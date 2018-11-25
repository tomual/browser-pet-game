<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model {

    public function create($data) {
        $this->db->insert('locations', $data);
        return $this->db->insert_id();
    }

    public function is_home($user_id) {
        $home = $this->home_model->get_by_user_id($user_id);
        $location = $this->get_by_user_id($user_id);
        return $location->map_id === $home->map_id;
    }

    public function get_by_user_id($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->from('locations');
        $map = $this->db->get()->first_row();
        if($map) {
            return $map;
        }
        return null;
    }

    public function get_pets_in_map($map_id) {
        $this->db->select('locations.*, race_id, hat_id, username');
        $this->db->where('map_id', $map_id);
        $this->db->where('locations.user_id !=', $this->user->id);
        $this->db->from('locations');
        $this->db->join('pets', 'locations.user_id = pets.user_id', 'left');
        $this->db->join('users', 'locations.user_id= users.id', 'left');
        $pets = $this->db->get()->result();
        return $pets;
    }

    public function set_to_home($user_id) {
        $home = $this->home_model->get_by_user_id($user_id);
        if ($this->set($user_id, $home->map_id)) {
            return $home;
        }
        return null;
    }

    public function set($user_id, $map_id) {
        if ($this->get_by_user_id($user_id)) {
            $this->db->set('map_id', $map_id);
            $this->db->where('user_id', $user_id);
            $this->db->update('locations');
        } else {
            $data = array(
                'map_id' => $map_id,
                'user_id' => $user_id
            );
            $this->db->insert('locations', $data);
        }
        return $this->db->affected_rows();
    }

    public function check_in($user_id) {
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('user_id', $user_id);
        $this->db->update('locations');
        return $this->db->affected_rows();
    }

    public function remove_location($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('locations');
        return $this->db->affected_rows();
    }
}
