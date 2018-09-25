<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class World extends Authenticated_Controller {
	public function index()
	{
		$pet = $this->pet_model->get($this->user->pet_id);
		$location = $this->location_model->get_by_user_id($this->user->id);
		$map = $this->map_model->get($location->map_id);
		$chat = $this->chat_model->get_recent_by_map_id($map->id);
		$this->load->view('world/world', compact('pet', 'map', 'chat'));
	}
}