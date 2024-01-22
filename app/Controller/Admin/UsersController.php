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
        $perPage = $parameters['perpage'] ?? 5;
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

    public function delete()
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
        $userModel->deleteUser($user);
        FlashMessage::addMessage('User Removed', FlashMessage::INFO);
        redirect('/admin/users');
    }

    public function edit()
    {
        $this->templateName = 'admin/users/create';
        $errors = null;
        $form = [];
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        if (!is_numeric($id) || $id <= 0) {
            FlashMessage::addMessage('Wrong user ID', FlashMessage::ERROR);
            redirect('/admin/users');
        }
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);
        $page = [
            'title' => 'User Update',
            'breadcrumb' => 'Update',
            'pass_not_required' => true
        ];
        $form = [
            'user_id'  => $user->id,
            'name' => $user->name,
            'login' => $user->login,
            'email' => $user->email,
            'address' => $user->address,
            'role' => $user->role,
        ];

        if ($this->isPost()) {
            $v = new Validator($_POST);
            $userModel = new UserModel();
            $userModel->setUserId($_POST['user_id'] ?? null);
            $rules = [
                'required' => [['user_id'], ['name'], ['address'], ['login'], ['email'], ['role']],
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
                FlashMessage::addMessage('Update успішний', FlashMessage::SUCCESS);
                redirect('/admin/users');
            } else {
                FlashMessage::addMessage('Перегляньте форму', FlashMessage::ERROR);
                $errors = $v->errors();
                $form = $_POST;
            }
        }

        $data = compact('errors', 'form', 'page');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'settings']]);
        echo $this->renderPage();
    }

    public function create()
    {
        $errors = null;
        $form = [];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $userModel = new UserModel();
            $rules = [
                'required' => [['name'], ['address'], ['login'], ['email'], ['password'], ['password_confirmation'], ['role']],
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
                redirect('/admin/users');
            } else {
                FlashMessage::addMessage('Перегляньте форму', FlashMessage::ERROR);
                $errors = $v->errors();
                $form = $_POST;
            }
        }
        $data = compact('errors', 'form');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'settings']]);
        echo $this->renderPage();
    }
}
