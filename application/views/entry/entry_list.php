
<div class="col-md-4">
      <table class="table table-bordered table-striped">
        <tr>
            <td>Nama</td>
            <td><?php echo $nama_mahasiswa ?></td>
            
        </tr>
        <tr>
            <td>Nim</td>
            <td><?php echo $nim ?></td>
  
        </tr>
    </table>
</div>


<div class="col-md-4">
      <table class="table table-bordered table-striped">
 
        <tr>
            <td>IPS</td>
            <td>
                <a href="#" class="label label-default">
                <?php $sks_sebelum = $ips->total_mutu / $ips_sks->total_sks ; 
                        echo number_format($sks_sebelum,2 ); ?>
                  
                </a>
            </td>
          </tr>
        <tr>

        <!--batas perhitungan untuk maksimal sks-->
            <td>SKS MAX</td>
            <td>
                  <?php 
if ($sks_sebelum >=3.00 && 4.00 <=4.00) {
  ?>
<a href="#" class="label label-default">24</a>
  <?php
}elseif($sks_sebelum >=2.50 && 2.99<=2.99)
{
?>
<a href="#" class="label label-default">21</a>
<?php
}elseif($sks_sebelum >=2.00 && 2.49<=2.49)
{
?>
<a href="#" class="label label-default">18</a>
<?php }
elseif($sks_sebelum >=1.50 && 1.99<=1.99)
{
?>
<a href="#" class="label label-default">15</a>
<?php } 
else
{
?>
<a href="#" class="label label-default">12</a>
<?php }   ?>
            </td>
     
        <!--batas perhitungan untuk maksimal sks-->
        </tr>
    </table>
</div>


        <div class="row" style="margin-bottom: 10px">
<div class="col-md-4">
      <table class="table table-bordered table-striped">
  
        <tr>
            <td width=200 bgcolor=blue align=center>Fakultas</td>
            <td width=200 >TEKNIK</td>
            
        </tr>
        <tr>
            <td align=center>Jurusan</td>
            <td>INFORMATIKA</td>
     
        </tr>
    </table>
</div>






<div class="container"> 
 <div id="demo" class="collapse">

   <h1><small> Daftar Nilai Semester Sebelumnya</small></h1>
   <div class="panel panel-default">
      <div class="panel-heading">
<button type="button" class="btn btn-danger"
 data-toggle="collapse" data-target="#demo">
 <p class="glyphicon glyphicon-paperclip"></p>Tutup Tab</button>
 
     </div>
      <div class="panel-body">
<!--lihat semua nilai yang sudah di kontrak pada semester sebelumnya-->
<?php 
$sebelumnya = $this->Entry_model->nilai_sebelumnya($this->session->userdata('id_mahasiswa'));
 ?>
<!--lihat semua nilai yang sudah di kontrak pada semester sebelumnya-->

