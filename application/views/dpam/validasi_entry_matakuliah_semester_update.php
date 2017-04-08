<style type="text/css" media="screen">
  #status{
    border: #bdc3c7 dashed 1px;
      }
</style>


<div class="col-md-8">
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







    <div class="col-md-12 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
               



                </div>
            </div>





<div class="col-md-8">
  














<ul class="nav nav-tabs">

<?php 

// select aktif 


if ($cek_semester_aktif->aktif == 1) {
  ?>

<li class="active"><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>


<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>
  <?php
}elseif($cek_semester_aktif->aktif == 2)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>


<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<?php } 
elseif($cek_semester_aktif->aktif == 3)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>

<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<!--for recomendate-->
<?php
} 
elseif($cek_semester_aktif->aktif == 4)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#1">1a</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>



<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<!--for recomendate-->
<?php
}
elseif($cek_semester_aktif->aktif == 5)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>



<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<!--for recomendate-->
<?php
}
elseif($cek_semester_aktif->aktif == 6)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#6">6</a></li>






<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<!--for recomendate-->
<?php
}
elseif($cek_semester_aktif->aktif == 7)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>



<li class="active"><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<!--for recomendate-->
<?php
}
elseif($cek_semester_aktif->aktif == 8)
{
?>

<li class=""><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>




<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class="active"><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<!--for recomendate-->
<?php
}
else
{
 ?>

<li class="active"><a class="label label-success" data-toggle="tab" href="#1">1</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#2">2</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#3">3</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#4">4</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#5">5</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#6">6</a></li>



<li class=""><a class="label label-success" data-toggle="tab" href="#7">7</a></li>
<li class=""><a class="label label-success" data-toggle="tab" href="#8">8</a></li>

<?php } ?>


</ul>
<!--Batas untuk pengecekan semester ganjil atau genap-->





<div class="tab-content">






<?php
if ($cek_semester_aktif->aktif == 1) {
  ?>


   <div id="1" class="tab-pane fade in active">
      <h3>Semester 1</h3>


<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>




<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kode MK</th>
      <th>SKS</th>
      <th>Matakuliah</th>
       <th>Validasi</th>
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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>


        
      </td>
    </tr>
  <?php
}
    ?>














  </tbody>
</table>


<?php } ?>
      </div>


   <div id="2" class="tab-pane fade in">
      <h3>Semester 2</h3>


<?php 
if ($semester_2 == '') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>


  </tbody>
</table>



<?php
} ?>
      </div>


   <div id="3" class="tab-pane fade in ">
      <h3>Semester 3</h3>

<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>
  
   <div id="4" class="tab-pane fade in ">
      <h3>Semester 4</h3>


<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

 
   <div id="5" class="tab-pane fade in ">
      <h3>Semester 5</h3>


<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="6" class="tab-pane fade in ">
      <h3>Semester 6</h3>


<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="7" class="tab-pane fade in ">
      <h3>Semester 7</h3>


<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade in ">
      <h3>Semester 8</h3>

<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php }?>
      </div>


