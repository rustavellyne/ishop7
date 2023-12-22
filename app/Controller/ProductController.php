<?php

namespace IShop\Controller;

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
        $product = $productModel->getProduct($productId);
        $data = [
            'product' => $product,
        ];
        $meta = [

        ];

        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
    }
}

