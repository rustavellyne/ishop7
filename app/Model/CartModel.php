<?php

namespace IShop\Model;

use RedBeanPHP\Cursor;

class CartModel extends AbstractModel
{
    protected array $items = [];
    private array $storage;

    public function __construct()
    {
        parent::__construct();
        $this->storage = &$_SESSION;
        $this->items = $this->storage['cart']['items'] ?? [];
    }

    public function __destruct()
    {
        $this->storage['cart']['items'] = $this->items;
    }

    /**
     * @param array $product
     * @param int $qty
     * @param array|null $modification
     * @return void
     */
    public function addProduct(array $product, int $qty, array $modification = [])
    {
        if (isset($this->items[$product['product_id']])) {
            $update = &$this->items[$product['product_id']];
            $update['qty'] += $qty;
            $update['total_price'] = $product['price'] * $update['qty'];
            return;
        }
        $this->items[$product['product_id']] = [
            'id'    => $product['product_id'],
            'alias' => $product['alias'],
            'title' => $product['title'],
            'price' => $product['price'],
            'img'   => $product['img'],
            'qty'   => $qty,
            'total_price' => $product['price'] * $qty
        ];
    }

    /**
     * @return void
     */
    public function deleteCart()
    {
        $this->items = [];
    }

    /**
     * @return array
     */
    public function getCartItems(): array
    {
        return $this->items;
    }

    /**
     * @return float
     */
    public function getTotals(): float
    {
        return array_reduce($this->items, fn ($carry, $item) => $carry + $item['total_price'], 0);
    }

    public function getTotalQty(): int
    {
        return array_reduce($this->items, fn($carry, $item) => $carry + $item['qty'], 0);
    }

    /**
     * @return array
     */
    public function getCart(): array
    {
        $totals = $this->getTotals();
        $totalQty = $this->getTotalQty();
        return [
            'items'           => $this->items,
            'totals_qty'      => $totalQty,
            'totals'          => $totals,
            'totals_currency' => priceCurrency($totals, null, false)
        ];
    }
}
