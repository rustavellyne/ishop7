<?php

namespace IShop\Model;

class ProductModel extends AbstractModel
{
    /**
     * @param $alias
     * @return int|\RedBeanPHP\Cursor|string[]|NULL
     */
    public function getProduct($alias)
    {
        return $this->db->getAssoc("SELECT * FROM product WHERE alias = :alias", [':alias' => $alias]);
    }
}
