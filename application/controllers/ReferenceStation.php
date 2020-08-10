<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReferenceStation extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		$user = $this->ion_auth->user()->row();
		$data_aside['login'] = $user->first_name;
		
		$this->load->view('common/aside', $data_aside);
		$this->load->view('referencestation');
		$this->load->view('common/footer');
	}
}
