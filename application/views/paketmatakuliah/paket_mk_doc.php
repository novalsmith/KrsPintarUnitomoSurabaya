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
        <h2>Paket_mk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Semester</th>
		<th>Id Mk</th>
		
            </tr><?php
            foreach ($paketmatakuliah_data as $paketmatakuliah)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $paketmatakuliah->id_semester ?></td>
		      <td><?php echo $paketmatakuliah->id_mk ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>