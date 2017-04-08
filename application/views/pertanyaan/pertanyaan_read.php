<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Pertanyaan Read</h2>
        <table class="table">
	    <tr><td>Id Semester</td><td><?php echo $id_semester; ?></td></tr>
	    <tr><td>Nama Pertanyaan</td><td><?php echo $nama_pertanyaan; ?></td></tr>
	    <tr><td>Jika Ya</td><td><?php echo $jika_ya; ?></td></tr>
	    <tr><td>Jika Tidak</td><td><?php echo $jika_tidak; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pertanyaan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>