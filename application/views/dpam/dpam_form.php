
        <h2 style="margin-top:0px">Dpam <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	 
<div class="col-md-5">



        <div class="form-group">
            <label for="int">Nidn <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Nidn" 
            value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Dpam <?php echo form_error('nama_dpam') ?></label>
            <input type="text" class="form-control" name="nama_dpam" id="nama_dpam" placeholder="Nama Dpam" value="<?php echo $nama_dpam; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Pin Dpam <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Pin Dpam" value="<?php echo $password; ?>" />
        </div>
	    
	    <input type="hidden" name="id_dpam" value="<?php echo $id_dpam; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('dpam') ?>" class="btn btn-default">Cancel</a>
	</div>
    </form>
