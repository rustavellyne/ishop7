<?php

namespace IShop\Model;

class CategoryModel extends AbstractModel
{
    public function getCategories(): array
    {
        return $this->db->getAssoc('SELECT * FROM category');
    }
}
