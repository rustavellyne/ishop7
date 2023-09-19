<?php

namespace IShop\Framework;

use \RedBeanPHP\R;
use \IShop\Framework\App;

class Db
{
    use TSingleton;
    
    public $connection;

    private function __construct()
    {
        $config = \IShop\Framework\App::getProperties('db');
        $msn = "mysql:host={$config['host']};dbname={$config['db_name']}";
        R::setup($msn, $config['db_user'], $config['db_pass']);
        if (!R::testConnection()) {
            throw new \Exception('DB connection failed!');
        }
        R::freeze(true);
        if (ENV === 'developer') {
            R::debug(true, 1);
        }
        $this->connection = R::getRedBean();
    }

    public function __destruct()
    {
         R::close();
    }
}

