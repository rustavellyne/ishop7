<?php

namespace IShop\Controller\Admin;

use IShop\Model\CategoryModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;
use IShop\Model\UserModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class UsersController extends AbstractAdminController
{
    public function index()
    {
        $parameters = $this->getParameters('GET');
        $pageNumber = $parameters['page'] ?? 1;
        $perPage = $parameters['perpage'] ?? 1;
        $userModel = new UserModel();
        $usersQty = $userModel->count();
        $pagination = (new PaginationModel($usersQty, $pageNumber, $perPage))->getPagination();
        $users = $userModel->getUsers(['page' => $pageNumber, 'perPage' => $perPage]);
        $data = compact('users', 'pagination');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'settings']]);
        echo $this->renderPage();
    }

    public function view()
    {
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        if (!is_numeric($id) || $id <= 0) {
            FlashMessage::addMessage('Wrong user ID', FlashMessage::ERROR);
            redirect('/admin/users');
        }
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);
        if (!$user) {
            FlashMessage::addMessage('User not found', FlashMessage::ERROR);
            redirect('/admin/users');
        }
        $userOrders = (new OrderModel())->getOrderByField('user_id', $id);
        $data = compact('user', 'userOrders');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'settings']]);
        echo $this->renderPage();
    }
}
