<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Toybox extends Authenticated_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('inventory_model');
    }
    
	public function get()
	{
		$result = $this->inventory_model->get($this->user->id);

        $toybox = array(
            'hats' => array(),
            'trees' => array(),
            'beds' => array()
        );
        $toybox['hats'] = array_filter($result, function($thing) {
            return $thing->type == 'h';
        }, ARRAY_FILTER_USE_BOTH);
        $toybox['trees'] = array_filter($result, function($thing) {
            return $thing->type == 't';
        }, ARRAY_FILTER_USE_BOTH);
        $toybox['beds'] = array_filter($result, function($thing) {
            return $thing->type == 'b';
        }, ARRAY_FILTER_USE_BOTH);
        $toybox['land'] = array_filter($result, function($thing) {
            return $thing->type == 'l';
        }, ARRAY_FILTER_USE_BOTH);
        $toybox = array_map('array_values', $toybox);

		header('Content-Type: application/json');
		echo json_encode($toybox);
		return;
	}
}