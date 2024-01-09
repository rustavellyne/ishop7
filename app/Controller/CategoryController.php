<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\Model\AttributeModel;
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
        $filters = $parameters['filters'] ?? [];
        $filtersSql = '';
        if (!empty($filters)) {
            $attrIds = implode(', ', $filters);
            $group = (new AttributeModel())->getCountGroups($attrIds);
            $filtersSql = " AND id IN (SELECT product_id FROM attributeproduct a WHERE a.attr_id IN ($attrIds) GROUP BY product_id HAVING COUNT(product_id) = $group) ";
        }
        $totalProducts = $productModel->countProducts($ids, $filtersSql);
        $pagination = (new PaginationModel($totalProducts, $pageNumber, $perPage))->getPagination();
        $products = $productModel->getProducts($ids, 'category_id', $filtersSql, ['page' => $pageNumber, 'perPage' => $perPage]);
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

