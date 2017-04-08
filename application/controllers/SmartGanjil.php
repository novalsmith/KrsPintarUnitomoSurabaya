<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class SmartGanjil extends CI_Controller {

	function __construct() {

		parent::__construct();

		$this->load->model('Smart_model');
		$this->load->model('Nilai_model');
		$this->load->model('Entry_model');

    $this->load->model('Mk_tawaran_model');
	$this->load->library('form_validation');
	$this->load->library('form_validation');
		if ($this->session->userdata('nim') == "") {

			redirect('loginmhs');
		}
	}
//SELECT bb.id_mk FROM bidangminat_bersyarat bb WHERE bb.id_minat=1 and bb.id_mk in(select n.id_mk from nilai n where n.akhir<50)

	public function index() {

		$mhs = $this->session->userdata('id_mahasiswa');
		$push = $this->db->get('mk_tawaran mkt')->result();
		$respon = $this->uri->segment(3);

$data = array(
	'H3'     => $this->Smart_model->H_Ganjil($mhs),

	'mulai_Y_3'     => $this->Smart_model->mulai_Y_3(),
	'mulai_Y_5'     => $this->Smart_model->mulai_Y_5(),
	'mulai_Y_7'     => $this->Smart_model->mulai_Y_7(),

	'mulai_Y_3_respon'     => $this->Smart_model->mulai_Y_3_respon($respon),
	'mulai_Y_5_respon'     => $this->Smart_model->mulai_Y_5_respon($respon),
	'mulai_Y_7_respon'     => $this->Smart_model->mulai_Y_7_respon($respon),


	'content'           => 'expertkrs/expertrule_Ganjil',
'judul'             => 'Lembar Entry KRS Semester Ganjil',
'max_semester'     => $this->Smart_model->max_semester($mhs),
//	'expert_genap'      => $this->Mk_tawaran_model->semester_genap(),
'id_mahasiswa'      => $this->session->userdata('id_mahasiswa'),
'nama_mahasiswa'    => $this->session->userdata('nama_mahasiswa'),
'semester_sekarang' => $this->db->get('semester_sekarang')->row(),
'push'              => $push,
'sem_1'             => $this->Entry_model->join_mk_semester1(1,$mhs),
'sem_3'             => $this->Entry_model->join_mk_semester3($mhs),
'mengulang_semester1' => $this->Smart_model->valid_semester1($respon),
'mengulang_semester3' => $this->Smart_model->valid_semester3($respon),
'mengulang_semester5' => $this->Smart_model->valid_semester5($respon),
'mengulang_semester7' => $this->Smart_model->valid_semester7($respon),

'CekMinat' => $this->Smart_model->CekMinat($mhs),


'semester_sekarang' => $this->db->get('semester_sekarang')->row(),
 );



		$this->load->view('template_expert', $data);
	}



public function hasil_expert()
{
  $mhs = $this->session->userdata('id_mahasiswa');
  $data = array(

        'max_semester'     => $this->Smart_model->max_semester($mhs),
      	'sem_1'     => $this->Entry_model->join_mk_semester1(),
      //	'expert_genap'      => $this->Mk_tawaran_model->semester_genap(),
        'id_mahasiswa'      => $this->session->userdata('id_mahasiswa'),
        'nama_mahasiswa'    => $this->session->userdata('nama_mahasiswa'),
        'replace'     => $this->Mk_tawaran_model->join_expert_replace(),

        'data'    => "hasilnya sudah ada",
        'content'           => 'expertkrs/hasil_expert',
        'semester_sekarang' => $this->db->get('semester_sekarang')->row(),
        'judul'             => 'Lembar Entry KRS',
      );
    $this->load->view('template_expert', $data);
}



public function simpan_ke_entry_temp()
{

	$seg3= $this->uri->segment(3);
	$seg4= $this->uri->segment(4);
 $redirect = $this->db->query('select * from pertanyaan where id_pertanyaan="'.$seg4.'"')->row();

$mkt = $this->uri->segment(3);
$mhs = $this->session->userdata('id_mahasiswa');
$mhs_get = $this->db->query('select * from mahasiswa where id_mahasiswa='.$mhs)->row();
	# ini pembuatan variabel untuk get data
# code...
		# ini pembuatan variabel untuk get data
		#Membuat Value untuk insert Nama Kelas secara otomatis
		$kelas_A = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='A'")->row();
		$kelas_B = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='B'")->row();
		$kelas_C = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='C'")->row();
		$kelas_D = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='D'")->row();
		$kelas_K = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='K'")->row();
		$kelas_L = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='L'")->row();
		$kelas_X = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='X'")->row();
		$kelas_Y = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='Y'")->row();
		#Membuat hitung total kelas secara keseluruhan : contoh : Maks A = 10 !> 10 untuk data yg di isi
		$total_A = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_A from entry_temporary where id_kelas='.$kelas_A->id_kelas)->row();
		$total_B = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_B from entry_temporary where id_kelas='.$kelas_B->id_kelas)->row();
		$total_C = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_C from entry_temporary where id_kelas='.$kelas_C->id_kelas)->row();
		$total_D = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_D from entry_temporary where id_kelas='.$kelas_D->id_kelas)->row();
		$total_K = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_K from entry_temporary where id_kelas='.$kelas_K->id_kelas)->row();
		$total_L = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_L from entry_temporary where id_kelas='.$kelas_L->id_kelas)->row();
		$total_X = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_X from entry_temporary where id_kelas='.$kelas_X->id_kelas)->row();
		$total_Y = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_Y from entry_temporary where id_kelas='.$kelas_Y->id_kelas)->row();

$tahun_akademik = $this->db->query('select * from semester_sekarang')->row();
$mk_t = $this->db->query('select * from mk_tawaran natural join matakuliah where id_mk_tawaran='.$mkt)->row();

//-----------untuk tahun_akademik ---------------------------
	$dat1 = date('Y');
	$dat2 = date('Y')-1;
//------------------------------------------------
//----------------untuk pengecekan apakah sks masih cukup atau tidak saat insert mk----------------------------
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et
 join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=3')->row();

			$bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
				 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=2')->row();
				$maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
				 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=2')->row();
				$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
				$view_ipk = number_format($ipk,2)   ;


        if ($view_ipk >=3.00 ){

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=24) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $seg3,
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');

										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));


		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
		redirect(site_url('smart/index/RB3'));
		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
		redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
                 '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(24-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

                  </div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


				} elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=21) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $seg3,
		"id_kelas"       => $kelas_A->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');

										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));


	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
								 '<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(21-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

									</div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


				}elseif($view_ipk >=2.00 AND $view_ipk <=2.49)
				{

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=18) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
                 '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(18-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

                  </div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


				}elseif($view_ipk >=1.50 AND $view_ipk <=1.99)

				{

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=15) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
                 '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(15-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

                  </div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


				} elseif($view_ipk <=1.99){

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=12) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
								 '<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(12-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

									</div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


} else {
			$this->session->set_flashdata('message',
			'<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Maaf</strong> Untuk sementara Belum ada data IPK.
			</div>');
			redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));
	}
}












