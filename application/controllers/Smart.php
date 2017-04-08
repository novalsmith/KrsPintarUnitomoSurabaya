<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Smart extends CI_Controller {

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

	public function index() {
  $mhs = $this->session->userdata('id_mahasiswa');
	$semester_ganjil = $this->Entry_model->ganjil();
	$semester_genap  = $this->Entry_model->genap();

	$get = $this->uri->segment(4);
	$respon = $this->uri->segment(3);

	$this->db->join('semester s', 's.id_semester = mkt.id_semester');
  $this->db->join('matakuliah mk', 'mk.id_mk = mkt.id_mk');

  $this->db->where('s.nama_semester',1);
  $push = $this->db->get('mk_tawaran mkt')->result();

    $data = array(
			'mulai_Y_1'     => $this->Smart_model->mulai_Y_1(),
			'mulai_Y_2'     => $this->Smart_model->mulai_Y_2(),
			'mulai_Y_3'     => $this->Smart_model->mulai_Y_3(),
			'mulai_Y_4'     => $this->Smart_model->mulai_Y_4(),
			'mulai_Y_5'     => $this->Smart_model->mulai_Y_5(),
			'mulai_Y_6'     => $this->Smart_model->mulai_Y_6(),
			'mulai_Y_7'     => $this->Smart_model->mulai_Y_7(),
			'mulai_Y_8'     => $this->Smart_model->mulai_Y_8(),
// Batas
			'mulai_Y_1_respon'     => $this->Smart_model->mulai_Y_1_respon($respon),
			'mulai_Y_2_respon'     => $this->Smart_model->mulai_Y_2_respon($respon),
			'mulai_Y_3_respon'     => $this->Smart_model->mulai_Y_3_respon($respon),
			'mulai_Y_4_respon'     => $this->Smart_model->mulai_Y_4_respon($respon),
			'mulai_Y_5_respon'     => $this->Smart_model->mulai_Y_5_respon($respon),
			'mulai_Y_6_respon'     => $this->Smart_model->mulai_Y_6_respon($respon),
			'mulai_Y_7_respon'     => $this->Smart_model->mulai_Y_7_respon($respon),
			'mulai_Y_8_respon'     => $this->Smart_model->mulai_Y_8_respon($respon),

// RB
'RB1'     => $this->Smart_model->RB1(2),
'RB2'     => $this->Smart_model->RB2(2),
'RB3'     => $this->Smart_model->RB3(2),
'RB4'     => $this->Smart_model->RB4(2),
'RB5'     => $this->Smart_model->RB5(2),
'RB6'     => $this->Smart_model->RB6(2),
'RB7'     => $this->Smart_model->RB7(2),
'RB8'     => $this->Smart_model->RB8(2),

'H1'     => $this->Entry_model->join_mk_semester(2,$mhs),
//'H2'     => $this->Entry_model->H($mhs),
//'H3'     => $this->Smart_model->H3($mhs),
'H4'     => $this->Smart_model->H4($mhs),
'H5'     => $this->Smart_model->H5($mhs),
'H6'     => $this->Smart_model->H6($mhs),
'H7'     => $this->Smart_model->H7($mhs),
'H8'     => $this->Smart_model->H8($mhs),

// RB

      'max_semester'     => $this->Smart_model->max_semester($mhs),
	//	'expert_genap'      => $this->Mk_tawaran_model->semester_genap(),
			'id_mahasiswa'      => $this->session->userdata('id_mahasiswa'),
			'nama_mahasiswa'    => $this->session->userdata('nama_mahasiswa'),
			'content'           => 'expertkrs/expertrule',
			'semester_sekarang' => $this->db->get('semester_sekarang')->row(),
			'judul'             => 'Lembar Entry KRS',
			'push'              => $push,
			'sem_1'             => $this->Entry_model->join_mk_semester1(1,$mhs),
			'sem_2'             => $this->Entry_model->join_mk_semester($mhs),
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


      $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();

         $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
        $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
        $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
        $view_ipk = number_format($ipk,2)   ;


        if ($view_ipk >=3.00 ){

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=24) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...

	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $seg3,
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');


										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}




		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Genap',
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
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											if ($seg4=='RB5') {
												# code...
												redirect(site_url('smart/index/RB5'));

											} elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											elseif($seg4=='RBS6') {
												redirect(site_url('smart/index/RBS6'));

											}
											elseif($seg4=='RBS8') {
												redirect(site_url('smart/index/RBS8'));

											}
											elseif($seg4=='RB9') {
												redirect(site_url('smart/index/RB9'));

											}
											elseif($seg4=='RB7') {
												redirect(site_url('smart/index/RB7'));

											}
											elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											else {
												redirect(site_url('smart'));

											}
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
									if ($seg4=='RB5') {
										# code...
										redirect(site_url('smart/index/RB5'));

									} elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									elseif($seg4=='RBS6') {
										redirect(site_url('smart/index/RBS6'));

									}
									elseif($seg4=='RBS8') {
										redirect(site_url('smart/index/RBS8'));

									}
									elseif($seg4=='RB9') {
										redirect(site_url('smart/index/RB9'));

									}
									elseif($seg4=='RB7') {
										redirect(site_url('smart/index/RB7'));

									}
									elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									else {
										redirect(site_url('smart'));

									}
}


				} elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

