<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $menu = $this->Menu_model->get_all();

        $data = array(
            'menu_data' => $menu
        );

        $this->load->view('menu/menu_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Menu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_menu' => $row->id_menu,
		'parent_id' => $row->parent_id,
		'menu' => $row->menu,
		'menu_order' => $row->menu_order,
		'isi_menu' => $row->isi_menu,
	    );
            $this->load->view('menu/menu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('menu/create_action'),
	    'id_menu' => set_value('id_menu'),
	    'parent_id' => set_value('parent_id'),
	    'menu' => set_value('menu'),
	    'menu_order' => set_value('menu_order'),
	    'isi_menu' => set_value('isi_menu'),
	);
        $this->load->view('menu/menu_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'parent_id' => $this->input->post('parent_id',TRUE),
		'menu' => $this->input->post('menu',TRUE),
		'menu_order' => $this->input->post('menu_order',TRUE),
		'isi_menu' => $this->input->post('isi_menu',TRUE),
	    );

            $this->Menu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu/update_action'),
		'id_menu' => set_value('id_menu', $row->id_menu),
		'parent_id' => set_value('parent_id', $row->parent_id),
		'menu' => set_value('menu', $row->menu),
		'menu_order' => set_value('menu_order', $row->menu_order),
		'isi_menu' => set_value('isi_menu', $row->isi_menu),
	    );
            $this->load->view('menu/menu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_menu', TRUE));
        } else {
            $data = array(
		'parent_id' => $this->input->post('parent_id',TRUE),
		'menu' => $this->input->post('menu',TRUE),
		'menu_order' => $this->input->post('menu_order',TRUE),
		'isi_menu' => $this->input->post('isi_menu',TRUE),
	    );

            $this->Menu_model->update($this->input->post('id_menu', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $this->Menu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('parent_id', 'parent id', 'trim|required');
	$this->form_validation->set_rules('menu', 'menu', 'trim|required');
	$this->form_validation->set_rules('menu_order', 'menu order', 'trim|required');
	$this->form_validation->set_rules('isi_menu', 'isi menu', 'trim|required');

	$this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "menu.xls";
        $judul = "menu";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Parent Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Menu");
	xlsWriteLabel($tablehead, $kolomhead++, "Menu Order");
	xlsWriteLabel($tablehead, $kolomhead++, "Isi Menu");

	foreach ($this->Menu_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->parent_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->menu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->menu_order);
	    xlsWriteLabel($tablebody, $kolombody++, $data->isi_menu);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=menu.doc");

        $data = array(
            'menu_data' => $this->Menu_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('menu/menu_doc',$data);
    }

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-03-16 02:42:22 */
/* http://harviacode.com */