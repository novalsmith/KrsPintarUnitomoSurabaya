<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
                 if ($this->session->userdata('logged_in')== FALSE) {
            redirect('login');
    }elseif ($this->session->userdata('status')=="User") {

         redirect('home');
    }
      $this->load->helper('text');

    }


    public function index()
    {
        
        $admin = $this->Admin_model->get_all();

        $data = array(
               'nidn' => $this->session->userdata('nidn'),

        'email' => $this->session->userdata('email'),
            'admin_data' => $admin,
            'content'   => 'admin/admin_list',
            'judul'     =>  'Selamat Datang di SMART KRS Unitomo'
        );

        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->Admin_model->get_by_id($id);
        if ($row) {
            $data = array(
                   'nidn' => $this->session->userdata('nidn'),

        'email' => $this->session->userdata('email'),

                 'content' => 'admin/admin_read',
            'judul'  => 'Create Admin',
		'id_admin' => $row->id_admin,
		'username' => $row->username,
		'password' => $row->password,
		'email' => $row->email,
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function create()
    {
        $data = array(
               'nidn' => $this->session->userdata('nidn'),

        'nama_dpam' => $this->session->userdata('nama_dpam'),
            'button' => 'Create',
            'content' => 'admin/admin_form',
            'judul'  => 'Create Admin',
            'action' => site_url('admin/create_action'),
	    'id_admin' => set_value('id_admin'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'email' => set_value('email'),
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
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin'));
        }
    }

    public function update($id)
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                         'nidn' => $this->session->userdata('nidn'),

        'nama_dpam' => $this->session->userdata('nama_dpam'),
                'button' => 'Update',
                 'content' => 'admin/admin_form',
            'judul'  => 'Create Admin',
                'action' => site_url('admin/update_action'),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'email' => set_value('email', $row->email),
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_admin', TRUE));
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Admin_model->update($this->input->post('id_admin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin'));
        }
    }

    public function delete($id)
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $this->Admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('id_admin', 'id_admin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "admin.xls";
        $judul = "admin";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");

	foreach ($this->Admin_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=admin.doc");

        $data = array(
            'admin_data' => $this->Admin_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin/admin_doc',$data);
    }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-06 08:26:06 */
/* http://harviacode.com */