if (($sum_sks_rb1->totalsksRB1+$mk_t->sks)<=21) {
	# code...

	//---------------------------------------

	if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
		# code...
		$seg3= $this->uri->segment(3);
		$seg4= $this->uri->segment(4);
	if ($total_A->total_A < $kelas_A->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('d-m-Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $seg3,
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}	// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
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
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											if ($seg4=='RB5') {
												# code...
												redirect(site_url('smart/index/RB5'));

											} elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											elseif($seg4=='RBS6') {
												redirect(site_url('smart/index/RBS6'));

											}
											elseif($seg4=='RBS8') {
												redirect(site_url('smart/index/RBS8'));

											}
											elseif($seg4=='RB9') {
												redirect(site_url('smart/index/RB9'));

											}
											elseif($seg4=='RB7') {
												redirect(site_url('smart/index/RB7'));

											}
											elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											else {
												redirect(site_url('smart'));

											}
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
									if ($seg4=='RB5') {
										# code...
										redirect(site_url('smart/index/RB5'));

									} elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									elseif($seg4=='RBS6') {
										redirect(site_url('smart/index/RBS6'));

									}
									elseif($seg4=='RBS8') {
										redirect(site_url('smart/index/RBS8'));

									}
									elseif($seg4=='RB9') {
										redirect(site_url('smart/index/RB9'));

									}
									elseif($seg4=='RB7') {
										redirect(site_url('smart/index/RB7'));

									}
									elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									else {
										redirect(site_url('smart'));

									}
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
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
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
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											if ($seg4=='RB5') {
												# code...
												redirect(site_url('smart/index/RB5'));

											} elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											elseif($seg4=='RBS6') {
												redirect(site_url('smart/index/RBS6'));

											}
											elseif($seg4=='RBS8') {
												redirect(site_url('smart/index/RBS8'));

											}
											elseif($seg4=='RB9') {
												redirect(site_url('smart/index/RB9'));

											}
											elseif($seg4=='RB7') {
												redirect(site_url('smart/index/RB7'));

											}
											elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											else {
												redirect(site_url('smart'));

											}
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
									if ($seg4=='RB5') {
										# code...
										redirect(site_url('smart/index/RB5'));

									} elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									elseif($seg4=='RBS6') {
										redirect(site_url('smart/index/RBS6'));

									}
									elseif($seg4=='RBS8') {
										redirect(site_url('smart/index/RBS8'));

									}
									elseif($seg4=='RB9') {
										redirect(site_url('smart/index/RB9'));

									}
									elseif($seg4=='RB7') {
										redirect(site_url('smart/index/RB7'));

									}
									elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									else {
										redirect(site_url('smart'));

									}
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
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
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
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											if ($seg4=='RB5') {
												# code...
												redirect(site_url('smart/index/RB5'));

											} elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											elseif($seg4=='RBS6') {
												redirect(site_url('smart/index/RBS6'));

											}
											elseif($seg4=='RBS8') {
												redirect(site_url('smart/index/RBS8'));

											}
											elseif($seg4=='RB9') {
												redirect(site_url('smart/index/RB9'));

											}
											elseif($seg4=='RB7') {
												redirect(site_url('smart/index/RB7'));

											}
											elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											else {
												redirect(site_url('smart'));

											}
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
									if ($seg4=='RB5') {
										# code...
										redirect(site_url('smart/index/RB5'));

									} elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									elseif($seg4=='RBS6') {
										redirect(site_url('smart/index/RBS6'));

									}
									elseif($seg4=='RBS8') {
										redirect(site_url('smart/index/RBS8'));

									}
									elseif($seg4=='RB9') {
										redirect(site_url('smart/index/RB9'));

									}
									elseif($seg4=='RB7') {
										redirect(site_url('smart/index/RB7'));

									}
									elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									else {
										redirect(site_url('smart'));

									}
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
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_A->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	         <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...

											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		# code...

		$result_replace = array(
		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_B->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
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
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}
	elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_D->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}else {
		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
	}


	}

	else {

		if ($total_K->total_K < $kelas_K->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_K->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
	}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_L->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		# code...

		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_X->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);

		$this->session->set_flashdata('message',
	                 '<div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

	                  </div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}
		elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		# code...
		$result_replace = array(

		"id_mahasiswa"   =>  $mhs,
		"waktu_entry"    => date('Y'),
		"semester_aktif" => 2,
		"validasi"       => 'BELUM',
		"id_mk_tawaran"  => $this->uri->segment(3),
		"id_kelas"       => $kelas_Y->id_kelas,
		"semester_tahun_akademik" => 'Genap',
		"tahun_akademik" => $dat2.'/'.$dat1,
		);
		$this->db->insert('entry_temporary', $result_replace);


		$this->session->set_flashdata('message',
									 '<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.

										</div>');
										if ($seg4=='RB5') {
											# code...
											redirect(site_url('smart/index/RB5'));

										} elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										elseif($seg4=='RBS6') {
											redirect(site_url('smart/index/RBS6'));

										}
										elseif($seg4=='RBS8') {
											redirect(site_url('smart/index/RBS8'));

										}
										elseif($seg4=='RB9') {
											redirect(site_url('smart/index/RB9'));

										}
										elseif($seg4=='RB7') {
											redirect(site_url('smart/index/RB7'));

										}
										elseif($seg4=='RB3') {
											redirect(site_url('smart/index/RB3'));

										}
										else {
											redirect(site_url('smart'));

										}
		// batas pagi
		}else {
			$this->session->set_flashdata('message',
		                 '<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

		                  </div>');
											if ($seg4=='RB5') {
												# code...
												redirect(site_url('smart/index/RB5'));

											} elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											elseif($seg4=='RBS6') {
												redirect(site_url('smart/index/RBS6'));

											}
											elseif($seg4=='RBS8') {
												redirect(site_url('smart/index/RBS8'));

											}
											elseif($seg4=='RB9') {
												redirect(site_url('smart/index/RB9'));

											}
											elseif($seg4=='RB7') {
												redirect(site_url('smart/index/RB7'));

											}
											elseif($seg4=='RB3') {
												redirect(site_url('smart/index/RB3'));

											}
											else {
												redirect(site_url('smart'));

											}
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
									if ($seg4=='RB5') {
										# code...
										redirect(site_url('smart/index/RB5'));

									} elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									elseif($seg4=='RBS6') {
										redirect(site_url('smart/index/RBS6'));

									}
									elseif($seg4=='RBS8') {
										redirect(site_url('smart/index/RBS8'));

									}
									elseif($seg4=='RB9') {
										redirect(site_url('smart/index/RB9'));

									}
									elseif($seg4=='RB7') {
										redirect(site_url('smart/index/RB7'));

									}
									elseif($seg4=='RB3') {
										redirect(site_url('smart/index/RB3'));

									}
									else {
										redirect(site_url('smart'));

									}
}


				} else
				{
					$this->session->set_flashdata('message',
												 '<div class="alert alert-warning">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								 <strong>Maaf</strong> Untuk sementara Belum ada data IPK.

													</div>');
													if ($seg4=='RB5') {
														# code...
														redirect(site_url('smart/index/RB5'));

													} elseif($seg4=='RB3') {
														redirect(site_url('smart/index/RB3'));

													}
													elseif($seg4=='RBS6') {
														redirect(site_url('smart/index/RBS6'));

													}
													elseif($seg4=='RBS8') {
														redirect(site_url('smart/index/RBS8'));

													}
													elseif($seg4=='RB9') {
														redirect(site_url('smart/index/RB9'));

													}
													elseif($seg4=='RB7') {
														redirect(site_url('smart/index/RB7'));

													}
													elseif($seg4=='RB3') {
														redirect(site_url('smart/index/RB3'));

													}
													else {
														redirect(site_url('smart'));

													}
															}





}










