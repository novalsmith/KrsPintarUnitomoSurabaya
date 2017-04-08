<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SyaratBatasSks extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('SyaratBatasSksModel');
        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {

           redirect('login','refresh');
       }
    }

    public function index()
    {
        $syaratbatassks = $this->SyaratBatasSksModel->get_all();


            $data['syaratbatassks_data'] = $syaratbatassks;
            $data ['email'] = $this->session->userdata('email');
              $data['content'] = 'syaratbatassks/syarat_batas_sks_list.php';
                     $data['judul']    = 'Syarat Batas SKS';
                     $data['nama']    = 'Syarat Batas SKS';

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->SyaratBatasSksModel->get_by_id($id);
        if ($row) {
            $data = array(
		'id_mk_syarat_sks' => $row->id_mk_syarat_sks,
		'id_mk' => $row->id_mk,
		'batas_sks' => $row->batas_sks,
   'email' => $this->session->userdata('email'),
      'content' => 'syaratbatassks/syarat_batas_sks_read.php',
             'judul'    => 'Syarat Batas SKS Read',
          'nama'    => 'Syarat Batas SKS',
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('syaratbatassks'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('SyaratBatasSks/create_action'),
	    'id_mk_syarat_sks' => set_value('id_mk_syarat_sks'),
	    'id_mk' => set_value('id_mk'),
	    'batas_sks' => set_value('batas_sks'),
      'email' => $this->session->userdata('email'),
        'content' => 'syaratbatassks/syarat_batas_sks_form.php',
               'judul'    => 'Syarat Batas SKS',
               'nama'    => 'Syarat Batas SKS',
	);
        $this->load->view('template', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_mk' => $this->input->post('id_mk',TRUE),
		'batas_sks' => $this->input->post('batas_sks',TRUE),
	    );

            $this->SyaratBatasSksModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('SyaratBatasSks'));
        }
    }

    public function update($id)
    {
        $row = $this->SyaratBatasSksModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('SyaratBatasSks/update_action'),
		'id_mk_syarat_sks' => set_value('id_mk_syarat_sks', $row->id_mk_syarat_sks),
		'id_mk' => set_value('id_mk', $row->id_mk),
		'batas_sks' => set_value('batas_sks', $row->batas_sks),
    'email' => $this->session->userdata('email'),
      'content' => 'syaratbatassks/syarat_batas_sks_form.php',
             'judul'    => 'Update Syarat Batas SKS',
             'nama'    => 'Syarat Batas SKS',
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('SyaratBatasSks'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mk_syarat_sks', TRUE));
        } else {
            $data = array(
		'id_mk' => $this->input->post('id_mk',TRUE),
		'batas_sks' => $this->input->post('batas_sks',TRUE),
	    );

            $this->SyaratBatasSksModel->update($this->input->post('id_mk_syarat_sks', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('SyaratBatasSks'));
        }
    }

    public function delete($id)
    {
        $row = $this->SyaratBatasSksModel->get_by_id($id);

        if ($row) {
            $this->SyaratBatasSksModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('SyaratBatasSks'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('SyaratBatasSks'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_mk', 'Matakuliah', 'trim|required');
	$this->form_validation->set_rules('batas_sks', 'Batas Sks', 'trim|required');

	$this->form_validation->set_rules('id_mk_syarat_sks', 'id_mk_syarat_sks', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "syarat_batas_sks.xls";
        $judul = "syarat_batas_sks";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mk");
	xlsWriteLabel($tablehead, $kolomhead++, "Batas Sks");

	foreach ($this->SyaratBatasSksModel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->batas_sks);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=syarat_batas_sks.doc");

        $data = array(
            'syarat_batas_sks_data' => $this->SyaratBatasSksModel->get_all(),
            'start' => 0
        );

        $this->load->view('SyaratBatasSks/syarat_batas_sks_doc',$data);
    }

}

/* End of file SyaratBatasSks.php */
/* Location: ./application/controllers/SyaratBatasSks.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-07 19:33:13 */
/* http://harviacode.com */
