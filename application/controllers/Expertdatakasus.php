<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expertdatakasus extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Expertdatakasus_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {
      redirect('login');
}
    }

    public function index()
    {
        $expertdatakasus = $this->Expertdatakasus_model->get_all();

        $data = array(
            'expertdatakasus_data' => $expertdatakasus,
            'judul'      => 'Pertanyaan',
              'content'  => 'expertdatakasus/ExpertDataKasus_list',
              'email'    => $this->session->userdata('email'),
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Expertdatakasus_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_expert_kasus' => $row->id_expert_kasus,
		'nama_DataKasus' => $row->nama_DataKasus,
		'keterangan' => $row->keterangan,
    'judul'      => 'Pertanyaan',
      'content'  => 'expertdatakasus/ExpertDataKasus_read',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertdatakasus'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('expertdatakasus/create_action'),
	    'id_expert_kasus' => set_value('id_expert_kasus'),
	    'nama_DataKasus' => set_value('nama_DataKasus'),
	    'keterangan'     => set_value('keterangan'),
      'kode_DataKasus' => set_value('kode_DataKasus'),
      'judul'      => 'Pertanyaan',
        'content'  => 'expertdatakasus/ExpertDataKasus_form',
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
              'id_expert_kasus' => $this->input->post('kode_DataKasus',TRUE),
		'nama_DataKasus' => $this->input->post('nama_DataKasus',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Expertdatakasus_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('expertdatakasus'));
        }
    }

    public function update($id)
    {
        $row = $this->Expertdatakasus_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('expertdatakasus/update_action'),
		'id_expert_kasus' => set_value('id_expert_kasus', $row->id_expert_kasus),
		'nama_DataKasus' => set_value('nama_DataKasus', $row->nama_DataKasus),
		'keterangan' => set_value('keterangan', $row->keterangan),
    'judul'      => 'Pertanyaan',
      'content'  => 'expertdatakasus/ExpertDataKasus_form',
      'email'    => $this->session->userdata('email'),

	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertdatakasus'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_expert_kasus', TRUE));
        } else {
            $data = array(
		'nama_DataKasus' => $this->input->post('nama_DataKasus',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Expertdatakasus_model->update($this->input->post('id_expert_kasus', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('expertdatakasus'));
        }
    }

    public function delete($id)
    {
        $row = $this->Expertdatakasus_model->get_by_id($id);

        if ($row) {
            $this->Expertdatakasus_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('expertdatakasus'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertdatakasus'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_DataKasus', 'nama datakasus', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_expert_kasus', 'id_expert_kasus', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ExpertDataKasus.xls";
        $judul = "ExpertDataKasus";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama DataKasus");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Expertdatakasus_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_DataKasus);
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
        header("Content-Disposition: attachment;Filename=ExpertDataKasus.doc");

        $data = array(
            'ExpertDataKasus_data' => $this->Expertdatakasus_model->get_all(),
            'start' => 0
        );

        $this->load->view('expertdatakasus/ExpertDataKasus_doc',$data);
    }

}

/* End of file Expertdatakasus.php */
/* Location: ./application/controllers/Expertdatakasus.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-09 19:38:27 */
/* http://harviacode.com */
