<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('monitor_model');
    }

    public function index()
	{
        if (is_cli()) {
            while(1) {
                $this->monitor_model->expire_users();
                sleep(7);
            }
        }
	}
}