public function hapus_entry_temp()
{

$seg3= $this->uri->segment(3);
$seg4= $this->uri->segment(4);

	$del = $this->db->query('delete from entry_temporary where id_mk_tawaran='.$seg3);

	if ($del) {
		$this->session->set_flashdata('message',
 	                '<div class="alert alert-success">
 	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 	        <strong>Berhasil !</strong> Data Matakuliah Berhasil Terhapus.

 	                 </div>');


									 if ($seg4=='RB5') {
									 	# code...
									 	redirect(site_url('smart/index/RB5'));

									 } elseif($seg4=='RB3') {
									 	redirect(site_url('smart/index/RB3'));

									 }
									 elseif($seg4=='RBS6') {
									 	redirect(site_url('smart/index/RBS6'));

									 }
									 elseif($seg4=='RBS8') {
									 	redirect(site_url('smart/index/RBS8'));

									 }
									 elseif($seg4=='RB9') {
									 	redirect(site_url('smart/index/RB9'));

									 }
									 elseif($seg4=='RB7') {
									 	redirect(site_url('smart/index/RB7'));

									 }
									 elseif($seg4=='RB3') {
									 	redirect(site_url('smart/index/RB3'));

									 }
									 else {
									 	redirect(site_url('smart'));

									 }








	} else {
		$this->session->set_flashdata('message',
 	                '<div class="alert alert-danger">
 	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	 <strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.

 	                 </div>');
									 if ($seg4=='RB5') {
									 	# code...
									 	redirect(site_url('smart/index/RB5'));

									 } elseif($seg4=='RB3') {
									 	redirect(site_url('smart/index/RB3'));

									 }
									 elseif($seg4=='RBS6') {
									 	redirect(site_url('smart/index/RBS6'));

									 }
									 elseif($seg4=='RBS8') {
									 	redirect(site_url('smart/index/RBS8'));

									 }
									 elseif($seg4=='RB9') {
									 	redirect(site_url('smart/index/RB9'));

									 }
									 elseif($seg4=='RB7') {
									 	redirect(site_url('smart/index/RB7'));

									 }
									 elseif($seg4=='RB3') {
									 	redirect(site_url('smart/index/RB3'));

									 }
									 else {
									 	redirect(site_url('smart'));

									 }
	}


}





public function simpanP6_H2()
{


	# code...

	$replace = $this->Smart_model->insertKRS();


	foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $key->id_mahasiswa,
  "waktu_entry"    => $key->waktu_entry,
  "semester_aktif" => $key->semester_aktif,
  "validasi"       => $key->validasi,
  "id_kelas"       => $key->id_kelas,
  "semester_tahun_akademik" => $key->semester_tahun_akademik,
  "tahun_akademik" => $key->tahun_akademik,
  );
  $this->db->insert('entry', $result_replace);

  }

	$this->session->set_flashdata('message',
								'<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Berhasil !</strong> KRS Anda Berhasil Tersimpan !.

								 </div>');
								 redirect(site_url('smart/index/H2'));

}







public function hapus_entry()
{

$del = $this->Smart_model->hapus_entry();


	if ($del) {
$this->Smart_model->hapus_entry_temp();		$this->session->set_flashdata('message',
 	                '<div class="alert alert-success">
 	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 	        <strong>Berhasil !</strong> Data KRS Berhasil Terhapus, Silahkan Lanjutkan KRS anda !.

 	                 </div>');
									 redirect(site_url('smart/index'));

								 }
								 else {
									 $this->session->set_flashdata('message',
																 '<div class="alert alert-danger">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												 <strong>Maaf !</strong> Data KRS Gagal Terhapus.

													</div>');
						redirect(site_url('smart/index'));

								 }
							 }


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

}
