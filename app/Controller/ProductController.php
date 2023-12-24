<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\Model\BreadcrumbsModel;
use IShop\Model\ProductModel;

class ProductController extends BaseController
{
    public function view()
    {
        $productAlias = reset($this->route['parameters']);
        if (empty($productAlias)) {
            throw new \Exception("Product Not Found: ", 404);
        }
        $productModel = new ProductModel();
        $breadcrumbsModel = new BreadcrumbsModel();
        $product = $productModel->getProduct($productAlias);
        $breadcrumbs = $breadcrumbsModel->getBreadcrumbs($product);
        $relatedProducts = $productModel->getRelatedProducts($product['product_id']);
        $productModel->markAsViewed($product['product_id']);
        $alreadyViewedProducts = $productModel->getAlreadyViewedProducts($product['product_id']);
        $data = [
            'product' => $product,
            'breadcrumbs' => $breadcrumbs,
            'relatedProducts' => $relatedProducts,
            'alreadyViewedProducts' => $alreadyViewedProducts
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

