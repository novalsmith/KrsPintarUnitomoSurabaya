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
        <h2 style="margin-top:0px">Mk_tawaran Read</h2>
        <table class="table">
	    <tr><td>Id Mk</td><td><?php echo $id_mk; ?></td></tr>
	    <tr><td>Id Semester</td><td><?php echo $id_semester; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('mk_tawaran') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>