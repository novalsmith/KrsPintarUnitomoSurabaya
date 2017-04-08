<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public $data = array('pesan'=> '',);

		public function __construct()
		{
			parent::__construct();
				
				  $this->load->library('form_validation');
				$this->load->model('login_model');
		}
	
	public function index()
	{
$data ['judul']   = 'Selemat Datang di SMART KRS Unitomo ';
$data ['heading'] = 'Login Administrator SMART KRS Unitomo';
$this->load->view('login/login', $data);
    
	}




public function cek_login() 
{

    $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|max_length[20]');
    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[20]');

  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    if ($this->form_validation->run()==FALSE) {
 
 $this->index();

}else
{

    $data = array('username' => $this->input->post('username'),
             'password' => md5($this->input->post('password')));
   

    $hasil = $this->login_model->cek_user($data);

    if ($hasil->num_rows() == 1) 
    {
      foreach ($hasil->result() as $sess) {
        $sess_data['logged_in'] = 'Sudah Loggin';
        $sess_data['username'] = $sess->username;
        $sess_data['password'] = $sess->password;

        $sess_data['email'] = $sess->email;
        $this->session->set_userdata($sess_data);
      }
        redirect('home');
         
    
 
  }   else {
       $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Oppss !</strong> Password atau Username Anda salah.
 
                 </div>');
     redirect('login','refresh');
     // echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
    }


}

}




	     public function logout() {
        $this->session->unset_userdata('nidn');
        $this->session->unset_userdata('status');
        session_destroy();
        redirect('login');
    }

}

