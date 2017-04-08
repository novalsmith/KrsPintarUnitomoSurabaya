<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Minat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Minat_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {
      redirect('login');
    }
  }

    public function index()
    {
        $minat = $this->Minat_model->get_all();

        $data = array(
            'minat_data' => $minat,
            'judul'      => 'Pertanyaan',
              'content'  => 'minat/minat_list',
              'email'    => $this->session->userdata('email'),
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Minat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_minat' => $row->id_minat,
		'nama_minat' => $row->nama_minat,
    'judul'      => 'Pertanyaan',
      'content'  => 'minat/minat_read',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('minat'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('minat/create_action'),
	    'id_minat' => set_value('id_minat'),
	    'nama_minat' => set_value('nama_minat'),
      'judul'      => 'Pertanyaan',
        'content'  => 'minat/minat_form',
        'email'    => $this->session->userdata('email'),
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
		'nama_minat' => $this->input->post('nama_minat',TRUE),
	    );

            $this->Minat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('minat'));
        }
    }

    public function update($id)
    {
        $row = $this->Minat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('minat/update_action'),
		'id_minat' => set_value('id_minat', $row->id_minat),
		'nama_minat' => set_value('nama_minat', $row->nama_minat),
    'judul'      => 'Pertanyaan',
      'content'  => 'minat/minat_form',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('minat'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_minat', TRUE));
        } else {
            $data = array(
		'nama_minat' => $this->input->post('nama_minat',TRUE),
	    );

            $this->Minat_model->update($this->input->post('id_minat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('minat'));
        }
    }

    public function delete($id)
    {
        $row = $this->Minat_model->get_by_id($id);

        if ($row) {
            $this->Minat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('minat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('minat'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_minat', 'nama minat', 'trim|required');

	$this->form_validation->set_rules('id_minat', 'id_minat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "minat.xls";
        $judul = "minat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Minat");

	foreach ($this->Minat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_minat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=minat.doc");

        $data = array(
            'minat_data' => $this->Minat_model->get_all(),
            'start' => 0
        );

        $this->load->view('minat/minat_doc',$data);
    }

}

/* End of file Minat.php */
/* Location: ./application/controllers/Minat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-13 15:28:55 */
/* http://harviacode.com */
