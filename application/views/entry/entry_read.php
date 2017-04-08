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
        <h2 style="margin-top:0px">Entry Read</h2>
        <table class="table">
	    <tr><td>Id Nilai</td><td><?php echo $id_nilai; ?></td></tr>
	    <tr><td>Nim</td><td><?php echo $nim; ?></td></tr>
	    <tr><td>Id Mk</td><td><?php echo $id_mk; ?></td></tr>
	    <tr><td>Id Syarat</td><td><?php echo $id_syarat; ?></td></tr>
	    <tr><td>Id Rekom</td><td><?php echo $id_rekom; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('entry') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>