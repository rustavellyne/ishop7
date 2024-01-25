<?php

namespace IShop\Controller\Admin;

use IShop\Model\AttributeModel;
use IShop\Model\CategoryModel;
use IShop\Model\CurrencyModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;
use IShop\Model\UserModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class CurrencyController extends AbstractAdminController
{
    public function index()
    {
        $currencies = (new CurrencyModel())->getCurrencies();
        $data = compact('currencies');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'settings']]);
        echo $this->renderPage();
    }

    public function delete()
    {
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        $currencyModel = new CurrencyModel();
        $currency = $currencyModel->getCurrencyById($id);
        if (!is_numeric($id) || $id <= 0 || empty($currency)) {
            FlashMessage::addMessage('Wrong Currency ID', FlashMessage::ERROR);
            redirect('/admin/currency');
        }

        $currencyModel->delete($currency);
        FlashMessage::addMessage('Currency removed', FlashMessage::SUCCESS);
        redirect('/admin/currency');
    }

    public function create()
    {
        $formData = [];
        $errors = null;
        $page = [];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $rules = [
                'required' => [['title'], ['code'], ['value'], ['base']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $currencyModel = new CurrencyModel();
                $currencyModel->load($_POST)->save();
                FlashMessage::addMessage('Currency Created', FlashMessage::SUCCESS);
                redirect('/admin/currency');
            } else {
                FlashMessage::addMessage('Check Form', FlashMessage::ERROR);
                $errors = $v->errors();
                $formData = $_POST;
            }
        }
        $data = compact('formData', 'errors', 'page');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'settings']]);
        echo $this->renderPage();
    }

    public function edit()
    {
        $this->templateName = 'admin/currency/create';
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        $currencyModel = new CurrencyModel();
        $currency = $currencyModel->getCurrencyById($id);
        if (!is_numeric($id) || $id <= 0 || empty($currency)) {
            FlashMessage::addMessage('Wrong currency ID', FlashMessage::ERROR);
            redirect('/admin/currency');
        }
        $formData = [
            'id' => $currency->id,
            'title' => $currency->title,
            'code' => $currency->code,
            'symbol_left' => $currency->symbol_left,
            'symbol_right' => $currency->symbol_right,
            'value' => $currency->value,
            'base' => $currency->base,
        ];
        $errors = null;
        $page = [
            'title' => 'Currency Update',
            'breadcrumb' => 'Update',
        ];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $rules = [
                'required' => [['title'], ['code'], ['value'], ['base']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $currencyModel->setId($id);
                $currencyModel->load($_POST)->save();
                FlashMessage::addMessage('Currency Updated', FlashMessage::SUCCESS);
                redirect('/admin/currency');
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
