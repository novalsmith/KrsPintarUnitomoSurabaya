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
        <h2>ExpertRule List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Semester</th>
		<th>Id Expert Kasus</th>
		<th>Id Expert Jawaban</th>
		<th>Jika Ya</th>
		<th>Jika Tidak</th>
		<th>Mulai</th>
		
            </tr><?php
            foreach ($expertrule_data as $expertrule)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $expertrule->id_semester ?></td>
		      <td><?php echo $expertrule->id_expert_kasus ?></td>
		      <td><?php echo $expertrule->id_expert_jawaban ?></td>
		      <td><?php echo $expertrule->jika_ya ?></td>
		      <td><?php echo $expertrule->jika_tidak ?></td>
		      <td><?php echo $expertrule->mulai ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>