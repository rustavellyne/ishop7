<?php

namespace IShop\Model;

use IShop\widgets\mainNavigation\MainNavigation;

class CategoryModel extends AbstractModel
{
    public function getCategories(): array
    {
        return $this->db->getAssoc('SELECT * FROM category');
    }

    public function getCategoriesObj(): array
    {
        return $this->db->findAll('category');
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

    public function getCategoryById(int $id)
    {
        if ($id === 0) {
            $root = new \stdClass();
            $root->id = 0;
            $root->title = 'Root';
            return $root;
        }
        return $this->db->findOne('category', 'id = ?', [$id]);
    }

    public function saveCategory($data)
    {
        $newCatData = [
            'parent_id' => $data['parent_id'] ?? 0,
            'title' => $data['category_title'],
            'description' => $data['category_description'],
            'keywords' => $data['category_keywords'],
            'alias' => $this->getAliasForCategory($data['category_title']),
        ];

        return $this->db->save('category', $newCatData);
    }

    protected function getAliasForCategory(string $title): string
    {
        $alias = slugify($title);
        $duplicate = $this->getCategoryByAlias($alias);
        if ($duplicate) {
            // TODO: better implementation of avoiding duplicate aliases
            return $duplicate->alias . '1';
        }
        return $alias;
    }

    public function removeCategoryById(int $id): bool
    {
        $childrenQty = $this->db->countEntity('category', "WHERE parent_id = $id");
        if ($childrenQty) {
            return false;
        }
        $productsQty = $this->db->countEntity('product', "WHERE category_id = $id");
        if ($productsQty) {
            return false;
        }
        $category = $this->db->loadById('category', $id);
        $this->db->remove($category);
        return true;
    }

}
