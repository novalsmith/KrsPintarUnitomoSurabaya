<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_mk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_mk_model');
        $this->load->library('form_validation');

            if ($this->session->userdata('username')== "") {
            redirect('login');
        }
    $this->load->helper('text');
    }

    public function index()
    {
        $jadwal_mk = $this->Jadwal_mk_model->gel_join();

        $data = array(
            'email' => $this->session->userdata('email'),

            'jadwal_mk_data' => $jadwal_mk,
              'content'       => 'jadwal_mk/jadwal_mk_list',
            'judul'     => 'Jadwal Matakuliah'
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Jadwal_mk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jadwal' => $row->id_jadwal,
		'id_mk' => $row->id_mk,
		'jam_masuk' => $row->jam_masuk,
		'jam_selesai' => $row->jam_selesai,
		'ruangan' => $row->ruangan,
		'hari' => $row->hari,
	    );
            $this->load->view('jadwal_mk/jadwal_mk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_mk'));
        }
    }

    public function create()
    {

        $jadwal_mk = $this->Jadwal_mk_model->get_mk_tawaran();

        $data = array(
        'mk_tawaran'    => $jadwal_mk,
        'content'       => 'jadwal_mk/jadwal_mk_form',
        'judul'     => 'create Jadwal Matakuliah',
        'email' => $this->session->userdata('email'),
        'button' => 'Create',
        'action' => site_url('jadwal_mk/create_action'),
	    'id_jadwal' => set_value('id_jadwal'),
	    'id_mk_tawaran' => set_value('id_mk_tawaran'),
	    'jam_masuk' => set_value('jam_masuk'),
	    'jam_selesai' => set_value('jam_selesai'),
	    'id_ruang_kuliah' => set_value('id_ruang_kuliah'),
	    'hari' => set_value('hari'),
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

		'jam_masuk' => $this->input->post('jam_masuk',TRUE),
		'jam_selesai' => $this->input->post('jam_selesai',TRUE),
		'id_ruang_kuliah' => $this->input->post('id_ruang_kuliah',TRUE),
		'hari' => $this->input->post('hari',TRUE),
        'id_mk_tawaran' => $this->input->post('id_mk_tawaran',TRUE),
	    );

            $this->Jadwal_mk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jadwal_mk'));
        }
    }

    public function update($id)
    {
                $jadwal_mk = $this->Jadwal_mk_model->get_mk_tawaran();

        $row = $this->Jadwal_mk_model->get_by_id($id);

        if ($row) {
            $data = array(

            'mk_tawaran'      => $jadwal_mk,
            'content'         => 'jadwal_mk/jadwal_mk_form',
            'judul'           => 'Update Jadwal Matakuliah',
            'email'           => $this->session->userdata('email'),
            'button'          => 'Update',
            'action'          => site_url('jadwal_mk/update_action'),
    		'id_jadwal'       => set_value('id_jadwal', $row->id_jadwal),
    		'id_mk_tawaran'           => set_value('id_mk_tawaran', $row->id_mk_tawaran),
    		'jam_masuk'       => set_value('jam_masuk', $row->jam_masuk),
    		'jam_selesai'     => set_value('jam_selesai', $row->jam_selesai),
    		'id_ruang_kuliah' => set_value('  id_ruang_kuliah', $row->  id_ruang_kuliah),
    		'hari'            => set_value('hari', $row->hari),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_mk'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jadwal', TRUE));
        } else {
            $data = array(
		'jam_masuk' => $this->input->post('jam_masuk',TRUE),
		'jam_selesai' => $this->input->post('jam_selesai',TRUE),
		'id_ruang_kuliah' => $this->input->post('id_ruang_kuliah',TRUE),
		'hari' => $this->input->post('hari',TRUE),
                'id_mk_tawaran' => $this->input->post('id_mk_tawaran',TRUE),

	    );

            $this->Jadwal_mk_model->update($this->input->post('id_jadwal', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jadwal_mk'));
        }
    }

    public function delete($id)
    {
        $row = $this->Jadwal_mk_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_mk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jadwal_mk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_mk'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_mk_tawaran', 'Matakuliah', 'trim|required');
	$this->form_validation->set_rules('jam_masuk', 'jam masuk', 'trim|required');
	$this->form_validation->set_rules('jam_selesai', 'jam selesai', 'trim|required');
	$this->form_validation->set_rules('id_ruang_kuliah', 'ruangan', 'trim|required');
	$this->form_validation->set_rules('hari', 'hari', 'trim|required');

	$this->form_validation->set_rules('id_jadwal', 'id_jadwal', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jadwal_mk.xls";
        $judul = "jadwal_mk";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mk");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam Selesai");
	xlsWriteLabel($tablehead, $kolomhead++, "Ruangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Hari");

	foreach ($this->Jadwal_mk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kelas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_selesai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_ruang_kuliah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->hari);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jadwal_mk.doc");

        $data = array(
            'jadwal_mk_data' => $this->Jadwal_mk_model->get_all(),
            'start' => 0
        );

        $this->load->view('jadwal_mk/jadwal_mk_doc',$data);
    }

}

/* End of file Jadwal_mk.php */
/* Location: ./application/controllers/Jadwal_mk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-05 12:56:45 */
/* http://harviacode.com */
