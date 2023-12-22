<?php

namespace IShop\Model;

class AbstractModel
{
    protected \IShop\Framework\Db $db;

    public function __construct()
    {
        $db = \IShop\Framework\Db::getInstance();
        $this->db = $db;
    }
}