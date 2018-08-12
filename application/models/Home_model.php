<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function create($data) {
        $this->db->insert('homes', $data);
        return $this->db->insert_id();
    }

    public function get_by_user_id($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->from('homes');
        $home = $this->db->get()->first_row();
        if($home) {
            return $home;
        }
        return null;
    }

    public function set($user_id, $map_id) {
        $this->db->set('map_id', $map_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('homes');
        return $this->db->affected_rows();
    }
}
