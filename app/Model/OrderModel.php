<?php

namespace IShop\Model;

use RedBeanPHP\Cursor;

class OrderModel extends AbstractModel
{
    private string $orderTable = 'order';
    private string $orderItemTable = 'orderproduct';

    public function placeOrder($cart, $userId, $userData)
    {
        $orderTransfer = $this->prepareOrderData($userId, $userData);
        $orderId = $this->db->save($this->orderTable, $orderTransfer);
        if ($orderId) {
            $orderItemsTransfer = $this->prepareOrderItemData($orderId, $cart['items']);
            $result = $this->db->multipleSave($this->orderItemTable, $orderItemsTransfer);
            return $orderId;
        }
        throw new \Exception('ERROR SAVING ORDER');
    }

    public function placeOrderGuest($cart, $guestData, $userId = 0)
    {
        return $this->placeOrder($cart, $userId, $guestData);
    }

    private function prepareOrderItemData($orderId, $products): array
    {
        $data = array_map(fn ($item) => [
            'order_id'   => $orderId,
            'product_id' => $item['id'],
            'qty'        => $item['qty'],
            'title'      => $item['title'],
            'price'      => $item['price'],
        ], $products);
        return array_values($data);
    }

    private function prepareOrderData($userId, $userData): array
    {
        return [
            'user_id'  => $userId,
            'currency' => 'USD',
            'note' => \json_encode($userData)
        ];
    }
}


/**
 * ORDER TABLE
 * id|user_id|status|date|update_at|currency|note|
 * --+-------+------+----+---------+--------+----+
 *
 * ORDER PRODUCT
 * id|order_id|product_id|qty|title|price|
 * --+--------+----------+---+-----+-----+
 */