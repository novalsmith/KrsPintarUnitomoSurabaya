<!--DATA UNTUK KAPASITAS KELAS DAN PEMBERIAN kELAS-->


<?php
$id =  $this->session->userdata('id_mahasiswa');
$dataget = $this->db->query('select max(semester_aktif) as total from entry where id_mahasiswa='.$id)->row();
//$valid_mulai = $this->db->query('select * from pertanyaan where id_semester=13')->row();
$respon = $this->uri->segment('3');
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
$mhs = $this->session->userdata('id_mahasiswa');
$seg3=$this->uri->segment(3);
$sks_lebih = $this->db->query('select * from pertanyaan where id_pertanyaan="'.$seg3.'"')->row();
	$mhs_get = $this->db->query('select * from mahasiswa where id_mahasiswa='.$mhs)->row();

//-----------untuk tahun_akademik ---------------------------
$dat1 = date('Y');
$dat2 = date('Y')-1;
$now = $dat2.'/'.$dat1;
	$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_tahun_akademik="Genap" and tahun_akademik="'.$now.'"');
//------------------------------------------------
//----------------untuk pengecekan apakah sks masih cukup atau tidak saat insert mk----------------------------


  $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();

 ?>

<!--DATA UNTUK KAPASITAS KELAS DAN PEMBERIAN kELAS-->













<!--PENGECEKAN SEMESTER SEKARANG UNTUK SEMESTER GANJIL DAN GENAP-->
<?php if($semester_sekarang->sekarang == 'Ganjil') : ?>

<?php redirect('smartGanjil/index'); ?>

<?php else: ?>
	<!--SENGAJA DIBERIKAN KOSONG SEHINGGA TIDAK DAPAT REDIRECT HALAMAN-->
<?php endif; ?>
<!--PENGECEKAN SEMESTER SEKARANG UNTUK SEMESTER GANJIL DAN GENAP-->





<!--Untuk mengetahui posisi mahasiswa pada semester berapa sekarang -->
<?php
 $id =  $this->session->userdata('id_mahasiswa');
$dataget = $this->db->query('select max(semester_aktif) as total from entry where id_mahasiswa='.$id)->row();
 ?>
 <!--Untuk mengetahui posisi mahasiswa pada semester berapa sekarang -->




 <!--Untuk Pesan notifikasi kesalahan aau sukses -->
 <div class="col-md-12 text-center">
 		<div style="margin-top: 4px"  id="message">
 				<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
 		</div>
 </div>
 <!--Untuk Pesan notifikasi kesalahan aau sukses -->


<!--SEMESTER 2 DISINI-->
<?php
// PEMERIKSAAN DATA, UNTUK SEMESTER 2
if ($dataget->total ==2 or $dataget->total ==1): // DO SEMESTER 2
?>

<?php
$replace_cek = $this->Smart_model->validasiKRSentry(2);
 ?>
<?php if ($replace_cek): ?>
<!--Alert pesan data sudah ada, dan di tampilkan-->
<h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smartGenap/hapus_entry') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
 <!--Alert pesan data sudah ada, dan di tampilkan-->
<!--tampilkan data hasil krs yang masuk di tabel entry-->
<table class="table table-bordered">
<thead>
<th>No</th>

<th>Matakuliah</th>
<th>Semester</th>
<th>SKS</th>
<th>Jam Masuk</th>
<th>Jam Selesai</th>
<th>Ruang Kuliah</th>
<th>Kelas</th>
<th>Hari</th>
</thead>
<?php
$no=1;
foreach ($H2 as $key): ?>  <tr>
<td><?php echo $no++ ?></td>
<td><?php echo $key->nama_matakuliah ?></td>
<td><?php echo $key->nama_semester ?></td>
<td><?php echo $key->sks ?></td>
<td><?php echo $key->jam_masuk ?></td>
<td><?php echo $key->jam_selesai ?></td>
<td><?php echo $key->nama_ruangan ?></td>
<td><?php echo $key->nama_kelas ?></td>
<td><?php echo $key->hari ?></td>
</tr>
<?php endforeach; ?>
</table>
<div class="well col-md-12">
 <a href="<?php echo base_url('smartGenap/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
</div>
<!--tampilkan data hasil krs yang masuk di tabel entry-->
<!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->
<?php else: ?>
 <!--else ini berfungsi ketika data yang di entry belum ada di tabel entry, data akan di periksa semester
2, 4, 6, 8 di dalam else ini-->

<!--BUKA SEMESTER 2 DISINI-->
<!---ipk-->
<?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=1')->row();
$maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=1')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2)   ;
 ?>
 <!--ipk-->


<?php
// Baca Kode Respon yang di Kirim dari database
// Apakah Ada data yang di kirim pada uri segment ada atau tidak, yang datanya diberi nama $respon
 if ($respon==''):
// jika respon ini kosong maka akan tampilkan pertanyaan awal, dengan kondisi pertanyaan mulai = Y
// pertanyaan tersebut akan ditampilkan
?>
<?php
//tampilkan pertanyaan yang di beri pernyataan -> Y <-
//yang berarti pertanyaan Mulai Ya, akan di tampilkan pada kondisi awal program di jalankan
$this->db->join('semester s', 's.id_semester = p.id_semester');
$getss = $this->db->get_where('pertanyaan p',array('p.mulai'=>'Y','s.nama_semester'=>2))->num_rows();

$this->db->join('semester s', 's.id_semester = p.id_semester');
$gets = $this->db->get_where('pertanyaan p',array('p.mulai'=>'Y','s.nama_semester'=>2))->row();
 if ($getss > 0): // periksa apakah ada data mulai berisi Y atau tidak, jika ada data >0. ?>
<?php redirect(base_url().'smartGenap/index/'.$gets->id_pertanyaan); // data dtas terpenuhi maka akan di
//berikan uri segment dengan kode pertanyaan?>



<?php
// menampilkan pertanyaan yang berstatus mulai = Y
// pada semester 2
foreach ($mulai_Y_2 as $key):
// Perulangan data pertanyaan yang ada pada tabel
 ?>
  <div class="panel panel-default">
          <div class="panel-body">
            <h1 class="lead">
               <?php echo $key->nama_pertanyaan ?>
              </h1>
          </div>
          <div class="panel-footer">
            <p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
            </a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
          </div>
        </div>
  <?php endforeach; // akhir loop data pertanyaan : mulai = Y ?>

<?php endif; // akhir cek data ada data Mulai = Y atau tidak. ?>




<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2-->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2-->
<?php elseif ($respon=='PKT2'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
<?php
$mhs = $this->session->userdata('id_mahasiswa');
$seg3= $this->uri->segment(3);
$paketsemester2= 'P4SMT2';

$dat1 = date('Y');
$dat2 = date('Y')-1;
  $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

$PKT2 = $this->db->query('select mt.id_mk_tawaran  from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
//if ($RB3->sks<=12) {}

if ($view_ipk >=3.00 ) // jika IPK adalah lebih besar atau sama dengan 3.00

{

if ($RB3->sks<=24) //  perika apakah sks total matakuliah yang ditawarkan lebih kecil daripada
// 24 sks ?, jika ya, maka akan di masukan sebagai paket matakuliah.
{

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {

foreach ($PKT2 as $key) {

$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
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
redirect(site_url('smartGenap/index/'.$paketsemester2));

}
// kelas C
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


} elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));



// jika tidak ada selain kelas D pada kelas PAGI
}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));}
} // Kelas Sore / Kelas Malam (K,L,X,Y)
else {

if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

// KELAS L
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

// kelas X
}
elseif ($total_X->total_X < $kelas_X->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


// KELAS Y
} elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.
</div>');


redirect(site_url('smartGenap/index/'.$paketsemester2));


} // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
} // else tutup kelas Sore

} else {  // TUTUP 24 SKS
  $this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));

}


} elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

