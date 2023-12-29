<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\Model\BreadcrumbsModel;
use IShop\Model\CartModel;
use IShop\Model\ProductModel;

class CartController extends BaseController
{
    public function add()
    {
        $parameters = $this->getParameters('GET');
        $productId = $parameters['product_id'] ?? null;
        $modification = $parameters['modification'] ?? null;
        $qty = $parameters['quantity'] ?? 1;
        if (empty($productId)) {
            // wrong message send to user
            redirect();
        }
        /**
         * if Product Id get IT
         */
        $productModel = new ProductModel();
        $product = $productModel->getProductById($productId);
        if (empty($product)) {
            // wrong message send to user
            redirect();
        }
        $cart = new CartModel();
        $cart->addProduct($product, $qty);
        if ($this->isAjax()) {
            echo json_encode($cart->getCart());
        } else {
            // message success add
            redirect();
        }
    }
}

