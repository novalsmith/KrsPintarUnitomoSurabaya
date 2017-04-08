<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pertanyaan_model extends CI_Model
{

    public $table = 'pertanyaan';
    public $id = 'id_pertanyaan';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->join('semester s', 's.id_semester = pertanyaan.id_semester');
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
        $this->db->like('id_pertanyaan', $q);
	$this->db->or_like('id_semester', $q);
	$this->db->or_like('nama_pertanyaan', $q);
	$this->db->or_like('jika_ya', $q);
	$this->db->or_like('jika_tidak', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pertanyaan', $q);
	$this->db->or_like('id_semester', $q);
	$this->db->or_like('nama_pertanyaan', $q);
	$this->db->or_like('jika_ya', $q);
	$this->db->or_like('jika_tidak', $q);
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

/* End of file Pertanyaan_model.php */
/* Location: ./application/models/Pertanyaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-09 05:39:51 */
/* http://harviacode.com */
