<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends MY_Controller
{

    public function get()
    {
        $messages = $this->chat_model->get();
        header('Content-Type: application/json');
        echo json_encode($messages);
        return;
    }

    public function send()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|max_length[255]');
        $message = $this->input->post('message');
        $data = array(
            'message' => $message,
            'user_id' => $this->user->id,
            'map_id'  => 6,
        );
        if ($this->form_validation->run() != false) {
            $message_id = $this->chat_model->create($data);
            header('Content-Type: application/json');
            echo json_encode($message_id);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => form_error('message')));
        }
        return;
    }
}
