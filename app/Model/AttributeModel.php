<?php

namespace IShop\Model;

class AttributeModel extends AbstractModel
{
    /**
     * @var mixed
     */
    private array $attributes = [
        'title' => ''
    ];
    private ?int $groupId = null;

    public function getAttributeAndGroups()
    {
        $sql = "SELECT a.id as group_id, a.title as group_title, a2.id as attr_id, a2.value as attribute_title, a2.attr_group_id FROM attributegroup a LEFT JOIN attributevalue a2 ON a.id = a2.attr_group_id";
        return $this->db->getAll($sql);
    }

    public function getCountGroups($attrId): int
    {
        $result = $this->db->getAll("SELECT * FROM attributevalue WHERE id IN ($attrId)");
        $column = array_column($result, 'attr_group_id');
        $uniq = array_unique($column);
        return count($uniq);
    }
    public function getGroups()
    {
        return $this->db->findAll('attributegroup');
    }

    public function getGroupById($id)
    {
        return $this->db->findOne('attributegroup', "WHERE id = ?", [$id]);
    }

    public function load(array $data)
    {
        foreach ($this->attributes as $key => $value) {
            if (!isset($data[$key])) {
                throw new \Exception("Error field $key is required");
            }
            $this->attributes[$key] = $data[$key];
        }

        return $this;
    }
    public function setGroupId(int $id)
    {
        $this->groupId = $id;
    }

    public function delete($bean)
    {
        $this->db->remove($bean);
    }

    public function save()
    {
        if ($this->groupId) {
            $this->attributes['id'] = $this->groupId;
        }
        return $this->db->save('attributegroup', $this->attributes);
    }

}
