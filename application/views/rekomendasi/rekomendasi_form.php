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
        <h2 style="margin-top:0px">Rekomendasi <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Bidangminat <?php echo form_error('id_bidangminat') ?></label>
            <input type="text" class="form-control" name="id_bidangminat" id="id_bidangminat" placeholder="Id Bidangminat" value="<?php echo $id_bidangminat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Mk <?php echo form_error('id_mk') ?></label>
            <input type="text" class="form-control" name="id_mk" id="id_mk" placeholder="Id Mk" value="<?php echo $id_mk; ?>" />
        </div>
	    <input type="hidden" name="id_rekom" value="<?php echo $id_rekom; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('rekomendasi') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>