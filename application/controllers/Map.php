<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Map extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('collection_model');
        $this->load->model('inventory_model');
    }
    public function search()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('keyword', 'Keyword', 'required|alpha_dash|min_length[3]|max_length[20]');
        
        if ($this->form_validation->run() !== FALSE)
        {
            $keyword = $this->input->post('keyword');
            $results = $this->map_model->search_by_username($keyword);
        } else {
            $results = array('error' => 'Invalid keyword');
        }
        header('Content-Type: application/json');
        echo json_encode($results);
    }
    public function equip($item_id)
    {
        $is_home = $this->location_model->is_home($this->user->id);
        $has_item = $this->inventory_model->has_item($this->user->id, $item_id);
        if ($is_home && $has_item) {
            $item = $this->item_model->get($item_id);
            $home = $this->home_model->get_by_user_id($this->user->id);
            $map_id = $home->map_id;

            if ($item && $map_id) {
                $equipped = null;
                switch ($item->type) {
                    case 't':
                        $equipped = $this->map_model->set_tree($map_id, $item_id);
                        break;
                    case 'b':
                        $equipped = $this->map_model->set_bed($map_id, $item_id);
                        break;
                    case 'l':
                        $equipped = $this->map_model->set_land($map_id, $item_id);
                        break;
                }

                if ($equipped) {
                    echo 1;
                    return;
                }
            }
        }
        echo 0;
        return;
    }
    public function unequip($type)
    {
        $location = $this->location_model->get_by_user_id($this->user->id);
        $map_id = $location->map_id;

        if ($map_id) {
            $unequipped = null;
            switch ($type) {
                case 't':
                    $unequipped = $this->map_model->set_tree($map_id, null);
                    break;
                case 'b':
                    $unequipped = $this->map_model->set_bed($map_id, null);
                    break;
                case 'l':
                    $unequipped = $this->map_model->set_land($map_id, null);
                    break;
            }

            if ($unequipped) {
                echo 1;
                return;
            }
        }
        echo 0;
        return;
    }

    public function info()
    {
        $this->location_model->check_in($this->user->id);
        $location = $this->location_model->get_by_user_id($this->user->id);
        $pets = $this->location_model->get_pets_in_map($location->map_id);
        header('Content-Type: application/json');
        echo json_encode($pets);
    }
}
