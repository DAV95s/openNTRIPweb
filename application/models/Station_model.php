<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Station_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll()
    {
        $query = $this->db->query("SELECT `id`, `name`, `identifier`, `format`, REPLACE(`format-details`,',',' ') as 'format-details', carrier, `nav-system`, `country`, ST_X(lla) as lat, ST_Y(lla) as lon, `altitude`, `bitrate`, `misc`, IF(`is_online`, 'true', 'false') as is_online, `password`, `hz` FROM reference_stations");
        $result = $query->result_array();

        return $result;
    }

    public function getById($id)
    {
        $query = $this->db->query("SELECT `id`, `name`, `identifier`, `format`, `format-details`, carrier, `nav-system`, `country`, ST_AsText(lla) as lla, `altitude`, `bitrate`, `misc`, `is_online`, `password`, `hz` FROM reference_stations WHERE `id` =".(int)$id. ";");

        return $query->row();
    }

    public function remove($id)
    {
        return $this->db->query("DELETE FROM reference_stations WHERE id = ". (int)$id .";");
    }

    public function getAllPosition()
    {
        $query = $this->db->query("SELECT mountpoint, ST_AsText(lla) as lla FROM reference_stations");
        $result = $query->result_array();

        return $result;
    }

    public function add($arr)
    {
        return $this->db->insert('reference_stations', $arr);
    }
}
