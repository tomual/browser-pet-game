<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model {

    public function create($data) {
        $this->db->insert('locations', $data);
        return $this->db->insert_id();
    }

    public function get_by_user_id($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->from('locations');
        $home = $this->db->get()->first_row();
        if($home) {
            return $home;
        }
        return null;
    }

    public function set_to_home($user_id) {
        $home = $this->home_model->get_by_user_id($user_id);
        return $this->set($user_id, $home->map_id);
    }

    public function set($user_id, $map_id) {
        $this->db->set('map_id', $map_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('locations');
        return $this->db->affected_rows();
    }
}
