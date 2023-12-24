<?php

namespace IShop\Model;

class BreadcrumbsModel extends AbstractModel
{
    public function getBreadcrumbs(array $product): array
    {
        $breadcrumbs = [];
        $categoryId = $product['category_id'];
        $categories =  (new CategoryModel())->getCategories();
        foreach ($categories as $catId => $category) {
            if (isset($categories[$categoryId])) {
                $breadcrumbs[] = $categories[$categoryId];
                $categoryId = $categories[$categoryId]['parent_id'];
            } else {
                break;
            }
        }
        $product['alias'] = null;
        $breadcrumbs[] = $product;
        return array_map(fn ($item) => ['alias' => $item['alias'], 'title' => $item['title']], $breadcrumbs);
    }
}
