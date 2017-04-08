<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruang_kuliah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ruang_kuliah_model');
        $this->load->library('form_validation');
          if ($this->session->userdata('email')=='') {
        redirect('login','refresh');
    }
    $this->load->helper('text');

    
    }

    public function index()
    {
        $ruang_kuliah = $this->Ruang_kuliah_model->get_all();

        $data = array(
            'ruang_kuliah_data' => $ruang_kuliah,
                    'content' => 'ruang_kuliah/ruang_kuliah_list',
            'email' => $this->session->userdata('email'),
            'judul' => 'Ruang Kuliah',
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->Ruang_kuliah_model->get_by_id($id);
        if ($row) {
            $data = array(
                         'content' => 'ruang_kuliah/ruang_kuliah_read',
            'email' => $this->session->userdata('email'),
            'judul' => 'Read Ruang Kuliah',
		'id_ruang_kuliah' => $row->id_ruang_kuliah,
		'nama_ruangan' => $row->nama_ruangan,
		'ket_ruangan' => $row->ket_ruangan,
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruang_kuliah'));
        }
    }

    public function create() 
    {
        $data = array(
                     'content' => 'ruang_kuliah/ruang_kuliah_form',
            'email' => $this->session->userdata('email'),
            'judul' => 'Create Ruang Kuliah',
            'button' => 'Create',
            'action' => site_url('ruang_kuliah/create_action'),
	    'id_ruang_kuliah' => set_value('id_ruang_kuliah'),
	    'nama_ruangan' => set_value('nama_ruangan'),
	    'ket_ruangan' => set_value('ket_ruangan'),
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
		'nama_ruangan' => $this->input->post('nama_ruangan',TRUE),
		'ket_ruangan' => $this->input->post('ket_ruangan',TRUE),
	    );

            $this->Ruang_kuliah_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ruang_kuliah'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Ruang_kuliah_model->get_by_id($id);

        if ($row) {
            $data = array(
                         'content' => 'ruang_kuliah/ruang_kuliah_form',
            'email' => $this->session->userdata('email'),
            'judul' => 'Update Ruang Kuliah',
                'button' => 'Update',
                'action' => site_url('ruang_kuliah/update_action'),
		'id_ruang_kuliah' => set_value('id_ruang_kuliah', $row->id_ruang_kuliah),
		'nama_ruangan' => set_value('nama_ruangan', $row->nama_ruangan),
		'ket_ruangan' => set_value('ket_ruangan', $row->ket_ruangan),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruang_kuliah'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ruang_kuliah', TRUE));
        } else {
            $data = array(
		'nama_ruangan' => $this->input->post('nama_ruangan',TRUE),
		'ket_ruangan' => $this->input->post('ket_ruangan',TRUE),
	    );

            $this->Ruang_kuliah_model->update($this->input->post('id_ruang_kuliah', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ruang_kuliah'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ruang_kuliah_model->get_by_id($id);

        if ($row) {
            $this->Ruang_kuliah_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ruang_kuliah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruang_kuliah'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_ruangan', 'nama ruangan', 'trim|required');
	$this->form_validation->set_rules('ket_ruangan', 'ket ruangan', 'trim|required');

	$this->form_validation->set_rules('id_ruang_kuliah', 'id_ruang_kuliah', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ruang_kuliah.xls";
        $judul = "ruang_kuliah";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ruangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Ket Ruangan");

	foreach ($this->Ruang_kuliah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ruangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket_ruangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=ruang_kuliah.doc");

        $data = array(
            'ruang_kuliah_data' => $this->Ruang_kuliah_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('ruang_kuliah/ruang_kuliah_doc',$data);
    }

}

/* End of file Ruang_kuliah.php */
/* Location: ./application/controllers/Ruang_kuliah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-07 10:22:42 */
/* http://harviacode.com */