if ($RB3->sks<=21) {

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
$seg3= $this->uri->segment(3);
$seg4= $this->uri->segment(4);
if ($total_A->total_A < $kelas_A->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

 redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}



}else { //kelas K
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


// batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

} elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}
      } // else tutup kelas Sore

}else{
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
 <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}



}elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
if ($RB3->sks<=18) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}

}else {
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
 '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
  </div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Gagal Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}



} // else tutup kelas Sore
} else {

  $this->session->set_flashdata('message',
'<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}


}elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
if ($RB3->sks<=15) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {

	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');


redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));



}

}else {
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}


} // else tutup kelas Sore
} else {
  $this->session->set_flashdata('message',
  '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
  </div>');
	redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}



} elseif($view_ipk <=1.99){
if ($RB3->sks<=12) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
          redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
        redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}else {
$this->session->set_flashdata('message',
           '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
    redirect(site_url('smartGenap/index/'.$paketsemester2));
}

}else {

if ($total_K->total_K < $kelas_K->kapasitas ) {
# code...
foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
</div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

            </div>');
          redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_X->total_X < $kelas_X->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

            </div>');
        redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

            </div>');
    redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}else {
$this->session->set_flashdata('message',
             '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

              </div>');
        redirect(site_url('smartGenap/index/'.$paketsemester2));
}


} // else tutup kelas Sore
} else {

$this->session->set_flashdata('message',
'<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}

} else{
$this->session->set_flashdata('message',
'<div class="alert alert-warning">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maaf</strong> Untuk sementara Belum ada data IPK.
</div>');
  // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
// redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
redirect(site_url('smartGenap/index/'.$paketsemester2));
}
?>







<?php elseif ($respon=='P4SMT2') : ?>
<?php foreach ($mulai_Y_2_respon as $keys): ?>
<h1 class="lead"><?php echo $keys->nama_pertanyaan ?></h1>
<table class="table table-bordered">
<thead>
<th>No</th>
<th>Matakuliah</th>
<th>Semester</th>
<th>SKS</th>
<th>Jam Masuk</th>
<th>Jam Selesai</th>
<th>Ruang Kuliah</th>
<th>Kelas</th>
<th>Hari</th>
</thead>
<?php
$no=1;
foreach ($sem_2 as $key): ?>  <tr>
<td><?php echo $no++ ?></td>
<td><?php echo $key->nama_matakuliah ?></td>
<td><?php echo $key->nama_semester ?></td>
<td><?php echo $key->sks ?></td>
<td><?php echo $key->jam_masuk ?></td>
<td><?php echo $key->jam_selesai ?></td>
<td><?php echo $key->nama_ruangan ?></td>
<td><?php echo $key->nama_kelas ?></td>
<td><?php echo $key->hari ?></td>
</tr>
<?php endforeach; ?>
</table>

<div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>smartGenap/simpanP6_H2"
class="btn btn-primary btn-lg" role="button"
onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
YES <b  class="glyphicon glyphicon-ok"></b></a>
<a href="<?php echo base_url()?>smartGenap/hapus_entry"
class="btn btn-warning btn-lg" role="button"
onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
NO <b  class="glyphicon glyphicon-remove"></b></a></p>
</div>
<?php endforeach ?>








<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
<?php elseif ($respon=='RB2SMT2-2'): ?>
  <div class="panel panel-default">
 <?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
  ?>

<?php if ($view_ipk >=3.00 ): ?>

<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>

	<div class="panel-body">
	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	</div>


<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
class="btn btn-primary btn-lg" role="button">
YES <b  class="glyphicon glyphicon-ok"></b></a>
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
</p>
</div>
<?php endforeach; ?>



<?php else: ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md">
<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
</div>


 <div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-primary btn-lg" role="button">
NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
</div>

<?php endforeach; ?>
<?php endif; ?>






<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
<?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>

<div class="panel-body">
<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
</div>


<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
class="btn btn-primary btn-lg" role="button">
YES <b  class="glyphicon glyphicon-ok"></b> </a>
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-warning btn-lg" role="button">
NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
 <?php endforeach; ?>




<?php else: ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md">
<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
</h1>
</div>


<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-primary btn-lg" role="button">
NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
</div>
<?php endforeach; ?>
<?php endif; ?>




<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
<?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>

	<div class="panel-body">
	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	</div>



<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
class="btn btn-primary btn-lg" role="button">
YES <b  class="glyphicon glyphicon-ok"></b>
</a>
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-warning btn-lg" role="button">
NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
<?php endforeach; ?>
<?php else: ?>


<?php foreach ($mulai_Y_2_respon as $key): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md">
<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
</div>

<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-primary btn-lg" role="button">
NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
</div>
<?php endforeach; ?>
<?php endif; ?>



<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
<?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>

	<div class="panel-body">
	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	</div>


<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
class="btn btn-primary btn-lg" role="button">
YES <b  class="glyphicon glyphicon-ok"></b></a>
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-warning btn-lg" role="button">
NO <b  class="glyphicon glyphicon-remove"></b></a></p>
</div>
<?php endforeach; ?>


<?php else: ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md">
<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
</div>

<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-primary btn-lg" role="button">
NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
</div>
<?php endforeach; ?>
<?php endif; ?>





<?php elseif($view_ipk <=1.99): ?>
<?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>

	<div class="panel-body">
	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	</div>


<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
class="btn btn-primary btn-lg" role="button">
YES <b  class="glyphicon glyphicon-ok"></b></a>
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-warning btn-lg" role="button">
NO <b  class="glyphicon glyphicon-remove"></b></a></p>
</div>
<?php endforeach; ?>


<?php else: ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>
<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2);?>

<?php if ($view_ipk >=3.00 ): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md"></h1>
<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
</span></div>

<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md">
<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
</div>

<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md">
<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
</h1></div>


<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md">
<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
</h1></div>

<?php elseif($view_ipk <=1.99): ?>
<div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
<span class="btn btn-primary btn-md">
<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
</div>

<?php else: ?>
Maff, untuk sementara Belum ada IPK
<?php endif; ?>


<div class="panel-footer">
<p class="bgbottom">
<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
class="btn btn-primary btn-lg" role="button">
NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
</div>
<?php endforeach; ?>

<?php endif; ?>
<?php else: ?>
 Maff, untuk sementara Belum ada IPK
<?php endif; ?>
</div>
   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)->



	 <!-Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
 <?php elseif ($respon=='RB2SMT4-2'): ?>
	   <div class="panel panel-default">
	  <?php
	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	   ?>

	 <?php if ($view_ipk >=3.00 ): ?>

	 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	<div class="panel-body">
	 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	</div>


	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 YES <b  class="glyphicon glyphicon-ok"></b></a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 </p>
	 </div>
	 <?php endforeach; ?>



	 <?php else: ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 </div>


	  <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 </div>

	 <?php endforeach; ?>
	 <?php endif; ?>






	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 <div class="panel-body">
	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 <br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 </div>


	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 YES <b  class="glyphicon glyphicon-ok"></b> </a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-warning btn-lg" role="button">
	 NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	 </div>
	  <?php endforeach; ?>




	 <?php else: ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 </h1>
	 </div>


	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
	 </div>
	 <?php endforeach; ?>
	 <?php endif; ?>




	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	<div class="panel-body">
	 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	</div>



	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 YES <b  class="glyphicon glyphicon-ok"></b>
	 </a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-warning btn-lg" role="button">
	 NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	 </div>
	 <?php endforeach; ?>
	 <?php else: ?>


	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 </div>

	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 </div>
	 <?php endforeach; ?>
	 <?php endif; ?>



	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	<div class="panel-body">
	 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	</div>


	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 YES <b  class="glyphicon glyphicon-ok"></b></a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-warning btn-lg" role="button">
	 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
	 </div>
	 <?php endforeach; ?>


	 <?php else: ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 </div>

	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 </div>
	 <?php endforeach; ?>
	 <?php endif; ?>





	 <?php elseif($view_ipk <=1.99): ?>
	 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	<div class="panel-body">
	 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	</div>


	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 YES <b  class="glyphicon glyphicon-ok"></b></a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-warning btn-lg" role="button">
	 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
	 </div>
	 <?php endforeach; ?>


	 <?php else: ?>
	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <?php
	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

	 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
	 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
	 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
	 $view_ipk = number_format($ipk,2);?>

	 <?php if ($view_ipk >=3.00 ): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md"></h1>
	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 </span></div>

	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
	 </div>

	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 </h1></div>


	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 </h1></div>

	 <?php elseif($view_ipk <=1.99): ?>
	 <div class="panel-body">
	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
	 </div>

	 <?php else: ?>
	 Maff, untuk sementara Belum ada IPK
	 <?php endif; ?>


	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-primary btn-lg" role="button">
	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
	 </div>
	 <?php endforeach; ?>

	 <?php endif; ?>
	 <?php else: ?>
	  Maff, untuk sementara Belum ada IPK
	 <?php endif; ?>
	 </div>
 






 	  <?php elseif ($respon=='RB2SMT6-2'): ?>
	 	   <div class="panel panel-default">
	 	  <?php
	 	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 	   ?>

	 	 <?php if ($view_ipk >=3.00 ): ?>

	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	 	<div class="panel-body">
	 	 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	 	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	 	</div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 YES <b  class="glyphicon glyphicon-ok"></b></a>
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 	 </p>
	 	 </div>
	 	 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>


	 	  <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>

	 	 <?php endforeach; ?>
	 	 <?php endif; ?>






	 	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	 <div class="panel-body">
	 	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	 <br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	 </div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 YES <b  class="glyphicon glyphicon-ok"></b> </a>
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-warning btn-lg" role="button">
	 	 NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	 	 </div>
	 	  <?php endforeach; ?>




	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 	 </h1>
	 	 </div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>




	 	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	 	<div class="panel-body">
	 	 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	 	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	 	</div>



	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 YES <b  class="glyphicon glyphicon-ok"></b>
	 	 </a>
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-warning btn-lg" role="button">
	 	 NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php else: ?>


	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>

	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>



	 	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	 	<div class="panel-body">
	 	 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	 	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	 	</div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 YES <b  class="glyphicon glyphicon-ok"></b></a>
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-warning btn-lg" role="button">
	 	 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
	 	 </div>
	 	 <?php endforeach; ?>


	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>

	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>





	 	 <?php elseif($view_ipk <=1.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>

	 	 	<div class="panel-body">
	 	 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 	 	<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
	 	 	</div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 YES <b  class="glyphicon glyphicon-ok"></b></a>
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-warning btn-lg" role="button">
	 	 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
	 	 </div>
	 	 <?php endforeach; ?>


	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 	 <?php
	 	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

	 	 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
	 	 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
	 	 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
	 	 $view_ipk = number_format($ipk,2);?>

	 	 <?php if ($view_ipk >=3.00 ): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md"></h1>
	 	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 	 </span></div>

	 	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
	 	 </div>

	 	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 	 </h1></div>


	 	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 	 </h1></div>

	 	 <?php elseif($view_ipk <=1.99): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
	 	 </div>

	 	 <?php else: ?>
	 	 Maff, untuk sementara Belum ada IPK
	 	 <?php endif; ?>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
	 	 </div>
	 	 <?php endforeach; ?>

	 	 <?php endif; ?>
	 	 <?php else: ?>
	 	  Maff, untuk sementara Belum ada IPK
	 	 <?php endif; ?>
	 	 </div>
	 	    <!-Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->






				<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
			<?php elseif ($respon=='RB2SMT8-2'): ?>
				 <div class="panel panel-default">
				<?php
			 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
				 ?>

			 <?php if ($view_ipk >=3.00 ): ?>

			 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
				<br>  Apakah Anda Ingin Kontrak Semester Bawah ? </h1>
				</div>


			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 YES <b  class="glyphicon glyphicon-ok"></b></a>
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
			 </p>
			 </div>
			 <?php endforeach; ?>



			 <?php else: ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md">
			 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
			 </div>


				<div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
			 </div>

			 <?php endforeach; ?>
			 <?php endif; ?>






			 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
			 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>

			 <div class="panel-body">
			 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
			 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
			 <br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
			 </div>


			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 YES <b  class="glyphicon glyphicon-ok"></b> </a>
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-warning btn-lg" role="button">
			 NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
			 </div>
				<?php endforeach; ?>




			 <?php else: ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md">
			 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
			 </h1>
			 </div>


			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
			 </div>
			 <?php endforeach; ?>
			 <?php endif; ?>




			 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
			 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
				<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
				</div>



			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 YES <b  class="glyphicon glyphicon-ok"></b>
			 </a>
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-warning btn-lg" role="button">
			 NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
			 </div>
			 <?php endforeach; ?>
			 <?php else: ?>


			 <?php foreach ($mulai_Y_2_respon as $key): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md">
			 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
			 </div>

			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
			 </div>
			 <?php endforeach; ?>
			 <?php endif; ?>



			 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
			 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
				<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
				</div>


			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 YES <b  class="glyphicon glyphicon-ok"></b></a>
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-warning btn-lg" role="button">
			 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
			 </div>
			 <?php endforeach; ?>


			 <?php else: ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md">
			 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
			 </div>

			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
			 </div>
			 <?php endforeach; ?>
			 <?php endif; ?>





			 <?php elseif($view_ipk <=1.99): ?>
			 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
				<br>  Apakah Anda Ingin Kontrak Semester Atas ? </h1>
				</div>


			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 YES <b  class="glyphicon glyphicon-ok"></b></a>
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-warning btn-lg" role="button">
			 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
			 </div>
			 <?php endforeach; ?>


			 <?php else: ?>
			 <?php foreach ($mulai_Y_2_respon as $key): ?>
			 <?php
			 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

			 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
			 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
			 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
			 $view_ipk = number_format($ipk,2);?>

			 <?php if ($view_ipk >=3.00 ): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md"></h1>
			 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
			 </span></div>

			 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md">
			 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
			 </div>

			 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md">
			 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
			 </h1></div>


			 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md">
			 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
			 </h1></div>

			 <?php elseif($view_ipk <=1.99): ?>
			 <div class="panel-body">
			 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
			 <span class="btn btn-primary btn-md">
			 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
			 </div>

			 <?php else: ?>
			 Maff, untuk sementara Belum ada IPK
			 <?php endif; ?>


			 <div class="panel-footer">
			 <p class="bgbottom">
			 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
			 class="btn btn-primary btn-lg" role="button">
			 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
			 </div>
			 <?php endforeach; ?>

			 <?php endif; ?>
			 <?php else: ?>
				Maff, untuk sementara Belum ada IPK
			 <?php endif; ?>
			 </div>
 












	 <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->
	 <?php elseif ($respon=='RB1SMT2-2'): ?>

	 <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
 	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
	 <table class="table table-bordered table-striped">
	 <thead>
	 <tr>
	 <th width="80px">No</th>
	 <th>Kode MK</th>
	 <th>Matakuliah</th>
	 <th >SKS</th>
	 <th >Program Matakuliah ini ?</th>
	 </tr>
	 </thead>
	 <tbody >
	 <?php
	 $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks 
	 from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk
	  not   in (select ms.id_mk from mk_syarat ms WHERE  ms.syarat  
	  in (SELECT n.id_mk from nilai n WHERE n.akhir <=50)   )')->result();
	 $mhs = $this->session->userdata('id_mahasiswa');
	 $s=array();
	 $get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
	 foreach ($get_et->result() as  $value) {
	 $s[]=$value->id_mk_tawaran;}
	 $sub =  implode('',$s);
	 $sub1= substr($sub,0,2);
	 $sub2= substr($sub,2,2);
	 $sub3= substr($sub,4,2);
	 $sub4= substr($sub,6,2);
	 $sub5= substr($sub,8,2);
	 $sub6= substr($sub,10,2);
	 $sub7= substr($sub,12,2);
	 $sub8= substr($sub,14,2);
	 $sub9= substr($sub,16,2);
	 $sub10= substr($sub,18,2);
	 $sub11= substr($sub,20,2);
	 $sub12= substr($sub,0,1);

	 $start = 0;
	 foreach ($RB3 as $mk_tawaran):?>
	 <tr>
	 <td><?php echo ++$start ?></td>
	 <td><?php echo $mk_tawaran->kode_mk ?></td>
	 <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
	 <td align="center"><?php echo $mk_tawaran->sks ?></td>
	 <td style="text-align:center" width="200px">
	 <?php if (
	 $sub1==$mk_tawaran->id_mk_tawaran ||
	 $sub2==$mk_tawaran->id_mk_tawaran ||
	 $sub3==$mk_tawaran->id_mk_tawaran ||
	 $sub4==$mk_tawaran->id_mk_tawaran ||
	 $sub5==$mk_tawaran->id_mk_tawaran ||
	 $sub6==$mk_tawaran->id_mk_tawaran ||
	 $sub7==$mk_tawaran->id_mk_tawaran ||
	 $sub8==$mk_tawaran->id_mk_tawaran ||
	 $sub9==$mk_tawaran->id_mk_tawaran ||
	 $sub10==$mk_tawaran->id_mk_tawaran ||
	 $sub11==$mk_tawaran->id_mk_tawaran ||
	 $sub12==$mk_tawaran->id_mk_tawaran ): ?>

	 <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


	 <?php else: ?>
	 <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
	 <?php endif; ?>
	 </td>

	 </tr>
	 <?php endforeach; ?>
	 <tr>
	 <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
	 <td align="center">

	 <?php
	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>


	 <?php if ($view_ipk >=3.00 ): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 </span>


	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 </span>

	 <?php else: ?>
	 Maff, untuk sementara Belum ada IPK
	 <?php endif; ?>
	 </td>
	 </tr>
	 </tbody>
	 </table>



	 <div class="panel-footer">
	 <p class="bgbottom">
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 2,4,6,8 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
	 NO <b  class="glyphicon glyphicon-remove"></b></a></div>
	 <?php endforeach; ?>

	 <!--Batas RB3-->
	 <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->





	 <!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->

	 <?php elseif ($respon=='RB1SMT4-2'):   ?>
	 <input type="hidden" name="RB5_uri" value="<?php echo $this->uri->segment(3) ?>">
	 <!--JIKA RESPON DATA uri segment = RUNING BACKGROUND 3 (RB3)--------------------------->
	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
	 <table class="table table-bordered table-striped">
	 <thead>
	 <tr>
	 <th width="80px">No</th>
	 <th>Kode MK</th>
	 <th>Matakuliah</th>
	 <th >SKS</th>
	 <th >Program Matakuliah ini ?</th>
	 </tr>
	 </thead>
	 <tbody>
	 <?php
	 $RB3 = $this->db->query(' select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=14 and mt.id_mk not   in (select ms.id_mk from mk_syarat ms WHERE ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
	 $mhs = $this->session->userdata('id_mahasiswa');
	 $s=array();
	 $get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
	 foreach ($get_et->result() as  $value) {
	 $s[]=$value->id_mk_tawaran;
	 }
	 $sub =  implode('',$s);
	 $sub1= substr($sub,0,2);
	 $sub2= substr($sub,2,2);
	 $sub3= substr($sub,4,2);
	 $sub4= substr($sub,6,2);
	 $sub5= substr($sub,8,2);
	 $sub6= substr($sub,10,2);
	 $sub7= substr($sub,12,2);
	 $sub8= substr($sub,14,2);
	 $sub9= substr($sub,16,2);
	 $sub10= substr($sub,18,2);
	 $sub11= substr($sub,20,2);
	 $sub12= substr($sub,0,1);

	 $start = 0;
	 foreach ($RB3 as $mk_tawaran):
	 ?>
	 <tr>
	 <td><?php echo ++$start ?></td>
	 <td><?php echo $mk_tawaran->kode_mk ?></td>
	 <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
	 <td align="center"><?php echo $mk_tawaran->sks ?></td>
	 <td style="text-align:center" width="200px">
	 <?php if (
	 $sub1==$mk_tawaran->id_mk_tawaran ||
	 $sub2==$mk_tawaran->id_mk_tawaran ||
	 $sub3==$mk_tawaran->id_mk_tawaran ||
	 $sub4==$mk_tawaran->id_mk_tawaran ||
	 $sub5==$mk_tawaran->id_mk_tawaran ||
	 $sub6==$mk_tawaran->id_mk_tawaran ||
	 $sub7==$mk_tawaran->id_mk_tawaran ||
	 $sub8==$mk_tawaran->id_mk_tawaran ||
	 $sub9==$mk_tawaran->id_mk_tawaran ||
	 $sub10==$mk_tawaran->id_mk_tawaran ||
	 $sub11==$mk_tawaran->id_mk_tawaran ||
	 $sub12==$mk_tawaran->id_mk_tawaran ): ?>


	 <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
	 <?php else: ?>
	 <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
	 <?php endif; ?></td>
	 </tr>
	 <?php endforeach; ?>
	 <tr>
	 <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
	 <td align="center">

	 <?php
	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 ?>


	  <?php if ($view_ipk >=3.00 ): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 </span>

	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>

	 <?php else: ?>
	 Maff, untuk sementara Belum ada IPK
	 <?php endif; ?>
	 </td>
	 </tr>
	 </tbody>
	 </table>



	 <div class="panel-footer">
	 <p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
	 </a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 2
	 </a> </p>
	 </div>
	 <?php endforeach; ?>

 












 
	 <?php elseif ($respon=='RB1SMT6-2'): ?>
	 <input type="hidden" name="RB5_uri" value="<?php echo $this->uri->segment(3) ?>">
	 <!-JIKA RESPON DATA uri segment = RUNING BACKGROUND 3 (RB3)-->
	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
	 <table class="table table-bordered table-striped">
	 <thead>
	 <tr>
	 <th width="80px">No</th>
	 <th>Kode MK</th>
	 <th>Matakuliah</th>
	 <th >SKS</th>
	 <th >Program Matakuliah ini ?</th>
	 </tr>
	 </thead>
	 <tbody >
	 <?php
	 $RB3 = $this->db->query(' select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=16 and mt.id_mk not   in (select ms.id_mk from mk_syarat ms WHERE ms.syarat  in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) or  ms.syarat not in (SELECT n.id_mk from nilai n) )')->result();
	 $mhs = $this->session->userdata('id_mahasiswa');
	 $s=array();
	 $get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
	 foreach ($get_et->result() as  $value) {
	 $s[]=$value->id_mk_tawaran;
	 }
	 $sub =  implode('',$s);
	 $sub1= substr($sub,0,2);
	 $sub2= substr($sub,2,2);
	 $sub3= substr($sub,4,2);
	 $sub4= substr($sub,6,2);
	 $sub5= substr($sub,8,2);
	 $sub6= substr($sub,10,2);
	 $sub7= substr($sub,12,2);
	 $sub8= substr($sub,14,2);
	 $sub9= substr($sub,16,2);
	 $sub10= substr($sub,18,2);
	 $sub11= substr($sub,20,2);
	 $sub12= substr($sub,0,1);
	 $start = 0;
	 foreach ($RB3 as $mk_tawaran):
	 ?>
	 <tr>
	 <td><?php echo ++$start ?></td>
	 <td><?php echo $mk_tawaran->kode_mk ?></td>
	 <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
	 <td align="center"><?php echo $mk_tawaran->sks ?></td>
	 <td style="text-align:center" width="200px">
	 <?php if (
	 $sub1==$mk_tawaran->id_mk_tawaran ||
	 $sub2==$mk_tawaran->id_mk_tawaran ||
	 $sub3==$mk_tawaran->id_mk_tawaran ||
	 $sub4==$mk_tawaran->id_mk_tawaran ||
	 $sub5==$mk_tawaran->id_mk_tawaran ||
	 $sub6==$mk_tawaran->id_mk_tawaran ||
	 $sub7==$mk_tawaran->id_mk_tawaran ||
	 $sub8==$mk_tawaran->id_mk_tawaran ||
	 $sub9==$mk_tawaran->id_mk_tawaran ||
	 $sub10==$mk_tawaran->id_mk_tawaran ||
	 $sub11==$mk_tawaran->id_mk_tawaran ||
	 $sub12==$mk_tawaran->id_mk_tawaran ): ?>


	 <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
	 <?php else: ?>
	 <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
	 <?php endif; ?>
	 </td>

	 </tr>
	 <?php endforeach; ?>
	 <tr>
	 <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
	 <td align="center">

	 <?php
	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 ?>

	 <?php if ($view_ipk >=3.00 ): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 </span>

	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>

	 <?php else: ?>
	 Maff, untuk sementara Belum ada IPK
	 <?php endif; ?>
	 </td>
	 </tr>
	 </tbody>
	 </table>

	 <div class="panel-footer">
	 <p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
	 </a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 4
	 </a>
	 </p>
	 </div>

	 <?php endforeach; ?>
	 <!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)-->







	 <!--BATAS UNTUK RB9-->
	 <?php elseif ($respon=='RB1SMT8-2'): ?>
	 <input type="hidden" name="RB5_uri" value="<?php echo $this->uri->segment(3) ?>">
	 <!--JIKA RESPON DATA uri segment = RUNING BACKGROUND 3 (RB3)--------------------------->
	 <?php foreach ($mulai_Y_2_respon as $key): ?>
	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
	 <table class="table table-bordered table-striped">
	 <thead>
	 <tr>
	 <th width="80px">No</th>
	 <th>Kode MK</th>
	 <th>Matakuliah</th>
	 <th >SKS</th>
	 <th >Program Matakuliah ini ?</th>
	 </tr>
	 </thead>
	 <tbody >
	 <?php
	 $RB3 = $this->db->query(' select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=18 and mt.id_mk not   in (select ms.id_mk from mk_syarat ms WHERE ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) or  ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50)  )')->result();
	 $mhs = $this->session->userdata('id_mahasiswa');
	 $s=array();
	 $get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
	 foreach ($get_et->result() as  $value) {
	 $s[]=$value->id_mk_tawaran;
	 }
	   $sub =  implode('',$s);
	   $sub1= substr($sub,0,2);
	   $sub2= substr($sub,2,2);
	   $sub3= substr($sub,4,2);
	   $sub4= substr($sub,6,2);
	   $sub5= substr($sub,8,2);
	   $sub6= substr($sub,10,2);
	   $sub7= substr($sub,12,2);
	   $sub8= substr($sub,14,2);
	   $sub9= substr($sub,16,2);
	   $sub10= substr($sub,18,2);
	   $sub11= substr($sub,20,2);
	   $sub12= substr($sub,0,1);

	 $start = 0;
	 foreach ($RB3 as $mk_tawaran):
	 ?>
	 <tr>
	 <td><?php echo ++$start ?></td>
	 <td><?php echo $mk_tawaran->kode_mk ?></td>
	 <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
	 <td align="center"><?php echo $mk_tawaran->sks ?></td>
	 <td style="text-align:center" width="200px">
	 <?php if (
	   $sub1==$mk_tawaran->id_mk_tawaran ||
	   $sub2==$mk_tawaran->id_mk_tawaran ||
	   $sub3==$mk_tawaran->id_mk_tawaran ||
	   $sub4==$mk_tawaran->id_mk_tawaran ||
	   $sub5==$mk_tawaran->id_mk_tawaran ||
	   $sub6==$mk_tawaran->id_mk_tawaran ||
	   $sub7==$mk_tawaran->id_mk_tawaran ||
	   $sub8==$mk_tawaran->id_mk_tawaran ||
	   $sub9==$mk_tawaran->id_mk_tawaran ||
	   $sub10==$mk_tawaran->id_mk_tawaran ||
	   $sub11==$mk_tawaran->id_mk_tawaran ||
	   $sub12==$mk_tawaran->id_mk_tawaran ): ?>

	 <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
	 <?php else: ?>
	 <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
	 <?php endif; ?>
	 </td>
	 </tr>
	 <?php endforeach; ?>
	 <tr>
	 <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
	 <td align="center">

	 <?php
	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 ?>


	 <?php if ($view_ipk >=3.00 ): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 </span>

	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>

	 <?php else: ?>
	 Maff, untuk sementara Belum ada IPK
	 <?php endif; ?>
	 </td>
	 </tr>
	 </tbody>
	 </table>


	 <div class="panel-footer">
	 <p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
	 </a>
	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 6
	 </a></p> </div>
	 <?php endforeach; ?>
<!--batas untuk RB9-->

















<!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php else: ?>
  <!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php foreach ($mulai_Y_2_respon as $key): ?>
<div class="panel panel-default">
<div class="panel-body">
<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
</div>
<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
</a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>
<!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->

<?php endif;?>

<!--Batas semester 2 disini  :  Batas semester 2 disini : Batas semester 2 disini : Batas semester 2 disini-->
<!--Batas semester 2 disini  :  Batas semester 2 disini : Batas semester 2 disini : Batas semester 2 disini-->
<!--Batas semester 2 disini  :  Batas semester 2 disini : Batas semester 2 disini : Batas semester 2 disini-->
<!--Batas semester 2 disini  :  Batas semester 2 disini : Batas semester 2 disini : Batas semester 2 disini-->
<!--Batas semester 2 disini  :  Batas semester 2 disini : Batas semester 2 disini : Batas semester 2 disini-->
<!--Batas semester 2 disini  :  Batas semester 2 disini : Batas semester 2 disini : Batas semester 2 disini-->
<!--Batas semester 2 disini  :  Batas semester 2 disini : Batas semester 2 disini : Batas semester 2 disini-->
<!--Batas semester 2 disini  :  Batas semester 2 disini : Batas semester 2 disini : Batas semester 2 disini-->









<!--BUKA SEMESTER 4 DISINI-->

<?php elseif($dataget->total==4 or $dataget->total ==3): // DO AWMWATER 4?>

	<!--BUKA SEMESTER 4 DISINI-->
	<?php
	$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	?>

	<!---ipk-->
	<?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
	 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=3')->row();
	$maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
	 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=3')->row();
	$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
	$view_ipk = number_format($ipk,2)   ;
	 ?>
	 <!--ipk-->





	<?php $replace_cek = $this->Smart_model->validasiKRSentry(4);
	?>

	<?php if ($replace_cek): ?>
		<h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smartGenap/hapus_entry') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
		 <!--Alert pesan data sudah ada, dan di tampilkan-->
		<!--tampilkan data hasil krs yang masuk di tabel entry-->
		<table class="table table-bordered">
		<thead>
		<th>No</th>
		<th>Matakuliah</th>
		<th>Semester</th>
		<th>SKS</th>
		<th>Jam Masuk</th>
		<th>Jam Selesai</th>
		<th>Ruang Kuliah</th>
		<th>Kelas</th>
		<th>Hari</th>
		</thead>
		<?php
		$no=1;
		foreach ($H4 as $key): ?>  <tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $key->nama_matakuliah ?></td>
		<td><?php echo $key->nama_semester ?></td>
		<td><?php echo $key->sks ?></td>
		<td><?php echo $key->jam_masuk ?></td>
		<td><?php echo $key->jam_selesai ?></td>
		<td><?php echo $key->nama_ruangan ?></td>
		<td><?php echo $key->nama_kelas ?></td>
		<td><?php echo $key->hari ?></td>
		</tr>
		<?php endforeach; ?>
		</table>
		<div class="well col-md-12">
		<a href="<?php echo base_url('smartGenap/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
		</div>
		<!--tampilkan data hasil krs yang masuk di tabel entry-->
		<!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->
	<?php else: ?>







	<?php
	// Baca Kode Respon yang di Kirim dari database
	// Apakah Ada data yang di kirim pada uri segment ada atau tidak, yang datanya diberi nama $respon
	if ($respon==''):
	// jika respon ini kosong maka akan tampilkan pertanyaan awal, dengan kondisi pertanyaan mulai = Y
	// pertanyaan tersebut akan ditampilkan
	?>

					 <?php foreach ($mulai_Y_4 as $key): ?>
						 <div class="panel panel-default">
								 <div class="panel-body">
									 <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
								 </div>
								 <div class="panel-footer">
									 <p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
									 </a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
								 </div>
							 </div>
					 <?php endforeach; ?>








					 <!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2-->
					 <!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2-->
				 <?php elseif ($respon=='PKT4'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN ?>
					 <?php
					 $mhs = $this->session->userdata('id_mahasiswa');
					 $seg3= $this->uri->segment(3);
					 $paketsemester3= 'P4SMT4';

					 $dat1 = date('Y');
					 $dat2 = date('Y')-1;
						 $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural 
						 join matakuliah mk where mt.id_semester=14 and mt.id_mk not
						  in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

					 $PKT2 = $this->db->query('select mt.id_mk_tawaran  from mk_tawaran mt natural 
					 join matakuliah mk where mt.id_semester=14 and mt.id_mk not in 
					 (select ms.id_mk from mk_syarat ms WHERE ms.syarat in 
					 (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
					 //if ($RB3->sks<=12) {}

					 if ($view_ipk >=3.00 ) // jika IPK adalah lebih besar atau sama dengan 3.00

					 {

					 if ($RB3->sks<=24) //  perika apakah sks total matakuliah yang ditawarkan lebih kecil daripada
					 // 24 sks ?, jika ya, maka akan di masukan sebagai paket matakuliah.
					 {

					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 if ($total_A->total_A < $kelas_A->kapasitas ) {

					 foreach ($PKT2 as $key) {

					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
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
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }
					 // kelas C
					 elseif ($total_C->total_C < $kelas_C->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 } elseif ($total_D->total_D < $kelas_D->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 // jika tidak ada selain kelas D pada kelas PAGI
					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));}
					 } // Kelas Sore / Kelas Malam (K,L,X,Y)
					 else {

					 if ($total_K->total_K < $kelas_K->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 // KELAS L
					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 // kelas X
					 }
					 elseif ($total_X->total_X < $kelas_X->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 // KELAS Y
					 } elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Gagal Tersimpan.
					 </div>');


					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 } // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
					 } // else tutup kelas Sore

					 } else {  // TUTUP 24 SKS
						 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
					 <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));

					 }


					 } elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

					 if ($RB3->sks<=21) {

					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 $seg3= $this->uri->segment(3);
					 $seg4= $this->uri->segment(4);
					 if ($total_A->total_A < $kelas_A->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_B->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }
					 elseif ($total_D->total_D < $kelas_D->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

						redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }



					 }else { //kelas K
					 if ($total_K->total_K < $kelas_K->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 // batas pagi
					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" =>4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 } elseif ($total_X->total_X < $kelas_X->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1);
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Gagal Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }
								 } // else tutup kelas Sore

					 }else{
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
						<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
					 }



					 }elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
					 if ($RB3->sks<=18) {
					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 if ($total_A->total_A < $kelas_A->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_B->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }

					 }else {
					 if ($total_K->total_K < $kelas_K->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
						'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1);
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
						 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Gagal Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }



					 } // else tutup kelas Sore
					 } else {

						 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
						 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
							<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
					 }


					 }elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
					 if ($RB3->sks<=15) {
					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 if ($total_A->total_A < $kelas_A->kapasitas ) {

						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_B->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');


					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }

					 }else {
					 if ($total_K->total_K < $kelas_K->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }


					 } // else tutup kelas Sore
					 } else {
						 $this->session->set_flashdata('message',
						 '<div class="alert alert-danger">
						 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
							<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
						 </div>');
						 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
					 }



					 } elseif($view_ipk <=1.99){
					 if ($RB3->sks<=12) {
					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 if ($total_A->total_A < $kelas_A->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_B->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }
					 elseif ($total_C->total_C < $kelas_C->kapasitas ) {
					 # code...
						foreach ($PKT2 as $key) {
					 $result_replace = array(

					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
											 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
										 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }
					 elseif ($total_D->total_D < $kelas_D->kapasitas ) {
					 # code...
						foreach ($PKT2 as $key) {
					 $result_replace = array(

					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
											 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
									 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }else {
					 $this->session->set_flashdata('message',
											'<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

											 </div>');
											 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
							 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }

					 }else {

					 if ($total_K->total_K < $kelas_K->kapasitas ) {
					 # code...
					 foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');
											 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
					 # code...
						foreach ($PKT2 as $key) {
					 $result_replace = array(

					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
										 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }
					 elseif ($total_X->total_X < $kelas_X->kapasitas ) {
					 # code...
						foreach ($PKT2 as $key) {
					 $result_replace = array(

					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
									 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }
					 elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 4,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
							 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }else {
					 $this->session->set_flashdata('message',
												'<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

												 </div>');
									 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }


					 } // else tutup kelas Sore
					 } else {

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
						 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
							<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
					 }

					 } else{
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-warning">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Maaf</strong> Untuk sementara Belum ada data IPK.
					 </div>');
						 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
					 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }
					 ?>





				 <?php elseif ($respon=='P4SMT4') : ?>
					 <?php foreach ($mulai_Y_4_respon as $keys): ?>
					 <h1 class="lead"><?php echo $keys->nama_pertanyaan ?></h1>
					 <table class="table table-bordered">
					 <thead>
					 <th>No</th>
					 <th>Matakuliah</th>
					 <th>Semester</th>
					 <th>SKS</th>
					 <th>Jam Masuk</th>
					 <th>Jam Selesai</th>
					 <th>Ruang Kuliah</th>
					 <th>Kelas</th>
					 <th>Hari</th>
					 </thead>
					 <?php
					 $no=1;
					 foreach ($sem_2 as $key): ?>  <tr>
					 <td><?php echo $no++ ?></td>
					 <td><?php echo $key->nama_matakuliah ?></td>
					 <td><?php echo $key->nama_semester ?></td>
					 <td><?php echo $key->sks ?></td>
					 <td><?php echo $key->jam_masuk ?></td>
					 <td><?php echo $key->jam_selesai ?></td>
					 <td><?php echo $key->nama_ruangan ?></td>
					 <td><?php echo $key->nama_kelas ?></td>
					 <td><?php echo $key->hari ?></td>
					 </tr>
					 <?php endforeach; ?>
					 </table>

					 <div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>SmartGenap/simpanP6_H2"
					 class="btn btn-primary btn-lg" role="button"
					 onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
					 YES <b  class="glyphicon glyphicon-ok"></b></a>
					 <a href="<?php echo base_url()?>smartGenap/hapus_entry"
					 class="btn btn-warning btn-lg" role="button"
					 onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
					 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
					 </div>
					 <?php endforeach ?>







	 					 <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->
					 <?php elseif ($respon=='RB1SMT4-4'): ?>

	 					 <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
	 					   <!--JIKA RESPON DATA uri segment = RUNING BACKGROUND 3 (RB3)-->
	 					 <?php foreach ($mulai_Y_4_respon as $key): ?>
	 					 <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
	 					 <table class="table table-bordered table-striped">
	 					 <thead>
	 					 <tr>
	 					 <th width="80px">No</th>
	 					 <th>Kode MK</th>
	 					 <th>Matakuliah</th>
	 					 <th >SKS</th>
	 					 <th >Program Matakuliah ini ?</th>
	 					 </tr>
	 					 </thead>
	 					 <tbody >
	 					 <?php
	 					 $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=14 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
	 					 $mhs = $this->session->userdata('id_mahasiswa');
	 					 $s=array();
 	 					 foreach ($get_et->result() as  $value) {
	 					 $s[]=$value->id_mk_tawaran;}
	 					 $sub =  implode('',$s);
	 					 $sub1= substr($sub,0,2);
	 					 $sub2= substr($sub,2,2);
	 					 $sub3= substr($sub,4,2);
	 					 $sub4= substr($sub,6,2);
	 					 $sub5= substr($sub,8,2);
	 					 $sub6= substr($sub,10,2);
	 					 $sub7= substr($sub,12,2);
	 					 $sub8= substr($sub,14,2);
	 					 $sub9= substr($sub,16,2);
	 					 $sub10= substr($sub,18,2);
	 					 $sub11= substr($sub,20,2);
	 					 $sub12= substr($sub,0,1);

	 					 $start = 0;
	 					 foreach ($RB3 as $mk_tawaran):?>
	 					 <tr>
	 					 <td><?php echo ++$start ?></td>
	 					 <td><?php echo $mk_tawaran->kode_mk ?></td>
	 					 <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
	 					 <td align="center"><?php echo $mk_tawaran->sks ?></td>
	 					 <td style="text-align:center" width="200px">
	 					 <?php if (
	 					 $sub1==$mk_tawaran->id_mk_tawaran ||
	 					 $sub2==$mk_tawaran->id_mk_tawaran ||
	 					 $sub3==$mk_tawaran->id_mk_tawaran ||
	 					 $sub4==$mk_tawaran->id_mk_tawaran ||
	 					 $sub5==$mk_tawaran->id_mk_tawaran ||
	 					 $sub6==$mk_tawaran->id_mk_tawaran ||
	 					 $sub7==$mk_tawaran->id_mk_tawaran ||
	 					 $sub8==$mk_tawaran->id_mk_tawaran ||
	 					 $sub9==$mk_tawaran->id_mk_tawaran ||
	 					 $sub10==$mk_tawaran->id_mk_tawaran ||
	 					 $sub11==$mk_tawaran->id_mk_tawaran ||
	 					 $sub12==$mk_tawaran->id_mk_tawaran ): ?>

	 					 <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


	 					 <?php else: ?>
	 					 <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp4/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
	 					 <?php endif; ?>
	 					 </td>

	 					 </tr>
	 					 <?php endforeach; ?>
	 					 <tr>
	 					 <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
	 					 <td align="center">




	 					 <?php if ($view_ipk >=3.00 ): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 					 </span>


	 					 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 					 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 					 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 					 <?php elseif($view_ipk <=1.99): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 					 </span>

	 					 <?php else: ?>
	 					 Maff, untuk sementara Belum ada IPK
	 					 <?php endif; ?>
	 					 </td>
	 					 </tr>
	 					 </tbody>
	 					 </table>



	 					 <div class="panel-footer">
	 					 <p class="bgbottom">
	 					 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
	 					 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 					 class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 2,4,6,8 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
	 					 NO <b  class="glyphicon glyphicon-remove"></b></a></div>
	 					 <?php endforeach; ?>

	 					 <!--Batas RB3-->
	 					 <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->




				 <?php elseif($respon=='RB4SMT2'): ?>


					<?php $cek_semester2 = $this->Smart_model->mengulang_semester2_cekData(); ?>
					<?php foreach ($mengulang_semester2 as $key): ?>

					<?php if ($cek_semester2>0): ?>

	<?php redirect('smartGenap/index/'.$key->jika_ya); ?>

					<?php else: ?>
						<?php redirect('smartGenap/index/'.$key->jika_tidak); ?>

					<?php endif; ?>
				<?php endforeach; ?>






				<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
			<?php elseif ($respon=='RB2SMT4-4'): ?>
				  <div class="panel panel-default">
				 <?php
				$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
				  ?>

				<?php if ($view_ipk >=3.00 ): ?>

				<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
				</p>
				</div>
				<?php endforeach; ?>



				<?php else: ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>


				 <div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>

				<?php endforeach; ?>
				<?php endif; ?>






				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b> </a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				 <?php endforeach; ?>




				<?php else: ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1>
				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>




				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>



				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b>
				</a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php else: ?>


				<?php foreach ($mulai_Y_4_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>



				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>





				<?php elseif($view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_4_respon as $key): ?>


				<?php if ($view_ipk >=3.00 ): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md"></h1>
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
				</span></div>

				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>


				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>

				<?php elseif($view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php else: ?>
				Maff, untuk sementara Belum ada IPK
				<?php endif; ?>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>

				<?php endif; ?>
				<?php else: ?>
				 Maff, untuk sementara Belum ada IPK
				<?php endif; ?>
				</div>
				   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->










				 <?php elseif($respon=='RB3SMT2-4'): ?>

					<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
					<?php foreach ($mulai_Y_4_respon as $key): ?>
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
					<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th width="80px">No</th>
					<th>Kode MK</th>
					<th>Matakuliah</th>
					<th >SKS</th>
					<th >Program Matakuliah ini ?</th>
					</tr>
					</thead>
					<tbody >

					<?php

					$mhs = $this->session->userdata('id_mahasiswa');
					$s=array();

					foreach ($get_et->result() as  $value) {
					$s[]=$value->id_mk_tawaran;}
					$sub =  implode('',$s);
					$sub1= substr($sub,0,2);
					$sub2= substr($sub,2,2);
					$sub3= substr($sub,4,2);
					$sub4= substr($sub,6,2);
					$sub5= substr($sub,8,2);
					$sub6= substr($sub,10,2);
					$sub7= substr($sub,12,2);
					$sub8= substr($sub,14,2);
					$sub9= substr($sub,16,2);
					$sub10= substr($sub,18,2);
					$sub11= substr($sub,20,2);
					$sub12= substr($sub,0,1);
					$sub13= substr($sub,0);
					$sub14= substr($sub,1,2);
					$sub15= substr($sub,1,3);
					$sub16= substr($sub,3);
					$sub17= substr($sub,5);
					$sub18= substr($sub,7);

					$start = 0;
					$get_semester2 = $this->Smart_model->mengulang_semester2();
					foreach (	$get_semester2 as $mk_tawaran): ?>
					<tr>
					<td><?php echo ++$start ?></td>
					<td><?php echo $mk_tawaran->kode_mk ?></td>
					<td><?php echo $mk_tawaran->nama_matakuliah ?></td>
					<td align="center"><?php echo $mk_tawaran->sks ?></td>
					<td style="text-align:center" width="200px">
					<?php if (
					$sub1==$mk_tawaran->id_mk_tawaran or
					$sub2==$mk_tawaran->id_mk_tawaran or
					$sub3==$mk_tawaran->id_mk_tawaran or
					$sub4==$mk_tawaran->id_mk_tawaran or
					$sub5==$mk_tawaran->id_mk_tawaran or
					$sub6==$mk_tawaran->id_mk_tawaran or
					$sub7==$mk_tawaran->id_mk_tawaran or
					$sub8==$mk_tawaran->id_mk_tawaran or
					$sub9==$mk_tawaran->id_mk_tawaran or
					$sub10==$mk_tawaran->id_mk_tawaran or
					$sub11==$mk_tawaran->id_mk_tawaran or
					$sub12==$mk_tawaran->id_mk_tawaran or
					$sub13==$mk_tawaran->id_mk_tawaran or
					$sub14==$mk_tawaran->id_mk_tawaran or
					$sub15==$mk_tawaran->id_mk_tawaran or
					$sub16==$mk_tawaran->id_mk_tawaran or
					$sub17==$mk_tawaran->id_mk_tawaran or

					$sub18==$mk_tawaran->id_mk_tawaran ):  ?>

					<a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


					<?php else: ?>
					<a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp4/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
					<?php endif; ?>
					</td>

					</tr>
					<?php endforeach; ?>
					<tr>
					<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
					<td align="center">




					<?php if ($view_ipk >=3.00 ): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>


					<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>

					<?php else: ?>
					Maff, untuk sementara Belum ada IPK
					<?php endif; ?>
					</td>
					</tr>
					</tbody>
					</table>



					<div class="panel-footer">
					<p class="bgbottom">
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 4
				 </a></div>
					<?php endforeach; ?>
							<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->

						<?php elseif ($respon=='RB2SMT6-4'): ?>
							 <div class="panel panel-default">
							<?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
							 ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>

							<div class="panel-body">
							<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
							</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


							<div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
						 </div>



												 <div class="panel-footer">
												 <p class="bgbottom">
												 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
												 class="btn btn-primary btn-lg" role="button">
												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
												 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
												 </p>
												 </div>
												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>

							<div class="panel-body">
							<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

							</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>


						 <?php foreach ($mulai_Y_4_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>

							<div class="panel-body">
							<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

							</div>



												 <div class="panel-footer">
												 <p class="bgbottom">
												 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
												 class="btn btn-primary btn-lg" role="button">
												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
												 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
												 </p>
												 </div>
												 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>

							<div class="panel-body">
							<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

							</div>



												 <div class="panel-footer">
												 <p class="bgbottom">
												 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
												 class="btn btn-primary btn-lg" role="button">
												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
												 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
												 </p>
												 </div>
												 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_4_respon as $key): ?>
						 <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

						 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
						 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
						 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
						 $view_ipk = number_format($ipk,2);?>

						 <?php if ($view_ipk >=3.00 ): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md"></h1>
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
						 </span></div>

						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
						 </div>

						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1></div>


						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1></div>

						 <?php elseif($view_ipk <=1.99): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
						 </div>

						 <?php else: ?>
						 Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
							Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
								<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->

							<?php elseif ($respon=='RB2SMT8-4'): ?>
								 <div class="panel panel-default">
								<?php
							 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
								 ?>

							 <?php if ($view_ipk >=3.00 ): ?>

							 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
								</div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
							 </p>
							 </div>
							 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>


								<div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>

							 <?php endforeach; ?>
							 <?php endif; ?>






							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

							 <div class="panel-body">
							 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
							 </div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1>
							 </div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>




							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>




														 <div class="panel-footer">
														 <p class="bgbottom">
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
														 class="btn btn-primary btn-lg" role="button">
														 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
														 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
														 </p>
														 </div>
														 <?php endforeach; ?>

							 <?php else: ?>


							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>



							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


							 <?php else: ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>





							 <?php elseif($view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

							 <?php else: ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <?php
							 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

							 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
							 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
							 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
							 $view_ipk = number_format($ipk,2);?>

							 <?php if ($view_ipk >=3.00 ): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md"></h1>
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
							 </span></div>

							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>


							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>

							 <?php elseif($view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php else: ?>
							 Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>

							 <?php endif; ?>
							 <?php else: ?>
								Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>
							 </div>
									<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->


								<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
							<?php elseif ($respon=='RB2SMT2-4'): ?>
								 <div class="panel panel-default">
								<?php
							 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
								 ?>

							 <?php if ($view_ipk >=3.00 ): ?>

							 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
								</div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
							 </p>
							 </div>
							 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>


								<div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>

							 <?php endforeach; ?>
							 <?php endif; ?>






							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

							 <div class="panel-body">
							 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
							 </div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1>
							 </div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>




							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>




														 <div class="panel-footer">
														 <p class="bgbottom">
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
														 class="btn btn-primary btn-lg" role="button">
														 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
														 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
														 </p>
														 </div>
														 <?php endforeach; ?>

							 <?php else: ?>


							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>



							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


							 <?php else: ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>





							 <?php elseif($view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

							 <?php else: ?>
							 <?php foreach ($mulai_Y_4_respon as $key): ?>
							 <?php
							 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

							 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
							 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
							 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
							 $view_ipk = number_format($ipk,2);?>

							 <?php if ($view_ipk >=3.00 ): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md"></h1>
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
							 </span></div>

							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>


							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>

							 <?php elseif($view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php else: ?>
							 Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>

							 <?php endif; ?>
							 <?php else: ?>
								Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>
							 </div>
									<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->






                











								<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->
						  <?php elseif ($respon=='RB1SMT6-4'): ?>

						 	 <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
						 		 <!--JIKA RESPON DATA uri segment = RUNING BACKGROUND 3 (RB3)-->
						 	 <?php foreach ($mulai_Y_4_respon as $key): ?>
						 	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
						 	 <table class="table table-bordered table-striped">
						 	 <thead>
						 	 <tr>
						 	 <th width="80px">No</th>
						 	 <th>Kode MK</th>
						 	 <th>Matakuliah</th>
						 	 <th >SKS</th>
						 	 <th >Program Matakuliah ini ?</th>
						 	 </tr>
						 	 </thead>
						 	 <tbody >
						 	 <?php
						 	 $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=16 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 )   )')->result();
						 	 $mhs = $this->session->userdata('id_mahasiswa');
						 	 $s=array();
						 	 foreach ($get_et->result() as  $value) {
						 	 $s[]=$value->id_mk_tawaran;}
						 	 $sub =  implode('',$s);
						 	 $sub1= substr($sub,0,2);
						 	 $sub2= substr($sub,2,2);
						 	 $sub3= substr($sub,4,2);
						 	 $sub4= substr($sub,6,2);
						 	 $sub5= substr($sub,8,2);
						 	 $sub6= substr($sub,10,2);
						 	 $sub7= substr($sub,12,2);
						 	 $sub8= substr($sub,14,2);
						 	 $sub9= substr($sub,16,2);
						 	 $sub10= substr($sub,18,2);
						 	 $sub11= substr($sub,20,2);
						 	 $sub12= substr($sub,0,1);

						 	 $start = 0;
						 	 foreach ($RB3 as $mk_tawaran):?>
						 	 <tr>
						 	 <td><?php echo ++$start ?></td>
						 	 <td><?php echo $mk_tawaran->kode_mk ?></td>
						 	 <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
						 	 <td align="center"><?php echo $mk_tawaran->sks ?></td>
						 	 <td style="text-align:center" width="200px">
						 	 <?php if (
						 	 $sub1==$mk_tawaran->id_mk_tawaran ||
						 	 $sub2==$mk_tawaran->id_mk_tawaran ||
						 	 $sub3==$mk_tawaran->id_mk_tawaran ||
						 	 $sub4==$mk_tawaran->id_mk_tawaran ||
						 	 $sub5==$mk_tawaran->id_mk_tawaran ||
						 	 $sub6==$mk_tawaran->id_mk_tawaran ||
						 	 $sub7==$mk_tawaran->id_mk_tawaran ||
						 	 $sub8==$mk_tawaran->id_mk_tawaran ||
						 	 $sub9==$mk_tawaran->id_mk_tawaran ||
						 	 $sub10==$mk_tawaran->id_mk_tawaran ||
						 	 $sub11==$mk_tawaran->id_mk_tawaran ||
						 	 $sub12==$mk_tawaran->id_mk_tawaran ): ?>

						 	 <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


						 	 <?php else: ?>
						 	 <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp4/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
						 	 <?php endif; ?>
						 	 </td>

						 	 </tr>
						 	 <?php endforeach; ?>
						 	 <tr>
						 	 <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
						 	 <td align="center">




						 	 <?php if ($view_ipk >=3.00 ): ?>
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
						 	 </span>


						 	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 	 <?php elseif($view_ipk <=1.99): ?>
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
						 	 </span>

						 	 <?php else: ?>
						 	 Maff, untuk sementara Belum ada IPK
						 	 <?php endif; ?>
						 	 </td>
						 	 </tr>
						 	 </tbody>
						 	 </table>



						 	 <div class="panel-footer">
						 	 <p class="bgbottom">
						 	 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 4
							 </a></div>
						 	 <?php endforeach; ?>

						 	 <!--Batas RB3-->
						 	 <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3) -->





							 <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->
						 <?php elseif ($respon=='RB1SMT8-4'): ?>

						  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
						 	 <!--JIKA RESPON DATA uri segment = RUNING BACKGROUND 3 (RB3)-->
						  <?php foreach ($mulai_Y_4_respon as $key): ?>
						  <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
						  <table class="table table-bordered table-striped">
						  <thead>
						  <tr>
						  <th width="80px">No</th>
						  <th>Kode MK</th>
						  <th>Matakuliah</th>
						  <th >SKS</th>
						  <th >Program Matakuliah ini ?</th>
						  </tr>
						  </thead>
						  <tbody >
						  <?php
						  $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=18 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 )   )')->result();

						  $mhs = $this->session->userdata('id_mahasiswa');
						  $s=array();
						  foreach ($get_et->result() as  $value) {
						  $s[]=$value->id_mk_tawaran;}
						  $sub =  implode('',$s);
						  $sub1= substr($sub,0,2);
						  $sub2= substr($sub,2,2);
						  $sub3= substr($sub,4,2);
						  $sub4= substr($sub,6,2);
						  $sub5= substr($sub,8,2);
						  $sub6= substr($sub,10,2);
						  $sub7= substr($sub,12,2);
						  $sub8= substr($sub,14,2);
						  $sub9= substr($sub,16,2);
						  $sub10= substr($sub,18,2);
						  $sub11= substr($sub,20,2);
						  $sub12= substr($sub,0,1);

						  $start = 0;
						  foreach ($RB3 as $mk_tawaran):?>
						  <tr>
						  <td><?php echo ++$start ?></td>
						  <td><?php echo $mk_tawaran->kode_mk ?></td>
						  <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
						  <td align="center"><?php echo $mk_tawaran->sks ?></td>
						  <td style="text-align:center" width="200px">
						  <?php if (
						  $sub1==$mk_tawaran->id_mk_tawaran ||
						  $sub2==$mk_tawaran->id_mk_tawaran ||
						  $sub3==$mk_tawaran->id_mk_tawaran ||
						  $sub4==$mk_tawaran->id_mk_tawaran ||
						  $sub5==$mk_tawaran->id_mk_tawaran ||
						  $sub6==$mk_tawaran->id_mk_tawaran ||
						  $sub7==$mk_tawaran->id_mk_tawaran ||
						  $sub8==$mk_tawaran->id_mk_tawaran ||
						  $sub9==$mk_tawaran->id_mk_tawaran ||
						  $sub10==$mk_tawaran->id_mk_tawaran ||
						  $sub11==$mk_tawaran->id_mk_tawaran ||
						  $sub12==$mk_tawaran->id_mk_tawaran ): ?>

						  <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


						  <?php else: ?>
						  <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp4/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
						  <?php endif; ?>
						  </td>

						  </tr>
						  <?php endforeach; ?>
						  <tr>
						  <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
						  <td align="center">




						  <?php if ($view_ipk >=3.00 ): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
						  </span>


						  <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						  <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						  <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						  <?php elseif($view_ipk <=1.99): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
						  </span>

						  <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						  <?php endif; ?>
						  </td>
						  </tr>
						  </tbody>
						  </table>



						  <div class="panel-footer">
						  <p class="bgbottom">
						  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
						  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 6
						  </a></div>
						  <?php endforeach; ?>

						  <!--Batas RB3-->
						  <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->








	<?php else: ?>
	<!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
	<?php foreach ($mulai_Y_4_respon as $key): ?>
	<div class="panel panel-default">
	<div class="panel-body">
	<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
	</div>
	<div class="panel-footer">
	<p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
	</a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	</div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>


	<?php endif; // close all process when not have data from table_temporary ?>













	<!--BUKA SEMESTER 6 DISINI-->

<?php elseif( $dataget->total==6 or $dataget->total ==5): // DO AWMWATER 6?>
<?php
	$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
	join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	?>
	<!--BUKA SEMESTER 6 DISINI-->

<?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=5')->row();
$maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=5')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2)   ; ?>



<?php $replace_cek = $this->Smart_model->validasiKRSentry(6);
	?>

	<?php if ($replace_cek): ?>
		<h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smartGenap/hapus_entry') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
		 <!--Alert pesan data sudah ada, dan di tampilkan-->
		<!--tampilkan data hasil krs yang masuk di tabel entry-->
		<table class="table table-bordered">
		<thead>
		<th>No</th>
		<th>Matakuliah</th>
		<th>Semester</th>
		<th>SKS</th>
		<th>Jam Masuk</th>
		<th>Jam Selesai</th>
		<th>Ruang Kuliah</th>
		<th>Kelas</th>
		<th>Hari</th>
		</thead>
		<?php
		$no=1;
		foreach ($H4 as $key): ?>  <tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $key->nama_matakuliah ?></td>
		<td><?php echo $key->nama_semester ?></td>
		<td><?php echo $key->sks ?></td>
		<td><?php echo $key->jam_masuk ?></td>
		<td><?php echo $key->jam_selesai ?></td>
		<td><?php echo $key->nama_ruangan ?></td>
		<td><?php echo $key->nama_kelas ?></td>
		<td><?php echo $key->hari ?></td>
		</tr>
		<?php endforeach; ?>
		</table>
		<div class="well col-md-12">
		<a href="<?php echo base_url('smartGenap/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
		</div>
		<!--tampilkan data hasil krs yang masuk di tabel entry-->
		<!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->


<?php else: ?>

<?php
 
	// Baca Kode Respon yang di Kirim dari database
	// Apakah Ada data yang di kirim pada uri segment ada atau tidak, yang datanya diberi nama $respon
	if ($respon==''):
	// jika respon ini kosong maka akan tampilkan pertanyaan awal, dengan kondisi pertanyaan mulai = Y
	// pertanyaan tersebut akan ditampilkan
	?>

					 <?php foreach ($mulai_Y_6 as $key): ?>
						 <div class="panel panel-default">
								 <div class="panel-body">
									 <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
								 </div>
								 <div class="panel-footer">
									 <p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-forward"></b>
									 </a>  
									  </div>
							 </div>
					 <?php endforeach; ?>

<!--
 SELECT mk.nama_matakuliah,mk.sks,jm.jam_masuk,jm.jam_selesai,rk.nama_ruangan

from bidangminat bm join matakuliah mk on mk.id_mk=bm.id_mk join mk_tawaran mt on mt.id_mk=bm.id_mk 
join jadwal_mk jm on jm.id_mk_tawaran=mt.id_mk_tawaran 
join ruang_kuliah rk on rk.id_ruang_kuliah=jm.id_ruang_kuliah

WHERE bm.semester=6 and bm.id_minat=3
UNION 

SELECT mk.nama_matakuliah,mk.sks,jm.jam_masuk,jm.jam_selesai,rk.nama_ruangan

from mk_tawaran mt join matakuliah mk on mk.id_mk=mt.id_mk 
join jadwal_mk jm on jm.id_mk_tawaran=mt.id_mk_tawaran
join ruang_kuliah rk on rk.id_ruang_kuliah=jm.id_ruang_kuliah
WHERE mt.id_semester=16 SELECT * FROM `mk` WHERE 1 
 
 


Batas untuk rekomendasi Bidang Minat-->

<?php elseif ($respon=='PKT6PPK'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
<?php
$mhs = $this->session->userdata('id_mahasiswa');
$seg3= $this->uri->segment(3);
$paketsemester2= 'P4SMT6';

$dat1 = date('Y');
$dat2 = date('Y')-1;
  $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural 
  join matakuliah mk where mt.id_semester=16 and mt.id_mk not in 
  (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();



$PKT2 = $this->db->query('select mt.id_mk_tawaran from mk_tawaran mt where mt.id_mk 
in (select b.id_mk from bidangminat b where b.id_minat=2 AND b.semester=6) 
UNION
 select mt.id_mk_tawaran from mk_tawaran mt where mt.id_mk 
not in (select b.id_mk from bidangminat b) and mt.id_semester=16  ')->result();
//if ($RB3->sks<=12) {}

if ($view_ipk >=3.00 ) // jika IPK adalah lebih besar atau sama dengan 3.00

{

if ($RB3->sks<=24) //  perika apakah sks total matakuliah yang ditawarkan lebih kecil daripada
// 24 sks ?, jika ya, maka akan di masukan sebagai paket matakuliah.
{

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {

foreach ($PKT2 as $key) {

$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
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
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}
// kelas C
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


} elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));



// jika tidak ada selain kelas D pada kelas PAGI
}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));}
} // Kelas Sore / Kelas Malam (K,L,X,Y)
else {

if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

// KELAS L
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

// kelas X
}
elseif ($total_X->total_X < $kelas_X->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


// KELAS Y
} elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');


redirect(site_url('smartGenap/index/'.$paketsemester2));


} // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
} // else tutup kelas Sore

} else {  // TUTUP 24 SKS
  $this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));

}


} elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

if ($RB3->sks<=21) {

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
$seg3= $this->uri->segment(3);
$seg4= $this->uri->segment(4);
if ($total_A->total_A < $kelas_A->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

 redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}



}else { //kelas K
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


// batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

} elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}
      } // else tutup kelas Sore

}else{
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
 <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}



}elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
if ($RB3->sks<=18) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}

}else {
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
 '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
  </div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}



} // else tutup kelas Sore
} else {

  $this->session->set_flashdata('message',
'<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}


}elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
if ($RB3->sks<=15) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {

	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');


redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));



}

}else {
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}


} // else tutup kelas Sore
} else {
  $this->session->set_flashdata('message',
  '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
  </div>');
	redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}



} elseif($view_ipk <=1.99){
if ($RB3->sks<=12) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
          redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
        redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}else {
$this->session->set_flashdata('message',
           '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
    redirect(site_url('smartGenap/index/'.$paketsemester2));
}

}else {

if ($total_K->total_K < $kelas_K->kapasitas ) {
# code...
foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
          redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_X->total_X < $kelas_X->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
        redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Paket Matakuliah Bidang Minat Semester 6 </strong> Berhasil Tersimpan.

            </div>');
    redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}else {
$this->session->set_flashdata('message',
             '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.

              </div>');
        redirect(site_url('smartGenap/index/'.$paketsemester2));
}


} // else tutup kelas Sore
} else {

$this->session->set_flashdata('message',
'<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}

} else{
$this->session->set_flashdata('message',
'<div class="alert alert-warning">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maaf</strong> Untuk sementara Belum ada data IPK.
</div>');
  // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
// redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
redirect(site_url('smartGenap/index/'.$paketsemester2));
}
?>


<?php elseif ($respon=='PKT6JCM'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
<?php
$mhs = $this->session->userdata('id_mahasiswa');
$seg3= $this->uri->segment(3);
$paketsemester2= 'P4SMT6';

$dat1 = date('Y');
$dat2 = date('Y')-1;
  $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural 
  join matakuliah mk where mt.id_semester=16 and mt.id_mk not in 
  (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();


$PKT2 = $this->db->query('select mt.id_mk_tawaran from mk_tawaran mt where mt.id_mk 
in (select b.id_mk from bidangminat b where b.id_minat=3 AND b.semester=6) 
UNION
 select mt.id_mk_tawaran from mk_tawaran mt where mt.id_mk 
not in (select b.id_mk from bidangminat b) and mt.id_semester=16  ')->result();
//if ($RB3->sks<=12) {}

if ($view_ipk >=3.00 ) // jika IPK adalah lebih besar atau sama dengan 3.00

{

if ($RB3->sks<=24) //  perika apakah sks total matakuliah yang ditawarkan lebih kecil daripada
// 24 sks ?, jika ya, maka akan di masukan sebagai paket matakuliah.
{

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {

foreach ($PKT2 as $key) {

$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
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
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}
// kelas C
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


} elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));



// jika tidak ada selain kelas D pada kelas PAGI
}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));}
} // Kelas Sore / Kelas Malam (K,L,X,Y)
else {

if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

// KELAS L
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

// kelas X
}
elseif ($total_X->total_X < $kelas_X->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


// KELAS Y
} elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');


