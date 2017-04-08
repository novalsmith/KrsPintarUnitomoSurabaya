<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Nilai_model');
        $this->load->library('form_validation');
 if ($this->session->userdata('username')=="") {
            redirect('login','refresh');
        }
    $this->load->helper('text');
    }

    public function index()
    {



            $data['email']     = $this->session->userdata('email');
         $data['content'] = 'nilai/nilai_list.php';
         $data['judul']    = 'Nilai ';
         $data['nama']    = 'Data Nilai';
         $data['nilai_data'] = $this->Nilai_model->get_all();
         $data['nilai_join'] =$this->Nilai_model->data_nilai();
           $data['nidn'] = $this->session->userdata('nidn');

        $data['nama_dpam'] = $this->session->userdata('nama_dpam');
         $this->load->view('template',$data);


    }

    public function read($id)
    {



        $row = $this->Nilai_model->get_by_id($id);
        if ($row) {
            $data = array(
         'email' => $this->session->userdata('email'),
        'nama_dpam' => $this->session->userdata('nama_dpam'),
        'content' => 'nilai/nilai_read.php',
        'judul'    => 'Nilai Read ',
        'nama'    => 'Data Nilai',
		'id_nilai' => $row->id_nilai,
		'nama_matakuliah' => $row->nama_matakuliah,
		'nama_mahasiswa' => $row->nama_mahasiswa,
		'nama_semester' => $row->nama_semester,
		'tugas' => $row->tugas,
		'uts' => $row->uts,
		'uas' => $row->uas,
        'huruf'=>$row->huruf
	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai'));
        }
    }


    public function create()
    {



        $data = array(
             'email' => $this->session->userdata('email'),
        'nama_dpam' => $this->session->userdata('nama_dpam'),
            'content' => 'nilai/nilai_form.php',
        'judul'    => 'Nilai Read ',
        'nama'    => 'Data Nilai',
            'button' => 'Create',
            'action' => site_url('nilai/create_action'),
	    'id_nilai' => set_value('id_nilai'),
	    'id_mk' => set_value('id_mk'),
	    'id_mahasiswa' => set_value('id_mahasiswa'),
	    'id_semester' => set_value('id_semester'),
	    'tugas' => set_value('tugas'),
	    'uts' => set_value('uts'),
	    'uas' => set_value('uas'),


	);
        $this->load->view('template', $data);
    }


    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {


           $data_sks=$this->input->post('id_mk',TRUE);
   $sks= $this->db->get_where('matakuliah',array('id_mk'=>$data_sks))->row();
  //batas sks................


                $uts = $this->input->post('uts',TRUE);
            $tugas = $this->input->post('tugas',TRUE);
            $uas = $this->input->post('uas',TRUE);
            $hitung = ($uas+$tugas+$uts)/3;

        // Hitung range HURUF

           $huruf =  $this->input->post('huruf',TRUE);

           if ($hitung >=86 && 100 <=100) {



                    $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'A',
        'bobot' => 4,
        'sks'   => $sks->sks,
        'mutu'  => 4*$sks->sks
        );

            $this->Nilai_model->insert($data);

         $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');


            redirect(site_url('nilai'));
           }
           elseif($hitung>=80 && 86 <= 86)
           {


             $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'A-',
          'bobot' => 3.75,
         'sks'   => $sks->sks,
         'mutu'  => 3.75*$sks->sks
        );

            $this->Nilai_model->insert($data);

         $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');

            redirect(site_url('nilai'));

           }
           elseif($hitung >=76 && 80 <= 80)
           {

     $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'B+',
          'bobot' => 3.5,
         'sks'   => $sks->sks,
         'mutu'  => 3.5*$sks->sks
        );

            $this->Nilai_model->insert($data);

         $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');



            redirect(site_url('nilai'));


           }
           elseif($hitung >=70 && 76 <= 76 )
           {

                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'B',
          'bobot' => 3,
         'sks'   => $sks->sks,
         'mutu'  => 3*$sks->sks
        );

            $this->Nilai_model->insert($data);


         $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');


            redirect(site_url('nilai'));
           }

           elseif($hitung >=66 && 70<=70 )
           {

                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'B-',
          'bobot' => 2.75,
         'sks'   => $sks->sks,
         'mutu'  => 2.75*$sks->sks
        );

            $this->Nilai_model->insert($data);

         $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');

            redirect(site_url('nilai'));

           }

           elseif($hitung >=60 && 66<=66)
           {

                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'C+',
          'bobot' => 2.5,
         'sks'   => $sks->sks,
         'mutu'  => 2.5*$sks->sks
        );

            $this->Nilai_model->insert($data);

         $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');

            redirect(site_url('nilai'));

           }

           elseif($hitung >=56 && 60<=60)
           {
                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'C',
          'bobot' => 2,
         'sks'   => $sks->sks,
         'mutu'  => 2*$sks->sks
        );

            $this->Nilai_model->insert($data);


         $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');

            redirect(site_url('nilai'));
           }

           elseif($hitung >= 36 && 56 <= 56 )
           {

                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'D',
          'bobot' => 1,
         'sks'   => $sks->sks,
         'mutu'  => 1*$sks->sks
        );

            $this->Nilai_model->insert($data);


         $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');

            redirect(site_url('nilai'));

           }
           else
           {
                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'E',
          'bobot' => 0,
         'sks'   => $sks->sks,
         'mutu'  => 0*$sks->sks
        );

            $this->Nilai_model->insert($data);
           $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved !</strong> Your Data is Successful.

                 </div>');
            redirect(site_url('nilai'));
           }


        }




    }

    public function update($id)
    {




        $row = $this->Nilai_model->get_by_id($id);


        if ($row) {
            $data = array(
 'email' => $this->session->userdata('email'),
        'edit'          => $this->db->get_where('nilai', array('id_nilai' => $id))->row(),
        'mk'            => $this->db->get('matakuliah')->result(),
        'content'       => 'nilai/nilai_form.php',
        'judul'         => 'Nilai Read ',
        'nama'          => 'Data Nilai',
        'button'        => 'Update',
        'action'        => site_url('nilai/update_action'),
		'id_nilai'      => set_value('id_nilai', $row->id_nilai),
		'id_mk'         => set_value('id_mk', $row->id_mk),
		'id_mahasiswa'  => set_value('id_mahasiswa', $row->id_mahasiswa),
		'id_semester'   => set_value('id_semester', $row->id_semester),
		'tugas'         => set_value('tugas', $row->tugas),
		'uts'           => set_value('uts', $row->uts),
		'uas'           => set_value('uas', $row->uas),


	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai'));
        }

}

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_nilai', TRUE));
        } else {


           $data_sks=$this->input->post('id_mk',TRUE);
   $sks= $this->db->get_where('matakuliah',array('id_mk'=>$data_sks))->row();


               // $sks = $this->input->post('sks',TRUE);

                $uts = $this->input->post('uts',TRUE);
            $tugas = $this->input->post('tugas',TRUE);
            $uas = $this->input->post('uas',TRUE);
            $hitung = ($uas+$tugas+$uts)/3;
        // Hitung range HURUF

           $huruf =  $this->input->post('huruf',TRUE);

           if ($hitung >=86 && 100 <=100) {
                    $data = array(

        'id_mk' => $data_sks,
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'A',
          'bobot' => 4,
        'sks'   =>$sks->sks,
        'mutu'  => 4*$sks->sks

        );

          $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);




 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');


            redirect(site_url('nilai'));
           }
           elseif($hitung>=80 && 86 <= 86)
           {


             $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'A-',
          'bobot' => 3.75,
         'sks'   =>$sks->sks,
         'mutu'  => 3.75*$sks->sks
        );

           $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);


 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');


            redirect(site_url('nilai'));

           }
           elseif($hitung >=76 && 80 <= 80)
           {

     $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'B+',
          'bobot' => 3.5,
         'sks'   =>$sks->sks,
         'mutu'  => 3.5*$sks->sks
        );

            $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);
     $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');
            redirect(site_url('nilai'));


           }
           elseif($hitung >=70 && 76 <= 76 )
           {

                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'B',
          'bobot' => 3,
         'sks'   =>$sks->sks,
         'mutu'  => 3*$sks->sks
        );

          $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);
        $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');
            redirect(site_url('nilai'));
           }

           elseif($hitung >=66 && 70<=70 )
           {

                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'B-',
          'bobot' => 2.75,
         'sks'   =>$sks->sks,
         'mutu'  => 2.75*$sks->sks
        );

            $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);
 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');
            redirect(site_url('nilai'));

           }

           elseif($hitung >=60 && 66<=66)
           {

                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'C+',
          'bobot' => 2.5,
        'sks'   =>$sks->sks,
        'mutu'  => 2.5*$sks->sks
        );

             $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);
 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');
            redirect(site_url('nilai'));

           }

           elseif($hitung >=56 && 60<=60)
           {
                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'C',
          'bobot' => 2,
      'sks'   =>$sks->sks,
      'mutu'  => 2*$sks->sks
        );

             $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);
           $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');
            redirect(site_url('nilai'));
           }

           elseif($hitung >= 36 && 56 <= 56 )
           {

                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'D',
          'bobot' => 1,
        'sks'   =>$sks->sks,
        'mutu'  => 1*$sks->sks
        );

      $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);
 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');
            redirect(site_url('nilai'));

           }
           else
           {
                 $data = array(

        'id_mk' => $this->input->post('id_mk',TRUE),
        'id_mahasiswa' => $this->input->post('id_mahasiswa',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'akhir' => $hitung,
        'huruf' => 'E',
          'bobot' => 0,
         'sks'   =>$sks->sks,
         'mutu'  => 0*$sks->sks
        );

           $this->Nilai_model->update($this->input->post('id_nilai', TRUE), $data);
       $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Update!</strong> Your Data is Successful.

                 </div>');
            redirect(site_url('nilai'));
           }


        }
    }







    public function delete($id)
    {
        $row = $this->Nilai_model->get_by_id($id);

        if ($row) {
            $this->Nilai_model->delete($id);
               $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Delete !</strong> Your Data is Successful.

                 </div>');


            redirect(site_url('nilai'));
            redirect(site_url('nilai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_mk', 'id mk', 'trim|required');
	$this->form_validation->set_rules('id_mahasiswa', 'id mahasiswa', 'trim|required');
	$this->form_validation->set_rules('id_semester', 'id semester', 'trim|required');
	$this->form_validation->set_rules('tugas', 'tugas', 'trim|required|numeric');
	$this->form_validation->set_rules('uts', 'uts', 'trim|required');
	$this->form_validation->set_rules('uas', 'uas', 'trim|required|numeric');

	$this->form_validation->set_rules('id_nilai', 'id_nilai', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "nilai.xls";
        $judul = "nilai";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mahasiswa");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Semester");
	xlsWriteLabel($tablehead, $kolomhead++, "Tugas");
	xlsWriteLabel($tablehead, $kolomhead++, "Uts");
	xlsWriteLabel($tablehead, $kolomhead++, "Uas");

	foreach ($this->Nilai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mahasiswa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_semester);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tugas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->uts);
	    xlsWriteNumber($tablebody, $kolombody++, $data->uas);
	    xlsWriteNumber($tablebody, $kolombody++, $data->akhir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->huruf);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_sks);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_huruf);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ip);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=nilai.doc");

        $data = array(
            'nilai_data' => $this->Nilai_model->get_all(),
            'start' => 0
        );

        $this->load->view('nilai/nilai_doc',$data);
    }

}

/* End of file Nilai.php */
/* Location: ./application/controllers/Nilai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 11:20:24 */
/* http://harviacode.com */
