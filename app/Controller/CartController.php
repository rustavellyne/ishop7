<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\Model\BreadcrumbsModel;
use IShop\Model\CartModel;
use IShop\Model\ProductModel;

class CartController extends BaseController
{
    private CartModel $cart;

    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->cart = new CartModel();
    }

    public function view()
    {
        echo json_encode($this->cart->getCart());
    }

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
        $this->cart->addProduct($product, $qty);
        if ($this->isAjax()) {
            echo json_encode($this->cart->getCart());
        } else {
            // message success add
            redirect();
        }
    }

    public function deleteCart()
    {
        $this->cart->deleteCart();
        if ($this->isAjax()) {
            echo json_encode(['message' => 'cart was removed']);
        } else {
            // message success add
            redirect();
        }
    }

    public function deleteCartItem()
    {
        $params = $this->getParameters('GET');
        $productId = $params['productId'];
        $this->cart->deleteCartItem($productId);
        if ($this->isAjax()) {
            echo json_encode($this->cart->getCart());
        } else {
            // message success add
            redirect();
        }
    }
}

