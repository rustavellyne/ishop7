<?php

namespace IShop\Model;

use RedBeanPHP\Cursor;

class UserModel extends AbstractModel
{
    private array $storage;

    private ?int $userId = null;

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
                if (!empty($data[$key])) {
                    $this->attributes[$key] = password_hash($data[$key], PASSWORD_DEFAULT);
                } else {
                    unset($this->attributes['password']);
                }
            } else {
                $this->attributes[$key] = $data[$key];
            }
        }
        if (isset($data['role']) && $data['role'] === 'admin') {
            $this->attributes['role'] = $data['role'];
        }
        return $this;
    }

    /**
     * @param $user
     * @return int
     */
    public function deleteUser($user)
    {
        return $this->db->remove($user);
    }

    public function save()
    {
        if ($this->userId) {
            $this->attributes['id'] = $this->userId;
        }
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

    public function getUserById($id)
    {
        return $this->db->findOne('user', "id = ?", [$id]);
    }

    public function setUserId(int $id)
    {
        if (!is_numeric($id)) {
            return;
        }
        $this->userId = $id;
    }

    /**
     * @param $field
     * @param $value
     * @return bool
     */
    public function isUnique($field, $value): bool
    {
        $sql = '';
        if ($this->userId) {
            $sql = " AND id != $this->userId ";
        }
        $result = $this->db->findOne('user', "$field = ?" . $sql, [$value]);
        return empty($result);
    }

    public function getUsers($page = [])
    {
        $sql = '';
        if ($page) {
            $pageN = $page['page'] - 1;
            $sql .= "LIMIT {$pageN}, {$page['perPage']}";
        }
        return $this->db->findAll('user', $sql);
    }

    public function count(): int
    {
        return $this->db->countEntity('user', '');
    }

}
