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

<?php if ($max_semester->total=="" || $max_semester->total==1): ?> <!---semester 1--->
<div class="col-md-1">
</div>
<div class="col-md-10">
  <div class="row">

<?php
$data_entry = $this->db->get('entry')->num_rows();
 ?>


    <div class="panel panel-default">
      <div class="panel-body">

          <?php if ($this->uri->segment(3)=="YA"): ?>
            <h3>Jawaban Anda Adalah : YA</h3>





<table class="table">
  <thead>
    <th>nama</th>
    <th>semester</th>
    <th>Kelas</th>

  </thead>
<?php foreach ($sem_1 as $key): ?>
  <tr>
    <td><?php echo $key->nama_matakuliah ?></td>
    <td><?php echo $key->nama_semester ?></td>
    <td><?php echo $key->nama_kelas ?></td>

  </tr>
<?php endforeach; ?>


</table>









            <?php if ($data_entry <1): ?>

              <?php
foreach ($replace as $key) {

  $result_replace = array(
    "id_mahasiswa"   =>  $this->session->userdata('id_mahasiswa'),
    "waktu_entry"    => date('Y'),
    "semester_aktif" => 1,
    "validasi"       => 'BELUM',
    "id_mk_tawaran"  => $key->id_mk_tawaran,
    "id_kelas"       => 3,
  );
  $this->db->insert('entry_temporary', $result_replace);

  }

      ?>

            <?php endif; ?>

          <?php elseif ($this->uri->segment(3)=="NO"):?>
            <h3>Jawaban Anda Adalah : YA</h3>

          <?php endif; ?>

      </div>
      <div class="panel-footer">
        <p class="bgbottom">
<button class="btn btn-warning btn-lg" onClick="javascript: history.go(-1)" value="Back"> <b  class="glyphicon glyphicon-repeat"></b> Kembali</button></p>
      </div>
    </div>




  </div>
</div>
<div class="col-md-1">
</div>




<?php elseif($max_semester->total==2): ?>

<?php elseif($max_semester->total==3): ?>

<?php elseif($max_semester->total==4): ?>

<?php else: ?>
<h1>sudah ada nilai mahasiswa lama</h1>
<?php endif; ?>