<?php }elseif($cek_semester_aktif->aktif == 2){?>


   <div id="1" class="tab-pane fade in ">
      <h3>Semesterss 1</h3>



<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="2" class="tab-pane fade in active">
      <h3>Semester 2</h3>

<?php 
if ($semester_2 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="3" class="tab-pane fade in ">
      <h3>Semester 3</h3>


<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>
  
   <div id="4" class="tab-pane fade in ">
      <h3>Semester 4</h3>

<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php }?>
      </div>

 
   <div id="5" class="tab-pane fade in ">
      <h3>Semester 5</h3>

<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="6" class="tab-pane fade in ">
      <h3>Semester 6</h3>

<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="7" class="tab-pane fade in ">
      <h3>Semester 7</h3>


<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade in ">
      <h3>Semester 8</h3>


<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

<?php } 
elseif ($cek_semester_aktif->aktif == 3) {
  ?>


   <div id="1" class="tab-pane fade in ">
      <h3>Semester 1</h3>

<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="2" class="tab-pane fade in">
      <h3>Semester 2</h3>

<?php 
if ($semester_2 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="3" class="tab-pane fade in active">
      <h3>Semester 3</h3>

<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>
  
   <div id="4" class="tab-pane fade in ">
      <h3>Semester 4</h3>

<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

 
   <div id="5" class="tab-pane fade in ">
      <h3>Semester 5</h3>

<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="6" class="tab-pane fade in ">
      <h3>Semester 6</h3>


<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>

<?php } ?>

      </div>



   <div id="7" class="tab-pane fade in ">
      <h3>Semester 7</h3>

<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade in ">
      <h3>Semester 8</h3>

<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


<?php}elseif($cek_semester_aktif->aktif == 4){?>



   <div id="1" class="tab-pane fade  ">
      <h3>Semester 1</h3>

<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>



<table class="table table-striped table-bo4dered">
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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="2" class="tab-pane fade ">
      <h3>Semester 2</h3>

<?php 
if ($semester_2 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>




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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="3" class="tab-pane fade  ">
      <h3>Semester 3</h3>

<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>
  
   <div id="4" class="tab-pane fade in active">
      <h3>Semester 4</h3>

<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>
    
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

 
   <div id="5" class="tab-pane fade ">
      <h3>Semester 5</h3>
<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="6" class="tab-pane fade  ">
      <h3>Semester 6</h3>

<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

   <div id="7" class="tab-pane fade  ">
      <h3>Semester 7</h3>

<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade  ">
      <h3>Semester 8</h3>
<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

<?php }
elseif ($cek_semester_aktif->aktif == 5) {
  ?>


   <div id="1" class="tab-pane fade in ">
      <h3>Semester 1</h3>


<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="2" class="tab-pane fade in">
      <h3>Semester 2</h3>

<?php 
if ($semester_2 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="3" class="tab-pane fade in ">
      <h3>Semester 3</h3>

<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>
  
   <div id="4" class="tab-pane fade in ">
      <h3>Semester 4</h3>

<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

 
   <div id="5" class="tab-pane fade in active">
      <h3>Semester 5</h3>
<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="6" class="tab-pane fade in ">
      <h3>Semester 6</h3>

<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>

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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="7" class="tab-pane fade in ">
      <h3>Semester 7</h3>

<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade in ">
      <h3>Semester 8</h3>
<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


<?php 
}

elseif($cek_semester_aktif->aktif == 6)
    {
        ?>



   <div id="1" class="tab-pane fade in ">
      <h3>Semester 1</h3>

<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="2" class="tab-pane fade in">
      <h3>Semester 2</h3>
<?php 
if ($semester_2 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="3" class="tab-pane fade in ">
      <h3>Semester 3</h3>

<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>
  
   <div id="4" class="tab-pane fade in ">
      <h3>Semester 4</h3>
<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

 
   <div id="5" class="tab-pane fade in ">
      <h3>Semester 5</h3>

<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5 . 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="6" class="tab-pane fade in active">
      <h3>Semester 6</h3>

<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="7" class="tab-pane fade in ">
      <h3>Semester 7</h3>
<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade in ">
      <h3>Semester 8</h3>
<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

<?php } elseif ($cek_semester_aktif->aktif == 7) {
  ?>


   <div id="1" class="tab-pane fade in ">
      <h3>Semester 1</h3>
<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php }?>
      </div>


   <div id="2" class="tab-pane fade in">
      <h3>Semester 2</h3>

<?php 
if ($semester_2 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="3" class="tab-pane fade in ">
      <h3>Semester 3</h3>
<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>

      </div>
  
   <div id="4" class="tab-pane fade in ">
      <h3>Semester 4</h3>
<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

 
   <div id="5" class="tab-pane fade in ">
      <h3>Semester 5</h3>
<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>

      </div>


   <div id="6" class="tab-pane fade in ">
      <h3>Semester 6</h3>
<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>

      </div>

   <div id="7" class="tab-pane fade in active">
      <h3>Semester 7</h3>
<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade in ">
      <h3>Semester 8</h3>
<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


<?php }elseif($cek_semester_aktif->aktif == 8){?>



   <div id="1" class="tab-pane fade in ">
      <h3>Semester 1</h3>
<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="2" class="tab-pane fade in">
      <h3>Semester 2</h3>
<?php 
if ($semester_2 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="3" class="tab-pane fade in ">
      <h3>Semester 3</h3>
<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>
  
   <div id="4" class="tab-pane fade in ">
      <h3>Semester 4</h3>
<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php }?>
      </div>

 
   <div id="5" class="tab-pane fade in ">
      <h3>Semester 5</h3>
<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="6" class="tab-pane fade in ">
      <h3>Semester 6</h3>
<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

   <div id="7" class="tab-pane fade in ">
      <h3>Semester 7</h3>

<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>



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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade in active">
      <h3>Semester 8</h3>
<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


<?php }else{?>


   <div id="1" class="tab-pane fade in active">
      <h3>Semester 1</h3>
<?php 
if ($semester_1 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 1. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php }?>
      </div>


   <div id="2" class="tab-pane fade in">
      <h3>Semester 2</h3>
<?php 
if ($semester_2 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 2. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="3" class="tab-pane fade in ">
      <h3>Semester 3</h3>
<?php 
if ($semester_3 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 3. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>
  
   <div id="4" class="tab-pane fade in ">
      <h3>Semester 4</h3>
<?php 
if ($semester_4 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 4. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

 
   <div id="5" class="tab-pane fade in ">
      <h3>Semester 5</h3>
<?php 
if ($semester_5 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 5. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


   <div id="6" class="tab-pane fade in ">
      <h3>Semester 6</h3>
<?php 
if ($semester_6 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 6. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>

   <div id="7" class="tab-pane fade in ">
      <h3>Semester 7</h3>
<?php 
if ($semester_7 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 7. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>
        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>



   <div id="8" class="tab-pane fade in ">
      <h3>Semester 8</h3>
<?php 
if ($semester_8 =='') {
  ?>

<div class="alert alert-danger" role="alert">
    <strong>Maaff..!  , <?php echo $nama_mahasiswa ?> </strong>. Belum Mempunyai Matakuliah yang Hendak di Validasi pada Semester 8. 
</div>

  <?php
} else {
?>


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
if ($keys->validasi == 'SUDAH') {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Sudah',
     'class="btn btn-primary active"');  
} else {
     echo anchor(site_url('validasi/update/'.$keys->id_entry.
     '/'.$this->uri->segment(4)),'Belum',
     'class="btn btn-primary"'); 
  
}

?>

        
      </td>
    </tr>
  <?php
}
    ?>
  </tbody>
</table>
<?php } ?>
      </div>


<?php } ?>




</div>




</div>


<div class="col-md-4 pull-right" id="status">
  <h3>Update Status Validasi</h3>
        <form action="<?php echo base_url().'validasi/update_action';?>" method="post">
     


        <div class="form-group">
            <label for="varchar">Kode Mk <?php echo form_error('kode_mk') ?></label>
            <input type="text" class="form-control" name="kode_mk" id="kode_mk" placeholder="Kode Mk" value="<?php echo $kode_mk; ?>" disabled/>
        </div>
      <div class="form-group">
            <label for="varchar">Nama Matakuliah <?php echo form_error('nama_matakuliah') ?></label>
            <input type="text" class="form-control" name="nama_matakuliah" id="nama_matakuliah" placeholder="Nama Matakuliah" value="<?php echo $nama_matakuliah; ?>" disabled/>
        </div>
<!--
<div class="form-group">
 <label for="int">Validasi <?php echo form_error('validasi') ?></label>
            <input type="text" class="form-control" name="validasi" 
            id="validasi" placeholder="validasi" value="<?php echo $validasi; ?>"  />
        
</div>
-->


<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary active">
    <input type="radio" name="validasi" value="SUDAH" id="option1" autocomplete="off" checked> 
   <p class="glyphicon glyphicon-ok"></p> Sudah Validasi
  </label>

  <label class="btn btn-primary">
    <input type="radio" name="validasi" value="BELUM" id="option3" autocomplete="off">
     Belum Validasi <p class="glyphicon glyphicon-remove"></p> 
  </label>
</div>

<br> 

<br> 


      <input type="hidden" name="seg_4" value="<?php echo $this->uri->segment(4); ?>" /> 
      <input type="hidden" name="id_entry" value="<?php echo $id_entry; ?>" /> 
      <input type="submit" name="ok" value="simpan" class="btn btn-success">
  
    </form>


<br>

</div>




