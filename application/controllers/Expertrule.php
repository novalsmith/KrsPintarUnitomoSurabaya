<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expertrule extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Expertrule_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $expertrule = $this->Expertrule_model->get_all();

        $data = array(
            'expertrule_data' => $expertrule,
            'judul'      => 'Pertanyaan',
              'content'  => 'expertrule/ExpertRule_list',
              'email'    => $this->session->userdata('email'),
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Expertrule_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_expertrule' => $row->id_expertrule,
		'id_semester' => $row->id_semester,
		'id_expert_kasus' => $row->id_expert_kasus,
		'id_expert_jawaban' => $row->id_expert_jawaban,
		'jika_ya' => $row->jika_ya,
		'jika_tidak' => $row->jika_tidak,
		'mulai' => $row->mulai,
    'judul'      => 'Pertanyaan',
      'content'  => 'expertrule/ExpertRule_read',
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertrule'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('expertrule/create_action'),
	    'id_expertrule' => set_value('id_expertrule'),
	    'id_semester' => set_value('id_semester'),
	    'id_expert_kasus' => set_value('id_expert_kasus'),
	    'id_expert_jawaban' => set_value('id_expert_jawaban'),
	    'jika_ya' => set_value('jika_ya'),
	    'jika_tidak' => set_value('jika_tidak'),
	    'mulai' => set_value('mulai'),
      'judul'      => 'Pertanyaan',
        'content'  => 'expertrule/ExpertRule_form',
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
		'id_semester' => $this->input->post('id_semester',TRUE),
		'id_expert_kasus' => $this->input->post('id_expert_kasus',TRUE),
		'id_expert_jawaban' => $this->input->post('id_expert_jawaban',TRUE),
		'jika_ya' => $this->input->post('jika_ya',TRUE),
		'jika_tidak' => $this->input->post('jika_tidak',TRUE),
		'mulai' => $this->input->post('mulai',TRUE),
	    );

            $this->Expertrule_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('expertrule'));
        }
    }

    public function update($id)
    {
        $row = $this->Expertrule_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('expertrule/update_action'),
		'id_expertrule' => set_value('id_expertrule', $row->id_expertrule),
		'id_semester' => set_value('id_semester', $row->id_semester),
		'id_expert_kasus' => set_value('id_expert_kasus', $row->id_expert_kasus),
		'id_expert_jawaban' => set_value('id_expert_jawaban', $row->id_expert_jawaban),
		'jika_ya' => set_value('jika_ya', $row->jika_ya),
		'jika_tidak' => set_value('jika_tidak', $row->jika_tidak),
		'mulai' => set_value('mulai', $row->mulai),
    'judul'      => 'Pertanyaan',
      'content'  => 'expertrule/ExpertRule_form',
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertrule'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_expertrule', TRUE));
        } else {
            $data = array(
		'id_semester' => $this->input->post('id_semester',TRUE),
		'id_expert_kasus' => $this->input->post('id_expert_kasus',TRUE),
		'id_expert_jawaban' => $this->input->post('id_expert_jawaban',TRUE),
		'jika_ya' => $this->input->post('jika_ya',TRUE),
		'jika_tidak' => $this->input->post('jika_tidak',TRUE),
		'mulai' => $this->input->post('mulai',TRUE),
	    );

            $this->Expertrule_model->update($this->input->post('id_expertrule', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('expertrule'));
        }
    }

    public function delete($id)
    {
        $row = $this->Expertrule_model->get_by_id($id);

        if ($row) {
            $this->Expertrule_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('expertrule'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('expertrule'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_semester', 'id semester', 'trim|required');
	$this->form_validation->set_rules('id_expert_kasus', 'id expert kasus', 'trim|required');
	$this->form_validation->set_rules('id_expert_jawaban', 'id expert jawaban', 'trim|required');
	$this->form_validation->set_rules('jika_ya', 'jika ya', 'trim|required');
	$this->form_validation->set_rules('jika_tidak', 'jika tidak', 'trim|required');
	$this->form_validation->set_rules('mulai', 'mulai', 'trim|required');

	$this->form_validation->set_rules('id_expertrule', 'id_expertrule', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ExpertRule.xls";
        $judul = "ExpertRule";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Expert Kasus");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Expert Jawaban");
	xlsWriteLabel($tablehead, $kolomhead++, "Jika Ya");
	xlsWriteLabel($tablehead, $kolomhead++, "Jika Tidak");
	xlsWriteLabel($tablehead, $kolomhead++, "Mulai");

	foreach ($this->Expertrule_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_semester);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_expert_kasus);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_expert_jawaban);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jika_ya);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jika_tidak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mulai);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=ExpertRule.doc");

        $data = array(
            'ExpertRule_data' => $this->Expertrule_model->get_all(),
            'start' => 0
        );

        $this->load->view('expertrule/ExpertRule_doc',$data);
    }

}

/* End of file Expertrule.php */
/* Location: ./application/controllers/Expertrule.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-09 19:38:46 */
/* http://harviacode.com */
