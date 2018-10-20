<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Monitor_model extends CI_Model
{
    public function expire_users()
    {
        $users = $this->get_inactive();
        foreach ($users as $user) {
            $affected = $this->location_model->remove_location($user->user_id);
            if ($affected) {
                printf("%7s %10d\n", 'SUCCESS', $user->user_id);
            } else {
                printf("%7s %10d\n", 'FAIL', $user->user_id);
            }
        }
    }

    private function get_inactive() 
    {
        $this->db->select('user_id');
        $this->db->where('updated_at <', date('Y-m-d H:i:s', strtotime("5 seconds ago")));
        $this->db->from('locations');
        return $this->db->get()->result();
    }
}