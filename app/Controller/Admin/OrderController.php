<?php

namespace IShop\Controller\Admin;

use IShop\Framework\AbstractController;
use IShop\Model\CartModel;
use IShop\Model\DashBoardModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;

class OrderController extends AbstractAdminController
{
    public function index()
    {
        $parameters = $this->getParameters('GET');
        $pageNumber = $parameters['page'] ?? 1;
        $perPage = $parameters['perpage'] ?? 10;
        $orderModel = new OrderModel();
        $totalOrders = $orderModel->count();
        $orders = $orderModel->getOrders(['page' => $pageNumber, 'perPage' => $perPage]);
        $pagination = (new PaginationModel($totalOrders, $pageNumber, $perPage))->getPagination();
        $data = compact('orders', 'pagination');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'sales']]);
        echo $this->renderPage();
    }

    public function view()
    {
        $parameters = $this->getParameters('GET');
        $orderId = $parameters['id'];
        if (!$orderId) {
            throw new \Exception("Order Not Found: ", 404);
        }

        echo "Order $orderId";
    }
}
