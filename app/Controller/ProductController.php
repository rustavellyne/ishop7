<?php

namespace IShop\Controller;

use IShop\Framework\App;
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
            'product' => $product
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

