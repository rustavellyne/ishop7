<?php

namespace IShop\Controller;

use IShop\Model\ProductModel;
use IShop\Model\UserModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class UserController extends BaseController
{
    public function login()
    {
        echo 'Login';
    }

    public function register()
    {
        $errors = null;
        $form = [];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $userModel = new UserModel();
            $rules = [
                'required' => [['name'], ['last_name'], ['address'], ['login'], ['email'], ['password'], ['password_confirmation']],
                'email' => [['email']],
                'lengthMin' => [
                    ['password', 6],
                    ['password_confirmation', 6]
                ],
                'equals' => [['password', 'password_confirmation']],
            ];
            $v->rules($rules);
            $v->rule(function($field, $value, $params, $fields) use ($userModel) {
                return $userModel->isUnique($field, $value);
            }, ['login', 'email'])->message("{field} is already exists...");
            if ($v->validate()) {
                $id = $userModel->load($_POST)->save();
                FlashMessage::addMessage('Реєстрація пройшла успішно!', FlashMessage::SUCCESS);
                redirect('/');
            } else {
                FlashMessage::addMessage('Перегляньте форму', FlashMessage::ERROR);
                $errors = $v->errors();
                $form = $_POST;
            }
        }
        $data = compact('errors', 'form');
        $meta = ['head' => ['title' => 'Registration'], 'meta' => ''];
        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
    }
}

