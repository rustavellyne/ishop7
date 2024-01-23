<?php

namespace IShop\Controller\Admin;

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
}
