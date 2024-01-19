<?php

namespace IShop\Model;

use IShop\widgets\mainNavigation\MainNavigation;

class CategoryModel extends AbstractModel
{
    public function getCategories(): array
    {
        return $this->db->getAssoc('SELECT * FROM category');
    }

    public function getChildCategoryIds(string $alias): array
    {
        $ids = [];
        $currentCategory = $this->getCategoryByAlias($alias);
        if (!$currentCategory->getID()) {
            return $ids;
        }
        $categories = $this->getCategories();
        $ids = $this->getIdsRecursive($currentCategory->getID(), $categories);
        return explode(',', $ids);
    }

    /**
     * @param string $alias
     * @return \RedBeanPHP\OODBBean|null
     */
    public function getCategoryByAlias(string $alias): ?\RedBeanPHP\OODBBean
    {
        return $this->db->findOne('category', 'alias = ?', [$alias]);
    }

    protected function getIdsRecursive(int $parent_id, array $categories): string
    {
        $ids = [$parent_id];
        foreach ($categories as $id => $category)
        {
            if ((int)$category['parent_id'] === $parent_id) {
                $ids[] = $this->getIdsRecursive($id, $categories);
            }
        }
        return implode(',', $ids);
    }

    public function getCategoryTree()
    {
        $treeModel = new MainNavigation();
        return $treeModel->getTreeCache();
    }

}
