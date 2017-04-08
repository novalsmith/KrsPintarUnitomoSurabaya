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
        <h2 style="margin-top:0px">Mata_kuliah <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Semester <?php echo form_error('id_semester') ?></label>
            <input type="text" class="form-control" name="id_semester" id="id_semester" placeholder="Id Semester" value="<?php echo $id_semester; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Mk <?php echo form_error('nama_mk') ?></label>
            <input type="text" class="form-control" name="nama_mk" id="nama_mk" placeholder="Nama Mk" value="<?php echo $nama_mk; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Sks <?php echo form_error('sks') ?></label>
            <input type="text" class="form-control" name="sks" id="sks" placeholder="Sks" value="<?php echo $sks; ?>" />
        </div>
	    <input type="hidden" name="kode_mk" value="<?php echo $kode_mk; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('mata_kuliah') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>