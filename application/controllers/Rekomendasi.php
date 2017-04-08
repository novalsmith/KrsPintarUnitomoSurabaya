<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekomendasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rekomendasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $rekomendasi = $this->Rekomendasi_model->get_all();

        $data = array(
            'rekomendasi_data' => $rekomendasi
        );

        $this->load->view('rekomendasi/rekomendasi_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Rekomendasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_rekom' => $row->id_rekom,
		'id_bidangminat' => $row->id_bidangminat,
		'id_mk' => $row->id_mk,
	    );
            $this->load->view('rekomendasi/rekomendasi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekomendasi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('rekomendasi/create_action'),
	    'id_rekom' => set_value('id_rekom'),
	    'id_bidangminat' => set_value('id_bidangminat'),
	    'id_mk' => set_value('id_mk'),
	);
        $this->load->view('rekomendasi/rekomendasi_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_bidangminat' => $this->input->post('id_bidangminat',TRUE),
		'id_mk' => $this->input->post('id_mk',TRUE),
	    );

            $this->Rekomendasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('rekomendasi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Rekomendasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('rekomendasi/update_action'),
		'id_rekom' => set_value('id_rekom', $row->id_rekom),
		'id_bidangminat' => set_value('id_bidangminat', $row->id_bidangminat),
		'id_mk' => set_value('id_mk', $row->id_mk),
	    );
            $this->load->view('rekomendasi/rekomendasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekomendasi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_rekom', TRUE));
        } else {
            $data = array(
		'id_bidangminat' => $this->input->post('id_bidangminat',TRUE),
		'id_mk' => $this->input->post('id_mk',TRUE),
	    );

            $this->Rekomendasi_model->update($this->input->post('id_rekom', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rekomendasi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Rekomendasi_model->get_by_id($id);

        if ($row) {
            $this->Rekomendasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rekomendasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekomendasi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_bidangminat', 'id bidangminat', 'trim|required');
	$this->form_validation->set_rules('id_mk', 'id mk', 'trim|required');

	$this->form_validation->set_rules('id_rekom', 'id_rekom', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "rekomendasi.xls";
        $judul = "rekomendasi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Bidangminat");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mk");

	foreach ($this->Rekomendasi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_bidangminat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mk);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=rekomendasi.doc");

        $data = array(
            'rekomendasi_data' => $this->Rekomendasi_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('rekomendasi/rekomendasi_doc',$data);
    }

}

/* End of file Rekomendasi.php */
/* Location: ./application/controllers/Rekomendasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:16 */
/* http://harviacode.com */