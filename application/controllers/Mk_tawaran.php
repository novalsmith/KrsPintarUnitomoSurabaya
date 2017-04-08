<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mk_tawaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mk_tawaran_model');
        $this->load->library('form_validation');
         if ($this->session->userdata('username')=="") {
            redirect('login','refresh');
        }
    }

    public function index()
    {
        $mk_tawaran = $this->Mk_tawaran_model->join_expert_2();

        $data = array(
            'mk_tawaran_data' => $mk_tawaran,
            'email' => $this->session->userdata('email'),
            'content'   => 'mk_tawaran/mk_tawaran_list.php',
            'judul'     => 'Tawaran Matakuliah ',
            'nama'      =>  'Matakuliah Bidang Minat'
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Mk_tawaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_mk_tawaran' => $row->id_mk_tawaran,
		'id_mk' => $row->id_mk,
		'id_semester' => $row->id_semester,
	    );
            $this->load->view('mk_tawaran/mk_tawaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mk_tawaran'));
        }
    }

    public function create()
    {
         $mk_tawaran = $this->Mk_tawaran_model->join_expert_3();
        $data = array(
            'button' => 'Create',
            'mk_tawaran_data' => $mk_tawaran,
            'action' => site_url('mk_tawaran/create_action'),
                'judul'     => 'Tawaran Matakuliah ',
	    'id_mk_tawaran' => set_value('id_mk_tawaran'),
	    'id_mk' => set_value('id_mk'),
          'email' => $this->session->userdata('email'),
            'content'   => 'mk_tawaran/mk_tawaran_form.php',
	    'id_semester' => set_value('id_semester'),
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
		'id_mk' => $this->input->post('id_mk',TRUE),
    'id_semester' => $this->input->post('id_semester',TRUE),


	    );

            $this->Mk_tawaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mk_tawaran'));
        }
    }

    public function update($id)
    {
        $row = $this->Mk_tawaran_model->get_by_id($id);
         $mk_tawaran = $this->Mk_tawaran_model->join_expert_3();

        if ($row) {
            $data = array(
                 'mk_tawaran_data' => $mk_tawaran,
    'judul'     => 'Tawaran Matakuliah ',
        'email' => $this->session->userdata('email'),
    'content'   => 'mk_tawaran/mk_tawaran_form.php',
                'button' => 'Update',
                'action' => site_url('mk_tawaran/update_action'),
		'id_mk_tawaran' => set_value('id_mk_tawaran', $row->id_mk_tawaran),
		'id_mk' => set_value('id_mk', $row->id_mk),
		'id_semester' => set_value('id_semester', $row->id_semester),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mk_tawaran'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mk_tawaran', TRUE));
        } else {
            $data = array(
		'id_mk' => $this->input->post('id_mk',TRUE),
		'id_semester' => $this->input->post('id_semester',TRUE),

	    );

            $this->Mk_tawaran_model->update($this->input->post('id_mk_tawaran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mk_tawaran'));
        }
    }

    public function delete($id)
    {
        $row = $this->Mk_tawaran_model->get_by_id($id);

        if ($row) {
            $this->Mk_tawaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mk_tawaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mk_tawaran'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_mk', 'id mk', 'trim|required');
	$this->form_validation->set_rules('id_semester', 'id semester', 'trim|required');

	$this->form_validation->set_rules('id_mk_tawaran', 'id_mk_tawaran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mk_tawaran.xls";
        $judul = "mk_tawaran";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Semester");

	foreach ($this->Mk_tawaran_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_semester);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mk_tawaran.doc");

        $data = array(
            'mk_tawaran_data' => $this->Mk_tawaran_model->get_all(),
            'start' => 0
        );

        $this->load->view('mk_tawaran/mk_tawaran_doc',$data);
    }

}

/* End of file Mk_tawaran.php */
/* Location: ./application/controllers/Mk_tawaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-08-18 13:04:43 */
/* http://harviacode.com */
