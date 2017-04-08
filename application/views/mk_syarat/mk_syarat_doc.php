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
        <h2>Mk_syarat List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Bidangminat</th>
		<th>Id Nilai</th>
		<th>Nama Mk Syarat</th>
		
            </tr><?php
            foreach ($mk_syarat_data as $mk_syarat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $mk_syarat->id_bidangminat ?></td>
		      <td><?php echo $mk_syarat->id_nilai ?></td>
		      <td><?php echo $mk_syarat->nama_mk_syarat ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>