<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
	{
		$this->load->view('home');
	}

    public function signup()
    {
        if($this->input->method() == 'post') {
            $this->form_validation->set_rules('username', 'Username', 'required|alpha_dash|is_unique[users.username]|min_length[3]|max_length[20]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|max_length[254]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[254]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password]');

            if ($this->form_validation->run() !== FALSE)
            {
                $data = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                );
                $id = $this->user_model->create($data);
                $this->initialize($id);
                $user = $this->user_model->log_in($data['email'], $this->input->post('password'));
                if($user) {
                    $this->session->set_userdata('id', $user->id);
                    $this->session->set_userdata('user', $user);
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('error', 'Failed to create user account.');
                    redirect('user/signup');
                }
            }
        }
        $this->load->view('users/signup');
    }

    public function login()
    {
        if($this->input->method() == 'post') {
            $this->form_validation->set_rules('email', 'Email', 'required|max_length[254]');
            $this->form_validation->set_rules('password', 'Password', 'required|max_length[254]');

            if ($this->form_validation->run() !== FALSE)
            {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $user = $this->user_model->log_in($email, $password);
                if($user) {
                    $this->session->set_userdata('id', $user->id);
                    $this->session->set_userdata('user', $user);
                    redirect('world');
                } else {
                    $this->session->set_flashdata('error', 'Invalid login.');
                    redirect('user/login');
                }
            }
        }
        $this->load->view('users/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function forgot_password()
    {
        if($this->input->method() == 'post') {
            $this->form_validation->set_rules('email', 'Email', 'required|max_length[254]');

            if ($this->form_validation->run() !== FALSE)
            {
                $email = $this->input->post('email');
                $this->user_model->email_reset_link($email);
                $this->session->set_flashdata('info', 'If there is an account associated with this email, a reset link has been sent.');
                redirect('user/forgot_password');
            }
        }
        $this->load->view('users/forgot_password');
    }

    public function reset_password($token)
    {
        if($this->input->method() == 'post') {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password]');

            if ($this->form_validation->run() !== FALSE)
            {
                $user = $this->user_model->get_by_reset_token($token);
                if($user) {
                    $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                    if($this->user_model->set_password($user->id, $password)) {
                        $this->session->set_flashdata('success', 'Password has been reset. You may now log in.');
                    } else {
                        $this->session->set_flashdata('error', 'Password reset failed.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Reset request has expired or is invalid.');
                }
                redirect('user/login');
            }
        }
        $this->load->view('users/reset_password');
    }

    public function initialize($user_id) 
    {
        $data = array(
            'user_id' => $user_id, 
            'race_id' => 1
        );
        $pet_id = $this->pet_model->create($data);
        $this->user_model->update($user_id, compact('pet_id'));

        $data = array(
            'user_id' => $user_id,
            'land_id' => 12
        );
        $map_id = $this->map_model->create($data);

        $data = array(
            'user_id' => $user_id,
            'map_id' => $map_id
        );
        $this->location_model->create($data);

        $data = array(
            'user_id' => $user_id,
            'map_id' => $map_id
        );
        $this->home_model->create($data);

        $this->currency_model->add_beans($user_id, 70);
    }
}
