<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Monitor_model extends CI_Model
{
    public function expire_users()
    {
        
    }

    private function get_inactive() 
    {
        $this->db->select('user_id');
        $this->db->where('updated_at <', date('Y-m-d H:i:s', strtotime("5 seconds ago"));
        $this->db->from('locations');
        return $this->db->get()->result();
    }
}