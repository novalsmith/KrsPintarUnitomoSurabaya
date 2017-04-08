<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mata_kuliah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mata_kuliah_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {
            
            redirect('login','refresh');
        }
    }

    public function index()
    {
        $mata_kuliah = $this->Mata_kuliah_model->get_all();

        $data = array(
            'email' => $this->session->userdata('email'),
            'mata_kuliah_data' => $mata_kuliah
        );

        $this->load->view('mata_kuliah/mata_kuliah_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Mata_kuliah_model->get_by_id($id);
        if ($row) {
            $data = array(

            'email' => $this->session->userdata('email'),
		'kode_mk' => $row->kode_mk,
		'id_semester' => $row->id_semester,
		'nama_mk' => $row->nama_mk,
		'sks' => $row->sks,
	    );
            $this->load->view('mata_kuliah/mata_kuliah_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mata_kuliah'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',

            'email' => $this->session->userdata('email'),
            'action' => site_url('mata_kuliah/create_action'),
	    'kode_mk' => set_value('kode_mk'),
	    'id_semester' => set_value('id_semester'),
	    'nama_mk' => set_value('nama_mk'),
	    'sks' => set_value('sks'),
	);
        $this->load->view('mata_kuliah/mata_kuliah_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_semester' => $this->input->post('id_semester',TRUE),
		'nama_mk' => $this->input->post('nama_mk',TRUE),
		'sks' => $this->input->post('sks',TRUE),
	    );

            $this->Mata_kuliah_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mata_kuliah'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mata_kuliah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'email' => $this->session->userdata('email'),
                

                'action' => site_url('mata_kuliah/update_action'),
		'kode_mk' => set_value('kode_mk', $row->kode_mk),
		'id_semester' => set_value('id_semester', $row->id_semester),
		'nama_mk' => set_value('nama_mk', $row->nama_mk),
		'sks' => set_value('sks', $row->sks),
	    );
            $this->load->view('mata_kuliah/mata_kuliah_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mata_kuliah'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_mk', TRUE));
        } else {
            $data = array(
		'id_semester' => $this->input->post('id_semester',TRUE),
		'nama_mk' => $this->input->post('nama_mk',TRUE),
		'sks' => $this->input->post('sks',TRUE),
	    );

            $this->Mata_kuliah_model->update($this->input->post('kode_mk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mata_kuliah'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mata_kuliah_model->get_by_id($id);

        if ($row) {
            $this->Mata_kuliah_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mata_kuliah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mata_kuliah'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_semester', 'id semester', 'trim|required');
	$this->form_validation->set_rules('nama_mk', 'nama mk', 'trim|required');
	$this->form_validation->set_rules('sks', 'sks', 'trim|required');

	$this->form_validation->set_rules('kode_mk', 'kode_mk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mata_kuliah.xls";
        $judul = "mata_kuliah";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Semester");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Mk");
	xlsWriteLabel($tablehead, $kolomhead++, "Sks");

	foreach ($this->Mata_kuliah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_semester);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_mk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sks);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mata_kuliah.doc");

        $data = array(
            'mata_kuliah_data' => $this->Mata_kuliah_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mata_kuliah/mata_kuliah_doc',$data);
    }

}

/* End of file Mata_kuliah.php */
/* Location: ./application/controllers/Mata_kuliah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-12 09:20:32 */
/* http://harviacode.com */