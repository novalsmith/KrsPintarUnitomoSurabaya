<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paketmatakuliah_model extends CI_Model
{

    public $table = 'paket_mk';
    public $id = 'id_paket';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->join('matakuliah', 'matakuliah.id_mk = paket_mk.id_mk');

        $this->db->join('semester', 'semester.id_semester = paket_mk.id_semester');
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_paket', $q);
	$this->db->or_like('id_semester', $q);
	$this->db->or_like('id_mk', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_paket', $q);
	$this->db->or_like('id_semester', $q);
	$this->db->or_like('id_mk', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Paketmatakuliah_model.php */
/* Location: ./application/models/Paketmatakuliah_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-12 05:31:42 */
/* http://harviacode.com */