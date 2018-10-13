<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Collect extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('collection_model');
	}
	
	public function bean()
	{
		if ($this->location_model->is_home($this->user->id)) {
			$collected = $this->collection_model->collect($this->user->id, 'bean');
			if($collected) {
				$this->currency_model->add_beans($this->user->id, 12);
				echo 1;
				return;
			}
		}
		echo 0;
		return;
	}

	public function check($type)
	{
		echo $this->collection_model->available_for_collect($this->user->id, $type) ? 1 : 0;
	}
}