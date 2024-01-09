<?php

namespace IShop\widgets\categoryFilters;

use IShop\Model\AttributeModel;

class CategoryFilter
{
    protected array $filters = [];

    protected string $template = __DIR__ . '/template/main.php';

    protected \IShop\Framework\Cache $cache;

    protected string $cacheKey = 'IShop7_category_filters';

    private AttributeModel $attributeModel;

    public function __construct()
    {
        $this->cache = \IShop\Framework\Cache::getInstance();
        $this->attributeModel = new AttributeModel();
    }

    protected function getFilters()
    {
        $result = $this->attributeModel->getAttributeAndGroups();
        $filters = [];
        foreach ($result as $item) {
            $filters[$item['group_id']]['attributes'][] = $item;
            $filters[$item['group_id']]['group'] = [
                'group_id' => $item['group_id'],
                'group_title' => $item['group_title'],
            ];
        }
        $this->filters = $filters;
    }

    /**
     * @return array
     */
    protected function getFiltersCache(): array
    {
        $cached = $this->cache->get($this->cacheKey);
        if (!empty($cached)) {
            return $cached;
        }
        $this->getFilters();
        $this->cache->set($this->cacheKey, $this->filters);

        return $this->filters;
    }

    public function toHtml(): string
    {
        $filters = $this->getFiltersCache();
        $checked = $_GET['filters'] ?? [];
        ob_start();
        include $this->template;
        return ob_get_clean();
    }
}