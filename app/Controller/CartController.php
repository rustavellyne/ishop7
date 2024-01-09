<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\Model\BreadcrumbsModel;
use IShop\Model\CartModel;
use IShop\Model\OrderModel;
use IShop\Model\ProductModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

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

    public function placeOrder()
    {
        $cart = $this->cart->getCart();
        if (!isset($cart['totals_qty']) || $cart['totals_qty'] <= 0) {
            FlashMessage::addMessage("Додайте товари до кошика", FlashMessage::INFO);
            redirect();
        }

        if (!$this->isPost()) {
            FlashMessage::addMessage("Помилка зверніться в службу підтримки", FlashMessage::ERROR);
            redirect();
        }

        if (isset($_SESSION['user']) && $_SESSION['user']['is_auth']) {
            // place fo registered
            $userId = $_SESSION['user']['id'];
            $orderModel = new OrderModel();
            $orderId = $orderModel->placeOrder($cart, $userId, $_POST);
            $this->cart->deleteCart();
            FlashMessage::addMessage("Success order, your order number: $orderId", FlashMessage::SUCCESS);
            redirect('/');
            return;
        } else {
            $v = new Validator($_POST);
            $rules = [
                'required' => [['name'], ['last_name'], ['address'], ['email']],
                'email' => [['email']],
            ];
            $v->rules($rules);
            if ($v->validate()) {
                // place for guest
                $orderModel = new OrderModel();
                $orderId = $orderModel->placeOrderGuest($cart, $_POST);
                $this->cart->deleteCart();
                FlashMessage::addMessage("Success order, your order number: $orderId", FlashMessage::SUCCESS);
                redirect('/');
                return;
            } else {
                $_SESSION['errors'] = $v->errors();
                $_SESSION['form'] = $_POST;
                FlashMessage::addMessage("Check Form", FlashMessage::ERROR);
                redirect();
            }
        }
        FlashMessage::addMessage("Помилка зверніться в службу підтримки", FlashMessage::ERROR);
        redirect();
    }

    public function checkout() {
        $cart = $this->cart->getCart();
        if (!isset($cart['totals_qty']) || $cart['totals_qty'] <= 0) {
            FlashMessage::addMessage("Додайте товари до кошика", FlashMessage::INFO);
            redirect();
        }
        $errors = $_SESSION['errors'] ?? [];
        $form = $_SESSION['form'] ?? [];
        unset($_SESSION['errors']);
        unset($_SESSION['form']);
        $data = compact('cart', 'form', 'errors');
        $meta = ['head' => ['title' => 'Checkout'], 'meta' => ''];
        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
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

