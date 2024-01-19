<?php

namespace IShop\Controller\Admin;

use IShop\Model\CategoryModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class CategoryController extends AbstractAdminController
{
    public function index()
    {
        $catModel = new CategoryModel();
        $tree = $catModel->getCategoryTree();
        $data = compact('tree');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'catalog']]);
        echo $this->renderPage();
    }

    public function remove()
    {
        $parameters = $this->getParameters('GET');
        if (!isset($parameters['id']) || !is_numeric($parameters['id'])) {
            FlashMessage::addMessage('Wrong parameter', FlashMessage::ERROR);
            redirect();
        }
        $catModel = new CategoryModel();
        $result = $catModel->removeCategoryById($parameters['id']);
        if ($result) {
            FlashMessage::addMessage('Category removed', FlashMessage::SUCCESS);
            redirect('/admin/category');
        }
        FlashMessage::addMessage('Category has sub children or products assigned', FlashMessage::ERROR);
        redirect('/admin/category');
    }

    public function add()
    {
        if ($this->isPost()){
            $v = new Validator($_POST);
            $rules = [
                'required' => [['parent_id'], ['category_title'], ['category_description'], ['category_keywords']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $catModel = new CategoryModel();
                $result = $catModel->saveCategory($_POST);
                if (!$result) {
                    FlashMessage::addMessage('Wrong Save Form', FlashMessage::ERROR);
                    redirect();
                }
                FlashMessage::addMessage('Category saved', FlashMessage::SUCCESS);
                redirect('/admin/category');
            } else {
                FlashMessage::addMessage('Wrong Form data', FlashMessage::ERROR);
                redirect();
            }
        } else {
            $parameters = $this->getParameters('GET');
            if (!isset($parameters['id']) || !is_numeric($parameters['id'])) {
                FlashMessage::addMessage('Wrong parameters', FlashMessage::ERROR);
                redirect('/admin/category');
                return;
            }
            $parent_id = $parameters['id'];
            $catModel = new CategoryModel();
            $parentCat = $catModel->getCategoryById($parent_id);
            $data = compact('parent_id', 'parentCat');
        }

        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'catalog']]);
        echo $this->renderPage();
    }
}
