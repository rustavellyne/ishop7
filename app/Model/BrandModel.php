<?php

namespace IShop\Model;

use RedBeanPHP\Cursor;

class BrandModel extends AbstractModel
{
    public function getBrands()
    {
        return $this->db->findAll('brand');
    }
}
