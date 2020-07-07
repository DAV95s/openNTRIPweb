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
        $data = array();

        $this->load->model('stations_model');
        $result = $this->stations_model->getAllStations();
        
        foreach ($result as $station) {
            $data['stations'][] = array(
                'id' => $station['id'],
                'mountpoint' => $station['mountpoint'],
                'identifier' => $station['identifier'],
                'format' => $station['format'],
                'format_details' => $station['format-details'],
                'carrier' => $station['carrier'] == 1,
                'nav_system' => $station['nav-system'],
                'country' => $station['country'],
                'lla' => $station['lla'],
                'altitude' => $station['altitude'],
                'bitrate' => $station['bitrate'],
                'misc' => $station['misc'],
                'is_online' => $station['is_online'] == 1,
                'password' => $station['password'],
                'hz' => $station['hz']
            );
        }
        $this->load->view('ajax/stationslist', $data);
    }
        
    public function stationModal($id)
    {
        $this->load->model('stations_model');
        $result = $this->stations_model->getStationByName($id);
        $data['station'] = $result;
        $this->load->view('ajax/stationmodal', $data);
    }

    public function addStations()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('type_station', 'Type station', 'required');
        $this->form_validation->set_rules('mountpoint', 'Mountpoint', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            $this->load->model('stations_model');
            
            $data = array(
                'mountpoint' => $this->input->post('mountpoint'),
                'nmea' => $this->input->post('nmea'),
                'authentication' => $this->input->post('authentication'),
                'misc' => $this->input->post('misc')
            );
            
            $response = $this->stations_model->setNewStation($data);
            var_dump($response);
        } else {
            $error = array(
                'type_station' => form_error('type_station'),
                'mountpoint' => form_error('mountpoint'),
                'password' => form_error('password')
            );
            echo json_encode($error);
        }
    }
}
