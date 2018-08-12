<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model {

    public function create($data) {
        $this->db->insert('maps', $data);
        return $this->db->insert_id();
    }

    public function get($id) {
        $this->db->where('id', $id);
        $this->db->from('maps');
        $map = $this->db->get()->first_row();
        if($map) {
            return $map;
        }
        return null;
    }

    public function set_tree($id, $tree_id) {
        $this->db->set('tree_id', $tree_id);
        $this->db->where('id', $id);
        $this->db->where('user_id', $this->user->id);
        $this->db->update('maps');
        return $this->db->affected_rows();
    }

    public function set_bed($id, $bed_id) {
        $this->db->set('bed_id', $bed_id);
        $this->db->where('id', $id);
        $this->db->where('user_id', $this->user->id);
        $this->db->update('maps');
        return $this->db->affected_rows();
    }

    public function set_land($id, $land_id) {
        $this->db->set('land_id', $land_id);
        $this->db->where('id', $id);
        $this->db->where('user_id', $this->user->id);
        $this->db->update('maps');
        return $this->db->affected_rows();
    }
}
