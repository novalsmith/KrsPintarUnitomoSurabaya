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

$tambah1=$dataget->total+1;


$tahun_akademik = $this->db->query('select * from semester_sekarang')->row();
$seg3=$this->uri->segment(3);
$sks_lebih = $this->db->query('select s.nama_semester from pertanyaan p 
JOIN semester s on s.id_semester=p.id_semester
where p.mulai="Y" and s.nama_semester='.$tambah1)->row();

$mhs = $this->session->userdata('id_mahasiswa');

	$mhs_get = $this->db->query('select * from mahasiswa where id_mahasiswa='.$mhs)->row();

//-----------untuk tahun_akademik ---------------------------
$dat1 = date('Y');
$dat2 = date('Y')-1;
$now = $dat2.'/'.$dat1;
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_tahun_akademik="Ganjil" and tahun_akademik="'.$now.'"');

  $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt
   on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();

 ?>



<?php if($semester_sekarang->sekarang == 'Ganjil') : ?>
<?php else: ?>
<?php redirect('SmartGenap/index'); ?>
<?php endif; ?>
<?php
$respon = $this->uri->segment(3);
$id =  $this->session->userdata('id_mahasiswa');
$dataget = $this->db->query('select max(semester_aktif) as total from entry where id_mahasiswa='.$id)->row();
 ?>
 <!--Untuk Pesan notifikasi kesalahan aau sukses -->
 <div class="col-md-12 text-center">
 		<div style="margin-top: 4px"  id="message">
 				<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
 		</div>
 </div>



  <?php if($dataget->total ==1): // Untuk semester 1 ?>
<?php $replace_cek = $this->Smart_model->validasiKRSentry(1);
 ?>
    <?php if ($replace_cek): ?>
      <h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smartGanjil/hapus_entry') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
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
      <a href="<?php echo base_url('smartGanjil/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
      </div>
      <!--tampilkan data hasil krs yang masuk di tabel entry-->
      <!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->
    <?php else: ?>







    <?php
    $this->db->join('semester s', 's.id_semester = p.id_semester');
     $HSMT1_Y=$this->db->get_where('pertanyaan p',array('p.mulai'=>'Y','s.nama_semester'=>1))->result(); ?>
<div class="panel-body">
<?php foreach ($HSMT1_Y as $key): ?>
<h4 class="alert alert-warning" class="lead">  <?php echo $key->nama_pertanyaan ?>    </h4>
<?php endforeach; ?>
<table class="table table-bordered">
<thead>
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
       foreach ($sem_1 as $key): ?>  <tr>
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
</div>

<?php endif; // close all process when not have data from table_temporary ?>





  <?php elseif($dataget->total==3 or $dataget->total ==2): // Untuk semester 3 ?>

<?php $replace_cek = $this->Smart_model->validasiKRSentryGanjil(3);
 ?>

    <?php if ($replace_cek): ?>
      <h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smartGanjil/hapus_entry_H3') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
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
      foreach ($H3 as $key): ?>  <tr>
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
      <a href="<?php echo base_url('smartGanjil/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
      </div>
      <!--tampilkan data hasil krs yang masuk di tabel entry-->
      <!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->
    <?php else: ?>




       <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
       join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=2')->row();
      $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
       join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=2')->row();
      $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
      $view_ipk = number_format($ipk,2)   ;
       ?>
 


  <?php
   // Baca Kode Respon yang di Kirim dari database
   // Apakah Ada data yang di kirim pada uri segment ada atau tidak, yang datanya diberi nama $respon
    if ($respon==''):
   // jika respon ini kosong maka akan tampilkan pertanyaan awal, dengan kondisi pertanyaan mulai = Y
   // pertanyaan tersebut akan ditampilkan
   ?>

             <?php foreach ($mulai_Y_3 as $key): ?>
               <div class="panel panel-default">
                   <div class="panel-body">
                     <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
                   </div>
                   <div class="panel-footer">
                     <p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
                     </a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
                   </div>
                 </div>
             <?php endforeach; ?>








           
           <?php elseif ($respon=='PKT3'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
             <?php
             $mhs = $this->session->userdata('id_mahasiswa');
             $seg3= $this->uri->segment(3);
             $paketsemester3= 'P4SMT3';

             $dat1 = date('Y');
             $dat2 = date('Y')-1;
               $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=13 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

             $PKT2 = $this->db->query('select mt.id_mk_tawaran  from mk_tawaran mt natural join matakuliah mk where mt.id_semester=13 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
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
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
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
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }
             // kelas C
             elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             } elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             // jika tidak ada selain kelas D pada kelas PAGI
             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));}
             } // Kelas Sore / Kelas Malam (K,L,X,Y)
             else {

             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             // KELAS L
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             // kelas X
             }
             elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             // KELAS Y
             } elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');


             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             } // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
             } // else tutup kelas Sore

             } else {  // TUTUP 24 SKS
               $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
             <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));

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
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }
             elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

              redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }



             }else { //kelas K
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             // batas pagi
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             } elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1);
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }
                   } // else tutup kelas Sore

             }else{
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
              <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }



             }elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
             if ($RB3->sks<=18) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }

             }else {
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
              '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1);
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
               </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }



             } // else tutup kelas Sore
             } else {

               $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }


             }elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
             if ($RB3->sks<=15) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {

             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');


             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }

             }else {
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }


             } // else tutup kelas Sore
             } else {
               $this->session->set_flashdata('message',
               '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
               </div>');
							 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }



             } elseif($view_ipk <=1.99){
             if ($RB3->sks<=12) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
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
                       redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
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
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }else {
             $this->session->set_flashdata('message',
                        '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

                         </div>');
                         // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
                 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }

             }else {

             if ($total_K->total_K < $kelas_K->kapasitas ) {
             # code...
             foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');
                         // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                       redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 3,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }else {
             $this->session->set_flashdata('message',
                          '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

                           </div>');
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }


             } // else tutup kelas Sore
             } else {

             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }

             } else{
             $this->session->set_flashdata('message',
             '<div class="alert alert-warning">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Maaf</strong> Untuk sementara Belum ada data IPK.
             </div>');
               // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }
             ?>





           <?php elseif ($respon=='P4SMT3') : ?>
             <?php foreach ($mulai_Y_3_respon as $keys): ?>
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
             foreach ($sem_3 as $key): ?>  <tr>
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

             <div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>smartGanjil/simpanP6_H3"
             class="btn btn-primary btn-lg" role="button"
             onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
             YES <b  class="glyphicon glyphicon-ok"></b></a>
             <a href="<?php echo base_url()?>smartGanjil/hapus_entry_temp_ganjil"
             class="btn btn-warning btn-lg" role="button"
             onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
             NO <b  class="glyphicon glyphicon-remove"></b></a></p>
             </div>
             <?php endforeach ?>






					 <?php elseif($respon=='RB3SMT1-3'): ?>

						<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
						<?php foreach ($mulai_Y_3_respon as $key): ?>
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
						$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_aktif=3');
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
						$get_semester1 = $this->Smart_model->mengulang_semester1();
						foreach (	$get_semester1 as $mk_tawaran): ?>
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

						<a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


						<?php else: ?>
						<a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
						<?php endif; ?>
						</td>

						</tr>
						<?php endforeach; ?>
						<tr>
						<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
						<td align="center">

						<?php
						$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=3')->row(); ?>

						<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=12')->row();
						$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=12')->row();
						$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
						$view_ipk = number_format($ipk,2); ?>




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
						<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
						<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 3
 					 </a></div>
						<?php endforeach; ?>




					 <?php elseif($respon=='RB4SMT1'): ?>


						<?php $cek_semester2 = $this->Smart_model->mengulang_semester1_cekData(); ?>
						<?php foreach ($mengulang_semester1 as $key): ?>

						<?php if ($cek_semester2>0): ?>

<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

						<?php else: ?>
							<?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

						<?php endif; ?>
					<?php endforeach; ?>






						 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
					 <?php elseif ($respon=='RB2SMT3-3'): ?>
						   <div class="panel panel-default">
						  <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_3_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_3_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->



 						  <?php elseif ($respon=='RB2SMT1-3'): ?>
						 		 <div class="panel panel-default">
						 		<?php
						 	 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						 		 ?>

						 	 <?php if ($view_ipk >=3.00 ): ?>

						 	 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 		<div class="panel-body">
						 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 		<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
						 		</div>


						 	 <div class="panel-footer">
						 	 <p class="bgbottom">
						 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 	 class="btn btn-primary btn-lg" role="button">
						 	 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 	 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 	 </p>
						 	 </div>
						 	 <?php endforeach; ?>



						 	 <?php else: ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>
						 	 <div class="panel-body">
						 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 	 </div>


						 		<div class="panel-footer">
						 	 <p class="bgbottom">
						 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 	 class="btn btn-primary btn-lg" role="button">
						 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 	 </div>

						 	 <?php endforeach; ?>
						 	 <?php endif; ?>






						 	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 	 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 	 <div class="panel-body">
						 	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	 </div>



	 												 <div class="panel-footer">
	 												 <p class="bgbottom">
	 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 												 class="btn btn-primary btn-lg" role="button">
	 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 												 </p>
	 												 </div>
	 												 <?php endforeach; ?>



						 	 <?php else: ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>
						 	 <div class="panel-body">
						 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 	 </h1>
						 	 </div>


						 	 <div class="panel-footer">
						 	 <p class="bgbottom">
						 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 	 class="btn btn-primary btn-lg" role="button">
						 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 	 </div>
						 	 <?php endforeach; ?>
						 	 <?php endif; ?>




						 	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 	 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 		<div class="panel-body">
						 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 		<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 		</div>




														 <div class="panel-footer">
														 <p class="bgbottom">
														 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
														 class="btn btn-primary btn-lg" role="button">
														 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
														 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
														 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
														 </p>
														 </div>
														 <?php endforeach; ?>

						 	 <?php else: ?>


						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>
						 	 <div class="panel-body">
						 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 	 </div>

						 	 <div class="panel-footer">
						 	 <p class="bgbottom">
						 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 	 class="btn btn-primary btn-lg" role="button">
						 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 	 </div>
						 	 <?php endforeach; ?>
						 	 <?php endif; ?>



						 	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 	 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 		<div class="panel-body">
						 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 		<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 		</div>



 							 						 <div class="panel-footer">
 							 						 <p class="bgbottom">
 							 						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 							 						 class="btn btn-primary btn-lg" role="button">
 							 						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 							 						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 							 						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 							 						 </p>
 							 						 </div>
 							 						 <?php endforeach; ?>


						 	 <?php else: ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>
						 	 <div class="panel-body">
						 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 	 <span class="btn btn-primary btn-md">
						 	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 	 </div>

						 	 <div class="panel-footer">
						 	 <p class="bgbottom">
						 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 	 class="btn btn-primary btn-lg" role="button">
						 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 	 </div>
						 	 <?php endforeach; ?>
						 	 <?php endif; ?>





						 	 <?php elseif($view_ipk <=1.99): ?>
						 	 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>

						 		<div class="panel-body">
						 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 		<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 		</div>



	 						 						 <div class="panel-footer">
	 						 						 <p class="bgbottom">
	 						 						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 						 						 class="btn btn-primary btn-lg" role="button">
	 						 						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 						 						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 						 						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 						 						 </p>
	 						 						 </div>
	 						 						 <?php endforeach; ?>

						 	 <?php else: ?>
						 	 <?php foreach ($mulai_Y_3_respon as $key): ?>
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
						 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
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
								<?php elseif ($respon=='RB2SMT7-3'): ?>
									 <div class="panel panel-default">
									<?php
								 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
									 ?>

								 <?php if ($view_ipk >=3.00 ): ?>

								 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>

									<div class="panel-body">
									<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
									<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
									</div>


								 <div class="panel-footer">
								 <p class="bgbottom">
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
								 class="btn btn-primary btn-lg" role="button">
								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
								 </p>
								 </div>
								 <?php endforeach; ?>



								 <?php else: ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>
								 <div class="panel-body">
								 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
								 <span class="btn btn-primary btn-md">
								 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
								 </div>


									<div class="panel-footer">
								 <p class="bgbottom">
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
								 class="btn btn-primary btn-lg" role="button">
								 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
								 </div>

								 <?php endforeach; ?>
								 <?php endif; ?>






								 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
								 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>

								 <div class="panel-body">
								 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
								 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

								 </div>


								 						 <div class="panel-footer">
								 						 <p class="bgbottom">
								 						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
								 						 class="btn btn-primary btn-lg" role="button">
								 						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
								 						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
								 						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
								 						 </p>
								 						 </div>
								 						 <?php endforeach; ?>


								 <?php else: ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>
								 <div class="panel-body">
								 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
								 <span class="btn btn-primary btn-md">
								 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
								 </h1>
								 </div>


								 <div class="panel-footer">
								 <p class="bgbottom">
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
								 class="btn btn-primary btn-lg" role="button">
								 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
								 </div>
								 <?php endforeach; ?>
								 <?php endif; ?>




								 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
								 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>

									<div class="panel-body">
									<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
									<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

									</div>


															 <div class="panel-footer">
															 <p class="bgbottom">
															 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
															 class="btn btn-primary btn-lg" role="button">
															 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
															 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
															 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
															 </p>
															 </div>
															 <?php endforeach; ?>


								 <?php else: ?>


								 <?php foreach ($mulai_Y_3_respon as $key): ?>
								 <div class="panel-body">
								 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
								 <span class="btn btn-primary btn-md">
								 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
								 </div>

								 <div class="panel-footer">
								 <p class="bgbottom">
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
								 class="btn btn-primary btn-lg" role="button">
								 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
								 </div>
								 <?php endforeach; ?>
								 <?php endif; ?>



								 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
								 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>

									<div class="panel-body">
									<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
									<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

									</div>



															 <div class="panel-footer">
															 <p class="bgbottom">
															 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
															 class="btn btn-primary btn-lg" role="button">
															 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
															 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
															 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
															 </p>
															 </div>
															 <?php endforeach; ?>

								 <?php else: ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>
								 <div class="panel-body">
								 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
								 <span class="btn btn-primary btn-md">
								 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
								 </div>

								 <div class="panel-footer">
								 <p class="bgbottom">
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
								 class="btn btn-primary btn-lg" role="button">
								 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
								 </div>
								 <?php endforeach; ?>
								 <?php endif; ?>





								 <?php elseif($view_ipk <=1.99): ?>
								 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>

									<div class="panel-body">
									<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
									<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

									</div>



															 <div class="panel-footer">
															 <p class="bgbottom">
															 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
															 class="btn btn-primary btn-lg" role="button">
															 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
															 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
															 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
															 </p>
															 </div>
															 <?php endforeach; ?>

								 <?php else: ?>
								 <?php foreach ($mulai_Y_3_respon as $key): ?>
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
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
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




									<?php elseif ($respon=='RB2SMT5-3'): ?>
										 <div class="panel panel-default">
										<?php
									 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
										 ?>

									 <?php if ($view_ipk >=3.00 ): ?>

									 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>

										<div class="panel-body">
										<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
										<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
										</div>


									 <div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
									 class="btn btn-primary btn-lg" role="button">
									 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
									 </p>
									 </div>
									 <?php endforeach; ?>



									 <?php else: ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>
									 <div class="panel-body">
									 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
									 <span class="btn btn-primary btn-md">
									 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
									 </div>


										<div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 class="btn btn-primary btn-lg" role="button">
									 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
									 </div>

									 <?php endforeach; ?>
									 <?php endif; ?>






									 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
									 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>

									 <div class="panel-body">
									 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
									 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

									 </div>


									 						 <div class="panel-footer">
									 						 <p class="bgbottom">
									 						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
									 						 class="btn btn-primary btn-lg" role="button">
									 						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
									 						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
									 						 </p>
									 						 </div>
									 						 <?php endforeach; ?>



									 <?php else: ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>
									 <div class="panel-body">
									 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
									 <span class="btn btn-primary btn-md">
									 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
									 </h1>
									 </div>


									 <div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 class="btn btn-primary btn-lg" role="button">
									 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
									 </div>
									 <?php endforeach; ?>
									 <?php endif; ?>




									 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
									 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>

										<div class="panel-body">
										<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
										<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

										</div>


																 <div class="panel-footer">
																 <p class="bgbottom">
																 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
																 class="btn btn-primary btn-lg" role="button">
																 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
																 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
																 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
																 </p>
																 </div>
																 <?php endforeach; ?>

									 <?php else: ?>


									 <?php foreach ($mulai_Y_3_respon as $key): ?>
									 <div class="panel-body">
									 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
									 <span class="btn btn-primary btn-md">
									 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
									 </div>

									 <div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 class="btn btn-primary btn-lg" role="button">
									 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
									 </div>
									 <?php endforeach; ?>
									 <?php endif; ?>



									 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
									 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>

										<div class="panel-body">
										<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
										<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

										</div>


																 <div class="panel-footer">
																 <p class="bgbottom">
																 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
																 class="btn btn-primary btn-lg" role="button">
																 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
																 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
																 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
																 </p>
																 </div>
																 <?php endforeach; ?>



									 <?php else: ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>
									 <div class="panel-body">
									 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
									 <span class="btn btn-primary btn-md">
									 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
									 </div>

									 <div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 class="btn btn-primary btn-lg" role="button">
									 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
									 </div>
									 <?php endforeach; ?>
									 <?php endif; ?>





									 <?php elseif($view_ipk <=1.99): ?>
									 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>

										<div class="panel-body">
										<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
										<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 										</div>



																 <div class="panel-footer">
																 <p class="bgbottom">
																 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
																 class="btn btn-primary btn-lg" role="button">
																 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
																 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
																 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
																 </p>
																 </div>
																 <?php endforeach; ?>


									 <?php else: ?>
									 <?php foreach ($mulai_Y_3_respon as $key): ?>
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
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
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




<?php elseif($respon=='RB1SMT3-3'): ?>

<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
<?php foreach ($mulai_Y_3_respon as $key): ?>
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

$RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=13 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
$mhs = $this->session->userdata('id_mahasiswa');
$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_aktif=3');
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
foreach ($RB3 as $mk_tawaran):?>
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

<a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


<?php else: ?>
<a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
<?php endif; ?>
</td>

</tr>
<?php endforeach; ?>
<tr>
<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
<td align="center">

<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=3')->row(); ?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=12')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=12')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2); ?>




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
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
<a href="<?php echo base_url()?>smartGanjil/hapus_entry_H3"
class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 3,5,7 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
NO <b  class="glyphicon glyphicon-remove"></b></a></div>
<?php endforeach; ?>




<?php elseif($respon=='RB1SMT5-3'): ?>

<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
<?php foreach ($mulai_Y_3_respon as $key): ?>
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

$RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=15 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
$mhs = $this->session->userdata('id_mahasiswa');
$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_aktif=3');
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
foreach ($RB3 as $mk_tawaran):?>
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

<a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


<?php else: ?>
<a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
<?php endif; ?>
</td>

</tr>
<?php endforeach; ?>
<tr>
<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
<td align="center">

<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=3')->row(); ?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=12')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=12')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2); ?>




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
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 3
</a></div>
<?php endforeach; ?>






