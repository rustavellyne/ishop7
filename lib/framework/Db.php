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

    public function getAll($sql, $bindings = array())
    {
        return R::getAll($sql, $bindings);
    }

    public function getAssoc($sql, $bindings = array())
    {
        return R::getAssoc($sql, $bindings);
    }

    public function findOne($type, $sql = NULL, $bindings = array())
    {
        return R::findOne($type, $sql, $bindings);
    }

    public function findAll($type, $sql = NULL, $bindings = [])
    {
        return R::findAll($type, $sql, $bindings);
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

    public function getEntityIN($entity, $field, $values, $sql = '', $page = [])
    {
        $slots = R::genSlots( $values );
        $sql = "SELECT * FROM $entity WHERE $field IN ($slots) $sql ";
        if (!empty($page)) {
            $pageN = $page['page'] - 1;
            $sql .= "LIMIT {$pageN}, {$page['perPage']}";
        }
        return R::getAssoc($sql, $values);
    }

    /**
     * @param $sql
     * @param $bindings
     * @return array|int|\RedBeanPHP\Cursor|NULL
     */
    public function getRow($sql, $bindings = [])
    {
        return R::getRow($sql, $bindings);
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

    public function store($bean)
    {
        return R::store($bean);
    }

    public function loadById($entity, $id)
    {
        return R::load($entity, $id);
    }

    public function remove($bean)
    {
        return R::trash($bean);
    }

    public function execSql($sql, $bindings = [])
    {
        return R::exec($sql, $bindings);
    }

    public function __destruct()
    {
         R::close();
    }
}

