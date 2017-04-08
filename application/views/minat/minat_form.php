
        <h2 style="margin-top:0px">Minat <?php echo $button ?></h2>
<div class="col-md-5">



        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Minat <?php echo form_error('nama_minat') ?></label>
            <input type="text" class="form-control" name="nama_minat" id="nama_minat" placeholder="Nama Minat" value="<?php echo $nama_minat; ?>" />
        </div>
	    <input type="hidden" name="id_minat" value="<?php echo $id_minat; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('minat') ?>" class="btn btn-default">Cancel</a>
	</form>

  </div>
