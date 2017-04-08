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
        <h2>Mahasiswa</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nidn</th>
		<th>Nama Dpam</th>
		<th>Pin Dpam</th>
		<th>Status</th>
		
            </tr><?php
            foreach ($dpam_data as $dpam)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $dpam->nidn ?></td>
		      <td><?php echo $dpam->nama_dpam ?></td>
		      <td><?php echo $dpam->pin_dpam ?></td>
		      <td><?php echo $dpam->status ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>