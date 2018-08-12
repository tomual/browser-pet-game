<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Inventory_model extends CI_Model
{
    public function add($user_id, $item_id)
    {
        $data = [
            'user_id' => $user_id,
            'item_id' => $item_id
        ];
        $this->db->insert('inventory', $data);
        return $this->db->insert_id();
    }

    public function get($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->join('items', 'inventory.item_id = items.id', 'left');
        $this->db->from('inventory');
        $result = $this->db->get()->result();

        return $result;
    }
}