<?php elseif($respon=='RB1SMT7-3'): ?>

<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
<?php foreach ($mulai_Y_3_respon as $key): ?>
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

$RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=17 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
$mhs = $this->session->userdata('id_mahasiswa');
$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_aktif=3');
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
foreach ($RB3 as $mk_tawaran):?>
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

<a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


<?php else: ?>
<a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
<?php endif; ?>
</td>

</tr>
<?php endforeach; ?>
<tr>
<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
<td align="center">

<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=3')->row(); ?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=12')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=12')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2); ?>




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
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 5
</a></div>
<?php endforeach; ?>



<?php else: ?>
  <!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php foreach ($mulai_Y_3_respon as $key): ?>
<div class="panel panel-default">
<div class="panel-body">
<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
</div>
<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
</a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>


<?php endif; // close all process when not have data from table_temporary ?>




























  <?php elseif($dataget->total==5 or $dataget->total ==4): // Untuk semester 5 ?>
		
		<?php $replace_cek = $this->Smart_model->validasiKRSentryGanjil(5); ?>
    <?php if ($replace_cek): ?>
      <h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smartGanjil/hapus_entry_H3') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
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
      foreach ($H3 as $key): ?>  <tr>
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
      <a href="<?php echo base_url('smartGanjil/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
      </div>
      <!--tampilkan data hasil krs yang masuk di tabel entry-->
      <!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->
    <?php else: ?>

  
