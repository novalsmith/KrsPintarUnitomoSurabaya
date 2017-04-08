<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model');
        $this->load->library('form_validation');
              if ($this->session->userdata('username')=="") {
            redirect('login');
    }
    }

    public function index()
    {

        $data['email'] = $this->session->userdata('email');
         $data['content'] = 'jurusan/jurusan_list.php';
         $data['judul']    = 'Jurusan ';
         $data['nama']    = 'Data Jurusan';
         $data['jurusan_data'] = $this->Jurusan_model->get_all();

         $this->load->view('template',$data);


    }

    public function read($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);
        if ($row) {
 
            $data = array(
		'email' => $this->session->userdata('email'),
        'id_jurusan' => $row->id_jurusan,
        'content'   => 'jurusan/jurusan_read',
		'kode_jurusan' => $row->kode_jurusan,
        'nama'          => 'Jurusan List',
        'judul'         => 'Read Jurusan',
		'nama_jurusan' => $row->nama_jurusan,
        'jurusan_data' => $this->Jurusan_model->get_all()
	    );
        
         $this->load->view('template',$data);


        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurusan'));
        }
    }

    public function create() 
    {

        

        $data = array(
            'button' => 'Create',

        'email' => $this->session->userdata('email'),
            'action' => site_url('jurusan/create_action'),
	    'id_jurusan' => set_value('id_jurusan'),
            'nama'          => 'Jurusan List',
         'content'   => 'jurusan/jurusan_form',
        'judul'         => 'Jurusan',
	    'kode_jurusan' => set_value('kode_jurusan'),
	    'nama_jurusan' => set_value('nama_jurusan'),
	);

        
         $this->load->view('template',$data);

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_jurusan' => $this->input->post('kode_jurusan',TRUE),
		'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
	    );

            $this->Jurusan_model->insert($data);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.
 
                 </div>');


            redirect(site_url('jurusan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);

        if ($row) {



        


            $data = array(

        'email' => $this->session->userdata('email'),
                     'nama'          => 'Jurusan Update',
         'content'   => 'jurusan/jurusan_form',
        'judul'         => 'Update Jurusan',
                'button' => 'Update',
                'action' => site_url('jurusan/update_action'),
		'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
		'kode_jurusan' => set_value('kode_jurusan', $row->kode_jurusan),
		'nama_jurusan' => set_value('nama_jurusan', $row->nama_jurusan),
	    );
        



         $this->load->view('template',$data);


        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurusan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jurusan', TRUE));
        } else {
            $data = array(
		'kode_jurusan' => $this->input->post('kode_jurusan',TRUE),
		'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
	    );

            $this->Jurusan_model->update($this->input->post('id_jurusan', TRUE), $data);
       


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.
 
                 </div>');


            redirect(site_url('jurusan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);

        if ($row) {
            $this->Jurusan_model->delete($id);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted!</strong> Your Data is Successful.
 
                 </div>');


            redirect(site_url('jurusan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurusan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_jurusan', 'kode jurusan', 'trim|required');
	$this->form_validation->set_rules('nama_jurusan', 'nama jurusan', 'trim|required');

	$this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jurusan.xls";
        $judul = "jurusan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Jurusan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jurusan");

	foreach ($this->Jurusan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_jurusan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jurusan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jurusan.doc");

        $data = array(
            'jurusan_data' => $this->Jurusan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('jurusan/jurusan_doc',$data);
    }

}

/* End of file Jurusan.php */
/* Location: ./application/controllers/Jurusan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:14 */
/* http://harviacode.com */