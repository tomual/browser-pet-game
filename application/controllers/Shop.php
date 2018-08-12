<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shop extends Authenticated_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shop_model');
    }
	public function get()
	{
		$shop = $this->shop_model->get_all();
		header('Content-Type: application/json');
		echo json_encode($shop);
		return;
	}
	public function buy($product_id)
	{
		$response = array();
		if ($this->shop_model->get_by_item_id($product_id)) {
			$buy = $this->shop_model->buy($this->user->id, $product_id);
			if ($buy) {
				$response = ['type' => 'success'];
			} else {
				$response = ['type' => 'error', 'message' => 'Not enough beans.'];
			}
		} else {
			$response = ['type' => 'error', 'message' => 'Product does not exist.'];
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		return;
	}
}