<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
?>
<?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=4')->row();
$maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=4')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2)   ;



 ?>
 



<?php
// Baca Kode Respon yang di Kirim dari database
// Apakah Ada data yang di kirim pada uri segment ada atau tidak, yang datanya diberi nama $respon
if ($respon==''):
// jika respon ini kosong maka akan tampilkan pertanyaan awal, dengan kondisi pertanyaan mulai = Y
// pertanyaan tersebut akan ditampilkan
?>

			 <?php foreach ($mulai_Y_5 as $key): ?>
				 <div class="panel panel-default">
						 <div class="panel-body">
							 <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
						 </div>
						 <div class="panel-footer">
							 <p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
							 </a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
						 </div>
					 </div>
			 <?php endforeach; ?>


		 <?php elseif($respon=='RB4SMT1-5'): ?>


			<?php $cek_semester1 = $this->Smart_model->mengulang_semester1_cekData(); ?>
			<?php foreach ($mengulang_semester5 as $key): ?>

			<?php if ($cek_semester1>0): ?>

		<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

			<?php else: ?>
				<?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

			<?php endif; ?>
		<?php endforeach; ?>



	<?php elseif($respon=='RB4SMT3-5'): ?>


	 <?php $cek_semester3 = $this->Smart_model->mengulang_semester3_cekData(); ?>
	 <?php foreach ($mengulang_semester5 as $key): ?>

	 <?php if ($cek_semester3>0): ?>

	<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

	 <?php else: ?>
		 <?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

	 <?php endif; ?>
	<?php endforeach; ?>





