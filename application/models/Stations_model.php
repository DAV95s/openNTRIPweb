<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stations_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllStations()
    {
        $query = $this->db->query("SELECT `id`, `mountpoint`, `identifier`, `format`, `format-details`, carrier, `nav-system`, `country`, ST_AsText(lla) as lla, `altitude`, `bitrate`, `misc`, `is_online`, `password`, `hz` FROM base_stations");
        $result = $query->result_array();

        return $result;
    }

    public function getStationByName($id)
    {
        $query = $this->db->query("SELECT `id`, `mountpoint`, `identifier`, `format`, `format-details`, carrier, `nav-system`, `country`, ST_AsText(lla) as lla, `altitude`, `bitrate`, `misc`, `is_online`, `password`, `hz` FROM base_stations WHERE `id` =".(int)$id);
        $result = $query->row();

        return $result;
    }

    public function getStationsPosition()
    {
        $query = $this->db->query("SELECT mountpoint, ST_AsText(lla) as lla FROM base_stations");
        $result = $query->result_array();

        return $result;
    }

    // public function setNewStation($arr)
  // {
  //     $mountpoint =  $this->db->escape($arr['mountpoint']);
  //     $nmea =  $arr['nmea'] == 'on' ? '1' : '0';
  //     $authentication =  $arr['authentication'] == 'on' ? '1' : '0';
  //     $misc = $this->db->escape($arr['misc']);
  //     $sql = "INSERT INTO ntrip.stations (`id`,`mountpoint`,`nmea`,`authentication`,`misc`) VALUES (DEFAULT, ?, ?, ?, ?)";

  //     if($this->db->query($sql, array($mountpoint, $nmea, $authentication, $misc) )){
  //       return 'OK';
  //     }else{
  //       return $this->db->error(); // Has keys 'code' and 'message'
  //     }
  // }
}
