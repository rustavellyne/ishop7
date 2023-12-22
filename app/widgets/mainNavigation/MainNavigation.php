<?php

namespace IShop\widgets\mainNavigation;

class MainNavigation
{
    protected array $categories = [];

    protected string $template = __DIR__ . '/template/main.php';

    protected \IShop\Framework\Cache $cache;

    protected string $cacheKey = 'IShop7_menu';

    public function __construct()
    {
        $db = \IShop\Framework\Db::getInstance();
        $categories = $db->connection->find('category');
        $this->categories = array_map(fn($item) => $item->getProperties(), $categories);
        $this->cache = \IShop\Framework\Cache::getInstance();
    }

    /**
     * Example of working with reference
     *
     * @return array
     */
    protected function getTreeByReference(): array
    {
        $tree = [];
        $data = $this->categories;
        foreach ($data as $id => &$category) {
            if (!$category['parent_id']) {
                $tree[$id] = &$category;
            } else {
                $data[$category['parent_id']]['childs'][$id] = &$category;
            }
        }
        return $tree;
    }

    public function renderChild($items, $level = 0)
    {
        $template = __DIR__ . "/template/children_level_{$level}.php";
        ob_start();
        include $template;
        return ob_get_clean();
    }

    /**
     * Recursive solution
     *
     * @param array $items
     * @param int $parentId
     * @return array
     */
    protected function getTree(array $items, int $parentId = 0): array
    {
        $result = [];
        foreach ($items as $item) {
            if ((int)$item['parent_id'] === $parentId) {
                $children = $this->getTree($items, (int)$item['id']);
                if (!empty($children)) {
                    $item['children'] = $children;
                }
                $result[] = $item;
            }
        }
        return $result;
    }

    /**
     * @return array
     */
    protected function getTreeCache():array {
        $cachedMenu = $this->cache->get($this->cacheKey);
        if (!empty($cachedMenu)) {
            return $cachedMenu;
        }
        $menu = $this->getTree($this->categories);
        $this->cache->set($this->cacheKey, $menu);

        return $menu;
    }

    public function toHtml(): string
    {
        $tree = $this->getTreeCache();
        ob_start();
        include $this->template;
        return ob_get_clean();
    }
}