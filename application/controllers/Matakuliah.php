<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Matakuliah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Matakuliah_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {

            redirect('login','refresh');
        }
    }

    public function index()
    {
        $data['content'] = 'matakuliah/matakuliah_list.php';
         $data['judul']    = 'Mata Kuliah ';
         $data['nama']    = 'Data Mata Kuliah';
         $data['matakuliah_data'] = $this->Matakuliah_model->get_all();
$data['email'] = $this->session->userdata('email');
         $this->load->view('template',$data);



    }

    public function read($id)
    {
        $row = $this->Matakuliah_model->get_by_id($id);
        if ($row) {
            $data = array(
        'email' => $this->session->userdata('email'),
        'content'   => 'matakuliah/matakuliah_read',
        'nama'          => 'Matakuliah List',
        'judul'         => 'Read Matakuliah',
		'id_mk' => $row->id_mk,
		'kode_mk' => $row->kode_mk,
		'nama_matakuliah' => $row->nama_matakuliah,
		'sks' => $row->sks,
	    );
           $this->load->view('template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('matakuliah'));
        }
    }

    public function create()
    {
        $data = array(
            'content'   => 'matakuliah/matakuliah_form',
        'nama'          => 'Matakuliah Create',

        'email' => $this->session->userdata('email'),
        'judul'         => 'Create Matakuliah',
            'button' => 'Create',
            'action' => site_url('matakuliah/create_action'),
	    'id_mk' => set_value('id_mk'),
	    'kode_mk' => set_value('kode_mk'),
         //'id_semester' => set_value('id_semester'),
	    'nama_matakuliah' => set_value('nama_matakuliah'),
	    'sks' => set_value('sks'),
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
		'kode_mk' => $this->input->post('kode_mk',TRUE),
		'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
		'sks' => $this->input->post('sks',TRUE),
       // 'id_semester' => $this->input->post('id_semester',TRUE),
	    );

            $this->Matakuliah_model->insert($data);


 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.

                 </div>');



            redirect(site_url('matakuliah'));
        }
    }

    public function update($id)
    {
        $row = $this->Matakuliah_model->get_by_id($id);

        if ($row) {
            $data = array(

        'email' => $this->session->userdata('email'),
                  'content'   => 'matakuliah/matakuliah_form',
        'nama'          => 'Matakuliah Update',
        'judul'         => 'Update Matakuliah',
                'button' => 'Update',
                'action' => site_url('matakuliah/update_action'),
		'id_mk' => set_value('id_mk', $row->id_mk),
		'kode_mk' => set_value('kode_mk', $row->kode_mk),
		'nama_matakuliah' => set_value('nama_matakuliah', $row->nama_matakuliah),
		'sks' => set_value('sks', $row->sks),
   // 'id_semester' => set_value('id_semester', $row->id_semester),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('matakuliah'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mk', TRUE));
        } else {
            $data = array(
		'kode_mk' => $this->input->post('kode_mk',TRUE),
		'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
		'sks' => $this->input->post('sks',TRUE),
       // 'id_semester' => $this->input->post('id_semester',TRUE),
	    );

            $this->Matakuliah_model->update($this->input->post('id_mk', TRUE), $data);



 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');




           redirect(site_url('matakuliah'));
        }
    }

    public function delete($id)
    {
        $row = $this->Matakuliah_model->get_by_id($id);

        if ($row) {
            $this->Matakuliah_model->delete($id);



 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Delete!</strong> Your Data is Successful.

                 </div>');




            redirect(site_url('matakuliah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('matakuliah'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_mk', 'kode mk', 'trim|required');
	$this->form_validation->set_rules('nama_matakuliah', 'nama matakuliah', 'trim|required');
	$this->form_validation->set_rules('sks', 'sks', 'trim|required');

	$this->form_validation->set_rules('id_mk', 'id_mk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "matakuliah.xls";
        $judul = "matakuliah";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Mk");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Matakuliah");
	xlsWriteLabel($tablehead, $kolomhead++, "Sks");

	foreach ($this->Matakuliah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_mk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_matakuliah);
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
        header("Content-Disposition: attachment;Filename=matakuliah.doc");

        $data = array(
            'matakuliah_data' => $this->Matakuliah_model->get_all(),
            'start' => 0
        );

        $this->load->view('matakuliah/matakuliah_doc',$data);
    }

}

/* End of file Matakuliah.php */
/* Location: ./application/controllers/Matakuliah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:15 */
/* http://harviacode.com */
