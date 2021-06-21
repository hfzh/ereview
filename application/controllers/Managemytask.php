<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managemytask extends CI_Controller
{
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
		else if($session_data['id_member'] == 2)
		{
			redirect('manageassignedtask');
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

		$results = $this->master->get_profile_editor($id_user);
		$this->load->view("editor/header");
		$this->load->view("editor/body", array('profile' => $results));
		$this->load->view("editor/footer");
	}

	public function commit_payment()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];
		$results = $this->master->payment($id_user);
		$this->load->view("editor/header");
		$this->load->view("managemytask/commit_payment", array('judul_artikel' => $results));
		$this->load->view("editor/footer");
	}

	public function commiting_payment()
	{
		$id_artikel = $this->input->post('artikel');
		$artikel = $this->master->get_artikel($id_artikel);
		$this->load->view("editor/header");
		$this->load->view("managemytask/commiting_payment", array('artikel' => $artikel));
		$this->load->view("editor/footer");
	}

	public function payed()
	{
		/*
			sts_pembayaran = 0 // Belum dibayar
			sts_pembayaran = 1 // Payment Check on Progress
			sts_pembayaran = 2 // Payment Rejected by Makelar
			sts_pembayaran = 3 // Payment Accepted by Makelar
		*/
		$config['upload_path']			='./buktitransfer';
		$config['allowed_types']		='jpeg|jpg|png|pdf|gif';
		$config['max_size'] = 0000;

		$this->load->library('upload', $config);
		if( ! $this->upload->do_upload('userfile'))
		{
			$this->session->set_flashdata('fail_upload', 'Proof of Payment failed to be uploaded. Upload in .jpg .jpeg .png .pdf .gif format.');
			redirect('managemytask/commit_payment');
			return;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$bukti_pembayaran = $data['upload_data']['file_name'];
			$sts_pembayaran = 1;
			$id_artikel = $this->input->post('id');
			$results = $this->master->payed($sts_pembayaran, $id_artikel, $bukti_pembayaran);
			$this->session->set_flashdata('success_payment', 'Payment successfully uploaded, wait for the makelar to confirm your payment.');
			redirect('managemytask/commit_payment');
		}

	}
	
	public function add_new_task()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user=$session_data['id_user'];
		$results = $this->master->get_list_reviewer($id_user);
		$this->load->view("editor/header");
		$this->load->view("managemytask/add_new_task", array('reviewers' => $results));
		$this->load->view("editor/footer");
	}

	public function adding_new_task()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'trim|min_length[2]|max_length[150]', 'xss|clean');
		$this->form_validation->set_rules('penulis', 'Penulis', 'trim|min_length[2]|max_length[150]', 'xss|clean');
		$this->form_validation->set_rules('katakunci', 'Katakunci', 'trim|min_length[2]|max_length[150]', 'xss|clean');
		$this->form_validation->set_rules('bidangilmu', 'Bidangilmu', 'trim|min_length[2]|max_length[50]', 'xss|clean');
		$this->form_validation->set_rules('jumlahkata', 'Jumlahkata');

		$check = $this->form_validation->run();
		if($check == FALSE)
		{
			redirect('managemytask/add_new_task');
			return FALSE;
		}
		
		$config['upload_path']		= './artikel';
		$config['allowed_types']	= 'pdf';
		$config['max_size'] = 50000;
		$this->load->library('upload', $config);
		if( ! $this->upload->do_upload('userfile'))
		{
			$this->session->set_flashdata('fail_upload', 'You should upload your article in .pdf format');
			redirect('managemytask/add_new_task');
			return;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$artikel = $data['upload_data']['file_name'];
			$session_data = $this->session->userdata('logged_in');
			$id_user = $session_data['id_user'];
			$this->master->add_task($id_user, $artikel);
			$results = $this->master->get_list_reviewer($id_user);

			$this->session->set_flashdata('success_add', 'Your task has been successfully added');
			redirect('managemytask/add_new_task');
		}
	}

	public function confirm_task_completion($sort="")
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];

		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'index.php/managemytask/view_task/' . $sort . '/';

		$config['total_rows'] = $this->master->count_task_confirm($id_user);
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$page_link = $this->pagination->create_links();

		$results = $this->master->get_task_confirm($config['per_page'], $page, $sort, $id_user);

		$this->load->view("editor/header");
		$this->load->view("managemytask/confirm_task_completion", array('task' => $results, 'page_link'=>$page_link, 'sort'=> $sort));
		$this->load->view("editor/footer");
	}

	public function confirming_task_completion($id_artikel ="", $sts_progress = "", $harga="", $balance="", $id_reviewer="") 
	{
		$this->master->add_progress_confirmation($id_artikel, $sts_progress, $harga, $balance, $id_reviewer);
		$this->master->mark_task_done($id_artikel);
		$this->session->set_flashdata('accept_completion', 'Task has been successfully accepted for completion');
		redirect('managemytask/confirm_task_completion');
	}

	public function view_task($sts_artikel=-1, $sort="")
	{	
		/*
			sts_progress = 0 // Belum di Accept / Reject
			sts_progress = 1 // di Reject
			sts_progress = 2 // di Accept dan On Progress
			sts_progress = 3 // Task Telah di Confirm oleh Makelar
			sts_progress = 4 // Task telah di confirm oleh editor
		*/
		
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];
		
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'index.php/managemytask/view_task/' . $sts_artikel . '/' . $sort . '/';
		
		$config['total_rows'] = $this->master->count_task($id_user, $sts_artikel);
		$config['per_page'] = 5;
		$config['uri_segment'] = 5;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$page_link = $this->pagination->create_links();
		
		$artikel = $this->master->get_task($config['per_page'], $page, $sts_artikel, $sort, $id_user);

		$this->load->view("editor/header");
		$this->load->view("managemytask/view_task", array('artikel'=>$artikel, 'page_link'=>$page_link, 'sts_artikel' => $sts_artikel, 'sort' => $sort));
		$this->load->view("editor/footer");
	}

	public function artikel($id_artikel)
	{
		$this->load->helper('download');
		$results = $this->master->get_file_artikel($id_artikel);
		$file_path = 'artikel/' . $results[0]['artikel'];
		force_download($file_path, NULL);
	}

	public function view_list_reviewer($sort = "")
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data['id_user'];

		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'index.php/managemytask/view_list_reviewer/' . $sort . '/';
		
		$config['total_rows'] = $this->master->count_list_reviewers($id_user);
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$page_link = $this->pagination->create_links();

		$results = $this->master->get_list_reviewers($config['per_page'], $page, $sort, $id_user);

		$this->load->view('editor/header');
		$this->load->view('managemytask/view_list_reviewer', array('reviewer' => $results, 'page_link'=>$page_link, 'sort'=> $sort));
		$this->load->view('editor/footer');
	}
}
?>