redirect(site_url('smartGenap/index/'.$paketsemester2));


} // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
} // else tutup kelas Sore

} else {  // TUTUP 24 SKS
  $this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));

}


} elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

if ($RB3->sks<=21) {

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
$seg3= $this->uri->segment(3);
$seg4= $this->uri->segment(4);
if ($total_A->total_A < $kelas_A->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

 redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}



}else { //kelas K
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


// batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

} elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}
      } // else tutup kelas Sore

}else{
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
 <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}



}elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
if ($RB3->sks<=18) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}

}else {
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
 '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
  </div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}



} // else tutup kelas Sore
} else {

  $this->session->set_flashdata('message',
'<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}


}elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
if ($RB3->sks<=15) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {

	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');


redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));



}

}else {
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}


} // else tutup kelas Sore
} else {
  $this->session->set_flashdata('message',
  '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
  </div>');
	redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}



} elseif($view_ipk <=1.99){
if ($RB3->sks<=12) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
          redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
        redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}else {
$this->session->set_flashdata('message',
           '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
    redirect(site_url('smartGenap/index/'.$paketsemester2));
}

}else {

if ($total_K->total_K < $kelas_K->kapasitas ) {
# code...
foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
          redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_X->total_X < $kelas_X->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
        redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Paket Matakuliah Bidang Minat Semester 6 </strong> Berhasil Tersimpan.

            </div>');
    redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}else {
$this->session->set_flashdata('message',
             '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.

              </div>');
        redirect(site_url('smartGenap/index/'.$paketsemester2));
}


} // else tutup kelas Sore
} else {

$this->session->set_flashdata('message',
'<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}

} else{
$this->session->set_flashdata('message',
'<div class="alert alert-warning">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maaf</strong> Untuk sementara Belum ada data IPK.
</div>');
  // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
// redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
redirect(site_url('smartGenap/index/'.$paketsemester2));
}
?>



<?php elseif ($respon=='PKT6SC'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
<?php
$mhs = $this->session->userdata('id_mahasiswa');
$seg3= $this->uri->segment(3);
$paketsemester2= 'P4SMT6';

$dat1 = date('Y');
$dat2 = date('Y')-1;
  $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural 
  join matakuliah mk where mt.id_semester=16 and mt.id_mk not in 
  (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();
 
 

$PKT2 = $this->db->query('select mt.id_mk_tawaran from mk_tawaran mt where mt.id_mk 
in (select b.id_mk from bidangminat b where b.id_minat=1 AND b.semester=6) 
UNION
 select mt.id_mk_tawaran from mk_tawaran mt where mt.id_mk 
not in (select b.id_mk from bidangminat b) and mt.id_semester=16  ')->result();
 //if ($RB3->sks<=12) {}

if ($view_ipk >=3.00 ) // jika IPK adalah lebih besar atau sama dengan 3.00

{

if ($RB3->sks<=24) //  perika apakah sks total matakuliah yang ditawarkan lebih kecil daripada
// 24 sks ?, jika ya, maka akan di masukan sebagai paket matakuliah.
{

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {

foreach ($PKT2 as $key) {

$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
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
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}
// kelas C
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


} elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));



// jika tidak ada selain kelas D pada kelas PAGI
}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));}
} // Kelas Sore / Kelas Malam (K,L,X,Y)
else {

if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

// KELAS L
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

// kelas X
}
elseif ($total_X->total_X < $kelas_X->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


// KELAS Y
} elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');


