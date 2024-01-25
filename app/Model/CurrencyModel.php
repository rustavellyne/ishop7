<?php

namespace IShop\Model;

class CurrencyModel extends AbstractModel
{
    /**
     * @var mixed
     */
    private array $attributes = [
        'title' => '',
        'code' => '',
        'symbol_left' => '',
        'symbol_right' => '',
        'value' => '',
        'base' => '',
    ];
    private ?int $id = null;

    public function getCurrencies()
    {
        return $this->db->findAll('currency');
    }

    public function getCurrencyById($id)
    {
        return $this->db->findOne('currency', "WHERE id = ?", [$id]);
    }

    private function populate($data)
    {
        $data['base'] = $data['base'] == '1' ? '2' : '1'; // ENUM index
        return $data;
    }

    public function load(array $data)
    {
        $data = $this->populate($data);
        foreach ($this->attributes as $key => $value) {
            if (!isset($data[$key])) {
                throw new \Exception("Error field $key is required");
            }
            $this->attributes[$key] = $data[$key];
        }

        return $this;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function delete($bean)
    {
        $this->db->remove($bean);
    }

    public function save()
    {
        if ($this->id) {
            $this->attributes['id'] = $this->id;
        }
        return $this->db->save('currency', $this->attributes);
    }

}
