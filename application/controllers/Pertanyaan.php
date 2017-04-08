<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pertanyaan_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {
      redirect('login');
}
    }

    public function index()
    {
        $pertanyaan = $this->Pertanyaan_model->get_all();

        $data = array(
            'pertanyaan_data' => $pertanyaan,
            'judul'      => 'Pertanyaan',
              'content'  => 'pertanyaan/pertanyaan_list',
              'email'    => $this->session->userdata('email'),
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Pertanyaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pertanyaan' => $row->id_pertanyaan,
		'id_semester' => $row->id_semester,
		'nama_pertanyaan' => $row->nama_pertanyaan,
		'jika_ya' => $row->jika_ya,
		'jika_tidak' => $row->jika_tidak,
    'mulai' => $row->mulai,

    'judul'      => 'Read pertanyaan',
      'content'  => 'pertanyaan/pertanyaan_read',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pertanyaan'));
        }
    }

    public function create()
    {

    $data = array(
      'judul'      => 'Rule Pertanyaan',
      'content'  => 'pertanyaan/pertanyaan_form',
      'email'    => $this->session->userdata('email'),
      'button' => 'Create',
      'action' => site_url('pertanyaan/create_action'),
	    'id_pertanyaan' => set_value('id_pertanyaan'),
	    'id_semester' => set_value('id_semester'),
	    'nama_pertanyaan' => set_value('nama_pertanyaan'),
      'mulai' => set_value('mulai'),
	    'jika_ya' => set_value('jika_ya'),
	    'jika_tidak' => set_value('jika_tidak'),

	);
        $this->load->view('template', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
$id_semester = $this->input->post('id_semester');
$mulai = $this->input->post('mulai');

if ($mulai=='Y') {
  # code...

  // mulai pertanyaan jika mulai Y lebih dari satu data
  $mulaicek = $this->db->query('select * from pertanyaan where id_semester='.$id_semester.' and mulai="Y" ')->num_rows();
  // mulai pertanyaan

  if ($mulaicek >0) {
    # code...

     $this->session->set_flashdata('message',
                    '<div class="alert alert-danger">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Maaf!</strong> Pernyataan (Y) untuk memulai Pertanyaan Sudah Ada <br> Dalam satu semester hanya di perbolehkan Satu Pernyataan Permulaan Pertanyaan dengan Kondisi (Y).

                     </div>');
                     redirect(site_url('pertanyaan/create'));
  }else {
    # code...

              $data = array(

      'id_pertanyaan' => $this->input->post('tanya',TRUE),
  		'id_semester' => $this->input->post('id_semester',TRUE),
  		'nama_pertanyaan' => $this->input->post('nama_pertanyaan',TRUE),

      'jika_ya' => $this->input->post('jika_ya',TRUE),
      'jika_tidak' => $this->input->post('jika_tidak',TRUE),

      'mulai' => $this->input->post('mulai',TRUE),

  	    );

              $this->Pertanyaan_model->insert($data);
              $this->session->set_flashdata('message', 'Create Record Success');
              redirect(site_url('pertanyaan'));
          }



} else {

    $data = array(

    'id_pertanyaan' => $this->input->post('tanya',TRUE),
		'id_semester' => $this->input->post('id_semester',TRUE),
		'nama_pertanyaan' => $this->input->post('nama_pertanyaan',TRUE),
    'jika_ya' => $this->input->post('jika_ya',TRUE),
    'jika_tidak' => $this->input->post('jika_tidak',TRUE),
    'mulai' => $this->input->post('mulai',TRUE),
    );

    $this->Pertanyaan_model->insert($data);
    $this->session->set_flashdata('message', 'Create Record Success');
    redirect(site_url('pertanyaan'));
}
  }
}
    public function update($id)
    {
        $row = $this->Pertanyaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pertanyaan/update_action'),
		'id_pertanyaan' => set_value('id_pertanyaan', $row->id_pertanyaan),
		'id_semester' => set_value('id_semester', $row->id_semester),
		'nama_pertanyaan' => set_value('nama_pertanyaan', $row->nama_pertanyaan),
		'jika_ya' => set_value('jika_ya', $row->jika_ya),
		'jika_tidak' => set_value('jika_tidak', $row->jika_tidak),

    'mulai' => set_value('mulai', $row->mulai),
    'judul'      => 'Rule Pertanyaan',
      'content'  => 'pertanyaan/pertanyaan_form',
      'email'    => $this->session->userdata('email'),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pertanyaan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pertanyaan', TRUE));
        } else {
            $data = array(
		'id_semester' => $this->input->post('id_semester',TRUE),
		'nama_pertanyaan' => $this->input->post('nama_pertanyaan',TRUE),
    'jika_ya' => $this->input->post('jika_ya',TRUE),
		'jika_tidak' => $this->input->post('jika_tidak',TRUE),
    'mulai' => $this->input->post('mulai',TRUE),

      );

            $this->Pertanyaan_model->update($this->input->post('id_pertanyaan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pertanyaan'));
            
        }
    }

    public function delete($id)
    {
        $row = $this->Pertanyaan_model->get_by_id($id);

        if ($row) {
            $this->Pertanyaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pertanyaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pertanyaan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_semester', 'id semester', 'trim|required');
	$this->form_validation->set_rules('nama_pertanyaan', 'nama pertanyaan', 'trim|required');


//	$this->form_validation->set_rules('tanya', 'Kode Pertanyaan', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pertanyaan.xls";
        $judul = "pertanyaan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pertanyaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Jika Ya");
	xlsWriteLabel($tablehead, $kolomhead++, "Jika Tidak");

	foreach ($this->Pertanyaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_semester);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pertanyaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jika_ya);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jika_tidak);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pertanyaan.doc");

        $data = array(
            'pertanyaan_data' => $this->Pertanyaan_model->get_all(),
            'start' => 0
        );

        $this->load->view('pertanyaan/pertanyaan_doc',$data);
    }

}

/* End of file Pertanyaan.php */
/* Location: ./application/controllers/Pertanyaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-09 05:39:51 */
/* http://harviacode.com */
