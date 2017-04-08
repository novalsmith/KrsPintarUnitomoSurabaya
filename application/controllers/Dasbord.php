<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbord extends CI_Controller {
    public $data = array('pesan'=> '',);

		public function __construct()
		{
			parent::__construct();

			//	  $this->load->library('form_validation');
			//	$this->load->model('login_model');
		}

	public function index()
	{
$data ['judul']   = 'Selemat Datang di SMART KRS Unitomo ';
$data ['heading'] = 'Login Administrator SMART KRS Unitomo';
$this->load->view('Dasbord', $data);

	}


}