public function simpan_ke_entry_temp7()
{

	$seg3= $this->uri->segment(3);
	$seg4= $this->uri->segment(4);
 $redirect = $this->db->query('select * from pertanyaan where id_pertanyaan="'.$seg4.'"')->row();

$mkt = $this->uri->segment(3);
$mhs = $this->session->userdata('id_mahasiswa');
$mhs_get = $this->db->query('select * from mahasiswa where id_mahasiswa='.$mhs)->row();
	# ini pembuatan variabel untuk get data
# code...
		# ini pembuatan variabel untuk get data
		#Membuat Value untuk insert Nama Kelas secara otomatis
		$kelas_A = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='A'")->row();
		$kelas_B = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='B'")->row();
		$kelas_C = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='C'")->row();
		$kelas_D = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='D'")->row();
		$kelas_K = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='K'")->row();
		$kelas_L = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='L'")->row();
		$kelas_X = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='X'")->row();
		$kelas_Y = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='Y'")->row();
		#Membuat hitung total kelas secara keseluruhan : contoh : Maks A = 10 !> 10 untuk data yg di isi
		$total_A = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_A from entry_temporary where id_kelas='.$kelas_A->id_kelas)->row();
		$total_B = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_B from entry_temporary where id_kelas='.$kelas_B->id_kelas)->row();
		$total_C = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_C from entry_temporary where id_kelas='.$kelas_C->id_kelas)->row();
		$total_D = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_D from entry_temporary where id_kelas='.$kelas_D->id_kelas)->row();
		$total_K = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_K from entry_temporary where id_kelas='.$kelas_K->id_kelas)->row();
		$total_L = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_L from entry_temporary where id_kelas='.$kelas_L->id_kelas)->row();
		$total_X = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_X from entry_temporary where id_kelas='.$kelas_X->id_kelas)->row();
		$total_Y = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_Y from entry_temporary where id_kelas='.$kelas_Y->id_kelas)->row();

$tahun_akademik = $this->db->query('select * from semester_sekarang')->row();
$mk_t = $this->db->query('select * from mk_tawaran natural join matakuliah where id_mk_tawaran='.$mkt)->row();

//-----------untuk tahun_akademik ---------------------------
	$dat1 = date('Y');
	$dat2 = date('Y')-1;
//------------------------------------------------
//----------------untuk pengecekan apakah sks masih cukup atau tidak saat insert mk----------------------------
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et
 join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=7')->row();

			$bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
				 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=6')->row();
				$maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
				 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=6')->row();
				$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
				$view_ipk = number_format($ipk,2)   ;


        if ($view_ipk >=3.00 ){

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=24) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
		"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $seg3,
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');

										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));


		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
		redirect(site_url('smart/index/RB3'));
		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
		redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
                 '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(24-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

                  </div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


				} elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=21) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $seg3,
		"id_kelas"       => $kelas_A->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');

										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));


	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
								 '<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(21-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

									</div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


				}elseif($view_ipk >=2.00 AND $view_ipk <=2.49)
				{

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=18) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
	"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
                 '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(18-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

                  </div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


				}elseif($view_ipk >=1.50 AND $view_ipk <=1.99)

				{

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=15) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
					"semester_aktif" => 7,

				"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 3,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
                 '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(15-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

                  </div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


				} elseif($view_ipk <=1.99){

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=12) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_C->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
			"semester_aktif" => 7,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Ganjil',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

		}


	} // else tutup kelas Sore
} else {
	# code...
	$this->session->set_flashdata('message',
								 '<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
				 <br> Total SKS yang Sudah Terpakai Adalah <strong>'.$sum_sks_rb1->totalsksRB1.' SKS</strong> dan SKS yang tersisa Sekarang adalah <strong>'.(12-$sum_sks_rb1->totalsksRB1).' SKS</strong>.

									</div>');
									redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}


} else {
			$this->session->set_flashdata('message',
			'<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Maaf</strong> Untuk sementara Belum ada data IPK.
			</div>');
			redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));
	}
}






