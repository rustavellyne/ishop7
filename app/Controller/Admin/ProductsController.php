<?php

namespace IShop\Controller\Admin;

use IShop\Model\BrandModel;
use IShop\Model\CategoryModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;
use IShop\Model\ProductModel;
use IShop\Model\UserModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class ProductsController extends AbstractAdminController
{
    public function index()
    {
        $parameters = $this->getParameters('GET');
        $pageNumber = $parameters['page'] ?? 1;
        $perPage = $parameters['perpage'] ?? 5;
        $productModel = new ProductModel();
        $productQty = $productModel->count();
        $pagination = (new PaginationModel($productQty, $pageNumber, $perPage))->getPagination();
        $products = $productModel->getProductsCollection(['page' => $pageNumber, 'perPage' => $perPage]);
        $data = compact('products', 'pagination');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'catalog']]);
        echo $this->renderPage();
    }

    public function create()
    {
        // TODO: image content load exclude base64 integrate file manager for handling images
        $formData = [];
        $errors = null;
        $page = [];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $productModel = new ProductModel();
            $rules = [
                'required' => [['title'], ['price'], ['category_id'], ['brand_id'], ['status']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $id = $productModel->load($_POST)->save();
                FlashMessage::addMessage('Product added', FlashMessage::SUCCESS);
                redirect('/admin/products   ');
            } else {
                FlashMessage::addMessage('Check Form', FlashMessage::ERROR);
                $errors = $v->errors();
                $formData = $_POST;
            }
        }
        $brands = (new BrandModel())->getBrands();
        $categories = (new CategoryModel())->getCategoriesObj();
        $statuses = [
            '0' => 'Disabled',
            '1' => 'Active',
        ];
        $data = compact('formData', 'errors', 'page', 'brands', 'categories', 'statuses');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'catalog']]);
        echo $this->renderPage();
    }

    public function edit()
    {
        $this->templateName = 'admin/products/create';
        // TODO: image content load exclude base64 integrate file manager for handling images
        $parameters = $this->getParameters('GET');
        $id = $parameters['id'] ?? 0;
        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);
        if (!is_numeric($id) || $id <= 0 || empty($product)) {
            FlashMessage::addMessage('Wrong product ID', FlashMessage::ERROR);
            redirect('/admin/products');
        }
        $formData = [
            'id' => $product['product_id'],
            'title' => $product['title'],
            'price' => $product['price'],
            'old_price' => $product['old_price'],
            'category_id' => $product['category_id'],
            'brand_id' => $product['brand_id'],
            'status' => $product['status'],
            'content' => $product['content'],
            'description' => $product['description'],
            'keywords' => $product['keywords'],
            'hit' => $product['hit'],
        ];
        $errors = null;
        $page = [];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $productModel->setProductId($id);
            $rules = [
                'required' => [['title'], ['price'], ['category_id'], ['brand_id'], ['status']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $id = $productModel->load($_POST)->save();
                FlashMessage::addMessage('Product added', FlashMessage::SUCCESS);
                redirect('/admin/products   ');
            } else {
                FlashMessage::addMessage('Check Form', FlashMessage::ERROR);
                $errors = $v->errors();
                $formData = $_POST;
            }
        }
        $brands = (new BrandModel())->getBrands();
        $categories = (new CategoryModel())->getCategoriesObj();
        $statuses = [
            '0' => 'Disabled',
            '1' => 'Active',
        ];
        $data = compact('formData', 'errors', 'page', 'brands', 'categories', 'statuses');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'catalog']]);
        echo $this->renderPage();
    }
}
