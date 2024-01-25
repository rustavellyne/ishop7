<?php

namespace IShop\Controller\Admin;

use IShop\Model\AttributeModel;
use IShop\Model\CategoryModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;
use IShop\Model\UserModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class AttributesController extends AbstractAdminController
{
    public function index()
    {
        $groupsAndAttributes = (new AttributeModel())->getAttributeAndGroups();
        $data = compact('groupsAndAttributes');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'eav']]);
        echo $this->renderPage();
    }

    public function delete()
    {
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        $attrModel = new AttributeModel();
        $attr = $attrModel->getAttributeById($id);
        if (!is_numeric($id) || $id <= 0 || empty($attr)) {
            FlashMessage::addMessage('Wrong attr ID', FlashMessage::ERROR);
            redirect('/admin/attributes');
        }
        $attrModel->delete($attr);
        FlashMessage::addMessage('Group removed', FlashMessage::SUCCESS);
        redirect('/admin/attributes');
    }

    public function create()
    {
        $formData = [];
        $errors = null;
        $page = [];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $rules = [
                'required' => [['value'], ['attr_group_id']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $groupModel = new AttributeModel();
                $groupModel->load($_POST, 'attributes')->save('attributevalue', 'attributes');
                FlashMessage::addMessage('EAV Attribute Created', FlashMessage::SUCCESS);
                redirect('/admin/attributes');
            } else {
                FlashMessage::addMessage('Check Form', FlashMessage::ERROR);
                $errors = $v->errors();
                $formData = $_POST;
            }
        }
        $groups = $groups = (new AttributeModel())->getGroups();
        $data = compact('formData', 'errors', 'page', 'groups');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'eav']]);
        echo $this->renderPage();
    }

    public function edit()
    {
        $this->templateName = 'admin/attributes/create';
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        $attrModel = new AttributeModel();
        $attr = $attrModel->getAttributeById($id);
        if (!is_numeric($id) || $id <= 0 || empty($attr)) {
            FlashMessage::addMessage('Wrong Attribute ID', FlashMessage::ERROR);
            redirect('/admin/attributes');
        }

        $formData = [
            'id'            => $attr->id,
            'value'         => $attr->value,
            'attr_group_id' => $attr->attr_group_id,
        ];
        $errors = null;
        $page = [
            'title' => 'EAV Update',
            'breadcrumb' => 'Update',
        ];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $rules = [
                'required' => [['value'], ['id']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $groupModel = new AttributeModel();
                $groupModel->setGroupId($id);
                $groupModel->load($_POST, 'attributes')->save('attributevalue', 'attributes');
                FlashMessage::addMessage('EAV Group Updated', FlashMessage::SUCCESS);
                redirect('/admin/attributes');
            } else {
                FlashMessage::addMessage('Check Form', FlashMessage::ERROR);
                $errors = $v->errors();
                $formData = $_POST;
            }
        }
        $groups = (new AttributeModel())->getGroups();
        $data = compact('formData', 'errors', 'page', 'groups');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'eav']]);
        echo $this->renderPage();
    }
}
