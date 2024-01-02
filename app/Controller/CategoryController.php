<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\Model\BreadcrumbsModel;
use IShop\Model\CategoryModel;
use IShop\Model\ProductModel;

class CategoryController extends BaseController
{
    public function view()
    {
        $categoryAlias = reset($this->route['parameters']);
        if (empty($categoryAlias)) {
            throw new \Exception("Category Not Found: ", 404);
        }
        $catModel = new CategoryModel();
        $productModel = new ProductModel();
        $categoryCurrent = $catModel->getCategoryByAlias($categoryAlias);
        $ids = $catModel->getChildCategoryIds($categoryAlias);
        $products = $productModel->getProducts($ids);
        $this->setData(compact('categoryCurrent', 'products'));
        $this->setMeta([
            'head' => ['title' => $categoryCurrent->title],
            'meta' => [
                ['name' => 'description', 'content' => 'some content of ISHop']
            ]
        ]);
        echo $this->renderPage();
    }
}

