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
        <h2>Mahasiswa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nim</th>
		<th>Nama Mahasiswa</th>
		<th>Pin</th>
		
            </tr><?php
            foreach ($mahasiswa_data as $mahasiswa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $mahasiswa->nim ?></td>
		      <td><?php echo $mahasiswa->nama_mahasiswa ?></td>
		      <td><?php echo $mahasiswa->pin ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>