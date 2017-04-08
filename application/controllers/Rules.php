<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rules extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rules_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {
      redirect('login');
}
    }

    public function index()
    {
        $rules = $this->Rules_model->get_all();

        $data = array(
          'judul'      => 'Rules',
            'content'  => 'rules/rules_list',
            'email'    => $this->session->userdata('email'),
            'rules_data' => $rules
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Rules_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_rules' => $row->id_rules,
		'id_pertanyaan' => $row->id_pertanyaan,
		'id_jawaban' => $row->id_jawaban,
    'judul'      => 'Rules',
      'content'  => 'rules/rules_read',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rules'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('rules/create_action'),
	    'id_rules' => set_value('id_rules'),
	    'id_pertanyaan' => set_value('id_pertanyaan'),
	    'id_jawaban' => set_value('id_jawaban'),
      'judul'      => 'Rules',
        'content'  => 'rules/rules_form',
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
		'id_pertanyaan' => $this->input->post('id_pertanyaan',TRUE),
		'id_jawaban' => $this->input->post('id_jawaban',TRUE),
	    );

            $this->Rules_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('rules'));
        }
    }

    public function update($id)
    {
        $row = $this->Rules_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('rules/update_action'),
		'id_rules' => set_value('id_rules', $row->id_rules),
		'id_pertanyaan' => set_value('id_pertanyaan', $row->id_pertanyaan),
		'id_jawaban' => set_value('id_jawaban', $row->id_jawaban),
    'judul'      => 'Rules',
      'content'  => 'rules/rules_form',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rules'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_rules', TRUE));
        } else {
            $data = array(
		'id_pertanyaan' => $this->input->post('id_pertanyaan',TRUE),
		'id_jawaban' => $this->input->post('id_jawaban',TRUE),
	    );

            $this->Rules_model->update($this->input->post('id_rules', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rules'));
        }
    }

    public function delete($id)
    {
        $row = $this->Rules_model->get_by_id($id);

        if ($row) {
            $this->Rules_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rules'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rules'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_pertanyaan', 'id pertanyaan', 'trim|required');
	$this->form_validation->set_rules('id_jawaban', 'id jawaban', 'trim|required');

	$this->form_validation->set_rules('id_rules', 'id_rules', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "rules.xls";
        $judul = "rules";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Pertanyaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Jawaban");

	foreach ($this->Rules_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_pertanyaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_jawaban);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=rules.doc");

        $data = array(
            'rules_data' => $this->Rules_model->get_all(),
            'start' => 0
        );

        $this->load->view('rules/rules_doc',$data);
    }

}

/* End of file Rules.php */
/* Location: ./application/controllers/Rules.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-09 05:40:11 */
/* http://harviacode.com */
