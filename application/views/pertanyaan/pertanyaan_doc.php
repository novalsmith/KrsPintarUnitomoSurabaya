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
        <h2>Pertanyaan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Semester</th>
		<th>Nama Pertanyaan</th>
		<th>Jika Ya</th>
		<th>Jika Tidak</th>
		
            </tr><?php
            foreach ($pertanyaan_data as $pertanyaan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pertanyaan->id_semester ?></td>
		      <td><?php echo $pertanyaan->nama_pertanyaan ?></td>
		      <td><?php echo $pertanyaan->jika_ya ?></td>
		      <td><?php echo $pertanyaan->jika_tidak ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>