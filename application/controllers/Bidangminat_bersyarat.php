<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bidangminat_bersyarat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bidangminat_bersyarat_model');
        $this->load->library('form_validation');
         if ($this->session->userdata('username')=="") {
            redirect('login');
    }
    $this->load->helper('text');
    }

    public function index()
    {
        $bidangminat_bersyarat = $this->Bidangminat_bersyarat_model->get_all();

        $data = array(
               'email' => $this->session->userdata('email'),

            'bidangminat_bersyarat_data' => $bidangminat_bersyarat,
            'content' => 'bidangminat_bersyarat/bidangminat_bersyarat_list',
            'judul'  => 'Bidang Minat Bersyarat',
            'nama'  => 'Bidang Minat Bersyarat',
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->Bidangminat_bersyarat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_bminat_syarat' => $row->id_bminat_syarat,

'email' => $this->session->userdata('email'),
		'id_minat' => $row->nama_minat,
		'id_mk' => $row->nama_matakuliah,
          'content' => 'bidangminat_bersyarat/bidangminat_bersyarat_read',
            'judul'  => 'Bidang Minat Bersyarat',
            'nama'  => 'Bidang Minat Bersyarat',
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bidangminat_bersyarat'));
        }
    }

    public function create() 
    {
        $data = array(
'email' => $this->session->userdata('email'),

            'button' => 'Create',
            'action' => site_url('bidangminat_bersyarat/create_action'),
	    'id_bminat_syarat' => set_value('id_bminat_syarat'),
	    'id_minat' => set_value('id_minat'),
	    'id_mk' => set_value('id_mk'),
          'content' => 'bidangminat_bersyarat/bidangminat_bersyarat_form',
            'judul'  => 'Bidang Minat Bersyarat',
            'nama'  => 'Bidang Minat Bersyarat',
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
		'id_minat' => $this->input->post('id_minat',TRUE),
		'id_mk' => $this->input->post('id_mk',TRUE),
	    );

            $this->Bidangminat_bersyarat_model->insert($data);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.
 
                 </div>');


            redirect(site_url('bidangminat_bersyarat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bidangminat_bersyarat_model->get_by_id($id);

        if ($row) {
            $data = array(
'email' => $this->session->userdata('email'),

                 'content' => 'bidangminat_bersyarat/bidangminat_bersyarat_form',
            'judul'  => 'Bidang Minat Bersyarat',
            'nama'  => 'Bidang Minat Bersyarat',
                'button' => 'Update',
                'action' => site_url('bidangminat_bersyarat/update_action'),
		'id_bminat_syarat' => set_value('id_bminat_syarat', $row->id_bminat_syarat),
		'id_minat' => set_value('id_minat', $row->id_minat),
		'id_mk' => set_value('id_mk', $row->id_mk),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bidangminat_bersyarat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_bminat_syarat', TRUE));
        } else {
            $data = array(
		'id_minat' => $this->input->post('id_minat',TRUE),
		'id_mk' => $this->input->post('id_mk',TRUE),
	    );

            $this->Bidangminat_bersyarat_model->update($this->input->post('id_bminat_syarat', TRUE), $data);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update !</strong> Your Data is Successful.
 
                 </div>');


            redirect(site_url('bidangminat_bersyarat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bidangminat_bersyarat_model->get_by_id($id);

        if ($row) {
            $this->Bidangminat_bersyarat_model->delete($id);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted !</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('bidangminat_bersyarat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bidangminat_bersyarat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_minat', 'id minat', 'trim|required');
	$this->form_validation->set_rules('id_mk', 'id mk', 'trim|required');

	$this->form_validation->set_rules('id_bminat_syarat', 'id_bminat_syarat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bidangminat_bersyarat.xls";
        $judul = "bidangminat_bersyarat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Minat");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mk");

	foreach ($this->Bidangminat_bersyarat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_minat);
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
        header("Content-Disposition: attachment;Filename=bidangminat_bersyarat.doc");

        $data = array(
            'bidangminat_bersyarat_data' => $this->Bidangminat_bersyarat_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('bidangminat_bersyarat/bidangminat_bersyarat_doc',$data);
    }

}

/* End of file Bidangminat_bersyarat.php */
/* Location: ./application/controllers/Bidangminat_bersyarat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-26 12:07:36 */
/* http://harviacode.com */