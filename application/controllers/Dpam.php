<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dpam extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dpam_model');
        $this->load->library('form_validation');
            if ($this->session->userdata('username')== "") {
            redirect('login');
        }
    $this->load->helper('text');
    }

    public function index()
    {
       
        $dpam = $this->Dpam_model->get_all();

        $data = array(
         
        'email' => $this->session->userdata('email'),
            'dpam_data' => $dpam,
            'content'       => 'dpam/dpam_list',
            'judul'     => 'DPAM'
        );

        $this->load->view('template', $data);
    
}
    public function read($id) 
    {
 
           
        $row = $this->Dpam_model->get_by_id($id);
        if ($row) {
            $data = array(
        'content'       => 'dpam/dpam_read',
        'email' => $this->session->userdata('email'),
        'judul'     => 'DPAM Read',
        
		'id_dpam' => $row->id_dpam,
		'username' => $row->username,
		'nama_dpam' => $row->nama_dpam,
		'password' => $row->password,

	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dpam'));
        
    }
}
    public function create() 
    {
       
        $data = array(

        'email' => $this->session->userdata('email'),
             'content'       => 'dpam/dpam_form',
            'judul'     => 'DPAM Create',
            'button' => 'Create',
            'action' => site_url('dpam/create_action'),
	    'id_dpam' => set_value('id_dpam'),
	    'username' => set_value('username'),
	    'nama_dpam' => set_value('nama_dpam'),
	    'password' => set_value('password'),
	  
	);
        $this->load->view('template', $data);
    
}
    
    public function create_action() 
    {
                if ($this->session->userdata('logged_in')== FALSE) {
            redirect('login');
    }elseif ($this->session->userdata('status')=="User") {
        
         redirect('home');
    }else{
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'nama_dpam' => $this->input->post('nama_dpam',TRUE),
		'password' =>  md5($this->input->post('password',TRUE)),
		
	    );

            $this->Dpam_model->insert($data);
          $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('dpam'));
        }
    }
    }
    public function update($id) 
    {
     
       
        $row = $this->Dpam_model->get_by_id($id);

        if ($row) {
            $data = array(

        'email' => $this->session->userdata('email'),
                 'content'       => 'dpam/dpam_form',
            'judul'     => 'DPAM Update',
                'button' => 'Update',
                'action' => site_url('dpam/update_action'),
		'id_dpam' => set_value('id_dpam', $row->id_dpam),
		'username' => set_value('username', $row->username),
		'nama_dpam' => set_value('nama_dpam', $row->nama_dpam),
		'password' => set_value('password', $row->password),
	
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dpam'));
        }
    }

    
    public function update_action() 
    {
            if ($this->session->userdata('logged_in')== FALSE) {
            redirect('login');
    }elseif ($this->session->userdata('status')=="User") {
        
         redirect('home');
    }else{
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_dpam', TRUE));
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'nama_dpam' => $this->input->post('nama_dpam',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		
	    );

            $this->Dpam_model->update($this->input->post('id_dpam', TRUE), $data);
           $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update !</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('dpam'));
        }
    }

    }
    public function delete($id) 
    {
            if ($this->session->userdata('logged_in')== FALSE) {
            redirect('login');
    }elseif ($this->session->userdata('status')=="User") {
        
         redirect('home');
    }else{
        $row = $this->Dpam_model->get_by_id($id);

        if ($row) {
            $this->Dpam_model->delete($id);
           $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted !</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('dpam'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dpam'));
        }
    }
}



    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'nidn', 'trim|required');
	$this->form_validation->set_rules('nama_dpam', 'nama dpam', 'trim|required');
	$this->form_validation->set_rules('password', 'pin dpam', 'trim|required');


	$this->form_validation->set_rules('id_dpam', 'id_dpam', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "dpam.xls";
        $judul = "dpam";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nidn");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Dpam");
	xlsWriteLabel($tablehead, $kolomhead++, "Pin Dpam");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Dpam_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nidn);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_dpam);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pin_dpam);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=dpam.doc");

        $data = array(
            'dpam_data' => $this->Dpam_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('dpam/dpam_doc',$data);
    }

}

/* End of file Dpam.php */
/* Location: ./application/controllers/Dpam.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:14 */
/* http://harviacode.com */