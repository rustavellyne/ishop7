<?php

namespace IShop\Controller\Admin;

use IShop\Framework\AbstractController;
use IShop\Model\UserModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class LoginController extends AbstractAdminController
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->layout = 'admin_login';
        if ($this->isAdmin()) {
            redirect('/admin');
        }
    }

    public function index()
    {
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $rules = [
                'required' => [['email'], ['password']],
                'email' => [['email']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $userModel = new UserModel();
                $user = $userModel->getUserByField('email', $_POST['email'], 'admin');
                if ($user && password_verify($_POST['password'], $user->password)) {
                    foreach ($user as $k => $v) {
                        if ($k !== 'password') {
                            $_SESSION['admin'][$k] = $v;
                        }
                    }
                    FlashMessage::addMessage("Вітаємо, {$_SESSION['user']['name']}! ", FlashMessage::SUCCESS);
                    redirect('/admin');
                } else {
                    FlashMessage::addMessage('Wrong email or password', FlashMessage::ERROR);
                    redirect();
                }
                return;
            } else {
                FlashMessage::addMessage('Wrong email or password', FlashMessage::ERROR);
                redirect();
                return;
            }
        }
        echo $this->renderPage();
    }
}
