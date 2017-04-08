<style type="text/css" media="screen">
  #jarak
  {
    margin-top: 5px;
  }
  #bawah_tetap
  {
    height: 15px;
    padding-top: 0px;
  }

</style>

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

	$mhs_get = $this->db->query('select * from mahasiswa where id_mahasiswa='.$mhs)->row();

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

 ?>


<?php if($semester_sekarang->sekarang == 'Ganjil') { // Untuk semester genap ?>



  <?php if($dataget->total ==1 ) { // Untuk semester 1 ?>
<div class="panel panel-default">
<div class="panel-body">
<h1 class="lead">   Sekarang Anda adalah mahasiswa Baru    </h1>
<p>Adan secara otomatis di berikan matakuliah paket untuk semester 1</p>
<br>
<table class="table table-bordered">
<thead>
<th>Matakuliah</th>
<th>Semester</th>
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
   <td><?php echo $key->jam_masuk ?></td>
   <td><?php echo $key->jam_selesai ?></td>
   <td><?php echo $key->nama_ruangan ?></td>
   <td><?php echo $key->nama_kelas ?></td>
   <td><?php echo $key->hari ?></td>
   </tr>
   <?php endforeach; ?>
   </table>
      </div>

  <?php } elseif($dataget->total==3 or $dataget->total ==2) { // Untuk semester 3 ?>




        <?php foreach ($mulai_Y_3 as $key): ?>

          <div class="panel-body">
            <h1 class="lead">   Semester 3   </h1>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
            </div>
            <div class="panel-footer">
              <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
              </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
            </div>
          </div>
      <?php endforeach; ?>






  <?php } elseif( $dataget->total==5 or $dataget->total ==4) { // Untuk semester 5 ?>

    <?php foreach ($mulai_Y_5 as $key): ?>

      <div class="panel-body">
        <h1 class="lead">   Semester 5   </h1>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
        </div>
        <div class="panel-footer">
          <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
          </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
        </div>
      </div>
  <?php endforeach; ?>
  <?php } elseif($dataget->total==7 || $dataget->total>=7 or $dataget->total ==6) { // Untuk semester 7 ?>

    <?php foreach ($mulai_Y_7 as $key): ?>

      <div class="panel-body">
        <h1 class="lead">   Semester 7   </h1>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
        </div>
        <div class="panel-footer">
          <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
          </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
        </div>
      </div>
  <?php endforeach; ?>


  <?php } else{ // untuk semester Ganjil  ?>
<?php echo 'no data' ?>
    <?php } ?>


<!--batas semester ganjil-->

<?php
$get_pertanyaan = $this->db->get_where('pertanyaan', array('mulai'=>'Y'))->row();

 ?>










<?php } else{ //untuk semester Genap  ?>





  <div class="col-md-12 text-center">
      <div style="margin-top: 4px"  id="message">
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
      </div>
  </div>
  <!--periksa data jika data jawaban sudah ada-->
<?php 	$replace_cek = $this->Smart_model->validasiKRSentry();
 ?>

<?php if ($replace_cek): ?>
  <h4 class="alert alert-warning">Dibawah Ini Adalah KRS Anda Yang Telah Di Program Sebelumnya <br> Apakah Anda Ingin Mengubah Data KRS Anda ? <br> Silahkan <a href="<?php echo base_url('smart/hapus_entry') ?>" class="label label-default btn-md" onclick="javasciprt: return confirm('Anda Yakin Untuk Mengubah KRS Anda ? Data KRS Anda yang Sekarang Akan di Hapus dan Anda Akan Melakukan KRS Kembali')">Klik Disi</a></h4>

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



<?php else: ?>


<!--Sengaja diberika Batas --------------------------->
  <!--Sengaja diberika Batas --------------------------->
  <!--Sengaja diberika Batas --------------------------->
  <!--Sengaja diberika Batas --------------------------->
  <!--Sengaja diberika Batas --------------------------->
  <!--Sengaja diberika Batas --------------------------->



    <?php
// Pengecekan data semester 2
    if($dataget->total ==2 or $dataget->total ==1) { // Untuk semester 2
// Apakah semester sekarang adalah semester 2 jika_ya maka
// Lakukan Perintah dibawah ini |
//                              v
  ?>


<?php
// Baca Kode Respon yang di Kirim dari database
// Apakah Ada data yang di kirim pada uri segment atau tidak, yang datanya diberi nama $respon
 if ($respon==''):
// jika respon ini kosong maka akan tampilkan pertanyaan awal, dengan kondisi pertanyaan mulai = Y
// pertanyaan tersebut akan ditampilkan

?>



  <?php
  $getss = $this->db->get_where('pertanyaan',array('mulai'=>'Y'))->num_rows();

  $gets = $this->db->get_where('pertanyaan',array('mulai'=>'Y'))->row();
   if ($getss): ?>
  <?php redirect(base_url().'smart/index/'.$gets->id_pertanyaan); ?>



<?php
// menampilkan pertanyaan yang berstatus mulai = Y
// pada semester 2
foreach ($mulai_Y_2 as $key):
// Perulangan data pertanyaan yang ada pada tabel
 ?>

 <!--Sengaja diberika Batas pertanyaan pertama --------------------------->
 <!--Sengaja diberika Batas pertanyaan pertama --------------------------->

        <div class="panel panel-default">
          <div class="panel-body">
            <h1 class="lead">
               <?php echo $key->nama_pertanyaan ?>
              </h1>
          </div>
          <div class="panel-footer">
            <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
            </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NOs <b  class="glyphicon glyphicon-remove"></b> </a></p>
          </div>
        </div>
    <?php endforeach; ?>
  <?php endif; ?>
    <!--Sengaja diberika Batas pertanyaan pertama --------------------------->
    <!--Sengaja diberika Batas  pertanyaan pertama--------------------------->

<!--untuk Paket matakuliah semester-->

<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 1--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 1--------------------------->

<?php elseif ($respon=='PKT1'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah Semester 1</h1>


<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 1--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 1--------------------------->


<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2--------------------------->
<?php elseif ($respon=='PKT2'): ?>
<?php
$mhs = $this->session->userdata('id_mahasiswa');
$dat1 = date('Y');
$dat2 = date('Y')-1;
  $RB3 = $this->db->query('select sum(mk.sks) as sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->row();

$RB3insert = $this->db->query('select mt.id_mk_tawaran  from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
//if ($RB3->sks<=12) {}






if ($view_ipk >=3.00 ){

if ($RB3->sks<=24) {
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
  $this->session->set_flashdata('message',
           '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 24 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.

            </div>');
            redirect(site_url('smart/index/RB3'));

}


} elseif($view_ipk >=2.50 AND $view_ipk <=2.99){

if ($RB3->sks<=21) {
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

  $this->session->set_flashdata('message',
           '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 21 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.

            </div>');
            redirect(site_url('smart/index/RB3'));

}


}elseif($view_ipk >=2.00 AND $view_ipk <=2.49)
{

if ($RB3->sks<=18) {
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

  $this->session->set_flashdata('message',
           '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 18 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.

            </div>');
            redirect(site_url('smart/index/RB3'));
}


}elseif($view_ipk >=1.50 AND $view_ipk <=1.99)

{

if ($RB3->sks<=15) {
# code...

//---------------------------------------

if ($mhs_get->jenis_kelas =='Pagi') { // Kelas Pagi
# code...

if ($total_A->total_A < $kelas_A->kapasitas ) {
# code...
foreach ($RB3insert as $value) {
  # code...

$result_replace = array(
"id_mahasiswa"   =>  $mhs,
"waktu_entry"    => date('d-m-Y'),
"semester_aktif" => 2,
"validasi"       => 'BELUM',
"id_mk_tawaran"  => $value->id_mk_tawaran,
"id_kelas"       => $kelas_A->id_kelas,
"semester_tahun_akademik" => 'Genap',
"tahun_akademik" => $dat2.'/'.$dat1,
);
$this->db->insert('entry_temporary', $result_replace);
} // endforeach

$this->session->set_flashdata('message',
           '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Paket Matakuliah Semester 2 </strong> Berhasil Tersimpan.

            </div>');

              redirect(site_url('smart/index/P6'));


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
  $this->session->set_flashdata('message',
           '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 15 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.

            </div>');

              redirect(site_url('smart/index/RB3'));
}


} elseif($view_ipk <=1.99){

if ($RB3->sks<=12) {
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

$this->session->set_flashdata('message',
           '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Maaf Anda diberi Batas Maksimal 12 SKS </strong>
   <br> Anda tidak Di Berikan Keseluruhan Paket Matakuliah  Dikarenakan Total SKS Paket Matakuliah Melebihi Batas Maksimal SKS Anda <br> Anda Harus Memilih Matakuliah dibawah ini yang Hendak Di Program !.

            </div>');


            redirect(site_url('smart/index/RB3'));


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









?>
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 2--------------------------->


<?php elseif ($respon=='P6') : ?>
    <?php foreach ($mulai_Y_2_respon as $keys): ?>

    <h1 class="lead">
<?php echo $keys->nama_pertanyaan ?>
     </h1>
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





  <div class="panel-footer">
    <p class="bgbottom">
   <a href="<?php echo base_url()?>smart/simpanP6_H2"
     class="btn btn-primary btn-lg" role="button"  onclick="javasciprt: return confirm('Anda Yakin Untuk Cetak KRS dengan Daftar Matakuliah ini ?')">
     YES <b  class="glyphicon glyphicon-ok"></b>
   </a>   <a href="<?php echo base_url()?>smart/hapus_entry"
        class="btn btn-warning btn-lg" role="button"  onclick="javasciprt: return confirm('Anda Yakin Untuk Kembali ? Daftar Matakuliah Dibawah ini Akan di Hapus !')">
        NO <b  class="glyphicon glyphicon-remove"></b>
       </a>
   </p>
  </div>

<?php endforeach ?>

<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 3--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 3--------------------------->
<?php elseif ($respon=='PKT3'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah Semester 3</h1>
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 3--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 3--------------------------->


<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 4--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 4--------------------------->
<?php elseif ($respon=='PKT4'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah Semester 4</h1>
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 4--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 4--------------------------->

<?php elseif ($respon=='H2'): ?>

  <?php foreach ($mulai_Y_2_respon as $keys): ?>


  <h1 class="lead">
<?php echo $keys->nama_pertanyaan ?>
   </h1>
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


<?php endforeach ?>





<?php elseif ($respon=='H3'): ?>
  <h1>HASIL CETAK H3</h1>

<?php elseif ($respon=='H4'): ?>
  <h1>HASIL CETAK H4</h1>



<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 5--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 5--------------------------->

<?php elseif ($respon=='PKT5'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah Semester 5</h1>

<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 5--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 5--------------------------->




<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 6--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 6--------------------------->
<?php elseif ($respon=='PKT6'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah Semester 6</h1>
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 6--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 6--------------------------->


<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER   7-------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER   7-------------------------->
<?php elseif ($respon=='PKT7'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah Semester 7</h1>

<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER   7-------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER  7--------------------------->




<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 8--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 8--------------------------->
<?php elseif ($respon=='PKT8'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah Semester 8</h1>

<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 8--------------------------->
<!--Sengaja diberika Batas PAKET MATAKULIAH SEMESTER 8--------------------------->
<!--Batas untuk Paket matakuliah semester-->

<!--..............................................................................................-->

<!--untuk Running Background (RB)matakuliah semester-->




<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)--------------------------->
<?php elseif ($respon=='RB1'): ?>
  <div class="panel panel-default">
 <?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
  ?>
  <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
  $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
  $view_ipk = number_format($ipk,2)   ;
   ?>

   <?php if ($view_ipk >=3.00 ): ?>

 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>

 <div class="panel-body">
   <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?
       </h1>
     </div>
       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
        </p>
       </div>

     <?php endforeach; ?>

    <?php else: ?>

                <?php foreach ($mulai_Y_2_respon as $key): ?>
                  <div class="panel-body">

                <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
                    <span class="btn btn-primary btn-md">
                        <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             </h1>
             </div>


             <div class="panel-footer">
             <p class="bgbottom">
             <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-primary btn-lg" role="button">
             NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
             </a>
             </a>
             </p>
             </div>

              <?php endforeach; ?>
                <?php endif; ?>


   <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>

           <div class="panel-body">
             <h1 class="lead">
                   Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
                     <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
                    <br>
                   <?php echo $key->nama_pertanyaan ?>
                   <br>
                   Apakah Anda Ingin Kontrak Semester Atas ?
                 </h1>
               </div>

       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
      </p>
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
       <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
       class="btn btn-primary btn-lg" role="button">
       NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
       </a>
       </a>
       </p>
       </div>
        <?php endforeach; ?>
          <?php endif; ?>

   <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>

         <div class="panel panel-body">

       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?
       </h1>

     </div>
       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
  </p>
       </div>

     <?php endforeach; ?>

   <?php else: ?>



     <?php foreach ($mulai_Y_2_respon as $key): ?>
       <div class="panel-body">

     <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
  </h1>
  </div>


  <div class="panel-footer">
  <p class="bgbottom">
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>
   <?php endforeach; ?>
     <?php endif; ?>



   <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>

         <div class="panel-body">

       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?
       </h1>
</div>

       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
    </p>
       </div>

     <?php endforeach; ?>

   <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>
       <div class="panel-body">

     <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
 </h1>
 </div>


 <div class="panel-footer">
 <p class="bgbottom">
 <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
 class="btn btn-primary btn-lg" role="button">
 NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
 </a>
 </a>
 </p>
 </div>
   <?php endforeach; ?>
     <?php endif; ?>





   <?php elseif($view_ipk <=1.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>
         <div class="panel-body">
       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?

       </h1>
   </div>

       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
      </p>
       </div>
     <?php endforeach; ?>

   <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>


        <?php
             $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
               ?>
               <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
               $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
               $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
               $view_ipk = number_format($ipk,2)   ;
                ?>

                <?php if ($view_ipk >=3.00 ): ?>

  <div class="panel-body">
<h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah

                   <span class="btn btn-primary btn-md">
  </h1>

          <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
                   </span>
 </div>
                <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                  <div class="panel-body">
    <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
                 <span class="btn btn-primary btn-md">
                        <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
</h1></div>
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
                        <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
</h1>
</div>
                  <?php else: ?>

                Maff, untuk sementara Belum ada IPK
                <?php endif; ?>

     <div class="panel-footer">
       <p class="bgbottom">
      <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
        class="btn btn-primary btn-lg" role="button">
        NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
      </a>
          </a>
    </p>
     </div>

   <?php endforeach; ?>

     <?php endif; ?>
     <?php else: ?>

   Maff, untuk sementara Belum ada IPK
   <?php endif; ?>

</div>
   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND 1 (RB1)--------------------------->










<!---::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::->
<!-::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->






   <!--Sengaja diberika Batas RUNING BACKGROUND 2 (RB2)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND 2 (RB2)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND 2 (RB2)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND 2 (RB2)--------------------------->


<?php elseif ($respon=='RB2'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah RB2</h1>



<!--Sengaja diberika Batas RUNING BACKGROUND 2 (RB2)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 2 (RB2)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 2 (RB2)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 2 (RB2)--------------------------->











<!--Batas RB3-->
<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->


<?php elseif ($respon=='RB3'): ?>

<input type="hidden" name="RB3_uri" value="<?php echo current_url() ?>">

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
     $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )')->result();
     $mhs = $this->session->userdata('id_mahasiswa');
$s=array();
 $get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
 foreach ($get_et->result() as  $value) {
   # code...
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

//--------------------------------------------------

//---------------------------------------------------
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


<a href="<?php echo base_url().'Smart/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
<?php else: ?>
  <a href="<?php echo base_url().'Smart/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
  <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
  $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
  $view_ipk = number_format($ipk,2)   ;
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
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT  <b  class="glyphicon glyphicon-fast-forward"></b></a>
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
     class="btn btn-warning btn-lg" role="button" onclick="javasciprt: return confirm('Apakah Anda Yakin Kembali ?. Pastikan Bahwa Matakuliah Semester 2,4,6,8 Dihapus Terlebih dahulu, Dikarenakan Proses Anda akan dilakukan Pada Tahapan Awal. Terimakasih !')">
    NO <b  class="glyphicon glyphicon-remove"></b></a>
</div>
<?php endforeach; ?>

<!--Batas RB3-->
<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 3 (RB3)--------------------------->










<!--Sengaja diberika Batas RUNING BACKGROUND 4 (RB4)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 4 (RB4)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 4 (RB4)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 4 (RB4)--------------------------->

<?php elseif ($respon=='RB4'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah RB4</h1>
<!--Sengaja diberika Batas RUNING BACKGROUND 4 (RB4)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 4 (RB4)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 4 (RB4)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 4 (RB4)--------------------------->






<!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->

<?php elseif ($respon=='RB5'):   ?>
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
     $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=14 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 ) )')->result();
     $mhs = $this->session->userdata('id_mahasiswa');
$s=array();
 $get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
 foreach ($get_et->result() as  $value) {
   # code...
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

//--------------------------------------------------

//---------------------------------------------------
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


<a href="<?php echo base_url().'Smart/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
<?php else: ?>
  <a href="<?php echo base_url().'Smart/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
  <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
  $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
  $view_ipk = number_format($ipk,2)   ;
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
<p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo 'RBS4'; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
</a>
<a href="<?php echo base_url()?>smart/index/<?php echo 'RB3'; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 2
</a> </p>
</div>
  </div>




<?php endforeach; ?>



<!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 5 (RB5)--------------------------->






<!--Sengaja diberika Batas RUNING BACKGROUND 6 (RB6)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 6 (RB6)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 6 (RB6)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 6 (RB6)--------------------------->

<?php elseif ($respon=='RB6'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah RB6</h1>

<!--Sengaja diberika Batas RUNING BACKGROUND 6 (RB6)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 6 (RB6)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 6 (RB6)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 6 (RB6)--------------------------->






<!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)--------------------------->

<?php elseif ($respon=='RB7'): ?>
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
   $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=16 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 ) )')->result();
   $mhs = $this->session->userdata('id_mahasiswa');
$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
foreach ($get_et->result() as  $value) {
 # code...
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

//--------------------------------------------------

//---------------------------------------------------
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


<a href="<?php echo base_url().'Smart/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
<?php else: ?>
<a href="<?php echo base_url().'Smart/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2)   ;
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
<p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
</a>
<a href="<?php echo base_url()?>smart/index/<?php echo 'RB5'; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 4
</a>
</p>
</div>



<?php endforeach; ?>
<!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 7 (RB7)--------------------------->



<!--Sengaja diberika Batas RUNING BACKGROUND 8 (RB8)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 8 (RB8)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 8 (RB8)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 8 (RB8)--------------------------->

<?php elseif ($respon=='RB8'): ?>
<h1 class="lead">Ini adalah Halaman Untuk Paket Matakuliah RB8</h1>
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
   $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=14 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 ) )')->result();
   $mhs = $this->session->userdata('id_mahasiswa');
$s=array();
$get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
foreach ($get_et->result() as  $value) {
 # code...
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

//--------------------------------------------------

//---------------------------------------------------
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


<a href="<?php echo base_url().'Smart/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
<?php else: ?>
<a href="<?php echo base_url().'Smart/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
<?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
$maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
$ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
$view_ipk = number_format($ipk,2)   ;
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


<?php if (
(24-$sum_sks_rb1->totalsksRB1)<1 ||
(21-$sum_sks_rb1->totalsksRB1)<1 ||
(18-$sum_sks_rb1->totalsksRB1)<1 ||
(15-$sum_sks_rb1->totalsksRB1)<1 ||
(12-$sum_sks_rb1->totalsksRB1)<1
): ?>
<h1 class="lead">Anda Masih Memiliki Kelebihan SKS, Apakah anda Ingin Melihat Matakuliah Pada Semester 6 ?</h1>
<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo 'RBS6'; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
</a>

<a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b>
</a>
</p>
</div>
<?php else: ?>


<div class="panel-footer">
<p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
</a> </p>
</div>
<?php endif; ?>



<?php endforeach; ?>
<!--Sengaja diberika Batas RUNING BACKGROUND 8 (RB8)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 8 (RB8)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 8 (RB8)--------------------------->
<!--Sengaja diberika Batas RUNING BACKGROUND 8 (RB8)--------------------------->

<!--Batas untuk Running Background (RB)matakuliah semester-->






<?php elseif ($respon=='RBS8'): ?>
  <div class="panel panel-default">
 <?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
  ?>
  <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
  $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
  $view_ipk = number_format($ipk,2)   ;
   ?>

   <?php if ($view_ipk >=3.00 ): ?>

 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>

 <div class="panel-body">
   <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>

       </h1>
     </div>
       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
        </p>
       </div>

     <?php endforeach; ?>

    <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>

       <div class="panel-body">

     <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
  </h1>
  </div>


  <div class="panel-footer">
  <p class="bgbottom">
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>


    <?php endforeach; ?>
     <?php endif; ?>



   <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>
         <div class="panel-body">

       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>

       </h1>
</div>
       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
      </p>
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
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>

   <?php endforeach; ?>

     <?php endif; ?>
   <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>

         <div class="panel-body">

       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>

       </h1>

     </div>
       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
  </p>
       </div>

     <?php endforeach; ?>

   <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>

       <div class="panel-body">

     <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
  </h1>
  </div>


  <div class="panel-footer">
  <p class="bgbottom">
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>

   <?php endforeach; ?>

     <?php endif; ?>
   <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>

         <div class="panel-body">

       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>

       </h1>
</div>

       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
    </p>
       </div>

     <?php endforeach; ?>

   <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>
       <div class="panel-body">

     <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
  </h1>
  </div>


  <div class="panel-footer">
  <p class="bgbottom">
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>
   <?php endforeach; ?>
     <?php endif; ?>





   <?php elseif($view_ipk <=1.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>
         <div class="panel-body">
       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>


       </h1>
   </div>

       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
      </p>
       </div>

     <?php endforeach; ?>

   <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>

       <div class="panel-body">

      <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
      </h1>
      </div>


      <div class="panel-footer">
      <p class="bgbottom">
      <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
      class="btn btn-primary btn-lg" role="button">
      NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
      </a>
      </a>
      </p>
      </div>

   <?php endforeach; ?>

     <?php endif; ?>
     <?php else: ?>

   Maff, untuk sementara Belum ada IPK
   <?php endif; ?>

</div>



<?php elseif ($respon=='RB9'): ?>

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
     $RB3 = $this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=18 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat not in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 ) )')->result();
     $mhs = $this->session->userdata('id_mahasiswa');
  $s=array();
  $get_et = $this->db->query('select * from entry_temporary where id_mahasiswa='.$mhs);
  foreach ($get_et->result() as  $value) {
   # code...
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

  //--------------------------------------------------

  //---------------------------------------------------
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


  <a href="<?php echo base_url().'Smart/hapus_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-danger">Hapus <b  class="glyphicon glyphicon-remove"></b></a>
  <?php else: ?>
  <a href="<?php echo base_url().'Smart/simpan_ke_entry_temp/'.$mk_tawaran->id_mk_tawaran.'/'.$this->uri->segment(3) ?>" class="btn btn-md btn-primary">Program <b  class="glyphicon glyphicon-ok"></b></a>
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
  <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
  $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
  $view_ipk = number_format($ipk,2)   ;
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
  <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button"> <b  class="glyphicon glyphicon-fast-backward"></b> BACK TO SEMESTER 6
  </a>
  </p>
  </div>



  <?php endforeach; ?>



<?php elseif ($respon=='RBS4'): ?>
  <div class="panel panel-default">
 <?php
$sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
  ?>
  <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
  $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
  $view_ipk = number_format($ipk,2)   ;
   ?>

   <?php if ($view_ipk >=3.00 ): ?>

 <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
<?php foreach ($mulai_Y_2_respon as $key): ?>

 <div class="panel-body">
   <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?
       </h1>
     </div>
       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
        </p>
       </div>

     <?php endforeach; ?>

    <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>

       <div class="panel-body">

     <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
  </h1>
  </div>


  <div class="panel-footer">
  <p class="bgbottom">
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>


    <?php endforeach; ?>
     <?php endif; ?>



   <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>
         <div class="panel-body">

       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?
       </h1>
</div>
       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
      </p>
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
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>

   <?php endforeach; ?>

     <?php endif; ?>
   <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>

         <div class="panel-body">

       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?
       </h1>

     </div>
       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
  </p>
       </div>

     <?php endforeach; ?>

   <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>

       <div class="panel-body">

     <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
  </h1>
  </div>


  <div class="panel-footer">
  <p class="bgbottom">
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>

   <?php endforeach; ?>

     <?php endif; ?>
   <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>

         <div class="panel-body">

       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?
       </h1>
</div>

       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
    </p>
       </div>

     <?php endforeach; ?>

   <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>
       <div class="panel-body">

     <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
  </h1>
  </div>


  <div class="panel-footer">
  <p class="bgbottom">
  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
  class="btn btn-primary btn-lg" role="button">
  NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
  </a>
  </a>
  </p>
  </div>
   <?php endforeach; ?>
     <?php endif; ?>





   <?php elseif($view_ipk <=1.99): ?>
     <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
       <?php foreach ($mulai_Y_2_respon as $key): ?>
         <div class="panel-body">
       <h1 class="lead">
         Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
           <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
          <br>
         <?php echo $key->nama_pertanyaan ?>
         <br>
         Apakah Anda Ingin Kontrak Semester Atas ?

       </h1>
   </div>

       <div class="panel-footer">
         <p class="bgbottom">
        <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
          class="btn btn-primary btn-lg" role="button">
          YES <b  class="glyphicon glyphicon-ok"></b>
        </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
             class="btn btn-warning btn-lg" role="button">
             NO <b  class="glyphicon glyphicon-remove"></b>
            </a>
      </p>
       </div>

     <?php endforeach; ?>

   <?php else: ?>
     <?php foreach ($mulai_Y_2_respon as $key): ?>

       <div class="panel-body">

      <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
         <span class="btn btn-primary btn-md">
             <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
      </h1>
      </div>


      <div class="panel-footer">
      <p class="bgbottom">
      <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
      class="btn btn-primary btn-lg" role="button">
      NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
      </a>
      </a>
      </p>
      </div>

   <?php endforeach; ?>

     <?php endif; ?>
     <?php else: ?>

   Maff, untuk sementara Belum ada IPK
   <?php endif; ?>

</div>


   <!--Sengaja diberika Batas RUNING BACKGROUND SEMESTER 2 (RB1)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND SEMESTER 2 (RB1)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND SEMESTER 2 (RB1)--------------------------->
   <!--Sengaja diberika Batas RUNING BACKGROUND SEMESTER 2 (RB1)--------------------------->






 <?php elseif ($respon=='RBS6'): ?>
     <div class="panel panel-default">
    <?php
   $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
     ?>
     <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
     $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
     $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
     $view_ipk = number_format($ipk,2)   ;
      ?>

      <?php if ($view_ipk >=3.00 ): ?>

    <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
   <?php foreach ($mulai_Y_2_respon as $key): ?>

    <div class="panel-body">
      <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?
          </h1>
        </div>
          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
           </p>
          </div>

        <?php endforeach; ?>

       <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>

          <div class="panel-body">

        <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah
            <span class="btn btn-primary btn-md">
                <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
     </h1>
     </div>


     <div class="panel-footer">
     <p class="bgbottom">
     <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
     class="btn btn-primary btn-lg" role="button">
     NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
     </a>
     </a>
     </p>
     </div>


       <?php endforeach; ?>
        <?php endif; ?>



      <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
        <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
          <?php foreach ($mulai_Y_2_respon as $key): ?>
            <div class="panel-body">

          <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?
          </h1>
   </div>
          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
         </p>
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
     <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
     class="btn btn-primary btn-lg" role="button">
     NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
     </a>
     </a>
     </p>
     </div>

      <?php endforeach; ?>

        <?php endif; ?>
      <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
        <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
          <?php foreach ($mulai_Y_2_respon as $key): ?>

            <div class="panel-body">

          <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?
          </h1>

        </div>
          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
     </p>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>

          <div class="panel-body">

        <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
            <span class="btn btn-primary btn-md">
                <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
     </h1>
     </div>


     <div class="panel-footer">
     <p class="bgbottom">
     <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
     class="btn btn-primary btn-lg" role="button">
     NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
     </a>
     </a>
     </p>
     </div>

      <?php endforeach; ?>

        <?php endif; ?>
      <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
        <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
          <?php foreach ($mulai_Y_2_respon as $key): ?>

            <div class="panel-body">

          <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?
          </h1>
   </div>

          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
       </p>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>
          <div class="panel-body">

        <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
            <span class="btn btn-primary btn-md">
                <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
     </h1>
     </div>


     <div class="panel-footer">
     <p class="bgbottom">
     <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
     class="btn btn-primary btn-lg" role="button">
     NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
     </a>
     </a>
     </p>
     </div>
      <?php endforeach; ?>
        <?php endif; ?>





      <?php elseif($view_ipk <=1.99): ?>
        <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
          <?php foreach ($mulai_Y_2_respon as $key): ?>
            <div class="panel-body">
          <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?

          </h1>
      </div>

          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
         </p>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>

          <div class="panel-body">

         <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
            <span class="btn btn-primary btn-md">
                <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
         </h1>
         </div>


         <div class="panel-footer">
         <p class="bgbottom">
         <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
         class="btn btn-primary btn-lg" role="button">
         NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
         </a>
         </a>
         </p>
         </div>

      <?php endforeach; ?>

        <?php endif; ?>
        <?php else: ?>

      Maff, untuk sementara Belum ada IPK
      <?php endif; ?>

   </div>

<!--OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO-->



 <?php elseif ($respon=='RBS8'): ?>
     <div class="panel panel-default">
    <?php
   $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
     ?>
     <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
     $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
     $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
     $view_ipk = number_format($ipk,2)   ;
      ?>

      <?php if ($view_ipk >=3.00 ): ?>

    <?php if ($sum_sks_rb1->totalsksRB1 < 24 ): ?>
   <?php foreach ($mulai_Y_2_respon as $key): ?>

    <div class="panel panel-body">
      <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?
          </h1>
        </div>
          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
           </p>
          </div>

        <?php endforeach; ?>

       <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>

          <div class="panel panel-body">

        <h1 class="lead">
         Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah <span class="btn btn-primary btn-md">
           <strong>24 SKS</strong> </span>
        </h1>
   </div>

        <div class="panel-footer">
          <p class="bgbottom">
         <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
           class="btn btn-primary btn-lg" role="button">
           YES <b  class="glyphicon glyphicon-ok"></b>
         </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
              class="btn btn-warning btn-lg" role="button">
              NO <b  class="glyphicon glyphicon-remove"></b>
             </a>
       </p>
        </div>
       <?php endforeach; ?>
        <?php endif; ?>



      <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
        <?php if ($sum_sks_rb1->totalsksRB1 < 21 ): ?>
          <?php foreach ($mulai_Y_2_respon as $key): ?>
            <div class="panel-body">

          <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?
          </h1>
   </div>
          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
         </p>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>
          <div class="panel-body">

        <h1 class="lead">
         Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah <span class="badge badge-primary badge-md">
           <strong>21 SKS</strong> </span>
   Dan SKS yang Sudah terpakai adalah
    <span class="badge badge-primary badge-md">
       <strong><?php echo ($sum_sks_rb1->totalsksRB1); ?> SKS</strong>
     </span>
   Jadi SKS yang tersisa Adalah
         <span class="badge badge-primary badge-md">    <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>

        </h1>
   <h1 class="lead">
     Apakah Anda Ingin Melanjutkan Proses Atau Kembali dan Mengubah Matakuliah yang telah anda Kontrak Pada Matakuliah Semester 2 ?

   </h1>

      </div>
        <div class="panel-footer">
          <p class="bgbottom">
         <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
           class="btn btn-primary btn-lg" role="button">
           YES <b  class="glyphicon glyphicon-ok"></b>
         </a>   <a href="<?php echo base_url()?>smart/index/<?php echo 'RB1'; ?>"
              class="btn btn-warning btn-lg" role="button">
              NO <b  class="glyphicon glyphicon-remove"></b>
             </a>
       </p>
        </div>

      <?php endforeach; ?>

        <?php endif; ?>
      <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
        <?php if ($sum_sks_rb1->totalsksRB1 < 18 ): ?>
          <?php foreach ($mulai_Y_2_respon as $key): ?>

            <div class="panel-body">

          <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?
          </h1>

        </div>
          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
     </p>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>

          <div class="panel panel-body">

        <h1 class="lead">
         Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah <span class="btn btn-primary btn-md">
           <strong>18 SKS</strong> </span>
        </h1>

   </div>
        <div class="panel-footer">
          <p class="bgbottom">
         <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
           class="btn btn-primary btn-lg" role="button">
           YES <b  class="glyphicon glyphicon-ok"></b>
         </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
              class="btn btn-warning btn-lg" role="button">
              NO <b  class="glyphicon glyphicon-remove"></b>
             </a>
       </p>
        </div>

      <?php endforeach; ?>

        <?php endif; ?>
      <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
        <?php if ($sum_sks_rb1->totalsksRB1 < 15 ): ?>
          <?php foreach ($mulai_Y_2_respon as $key): ?>

            <div class="panel-body">

          <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?
          </h1>
   </div>

          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
       </p>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>
          <div class="panel panel-body">


        <h1 class="lead">
         Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah <span class="btn btn-primary btn-md">
           <strong>15 SKS</strong> </span>
        </h1>
   </div>
        <div class="panel-footer">
          <p class="bgbottom">
         <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
           class="btn btn-primary btn-lg" role="button">
           YES <b  class="glyphicon glyphicon-ok"></b>
         </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
              class="btn btn-warning btn-lg" role="button">
              NO <b  class="glyphicon glyphicon-remove"></b>
             </a>
     </p>
        </div>
      <?php endforeach; ?>
        <?php endif; ?>





      <?php elseif($view_ipk <=1.99): ?>
        <?php if ($sum_sks_rb1->totalsksRB1 < 12 ): ?>
          <?php foreach ($mulai_Y_2_respon as $key): ?>
            <div class="panel-body">
          <h1 class="lead">
            Anda Masih Memiliki Kelebihan <span class="btn btn-primary btn-md">
              <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
             <br>
            <?php echo $key->nama_pertanyaan ?>
            <br>
            Apakah Anda Ingin Kontrak Semester Atas ?

          </h1>
      </div>

          <div class="panel-footer">
            <p class="bgbottom">
           <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>"
             class="btn btn-primary btn-lg" role="button">
             YES <b  class="glyphicon glyphicon-ok"></b>
           </a>   <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
                class="btn btn-warning btn-lg" role="button">
                NO <b  class="glyphicon glyphicon-remove"></b>
               </a>
         </p>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <?php foreach ($mulai_Y_2_respon as $key): ?>


     <?php
      $sum_sks_rb1 = $this->db->query('select sum(mk.sks) as totalsksRB1 from entry_temporary et join mk_tawaran mt on et.id_mk_tawaran=mt.id_mk_tawaran join matakuliah mk on mk.id_mk=mt.id_mk ')->row();
                  ?>
      <?php $bobot_dan_sks = $this->db->query('SELECT sum(bobot * sks) as total from nilai')->row();
      $maks_sks      = $this->db->query('SELECT sum(sks) as sks_maks from nilai')->row();
      $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
      $view_ipk = number_format($ipk,2)   ;
             ?>
       <div class="panel-body">
         <?php if ($view_ipk >=3.00 ): ?>
       <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 24 <br> dan Sisa dari sks yang terpakai adalah

                      <span class="btn btn-primary btn-md">
     </h1>                 <strong><?php echo (24-$sum_sks_rb1->totalsksRB1); ?> SKS</strong>
                      </span>

                   <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                 <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 21 <br> dan Sisa dari sks yang terpakai adalah
                    <span class="btn btn-primary btn-md">
                           <strong><?php echo (21-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
   </h1>
                   <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>

                   <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 18 <br> dan Sisa dari sks yang terpakai adalah
                      <span class="btn btn-primary btn-md">
                           <strong><?php echo (18-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
   </h1>


                   <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                   <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 15 <br> dan Sisa dari sks yang terpakai adalah
                       <span class="btn btn-primary btn-md">
                           <strong><?php echo (15-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
   </h1>
                   <?php elseif($view_ipk <=1.99): ?>
                   <h1 class="lead"> Anda Tidak Memiliki Kelebihan SKS, Maksimal SKS Anda Adalah 12 <br> dan Sisa dari sks yang terpakai adalah
                       <span class="btn btn-primary btn-md">
                           <strong><?php echo (12-$sum_sks_rb1->totalsksRB1); ?> SKS</strong> </span>
   </h1>
                     <?php else: ?>

                   Maff, untuk sementara Belum ada IPK
                   <?php endif; ?>
   </div>

        <div class="panel-footer">
          <p class="bgbottom">
         <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>"
           class="btn btn-primary btn-lg" role="button">
           NEXT <b  class="glyphicon glyphicon-fast-forward"></b>
         </a>
             </a>
       </p>
        </div>

      <?php endforeach; ?>

        <?php endif; ?>
        <?php else: ?>

      Maff, untuk sementara Belum ada IPK
      <?php endif; ?>

   </div>


<!--OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO-->








<!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->
<?php else: ?>
  <!--else ini adalah kondisi yang akan di penuhi ketika respon kode pertanyaan (P1-P6) tidak ditemukan-->




  <?php foreach ($mulai_Y_2_respon as $key): ?>
    <div class="panel panel-default">
      <div class="panel-body">
        <h1 class="lead">   <?php echo $key->nama_pertanyaan ?> </h1>
      </div>
      <div class="panel-footer">
        <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
        </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a> </p>
  </div>
  </div>
<?php endforeach; ?>
<?php endif; ?>










<!--Sengaja diberikan Batas untuk semester 4 (RB4)--------------------------->
<!--Sengaja diberikan Batas untuk semester 4 (RB4)--------------------------->
<!--Sengaja diberikan Batas untuk semester 4 (RB4)--------------------------->
<!--Sengaja diberikan Batas untuk semester 4 (RB4)--------------------------->
    <?php } elseif($dataget->total==4 or $dataget->total ==3) { // Untuk semester 4 ?>
      <?php foreach ($mulai_Y_4 as $key): ?>
        <div class="panel-body">
          <h1 class="lead">   Semester 4  </h1>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
          </div>
          <div class="panel-footer">
            <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
            </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
          </div>
        </div>
    <?php endforeach; ?>

    <!--Sengaja diberikan Batas untuk semester 4 (RB4)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 4 (RB4)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 4 (RB4)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 4 (RB4)--------------------------->






    <!--Sengaja diberikan Batas untuk semester 6 (RB6)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 6 (RB6)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 6 (RB6)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 6 (RB6)--------------------------->
<?php } elseif( $dataget->total==6 or $dataget->total ==5) { // Untuk semester 5 ?>

      <?php foreach ($mulai_Y_6 as $key): ?>

        <div class="panel-body">
          <h1 class="lead">   Semester 6   </h1>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
          </div>
          <div class="panel-footer">
            <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
            </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
          </div>
        </div>
    <?php endforeach; ?>
    <!--Sengaja diberikan Batas untuk semester 6 (RB6)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 6 (RB6)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 6 (RB6)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 6 (RB6)--------------------------->






    <!--Sengaja diberikan Batas untuk semester 8 (RB8)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 8 (RB8)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 8 (RB8)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 8 (RB8)--------------------------->
    <?php } elseif($dataget->total==8 or $dataget->total>=8  or $dataget->total ==7) { // Untuk semester 8 ?>

      <?php foreach ($mulai_Y_8 as $key): ?>

        <div class="panel-body">
          <h1 class="lead">   Semester 8   </h1>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <h1 class="lead">   <?php echo $key->nama_pertanyaan ?>    </h1>
          </div>
          <div class="panel-footer">
            <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
            </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-warning btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
          </div>
        </div>
    <?php endforeach; ?>


    <!--Sengaja diberikan Batas untuk semester 8 (RB8)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 8 (RB8)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 8 (RB8)--------------------------->
    <!--Sengaja diberikan Batas untuk semester 8 (RB8)--------------------------->

    <?php }



     else{ // untuk semester Ganjil  ?>
  <?php echo 'no dataa' ?>
      <?php } ?>

<?php endif; ?>
  <?php } ?>
