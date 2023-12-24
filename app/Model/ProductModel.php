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

    /**
     * @param int $productId
     * @return int|\RedBeanPHP\Cursor|string[]|NULL
     */
    public function getRelatedProducts(int $productId)
    {
        $sql = "SELECT * FROM product p JOIN related_product rp ON p.id = rp.related_id WHERE rp.product_id = ?";
        return $this->db->getAssoc($sql, [$productId]);
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getProducts(array $ids): array
    {
        return $this->db->getEntityIN('product', 'id', $ids);
    }

    /**
     * @return array
     */
    public function getAlreadyViewedProducts($currentProductId): array
    {
        $ids = array_diff($this->getAlreadyViewedIds(), [$currentProductId]);
        $ids = array_slice($ids, -3);
        return $this->getProducts($ids);
    }

    /**
     * @return array
     */
    public function getAlreadyViewedIds(): array
    {
        return isset($_COOKIE['alreadyViewed']) ? explode(';', $_COOKIE['alreadyViewed']) : [];
    }

    /**
     * @param int $productId
     * @return void
     */
    public function markAsViewed(int $productId)
    {
        $idsArray = $this->getAlreadyViewedIds();
        if (in_array($productId, $idsArray)) {
            return;
        }
        $idsArray[] = $productId;
        $payload = implode(';', $idsArray);
        setcookie('alreadyViewed', $payload, time() + 3600 * 12);
    }
}
