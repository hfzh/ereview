<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managealltask extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library(array('form_validation'));
		$this->load->model('master');
		$session_data = $this->session->userdata('logged_in');
		if( ! ($this->session->userdata('logged_in')))
		{
			$this->session->set_flashdata('not_logged_in', 'Please login to continue');
			redirect('welcome/login');
		}
		else if($session_data['id_member'] == 1)
		{
			redirect('managemytask');
		}
		else if($session_data['id_member'] == 2)
		{
			redirect('manageassignedtask');
		}
	}

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];

		$results = $this->master->get_profile_makelar($id_user);
		$this->load->view("makelar/header");
		$this->load->view("makelar/body", array('profile' => $results));
		$this->load->view("makelar/footer");
	}
	
	public function monitor_tasks($sts_artikel='-1', $sort="")
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'index.php/managealltask/monitor_tasks/' . $sts_artikel . '/' . $sort . '/';

		$config['total_rows'] = $this->master->count_all_tasks($sts_artikel);
		$config['per_page'] = 5;
		$config['uri_segment'] = 5;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$page_link = $this->pagination->create_links();
		$results = $this->master->get_all_tasks($config['per_page'], $page, $sts_artikel, $sort);

		$this->load->view("makelar/header");
		$this->load->view("managealltask/monitor_tasks", array('task' => $results, 'page_link'=>$page_link, 'sts_artikel'=>$sts_artikel, 'sort' => $sort));
		$this->load->view("makelar/footer");
	}

	public function confirming_task_completion($id_artikel ="", $sts_progress = "", $harga="", $balance="", $id_reviewer="") 
	{
		$this->master->add_progress_confirmation($id_artikel, $sts_progress, $harga, $balance, $id_reviewer);
		$this->master->mark_task_done($id_artikel);
		$this->session->set_flashdata('accept_completion', 'Task has been successfully accepted for completion');
		redirect('managealltask/monitor_tasks');
	}
	
	public function monitor_payments($sort="")
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'index.php/managealltask/monitor_payments/' . $sort . '/';
		$config['total_rows'] = $this->master->count_all_payments();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$page_link = $this->pagination->create_links();
		$results = $this->master->get_all_payments($config['per_page'], $page, $sort);

		$this->load->view("makelar/header");
		$this->load->view("managealltask/monitor_payments", array('task' => $results, 'page_link'=> $page_link, 'sort'=>$sort));
		$this->load->view("makelar/footer");
	}



	public function monitoring_payment($id_artikel = "", $sts_pembayaran = "")
	{

		$this->master->add_sts_payment($id_artikel, $sts_pembayaran);
		if($sts_pembayaran == 2)
		{
			$this->session->set_flashdata('reject_payment', 'Payment has been successfully rejected');
		}
		else if ($sts_pembayaran == 3)
		{
			$this->session->set_flashdata('accept_payment', 'Payment has been successfully accepted');
		}
		redirect('managealltask/monitor_payments');
	}

	public function bukti_pembayaran($id_artikel)
	{
		$this->load->helper('download');
		$results = $this->master->get_bukti_transfer($id_artikel);
		$file_path = 'buktitransfer/' . $results[0]['bukti_pembayaran'];
		force_download($file_path, NULL);
	}

	public function artikel($id_artikel)
	{
		$this->load->helper('download');
		$results = $this->master->get_file_artikel($id_artikel);
		$file_path = 'artikel/' . $results[0]['artikel'];
		force_download($file_path, NULL);
	}

    public function dump_tasks($sort="")
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'index.php/managealltask/dump_tasks/' . $sort . '/';
		$config['total_rows'] = $this->master->count_all_payments();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$page_link = $this->pagination->create_links();

		$results = $this->master->get_tasks_done($config['per_page'], $page, $sort);
		$this->load->view("makelar/header");
		$this->load->view("managealltask/dump_tasks", array('tasks' => $results, 'page_link'=>$page_link, 'sort'=>$sort));
		$this->load->view("makelar/footer");
	}

	public function dumping_task($id_artikel = "")
	{
		$this->master->dump_task($id_artikel);
		$this->session->set_flashdata('dump_task', 'Task has been successfully marked as inactive (0)');
		redirect('managealltask/dump_tasks');
	}

    public function dump_editors($sort="")
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'index.php/managealltask/dump_editors/' . $sort . '/';
		$config['total_rows'] = $this->master->count_editors();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$page_link = $this->pagination->create_links();

		$results = $this->master->get_editors($config['per_page'], $page, $sort);
		$this->load->view("makelar/header");
		$this->load->view("managealltask/dump_editors", array('editors'=>$results, 'page_link'=>$page_link, 'sort'=>$sort));
		$this->load->view("makelar/footer");
	}
	
	public function dumping_editor($id_user = "")
	{
		$this->master->dump_editor($id_user);
		$this->session->set_flashdata('dump_editor', 'Editor has been successfully removed');
		redirect('managealltask/dump_editors');
	}

	public function dump_reviewers($sort="")
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'index.php/managealltask/dump_reviwers/' . $sort . '/';
		$config['total_rows'] = $this->master->count_reviewers();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$page_link = $this->pagination->create_links();
		$results = $this->master->get_reviewers($config['per_page'], $page, $sort);

		$this->load->view("makelar/header");
		$this->load->view("managealltask/dump_reviewers", array('reviewers'=>$results, 'page_link'=>$page_link, 'sort' => $sort));
		$this->load->view("makelar/footer");
	}

	public function dumping_reviewer($id_user = "")
	{
		$results = $this->master->dump_reviewer($id_user);
		$this->session->set_flashdata('dump_reviewer', 'Reviewer has been successfully removed');
		redirect('managealltask/dump_reviewers');
	}
}