<table class="table table-striped table-bordered" id="mytable">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
        <th>Semester</th>
      <th>Matakuliah</th>
       <th>Huruf</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($sebelumnya->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
         <td><?php echo $keys->nama_semester ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>
     <td><?php echo $keys->huruf ?></td>

     
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
    </div>

  </div>
  </div>


    <div class="col-md-12 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
               



                </div>
            </div>




            <div class="col-md-6" >
                <h2 style="margin-top:0px">Daftar Matakuliah</h2>
        
 
<!--Batas untuk pengecekan semester ganjil atau genap-->
   <ul class="nav nav-tabs">

<?php 
$cek_semester_aktif = $this->db->query('SELECT max(semester_aktif) as aktif from entry
  where id_mahasiswa='.$id_mahasiswa)->row();    
// select aktif 
if ($semester_sekarang->sekarang == 'Genap') {
   ?>


<?php
if ($cek_semester_aktif->aktif == 2) {
  ?>

<li class="active"><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>
  <?php
}elseif($cek_semester_aktif->aktif == 4)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<?php } 
elseif($cek_semester_aktif->aktif == 6)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#6">6</a></li>

<!--for recomendate-->
<?php


if ($rek_sc->num_rows()>0) {
 ?>

<?php

if ($rek_jcm->num_rows() <1) {

  $data =$this->db->query('SELECT * from nilai join bidangminat_bersyarat bb on bb.id_mk = nilai.id_mk where nilai.id_mahasiswa='.$id_mahasiswa.' and bb.id_minat=3 and nilai.akhir < 56 ');

  ?>

<!--<li class=""><a class="label label-default" data-toggle="tab" href="#3">(6) JCM </a></li>
-->
<?php
if ($data->num_rows()>0) {
 ?>

<?php }else{ ?>
<li class=""><a class="label label-default" data-toggle="tab" href="#jcmrekom">  (6) JCM Rekomendasi</a></li>

<li class=""><a class="label label-info" data-toggle="tab" href="#bacaini"> Baca ini</a></li>
<?php }?>


  <?php
}
if($rek_ppk->num_rows() <1)
{

$data =$this->db->query('SELECT * from nilai join bidangminat_bersyarat bb on bb.id_mk = nilai.id_mk where nilai.id_mahasiswa='.$id_mahasiswa.' and bb.id_minat=2 and nilai.akhir < 56 ');

  ?>

<!--<li class=""><a class="label label-default" data-toggle="tab" href="#3">(6) JCM </a></li>
-->
<?php
if ($data->num_rows()>0) {
 ?>
<?php }else{ ?>
<li class=""><a class="label label-default" data-toggle="tab" href="#rekomppk"> (6) PPK Rekomendasi</a></li>

<li class=""><a class="label label-info" data-toggle="tab" href="#bacaini"> Baca ini </a></li>



<?php }?>





<?php
}
 ?>



 <?php
}else
{ ?>


 <li class=""><a class="label label-default" data-toggle="tab" href="#rekomsc">(6) SC Rekomendasi</a></li>
<li class=""><a class="label label-info" data-toggle="tab" href="#bacaini"> Baca ini </a></li>



  <?php } ?>


<!--for recomendate-->

<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<?php }elseif($cek_semester_aktif->aktif == 8)
{
?>


<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>




<!--for recomendate-->
<?php
if ($bm_sc_8->num_rows()>0) {
?>

<li class=""><a class="label label-primary" data-toggle="tab" href="#rekomsc_6">(6) Rekomendasi SC</a></li>

<?php
} 
elseif($bm_jcm_8->num_rows()>0) 
{
?>
<li class=""><a class="label label-primary" data-toggle="tab" href="#jcmrekom_6">(6) Rekomendasi JCM</a></li>


<?php 
}elseif($bm_ppk_8->num_rows()>0)
{
?>

<li class=""><a class="label label-primary" data-toggle="tab" href="#ppkrekom_6">(6) Rekomendasi PPK</a></li>


<?php

}else{
?>
<li class=""><a class="label label-primary" data-toggle="tab" href="#7">6 Noting</a></li>


<?php
} ?>

<!--for recomendate-->



<li class="active"><a class="label label-success" data-toggle="tab" href="#8">8</a></li>


<?php }else
{
?>


<li class="active"><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>





<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>


<?php } ?>




<?php
}
else{
 ?>





<?php
if ($cek_semester_aktif->aktif == 1) {
  ?>

<li class="active"><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>

  <?php
}elseif($cek_semester_aktif->aktif == 3)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<?php } 
elseif($cek_semester_aktif->aktif == 5)
{
?>


<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>

<?php }elseif($cek_semester_aktif->aktif == 7)
{
?>


<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#7">7</a></li>





<!--for recomendate-->
<?php
if ($bm_sc_7->num_rows()>0) {
?>

<li class=""><a class="label label-primary" data-toggle="tab" href="#rekomsc">(7) Rekomendasi SC</a></li>

<?php
} 
elseif($bm_jcm_7->num_rows()>0) 
{
?>
<li class=""><a class="label label-primary" data-toggle="tab" href="#jcmrekom7">(7) Rekomendasi JCM</a></li>


<?php 
}elseif($bm_ppk_7->num_rows()>0)
{
?>

<li class=""><a class="label label-primary" data-toggle="tab" href="#rekomppk7">(7) Rekomendasi PPK</a></li>


<?php

}else{
?>
<li class=""><a class="label label-primary" data-toggle="tab" href="#7">7 Noting</a></li>


<?php
} ?>

<!--for recomendate-->










<?php }else{ ?>


<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>



<?php
}

}
 ?>


</ul>
<!--Batas untuk pengecekan semester ganjil atau genap-->

<!--Batas untuk Semester genap-->
  <div class="tab-content">

   <?php 
  //   $data =$this->db->query('SELECT * from matakuliah natural join semester 
     //                      where semester.nama_semester =2'); 

