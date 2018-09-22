<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {

    public function create($data) {
        $this->db->insert('chat', $data);
        return $this->db->insert_id();
    }

    public function get($map_id) {
        $this->db->where('map_id', $map_id);
        $this->db->from('chat');
        $chat = $this->db->get()->result();
        return $chat;
    }
}
