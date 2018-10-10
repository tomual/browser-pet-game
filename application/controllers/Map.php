<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Map extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('collection_model');
    }
    public function search()
    {
        $keyword = $this->input->post('keyword');
		$results = $this->map_model->search_by_username($keyword);
        header('Content-Type: application/json');
        echo json_encode($results);
    }
    public function equip($item_id)
    {
        $item = $this->item_model->get($item_id);
        $location = $this->location_model->get_by_user_id($this->user->id);
        $map_id = $location->map_id;

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
        $location = $this->location_model->get_by_user_id($this->user->id);
        $pets = $this->location_model->get_pets_in_map($location->id);
        header('Content-Type: application/json');
        echo json_encode($pets);
    }
}