if ($semester_sekarang->sekarang == 'Genap') {
   ?>





<?php
if ($cek_semester_aktif->aktif == 2) {
  ?>

      <div id="2" class="tab-pane fade in active">
      <h3>Semester 2</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_2->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="4" class="tab-pane fade">
      <h3>Semester 4</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_4->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="6" class="tab-pane fade">
      <h3>Semester 6</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_6->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>

        <div id="8" class="tab-pane fade">
      <h3>Semester 8</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_8->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>

  <?php
}elseif($cek_semester_aktif->aktif == 4)
{
?>


      <div id="2" class="tab-pane fade ">
      <h3>Semester 2</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_2->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="4" class="tab-pane fade in active">
      <h3>Semester 4</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_4->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="6" class="tab-pane fade">
      <h3>Semester 6</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_6->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>

        <div id="8" class="tab-pane fade ">
      <h3>Semester 8</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_8->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>
<?php } 
elseif($cek_semester_aktif->aktif == 6)
{
?>

      <div id="2" class="tab-pane fade ">
      <h3>Semester 2</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_2->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="4" class="tab-pane fade">
      <h3>Semester 4</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_4->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="6" class="tab-pane fade in active">
      <h3>Semester 6</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_6->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>









        <div id="8" class="tab-pane fade">
      <h3>Semester 8</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_8->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>










<!--batas rekomendasi untuk semster 7 jcm-->

<div id="jcmrekom" class="tab-pane fade">
      <h3>Anda di Rekomendasi (JCM)</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_jcm_join_mk->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>



      </div>

<!--batas rekomendasi untuk semster 7 jcm-->

<div id="bacaini" class="tab-pane fade">
      <h3>Perhatian..<small> Apakah anda ingin Pindah Ke Bidang Minat Lain.? </small></h3>

<div class="alert alert-info" role="alert">
 <h3>Jika Anda Ingin <strong>Pindah Bidang Minat..</strong></h3>
<h4>Anda Harus menghubungi DPAM anda...!!</h4>
</div>
  
</div>



      

<!--batas rekomendasi untuk semster 7 ppk-->


<!--batas rekomendasi untuk semster 7 ppk-->

<div id="rekomppk" class="tab-pane fade">
      <h3>Anda di Rekomendasi (PPK)</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_ppk_join_mk->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>


      </div>

<!--batas rekomendasi untuk semster 7 ppk-->
















<!--batas rekomendasi untuk semster 7 sc-->
   <div id="rekomsc" class="tab-pane fade">
      <h3>Anda di Rekomendasi (SC)</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_sc_join_mk->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>



<!--batas rekomendasi untuk semster 7 sc-->



































<?php }elseif($cek_semester_aktif->aktif == 8)
{
?>

      <div id="2" class="tab-pane fade ">
      <h3>Semester 2</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_2->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="4" class="tab-pane fade">
      <h3>Semester 4</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_4->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="6" class="tab-pane fade">
      <h3>Semester 6</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_6->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>

        <div id="8" class="tab-pane fade in active">
      <h3>Semester 8</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_8->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      


      </div>



<!--batas rekomendasi untuk semster 7 jcm-->

<div id="jcmrekom_6" class="tab-pane fade">
      <h3>Anda di Rekomendasi (JCM)</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_jcm_join_mk_6->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>



      </div>

<!--batas rekomendasi untuk semster 7 jcm-->


<!--batas rekomendasi untuk semster 7 ppk-->

<div id="ppkrekom_6" class="tab-pane fade">
      <h3>Anda di Rekomendasi (PPK)</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_ppk_join_mk_6->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>


      </div>

<!--batas rekomendasi untuk semster 7 ppk-->
















<!--batas rekomendasi untuk semster 7 sc-->
   <div id="rekomsc_6" class="tab-pane fade">
      <h3>Anda di Rekomendasi (SC)</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_sc_join_mk_6->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>



<!--batas rekomendasi untuk semster 7 sc-->












<?php }else{ ?>





      <div id="2" class="tab-pane fade in active">
      <h3>Semester 2</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_2->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="4" class="tab-pane fade">
      <h3>Semester 4</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_4->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="6" class="tab-pane fade">
      <h3>Semester 6</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_6->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>

        <div id="8" class="tab-pane fade">
      <h3>Semester 8</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_8->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>



 
 <?php
}
}

