<?php

namespace IShop\Controller;

use IShop\Model\ProductModel;

class UserController extends BaseController
{
    public function login()
    {
        echo 'Login';
    }

    public function register()
    {
        if ($this->isPost()) {
            dd($_POST);
            exit;
        }
        $data = [];
        $meta = ['head' => ['title' => 'Registration'], 'meta' => ''];
        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
    }
}

