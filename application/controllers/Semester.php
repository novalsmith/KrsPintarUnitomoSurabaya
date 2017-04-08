<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Semester extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Semester_model');
        $this->load->library('form_validation');
         if ($this->session->userdata('username')=="") {
            
            redirect('login','refresh');
        }
    }

    public function index()
    {
   
$data ['email'] = $this->session->userdata('email');
  $data['content'] = 'semester/semester_list.php';
         $data['judul']    = 'Semester';
         $data['nama']    = 'Data Semester';
         $data['semester_data'] = $this->Semester_model->get_all();

         $this->load->view('template',$data);




    }

    public function read($id) 
    {
        $row = $this->Semester_model->get_by_id($id);
        if ($row) {

$data['email'] = $this->session->userdata('email');
             $data['content'] = 'semester/semester_read.php';
         $data['judul']    = 'Semester Read';
         $data['nama']    = 'Semester Read';
         $data['semester_data'] = $this->Semester_model->get_all();

    
		$data['id_semester'] = $row->id_semester;
		$data['nama_semester'] = $row->nama_semester;
	   
             $this->load->view('template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('semester'));
        }
    }

    public function create() 
    {
        $data['email'] = $this->session->userdata('email');
               $data['content'] = 'semester/semester_form.php';
         $data['judul']    = 'Semester Create';
         $data['nama']    = 'Semester Create';
         $data['semester_data'] = $this->Semester_model->get_all();

    
        $data['id_semester'] =set_value('id_semester');
        $data['nama_semester'] = set_value('nama_semester');
       
            
           $data['button'] = 'Create';
            $data['action'] = site_url('semester/create_action');
	
	 $this->load->view('template',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_semester' => $this->input->post('nama_semester',TRUE),
	    );

            $this->Semester_model->insert($data);


 $this->session->set_flashdata('message', 
    
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('semester'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Semester_model->get_by_id($id);

        if ($row) {

$data['email']  = $this->session->userdata('email');
 $data['content'] = 'semester/semester_form.php';
         $data['judul']    = 'Semester Update';
         $data['nama']    = 'Semester Update';
         $data['semester_data'] = $this->Semester_model->get_all();

    
        $data['id_semester'] =set_value('id_semester', $row->id_semester);
        $data['nama_semester'] = set_value('nama_semester', $row->nama_semester);
       
            
           $data['button'] = 'Update';
            $data['action'] = site_url('semester/update_action');
    
     $this->load->view('template',$data);


     
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('semester'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_semester', TRUE));
        } else {
            $data = array(
		'nama_semester' => $this->input->post('nama_semester',TRUE),
	    );

            $this->Semester_model->update($this->input->post('id_semester', TRUE), $data);
            
            $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.
 
                 </div>');


            redirect(site_url('semester'));
        }
    } 
    
    public function delete($id) 
    {
        $row = $this->Semester_model->get_by_id($id);

        if ($row) {
            $this->Semester_model->delete($id);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted!</strong> Your Data is Successful.
 
                 </div>');



            redirect(site_url('semester'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('semester'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_semester', 'nama semester', 'trim|required');

	$this->form_validation->set_rules('id_semester', 'id_semester', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "semester.xls";
        $judul = "semester";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Semester");

	foreach ($this->Semester_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_semester);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=semester.doc");

        $data = array(
            'semester_data' => $this->Semester_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('semester/semester_doc',$data);
    }

}

/* End of file Semester.php */
/* Location: ./application/controllers/Semester.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:16 */
/* http://harviacode.com */