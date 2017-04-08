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
        <h2>Bidangminat_bersyarat List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Minat</th>
		<th>Id Mk</th>
		
            </tr><?php
            foreach ($bidangminat_bersyarat_data as $bidangminat_bersyarat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $bidangminat_bersyarat->id_minat ?></td>
		      <td><?php echo $bidangminat_bersyarat->id_mk ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>