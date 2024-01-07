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
        if (isset($_SESSION['user']) && $_SESSION['user']['is_auth']) {
            redirect('/');
        }
        $errors = null;
        $form = [];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $userModel = new UserModel();
            $rules = [
                'required' => [['login'], ['password']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $user = $userModel->getUserByField('login', $_POST['login']);
                if ($user && password_verify($_POST['password'], $user->password)) {
                    /**
                     * Place for setting user to session
                     */
                    $_SESSION['user'] = [
                        'is_auth' => true,
                        'is_admin' => false
                    ];
                    foreach ($user as $k => $v) {
                        if ($k !== 'password') {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    FlashMessage::addMessage("Вітаємо, {$_SESSION['user']['name']}! ", FlashMessage::SUCCESS);
                    redirect('/');
                } else {
                    $errors['login'] = ['Wrong login or password'];
                    $form = $_POST;
                }

            } else {
                FlashMessage::addMessage('Сталася помилка', FlashMessage::ERROR);
                $errors = $v->errors();
                $form = $_POST;
            }
        }
        $data = compact('errors', 'form');
        $meta = ['head' => ['title' => 'Login'], 'meta' => ''];
        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
    }

    public function logout () {
        unset($_SESSION['user']);
        redirect();
    }

    public function register()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['is_auth']) {
            redirect('/');
        }
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

