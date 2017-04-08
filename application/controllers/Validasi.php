<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Validasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dpam_model');
        $this->load->library('form_validation');
   $this->load->model('Entry_model');
         $this->load->model('Nilai_model');
            if ($this->session->userdata('username')== "") {
            redirect('logindpam');
        }
    $this->load->helper('text');
    }


public function index()
    {
       
        $dpam = $this->Dpam_model->get_all();

        $data = array(
         'mhs_all' => $this->Dpam_model->mhs_all(),
        'nama_dpam' => $this->session->userdata('nama_dpam'),
            'dpam_data' => $dpam,
            'content'       => 'dpam/validasi_utama',
            'judul'     => 'DPAM Place'
        );

        $this->load->view('template_dpam', $data);
    
}


    public function validasi_nilai()
    {
       




           $id = $this->uri->segment(3);
         // $rek_sc_join_mk    = $this->Entry_model->rek_sc_join_mk();
 
          $semester_sekarang = $this->db->get('semester_sekarang')->row();
       
       

 $cek_semester_aktif = $this->db->query('SELECT max(semester_aktif) as 
    aktif from entry where id_mahasiswa='.$this->uri->segment(3))->row();    


         //untuk hitung ip sebelumnya (ips)
     $dpam = $this->Dpam_model->get_all();
        $row = $this->Dpam_model->detail_mhs($id);
        if ($row) {
            $data = array(

  'button' => 'Create',

            'email' => $this->session->userdata('email'),
            'action' => site_url('mata_kuliah/create_action'),
        'id_entry' => set_value('id_entry'),
             'kode_mk' => set_value('kode_mk'),
        'id_semester' => set_value('id_semester'),
        'nama_matakuliah' => set_value('nama_matakuliah'),
        'validasi' => set_value('validasi'),

            'semester_1'     => $this->Entry_model->val_semester_1($id),
            'semester_2'     => $this->Entry_model->val_semester_2($id),
            'semester_3'     => $this->Entry_model->val_semester_3($id),
            'semester_4'     => $this->Entry_model->val_semester_4($id),
            'semester_5'     => $this->Entry_model->val_semester_5($id),
            'semester_6'     => $this->Entry_model->val_semester_6($id),
            'semester_7'     => $this->Entry_model->val_semester_7($id),
            'semester_8'     => $this->Entry_model->val_semester_8($id),
                'nama_mahasiswa'        => $row->nama_mahasiswa,
                'nim'                   => $row->nim,
               'cek_semester_aktif'     => $cek_semester_aktif,
                'semester_sekarang'     => $semester_sekarang,
                'mhs_all'               => $this->Dpam_model->mhs_all(),
                'nama_dpam'             => $this->session->userdata('nama_dpam'),
                'dpam_data'             => $dpam,
                'content'               => 'dpam/validasi_entry_matakuliah_semester',
                'judul'                 => 'DPAM Place'
        );

        $this->load->view('template_dpam', $data);
    
  }
}






  public function validasi_data()
    {
       
        $dpam = $this->Dpam_model->get_all();

        $data = array(
         'mhs_all' => $this->Dpam_model->mhs_all(),
        'nama_dpam' => $this->session->userdata('nama_dpam'),
            'dpam_data' => $dpam,
            'content'       => 'dpam/validasi_data',
            'judul'     => 'DPAM Place'
        );

        $this->load->view('template_dpam', $data);
    
  }


  public function validasi_data_entry()
    {
       
        $dpam = $this->Dpam_model->get_all();

        $data = array(
         'mhs_all' => $this->Dpam_model->mhs_all(),
        'nama_dpam' => $this->session->userdata('nama_dpam'),
            'dpam_data' => $dpam,
            'content'       => 'dpam/validasi_home',
            'judul'     => 'DPAM Place'
        );

        $this->load->view('template_dpam', $data);
    
  }


    public function detail_mhs($id) 
    {
 
 $waktu = date('Y-m');



//ambil max semester
 $max_semester_aktif = $this->db->query('SELECT max(semester_aktif) as aktif from entry
    where id_mahasiswa='.$id)->row();    

//


        $rek_sc = $this->Entry_model->rek_sc($id,1);
        $rek_jcm = $this->Entry_model->rek_jcm($id,3);
        $rek_ppk = $this->Entry_model->rek_ppk($id,2);


        $semester_sekarang = $this->db->get('semester_sekarang')->row();
        $semester = $this->Entry_model->ganjil();
        $semester_genap = $this->Entry_model->genap();
        $idmahasiswa = $this->session->userdata('id_mahasiswa');
        $idsemester = $this->session->userdata('id_semester');
        $entry = $this->Entry_model->entry_join($this->uri->segment(3));
         //untuk hitung ip sebelumnya (ips)
     //


         $ips = $this->Nilai_model->mutu($this->session->userdata('id_mahasiswa'));
         $ips_sks = $this->Nilai_model->ips_sks($this->session->userdata('id_mahasiswa'));
                 //untuk hitung ip sebelumnya (ips)
        $paket_mk = $this->Entry_model->paket_mk();

  //untuk hitung ip sebelumnya (ips)
         $ips = $this->Nilai_model->mutu($id);
         $ips_sks = $this->Nilai_model->ips_sks($id);
                 //untuk hitung ip sebelumnya (ips)
           
        $row = $this->Dpam_model->detail_mhs($id);
        if ($row) {
            $data = array(

    'rek_sc_join_mk' => $this->Entry_model->rek_sc_join_mk($max_semester_aktif->aktif),
    'rek_jcm_join_mk'=> $this->Entry_model->rek_jcm_join_mk($max_semester_aktif->aktif),
    'rek_ppk_join_mk'=> $this->Entry_model->rek_ppk_join_mk($max_semester_aktif->aktif),

 'rek_sc_join_mk_6' => $this->Entry_model->rek_sc_join_mk(6),
    'rek_jcm_join_mk_6'=> $this->Entry_model->rek_jcm_join_mk(6),
    'rek_ppk_join_mk_6'=> $this->Entry_model->rek_ppk_join_mk(6),



    'bm_sc_7'        => $this->Entry_model->bm_sc_7($this->session->userdata('id_mahasiswa')),
    'bm_jcm_7'           => $this->Entry_model->bm_jcm_7($this->session->userdata('id_mahasiswa')),
        'bm_ppk_7'       => $this->Entry_model->bm_ppk_7($this->session->userdata('id_mahasiswa')),
              
 'bm_sc_8'        => $this->Entry_model->bm_sc_8($this->session->userdata('id_mahasiswa')),
    'bm_jcm_8'           => $this->Entry_model->bm_jcm_8($this->session->userdata('id_mahasiswa')),
        'bm_ppk_8'       => $this->Entry_model->bm_ppk_8($this->session->userdata('id_mahasiswa')),



            'rek_sc'         => $rek_sc,
            'rek_jcm'        => $rek_jcm,
            'rek_ppk'        => $rek_ppk,
            'join_mk_syarat' => $this->Entry_model->join_mk_syarat(50,1),
            'entry_data'     => $entry,
        'semester_sekarang'  => $semester_sekarang,
            'sks'            => $this->Entry_model->sum_sks($this->uri->segment(3),$waktu),
            'nim'            => $this->session->userdata('nim'),
            'paket_mk'       => $paket_mk,
            'ips'            => $ips,
            'ips_sks'        => $ips_sks,
            'id_mahasiswa'   => $id,
            'nama_mahasiswa' => $this->session->userdata('nama_mahasiswa'),
            'semester'       => $semester,
            'semester_genap' => $semester_genap,
            'content'        => 'entry/entry_list',
            'judul'          => 'Lembar Entry KRS',
            'semester_1'     => $this->Entry_model->semester_1(),
            'semester_2'     => $this->Entry_model->semester_2(),
            'semester_3'     => $this->Entry_model->semester_3(),
            'semester_4'     => $this->Entry_model->semester_4(),
            'semester_5'     => $this->Entry_model->semester_5(),
            'semester_6'     => $this->Entry_model->semester_6(),
            'semester_7'     => $this->Entry_model->semester_7(),
            'semester_8'     => $this->Entry_model->semester_8(),
     
            'nama_dpam' => $this->session->userdata('nama_dpam'),
            'content'       => 'dpam/validasi_detail_mahasiswa',

        'nama_mahasiswa' => $row->nama_mahasiswa,
           'nim'     => $row->nim,
		


	    );
            $this->load->view('template_dpam', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dpam'));
        
    }
}

   
   



        public function simpan_entry()
    {

$id = $this->uri->segment(3);
$id_mhs = $this->uri->segment(4);
       $data_tampil = $this->Entry_model->nama_mk($id)->row();


      $cek_semester_aktif = $this->db->query('SELECT max(nama_semester)+1 as aktif from nilai join semester on semester.id_semester=nilai.id_semester
        where id_mahasiswa='.$id_mhs)->row();

 $validasi_not_syarat= $this->Entry_model->validasi_not_syarat
            ($id,$id_mhs);

        $validasi = $this->Entry_model->validasi($id,$id_mhs);


if ($validasi->num_rows() >0 ) {


  $this->session->set_flashdata('message', 
                '<div class="alert alert-danger"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <p class="    glyphicon glyphicon-remove"></p>   Maaf <strong> '.$data_tampil->nama_matakuliah.' </strong> Sudah Di Entry, <strong>Silahkan Lihat Di Tabel Terprogram</strong>
 
                 </div>');

         redirect(site_url('validasi/detail_mhs/'.$this->uri->segment(4)));


} else {

   if ($validasi_not_syarat->num_rows()>0) {


 $this->session->set_flashdata('message', 
                '<div class="alert alert-info fade in"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <p class="    glyphicon glyphicon-remove"></p>   Matakuliah <strong> '.$data_tampil->nama_matakuliah.' </strong> Sudah Pernah Di Kontrak Pada Semester Sebelumnya, <strong>Silahkan Lihat Di Daftar Nilai</strong>
 
                 </div>');

  redirect(site_url('validasi/detail_mhs/'.$this->uri->segment(4)));






}else
{


}






 $data = array(
    'id_semester' => $data_tampil->id_semester,
        'id_mahasiswa' => $this->uri->segment(4),
        'id_mk' => $data_tampil->id_mk,
          'waktu_entry'  => date('Y-m'),
          'semester_aktif'=>$cek_semester_aktif->aktif,
          'validasi'=>'SUDAH'
        );

            $this->Entry_model->insert($data);

 $this->session->set_flashdata('message', 
                '<div class="alert alert-success fade in"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Selamat..! Matakuliah  <strong> '.$data_tampil->nama_matakuliah.' </strong> Sukses Tersimpan.
 
                 </div>');

            redirect(site_url('validasi/detail_mhs/'.$this->uri->segment(4)));
 }

}

 public function delete() 
    {

$id = $this->uri->segment(3);

        $row = $this->Entry_model->get_by_id($id);

        if ($row) {
            $this->Entry_model->delete($id);

 $this->session->set_flashdata('message', 
                '<div class="alert alert-success fade in"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Terhapus !</strong> Your Data is Successful.
 
                 </div>');


           
            redirect(site_url('validasi/detail_mhs/'.$this->uri->segment(4)));

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            
        
     
            redirect(site_url('validasi/detail_mhs/'.$this->uri->segment(4)));
        }
    }




   public function simpan_paket($id)
    {
         $data          = $this->db->get_where('paket_mk')->num_rows();
         $data_paket_mk = $this->db->get_where('paket_mk');
         if ($data > 0) {
            
         foreach ($data_paket_mk->result() as $data) {
            
         

         $data = array(
       
        'id_semester'  => $data->id_semester,
        'id_mahasiswa' => $id,
        'id_mk'        => $data->id_mk,
        'waktu_entry'  => date('Y-m'),
        'semester_aktif' => 1,
        'validasi'     => 'SUDAH'

        );
              $this->Entry_model->insert($data);
}
            

 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Paket Matakuliah Anda!</strong>is Successful Saved.
 
                 </div>');

            redirect(site_url('validasi'));


        }else
 
        {

   
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Paket Matakuliah !</strong> Is Not Saved.
 
            </div>');
            redirect(site_url('validasi'));

        }

    }








  public function create() 
    {
        $data = array(
            'content'   => 'matakuliah/matakuliah_form',
        'nama'          => 'Matakuliah Create',

        'email' => $this->session->userdata('email'),
        'judul'         => 'Create Matakuliah',
            'button' => 'Create',
            'action' => site_url('matakuliah/create_action'),
        'id_entry' => set_value('id_entry'),
        'kode_mk' => set_value('kode_mk'),
         'id_semester' => set_value('id_semester'),
        'nama_matakuliah' => set_value('nama_matakuliah'),
        'sks' => set_value('sks'),
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
        'kode_mk' => $this->input->post('kode_mk',TRUE),
        'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
        'sks' => $this->input->post('sks',TRUE),
        'id_semester' => $this->input->post('id_semester',TRUE),
        );

            $this->Matakuliah_model->insert($data);
      

 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.
 
                 </div>');



            redirect(site_url('matakuliah'));
        }    }
    
    public function update() 
    {
        


          $id = $this->uri->segment(3);
          $mhs = $this->uri->segment(4);
          


    




 $cek_semester_aktif = $this->db->query('SELECT max(semester_aktif) as 
    aktif from entry where id_mahasiswa='.$this->uri->segment(4))->row();   



        //  $rek_sc_join_mk    = $this->Entry_model->rek_sc_join_mk();
          $semester_sekarang = $this->db->get('semester_sekarang')->row();
       
         //untuk hitung ip sebelumnya (ips)
     $dpam = $this->Dpam_model->get_all();
        $row = $this->Entry_model->get_validasi_mk($id,$mhs)->row();
        if ($row) {
            $data = array(

                'semester_1'     => $this->Entry_model->val_semester_1($mhs),
                'semester_2'     => $this->Entry_model->val_semester_2($mhs),
                'semester_3'     => $this->Entry_model->val_semester_3($mhs),
                'semester_4'     => $this->Entry_model->val_semester_4($mhs),
                'semester_5'     => $this->Entry_model->val_semester_5($mhs),
                'semester_6'     => $this->Entry_model->val_semester_6($mhs),
                'semester_7'     => $this->Entry_model->val_semester_7($mhs),
                'semester_8'     => $this->Entry_model->val_semester_8($mhs),
                'nama_mahasiswa'        => $row->nama_mahasiswa,
                'nim'                   => $row->nim,
               
                'semester_sekarang'     => $semester_sekarang,
                'mhs_all'               => $this->Dpam_model->mhs_all(),
                'nama_dpam'             => $this->session->userdata('nama_dpam'),
                'dpam_data'             => $dpam,
                'content'               => 'dpam/validasi_entry_matakuliah_semester_update',
                'judul'                 => 'DPAM Place',

                
        'email'             => $this->session->userdata('email'),
        'cek_semester_aktif'=> $cek_semester_aktif,      
        'nama'              => 'Matakuliah Update',
        'judul'             => 'Update Matakuliah',
                'button'    => 'Update',
                'action'    => site_url('validasi/update_action'),
        'id_entry'             => set_value('id_mk', $row->id_entry),
        'kode_mk'           => set_value('kode_mk', $row->kode_mk),
        'nama_matakuliah'   => set_value('nama_matakuliah', $row->nama_matakuliah),
        'validasi'               => set_value('validasi', $row->validasi),
        'id_semester'       => set_value('id_semester', $row->id_semester),
        );
            $this->load->view('template_dpam', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('update')
                );
        }
    
    
    }
    public function update_action() 
    {

        $mk = $this->uri->segment(3);
        $mhs = $this->input->post('seg_4');


    $id_entry = $this->input->post('id_entry');    
    $validasi = $this->input->post('validasi');





  $data = array(
               'validasi' => $validasi
               
            );

$cek_validasi = $this->Entry_model->cek_update($id_entry,$data);

    if ($cek_validasi) {
        
 $this->session->set_flashdata('message', 
                '<div class="alert alert-success"> 
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Validasi!</strong> Your Data is Successful.
 
                 </div>');



         redirect("validasi/update/".'/'.$id_entry.'/'.$mhs);



    } else {
         $this->session->set_flashdata('message', 
 
         '<div class="alert alert-danger"> 
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Opps not Saved!</strong> Your Data is not Successful.
 
                 </div>');


  redirect("validasi/update/".'/'.$id_entry.'/'.$mhs);
        // redirect(site_url("validasi/update/").$_GET[].$_GET[);
    }
    
























    }
    }
    

































/* End of file Dpam.php */
/* Location: ./application/controllers/Dpam.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:14 */
/* http://harviacode.com */