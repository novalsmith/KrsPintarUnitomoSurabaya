<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expertjawaban extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Expertjawaban_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {
      redirect('login');
}
    }

    public function index()
    {
        $expertjawaban = $this->Expertjawaban_model->get_all();

        $data = array(
            'expertjawaban_data' => $expertjawaban,
            'judul'      => 'Pertanyaan',
              'content'  => 'expertjawaban/ExpertJawaban_list',
              'email'    => $this->session->userdata('email'),
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Expertjawaban_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_expert_jawaban' => $row->id_expert_jawaban,
		'nama_jawaban' => $row->nama_jawaban,
		'solusi' => $row->solusi,
    'judul'      => 'Pertanyaan',
      'content'  => 'expertjawaban/ExpertJawaban_read',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertjawaban'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('expertjawaban/create_action'),
	    'id_expert_jawaban' => set_value('id_expert_jawaban'),
	    'nama_jawaban' => set_value('nama_jawaban'),
	    'solusi' => set_value('solusi'),
        'kode_jawaban' => set_value('kode_jawaban'),
      'judul'      => 'Pertanyaan',
        'content'  => 'expertjawaban/ExpertJawaban_form',
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
              'id_expert_jawaban' => $this->input->post('kode_jawaban',TRUE),
		'nama_jawaban' => $this->input->post('nama_jawaban',TRUE),
		'solusi' => $this->input->post('solusi',TRUE),
	    );

            $this->Expertjawaban_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('expertjawaban'));
        }
    }

    public function update($id)
    {
        $row = $this->Expertjawaban_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('expertjawaban/update_action'),
		'id_expert_jawaban' => set_value('id_expert_jawaban', $row->id_expert_jawaban),
		'nama_jawaban' => set_value('nama_jawaban', $row->nama_jawaban),
		'solusi' => set_value('solusi', $row->solusi),
    'judul'      => 'Pertanyaan',
      'content'  => 'expertjawaban/ExpertJawaban_form',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertjawaban'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_expert_jawaban', TRUE));
        } else {
            $data = array(
		'nama_jawaban' => $this->input->post('nama_jawaban',TRUE),
		'solusi' => $this->input->post('solusi',TRUE),
	    );

            $this->Expertjawaban_model->update($this->input->post('id_expert_jawaban', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('expertjawaban'));
        }
    }

    public function delete($id)
    {
        $row = $this->Expertjawaban_model->get_by_id($id);

        if ($row) {
            $this->Expertjawaban_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('expertjawaban'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertjawaban'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_jawaban', 'nama jawaban', 'trim|required');
	$this->form_validation->set_rules('solusi', 'solusi', 'trim|required');

	$this->form_validation->set_rules('id_expert_jawaban', 'id_expert_jawaban', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ExpertJawaban.xls";
        $judul = "ExpertJawaban";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jawaban");
	xlsWriteLabel($tablehead, $kolomhead++, "Solusi");

	foreach ($this->Expertjawaban_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jawaban);
	    xlsWriteLabel($tablebody, $kolombody++, $data->solusi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=ExpertJawaban.doc");

        $data = array(
            'ExpertJawaban_data' => $this->Expertjawaban_model->get_all(),
            'start' => 0
        );

        $this->load->view('expertjawaban/ExpertJawaban_doc',$data);
    }

}

/* End of file Expertjawaban.php */
/* Location: ./application/controllers/Expertjawaban.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-09 19:38:37 */
/* http://harviacode.com */
