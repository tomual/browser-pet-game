<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller {

	public function get()
	{
		$messages = $this->chat_model->get();
		header('Content-Type: application/json');
		echo json_encode($messages);
		return;
	}

	public function send()
	{
		$message = $this->input->post('message');
		$data = array(
			'message' => $message,
			'user_id' => $this->user->id,
			'map_id' => 6
		);
		$message_id = $this->chat_model->create($data);
		
		header('Content-Type: application/json');
		echo json_encode($message_id);
		return;
	}
}
