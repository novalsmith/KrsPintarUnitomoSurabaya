<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mk_syarat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mk_syarat_model');
        $this->load->library('form_validation');
          if ($this->session->userdata('username')=="") {
            redirect('login');
    }
    }

    public function index()
    {
        $mk_syarat = $this->Mk_syarat_model->join_all();

        $data = array(
            'content'   => 'mk_syarat/mk_syarat_list.php',
            'judul'     => 'Matakuliah Bersyarat',
            'nama'      =>  'List Matakuliah Bersyarat',   
            'email'     => $this->session->userdata('email'),
            'mk_syarat_data' => $mk_syarat
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->Mk_syarat_model->get_by_id($id);
        if ($row) {
            $data = array(
                   'content'   => 'mk_syarat/mk_syarat_read.php',
            'judul'     => 'Matakuliah Bersyarat',
            'nama'      =>  'List Matakuliah Bersyarat',
            'id_mk' =>  $row->nama_matakuliah,
	
            'email'     => $this->session->userdata('email'),
		'id_semester' => $row->nama_semester,
		'syarat' => $row->syarat,
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mk_syarat'));
        }
    }

    public function create() 
    {
        $data = array(
           
            'email'     => $this->session->userdata('email'),
               'content'   => 'mk_syarat/mk_syarat_form.php',
            'judul'     => 'Matakuliah Bersyarat',
            'nama'      =>  'Matakuliah Bersyarat',
            'button' => 'Create',
            'action' => site_url('mk_syarat/create_action'),
            'id_syarat' =>set_value('id_syarat'),
	    'id_mk' => set_value('id_mk'),
	    'id_semester' => set_value('id_semester'),
	    'syarat' => set_value('syarat')
      
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
		'id_semester' => $this->input->post('id_semester',TRUE),
		'syarat' => $this->input->post('syarat',TRUE),
	    );

            $this->Mk_syarat_model->insert($data);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('mk_syarat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mk_syarat_model->get_by_id_update($id);

        if ($row) {
            $data = array(
                
            'email'     => $this->session->userdata('email'),
                 'content'   => 'mk_syarat/mk_syarat_form.php',
            'judul'          => 'Matakuliah Bersyarat',
            'nama'           =>  'Matakuliah Bersyarat',
            'button'         => 'Update',
            'action'         => site_url('mk_syarat/update_action'),
            'id_syarat'      => set_value('id_syarat', $row->id_syarat),
		    'id_mk'          => set_value('id_mk', $row->id_mk),
      
		    'id_semester' => set_value('id_semester', $row->id_semester),
		    'syarat' => set_value('syarat', $row->syarat),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mk_syarat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_syarat', TRUE));
        } else {
            $data     = array(
		'id_mk'    => $this->input->post('id_mk',TRUE),
		'id_semester' => $this->input->post('id_semester',TRUE),
		'syarat'      => $this->input->post('syarat',TRUE),
        );

            $this->Mk_syarat_model->update($this->input->post('id_syarat', TRUE), $data);

 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.
 
                 </div>');


                             redirect(site_url('mk_syarat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mk_syarat_model->get_by_id($id);

        if ($row) {
            $this->Mk_syarat_model->delete($id);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted!</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('mk_syarat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mk_syarat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_mk', 'Matakuliah', 'trim|required');
	$this->form_validation->set_rules('id_semester', 'Semester', 'trim|required');
	$this->form_validation->set_rules('syarat', 'Syarat', 'trim|required');


	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mk_syarat.xls";
        $judul = "mk_syarat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Nilai");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Mk Syarat");

	foreach ($this->Mk_syarat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_bidangminat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_nilai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_mk_syarat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mk_syarat.doc");

        $data = array(
            'mk_syarat_data' => $this->Mk_syarat_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mk_syarat/mk_syarat_doc',$data);
    }

}

/* End of file Mk_syarat.php */
/* Location: ./application/controllers/Mk_syarat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:15 */
/* http://harviacode.com */