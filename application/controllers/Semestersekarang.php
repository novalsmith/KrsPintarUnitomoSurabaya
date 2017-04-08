<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Semestersekarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Semestersekarang_model');
        $this->load->library('form_validation');
              if ($this->session->userdata('username')=="") {
            redirect('login');

 }
    $this->load->helper('text');
    }

    public function index()
    {
        $semestersekarang = $this->Semestersekarang_model->get_all();

        $data = array(
            'email' => $this->session->userdata('email'),
            'semestersekarang_data' => $semestersekarang,
            'judul' => 'Semester Sekarang',
            'content' => 'semestersekarang/semester_sekarang_list'
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Semestersekarang_model->get_by_id($id);
        if ($row) {
            $data = array(
           'judul' => 'Semester Sekarang',
            'content' => 'semestersekarang/semester_sekarang_read',
            'email' => $this->session->userdata('email'),
		'id_semester_sekarang' => $row->id_semester_sekarang,
		'sekarang' => $row->sekarang,
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('semestersekarang'));
        }
    }

    public function create()
    {
        $data = array(

            'email' => $this->session->userdata('email'),
            'button' => 'Create',
                       'judul' => 'Semester Sekarang',
            'content' => 'semestersekarang/semester_sekarang_form',
            'action' => site_url('semestersekarang/create_action'),
	    'id_semester_sekarang' => set_value('id_semester_sekarang'),
	    'sekarang' => set_value('sekarang'),
      'tahun_ajaran' => set_value('tahun_ajaran'),

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
		'sekarang' => $this->input->post('sekarang',TRUE),
    'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE), );
      $this->Semestersekarang_model->insert($data);

 $this->session->set_flashdata('message',
  '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success Create!</strong> Your Data is Successful.
   </div>');
          redirect(site_url('semestersekarang'));
      }
  }

    public function update($id)
    {
        $row = $this->Semestersekarang_model->get_by_id($id);

        if ($row) {
            $data = array(

             'email' => $this->session->userdata('email'),
            'button' => 'Update',
             'judul' => 'Semester Sekarang',
           'content' => 'semestersekarang/semester_sekarang_form',
            'action' => site_url('semestersekarang/update_action'),
'id_semester_sekarang' => set_value('id_semester_sekarang', $row->id_semester_sekarang),
		'sekarang' => set_value('sekarang', $row->sekarang),
    'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),);
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('semestersekarang'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_semester_sekarang', TRUE));
        } else {
            $data = array(
		'sekarang' => $this->input->post('sekarang',TRUE),
    'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
	    );
    $this->Semestersekarang_model->update($this->input->post('id_semester_sekarang', TRUE), $data);
    $this->session->set_flashdata('message',
    '<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success Update!</strong> Your Data is Successful.
     </div>');


            redirect(site_url('semestersekarang'));
        }
    }

    public function delete($id)
    {
        $row = $this->Semestersekarang_model->get_by_id($id);

        if ($row) {
            $this->Semestersekarang_model->delete($id);



 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted!</strong> Your Data is Successful.

                 </div>');

            redirect(site_url('semestersekarang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('semestersekarang'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('sekarang', 'sekarang', 'trim|required');

	$this->form_validation->set_rules('id_semester_sekarang', 'id_semester_sekarang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "semester_sekarang.xls";
        $judul = "semester_sekarang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Sekarang");

	foreach ($this->Semestersekarang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->sekarang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=semester_sekarang.doc");

        $data = array(
            'semester_sekarang_data' => $this->Semestersekarang_model->get_all(),
            'start' => 0
        );

        $this->load->view('semestersekarang/semester_sekarang_doc',$data);
    }

}

/* End of file Semestersekarang.php */
/* Location: ./application/controllers/Semestersekarang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-08 16:47:57 */
/* http://harviacode.com */
