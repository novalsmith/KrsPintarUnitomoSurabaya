<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paketmatakuliah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Paketmatakuliah_model');
        $this->load->library('form_validation');
    
    if ($this->session->userdata('email')=='') {
        redirect('login','refresh');
    }
    $this->load->helper('text');

    }


public function cek_sess()
{
   
}
    public function index()
    {
        $paketmatakuliah = $this->Paketmatakuliah_model->get_all();

        $data = array(
            'content' => 'paketmatakuliah/paket_mk_list',
            'email' => $this->session->userdata('email'),
            'judul' => 'Paket Matakuliah',
            'paketmatakuliah_data' => $paketmatakuliah
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->Paketmatakuliah_model->get_by_id($id);
        if ($row) {
            $data = array(
'content' => 'paketmatakuliah/paket_mk_read',
            'email' => $this->session->userdata('email'),
            'judul' => 'Read Paket Matakuliah',
		'id_paket' => $row->id_paket,
		'id_semester' => $row->id_semester,
		'id_mk' => $row->id_mk,
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paketmatakuliah'));
        }
    }

    public function create() 
    {
        $data = array(
'content' => 'paketmatakuliah/paket_mk_form',
            'email' => $this->session->userdata('email'),
            'judul' => 'Create Paket Matakuliah',
            'button' => 'Create',
            'action' => site_url('paketmatakuliah/create_action'),
	    'id_paket' => set_value('id_paket'),
	    'id_semester' => set_value('id_semester'),
	    'id_mk' => set_value('id_mk'),
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
		'id_semester' => $this->input->post('id_semester',TRUE),
		'id_mk' => $this->input->post('id_mk',TRUE),
	    );

            $this->Paketmatakuliah_model->insert($data);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('paketmatakuliah'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Paketmatakuliah_model->get_by_id($id);

        if ($row) {
            $data = array(
            
            'content' => 'paketmatakuliah/paket_mk_form',
            'email' => $this->session->userdata('email'),
            'judul' => 'Update Paket Matakuliah',
                'button' => 'Update',
                'action' => site_url('paketmatakuliah/update_action'),
		'id_paket' => set_value('id_paket', $row->id_paket),
		'id_semester' => set_value('id_semester', $row->id_semester),
		'id_mk' => set_value('id_mk', $row->id_mk),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paketmatakuliah'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_paket', TRUE));
        } else {
            $data = array(
		'id_semester' => $this->input->post('id_semester',TRUE),
		'id_mk' => $this->input->post('id_mk',TRUE),
	    );

            $this->Paketmatakuliah_model->update($this->input->post('id_paket', TRUE), $data);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Updated!</strong> Your Data is Successful.
 
                 </div>');


            redirect(site_url('paketmatakuliah'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Paketmatakuliah_model->get_by_id($id);

        if ($row) {
            $this->Paketmatakuliah_model->delete($id);


 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted !</strong> Your Data is Successful.
 
                 </div>');

            redirect(site_url('paketmatakuliah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paketmatakuliah'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_semester', 'id semester', 'trim|required');
	$this->form_validation->set_rules('id_mk', 'id mk', 'trim|required');

	$this->form_validation->set_rules('id_paket', 'id_paket', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "paket_mk.xls";
        $judul = "paket_mk";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mk");

	foreach ($this->Paketmatakuliah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_semester);
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
        header("Content-Disposition: attachment;Filename=paket_mk.doc");

        $data = array(
            'paket_mk_data' => $this->Paketmatakuliah_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('paketmatakuliah/paket_mk_doc',$data);
    }

}

/* End of file Paketmatakuliah.php */
/* Location: ./application/controllers/Paketmatakuliah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-12 05:31:42 */
/* http://harviacode.com */