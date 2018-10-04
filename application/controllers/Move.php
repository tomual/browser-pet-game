<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Move extends Authenticated_Controller
{
    public function _remap($map_id = null)
    {
        if (is_numeric($map_id)) {
            $map = $this->map_model->get($map_id);
            if ($map) {
                $this->location_model->set($this->user->id, $map_id);
                redirect('world');
            } 
        }
        $this->location_model->set_to_home($this->user->id);
        redirect('world');
    }
}
