<?php

namespace IShop\Model;

use RedBeanPHP\Cursor;

class UserModel extends AbstractModel
{
    private array $storage;

    private array $attributes = [
        'name'      => '',
        'address'   => '',
        'login'     => '',
        'email'     => '',
        'password'  => ''
    ];

    public function __construct()
    {
        parent::__construct();
        $this->storage = &$_SESSION;
    }

    /**
     * @param $data
     * @return $this
     * @throws \Exception
     */
    public function load($data): self
    {
        foreach ($this->attributes as $key => $value) {
            if (!isset($data[$key])) {
                throw new \Exception("Error field $key is required");
            }
            if ($key === 'password') {
                $this->attributes[$key] = password_hash($data[$key], PASSWORD_DEFAULT);
            } else {
                $this->attributes[$key] = $data[$key];
            }
        }
        return $this;
    }

    public function save()
    {
        return $this->db->save('user', $this->attributes);
    }

    /**
     * @param $field
     * @param $value
     * @return \RedBeanPHP\OODBBean|NULL
     */
    public function getUserByField($field, $value, $role = 'user'): ?\RedBeanPHP\OODBBean
    {
        return $this->db->findOne('user', "$field = ? AND role = '$role'", [$value]);
    }

    /**
     * @param $field
     * @param $value
     * @return bool
     */
    public function isUnique($field, $value): bool
    {
        $result = $this->db->findOne('user', "$field = ?", [$value]);
        return empty($result);
    }

}
