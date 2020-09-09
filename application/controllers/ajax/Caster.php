<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Caster extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
    }

    public function getAllCasters()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('caster_model');
        $this->load->model('mountpoint_model');
        $casters = $this->caster_model->getAll();
        $mountpoints = $this->mountpoint_model->getAll();
        
        $response = array();

        foreach ($casters as $caster) {
            $temp = $caster;
            $temp['status'] = $temp['status'] === 'true';
            $temp['mountpoints'] = array();
            
            foreach ($mountpoints as $mountpoint) {
                if ($mountpoint['caster_id'] === $caster['id']) {
                    $mountpoint['available'] = $mountpoint['available'] === 'true';
                    $temp['mountpoints'][] = $mountpoint;
                }
            }
            $response[] = $temp;
        }

        echo json_encode($response);
    }

    public function addCaster()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('port', 'Port', 'required|less_than[65536]|greater_than[5000]|integer|is_unique[casters.port]');

        if ($this->form_validation->run() == true) {
            $this->load->model('caster_model');
            
            echo $this->caster_model->add($this->input->post('port'));
        } else {
            $error = array(
                'port' => form_error('port', '<div class="invalid-feedback">', '</div>')
            );
            echo json_encode($error);
        }
    }

    public function removeCaster(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'Id', 'required|integer|trim');
      
        if ($this->form_validation->run() == true) {
            $this->load->model('caster_model');
            echo $this->caster_model->remove($this->input->post('id'));
        } else {
            echo $response;
        }
    }

    public function onOffCaster()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('casterid', 'caster id', 'required|integer');
        $this->form_validation->set_rules('status', 'status', 'in_list[true,false]');

        if ($this->form_validation->run() == true) {
            $this->load->model('caster_model');
            
            echo $this->caster_model->switcher($this->input->post('casterid'), $this->input->post('status'));
        } else {
            $error = array(
                'casterid' => form_error('casterid', '<div class="invalid-feedback">', '</div>'),
                'status' => form_error('status', '<div class="invalid-feedback">', '</div>')
            );
            echo json_encode($error);
        }
    }
}