redirect(site_url('smartGenap/index/'.$paketsemester2));


} // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
} // else tutup kelas Sore

} else {  // TUTUP 24 SKS
  $this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));

}


} elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

if ($RB3->sks<=21) {

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
$seg3= $this->uri->segment(3);
$seg4= $this->uri->segment(4);
if ($total_A->total_A < $kelas_A->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

 redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}



}else { //kelas K
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


// batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

} elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}
      } // else tutup kelas Sore

}else{
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
 <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}



}elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
if ($RB3->sks<=18) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}

}else {
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
 '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
  </div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));

}



} // else tutup kelas Sore
} else {

  $this->session->set_flashdata('message',
'<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}


}elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
if ($RB3->sks<=15) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {

	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
 redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_C->total_C < $kelas_C->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_D->total_D < $kelas_D->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
</div>');


redirect(site_url('smartGenap/index/'.$paketsemester2));



}else {
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));



}

}else {
if ($total_K->total_K < $kelas_K->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_X->total_X < $kelas_X->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}else {
$this->session->set_flashdata('message',
'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));

}


} // else tutup kelas Sore
} else {
  $this->session->set_flashdata('message',
  '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
  </div>');
	redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}



} elseif($view_ipk <=1.99){
if ($RB3->sks<=12) {
if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
if ($total_A->total_A < $kelas_A->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');

redirect(site_url('smartGenap/index/'.$paketsemester2));


}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
		foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_B->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_C->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
          redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_D->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
        redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}else {
$this->session->set_flashdata('message',
           '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.

            </div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
    redirect(site_url('smartGenap/index/'.$paketsemester2));
}

}else {

if ($total_K->total_K < $kelas_K->kapasitas ) {
# code...
foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_K->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1 );
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.
</div>');
            // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_L->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
          redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_X->total_X < $kelas_X->kapasitas ) {
# code...
	foreach ($PKT2 as $key) {
$result_replace = array(

"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_X->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}
$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Berhasil Tersimpan.

            </div>');
        redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}
elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

	foreach ($PKT2 as $key) {
$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('Y'),
"semester_aktif" => 6,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $key->id_mk_tawaran,
"id_kelas"       => $kelas_Y->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
}

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Paket Matakuliah Bidang Minat Semester 6 </strong> Berhasil Tersimpan.

            </div>');
    redirect(site_url('smartGenap/index/'.$paketsemester2));
// batas pagi
}else {
$this->session->set_flashdata('message',
             '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Paket Matakuliah Bidang Minat Semester 6</strong> Gagal Tersimpan.

              </div>');
        redirect(site_url('smartGenap/index/'.$paketsemester2));
}


} // else tutup kelas Sore
} else {

$this->session->set_flashdata('message',
'<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
</div>');
redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
}

} else{
$this->session->set_flashdata('message',
'<div class="alert alert-warning">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maaf</strong> Untuk sementara Belum ada data IPK.
</div>');
  // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
// redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
redirect(site_url('smartGenap/index/'.$paketsemester2));
}
?>

 

	 



<?php elseif($respon=='PKT6EMPTY'):?>
 
 <?php foreach ($mulai_Y_6_respon as $key): ?>
	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
	 <table class="table table-bordered table-striped">
	 <thead>
	 <tr>
	 <th width="80px">No</th>
	 <th>Kode MK</th>
	 <th>Matakuliah</th>
	 <th >SKS</th>
	 <th >Program Matakuliah ini ?</th>
	 </tr>
	 </thead>
	 <tbody >
	 <?php
	 $RB3 =  $this->Smart_model->pkt6();

	  $mhs = $this->session->userdata('id_mahasiswa');
	 $s=array();
	 $get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
	 foreach ($get_et->result() as  $value) {
	 $s[]=$value->id_mk_tawaran;
	 }
	 $sub =  implode('',$s);
	 $sub1= substr($sub,0,2);
	 $sub2= substr($sub,2,2);
	 $sub3= substr($sub,4,2);
	 $sub4= substr($sub,6,2);
	 $sub5= substr($sub,8,2);
	 $sub6= substr($sub,10,2);
	 $sub7= substr($sub,12,2);
	 $sub8= substr($sub,14,2);
	 $sub9= substr($sub,16,2);
	 $sub10= substr($sub,18,2);
	 $sub11= substr($sub,20,2);
	 $sub12= substr($sub,0,1);
	 $start = 0;
	 foreach ($RB3 as $mk_tawaran):
	 ?>
	 <tr>
	 <td><?php echo ++$start ?></td>
	 <td><?php echo $mk_tawaran->kode_mk ?></td>
	 <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
	 <td align="center"><?php echo $mk_tawaran->sks ?></td>
	 <td style="text-align:center" width="200px">
	 <?php if (
	 $sub1==$mk_tawaran->id_mk_tawaran ||
	 $sub2==$mk_tawaran->id_mk_tawaran ||
	 $sub3==$mk_tawaran->id_mk_tawaran ||
	 $sub4==$mk_tawaran->id_mk_tawaran ||
	 $sub5==$mk_tawaran->id_mk_tawaran ||
	 $sub6==$mk_tawaran->id_mk_tawaran ||
	 $sub7==$mk_tawaran->id_mk_tawaran ||
	 $sub8==$mk_tawaran->id_mk_tawaran ||
	 $sub9==$mk_tawaran->id_mk_tawaran ||
	 $sub10==$mk_tawaran->id_mk_tawaran ||
	 $sub11==$mk_tawaran->id_mk_tawaran ||
	 $sub12==$mk_tawaran->id_mk_tawaran ): ?>


	 <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
	 <?php else: ?>
	 <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp6/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
	 <?php endif; ?>
	 </td>

	 </tr>
	 <?php endforeach; ?>
	 <tr>
	 <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
	 <td align="center">

	 <?php
	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
	 join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 ?>

	 <?php if ($view_ipk >=3.00 ): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 </span>

	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 <?php elseif($view_ipk <=1.99): ?>
	 <span class="btn btn-primary btn-md">
	 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>

	 <?php else: ?>
	 Maff, untuk sementara Belum ada IPK
	 <?php endif; ?>
	 </td>
	 </tr>
	 </tbody>
	 </table>

	 <div class="panel-footer">
	 <p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
	 </a>
 
	 </p>
	 </div>

	 <?php endforeach; ?>
	 <!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)-->




 


<?php elseif ($respon=='P4SMT6') : ?>
					 <?php foreach ($mulai_Y_6_respon as $keys): ?>
					 <h1 class="lead"><?php echo $keys->nama_pertanyaan ?></h1>
					 <table class="table table-bordered">
					 <thead>
					 <th>No</th>
					 <th>Matakuliah</th>
					 <th>Semester</th>
					 <th>SKS</th>
					 <th>Jam Masuk</th>
					 <th>Jam Selesai</th>
					 <th>Ruang Kuliah</th>
					 <th>Kelas</th>
					 <th>Hari</th>
					 </thead>
					 <?php
					 $no=1;
					 foreach ($sem_2 as $key): ?>  <tr>
					 <td><?php echo $no++ ?></td>
					 <td><?php echo $key->nama_matakuliah ?></td>
					 <td><?php echo $key->nama_semester ?></td>
					 <td><?php echo $key->sks ?></td>
					 <td><?php echo $key->jam_masuk ?></td>
					 <td><?php echo $key->jam_selesai ?></td>
					 <td><?php echo $key->nama_ruangan ?></td>
					 <td><?php echo $key->nama_kelas ?></td>
					 <td><?php echo $key->hari ?></td>
					 </tr>
					 <?php endforeach; ?>
					 </table>

					 <div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>SmartGenap/simpanP6_H2"
					 class="btn btn-primary btn-lg" role="button"
					 onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
					 YES <b  class="glyphicon glyphicon-ok"></b></a>
					 <a href="<?php echo base_url()?>smartGenap/hapus_entry_temp"
					 class="btn btn-warning btn-lg" role="button"
					 onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
					 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
					 </div>
					 <?php endforeach ?>



   <?php elseif($respon=='RB4SMT2-6'): ?>
	<?php $cek_semester2 = $this->Smart_model->mengulang_semester2_cekData(); ?>
	<?php $key = $this->Smart_model->valid_semester2s($this->uri->segment(3)); ?>
	<?php if ($cek_semester2>0): ?>
	<?php redirect('smartGenap/index/'.$key->jika_ya); ?>
	<?php else: ?>
	<?php redirect('smartGenap/index/'.$key->jika_tidak); ?>
	<?php endif; ?>
 

 <?php elseif($respon=='RB4SMT4-6'): ?>
	<?php $cek_semester2 = $this->Smart_model->mengulang_semester4_cekData(); ?>
	<?php $key = $this->Smart_model->valid_semester2s($this->uri->segment(3)); ?>
	<?php if ($cek_semester2>0): ?>
	<?php redirect('smartGenap/index/'.$key->jika_ya); ?>
	<?php else: ?>
	<?php redirect('smartGenap/index/'.$key->jika_tidak); ?>
	<?php endif; ?>




<?php elseif($respon=='RB4SMT8-6'): ?>
	<?php $cek_semester2 = $this->Smart_model->mengulang_semester8_cekData(); ?>
	<?php $key = $this->Smart_model->valid_semester2s($this->uri->segment(3)); ?>
	<?php if ($cek_semester2>0): ?>
	<?php redirect('smartGenap/index/'.$key->jika_ya); ?>
	<?php else: ?>
	<?php redirect('smartGenap/index/'.$key->jika_tidak); ?>
	<?php endif; ?>



 <?php elseif($respon=='RB3SMT2-6'): ?>
  			<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
					<?php foreach ($mulai_Y_6_respon as $key): ?>
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
					<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th width="80px">No</th>
					<th>Kode MK</th>
					<th>Matakuliah</th>
					<th >SKS</th>
					<th >Program Matakuliah ini ?</th>
					</tr>
					</thead>
					<tbody >

					<?php

					$mhs = $this->session->userdata('id_mahasiswa');
					$s=array();

					foreach ($get_et->result() as  $value) {
					$s[]=$value->id_mk_tawaran;}
					$sub =  implode('',$s);
					$sub1= substr($sub,0,2);
					$sub2= substr($sub,2,2);
					$sub3= substr($sub,4,2);
					$sub4= substr($sub,6,2);
					$sub5= substr($sub,8,2);
					$sub6= substr($sub,10,2);
					$sub7= substr($sub,12,2);
					$sub8= substr($sub,14,2);
					$sub9= substr($sub,16,2);
					$sub10= substr($sub,18,2);
					$sub11= substr($sub,20,2);
					$sub12= substr($sub,0,1);
					$sub13= substr($sub,0);
					$sub14= substr($sub,1,2);
					$sub15= substr($sub,1,3);
					$sub16= substr($sub,3);
					$sub17= substr($sub,5);
					$sub18= substr($sub,7);

					$start = 0;
					$get_semester2 = $this->Smart_model->mengulang_semester2();
					foreach (	$get_semester2 as $mk_tawaran): ?>
					<tr>
					<td><?php echo ++$start ?></td>
					<td><?php echo $mk_tawaran->kode_mk ?></td>
					<td><?php echo $mk_tawaran->nama_matakuliah ?></td>
					<td align="center"><?php echo $mk_tawaran->sks ?></td>
					<td style="text-align:center" width="200px">
					<?php if (
					$sub1==$mk_tawaran->id_mk_tawaran or
					$sub2==$mk_tawaran->id_mk_tawaran or
					$sub3==$mk_tawaran->id_mk_tawaran or
					$sub4==$mk_tawaran->id_mk_tawaran or
					$sub5==$mk_tawaran->id_mk_tawaran or
					$sub6==$mk_tawaran->id_mk_tawaran or
					$sub7==$mk_tawaran->id_mk_tawaran or
					$sub8==$mk_tawaran->id_mk_tawaran or
					$sub9==$mk_tawaran->id_mk_tawaran or
					$sub10==$mk_tawaran->id_mk_tawaran or
					$sub11==$mk_tawaran->id_mk_tawaran or
					$sub12==$mk_tawaran->id_mk_tawaran or
					$sub13==$mk_tawaran->id_mk_tawaran or
					$sub14==$mk_tawaran->id_mk_tawaran or
					$sub15==$mk_tawaran->id_mk_tawaran or
					$sub16==$mk_tawaran->id_mk_tawaran or
					$sub17==$mk_tawaran->id_mk_tawaran or

					$sub18==$mk_tawaran->id_mk_tawaran ):  ?>

					<a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


					<?php else: ?>
					<a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp6/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
					<?php endif; ?>
					</td>

					</tr>
					<?php endforeach; ?>
					<tr>
					<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
					<td align="center">




					<?php if ($view_ipk >=3.00 ): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>


					<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>

					<?php else: ?>
					Maff, untuk sementara Belum ada IPK
					<?php endif; ?>
					</td>
					</tr>
					</tbody>
					</table>



					<div class="panel-footer">
					<p class="bgbottom">
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
				 </a></div>
					<?php endforeach; ?>
							<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->

					 





 <?php elseif ($respon=='RB1SMT8-6'): ?>

						  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
						 	 <!--JIKA RESPON DATA uri segment = RUNING BACKGROUND 3 (RB3)-->
						  <?php foreach ($mulai_Y_6_respon as $key): ?>
						  <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
						  <table class="table table-bordered table-striped">
						  <thead>
						  <tr>
						  <th width="80px">No</th>
						  <th>Kode MK</th>
						  <th>Matakuliah</th>
						  <th >SKS</th>
						  <th >Program Matakuliah ini ?</th>
						  </tr>
						  </thead>
						  <tbody >
						  <?php
						  $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks 
						  from mk_tawaran mt natural join matakuliah mk where mt.id_semester=18 
						  and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat 
						  not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 )   )')->result();

						  $mhs = $this->session->userdata('id_mahasiswa');
						  $s=array();
						  foreach ($get_et->result() as  $value) {
						  $s[]=$value->id_mk_tawaran;}
						  $sub =  implode('',$s);
						  $sub1= substr($sub,0,2);
						  $sub2= substr($sub,2,2);
						  $sub3= substr($sub,4,2);
						  $sub4= substr($sub,6,2);
						  $sub5= substr($sub,8,2);
						  $sub6= substr($sub,10,2);
						  $sub7= substr($sub,12,2);
						  $sub8= substr($sub,14,2);
						  $sub9= substr($sub,16,2);
						  $sub10= substr($sub,18,2);
						  $sub11= substr($sub,20,2);
						  $sub12= substr($sub,0,1);

						  $start = 0;
						  foreach ($RB3 as $mk_tawaran):?>
						  <tr>
						  <td><?php echo ++$start ?></td>
						  <td><?php echo $mk_tawaran->kode_mk ?></td>
						  <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
						  <td align="center"><?php echo $mk_tawaran->sks ?></td>
						  <td style="text-align:center" width="200px">
						  <?php if (
						  $sub1==$mk_tawaran->id_mk_tawaran ||
						  $sub2==$mk_tawaran->id_mk_tawaran ||
						  $sub3==$mk_tawaran->id_mk_tawaran ||
						  $sub4==$mk_tawaran->id_mk_tawaran ||
						  $sub5==$mk_tawaran->id_mk_tawaran ||
						  $sub6==$mk_tawaran->id_mk_tawaran ||
						  $sub7==$mk_tawaran->id_mk_tawaran ||
						  $sub8==$mk_tawaran->id_mk_tawaran ||
						  $sub9==$mk_tawaran->id_mk_tawaran ||
						  $sub10==$mk_tawaran->id_mk_tawaran ||
						  $sub11==$mk_tawaran->id_mk_tawaran ||
						  $sub12==$mk_tawaran->id_mk_tawaran ): ?>

						  <a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


						  <?php else: ?>
						  <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp6/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
						  <?php endif; ?>
						  </td>

						  </tr>
						  <?php endforeach; ?>
						  <tr>
						  <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
						  <td align="center">




						  <?php if ($view_ipk >=3.00 ): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
						  </span>


						  <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						  <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						  <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						  <?php elseif($view_ipk <=1.99): ?>
						  <span class="btn btn-primary btn-md">
						  <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
						  </span>

						  <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						  <?php endif; ?>
						  </td>
						  </tr>
						  </tbody>
						  </table>



						  <div class="panel-footer">
						  <p class="bgbottom">
						  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
						  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK 
						  </a></div>
						  <?php endforeach; ?>

						  <!--Batas RB3-->
						  <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->







 <?php elseif($respon=='RB3SMT4-6'): ?>
  			<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
					<?php foreach ($mulai_Y_6_respon as $key): ?>
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
					<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th width="80px">No</th>
					<th>Kode MK</th>
					<th>Matakuliah</th>
					<th >SKS</th>
					<th >Program Matakuliah ini ?</th>
					</tr>
					</thead>
					<tbody >

					<?php

					$mhs = $this->session->userdata('id_mahasiswa');
					$s=array();

					foreach ($get_et->result() as  $value) {
					$s[]=$value->id_mk_tawaran;}
					$sub =  implode('',$s);
					$sub1= substr($sub,0,2);
					$sub2= substr($sub,2,2);
					$sub3= substr($sub,4,2);
					$sub4= substr($sub,6,2);
					$sub5= substr($sub,8,2);
					$sub6= substr($sub,10,2);
					$sub7= substr($sub,12,2);
					$sub8= substr($sub,14,2);
					$sub9= substr($sub,16,2);
					$sub10= substr($sub,18,2);
					$sub11= substr($sub,20,2);
					$sub12= substr($sub,0,1);
					$sub13= substr($sub,0);
					$sub14= substr($sub,1,2);
					$sub15= substr($sub,1,3);
					$sub16= substr($sub,3);
					$sub17= substr($sub,5);
					$sub18= substr($sub,7);

					$start = 0;
					$get_semester4 = $this->Smart_model->mengulang_semester4();
					foreach (	$get_semester4 as $mk_tawaran): ?>
					<tr>
					<td><?php echo ++$start ?></td>
					<td><?php echo $mk_tawaran->kode_mk ?></td>
					<td><?php echo $mk_tawaran->nama_matakuliah ?></td>
					<td align="center"><?php echo $mk_tawaran->sks ?></td>
					<td style="text-align:center" width="200px">
					<?php if (
					$sub1==$mk_tawaran->id_mk_tawaran or
					$sub2==$mk_tawaran->id_mk_tawaran or
					$sub3==$mk_tawaran->id_mk_tawaran or
					$sub4==$mk_tawaran->id_mk_tawaran or
					$sub5==$mk_tawaran->id_mk_tawaran or
					$sub6==$mk_tawaran->id_mk_tawaran or
					$sub7==$mk_tawaran->id_mk_tawaran or
					$sub8==$mk_tawaran->id_mk_tawaran or
					$sub9==$mk_tawaran->id_mk_tawaran or
					$sub10==$mk_tawaran->id_mk_tawaran or
					$sub11==$mk_tawaran->id_mk_tawaran or
					$sub12==$mk_tawaran->id_mk_tawaran or
					$sub13==$mk_tawaran->id_mk_tawaran or
					$sub14==$mk_tawaran->id_mk_tawaran or
					$sub15==$mk_tawaran->id_mk_tawaran or
					$sub16==$mk_tawaran->id_mk_tawaran or
					$sub17==$mk_tawaran->id_mk_tawaran or

					$sub18==$mk_tawaran->id_mk_tawaran ):  ?>

					<a href="<?php echo base_url().'smartGenap/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


					<?php else: ?>
					<a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp6/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
					<?php endif; ?>
					</td>

					</tr>
					<?php endforeach; ?>
					<tr>
					<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
					<td align="center">




					<?php if ($view_ipk >=3.00 ): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>


					<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>

					<?php else: ?>
					Maff, untuk sementara Belum ada IPK
					<?php endif; ?>
					</td>
					</tr>
					</tbody>
					</table>



					<div class="panel-footer">
					<p class="bgbottom">
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
				 </a></div>
					<?php endforeach; ?>
							<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->




 