<?php elseif ($respon=='RB2SMT3-5'): ?>
	 		 <div class="panel panel-default">


	 	 <?php if ($view_ipk >=3.00 ): ?>

	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 		</div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 	 </p>
	 	 </div>
	 	 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>


	 		<div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>

	 	 <?php endforeach; ?>
	 	 <?php endif; ?>






	 	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 	 <div class="panel-body">
	 	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 	 </div>


	 							 <div class="panel-footer">
	 							 <p class="bgbottom">
	 							 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 							 class="btn btn-primary btn-lg" role="button">
	 							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 							 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 							 </p>
	 							 </div>
	 							 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 	 </h1>
	 	 </div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>




	 	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 		</div>


	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>

	 	 <?php else: ?>


	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>

	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>



	 	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 		</div>


	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>

	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>





	 	 <?php elseif($view_ipk <=1.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 		</div>



	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>


	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>


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
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
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


			<?php elseif ($respon=='RB2SMT5-5'): ?>
	 		 <div class="panel panel-default">


	 	 <?php if ($view_ipk >=3.00 ): ?>

	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 		</div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 	 </p>
	 	 </div>
	 	 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>


	 		<div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>

	 	 <?php endforeach; ?>
	 	 <?php endif; ?>






	 	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 	 <div class="panel-body">
	 	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 	 </div>


	 							 <div class="panel-footer">
	 							 <p class="bgbottom">
	 							 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 							 class="btn btn-primary btn-lg" role="button">
	 							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 							 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 							 </p>
	 							 </div>
	 							 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 	 </h1>
	 	 </div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>




	 	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 		</div>


	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>

	 	 <?php else: ?>


	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>

	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>



	 	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 		</div>


	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>

	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>





	 	 <?php elseif($view_ipk <=1.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 		</div>



	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>


	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>


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
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
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



			<?php elseif ($respon=='RB2SMT1-5'): ?>
	 		 <div class="panel panel-default">


	 	 <?php if ($view_ipk >=3.00 ): ?>

	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 		</div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 	 </p>
	 	 </div>
	 	 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>


	 		<div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>

	 	 <?php endforeach; ?>
	 	 <?php endif; ?>






	 	 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 	 <div class="panel-body">
	 	 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 	 </div>


	 							 <div class="panel-footer">
	 							 <p class="bgbottom">
	 							 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 							 class="btn btn-primary btn-lg" role="button">
	 							 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 							 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 							 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 							 </p>
	 							 </div>
	 							 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
	 	 </h1>
	 	 </div>


	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>




	 	 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 		</div>


	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>

	 	 <?php else: ?>


	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>

	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>



	 	 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

	 		</div>


	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>



	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>
	 	 <div class="panel-body">
	 	 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
	 	 <span class="btn btn-primary btn-md">
	 	 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
	 	 </div>

	 	 <div class="panel-footer">
	 	 <p class="bgbottom">
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
	 	 </div>
	 	 <?php endforeach; ?>
	 	 <?php endif; ?>





	 	 <?php elseif($view_ipk <=1.99): ?>
	 	 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>

	 		<div class="panel-body">
	 		<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
	 		<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
	 		</div>



	 								 <div class="panel-footer">
	 								 <p class="bgbottom">
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
	 								 class="btn btn-primary btn-lg" role="button">
	 								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
	 								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
	 								 </p>
	 								 </div>
	 								 <?php endforeach; ?>


	 	 <?php else: ?>
	 	 <?php foreach ($mulai_Y_5_respon as $key): ?>


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
	 	 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
	 	 class="btn btn-primary btn-lg" role="button">
	 	 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
	 	 </div>
	 	 <?php endforeach; ?>

	 	 <?php endif; ?>
	 	 <?php else: ?>
	 		Maff, untuk sementara Belum ada IPK
	 	 <?php endif; ?>
	 	 </div>
 


			<?php elseif ($respon=='RB2SMT7-5'): ?>
			 <div class="panel panel-default">


		 <?php if ($view_ipk >=3.00 ): ?>

		 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>

			<div class="panel-body">
			<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
			<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
			</div>


		 <div class="panel-footer">
		 <p class="bgbottom">
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
		 class="btn btn-primary btn-lg" role="button">
		 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
		 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
		 </p>
		 </div>
		 <?php endforeach; ?>



		 <?php else: ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>
		 <div class="panel-body">
		 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
		 <span class="btn btn-primary btn-md">
		 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
		 </div>


			<div class="panel-footer">
		 <p class="bgbottom">
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
		 class="btn btn-primary btn-lg" role="button">
		 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
		 </div>

		 <?php endforeach; ?>
		 <?php endif; ?>






		 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
		 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>

		 <div class="panel-body">
		 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
		 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

		 </div>


								 <div class="panel-footer">
								 <p class="bgbottom">
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
								 class="btn btn-primary btn-lg" role="button">
								 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
								 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
								 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
								 </p>
								 </div>
								 <?php endforeach; ?>



		 <?php else: ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>
		 <div class="panel-body">
		 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
		 <span class="btn btn-primary btn-md">
		 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
		 </h1>
		 </div>


		 <div class="panel-footer">
		 <p class="bgbottom">
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
		 class="btn btn-primary btn-lg" role="button">
		 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
		 </div>
		 <?php endforeach; ?>
		 <?php endif; ?>




		 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
		 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>

			<div class="panel-body">
			<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
			<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

			</div>


									 <div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
									 class="btn btn-primary btn-lg" role="button">
									 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
									 </p>
									 </div>
									 <?php endforeach; ?>

		 <?php else: ?>


		 <?php foreach ($mulai_Y_5_respon as $key): ?>
		 <div class="panel-body">
		 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
		 <span class="btn btn-primary btn-md">
		 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
		 </div>

		 <div class="panel-footer">
		 <p class="bgbottom">
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
		 class="btn btn-primary btn-lg" role="button">
		 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
		 </div>
		 <?php endforeach; ?>
		 <?php endif; ?>



		 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
		 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>

			<div class="panel-body">
			<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
			<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

			</div>


									 <div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
									 class="btn btn-primary btn-lg" role="button">
									 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
									 </p>
									 </div>
									 <?php endforeach; ?>



		 <?php else: ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>
		 <div class="panel-body">
		 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
		 <span class="btn btn-primary btn-md">
		 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
		 </div>

		 <div class="panel-footer">
		 <p class="bgbottom">
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
		 class="btn btn-primary btn-lg" role="button">
		 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
		 </div>
		 <?php endforeach; ?>
		 <?php endif; ?>





		 <?php elseif($view_ipk <=1.99): ?>
		 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>

			<div class="panel-body">
			<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
			<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
			</div>



									 <div class="panel-footer">
									 <p class="bgbottom">
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
									 class="btn btn-primary btn-lg" role="button">
									 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
									 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
									 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
									 </p>
									 </div>
									 <?php endforeach; ?>


		 <?php else: ?>
		 <?php foreach ($mulai_Y_5_respon as $key): ?>


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
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
		 class="btn btn-primary btn-lg" role="button">
		 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
		 </div>
		 <?php endforeach; ?>

		 <?php endif; ?>
		 <?php else: ?>
			Maff, untuk sementara Belum ada IPK
		 <?php endif; ?>
		 </div>
 


		 <?php elseif ($respon=='P4SMT5') : ?>
			 <?php foreach ($mulai_Y_5_respon as $keys): ?>
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
			 foreach ($sem_3 as $key): ?>  <tr>
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

			 <div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>smartGanjil/simpanP6_H3"
			 class="btn btn-primary btn-lg" role="button"
			 onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
			 YES <b  class="glyphicon glyphicon-ok"></b></a>
			 <a href="<?php echo base_url()?>smartGanjil/hapus_entry_temp_ganjil"
			 class="btn btn-warning btn-lg" role="button"
			 onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
			 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
			 </div>
			 <?php endforeach ?>


			 
		 


		 <?php elseif($respon=='RB3SMT3-5'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_5_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester3();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
		  <?php endif; ?>
		  </td>

		  </tr>
		  <?php endforeach; ?>
		  <tr>
		  <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
		  <td align="center">

		  <?php
		  $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=3')->row(); ?>

		  <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=12')->row();
		  $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=12')->row();
		  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
		  $view_ipk = number_format($ipk,2); ?>




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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 5
		 </a></div>
		  <?php endforeach; ?>


		 <?php elseif($respon=='RB3SMT1-5'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_5_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester1();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
		  <?php endif; ?>
		  </td>

		  </tr>
		  <?php endforeach; ?>
		  <tr>
		  <td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
		  <td align="center">

		  <?php
		  $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=3')->row(); ?>

		  <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=12')->row();
		  $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=12')->row();
		  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
		  $view_ipk = number_format($ipk,2); ?>




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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 5
		 </a></div>
		  <?php endforeach; ?>





		 <?php elseif ($respon=='PKT5'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
			 <?php
			 $mhs = $this->session->userdata('id_mahasiswa');
			 $seg3= $this->uri->segment(3);
			 $paketsemester3= 'P4SMT5';

			 $dat1 = date('Y');
			 $dat2 = date('Y')-1;
				 $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=15 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

			 $PKT2 = $this->db->query('select mt.id_mk_tawaran  from mk_tawaran mt natural join matakuliah mk where mt.id_semester=15 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
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
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_A->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }

			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
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
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 }
			 // kelas C
			 elseif ($total_C->total_C < $kelas_C->kapasitas ) {
				foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_C->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 } elseif ($total_D->total_D < $kelas_D->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_D->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 // jika tidak ada selain kelas D pada kelas PAGI
			 }else {
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));}
			 } // Kelas Sore / Kelas Malam (K,L,X,Y)
			 else {

			 if ($total_K->total_K < $kelas_K->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_K->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 // KELAS L
			 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_L->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }

			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 // kelas X
			 }
			 elseif ($total_X->total_X < $kelas_X->kapasitas ) {
				foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_X->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }

			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 // KELAS Y
			 } elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_Y->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 }else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-danger">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Gagal Tersimpan.
			 </div>');


			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 } // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
			 } // else tutup kelas Sore

			 } else {  // TUTUP 24 SKS
				 $this->session->set_flashdata('message',
			 '<div class="alert alert-danger">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
			 <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));

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
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_A->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }

			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
				foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_B->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
				foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_C->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 }
			 elseif ($total_D->total_D < $kelas_D->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_D->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

				redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 }else {
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 }



			 }else { //kelas K
			 if ($total_K->total_K < $kelas_K->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_K->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 // batas pagi
			 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_L->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 } elseif ($total_X->total_X < $kelas_X->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_X->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_Y->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1);
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 }else {
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-danger">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Gagal Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 }
						 } // else tutup kelas Sore

			 }else{
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-danger">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
				<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
			 }



			 }elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
			 if ($RB3->sks<=18) {
			 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
			 if ($total_A->total_A < $kelas_A->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('d-m-Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_A->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_B->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_C->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
				redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_D->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
				redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }else {
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
				redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }

			 }else {
			 if ($total_K->total_K < $kelas_K->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_K->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
				redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_L->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_X->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
				'<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_Y->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1);
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
				 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 }else {
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-danger">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Gagal Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 }



			 } // else tutup kelas Sore
			 } else {

				 $this->session->set_flashdata('message',
			 '<div class="alert alert-danger">
				 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
					<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
			 }


			 }elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
			 if ($RB3->sks<=15) {
			 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
			 if ($total_A->total_A < $kelas_A->kapasitas ) {

				foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('d-m-Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_A->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }

			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5 </strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_B->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
			 </div>');
				redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_C->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_D->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');


			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 }else {
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));



			 }

			 }else {
			 if ($total_K->total_K < $kelas_K->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_K->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_L->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_X->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_Y->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }else {
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-danger">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Gagal Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));

			 }


			 } // else tutup kelas Sore
			 } else {
				 $this->session->set_flashdata('message',
				 '<div class="alert alert-danger">
				 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
					<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
				 </div>');
				 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
			 }



			 } elseif($view_ipk <=1.99){
			 if ($RB3->sks<=12) {
			 if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
			 if ($total_A->total_A < $kelas_A->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('d-m-Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_A->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');

			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));


			 }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
					foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_B->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 // batas pagi
			 }
			 elseif ($total_C->total_C < $kelas_C->kapasitas ) {
			 # code...
				foreach ($PKT2 as $key) {
			 $result_replace = array(

			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_C->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }

			 $this->session->set_flashdata('message',
									'<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.

									 </div>');
									 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
								 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 // batas pagi
			 }
			 elseif ($total_D->total_D < $kelas_D->kapasitas ) {
			 # code...
				foreach ($PKT2 as $key) {
			 $result_replace = array(

			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_D->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
									'<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.

									 </div>');
									 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
							 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 // batas pagi
			 }else {
			 $this->session->set_flashdata('message',
									'<div class="alert alert-danger">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

									 </div>');
									 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
					 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 }

			 }else {

			 if ($total_K->total_K < $kelas_K->kapasitas ) {
			 # code...
			 foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_K->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
									'<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.
			 </div>');
									 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 // batas pagi
			 }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
			 # code...
				foreach ($PKT2 as $key) {
			 $result_replace = array(

			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_L->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }

			 $this->session->set_flashdata('message',
									'<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

									 </div>');
								 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 // batas pagi
			 }
			 elseif ($total_X->total_X < $kelas_X->kapasitas ) {
			 # code...
				foreach ($PKT2 as $key) {
			 $result_replace = array(

			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_X->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }
			 $this->session->set_flashdata('message',
									'<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.

									 </div>');
							 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 // batas pagi
			 }
			 elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

				foreach ($PKT2 as $key) {
			 $result_replace = array(
			 "id_mahasiswa"   =>  $mhs,
			 "waktu_entry"    => date('Y'),
			 "semester_aktif" => 5,
			 "validasi"       => 'BELUM',
			 "id_mk_tawaran"  => $key->id_mk_tawaran,
			 "id_kelas"       => $kelas_Y->id_kelas,
			 "semester_tahun_akademik" => 'Ganjil',
			 "tahun_akademik" => $dat2.'/'.$dat1,
			 );
			 $this->db->insert('entry_temporary', $result_replace);
			 }

			 $this->session->set_flashdata('message',
									'<div class="alert alert-success">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Berhasil Tersimpan.

									 </div>');
					 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 // batas pagi
			 }else {
			 $this->session->set_flashdata('message',
										'<div class="alert alert-danger">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Paket Matakuliah Semester 5</strong> Gagal Tersimpan.

										 </div>');
							 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 }


			 } // else tutup kelas Sore
			 } else {

			 $this->session->set_flashdata('message',
			 '<div class="alert alert-danger">
				 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
					<br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
			 </div>');
			 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
			 }

			 } else{
			 $this->session->set_flashdata('message',
			 '<div class="alert alert-warning">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Maaf</strong> Untuk sementara Belum ada data IPK.
			 </div>');
				 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
			 // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
			 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
			 }
			 ?>




		 <?php elseif($respon=='RB1SMT5-5'): ?>
		 <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		 <?php foreach ($mulai_Y_5_respon as $key): ?>
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

		 $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=15 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
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
		 foreach ($RB3 as $mk_tawaran):?>
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

		 <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		 <?php else: ?>
		 <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		 <a href="<?php echo base_url()?>smartGanjil/hapus_entry_H3"
		 class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 3,5,7 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
		 NO <b  class="glyphicon glyphicon-remove"></b></a></div>
		 <?php endforeach; ?>




	 <?php elseif($respon=='RB1SMT7-5'): ?>
		 <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		 <?php foreach ($mulai_Y_5_respon as $key): ?>
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

		 $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=17 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
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
		 foreach ($RB3 as $mk_tawaran):?>
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

		 <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		 <?php else: ?>
		 <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		 <a href="<?php echo base_url()?>smartGanjil/hapus_entry_H3"
		 class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 3,5,7 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
		 NO <b  class="glyphicon glyphicon-remove"></b></a></div>
		 <?php endforeach; ?>



<?php else: ?>
  <!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php foreach ($mulai_Y_5_respon as $key): ?>
<div class="panel panel-default">
<div class="panel-body">
<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
</div>
<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
</a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
















	<!--BUKA SEMESTER 7 DISINI-->
 
 





  <?php elseif($dataget->total==7 or $dataget->total ==6): // Untuk semester 7 ?>

<?php
	$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
	join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
	?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=6')->row();
$maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
 join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=6')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2)   ; ?>



<?php $replace_cek = $this->Smart_model->validasiKRSentryGanjil(7);
	?>
    <?php if ($replace_cek): ?>
      <h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya 
	  <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan 
	  <a href="<?php echo base_url('smartGanjil/hapus_entry_H3') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
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
      foreach ($H3 as $key): ?>  <tr>
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
      <a href="<?php echo base_url('smartGanjil/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
      </div>
      <!--tampilkan data hasil krs yang masuk di tabel entry-->
      <!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->
    <?php else: ?>





			 



 
<?php 
$periksaMinat = $CekMinat->row();
$CekDataMinat = $CekMinat->num_rows();

 ?>

 <?php if($CekDataMinat < 1 ):?>
<h1>No Data is Here or  Matakuliah Umum Only <br> KODE program disini</h1>



<?php
 if ($respon==''): 
 ?>


<?php foreach ($mulai_Y_7 as $key): ?>
				 <div class="panel panel-default">
						 <div class="panel-body">
							 <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
						 </div>
						 <div class="panel-footer">
							 <p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
							 </a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
						 </div>
					 </div>
			 <?php endforeach; ?>


















<?php elseif($respon=='RB1SMT7-7'): ?>

<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
<?php foreach ($mulai_Y_7_respon as $key): ?>
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

$RB3 = $this->Smart_model->viewMinat7empty();
$mhs = $this->session->userdata('id_mahasiswa');

$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_aktif=3');
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
foreach ($RB3 as $mk_tawaran):?>
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

<a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


<?php else: ?>
<a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
<?php endif; ?>
</td>

</tr>
<?php endforeach; ?>
<tr>
<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
<td align="center">

<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk where et.semester_aktif=3')->row(); ?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=12')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=12')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2); ?>




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
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
<a href="<?php echo base_url()?>smartGanjil/hapus_entry_H3"
class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 3,5,7 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
NO <b  class="glyphicon glyphicon-remove"></b></a></div>
<?php endforeach; ?>







<?php else: ?>
  <!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php foreach ($mulai_Y_7_respon as $key): ?>
<div class="panel panel-default">
<div class="panel-body">
<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
</div>
<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
</a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>

 










<?php else:?>

 <?php if($periksaMinat->nama_minat=='SC'): ?>
  



<?php
 if ($respon==''): 
 ?>


<?php foreach ($mulai_Y_7 as $key): ?>
				 <div class="panel panel-default">
						 <div class="panel-body">
							 <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
						 </div>
						 <div class="panel-footer">
							 <p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
							 </a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
						 </div>
					 </div>
			 <?php endforeach; ?>





 <?php elseif($respon=='RB3SMT3-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester3();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>


 <?php elseif($respon=='RB3SMT1-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester1();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>








 <?php elseif($respon=='RB3SMT5-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester5();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>




  <?php elseif ($respon=='PKT7'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
             <?php
             $mhs = $this->session->userdata('id_mahasiswa');
             $seg3= $this->uri->segment(3);
             $paketsemester3= 'P4SMT7';

             $dat1 = date('Y');
             $dat2 = date('Y')-1;
               $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural 
			   join matakuliah mk where mt.id_semester=17 and mt.id_mk 
			   not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat 
			   in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

             $PKT2 =  $this->Smart_model->viewMinat7('SC');

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
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
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
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }
             // kelas C
             elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             } elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             // jika tidak ada selain kelas D pada kelas PAGI
             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));}
             } // Kelas Sore / Kelas Malam (K,L,X,Y)
             else {

             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             // KELAS L
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             // kelas X
             }
             elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             // KELAS Y
             } elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');


             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             } // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
             } // else tutup kelas Sore

             } else {  // TUTUP 24 SKS
               $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
             <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));

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
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }
             elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

              redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }



             }else { //kelas K
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             // batas pagi
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             } elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1);
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }
                   } // else tutup kelas Sore

             }else{
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
              <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }



             }elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
             if ($RB3->sks<=18) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }

             }else {
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
              '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1);
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
               </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }



             } // else tutup kelas Sore
             } else {

               $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }


             }elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
             if ($RB3->sks<=15) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {

             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');


             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }

             }else {
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }


             } // else tutup kelas Sore
             } else {
               $this->session->set_flashdata('message',
               '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
               </div>');
							 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }



             } elseif($view_ipk <=1.99){
             if ($RB3->sks<=12) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
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
                       redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
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
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }else {
             $this->session->set_flashdata('message',
                        '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

                         </div>');
                         // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
                 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }

             }else {

             if ($total_K->total_K < $kelas_K->kapasitas ) {
             # code...
             foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');
                         // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                       redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }else {
             $this->session->set_flashdata('message',
                          '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

                           </div>');
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }


             } // else tutup kelas Sore
             } else {

             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }

             } else{
             $this->session->set_flashdata('message',
             '<div class="alert alert-warning">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Maaf</strong> Untuk sementara Belum ada data IPK.
             </div>');
               // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }
             ?>







	
	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT7-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->



	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT1-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT5-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





 <?php elseif ($respon=='P4SMT7') : ?>
			 <?php foreach ($mulai_Y_7_respon as $keys): ?>
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
			 foreach ($sem_3 as $key): ?>  <tr>
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

			 <div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>smartGanjil/simpanP6_H3"
			 class="btn btn-primary btn-lg" role="button"
			 onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
			 YES <b  class="glyphicon glyphicon-ok"></b></a>
			 <a href="<?php echo base_url()?>smartGanjil/hapus_entry_temp_ganjil"
			 class="btn btn-warning btn-lg" role="button"
			 onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
			 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
			 </div>
			 <?php endforeach ?>



	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT3-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





 <?php elseif($respon=='RB4SMT1-7'): ?>


			<?php $cek_semester1 = $this->Smart_model->mengulang_semester1_cekData(); ?>
			<?php foreach ($mengulang_semester7 as $key): ?>

			<?php if ($cek_semester1>0): ?>

		<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

			<?php else: ?>
				<?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

			<?php endif; ?>
		<?php endforeach; ?>



	<?php elseif($respon=='RB4SMT3-7'): ?>


	 <?php $cek_semester3 = $this->Smart_model->mengulang_semester3_cekData(); ?>
	 <?php foreach ($mengulang_semester7 as $key): ?>

	 <?php if ($cek_semester3>0): ?>

	<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

	 <?php else: ?>
		 <?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

	 <?php endif; ?>
	<?php endforeach; ?>



	<?php elseif($respon=='RB4SMT5-7'): ?>


	 <?php $cek_semester3 = $this->Smart_model->mengulang_semester5_cekData(); ?>
	 <?php foreach ($mengulang_semester7 as $key): ?>

	 <?php if ($cek_semester3>0): ?>

	<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

	 <?php else: ?>
		 <?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

	 <?php endif; ?>
	<?php endforeach; ?>






<?php elseif($respon=='RB1SMT7-7'): ?>

<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
<?php foreach ($mulai_Y_7_respon as $key): ?>
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

$RB3 = $this->Smart_model->viewMinat7('SC');
$mhs = $this->session->userdata('id_mahasiswa');

$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_aktif=7');
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
foreach ($RB3 as $mk_tawaran):?>
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

<a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


<?php else: ?>
<a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
<?php endif; ?>
</td>

</tr>
<?php endforeach; ?>
<tr>
<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
<td align="center">

<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on 
mk.id_mk=mt.id_mk where et.semester_aktif=7')->row(); ?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=16')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=16')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2); ?>




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
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
<a href="<?php echo base_url()?>smartGanjil/hapus_entry_H3"
class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 3,5,7 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
NO <b  class="glyphicon glyphicon-remove"></b></a></div>
<?php endforeach; ?>


<?php else: ?>
  <!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php foreach ($mulai_Y_7_respon as $key): ?>
<div class="panel panel-default">
<div class="panel-body">
<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
</div>
<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
</a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>














 <?php elseif($periksaMinat->nama_minat=='JCM'): ?>
 
 








<?php
 if ($respon==''): 
 ?>

 
<?php foreach ($mulai_Y_7 as $key): ?>
				 <div class="panel panel-default">
						 <div class="panel-body">
							 <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
						 </div>
						 <div class="panel-footer">
							 <p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
							 </a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
						 </div>
					 </div>
			 <?php endforeach; ?>





 <?php elseif($respon=='RB3SMT3-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester3();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>


 <?php elseif($respon=='RB3SMT1-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester1();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>








 <?php elseif($respon=='RB3SMT5-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester5();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>




  <?php elseif ($respon=='PKT7'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
             <?php
             $mhs = $this->session->userdata('id_mahasiswa');
             $seg3= $this->uri->segment(3);
             $paketsemester3= 'P4SMT7';

             $dat1 = date('Y');
             $dat2 = date('Y')-1;
               $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural 
			   join matakuliah mk where mt.id_semester=17 and mt.id_mk 
			   not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat 
			   in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

             $PKT2 =  $this->Smart_model->viewMinat7('JCM');

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
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
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
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }
             // kelas C
             elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             } elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             // jika tidak ada selain kelas D pada kelas PAGI
             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));}
             } // Kelas Sore / Kelas Malam (K,L,X,Y)
             else {

             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             // KELAS L
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             // kelas X
             }
             elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             // KELAS Y
             } elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');


             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             } // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
             } // else tutup kelas Sore

             } else {  // TUTUP 24 SKS
               $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
             <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));

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
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }
             elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

              redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }



             }else { //kelas K
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             // batas pagi
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             } elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1);
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }
                   } // else tutup kelas Sore

             }else{
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
              <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }



             }elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
             if ($RB3->sks<=18) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }

             }else {
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
              '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1);
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
               </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }



             } // else tutup kelas Sore
             } else {

               $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }


             }elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
             if ($RB3->sks<=15) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {

             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');


             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }

             }else {
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }


             } // else tutup kelas Sore
             } else {
               $this->session->set_flashdata('message',
               '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
               </div>');
							 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }



             } elseif($view_ipk <=1.99){
             if ($RB3->sks<=12) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
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
                       redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
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
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }else {
             $this->session->set_flashdata('message',
                        '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

                         </div>');
                         // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
                 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }

             }else {

             if ($total_K->total_K < $kelas_K->kapasitas ) {
             # code...
             foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');
                         // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                       redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }else {
             $this->session->set_flashdata('message',
                          '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

                           </div>');
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }


             } // else tutup kelas Sore
             } else {

             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }

             } else{
             $this->session->set_flashdata('message',
             '<div class="alert alert-warning">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Maaf</strong> Untuk sementara Belum ada data IPK.
             </div>');
               // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }
             ?>







	
	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT7-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->



	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT1-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT5-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





 <?php elseif ($respon=='P4SMT7') : ?>
			 <?php foreach ($mulai_Y_7_respon as $keys): ?>
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
			 foreach ($sem_3 as $key): ?>  <tr>
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

			 <div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>smartGanjil/simpanP6_H3"
			 class="btn btn-primary btn-lg" role="button"
			 onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
			 YES <b  class="glyphicon glyphicon-ok"></b></a>
			 <a href="<?php echo base_url()?>smartGanjil/hapus_entry_temp_ganjil"
			 class="btn btn-warning btn-lg" role="button"
			 onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
			 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
			 </div>
			 <?php endforeach ?>



	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT3-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





 <?php elseif($respon=='RB4SMT1-7'): ?>


			<?php $cek_semester1 = $this->Smart_model->mengulang_semester1_cekData(); ?>
			<?php foreach ($mengulang_semester7 as $key): ?>

			<?php if ($cek_semester1>0): ?>

		<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

			<?php else: ?>
				<?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

			<?php endif; ?>
		<?php endforeach; ?>



	<?php elseif($respon=='RB4SMT3-7'): ?>


	 <?php $cek_semester3 = $this->Smart_model->mengulang_semester3_cekData(); ?>
	 <?php foreach ($mengulang_semester7 as $key): ?>

	 <?php if ($cek_semester3>0): ?>

	<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

	 <?php else: ?>
		 <?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

	 <?php endif; ?>
	<?php endforeach; ?>



	<?php elseif($respon=='RB4SMT5-7'): ?>


	 <?php $cek_semester3 = $this->Smart_model->mengulang_semester5_cekData(); ?>
	 <?php foreach ($mengulang_semester7 as $key): ?>

	 <?php if ($cek_semester3>0): ?>

	<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

	 <?php else: ?>
		 <?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

	 <?php endif; ?>
	<?php endforeach; ?>






<?php elseif($respon=='RB1SMT7-7'): ?>

<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
<?php foreach ($mulai_Y_7_respon as $key): ?>
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

$RB3 = $this->Smart_model->viewMinat7('JCM');
$mhs = $this->session->userdata('id_mahasiswa');

$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_aktif=7');
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
foreach ($RB3 as $mk_tawaran):?>
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

<a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


<?php else: ?>
<a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
<?php endif; ?>
</td>

</tr>
<?php endforeach; ?>
<tr>
<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
<td align="center">

<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on 
mk.id_mk=mt.id_mk where et.semester_aktif=7')->row(); ?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=16')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=16')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2); ?>




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
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
<a href="<?php echo base_url()?>smartGanjil/hapus_entry_H3"
class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 3,5,7 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
NO <b  class="glyphicon glyphicon-remove"></b></a></div>
<?php endforeach; ?>


<?php else: ?>
  <!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php foreach ($mulai_Y_7_respon as $key): ?>
<div class="panel panel-default">
<div class="panel-body">
<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
</div>
<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
</a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>












 <?php elseif($periksaMinat->nama_minat=='PPK'): ?>
   





<?php
 if ($respon==''): 
 ?>

 
<?php foreach ($mulai_Y_7 as $key): ?>
				 <div class="panel panel-default">
						 <div class="panel-body">
							 <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
						 </div>
						 <div class="panel-footer">
							 <p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
							 </a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
						 </div>
					 </div>
			 <?php endforeach; ?>





 <?php elseif($respon=='RB3SMT3-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester3();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>


 <?php elseif($respon=='RB3SMT1-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester1();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>








 <?php elseif($respon=='RB3SMT5-7'): ?>

		  <input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
		  <?php foreach ($mulai_Y_7_respon as $key): ?>
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
		  $get_semester1 = $this->Smart_model->mengulang_semester5();
		  foreach (	$get_semester1 as $mk_tawaran): ?>
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

		  <a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


		  <?php else: ?>
		  <a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
		  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK
		 </a></div>
		  <?php endforeach; ?>




  <?php elseif ($respon=='PKT7'): // JIKA RESPON URI ADALAH PKT2 MAKA PAKET MK DI JALLANKAN?>
             <?php
             $mhs = $this->session->userdata('id_mahasiswa');
             $seg3= $this->uri->segment(3);
             $paketsemester3= 'P4SMT7';

             $dat1 = date('Y');
             $dat2 = date('Y')-1;
               $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural 
			   join matakuliah mk where mt.id_semester=17 and mt.id_mk 
			   not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat 
			   in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

             $PKT2 =  $this->Smart_model->viewMinat7('PPK');

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
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
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
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }
             // kelas C
             elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             } elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             // jika tidak ada selain kelas D pada kelas PAGI
             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));}
             } // Kelas Sore / Kelas Malam (K,L,X,Y)
             else {

             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             // KELAS L
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             // kelas X
             }
             elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             // KELAS Y
             } elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }else { // eLSE TIDAK ADA KELAS SELAIN KELAS X, PADA KELAS MALAM, MAKA HALAMAN INI AKAN DI REDIRECT
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');


             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             } // TUTUP TIDAK ADA KELAS SELAIN KELAS X, ATAU KELAS X ADALAH KELAS TERAKHIR DI KELAS MALAM
             } // else tutup kelas Sore

             } else {  // TUTUP 24 SKS
               $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
             <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));

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
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }
             elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

              redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }



             }else { //kelas K
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             // batas pagi
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             } elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1);
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }
                   } // else tutup kelas Sore

             }else{
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
              <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }



             }elseif($view_ipk >=2.00 AND $view_ipk <=2.49) {
             if ($RB3->sks<=18) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }

             }else {
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
              '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1);
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
               </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Gagal Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }



             } // else tutup kelas Sore
             } else {

               $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }


             }elseif($view_ipk >=1.50 AND $view_ipk <=1.99){
             if ($RB3->sks<=15) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {

             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>'.$mk_t->nama_matakuliah.'</strong> Berhasil Tersimpan.
             </div>');
              redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');


             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));



             }

             }else {
             if ($total_K->total_K < $kelas_K->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 <strong>Paket Matakuliah Semester 3</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }else {
             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));

             }


             } // else tutup kelas Sore
             } else {
               $this->session->set_flashdata('message',
               '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
               </div>');
							 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }



             } elseif($view_ipk <=1.99){
             if ($RB3->sks<=12) {
             if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
             if ($total_A->total_A < $kelas_A->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('d-m-Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_A->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');

             redirect(site_url('SmartGanjil/index/'.$paketsemester3));


             }elseif ($total_B->total_B < $kelas_B->kapasitas ) {
             		foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_B->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
             '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_C->total_C < $kelas_C->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_C->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
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
                       redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_D->total_D < $kelas_D->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_D->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
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
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }else {
             $this->session->set_flashdata('message',
                        '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

                         </div>');
                         // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
                 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }

             }else {

             if ($total_K->total_K < $kelas_K->kapasitas ) {
             # code...
             foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_K->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1 );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.
             </div>');
                         // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }elseif ($total_L->total_L < $kelas_L->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_L->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                       redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_X->total_X < $kelas_X->kapasitas ) {
             # code...
             	foreach ($PKT2 as $key) {
             $result_replace = array(

             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_X->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }
             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }
             elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {

             	foreach ($PKT2 as $key) {
             $result_replace = array(
             "id_mahasiswa"   =>  $mhs,
             "waktu_entry"    => date('Y'),
             "semester_aktif" => 7,
             "validasi"       => 'BELUM',
             "id_mk_tawaran"  => $key->id_mk_tawaran,
             "id_kelas"       => $kelas_Y->id_kelas,
             "semester_tahun_akademik" => 'Ganjil',
             "tahun_akademik" => $dat2.'/'.$dat1,
             );
             $this->db->insert('entry_temporary', $result_replace);
             }

             $this->session->set_flashdata('message',
                        '<div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2Paket Matakuliah Semester 2</strong> Berhasil Tersimpan.

                         </div>');
                 redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             // batas pagi
             }else {
             $this->session->set_flashdata('message',
                          '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Paket Matakuliah Semester 2</strong> Gagal Tersimpan.

                           </div>');
                     redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }


             } // else tutup kelas Sore
             } else {

             $this->session->set_flashdata('message',
             '<div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
                <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.
             </div>');
						 redirect(site_url('SmartGanjil/index/'.$sks_lebih->jika_tidak));
             }

             } else{
             $this->session->set_flashdata('message',
             '<div class="alert alert-warning">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Maaf</strong> Untuk sementara Belum ada data IPK.
             </div>');
               // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             // redirect halaman, akan di kembalikan kepada halaman dengan parameter kode pertanyaan.
             redirect(site_url('SmartGanjil/index/'.$paketsemester3));
             }
             ?>







	
	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT7-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->



	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT1-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT5-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





 <?php elseif ($respon=='P4SMT7') : ?>
			 <?php foreach ($mulai_Y_7_respon as $keys): ?>
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
			 foreach ($sem_3 as $key): ?>  <tr>
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

			 <div class="panel-footer"> <p class="bgbottom"> <a href="<?php echo base_url()?>smartGanjil/simpanP6_H3"
			 class="btn btn-primary btn-lg" role="button"
			 onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
			 YES <b  class="glyphicon glyphicon-ok"></b></a>
			 <a href="<?php echo base_url()?>smartGanjil/hapus_entry_temp_ganjil"
			 class="btn btn-warning btn-lg" role="button"
			 onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
			 NO <b  class="glyphicon glyphicon-remove"></b></a></p>
			 </div>
			 <?php endforeach ?>



	 <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)-->
	
	 <?php elseif ($respon=='RB2SMT3-7'): ?>
						   <div class="panel panel-default">
					   <?php
						 $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 
						 from entry_temporary et join mk_tawaran mt
						  on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
						   ?>

						 <?php if ($view_ipk >=3.00 ): ?>

						 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>
 						 	</div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
						 </p>
						 </div>
						 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>


						  <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>

						 <?php endforeach; ?>
						 <?php endif; ?>






						 <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 <div class="panel-body">
						 <h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 </div>



 												 <div class="panel-footer">
 												 <p class="bgbottom">
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
 												 class="btn btn-primary btn-lg" role="button">
 												 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
 												 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
 												 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
 												 </p>
 												 </div>
 												 <?php endforeach; ?>



						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
						 </h1>
						 </div>


						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>




						 <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>




													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>
						 <?php else: ?>


						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>



						 <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>

						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
						 <div class="panel-body">
						 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
						 <span class="btn btn-primary btn-md">
						 <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> </h1>
						 </div>

						 <div class="panel-footer">
						 <p class="bgbottom">
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b> </a> </p>
						 </div>
						 <?php endforeach; ?>
						 <?php endif; ?>





						 <?php elseif($view_ipk <=1.99): ?>
						 <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>

						 	<div class="panel-body">
						 	<h1 class="lead"><?php echo $key->nama_pertanyaan ?> Anda Masih Memiliki Kelebihan Sebesar <span class="btn btn-primary btn-md">
						 	<strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span> <br>

						 	</div>



													 <div class="panel-footer">
													 <p class="bgbottom">
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>"
													 class="btn btn-primary btn-lg" role="button">
													 NEXT <b  class="glyphicon glyphicon-forward"></b></a>
													 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
													 class="btn btn-warning btn-lg" role="button"> NO <b  class="glyphicon glyphicon-remove"></b> </a>
													 </p>
													 </div>
													 <?php endforeach; ?>


						 <?php else: ?>
						 <?php foreach ($mulai_Y_7_respon as $key): ?>
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
						 <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>"
						 class="btn btn-primary btn-lg" role="button">
						 NEXT <b  class="glyphicon glyphicon-fast-forward"></b></a></p>
						 </div>
						 <?php endforeach; ?>

						 <?php endif; ?>
						 <?php else: ?>
						  Maff, untuk sementara Belum ada IPK
						 <?php endif; ?>
						 </div>
						    <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1) -->





 <?php elseif($respon=='RB4SMT1-7'): ?>


			<?php $cek_semester1 = $this->Smart_model->mengulang_semester1_cekData(); ?>
			<?php foreach ($mengulang_semester7 as $key): ?>

			<?php if ($cek_semester1>0): ?>

		<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

			<?php else: ?>
				<?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

			<?php endif; ?>
		<?php endforeach; ?>



	<?php elseif($respon=='RB4SMT3-7'): ?>


	 <?php $cek_semester3 = $this->Smart_model->mengulang_semester3_cekData(); ?>
	 <?php foreach ($mengulang_semester7 as $key): ?>

	 <?php if ($cek_semester3>0): ?>

	<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

	 <?php else: ?>
		 <?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

	 <?php endif; ?>
	<?php endforeach; ?>



	<?php elseif($respon=='RB4SMT5-7'): ?>


	 <?php $cek_semester3 = $this->Smart_model->mengulang_semester5_cekData(); ?>
	 <?php foreach ($mengulang_semester7 as $key): ?>

	 <?php if ($cek_semester3>0): ?>

	<?php redirect('smartGanjil/index/'.$key->jika_ya); ?>

	 <?php else: ?>
		 <?php redirect('smartGanjil/index/'.$key->jika_tidak); ?>

	 <?php endif; ?>
	<?php endforeach; ?>






<?php elseif($respon=='RB1SMT7-7'): ?>

<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">
<?php foreach ($mulai_Y_7_respon as $key): ?>
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

$RB3 = $this->Smart_model->viewMinat7('PPK');
$mhs = $this->session->userdata('id_mahasiswa');

$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs.' and semester_aktif=7');
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
foreach ($RB3 as $mk_tawaran):?>
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

<a href="<?php echo base_url().'smartGanjil/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>


<?php else: ?>
<a href="<?php echo base_url().'smartGanjil/simpan_ke_entry_temp7/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
<?php endif; ?>
</td>

</tr>
<?php endforeach; ?>
<tr>
<td colspan="3" >Total SKS Yang Tersisa Saat di Program</td>
<td align="center">

<?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et 
join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on 
mk.id_mk=mt.id_mk where et.semester_aktif=7')->row(); ?>

<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai where id_semester=16')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai where id_semester=16')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2); ?>




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
<a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
<a href="<?php echo base_url()?>smartGanjil/hapus_entry_H3"
class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 3,5,7 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
NO <b  class="glyphicon glyphicon-remove"></b></a></div>
<?php endforeach; ?>


