<!doctype html>
<html>
    <head>
        <title>Smart KRS Unitomo</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important;
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important;
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <div class="col-md-6">
          <center>
            <img src="<?php echo base_url('assets/img/logo_unitomo.gif')?>" class="pull-left" width="100" height="95">

<?php $mhs = $this->session->userdata('id_mahasiswa');
$getname = $this->db->get_where('mahasiswa',array('id_mahasiswa'=>$mhs))->row();
 ?>
            <h2>Hasil KRS Anda Di Semester ini yang di Generate Oleh Sistem <br> Smart KRS Unitomo <br>
              <small><?php echo $getname->nama_mahasiswa.' : '.$getname->nim ?></small>
            </h2>

          </center>
        </div>
        <table class="word-table" style="margin-bottom: 10px">
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
</body>
</html>
