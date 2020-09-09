<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Caster_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll()
    {
        $query = $this->db->query("SELECT `id`, `address`, `port`, `group_id`, IF(`status`, 'true', 'false') as 'status' FROM ntrip.casters;");
        return $query->result_array();
    }

    public function remove($id)
    {
        return $this->db->query("DELETE FROM casters WHERE id = " . (int)$id);
    }

    public function add($port)
    {
        return $this->db->query("INSERT INTO ntrip.casters (`port`) VALUES(" . (int)$port .")");
    }

    public function switcher($id, $boolean)
    {
        $data = array(
                'status' => $boolean === 'true' ? 1 : 0
            );
        $this->db->where('id', $id);
        $this->db->update('casters', $data);
    }
}
