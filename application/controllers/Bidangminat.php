<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bidangminat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bidangminat_model');
        $this->load->library('form_validation');
           if ($this->session->userdata('username')=="") {
            redirect('login');
   
 }
    $this->load->helper('text');
    }

    public function index()
    {
        $bidangminat = $this->Bidangminat_model->join_mk();

        $data = array(
            
        'email' => $this->session->userdata('email'),
            'content'   => 'bidangminat/bidangminat_list.php',
            'judul'     => 'Bidang Minat',
            'nama'      =>  'Matakuliah Bidang Minat',
            'bidangminat_data' => $bidangminat
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->Bidangminat_model->get_by_id($id);
        if ($row) {
            $data = array(
        'email' => $this->session->userdata('email'),
        'content'   => 'bidangminat/bidangminat_read.php',
        'judul'     => 'Read Matakuliah Bidang Minat',
        'nama'      =>  'Read Matakuliah Bidang Minat',
		'id_bidangminat' => $row->id_bidangminat,
		'kode_mk' => $row->nama_matakuliah,
		'nama_minat' => $row->nama_minat,
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bidangminat'));
        }
    }

    public function create() 
    {

        $data = array(
               'email' => $this->session->userdata('email'),
            'mk'       => $this->db->get('matakuliah'),

            'minat'       => $this->db->get('minat'),
          'content'   => 'bidangminat/bidangminat_form.php',
        'judul'     => 'Matakuliah Bidang minat',
        'nama'      =>  'Matakuliah Bidang minat',   
            'button' => 'Create',
            'action' => site_url('bidangminat/create_action'),
	    'id_bidangminat' => set_value('id_bidangminat'),
	    'kode_mk' => set_value('kode_mk'),
          'semester' => set_value('semester'),
	    'nama_bidangminat' => set_value('nama_bidangminat'),
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
		'id_mk' => $this->input->post('kode_mk',TRUE),
		'id_minat' => $this->input->post('nama_bidangminat',TRUE),
          'semester' => $this->input->post('semester',TRUE),
	    );

            $this->Bidangminat_model->insert($data);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.
 
                 </div>');


            redirect(site_url('bidangminat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bidangminat_model->get_by_id($id);

        if ($row) {
            $data = array(
                   'email' => $this->session->userdata('email'),
                   'content'   => 'bidangminat/bidangminat_form.php',
                     'minat'       => $this->db->get('minat'),
        'judul'     => 'Matakuliah Bersyarat',
        'nama'      =>  'Matakuliah Bersyarat', 
                  'mk'       => $this->db->get('matakuliah'),
                'button' => 'Update',
                'action' => site_url('bidangminat/update_action'),
		'id_bidangminat' => set_value('id_bidangminat', $row->id_bidangminat),
		'kode_mk' => set_value('kode_mk', $row->id_mk),
		'nama_bidangminat' => set_value('nama_bidangminat', $row->id_minat),
        'semester' => set_value('semester', $row->semester),

	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bidangminat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_bidangminat', TRUE));
        } else {
            $data = array(
		'id_mk' => $this->input->post('kode_mk',TRUE),
		'id_minat' => $this->input->post('nama_bidangminat',TRUE),
        'semester' => $this->input->post('semester',TRUE),
	    );

            $this->Bidangminat_model->update($this->input->post('id_bidangminat', TRUE), $data);



 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('bidangminat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bidangminat_model->get_by_id($id);

        if ($row) {
            $this->Bidangminat_model->delete($id);



 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted!</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('bidangminat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bidangminat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_mk', 'Nama Matakuliah', 'trim|required');
	$this->form_validation->set_rules('nama_bidangminat', 'Nama Bidangminat', 'trim|required');

	$this->form_validation->set_rules('id_bidangminat', 'id_bidangminat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bidangminat.xls";
        $judul = "bidangminat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Bidangminat");

	foreach ($this->Bidangminat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_mk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_bidangminat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bidangminat.doc");

        $data = array(
            'bidangminat_data' => $this->Bidangminat_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('bidangminat/bidangminat_doc',$data);
    }

}

/* End of file Bidangminat.php */
/* Location: ./application/controllers/Bidangminat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:13 */
/* http://harviacode.com */