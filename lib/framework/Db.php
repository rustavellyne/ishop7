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

    public function getAssoc($sql, $bindings = array())
    {
        return R::getAssoc($sql, $bindings);
    }

    public function findOne($type, $sql = NULL, $bindings = array())
    {
        return R::findOne($type, $sql, $bindings);
    }

    /**
     * @param string $entity
     * @param string $sql
     * @return int
     */
    public function countEntity(string $entity, string $sql): int
    {
        return R::count($entity, $sql);
    }

    public function getEntityIN($entity, $field, $values, $page = [])
    {
        $slots = R::genSlots( $values );
        $sql = "SELECT * FROM $entity WHERE $field IN ($slots)";
        if (!empty($page)) {
            $sql .= "LIMIT {$page['page']}, {$page['perPage']}";
        }
        return R::getAssoc($sql, $values);
    }

    /**
     * @param $tableName
     * @param $data
     * @return int[]
     */
    public function multipleSave($tableName, $data): array
    {
        if (count($data) === 1) {
            return (array) $this->save($tableName, $data[0]);
        }
        $beans = R::dispense($tableName, count($data));
        foreach ($data as $index => $row) {
            foreach ($row as $key => $value) {
                $beans[$index]->$key = $value;
            }
        }
        return R::storeAll($beans);
    }

    public function save($tableName, $data)
    {
        $table = R::dispense($tableName);
        foreach ($data as $key => $value) {
            $table->$key = $value;
        }
        return R::store($table);
    }

    public function __destruct()
    {
         R::close();
    }
}