else{
 ?>
<!--Batas untuk Semester Ganjil-->





<?php
if ($cek_semester_aktif->aktif == 1) {
  ?>

     
      <div id="1" class="tab-pane fade in active">
      <h3>Semester 1</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_1->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="3" class="tab-pane fade ">
      <h3>Semester 3</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_3->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="5" class="tab-pane fade">
      <h3>Semester 5</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_5->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>

        <div id="7" class="tab-pane fade ">
      <h3>Semester 7</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_7->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>

  <?php
}elseif($cek_semester_aktif->aktif == 3)
{
?>


      <div id="1" class="tab-pane fade ">
      <h3>Semester 1</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_1->result() as $keys) {
?>

    <tr >
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="3" class="tab-pane fade in active">
      <h3>Semester 3</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_3->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="5" class="tab-pane fade ">
      <h3>Semester 5</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_5->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>

        <div id="7" class="tab-pane fade ">
      <h3>Semester 7</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_7->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>

<?php } 
elseif($cek_semester_aktif->aktif == 5)
{
?>

      <div id="1" class="tab-pane fade ">
      <h3>Semester 1</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_1->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="3" class="tab-pane fade">
      <h3>Semester 3</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_3->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="5" class="tab-pane fade in active">
      <h3>Semester 5</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_5->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>

        <div id="7" class="tab-pane fade ">
      <h3>Semester 7</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_7->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>

<?php }elseif($cek_semester_aktif->aktif==  7)
{
?>


      <div id="1" class="tab-pane fade ">
      <h3>Semester 1</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_1->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="3" class="tab-pane fade ">
      <h3>Semester 3</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_3->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="5" class="tab-pane fade">
      <h3>Semester 5</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_5->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>

        <div id="7" class="tab-pane fade in active">
      <h3>Semester 7</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_7->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>

<!--batas rekomendasi untuk semster 7 jcm-->

<div id="jcmrekom7" class="tab-pane fade">
      <h3>Anda di Rekomendasi (JCM)</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_jcm_join_mk->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>



      </div>

<!--batas rekomendasi untuk semster 7 jcm-->


<!--batas rekomendasi untuk semster 7 ppk-->

<div id="rekomppk7" class="tab-pane fade">
      <h3>Anda di Rekomendasi (PPK)</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_ppk_join_mk->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>


      </div>

<!--batas rekomendasi untuk semster 7 ppk-->
















<!--batas rekomendasi untuk semster 7 sc-->
   <div id="rekomsc" class="tab-pane fade">
      <h3>Anda di Rekomendasi (SC)</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>

    <?php 
foreach ($rek_sc_join_mk->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>



<!--batas rekomendasi untuk semster 7 sc-->







<?php }else{ ?>


      <div id="1" class="tab-pane fade ">
      <h3>Semester 1</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_1->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>


      <div id="3" class="tab-pane fade in active">
      <h3>Semester 3</h3>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_3->result() as $keys) {
?>

    <tr class="success">
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>




      </div>
        <div id="5" class="tab-pane fade ">
      <h3>Semester 5</h3>

      <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_5->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
      </div>

        <div id="7" class="tab-pane fade ">
      <h3>Semester 7</h3>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Program</th>
    </tr>
  </thead>
  <tbody>
    <?php 
foreach ($semester_7->result() as $keys) {
?>

    <tr>
      <td><?php echo $keys->kode_mk ?></td>
      <td><?php echo $keys->sks ?></td>
      <td><?php echo $keys->nama_matakuliah ?></td>

      <td>
      <?php
     $atts = array(
     
        'class'     => 'btn btn-primary'
     
);

echo anchor(site_url('entry/simpan_entry/'.$keys->id_mk),'Program',
        'class="btn btn-primary"'); 




      ?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

      </div>

<?php
}
}

 ?>

<!--Batas untuk Semester Ganjil-->
    </div>
   
    </div> <!--col md 6-->
          
                 <div class="col-md-6 well">
            <img class="img-rounded img-responsive" src="<?php echo base_url().'assets/img/logo.png' ?>" alt="Cinque Terre" width="550" height="80" style="margin-bottom:2px; padding-top:0px;margin-top:0px">
      

              <table class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>Kode MK</th>
                           <th>Mata Kuliah</th>
                           <th>Semester</th>
                                <th>sks</th>
                           <th>Hapus</th>
                      </tr>
                  </thead>
                  <tbody>

                    <?php

                     foreach ($entry_data as $key): ?>
                   <tr>
                          <td><?php echo $key->kode_mk ?></td>



                          <td><?php echo $key->nama_matakuliah ?></td>
                             <td><?php echo $key->nama_semester ?></td>
                          <td><?php echo $key->sks ?></td>
                          <td>





<?php 

$data = array(
  'class' => 'btn btn-default',
  'onclick' => 'javasciprt: return confirm(\'Anda Yakin Untuk Hapus '.$key->nama_matakuliah.' ?\')',
  );

echo anchor(site_url('entry/delete/'.$key->id_entry),'Delete <p class="glyphicon glyphicon-trash"   ',$data); 
 ?>


</td>
                      </tr>
                <?php endforeach ?>

<?php 
// Hitung total sks pada tabel entry 

 ?>

        <td colspan="3" rowspan="3" headers="">Total SKS</td>
          <td colspan="1" rowspan="1" headers="">
            <a href="#" class="btn btn-primary"><?php echo $sks->sks_total ?></a>
          </td>

          <td colspan="4" rowspan="3" headers=""></td>
                  </tbody>
              </table>
            </div>
          </div>