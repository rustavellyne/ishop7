<?php

namespace IShop\Model;

class DashBoardModel extends AbstractModel
{

    public function getStatistics(): array
    {
        $ordersQty = $this->db->countEntity('order', '');
        $customersQty = $this->db->countEntity('user', 'WHERE role = "user"');
        $productsQty = $this->db->countEntity('product', '');
        $categoriesQty = $this->db->countEntity('category', '');
        return compact('ordersQty', 'customersQty', 'categoriesQty', 'productsQty');
    }
}