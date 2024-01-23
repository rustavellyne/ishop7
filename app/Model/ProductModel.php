<?php

namespace IShop\Model;

use RedBeanPHP\Cursor;

class ProductModel extends AbstractModel
{
    private ?int $productId = null;

    private array $attributes = [
        'category_id' => '',
        'brand_id' => '',
        'title' => '',
        'alias' => '',
        'content' => '',
        'price' => '',
        'old_price' => '',
        'status' => '',
        'keywords' => '',
        'description' => '',
        'hit' => '',
        'img' => '',
    ];

    public function setProductId(int $id)
    {
        $this->productId = $id;
    }

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

    public function searchProducts($query, $fields = '*'): array
    {
        $sql = "SELECT $fields FROM product WHERE title LIKE ?";
        return (array)$this->db->getAssoc($sql, ["%$query%"]);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getProductById(int $id): array
    {
        $sql = "SELECT p.*, p.id as product_id
            FROM product p 
            WHERE p.id = :id AND p.status = '1' LIMIT 1";
        $result = (array)$this->db->getAssoc($sql, [':id' => $id]);
        return array_shift($result);
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
    public function getProducts(array $ids, $field = 'id', $sql = '', $page = []): array
    {
        return $this->db->getEntityIN('product', $field, $ids, $sql, $page);
    }

    public function countProducts(array $ids, string $filters = ''): int
    {
        $ids = implode(',', $ids);
        return $this->db->countEntity('product', "category_id IN ($ids) $filters");
    }

    /**
     * @param $currentProductId
     * @return array
     */
    public function getAlreadyViewedProducts($currentProductId): array
    {
        $ids = array_diff($this->getAlreadyViewedIds(), [$currentProductId]);
        $ids = array_slice($ids, -3);
        if (empty($ids)) {
            return [];
        }
        return $this->getProducts($ids);
    }

    /**
     * @param int $productId
     * @return int|Cursor|string[]|NULL
     */
    public function getProductGallery(int $productId)
    {
        $sql = "SELECT * FROM gallery  WHERE product_id = ?";
        return $this->db->getAssoc($sql, [$productId]);
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

    /**
     * @param int $productId
     * @return int|Cursor|string[]|NULL
     */
    public function getProductModifications(int $productId)
    {
        $sql = "SELECT * FROM modification WHERE product_id = ?";
        return $this->db->getAssoc($sql, [$productId]);
    }

    public function count(): int
    {
        return $this->db->countEntity('product', '');
    }

    public function getProductsCollection($page = [], $sql = '', $order = 'DESC')
    {
        if ($page) {
            $pageN = ($page['page'] - 1) * $page['perPage'];
            $order = "ORDER BY product.id $order";
            $sql .= "$order LIMIT {$pageN}, {$page['perPage']}";
        }
        return $this->db->findAll('product', $sql);
    }

    public function load(array $data)
    {
        $data = $this->populate($data);
        foreach ($this->attributes as $key => $value) {
            if (!isset($data[$key])) {
                throw new \Exception("Error field $key is required");
            }
            $this->attributes[$key] = $data[$key];
        }

        return $this;
    }

    public function save()
    {
        if ($this->productId) {
            $this->attributes['id'] = $this->productId;
        }
        return $this->db->save('product', $this->attributes);
    }

    private function populate($data)
    {
        if ($data['title']) {
            $alias = slugify($data['title']);
            $duplicate = $this->getProduct($alias);
            if (!empty($duplicate)) {
                $alias .= '1';
            }
            $data['alias'] = $alias;
        }
        $data['img'] = 'temp';
        $data['hit'] = $data['hit'] == 'on' ? '2' : '1'; // ENUM index
        $data['status'] = $data['status'] == '1' ? '2' : '1'; // ENUM index
        return $data;
    }
}