<?php elseif ($respon=='RB2SMT4-6'): ?>
	<div class="panel panel-default">
<?php
 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 ?>

	 <?php if ($view_ipk >=3.00 ): ?>

	<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
								</div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
							 </p>
							 </div>
							 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>


								<div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>

							 <?php endforeach; ?>
							 <?php endif; ?>






							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

							 <div class="panel-body">
							 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
							 </div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1>
							 </div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>




							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>




														 <div class="panel-footer">
														 <p class="bgbottom">
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
														 class="btn btn-primary btn-lg" role="button">
														 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
														 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
														 </p>
														 </div>
														 <?php endforeach; ?>

							 <?php else: ?>


							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>



							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>





							 <?php elseif($view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <?php
							 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

							 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
							 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
							 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
							 $view_ipk = number_format($ipk,2);?>

							 <?php if ($view_ipk >=3.00 ): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md"></h1>
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
							 </span></div>

							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>


							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>

							 <?php elseif($view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php else: ?>
							 Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>

							 <?php endif; ?>
							 <?php else: ?>
								Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>
							 </div>
									<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->





<?php elseif ($respon=='RB2SMT8-6'): ?>
	<div class="panel panel-default">
<?php
 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 ?>

	 <?php if ($view_ipk >=3.00 ): ?>

	<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
								</div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
							 </p>
							 </div>
							 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>


								<div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>

							 <?php endforeach; ?>
							 <?php endif; ?>






							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

							 <div class="panel-body">
							 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
							 </div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1>
							 </div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>




							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>




														 <div class="panel-footer">
														 <p class="bgbottom">
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
														 class="btn btn-primary btn-lg" role="button">
														 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
														 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
														 </p>
														 </div>
														 <?php endforeach; ?>

							 <?php else: ?>


							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>



							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>





							 <?php elseif($view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <?php
							 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

							 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
							 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
							 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
							 $view_ipk = number_format($ipk,2);?>

							 <?php if ($view_ipk >=3.00 ): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md"></h1>
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
							 </span></div>

							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>


							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>

							 <?php elseif($view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php else: ?>
							 Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>

							 <?php endif; ?>
							 <?php else: ?>
								Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>
							 </div>
									<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->













<?php elseif ($respon=='RB2SMT2-6'): ?>
	<div class="panel panel-default">
<?php
 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 ?>

	 <?php if ($view_ipk >=3.00 ): ?>

	<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
								</div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
							 </p>
							 </div>
							 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>


								<div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>

							 <?php endforeach; ?>
							 <?php endif; ?>






							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

							 <div class="panel-body">
							 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
							 </div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1>
							 </div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>




							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>




														 <div class="panel-footer">
														 <p class="bgbottom">
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
														 class="btn btn-primary btn-lg" role="button">
														 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
														 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
														 </p>
														 </div>
														 <?php endforeach; ?>

							 <?php else: ?>


							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>



							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>





							 <?php elseif($view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <?php
							 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

							 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
							 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
							 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
							 $view_ipk = number_format($ipk,2);?>

							 <?php if ($view_ipk >=3.00 ): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md"></h1>
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
							 </span></div>

							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>


							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>

							 <?php elseif($view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php else: ?>
							 Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>

							 <?php endif; ?>
							 <?php else: ?>
								Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>
							 </div>
									<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->









<?php elseif ($respon=='RB2SMT6-6'): ?>
	<div class="panel panel-default">
<?php
 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
 join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	 ?>

	 <?php if ($view_ipk >=3.00 ): ?>

	<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
								</div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
							 </p>
							 </div>
							 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>


								<div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>

							 <?php endforeach; ?>
							 <?php endif; ?>






							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

							 <div class="panel-body">
							 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
							 </div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>



							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1>
							 </div>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>




							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>




														 <div class="panel-footer">
														 <p class="bgbottom">
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
														 class="btn btn-primary btn-lg" role="button">
														 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
														 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
														 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
														 </p>
														 </div>
														 <?php endforeach; ?>

							 <?php else: ?>


							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>



							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
							 </div>

							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
							 </div>
							 <?php endforeach; ?>
							 <?php endif; ?>





							 <?php elseif($view_ipk <=1.99): ?>
							 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>

								<div class="panel-body">
								<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

							 <?php else: ?>
							 <?php foreach ($mulai_Y_6_respon as $key): ?>
							 <?php
							 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row(); ?>

							 <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
							 $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
							 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
							 $view_ipk = number_format($ipk,2);?>

							 <?php if ($view_ipk >=3.00 ): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md"></h1>
							 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
							 </span></div>

							 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>


							 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
							 </h1></div>

							 <?php elseif($view_ipk <=1.99): ?>
							 <div class="panel-body">
							 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
							 <span class="btn btn-primary btn-md">
							 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
							 </div>

							 <?php else: ?>
							 Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>


							 <div class="panel-footer">
							 <p class="bgbottom">
							 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
							 class="btn btn-primary btn-lg" role="button">
							 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
							 </div>
							 <?php endforeach; ?>

							 <?php endif; ?>
							 <?php else: ?>
								Maff, untuk sementara Belum ada IPK
							 <?php endif; ?>
							 </div>
									<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->







<?php elseif($respon=='P5SMT6SC'):
 $cekSC=$rekomendSC->num_rows();
?>

 <?php if($cekSC>0): ?>
<?php 
	redirect(site_url('SmartGenap/index/P5SMT6JCM'));
?>

<?php else: ?>
	<?php foreach ($mulai_Y_6_respon as $key): ?>
	<div class="panel panel-default">
	<div class="panel-body">
	<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
	</div>
	<div class="panel-footer">
	<p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
	</a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	</div>
	</div>
	<?php endforeach; ?>
<?php endif; ?>


<?php elseif($respon=='P5SMT6JCM'):
 $cekJCM=$rekomendJCM->num_rows();
?>
 <?php if($cekJCM>0): ?>
<?php 
	redirect(site_url('SmartGenap/index/P5SMT6PPK'));
?>

<?php else: ?>
	<?php foreach ($mulai_Y_6_respon as $key): ?>
	<div class="panel panel-default">
	<div class="panel-body">
	<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
	</div>
	<div class="panel-footer">
	<p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
	</a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	</div>
	</div>
	<?php endforeach; ?>
<?php endif; ?>


<?php elseif($respon=='P5SMT6PPK'):
 $cekPPK=$rekomendPPK->num_rows();
 ?>
 <?php if($cekPPK>0): ?>
<?php 
	redirect(site_url('SmartGenap/index/PKT6EMPTY'));
?>




<?php else: ?>
	<?php foreach ($mulai_Y_6_respon as $key): ?>
	<div class="panel panel-default">
	<div class="panel-body">
	<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
	</div>
	<div class="panel-footer">
	<p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
	</a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	</div>
	</div>
	<?php endforeach; ?>
<?php endif; ?>



<!-- my data fro sql
SELECT mk.nama_matakuliah,mk.sks from bidangminat bm join matakuliah mk on mk.id_mk=bm.id_mk 
WHERE bm.semester=6 and bm.id_minat=3 UNION SELECT mk.nama_matakuliah,mk.sks from mk_tawaran mt 
join matakuliah mk on mk.id_mk=mt.id_mk WHERE mt.id_semester=16 


v2.

SELECT mk.nama_matakuliah,mk.sks from bidangminat bm join matakuliah mk on mk.id_mk=bm.id_mk join mk_tawaran mt on mt.id_mk=bm.id_mk join jadwal_mk jm on jm.id_mk_tawaran=mt.id_mk_tawaran WHERE bm.semester=6 and bm.id_minat=3 UNION SELECT mk.nama_matakuliah,mk.sks from mk_tawaran mt join matakuliah mk on mk.id_mk=mt.id_mk join jadwal_mk jm on jm.id_mk_tawaran=mt.id_mk_tawaran WHERE mt.id_semester=16 SELECT * FROM `mk` WHERE 1
-->

 







<!--Batas untuk rekomendasi Bidang MInta-->
	
	<?php else: ?>
	<!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
	<?php foreach ($mulai_Y_6_respon as $key): ?>
	<div class="panel panel-default">
	<div class="panel-body">
	<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
	</div>
	<div class="panel-footer">
	<p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
	</a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	</div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>

	<?php endif; ?>






















	<!--BUKA SEMESTER 8 DISINI-->

<?php elseif($dataget->total==8 or $dataget->total>=8  or $dataget->total ==7): // DO SEMESTER 8 ?>

	<!--BUKA SEMESTER 8 DISINI-->







<?php
	$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
	join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	?>
	<!--BUKA SEMESTER 6 DISINI-->

<?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=7')->row();
$maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=7')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2)   ; ?>



<?php $replace_cek = $this->Smart_model->validasiKRSentry(8);
	?>

	<?php if ($replace_cek): ?>
		<h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smartGenap/hapus_entry') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
		 <!--Alert pesan data sudah ada, dan di tampilkan-->
		<!--tampilkan data hasil krs yang masuk di tabel entry-->
		<table class="table table-bordered">
		<thead>
		<th>No</th>
		<th>Matakuliah</th>
		<th>Semester</th>
		<th>SKS</th>
		<th>Jam Masuk</th>
		<th>Jam Selesai</th>
		<th>Ruang Kuliah</th>
		<th>Kelas</th>
		<th>Hari</th>
		</thead>
		<?php
		$no=1;
		foreach ($H4 as $key): ?>  <tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $key->nama_matakuliah ?></td>
		<td><?php echo $key->nama_semester ?></td>
		<td><?php echo $key->sks ?></td>
		<td><?php echo $key->jam_masuk ?></td>
		<td><?php echo $key->jam_selesai ?></td>
		<td><?php echo $key->nama_ruangan ?></td>
		<td><?php echo $key->nama_kelas ?></td>
		<td><?php echo $key->hari ?></td>
		</tr>
		<?php endforeach; ?>
		</table>
		<div class="well col-md-12">
		<a href="<?php echo base_url('smartGenap/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
		</div>
		<!--tampilkan data hasil krs yang masuk di tabel entry-->
		<!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->


<?php else: ?>

<?php
 
	// Baca Kode Respon yang di Kirim dari database
	// Apakah Ada data yang di kirim pada uri segment ada atau tidak, yang datanya diberi nama $respon
	if ($respon==''):
	// jika respon ini kosong maka akan tampilkan pertanyaan awal, dengan kondisi pertanyaan mulai = Y
	// pertanyaan tersebut akan ditampilkan
	?>

					 <?php foreach ($mulai_Y_8 as $key): ?>
						 <div class="panel panel-default">
								 <div class="panel-body">
									 <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
								 </div>
								 <div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
									  class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
									 </a> 

									  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO
									   <b  class="glyphicon glyphicon-remove"></b>
									 </a>  
									  </div>
							 </div>
					 <?php endforeach; ?>













	 <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->
					 <?php elseif ($respon=='RB1SMT8-8'): ?>

	 					 <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
	 					   <!--JIKA RESPON DATA uri segment = RUNING BACKGROUND 3 (RB3)-->
	 					 <?php foreach ($mulai_Y_8_respon as $key): ?>
	 					 <h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
	 					 <table class="table table-bordered table-striped">
	 					 <thead>
	 					 <tr>
	 					 <th width="80px">No</th>
	 					 <th>Kode MK</th>
	 					 <th>Matakuliah</th>
	 					 <th >SKS</th>
	 					 <th >Program Matakuliah ini ?</th>
	 					 </tr>
	 					 </thead>
	 					 <tbody >
	 					 <?php
	 					 $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,
						  mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk 
						  where mt.id_semester=18 and mt.id_mk 
						  not in (select ms.id_mk from mk_syarat ms 
						  WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
	 					 $mhs = $this->session->userdata('id_mahasiswa');
	 					 $s=array();
 	 					 foreach ($get_et->result() as  $value) {
	 					 $s[]=$value->id_mk_tawaran;}
	 					 $sub =  implode('',$s);
	 					 $sub1= substr($sub,0,2);
	 					 $sub2= substr($sub,2,2);
	 					 $sub3= substr($sub,4,2);
	 					 $sub4= substr($sub,6,2);
	 					 $sub5= substr($sub,8,2);
	 					 $sub6= substr($sub,10,2);
	 					 $sub7= substr($sub,12,2);
	 					 $sub8= substr($sub,14,2);
	 					 $sub9= substr($sub,16,2);
	 					 $sub10= substr($sub,18,2);
	 					 $sub11= substr($sub,20,2);
	 					 $sub12= substr($sub,0,1);

	 					 $start = 0;
	 					 foreach ($RB3 as $mk_tawaran):?>
	 					 <tr>
	 					 <td><?php echo ++$start ?></td>
	 					 <td><?php echo $mk_tawaran->kode_mk ?></td>
	 					 <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
	 					 <td align="center"><?php echo $mk_tawaran->sks ?></td>
	 					 <td style="text-align:center" width="200px">
	 					 <?php if (
	 					 $sub1==$mk_tawaran->id_mk_tawaran ||
	 					 $sub2==$mk_tawaran->id_mk_tawaran ||
	 					 $sub3==$mk_tawaran->id_mk_tawaran ||
	 					 $sub4==$mk_tawaran->id_mk_tawaran ||
	 					 $sub5==$mk_tawaran->id_mk_tawaran ||
	 					 $sub6==$mk_tawaran->id_mk_tawaran ||
	 					 $sub7==$mk_tawaran->id_mk_tawaran ||
	 					 $sub8==$mk_tawaran->id_mk_tawaran ||
	 					 $sub9==$mk_tawaran->id_mk_tawaran ||
	 					 $sub10==$mk_tawaran->id_mk_tawaran ||
	 					 $sub11==$mk_tawaran->id_mk_tawaran ||
	 					 $sub12==$mk_tawaran->id_mk_tawaran ): ?>

	 					 <a href="<?php echo base_url().'smartGenap/hapus_entry_tempData/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


	 					 <?php else: ?>
	 					 <a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp8/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
	 					 <?php endif; ?>
	 					 </td>

	 					 </tr>
	 					 <?php endforeach; ?>
	 					 <tr>
	 					 <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
	 					 <td align="center">




	 					 <?php if ($view_ipk >=3.00 ): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 					 </span>


	 					 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 					 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 					 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 					 <?php elseif($view_ipk <=1.99): ?>
	 					 <span class="btn btn-primary btn-md">
	 					 <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
	 					 </span>

	 					 <?php else: ?>
	 					 Maff, untuk sementara Belum ada IPK
	 					 <?php endif; ?>
	 					 </td>
	 					 </tr>
	 					 </tbody>
	 					 </table>



	 					 <div class="panel-footer">
	 					 <p class="bgbottom">
	 					 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
	 					 <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
	 					 class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 2,4,6,8 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
	 					 NO <b  class="glyphicon glyphicon-remove"></b></a></div>
	 					 <?php endforeach; ?>

	 					 <!--Batas RB3-->
	 					 <!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)-->





	<?php elseif ($respon=='RB2SMT8-8'): ?>
				  <div class="panel panel-default">
				 <?php
				$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
				  ?>

				<?php if ($view_ipk >=3.00 ): ?>

				<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
				</p>
				</div>
				<?php endforeach; ?>



				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>


				 <div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>

				<?php endforeach; ?>
				<?php endif; ?>






				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b> </a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				 <?php endforeach; ?>




				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1>
				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>




				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>



				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b>
				</a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php else: ?>


				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>



				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>





				<?php elseif($view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>


				<?php if ($view_ipk >=3.00 ): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md"></h1>
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
				</span></div>

				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>


				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>

				<?php elseif($view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php else: ?>
				Maff, untuk sementara Belum ada IPK
				<?php endif; ?>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>

				<?php endif; ?>
				<?php else: ?>
				 Maff, untuk sementara Belum ada IPK
				<?php endif; ?>
				</div>
				   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->







<?php elseif ($respon=='RB2SMT2-8'): ?>
				  <div class="panel panel-default">
				 <?php
				$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
				join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran 
				join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
				  ?>

				<?php if ($view_ipk >=3.00 ): ?>

				<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
				</p>
				</div>
				<?php endforeach; ?>



				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>


				 <div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>

				<?php endforeach; ?>
				<?php endif; ?>






				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b> </a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				 <?php endforeach; ?>




				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1>
				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>




				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>



				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b>
				</a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php else: ?>


				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>



				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>





				<?php elseif($view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>


				<?php if ($view_ipk >=3.00 ): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md"></h1>
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
				</span></div>

				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>


				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>

				<?php elseif($view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php else: ?>
				Maff, untuk sementara Belum ada IPK
				<?php endif; ?>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>

				<?php endif; ?>
				<?php else: ?>
				 Maff, untuk sementara Belum ada IPK
				<?php endif; ?>
				</div>
				   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->





<?php elseif ($respon=='RB2SMT4-8'): ?>
				  <div class="panel panel-default">
				 <?php
				$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
				join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran 
				join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
				  ?>

				<?php if ($view_ipk >=3.00 ): ?>

				<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
				</p>
				</div>
				<?php endforeach; ?>



				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>


				 <div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>

				<?php endforeach; ?>
				<?php endif; ?>






				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b> </a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				 <?php endforeach; ?>




				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1>
				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>




				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>



				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b>
				</a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php else: ?>


				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>



				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>





				<?php elseif($view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>


				<?php if ($view_ipk >=3.00 ): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md"></h1>
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
				</span></div>

				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>


				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>

				<?php elseif($view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php else: ?>
				Maff, untuk sementara Belum ada IPK
				<?php endif; ?>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>

				<?php endif; ?>
				<?php else: ?>
				 Maff, untuk sementara Belum ada IPK
				<?php endif; ?>
				</div>
				   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->




<?php elseif ($respon=='RB2SMT6-8'): ?>
				  <div class="panel panel-default">
				 <?php
				$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
				join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran 
				join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
				  ?>

				<?php if ($view_ipk >=3.00 ): ?>

				<?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
				</p>
				</div>
				<?php endforeach; ?>



				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>


				 <div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>

				<?php endforeach; ?>
				<?php endif; ?>






				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

				<div class="panel-body">
				<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b> </a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				 <?php endforeach; ?>




				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1>
				</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>




				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>



				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b>
				</a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php else: ?>


				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>



				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
				</div>

				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>





				<?php elseif($view_ipk <=1.99): ?>
				<?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>

					<div class="panel-body">
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 					</div>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>"
				class="btn btn-primary btn-lg" role="button">
				YES <b  class="glyphicon glyphicon-ok"></b></a>
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-warning btn-lg" role="button">
				NO <b  class="glyphicon glyphicon-remove"></b></a></p>
				</div>
				<?php endforeach; ?>


				<?php else: ?>
				<?php foreach ($mulai_Y_8_respon as $key): ?>


				<?php if ($view_ipk >=3.00 ): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md"></h1>
				<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
				</span></div>

				<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>


				<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
				</h1></div>

				<?php elseif($view_ipk <=1.99): ?>
				<div class="panel-body">
				<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
				<span class="btn btn-primary btn-md">
				<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span></h1>
				</div>

				<?php else: ?>
				Maff, untuk sementara Belum ada IPK
				<?php endif; ?>


				<div class="panel-footer">
				<p class="bgbottom">
				<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>"
				class="btn btn-primary btn-lg" role="button">
				NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
				</div>
				<?php endforeach; ?>

				<?php endif; ?>
				<?php else: ?>
				 Maff, untuk sementara Belum ada IPK
				<?php endif; ?>
				</div>
				   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->








   <?php elseif($respon=='RB4SMT2-8'): ?>
	<?php $cek_semester2 = $this->Smart_model->mengulang_semester2_cekData(); ?>
	<?php $key = $this->Smart_model->valid_semester2s($this->uri->segment(3)); ?>
	<?php if ($cek_semester2>0): ?>
	<?php redirect('smartGenap/index/'.$key->jika_ya); ?>
	<?php else: ?>
	<?php redirect('smartGenap/index/'.$key->jika_tidak); ?>
	<?php endif; ?>
 

 <?php elseif($respon=='RB4SMT4-8'): ?>
	<?php $cek_semester2 = $this->Smart_model->mengulang_semester4_cekData(); ?>
	<?php $key = $this->Smart_model->valid_semester2s($this->uri->segment(3)); ?>
	<?php if ($cek_semester2>0): ?>
	<?php redirect('smartGenap/index/'.$key->jika_ya); ?>
	<?php else: ?>
	<?php redirect('smartGenap/index/'.$key->jika_tidak); ?>
	<?php endif; ?>




<?php elseif($respon=='RB4SMT6-8'): ?>
	<?php $cek_semester2 = $this->Smart_model->mengulang_semester6_cekData(); ?>
	<?php $key = $this->Smart_model->valid_semester2s($this->uri->segment(3)); ?>
	<?php if ($cek_semester2>0): ?>
	<?php redirect('smartGenap/index/'.$key->jika_ya); ?>
	<?php else: ?>
	<?php redirect('smartGenap/index/'.$key->jika_tidak); ?>
	<?php endif; ?>



 <?php elseif($respon=='RB3SMT2-8'): ?>
  			<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
					<?php foreach ($mulai_Y_8_respon as $key): ?>
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
					<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th width="80px">No</th>
					<th>Kode MK</th>
					<th>Matakuliah</th>
					<th >SKS</th>
					<th >Program Matakuliah ini ?</th>
					</tr>
					</thead>
					<tbody >

					<?php

					$mhs = $this->session->userdata('id_mahasiswa');
					$s=array();

					foreach ($get_et->result() as  $value) {
					$s[]=$value->id_mk_tawaran;}
					$sub =  implode('',$s);
					$sub1= substr($sub,0,2);
					$sub2= substr($sub,2,2);
					$sub3= substr($sub,4,2);
					$sub4= substr($sub,6,2);
					$sub5= substr($sub,8,2);
					$sub6= substr($sub,10,2);
					$sub7= substr($sub,12,2);
					$sub8= substr($sub,14,2);
					$sub9= substr($sub,16,2);
					$sub10= substr($sub,18,2);
					$sub11= substr($sub,20,2);
					$sub12= substr($sub,0,1);
					$sub13= substr($sub,0);
					$sub14= substr($sub,1,2);
					$sub15= substr($sub,1,3);
					$sub16= substr($sub,3);
					$sub17= substr($sub,5);
					$sub18= substr($sub,7);

					$start = 0;
					$get_semester2 = $this->Smart_model->mengulang_semester2();
					foreach (	$get_semester2 as $mk_tawaran): ?>
					<tr>
					<td><?php echo ++$start ?></td>
					<td><?php echo $mk_tawaran->kode_mk ?></td>
					<td><?php echo $mk_tawaran->nama_matakuliah ?></td>
					<td align="center"><?php echo $mk_tawaran->sks ?></td>
					<td style="text-align:center" width="200px">
					<?php if (
					$sub1==$mk_tawaran->id_mk_tawaran or
					$sub2==$mk_tawaran->id_mk_tawaran or
					$sub3==$mk_tawaran->id_mk_tawaran or
					$sub4==$mk_tawaran->id_mk_tawaran or
					$sub5==$mk_tawaran->id_mk_tawaran or
					$sub6==$mk_tawaran->id_mk_tawaran or
					$sub7==$mk_tawaran->id_mk_tawaran or
					$sub8==$mk_tawaran->id_mk_tawaran or
					$sub9==$mk_tawaran->id_mk_tawaran or
					$sub10==$mk_tawaran->id_mk_tawaran or
					$sub11==$mk_tawaran->id_mk_tawaran or
					$sub12==$mk_tawaran->id_mk_tawaran or
					$sub13==$mk_tawaran->id_mk_tawaran or
					$sub14==$mk_tawaran->id_mk_tawaran or
					$sub15==$mk_tawaran->id_mk_tawaran or
					$sub16==$mk_tawaran->id_mk_tawaran or
					$sub17==$mk_tawaran->id_mk_tawaran or

					$sub18==$mk_tawaran->id_mk_tawaran ):  ?>

					<a href="<?php echo base_url().'smartGenap/hapus_entry_tempData/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


					<?php else: ?>
					<a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp8/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
					<?php endif; ?>
					</td>

					</tr>
					<?php endforeach; ?>
					<tr>
					<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
					<td align="center">




					<?php if ($view_ipk >=3.00 ): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>


					<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>

					<?php else: ?>
					Maff, untuk sementara Belum ada IPK
					<?php endif; ?>
					</td>
					</tr>
					</tbody>
					</table>



					<div class="panel-footer">
					<p class="bgbottom">
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
				 </a></div>
					<?php endforeach; ?>
							<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->




 <?php elseif($respon=='RB3SMT4-8'): ?>
  			<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
					<?php foreach ($mulai_Y_8_respon as $key): ?>
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
					<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th width="80px">No</th>
					<th>Kode MK</th>
					<th>Matakuliah</th>
					<th >SKS</th>
					<th >Program Matakuliah ini ?</th>
					</tr>
					</thead>
					<tbody >

					<?php

					$mhs = $this->session->userdata('id_mahasiswa');
					$s=array();

					foreach ($get_et->result() as  $value) {
					$s[]=$value->id_mk_tawaran;}
					$sub =  implode('',$s);
					$sub1= substr($sub,0,2);
					$sub2= substr($sub,2,2);
					$sub3= substr($sub,4,2);
					$sub4= substr($sub,6,2);
					$sub5= substr($sub,8,2);
					$sub6= substr($sub,10,2);
					$sub7= substr($sub,12,2);
					$sub8= substr($sub,14,2);
					$sub9= substr($sub,16,2);
					$sub10= substr($sub,18,2);
					$sub11= substr($sub,20,2);
					$sub12= substr($sub,0,1);
					$sub13= substr($sub,0);
					$sub14= substr($sub,1,2);
					$sub15= substr($sub,1,3);
					$sub16= substr($sub,3);
					$sub17= substr($sub,5);
					$sub18= substr($sub,7);

					$start = 0;
					$get_semester2 = $this->Smart_model->mengulang_semester4();
					foreach (	$get_semester2 as $mk_tawaran): ?>
					<tr>
					<td><?php echo ++$start ?></td>
					<td><?php echo $mk_tawaran->kode_mk ?></td>
					<td><?php echo $mk_tawaran->nama_matakuliah ?></td>
					<td align="center"><?php echo $mk_tawaran->sks ?></td>
					<td style="text-align:center" width="200px">
					<?php if (
					$sub1==$mk_tawaran->id_mk_tawaran or
					$sub2==$mk_tawaran->id_mk_tawaran or
					$sub3==$mk_tawaran->id_mk_tawaran or
					$sub4==$mk_tawaran->id_mk_tawaran or
					$sub5==$mk_tawaran->id_mk_tawaran or
					$sub6==$mk_tawaran->id_mk_tawaran or
					$sub7==$mk_tawaran->id_mk_tawaran or
					$sub8==$mk_tawaran->id_mk_tawaran or
					$sub9==$mk_tawaran->id_mk_tawaran or
					$sub10==$mk_tawaran->id_mk_tawaran or
					$sub11==$mk_tawaran->id_mk_tawaran or
					$sub12==$mk_tawaran->id_mk_tawaran or
					$sub13==$mk_tawaran->id_mk_tawaran or
					$sub14==$mk_tawaran->id_mk_tawaran or
					$sub15==$mk_tawaran->id_mk_tawaran or
					$sub16==$mk_tawaran->id_mk_tawaran or
					$sub17==$mk_tawaran->id_mk_tawaran or

					$sub18==$mk_tawaran->id_mk_tawaran ):  ?>

					<a href="<?php echo base_url().'smartGenap/hapus_entry_tempData/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


					<?php else: ?>
					<a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp8/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
					<?php endif; ?>
					</td>

					</tr>
					<?php endforeach; ?>
					<tr>
					<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
					<td align="center">




					<?php if ($view_ipk >=3.00 ): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>


					<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>

					<?php else: ?>
					Maff, untuk sementara Belum ada IPK
					<?php endif; ?>
					</td>
					</tr>
					</tbody>
					</table>



					<div class="panel-footer">
					<p class="bgbottom">
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
				 </a></div>
					<?php endforeach; ?>
							<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->






 <?php elseif($respon=='RB3SMT6-8'): ?>
  			<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
					<?php foreach ($mulai_Y_8_respon as $key): ?>
					<h1 class="lead"><?php echo $key->nama_pertanyaan ?></h1>
					<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th width="80px">No</th>
					<th>Kode MK</th>
					<th>Matakuliah</th>
					<th >SKS</th>
					<th >Program Matakuliah ini ?</th>
					</tr>
					</thead>
					<tbody >

					<?php

					$mhs = $this->session->userdata('id_mahasiswa');
					$s=array();

					foreach ($get_et->result() as  $value) {
					$s[]=$value->id_mk_tawaran;}
					$sub =  implode('',$s);
					$sub1= substr($sub,0,2);
					$sub2= substr($sub,2,2);
					$sub3= substr($sub,4,2);
					$sub4= substr($sub,6,2);
					$sub5= substr($sub,8,2);
					$sub6= substr($sub,10,2);
					$sub7= substr($sub,12,2);
					$sub8= substr($sub,14,2);
					$sub9= substr($sub,16,2);
					$sub10= substr($sub,18,2);
					$sub11= substr($sub,20,2);
					$sub12= substr($sub,0,1);
					$sub13= substr($sub,0);
					$sub14= substr($sub,1,2);
					$sub15= substr($sub,1,3);
					$sub16= substr($sub,3);
					$sub17= substr($sub,5);
					$sub18= substr($sub,7);

					$start = 0;
					$get_semester2 = $this->Smart_model->mengulang_semester6();
					foreach (	$get_semester2 as $mk_tawaran): ?>
					<tr>
					<td><?php echo ++$start ?></td>
					<td><?php echo $mk_tawaran->kode_mk ?></td>
					<td><?php echo $mk_tawaran->nama_matakuliah ?></td>
					<td align="center"><?php echo $mk_tawaran->sks ?></td>
					<td style="text-align:center" width="200px">
					<?php if (
					$sub1==$mk_tawaran->id_mk_tawaran or
					$sub2==$mk_tawaran->id_mk_tawaran or
					$sub3==$mk_tawaran->id_mk_tawaran or
					$sub4==$mk_tawaran->id_mk_tawaran or
					$sub5==$mk_tawaran->id_mk_tawaran or
					$sub6==$mk_tawaran->id_mk_tawaran or
					$sub7==$mk_tawaran->id_mk_tawaran or
					$sub8==$mk_tawaran->id_mk_tawaran or
					$sub9==$mk_tawaran->id_mk_tawaran or
					$sub10==$mk_tawaran->id_mk_tawaran or
					$sub11==$mk_tawaran->id_mk_tawaran or
					$sub12==$mk_tawaran->id_mk_tawaran or
					$sub13==$mk_tawaran->id_mk_tawaran or
					$sub14==$mk_tawaran->id_mk_tawaran or
					$sub15==$mk_tawaran->id_mk_tawaran or
					$sub16==$mk_tawaran->id_mk_tawaran or
					$sub17==$mk_tawaran->id_mk_tawaran or

					$sub18==$mk_tawaran->id_mk_tawaran ):  ?>

					<a href="<?php echo base_url().'smartGenap/hapus_entry_tempData/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


					<?php else: ?>
					<a href="<?php echo base_url().'smartGenap/simpan_ke_entry_temp8/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
					<?php endif; ?>
					</td>

					</tr>
					<?php endforeach; ?>
					<tr>
					<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
					<td align="center">




					<?php if ($view_ipk >=3.00 ): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>


					<?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
					<?php elseif($view_ipk <=1.99): ?>
					<span class="btn btn-primary btn-md">
					<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
					</span>

					<?php else: ?>
					Maff, untuk sementara Belum ada IPK
					<?php endif; ?>
					</td>
					</tr>
					</tbody>
					</table>



					<div class="panel-footer">
					<p class="bgbottom">
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
					<a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
				 </a></div>
					<?php endforeach; ?>
							<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->





<?php elseif ($respon=='P4SMT8') : ?>
					 <?php foreach ($mulai_Y_8_respon as $keys): ?>
					 <h1 class="lead"><?php echo $keys->nama_pertanyaan ?></h1>
					 <table class="table table-bordered">
					 <thead>
					 <th>No</th>
					 <th>Matakuliah</th>
					 <th>Semester</th>
					 <th>SKS</th>
					 <th>Jam Masuk</th>
					 <th>Jam Selesai</th>
					 <th>Ruang Kuliah</th>
					 <th>Kelas</th>
					 <th>Hari</th>
					 </thead>
					 <?php
					 $no=1;
					 foreach ($sem_2 as $key): ?>  <tr>
					 <td><?php echo $no++ ?></td>
					 <td><?php echo $key->nama_matakuliah ?></td>
					 <td><?php echo $key->nama_semester ?></td>
					 <td><?php echo $key->sks ?></td>
					 <td><?php echo $key->jam_masuk ?></td>
					 <td><?php echo $key->jam_selesai ?></td>
					 <td><?php echo $key->nama_ruangan ?></td>
					 <td><?php echo $key->nama_kelas ?></td>
					 <td><?php echo $key->hari ?></td>
					 </tr>
					 <?php endforeach; ?>
					 </table>

					 <div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>SmartGenap/simpanP6_H2"
					 class="btn btn-primary btn-lg" role="button"
					 onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
					 YES <b  class="glyphicon glyphicon-ok"></b></a>
					 <a href="<?php echo base_url()?>smartGenap/hapus_entry_temp"
					 class="btn btn-warning btn-lg" role="button"
					 onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
					 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
					 </div>
					 <?php endforeach ?>




	 <!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2-->
					 <!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2-->
				 <?php elseif ($respon=='PKT8'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN ?>
					 <?php
					 $mhs = $this->session->userdata('id_mahasiswa');
					 $seg3= $this->uri->segment(3);
					 $paketsemester3= 'P4SMT8';

					 $dat1 = date('Y');
					 $dat2 = date('Y')-1;
						 $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural 
						 join matakuliah mk where mt.id_semester=18 and mt.id_mk not
						  in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

					 $PKT2 = $this->db->query('select mt.id_mk_tawaran  from mk_tawaran mt natural 
					 join matakuliah mk where mt.id_semester=18 and mt.id_mk not in 
					 (select ms.id_mk from mk_syarat ms WHERE ms.syarat in 
					 (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
					 //if ($RB3->sks<=12) {}

					 if ($view_ipk >=3.00 ) // jika IPK adalah lebih besar atau sama dengan 3.00

					 {

					 if ($RB3->sks<=24) //  perika apakah sks total matakuliah yang ditawarkan lebih kecil daripada
					 // 24 sks ?, jika ya, maka akan di masukan sebagai paket matakuliah.
					 {

					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 if ($total_A->total_A < $kelas_A->kapasitas ) {

					 foreach ($PKT2 as $key) {

					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
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
					 <strong>Paket Matakuliah Semester 8</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }
					 // kelas C
					 elseif ($total_C->total_C < $kelas_C->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 8</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 } elseif ($total_D->total_D < $kelas_D->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 8</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 // jika tidak ada selain kelas D pada kelas PAGI
					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));}
					 } // Kelas Sore / Kelas Malam (K,L,X,Y)
					 else {

					 if ($total_K->total_K < $kelas_K->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 // KELAS L
					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 // kelas X
					 }
					 elseif ($total_X->total_X < $kelas_X->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 // KELAS Y
					 } elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Gagal Tersimpan.
					 </div>');


					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 } // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
					 } // else tutup kelas Sore

					 } else {  // TUTUP 24 SKS
						 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
					 <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));

					 }


					 } elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

					 if ($RB3->sks<=21) {

					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 $seg3= $this->uri->segment(3);
					 $seg4= $this->uri->segment(4);
					 if ($total_A->total_A < $kelas_A->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_B->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }
					 elseif ($total_D->total_D < $kelas_D->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

						redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }



					 }else { //kelas K
					 if ($total_K->total_K < $kelas_K->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 // batas pagi
					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" =>8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 } elseif ($total_X->total_X < $kelas_X->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1);
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Gagal Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }
								 } // else tutup kelas Sore

					 }else{
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
						<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
					 }



					 }elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
					 if ($RB3->sks<=18) {
					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 if ($total_A->total_A < $kelas_A->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_B->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }

					 }else {
					 if ($total_K->total_K < $kelas_K->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
						'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1);
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
						 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Gagal Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }



					 } // else tutup kelas Sore
					 } else {

						 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
						 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
							<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
					 }


					 }elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
					 if ($RB3->sks<=15) {
					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 if ($total_A->total_A < $kelas_A->kapasitas ) {

						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_B->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
					 </div>');
						redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');


					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));



					 }

					 }else {
					 if ($total_K->total_K < $kelas_K->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 4</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }else {
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));

					 }


					 } // else tutup kelas Sore
					 } else {
						 $this->session->set_flashdata('message',
						 '<div class="alert alert-danger">
						 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
							<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
						 </div>');
						 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
					 }



					 } elseif($view_ipk <=1.99){
					 if ($RB3->sks<=12) {
					 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
					 if ($total_A->total_A < $kelas_A->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('d-m-Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_A->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');

					 redirect(site_url('smartGenap/index/'.$paketsemester3));


					 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
							foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_B->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }
					 elseif ($total_C->total_C < $kelas_C->kapasitas ) {
					 # code...
						foreach ($PKT2 as $key) {
					 $result_replace = array(

					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_C->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
											 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
										 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }
					 elseif ($total_D->total_D < $kelas_D->kapasitas ) {
					 # code...
						foreach ($PKT2 as $key) {
					 $result_replace = array(

					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_D->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
											 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
									 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }else {
					 $this->session->set_flashdata('message',
											'<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

											 </div>');
											 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
							 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }

					 }else {

					 if ($total_K->total_K < $kelas_K->kapasitas ) {
					 # code...
					 foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_K->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
					 </div>');
											 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
					 # code...
						foreach ($PKT2 as $key) {
					 $result_replace = array(

					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_L->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
										 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }
					 elseif ($total_X->total_X < $kelas_X->kapasitas ) {
					 # code...
						foreach ($PKT2 as $key) {
					 $result_replace = array(

					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_X->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }
					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
									 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }
					 elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

						foreach ($PKT2 as $key) {
					 $result_replace = array(
					 "id_mahasiswa"   =>  $mhs,
					 "waktu_entry"    => date('Y'),
					 "semester_aktif" => 8,
					 "validasi"       => 'BELUM',
					 "id_mk_tawaran"  => $key->id_mk_tawaran,
					 "id_kelas"       => $kelas_Y->id_kelas,
					 "semester_tahun_akademik" => 'Genap',
					 "tahun_akademik" => $dat2.'/'.$dat1,
					 );
					 $this->db->insert('entry_temporary', $result_replace);
					 }

					 $this->session->set_flashdata('message',
											'<div class="alert alert-success">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

											 </div>');
							 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 // batas pagi
					 }else {
					 $this->session->set_flashdata('message',
												'<div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

												 </div>');
									 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }


					 } // else tutup kelas Sore
					 } else {

					 $this->session->set_flashdata('message',
					 '<div class="alert alert-danger">
						 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
							<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
					 </div>');
					 redirect(site_url('smartGenap/index/'.$sks_lebih->jika_tidak));
					 }

					 } else{
					 $this->session->set_flashdata('message',
					 '<div class="alert alert-warning">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					 <strong>Maaf</strong> Untuk sementara Belum ada data IPK.
					 </div>');
						 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
					 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
					 redirect(site_url('smartGenap/index/'.$paketsemester3));
					 }
					 ?>









	<?php else: ?>
	<!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
	<?php foreach ($mulai_Y_8_respon as $key): ?>
	<div class="panel panel-default">
	<div class="panel-body">
	<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
	</div>
	<div class="panel-footer">
	<p class="bgbottom"><a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
	</a>  <a href="<?php echo base_url()?>smartGenap/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
	</div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>

	<?php endif; ?>


<?php else: // AKHIR PERBANDINGAN SEMESTER, TIDAK ADA SEMSTER LAGI ?>

<h3 class="alert alert-warning">Maaf Untuk Sementara Belum Ada Data Semester</h3>

<?php endif; ?>
<!--BATAS SEMESTER genap, ddari 2,4,6,8 DISINI-->








































	<!--Untuk Periksa data jawaban yang sudah atau belum pada tabel entry,
	jika sudah ada maka data tersebut ditampilkan -->
