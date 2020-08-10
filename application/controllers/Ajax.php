<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
    }

    public function index()
    {
    }

    public function stationsList()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        $data = array();

        $this->load->model('stations_model');
        $result = $this->stations_model->getAllStations();
        

        echo json_encode($result);
    }

    public function addStation()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');
      
        $this->form_validation->set_rules('mountpoint', 'Mountpoint', 'required|alpha_numeric|trim|is_unique[base_stations.mountpoint]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == true) {
            $this->load->model('stations_model');
            
            $data = array(
                'mountpoint' => $this->input->post('mountpoint'),
                'password' => $this->input->post('password'),
                'misc' => $this->input->post('misc')
            );
            
            $response = $this->stations_model->setNewStation($data);
            echo $response;
        } else {
            $error = array(
                'mountpoint' => form_error('mountpoint', '<div class="invalid-feedback">', '</div>'),
                'password' => form_error('password', '<div class="invalid-feedback">', '</div>')
            );
            echo json_encode($error);
        }
    }

    public function getCasters()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('stations_model');
        $casters = $this->stations_model->getAllCasters();
        $mountpoints = $this->stations_model->getAllMountpoint();
        
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

    public function onOffCaster()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('casterid', 'caster id', 'required|integer');
        $this->form_validation->set_rules('status', 'status', 'in_list[true,false]');

        if ($this->form_validation->run() == true) {
            $this->load->model('stations_model');
            
            $response = $this->stations_model->onOffCaster($this->input->post('casterid'), $this->input->post('status'));
            echo $response;
        } else {
            $error = array(
                'casterid' => form_error('casterid', '<div class="invalid-feedback">', '</div>'),
                'status' => form_error('status', '<div class="invalid-feedback">', '</div>')
            );
            echo json_encode($error);
        }
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
            $this->load->model('stations_model');
            
            $response = $this->stations_model->onOffMountpoint($this->input->post('id'), $this->input->post('status'));
            echo $response;
        } else {
            $error = array(
                'id' => form_error('id', '<div class="invalid-feedback">', '</div>'),
                'status' => form_error('status', '<div class="invalid-feedback">', '</div>')
            );
            echo json_encode($error);
        }
    }

    public function addCaster()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('port', 'Port', 'required|less_than[65536]|greater_than[5000]|integer|is_unique[casters.port]');

        if ($this->form_validation->run() == true) {
            $this->load->model('stations_model');
            
            $response = $this->stations_model->addNewCaster($this->input->post('port'));
            echo 'OK';
        } else {
            $error = array(
                'port' => form_error('port', '<div class="invalid-feedback">', '</div>')
            );
            echo json_encode($error);
        }
    }

    public function addMountPoint()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mountpoint', 'Mountpoint', 'required|alpha_numeric|trim|callback_uniqid_mountpoint');
        $this->form_validation->set_rules('authentication', 'Authentication', 'required|in_list[None,Basic]');
        $this->form_validation->set_rules('list', 'List', 'callback_bases_pool');
        $this->form_validation->set_rules('caster_id', 'caster id', 'required|numeric');

        if ($this->form_validation->run() == true) {
            $this->load->model('stations_model');
           
            $list = array();
            foreach (json_decode($this->input->post('list')) as $value) {
                $list[] = (int)$value;
            }

            $data = array(
                'mountpoint' => $this->input->post('mountpoint'),
                'authentication' => $this->input->post('authentication'),
                'caster_id' => $this->input->post('caster_id'),
                'nmea' => $this->input->post('nmea') === 'on',
                'bases_id' => join(',', $list),
            );
            
            $response = $this->stations_model->addMountpoint($data);

            if($response){
                echo 'OK';
            }else {
                var_dump($response);
            }

        } else {
            $error = array(
                'mountpoint' => form_error('mountpoint', '<div class="invalid-feedback">', '</div>'),
                'authentication' => form_error('authentication', '<div class="invalid-feedback">', '</div>'),
                'nmea' => form_error('nmea', '<div class="invalid-feedback">', '</div>'),
                'bases_id' => form_error('list', '<div class="invalid-feedback">', '</div>')
            );
            echo json_encode($error);
        }
    }
    function bases_pool($arr)
    {
        if (empty(json_decode($arr))) {
            $this->form_validation->set_message('bases_pool', 'You need to select one or more source reference stations.');
            return false;
        } else {
            return true;
        }
    }

    function uniqid_mountpoint() {
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
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
