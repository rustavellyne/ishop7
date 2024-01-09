<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\Model\BreadcrumbsModel;
use IShop\Model\CategoryModel;
use IShop\Model\PaginationModel;
use IShop\Model\ProductModel;

class CategoryController extends BaseController
{
    public function view()
    {
        $categoryAlias = reset($this->route['parameters']);
        $parameters = $this->getParameters('GET');
        if (empty($categoryAlias)) {
            throw new \Exception("Category Not Found: ", 404);
        }
        $catModel = new CategoryModel();
        $productModel = new ProductModel();
        $categoryCurrent = $catModel->getCategoryByAlias($categoryAlias);
        $ids = $catModel->getChildCategoryIds($categoryAlias);
        $pageNumber = $parameters['page'] ?? 1;
        $perPage = $parameters['perpage'] ?? 3;
        $totalProducts = $productModel->countProducts($ids);
        $pagination = (new PaginationModel($totalProducts, $pageNumber, $perPage))->getPagination();
        $products = $productModel->getProducts($ids, 'category_id', ['page' => $pageNumber, 'perPage' => $perPage]);
        $this->setData(compact('categoryCurrent', 'products', 'pagination'));
        $this->setMeta([
            'head' => ['title' => $categoryCurrent->title],
            'meta' => [
                ['name' => 'description', 'content' => 'some content of ISHop']
            ]
        ]);
        echo $this->renderPage();
    }
}

