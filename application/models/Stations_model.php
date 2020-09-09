<?php

defined('BASEPATH') or exit('No direct script access allowed');

// class Stations_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllStations()
    {
        $query = $this->db->query("SELECT `id`, `name`, `identifier`, `format`, REPLACE(`format-details`,',',' ') as 'format-details', carrier, `nav-system`, `country`, ST_X(lla) as lat, ST_Y(lla) as lon, `altitude`, `bitrate`, `misc`, IF(`is_online`, 'true', 'false') as is_online, `password`, `hz` FROM reference_stations");
        $result = $query->result_array();

        return $result;
    }

    public function getStationByName($id)
    {
        $query = $this->db->query("SELECT `id`, `name`, `identifier`, `format`, `format-details`, carrier, `nav-system`, `country`, ST_AsText(lla) as lla, `altitude`, `bitrate`, `misc`, `is_online`, `password`, `hz` FROM reference_stations WHERE `id` =".(int)$id);

        return $query->row();
    }

    public function removeStation($id)
    {
        $query = $this->db->query("DELETE FROM reference_stations WHERE id = ". (int)$id .";");
        return $query;
    }

    public function getStationsPosition()
    {
        $query = $this->db->query("SELECT `name`, ST_AsText(lla) as lla FROM reference_stations");
        $result = $query->result_array();

        return $result;
    }

    public function setNewStation($arr)
    {
        return $this->db->insert('reference_stations', $arr);
    }

    public function getAllCasters()
    {
        $query = $this->db->query("SELECT `id`, `address`, `port`, `group_id`, IF(`status`, 'true', 'false') as 'status' FROM ntrip.casters;");

        return $query->result_array();
    }

    public function removeCaster($id)
    {
        $query = $this->db->query("DELETE FROM casters WHERE id = " . (int)$id);
        return $query;
    }

    public function addNewCaster($port)
    {
        $sql = "INSERT INTO ntrip.casters (`port`) VALUES(" . (int)$port . ");";

        if ($this->db->query($sql)) {
            return 'OK';
        } else {
            return $this->db->error();
        }
    }

    public function addMountpoint($arr)
    {
        return $this->db->insert('mountpoints', $arr);
    }

    public function getAllMountpoint()
    {
        $query = $this->db->query("SELECT `id`, `mountpoint`, `identifier`, `format`, `format-details`, `carrier`, `nav-system`, `network`, `country`, `latitude`, `longitude`, IF(`nmea`, 'true', 'false') as 'nmea', IF(`solution`, 'true', 'false') as 'solution', `generator`, `compression`, `authentication`, `fee`, `bitrate`, `misc`, `caster_id`, `bases_id`, IF(`available`, 'true', 'false') as 'available', `plugin_id` FROM ntrip.mountpoints;");

        return $query->result_array();
    }

    public function onOffCaster($id, $boolean)
    {
        $data = array(
            'status' => $boolean === 'true' ? 1 : 0
        );
        $this->db->where('id', $id);
        $this->db->update('casters', $data);
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