public function hapus_entry_temp()
{
$seg3= $this->uri->segment(3);
$seg4= $this->uri->segment(4);
$redirect = $this->db->query('select * from pertanyaan where id_pertanyaan="'.$seg4.'"')->row();
$del = $this->db->query('delete from entry_temporary where id_mk_tawaran='.$seg3);

	if ($del) {
	$this->session->set_flashdata('message',
'<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Berhasil !</strong> Data Matakuliah Berhasil Terhapus.
 </div>');
redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

} else {
	$this->session->set_flashdata('message',
  '<div class="alert alert-danger">
 	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	 <strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.
   </div>');
 redirect(site_url('smartGanjil/index/'.$redirect->id_pertanyaan));

}

}


public function simpanP6_H3()
{
$replace = $this->Smart_model->insertKRS3();
	foreach ($replace as $key) {
  $result_replace = array(
  "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $key->id_mahasiswa,
  "waktu_entry"    => $key->waktu_entry,
  "semester_aktif" => $key->semester_aktif,
  "validasi"       => $key->validasi,
  "id_kelas"       => $key->id_kelas,
  "semester_tahun_akademik" => $key->semester_tahun_akademik,
  "tahun_akademik" => $key->tahun_akademik );
  $this->db->insert('entry', $result_replace);
}
 $this->Smart_model->hapus_entry_temp_ganjil();

$this->session->set_flashdata('message',
'<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Berhasil !</strong> KRS Anda Berhasil Tersimpan !.
	 </div>');
	 redirect(site_url('SmartGanjil/index'));
}


public function hapus_entry_H3() {
$del = $this->Smart_model->hapus_entry_H3();


if ($del) {
$this->Smart_model->hapus_entry_temp_ganjil();

$this->session->set_flashdata('message',
  '<div class="alert alert-success">
 	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Berhasil !</strong> Data KRS Berhasil Terhapus, Silahkan Lanjutkan KRS anda !.
   </div>');
	 redirect(site_url('SmartGanjil/index'));

 } else {
	 $this->session->set_flashdata('message',
	 '<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	 <strong>Maaf !</strong> Data KRS Gagal Terhapus.
		</div>');
	redirect(site_url('SmartGanjil/index'));

								 }
							 }



							 public function hapus_entry_temp_ganjil() {
							 $del = 					 $this->Smart_model->hapus_entry_temp_ganjil();


							 if ($del) {


							 $this->session->set_flashdata('message',
							   '<div class="alert alert-success">
							  	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Berhasil !</strong> Data KRS Berhasil Terhapus, Silahkan Lanjutkan KRS anda !.
							    </div>');
							 	 redirect(site_url('SmartGanjil/index'));

							  } else {
							 	 $this->session->set_flashdata('message',
							 	 '<div class="alert alert-danger">
							 		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							 	 <strong>Maaf !</strong> Data KRS Gagal Terhapus.
							 		</div>');
							 	redirect(site_url('SmartGanjil/index'));

							 								 }
							 							 }



/*

select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50)

......
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50))

select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) and mt.id_mk_tawaran in (select en.id_mk_tawaran FROM entry en NATURAL JOIN mk_tawaran mm WHERE mm.id_mk in(SELECT id_mk from nilai where akhir<=50) )

JADI query
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) and mt.id_mk_tawaran in (select en.id_mk_tawaran FROM entry en NATURAL JOIN mk_tawaran mm WHERE mm.id_mk in(SELECT id_mk from nilai where akhir<=50) )


query v2
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah from mk_tawaran mt natural join matakuliah mk where mt.id_semester=11 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=11)
*/





	 public function PKT2()
	 {

  $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();


	foreach ($RB3 as $key) {
  $result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $key->id_mk_tawaran,
		"id_kelas"       => 'A',
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakusiah Semester 2 !</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smart/index'));

 }



 	 public function KRStoWord()
 	 {
 $mhs = $this->session->userdata('id_mahasiswa');
 $getname = $this->db->get_where('mahasiswa',array('id_mahasiswa'=>$mhs))->row();

 			 header("Content-type: application/vnd.ms-word");
 			 header("Content-Disposition: attachment;Filename=".$getname->nim."-krsAnda.doc");

 			 $data = array(
 					 'H2' => $this->Smart_model->H_Ganjil($mhs),
 					 'start' => 0
 			 );

 			 $this->load->view('expertkrs/krsword',$data);
 	 }


}
