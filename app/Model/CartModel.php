<?php

namespace IShop\Model;

use RedBeanPHP\Cursor;

class CartModel extends AbstractModel
{
    protected array $items = [];

    /**
     * @param array $product
     * @param int $qty
     * @param array|null $modification
     * @return void
     */
    public function addProduct(array $product, int $qty, array $modification = [])
    {
        $this->items[] = [
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

    /**
     * @return array
     */
    public function getCart(): array
    {
        $totals = $this->getTotals();
        return [
            'items'           => $this->items,
            'totals_qty'      => count($this->items),
            'totals'          => $totals,
            'totals_currency' => priceCurrency($totals, null, false)
        ];
    }
}