<?php else: ?>
  <!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php foreach ($mulai_Y_7_respon as $key): ?>
<div class="panel panel-default">
<div class="panel-body">
<h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
</div>
<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
</a>  <a href="<?php echo base_url()?>smartGanjil/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>








 <?php else: ?>

<h1>Maaf Tidak Ada Data Matakuliah Bidang Minat Disini</h1>


 


 








<?php endif; ?>
<?php endif; ?>

 <?php endif; ?>








  <?php elseif($dataget->total==8 or $dataget->total>=8  or $dataget->total ==7): // Untuk semester 7, jika semestser sekarang lebih dari > 7 ?>


    <?php if ($replace_cek): ?>
      <h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smartGanjil/hapus_entry') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>
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
      <a href="<?php echo base_url('smartGanjil/KRStoWord') ?>" class="btn btn-default btn-lg">Cetak  <p class="glyphicon glyphicon-print"></p> </a>
      </div>
      <!--tampilkan data hasil krs yang masuk di tabel entry-->
      <!--else ini berfungsi ketika data yang di entry belum ada di tabel entry-->
    <?php else: ?>

  <h1>your code, can be write HERE !</h1>

  <?php endif; ?>


<?php else: ?>

  <h3 class="alert  alert-warning">Maff, Tidak ada Semester saat ini</h3>

<?php endif; //end from semester sekarang ?>
