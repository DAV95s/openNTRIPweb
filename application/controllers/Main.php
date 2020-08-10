<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
          redirect('auth/login', 'refresh');
        } else {
					redirect('map', 'refresh');
        }
    }
}
