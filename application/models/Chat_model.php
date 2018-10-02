<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {

    public function create($data) {
        $this->db->insert('chat', $data);
        return $this->db->insert_id();
    }

    public function get_recent_by_map_id($map_id) {
        $five_minutes_ago = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $this->db->select('chat.*, username');
        $this->db->where('map_id', $map_id);
        $this->db->where('chat.created_at >', $five_minutes_ago );
        $this->db->from('chat');
        $this->db->join('users', 'chat.user_id = users.id', 'left');
        $chat = $this->db->get()->result();
        return $chat;
    }
}
