<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mountpoint extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
    }

    public function onOffMountpoint()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'id', 'required|integer');
        $this->form_validation->set_rules('status', 'status', 'in_list[true,false]');

        if ($this->form_validation->run() == true) {
            $this->load->model('mountpoint_model');
            
            echo $this->mountpoint_model->onOffMountpoint($this->input->post('id'), $this->input->post('status'));
        } else {
            echo $error;
        }
    }

    public function addMountpoint()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mountpoint', 'Mountpoint', 'required|alpha_numeric|trim|callback_uniqid_mountpoint');
        $this->form_validation->set_rules('authentication', 'Authentication', 'required|in_list[None,Basic]');
        $this->form_validation->set_rules('stations_id', 'Stations id', 'callback_isnot_empty');
        $this->form_validation->set_rules('caster_id', 'caster id', 'required|numeric');

        if ($this->form_validation->run() == true) {
            $this->load->model('mountpoint_model');
           
            $stationlist = json_decode($this->input->post('stations_id'));
           
            if(is_array($stationlist)){
              $stationlist = join(',', $stationlist);
            }else {
              $stationlist = (int)$stationlist;
            }

            $data = array(
                'mountpoint' => $this->input->post('mountpoint'),
                'authentication' => $this->input->post('authentication'),
                'caster_id' => $this->input->post('caster_id'),
                'nmea' => $this->input->post('nmea') === 'on',
                'stations_id' => $stationlist,
            );
            echo $this->mountpoint_model->add($data);
        } else {
            $error = array(
                'mountpoint' => form_error('mountpoint', '<div class="invalid-feedback">', '</div>'),
                'authentication' => form_error('authentication', '<div class="invalid-feedback">', '</div>'),
                'nmea' => form_error('nmea', '<div class="invalid-feedback">', '</div>'),
                'stations_id' => form_error('list', '<div class="invalid-feedback">', '</div>')
            );
            echo json_encode($error);
        }
    }

    public function removeMountpoint()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'id', 'required|integer');

        if ($this->form_validation->run() == true) {
            $this->load->model('mountpoint_model');
            
            echo $this->mountpoint_model->delete($this->input->post('id'));
        } else {
            echo $error;
        }
    }

    public function isnot_empty($arr)
    {
        if (empty(json_decode($arr))) {
            $this->form_validation->set_message('stations_id', 'You need to select one or more source reference stations.');
            return false;
        } else {
            return true;
        }
    }

    public function uniqid_mountpoint()
    {
        $mountpoint = $this->input->post('mountpoint');
        $caster_id = $this->input->post('caster_id');
        $this->db->select('id');
        $this->db->from('mountpoints');
        $this->db->where('mountpoint', $mountpoint);
        $this->db->where('caster_id', $caster_id);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            $this->form_validation->set_message('uniqid_mountpoint', 'Mountpoint is must be unique.');
            return false;
        } else {
            return true;
        }
    }
}
