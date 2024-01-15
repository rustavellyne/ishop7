<?php

namespace IShop\Controller\Admin;

use IShop\Framework\AbstractController;
use IShop\Model\CartModel;
use IShop\Model\DashBoardModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;
use IShop\Service\FlashMessage;

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

    public function status()
    {
        $parameters = $this->getParameters('GET');
        $statusId = (int)$parameters['status_id'];
        $orderId = (int)$parameters['order_id'];
        $orderModel = new OrderModel();
        $order = $orderModel->loadOrderById($orderId);
        if (!$order) {
            FlashMessage::addMessage('Order not found', FlashMessage::ERROR);
            redirect();
        }
        try {
            $orderModel->updateStatus($order, $statusId);
            FlashMessage::addMessage('Order Updated', FlashMessage::SUCCESS);
        } catch (\Exception $e) {
            FlashMessage::addMessage($e->getMessage(), FlashMessage::ERROR);
        }
        redirect();
    }

    public function delete()
    {
        $parameters = $this->getParameters('GET');
        $orderId = (int)$parameters['order_id'];
        $orderModel = new OrderModel();
        $order = $orderModel->loadOrderById($orderId);
        if (!$order) {
            FlashMessage::addMessage('Order not found', FlashMessage::ERROR);
            redirect();
        }
        FlashMessage::addMessage('Order Deleted', FlashMessage::SUCCESS);
        $orderModel->remove($order);
        redirect('/admin/order');
    }
}
