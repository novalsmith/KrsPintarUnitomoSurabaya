<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
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
        <h2>Jadwal_mk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Mk</th>
		<th>Id Kelas</th>
		<th>Jam Masuk</th>
		<th>Jam Selesai</th>
		<th>Ruangan</th>
		<th>Hari</th>
		
            </tr><?php
            foreach ($jadwal_mk_data as $jadwal_mk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $jadwal_mk->id_mk ?></td>
		      <td><?php echo $jadwal_mk->id_kelas ?></td>
		      <td><?php echo $jadwal_mk->jam_masuk ?></td>
		      <td><?php echo $jadwal_mk->jam_selesai ?></td>
		      <td><?php echo $jadwal_mk->ruangan ?></td>
		      <td><?php echo $jadwal_mk->hari ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>