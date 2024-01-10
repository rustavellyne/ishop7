<?php

namespace IShop\Controller\Admin;

use IShop\Framework\AbstractController;

class IndexController extends AbstractAdminController
{
    public function index()
    {
        echo $this->renderPage();
    }
}
