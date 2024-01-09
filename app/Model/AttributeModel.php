<?php

namespace IShop\Model;

class AttributeModel extends AbstractModel
{
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

}
