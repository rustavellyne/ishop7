<?php

namespace IShop\Controller\Admin;

use IShop\Framework\AbstractController;

class AbstractAdminController extends AbstractController
{
    public function __construct(array $route)
    {
        if (!$this->isAdmin() && strtolower($route['controller']) !== 'login') {
            redirect('/admin/login');
        }
        parent::__construct($route);
    }

    public function isAdmin()
    {
        return isset($_SESSION['admin']);
    }
}
