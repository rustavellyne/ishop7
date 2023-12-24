<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\Model\BreadcrumbsModel;
use IShop\Model\ProductModel;

class ProductController extends BaseController
{
    public function view()
    {
        $productId = reset($this->route['parameters']);
        if (empty($productId)) {
            throw new \Exception("Product Not Found: ", 404);
        }
        $productModel = new ProductModel();
        $breadcrumbsModel = new BreadcrumbsModel();
        $product = $productModel->getProduct($productId);
        $breadcrumbs = $breadcrumbsModel->getBreadcrumbs($product);
        $data = [
            'product' => $product,
            'breadcrumbs' => $breadcrumbs
        ];
        $meta = [
            'head' => ['title' => $product['title']],
            'meta' => [
                ['name' => 'description', 'content' => 'some content of ISHop']
            ]
        ];

        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
    }
}

