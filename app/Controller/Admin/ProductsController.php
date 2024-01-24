<?php

namespace IShop\Controller\Admin;

use IShop\Model\BrandModel;
use IShop\Model\CategoryModel;
use IShop\Model\OrderModel;
use IShop\Model\PaginationModel;
use IShop\Model\ProductModel;
use IShop\Model\UserModel;
use IShop\Service\FlashMessage;
use IShop\widgets\categoryFilters\CategoryFilter;
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
        $attributes = (new CategoryFilter())->getFiltersCache();
        $productAttributes = [];
        $data = compact('formData', 'errors', 'page', 'brands', 'categories', 'statuses', 'attributes', 'productAttributes');
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
        $page = [
            'title' => 'Product Update',
            'breadcrumb' => 'Update',
        ];
        if ($this->isPost()) {
            $v = new Validator($_POST);
            $productModel->setProductId($id);
            $rules = [
                'required' => [['title'], ['price'], ['category_id'], ['brand_id'], ['status']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                $productModel->load($_POST)->save();
                FlashMessage::addMessage('Product Updated', FlashMessage::SUCCESS);
                redirect('/admin/products');
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
        $productAttributes = $productModel->getAttributesIds($id);
        $attributes = (new CategoryFilter())->getFiltersCache();
        $relatedProducts = $productModel->getRelatedProducts($id);
        $data = compact('formData', 'errors', 'page', 'brands', 'categories', 'statuses', 'attributes', 'productAttributes', 'relatedProducts');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'catalog']]);
        echo $this->renderPage();
    }

    public function relatedProductsWebservice()
    {
        if (!$this->isAjax()) redirect();

        $getParams = $this->getParameters('GET');
        $query = $getParams['q'] ?? null;
        $productId = $getParams['product_id'] ?? null;
        $productModel = new ProductModel();
        $data = $productModel->searchProductsService($query, 'id, title');
        $data = array_map(fn($item) => [
            'id' => $item['id'],
            'text' => $item['title']
        ], $data);
        if ($productId) {
            $relatedProducts = array_keys($productModel->getRelatedProducts($productId));
            foreach ($data as &$item) {
                if (in_array($item['id'], $relatedProducts)) {
                    $item['selected'] = true;
                }
            }
        }
        echo json_encode(['results' => $data]);
    }
}
