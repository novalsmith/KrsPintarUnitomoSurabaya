
        <h2 style="margin-top:0px">Semester <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	  <div class="col-md-5">

	    <div class="form-group">
            <label for="varchar">Nama Semester <?php echo form_error('nama_semester') ?></label>
            <input type="text" class="form-control" name="nama_semester" id="nama_semester" placeholder="Nama Semester" value="<?php echo $nama_semester; ?>" />
        </div>
	    <input type="hidden" name="id_semester" value="<?php echo $id_semester; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('semester') ?>" class="btn btn-default">Cancel</a>
	</div>
	</form>
  