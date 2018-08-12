<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pet_model extends CI_Model {

    public function create($data) {
        $this->db->insert('pets', $data);
        return $this->db->insert_id();
    }

    public function get($id) {
        $this->db->where('id', $id);
        $this->db->from('pets');
        $pet = $this->db->get()->first_row();
        if($pet) {
            return $pet;
        }
        return null;
    }

    public function equip($hat_id) {
        $this->db->set('hat_id', $hat_id);
        $this->db->where('id', $this->user->pet_id);
        $this->db->update('pets');
        return $this->db->affected_rows();
    }
}
