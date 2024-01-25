<?php

namespace IShop\Controller\Admin;

use IShop\Model\AttributeModel;
use IShop\Model\CategoryModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;
use IShop\Model\UserModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class GroupsController extends AbstractAdminController
{
    public function index()
    {
        $groups = (new AttributeModel())->getGroups();
        $data = compact('groups');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'eav']]);
        echo $this->renderPage();
    }

    public function delete()
    {
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        $attrModel = new AttributeModel();
        $group = $attrModel->getGroupById($id);
        if (!is_numeric($id) || $id <= 0 || empty($group)) {
            FlashMessage::addMessage('Wrong product ID', FlashMessage::ERROR);
            redirect('/admin/groups');
        }
        $attrModel->delete($group);
        FlashMessage::addMessage('Group removed', FlashMessage::SUCCESS);
        redirect('/admin/groups');
    }

    public function create()
    {
        $formData = [];
        $errors = null;
        $page = [];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $rules = [
                'required' => [['title']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $groupModel = new AttributeModel();
                $groupModel->load($_POST)->save();
                FlashMessage::addMessage('EAV Group Created', FlashMessage::SUCCESS);
                redirect('/admin/groups');
            } else {
                FlashMessage::addMessage('Check Form', FlashMessage::ERROR);
                $errors = $v->errors();
                $formData = $_POST;
            }
        }
        $data = compact('formData', 'errors', 'page');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'eav']]);
        echo $this->renderPage();
    }

    public function edit()
    {
        $this->templateName = 'admin/groups/create';
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        $attrModel = new AttributeModel();
        $group = $attrModel->getGroupById($id);
        if (!is_numeric($id) || $id <= 0 || empty($group)) {
            FlashMessage::addMessage('Wrong product ID', FlashMessage::ERROR);
            redirect('/admin/groups');
        }

        $formData = [
            'id' => $group->id,
            'title' => $group->title,
        ];
        $errors = null;
        $page = [
            'title' => 'EAV Update',
            'breadcrumb' => 'Update',
        ];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $rules = [
                'required' => [['title'], ['id']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $groupModel = new AttributeModel();
                $groupModel->setGroupId($id);
                $groupModel->load($_POST)->save();
                FlashMessage::addMessage('EAV Group Updated', FlashMessage::SUCCESS);
                redirect('/admin/groups');
            } else {
                FlashMessage::addMessage('Check Form', FlashMessage::ERROR);
                $errors = $v->errors();
                $formData = $_POST;
            }
        }
        $data = compact('formData', 'errors', 'page');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'eav']]);
        echo $this->renderPage();
    }
}
