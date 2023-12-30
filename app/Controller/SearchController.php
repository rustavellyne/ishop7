<?php

namespace IShop\Controller;

use IShop\Model\ProductModel;

class SearchController extends BaseController
{
    public function index()
    {
        $getParams = $this->getParameters('GET');
        $query = $getParams['q'];
        $productModel = new ProductModel();
        $product = array_values($productModel->searchProducts($query, 'id, title'));
        echo json_encode($product);
    }

    public function page()
    {
        $getParams = $this->getParameters('GET');
        $query = $getParams['q'];
        $meta = [
            'head' => ['title' => 'Search page of ' . "'$query'"],
            'meta' => [
                ['name' => 'description', 'content' => 'Search of ISHop']
            ]
        ];
        $productModel = new ProductModel();
        $products = $productModel->searchProducts($query);
        $data = [
            'query' => $query,
            'products' => $products
        ];

        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
    }
}

