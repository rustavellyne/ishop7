<?php

namespace IShop\Controller\Admin;

use IShop\Framework\AbstractController;
use IShop\Model\DashBoardModel;

class IndexController extends AbstractAdminController
{
    public function index()
    {
        $data = (new DashBoardModel())->getStatistics();
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'dashboard']]);
        echo $this->renderPage();
    }
}
