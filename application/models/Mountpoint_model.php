<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mountpoint_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add($arr)
    {
        return $this->db->insert('mountpoints', $arr);
    }

    public function delete($id)
    {
        $arr = array('id' => (int)$id);
        return $this->db->delete('mountpoints', $arr);
    }

    public function getAll()
    {
        $query = $this->db->query("SELECT `id`, `mountpoint`, `identifier`, `format`, `format-details`, `carrier`, `nav-system`, `network`, `country`, `latitude`, `longitude`, IF(`nmea`, 'true', 'false') as 'nmea', IF(`solution`, 'true', 'false') as 'solution', `generator`, `compression`, `authentication`, `fee`, `bitrate`, `misc`, `caster_id`, `stations_id`, IF(`available`, 'true', 'false') as 'available', `plugin_id` FROM ntrip.mountpoints;");

        return $query->result_array();
    }

    public function onOffMountpoint($id, $boolean)
    {
        $data = array(
            'available' => $boolean === 'true' ? 1 : 0
        );
        $this->db->where('id', $id);
        $this->db->update('mountpoints', $data);
    }
}
