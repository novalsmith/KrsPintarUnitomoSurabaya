<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelebihan_sks extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelebihan_sks_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kelebihan_sks = $this->Kelebihan_sks_model->get_all();

        $data = array(
            'kelebihan_sks_data' => $kelebihan_sks
        );

        $this->load->view('kelebihan_sks/kelebihan_sks_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kelebihan_sks_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kelebihan' => $row->id_kelebihan,
		'id_mk' => $row->id_mk,
		'lebih' => $row->lebih,
	    );
            $this->load->view('kelebihan_sks/kelebihan_sks_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelebihan_sks'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelebihan_sks/create_action'),
	    'id_kelebihan' => set_value('id_kelebihan'),
	    'id_mk' => set_value('id_mk'),
	    'lebih' => set_value('lebih'),
	);
        $this->load->view('kelebihan_sks/kelebihan_sks_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_mk' => $this->input->post('id_mk',TRUE),
		'lebih' => $this->input->post('lebih',TRUE),
	    );

            $this->Kelebihan_sks_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kelebihan_sks'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kelebihan_sks_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelebihan_sks/update_action'),
		'id_kelebihan' => set_value('id_kelebihan', $row->id_kelebihan),
		'id_mk' => set_value('id_mk', $row->id_mk),
		'lebih' => set_value('lebih', $row->lebih),
	    );
            $this->load->view('kelebihan_sks/kelebihan_sks_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelebihan_sks'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelebihan', TRUE));
        } else {
            $data = array(
		'id_mk' => $this->input->post('id_mk',TRUE),
		'lebih' => $this->input->post('lebih',TRUE),
	    );

            $this->Kelebihan_sks_model->update($this->input->post('id_kelebihan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelebihan_sks'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kelebihan_sks_model->get_by_id($id);

        if ($row) {
            $this->Kelebihan_sks_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelebihan_sks'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelebihan_sks'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_mk', 'id mk', 'trim|required');
	$this->form_validation->set_rules('lebih', 'lebih', 'trim|required');

	$this->form_validation->set_rules('id_kelebihan', 'id_kelebihan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kelebihan_sks.xls";
        $judul = "kelebihan_sks";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Lebih");

	foreach ($this->Kelebihan_sks_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->lebih);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kelebihan_sks.doc");

        $data = array(
            'kelebihan_sks_data' => $this->Kelebihan_sks_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kelebihan_sks/kelebihan_sks_doc',$data);
    }

}

/* End of file Kelebihan_sks.php */
/* Location: ./application/controllers/Kelebihan_sks.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-08-18 12:48:15 */
/* http://harviacode.com */