<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageassignedtask extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library(array('form_validation'));
		$this->load->model('master');
		$session_data = $this->session->userdata('logged_in');
		if(!($this->session->userdata('logged_in')))
		{
			$this->session->set_flashdata('not_logged_in', 'Please login to continue');
			redirect('welcome/login');
		}
		else if($session_data['id_member'] == 1)
		{
			redirect('managemytask');
		}
		else if($session_data['id_member'] == 3)
		{
			redirect('managealltask');
		}
	}
	
	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];
		$results = $this->master->get_profile_reviewer($id_user);
		$this->load->view('reviewer/header');
		$this->load->view('reviewer/body', array('profile' => $results));
		$this->load->view('reviewer/footer');
	}
		
	public function confirm_task()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];
		$task = $this->master->get_reviewer_task($id_user);
		$this->load->view("reviewer/header");
		$this->load->view("manageassignedtask/confirm_task", array('task' => $task));
		$this->load->view("reviewer/footer");
	}

	public function confirming_task($id_artikel= "", $sts_progress= "")
	{	
		$this->master->add_progress_status($id_artikel, $sts_progress);
		if($sts_progress==1)
		{
			$this->master->mark_task_done($id_artikel);
			$this->session->set_flashdata('reject_task', 'Task has been successfully rejected');
		}
		else if($sts_progress==2)
		{
			$this->session->set_flashdata('accept_task', 'Task has been successfully accepted');
		}
		redirect('manageassignedtask/confirm_task');
	}
	
	public function artikel($id_artikel)
	{
		$this->load->helper('download');
		$results = $this->master->get_file_artikel($id_artikel);
		$file_path = 'artikel/' . $results[0]['artikel'];
		force_download($file_path, NULL);
	}
    
    public function submit_review()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];
		$results = $this->master->get_artikel_reviewer($id_user);
	
		$this->load->view("reviewer/header");
		$this->load->view("manageassignedtask/submit_review", array('artikel'=>$results));
		$this->load->view("reviewer/footer");
	}

    public function submitting_review()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];
		$results = $this->master->get_artikel_reviewer($id_user);

		$config['upload_path']		= './artikel';
		$config['allowed_types']	= 'pdf';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('userfile'))
		{
			$this->session->set_flashdata('fail_upload', 'You should upload your file in .pdf format');
			redirect('manageassignedtask/submit_review');
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$artikel = $data['upload_data']['file_name'];
			$this->master->add_review($artikel);
			$this->session->set_flashdata('success_submit', 'Submit success!');
			redirect('manageassignedtask/submit_review');
		}
	}
	public function withdraw_funds()
    {
        $session_data = $this->session->userdata('logged_in');
        $id_user = $session_data['id_user'];
        $results = $this->master->get_reviewer_balance($id_user);
        $this->load->view("reviewer/header");
        $this->load->view("manageassignedtask/withdraw_funds", array('reviewer' => $results));
        $this->load->view("reviewer/footer");
    }

    public function withdrawing_funds()
    {
        $session_data = $this->session->userdata('logged_in');
        $id_user = $session_data['id_user'];
        $reviewer = $this->master->get_reviewer_balance($id_user);
        $balance = $reviewer[0]['balance'];
        $withdraw = $this->input->post('withdraw');
        if($withdraw>$balance)
        {
            $this->session->set_flashdata('fail_max_withdraw', 'The amount of balance you want to withdraw exceeded your amount of balance');
            redirect('manageassignedtask/withdraw_funds');
        }
        else if ($withdraw<10000)
        {
            $this->session->set_flashdata('fail_min_withdraw', 'Minimum amount to withdraw is Rp10000');
            redirect('manageassignedtask/withdraw_funds');
        }
        else
        {
            $this->master->get_funds($id_user, $balance, $withdraw);

            $this->session->set_flashdata('success_withdraw', 'Your balance have been successfully withdrawed');
            redirect('manageassignedtask/withdraw_funds');
        }
    }
	
	public function edit_additional()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];
		$results = $this->master->get_profile_reviewer($id_user);
		$this->load->view('reviewer/header');
		$this->load->view('manageassignedtask/edit_additional', array('profile'=> $results));
		$this->load->view('reviewer/footer');
	}

	public function editing_additional()
	{
		$id_user = $this->session->userdata('logged_in');
		$this->master->edit_additional($id_user);
		$this->session->set_flashdata('success_edit', 'Successfully editing additional data');
		redirect('manageassignedtask');
	}

	public function mark_task_done($id_artikel = "")
	{
		$this->master->mark_task_done($id_artikel);
		$this->session->set_flashdata('mark_task_done', 'Task successfully marked as done.');
		redirect('manageassignedtask/confirm_task');
	}
}