<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginmhs extends CI_Controller {
    public $data = array('pesan'=> '',);

		public function __construct()
		{
			parent::__construct();

				  $this->load->library('form_validation');
				$this->load->model('login_model');
		}

	public function index()
	{
$data ['judul']   = 'Selamat Datang di SMART KRS Unitomo ';
$data ['heading'] = 'SMART KRS Unitomo';
$this->load->view('login/loginmahasiswa', $data);

	}



public function cek_login()
{

    $this->form_validation->set_rules('nim','NIM', 'trim|required|min_length[5]|max_length[20]');
    $this->form_validation->set_rules('pin', 'PIN', 'trim|required|min_length[2]|max_length[20]');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    if ($this->form_validation->run()==FALSE) {

    $this->index();
}

else

{

    $data_mhs = array('nim' => $this->input->post('nim'),
                  'pin' => $this->input->post('pin'));


    $hasil = $this->login_model->cek_mahasiswa($data_mhs);

    if ($hasil->num_rows() == 1)
    {
      foreach ($hasil->result() as $sess) {
        $sess_data['logged_in'] = 'Sudah Loggin';
        $sess_data['id_mahasiswa'] = $sess->id_mahasiswa;

        $sess_data['nim'] = $sess->nim;
        $sess_data['pin'] = $sess->pin;
  $sess_data['nama_mahasiswa'] = $sess->nama_mahasiswa;

        $this->session->set_userdata($sess_data);
      }
        redirect('smart');



  }   else {
       $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Oppss !</strong> Password atau Username Anda salah.

                 </div>');
     redirect('loginmhs','refresh');
     // echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
    }


}

}




	     public function logout() {
        $this->session->unset_userdata('nim');
        $this->session->unset_userdata('nama_mahasiswa');

        $this->session->unset_userdata('pin');
        session_destroy();
        redirect('Dasbord');
    }

}
