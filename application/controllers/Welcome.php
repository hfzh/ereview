<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library(array('form_validation'));
	}

	public function index()
	{
		$this->load->view("landing/header");
		$this->load->view("landing/home");
		$this->load->view("landing/footer");
	}

	public function sign_up()
	{
		$this->load->view("signup/header");
		$this->load->view("signup/body");
		$this->load->view("signup/footer");
		return;
	}

	public function signing_up()
	{
		$this->load->model('account');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|min_length[2]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|min_length[2]|max_length[50]|is_unique[users.username]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[2]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[100]|is_unique[users.email]|xss_clean',);

		$res = $this->form_validation->run();
		if($res == FALSE)
		{
			$this->session->set_flashdata('fail_signup', 'Username or email have already been taken');
			redirect('welcome/sign_up');
			return FALSE;
		}

		$config['upload_path']			= './photos/';
		$config['allowed_types']		= 'gif|jpg|jpeg|png';
		
		$this->load->library('upload', $config);
		if( ! $this->upload->do_upload('userfile'))
		{
			$this->session->set_flashdata('fail_photo', 'Please insert the right photo!');
			redirect('welcome/sign_up');
			return;
		}
		
		$data = array('upload_data' => $this->upload->data());
		$file_name = $data['upload_data']['file_name'];
		$id_user = $this->account->insert_new_user($file_name);

		$this->session->set_flashdata('success_signup', 'Signup Success, Please Login to Continue!');
		redirect('welcome/login');
	}
	
	public function login()
	{
		if( ! $this->session->userdata('logged_in'))
		{
			$this->load->view("login/header");
			$this->load->view("login/body");
			$this->load->view("login/footer");
		}
		else
		{
			$session_data = $this->session->userdata('logged_in');
			switch($session_data['id_member'])
			{
				case 1:
					redirect ('managemytask');
					break;
				case 2:
					redirect ('manageassignedtask');
					break;
				case 3:
					redirect ('managealltask');
					break;
			}
		}
	}
	public function checking_login()
	{
		$this->load->model('account');

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$roles = $this->input->post('roles');
		$users = $this->account->get_users($username, $password, $roles);
	
		if(sizeof($users)<=0)
		{
			$this->session->set_flashdata('fail_login', 'Username, password, or roles is incorrect');
			redirect('welcome/login');
			return FALSE;
		}
		else
		{
			$sess_array=array(
				'id_user' 		=> $users[0]['id_user'],
				'nama' 			=> $users[0]['nama'],
				'username' 		=> $users[0]['username'],
				'id_member' 	=> $users[0]['id_grup']
			);
			$this->session->set_userdata('logged_in', $sess_array);
			switch($sess_array['id_member']){
				case 1:
					redirect ('managemytask');
					break;
				case 2:
					redirect ('manageassignedtask');
					break;
				case 3:
					redirect ('managealltask');
					break;
			}
		}
	}
	public function logout()
	{
		if( ! $this->session->userdata('logged_in'))
		{
			redirect ('welcome/login');
		}
		$session_data = $this->session->userdata('logged_in');
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('welcome/login');
	}
} ?>