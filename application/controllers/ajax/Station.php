<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Station extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->database();
      $this->load->library(['ion_auth', 'form_validation']);
  }

  public function getAllStations()
  {
      if (!$this->ion_auth->logged_in()) {
          redirect('auth/login', 'refresh');
      }

      $this->load->model('station_model');
      
      echo json_encode($this->station_model->getAll());
  }

  public function addStation()
  {
      if (!$this->ion_auth->logged_in()) {
          redirect('auth/login', 'refresh');
      }

      $this->load->library('form_validation');
    
      $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric|trim|is_unique[reference_stations.name]');
      $this->form_validation->set_rules('password', 'Password', 'required|trim');

      if ($this->form_validation->run() == true) {
          $this->load->model('station_model');
          
          $data = array(
              'name' => $this->input->post('name'),
              'password' => $this->input->post('password'),
              'misc' => $this->input->post('misc')
          );
          
          echo $this->station_model->add($data);
      } else {
          $error = array(
              'name' => form_error('name', '<div class="invalid-feedback">', '</div>'),
              'password' => form_error('password', '<div class="invalid-feedback">', '</div>')
          );
          echo json_encode($error);
      }
  }

  public function removeStation()
  {
      if (!$this->ion_auth->logged_in()) {
          redirect('auth/login', 'refresh');
      }

      $this->load->model('station_model');
      $this->load->library('form_validation');
    
      $this->form_validation->set_rules('id', 'Id', 'required|numeric|trim');
      
      if ($this->form_validation->run() == true) {
          echo $this->station_model->remove($this->input->post('id'));
      }
  }
}