<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Collection_model extends CI_Model
{
    public function collect($user_id, $type)
    {
        if ($this->available_for_collect($user_id, $type)) {
            $data = [
                'user_id' => $user_id,
                'type' => $type,
            ];
            $this->db->insert('collections', $data);
            return $this->db->insert_id();
        }
        return 0;
    }

    public function available_for_collect($user_id, $type)
    {
        $this->db->select('MAX(collected_at) as collected_at');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', $type);
        $this->db->from('collections');
        $last_bean = $this->db->get()->first_row();
        $now = strtotime('now');
        $allowed_collection_time = strtotime('+1 day', strtotime($last_bean->collected_at));
        if (!$last_bean->collected_at || $allowed_collection_time < $now) {
            return true;
        }
        return false;
    }
}