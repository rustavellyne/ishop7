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
        $sql = "SELECT p.*, p.id as product_id, c.title as category_name, c.alias as category_alias 
            FROM product p 
            LEFT JOIN category c ON p.category_id = c.id 
            WHERE p.alias = :alias AND p.status = '1' LIMIT 1";
        $result = (array)$this->db->getAssoc($sql, [':alias' => $alias]);
        return reset($result);
    }

    public function getRelatedProducts(int $productId)
    {
        $sql = "SELECT * FROM product p JOIN related_product rp ON p.id = rp.related_id WHERE rp.product_id = ?";
        return $this->db->getAssoc($sql, [$productId]);
    }
}
