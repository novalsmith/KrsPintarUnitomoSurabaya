<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
          if ($this->session->userdata('username')=="") {
            redirect('login','refresh');
        }
    }

    public function index()
    {
        $kelas = $this->Kelas_model->get_all();

        $data = array(
            'kelas_data' => $kelas,
             'content'       => 'kelas/kelas_list',
            'email' => $this->session->userdata('email'),
            'judul'     => 'Daftar Kelas',
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Kelas_model->get_by_id($id);
        if ($row) {
            $data = array(
                  'content'       => 'kelas/kelas_read',
            'email' => $this->session->userdata('email'),
            'judul'     => 'Daftar Kelas',
		'id_kelas' => $row->id_kelas,
		'nama_kelas' => $row->nama_kelas,
    'kapasitas' => $row->kapasitas,

		'keterangan' => $row->keterangan,
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function create()
    {
        $data = array(
               'content'       => 'kelas/kelas_form',
            'email' => $this->session->userdata('email'),
            'judul'     => 'Create Kelas',
            'button' => 'Create',
            'action' => site_url('kelas/create_action'),
	    'id_kelas' => set_value('id_kelas'),
	    'nama_kelas' => set_value('nama_kelas'),
      'kapasitas' => set_value('kapasitas'),

	    'keterangan' => set_value('keterangan'),
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
		'nama_kelas' => $this->input->post('nama_kelas',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
    'kapasitas' => $this->input->post('keterangan',TRUE),

	    );

            $this->Kelas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kelas'));
        }
    }

    public function update($id)
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                   'content'       => 'kelas/kelas_form',
            'email' => $this->session->userdata('email'),
            'judul'     => 'Update Kelas',
                'button' => 'Update',
                'action' => site_url('kelas/update_action'),
		'id_kelas' => set_value('id_kelas', $row->id_kelas),
		'nama_kelas' => set_value('nama_kelas', $row->nama_kelas),
		'keterangan' => set_value('keterangan', $row->keterangan),
    'kapasitas' => set_value('kapasitas', $row->kapasitas),


	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelas', TRUE));
        } else {
            $data = array(
		'nama_kelas' => $this->input->post('nama_kelas',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
    		'kapasitas' => $this->input->post('kapasitas',TRUE),
	    );

            $this->Kelas_model->update($this->input->post('id_kelas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelas'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $this->Kelas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_kelas', 'nama kelas', 'trim|required');
  $this->form_validation->set_rules('kapasitas', 'Kapasitas Ruang kelas', 'trim|required');

	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kelas.xls";
        $judul = "kelas";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Kelas");

	xlsWriteLabel($tablehead, $kolomhead++, "Kapasitas Ruang Kelas");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Kelas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kelas);
      xlsWriteLabel($tablebody, $kolombody++, $data->kapasitas);

	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kelas.doc");

        $data = array(
            'kelas_data' => $this->Kelas_model->get_all(),
            'start' => 0
        );

        $this->load->view('kelas/kelas_doc',$data);
    }

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-05 12:57:33 */
/* http://harviacode.com */
