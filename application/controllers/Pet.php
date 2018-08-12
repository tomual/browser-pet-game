<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pet extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('collection_model');
    }
	public function equip($hat_id)
	{
		$equipped = $this->pet_model->equip($hat_id);

		if($equipped) {
			echo 1;
			return;
		}
		echo 0;
		return;
	}
	public function unequip()
	{
		$unequipped = $this->pet_model->equip(null);

		if($unequipped) {
			echo 1;
			return;
		}
		echo 0;
		return;
	}
}