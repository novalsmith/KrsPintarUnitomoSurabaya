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
        <h2>Nilai List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Mk</th>
		<th>Id Mahasiswa</th>
		<th>Id Semester</th>
		<th>Tugas</th>
		<th>Uts</th>
		<th>Uas</th>
		<th>Akhir</th>
		<th>Huruf</th>
		<th>Total Sks</th>
		<th>Total Huruf</th>
		<th>Ip</th>
		
            </tr><?php
            foreach ($nilai_data as $nilai)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $nilai->id_mk ?></td>
		      <td><?php echo $nilai->id_mahasiswa ?></td>
		      <td><?php echo $nilai->id_semester ?></td>
		      <td><?php echo $nilai->tugas ?></td>
		      <td><?php echo $nilai->uts ?></td>
		      <td><?php echo $nilai->uas ?></td>
		      <td><?php echo $nilai->akhir ?></td>
		      <td><?php echo $nilai->huruf ?></td>
		      <td><?php echo $nilai->total_sks ?></td>
		      <td><?php echo $nilai->total_huruf ?></td>
		      <td><?php echo $nilai->ip ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>