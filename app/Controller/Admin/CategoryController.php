<?php

namespace IShop\Controller\Admin;

use IShop\Framework\AbstractController;
use IShop\Model\CartModel;
use IShop\Model\CategoryModel;
use IShop\Model\DashBoardModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;
use IShop\Service\FlashMessage;

class CategoryController extends AbstractAdminController
{
    public function index()
    {
        $parameters = $this->getParameters('GET');
        $catModel = new CategoryModel();
        $tree = $catModel->getCategoryTree();
        $data = compact('tree');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'catalog']]);
        echo $this->renderPage();
    }

    public function view()
    {
        $parameters = $this->getParameters('GET');
        $orderId = (int)$parameters['id'];
        if (!$orderId) {
            throw new \Exception("Order Not Found: ", 404);
        }
        $orderModel = new OrderModel();
        $order = $orderModel->getOrderById($orderId);
        if (empty($order['order_id'])) {
            throw new \Exception("Order Not Found: ", 404);
        }
        $orderProducts = $orderModel->getOrderProductsById($orderId);
        $data = compact('order', 'orderProducts');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'sales']]);
        echo $this->renderPage();
    }
}
