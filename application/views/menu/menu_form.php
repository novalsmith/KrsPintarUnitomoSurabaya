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
        <h2 style="margin-top:0px">Menu <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="tinyint">Parent Id <?php echo form_error('parent_id') ?></label>
            <input type="text" class="form-control" name="parent_id" id="parent_id" placeholder="Parent Id" value="<?php echo $parent_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Menu <?php echo form_error('menu') ?></label>
            <input type="text" class="form-control" name="menu" id="menu" placeholder="Menu" value="<?php echo $menu; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Menu Order <?php echo form_error('menu_order') ?></label>
            <input type="text" class="form-control" name="menu_order" id="menu_order" placeholder="Menu Order" value="<?php echo $menu_order; ?>" />
        </div>
	    <div class="form-group">
            <label for="isi_menu">Isi Menu <?php echo form_error('isi_menu') ?></label>
            <textarea class="form-control" rows="3" name="isi_menu" id="isi_menu" placeholder="Isi Menu"><?php echo $isi_menu; ?></textarea>
        </div>
	    <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('menu') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>