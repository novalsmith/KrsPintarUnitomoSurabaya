
        <h2 style="margin-top:0px">Matakuliah <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	   
<div class="col-md-5">

        <div class="form-group">
            <label for="varchar">Kode Mk <?php echo form_error('kode_mk') ?></label>
            <input type="text" required="required"  class="form-control" name="kode_mk" id="kode_mk" placeholder="Kode Mk" value="<?php echo $kode_mk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Matakuliah <?php echo form_error('nama_matakuliah') ?></label>
            <input type="text" required="required"  class="form-control" name="nama_matakuliah" id="nama_matakuliah" placeholder="Nama Matakuliah" value="<?php echo $nama_matakuliah; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Sks <?php echo form_error('sks') ?></label>
            <input type="text" required="required"  class="form-control" name="sks" id="sks" placeholder="Sks" value="<?php echo $sks; ?>" />
        </div>



	    <input type="hidden" name="id_mk" value="<?php echo $id_mk; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('matakuliah') ?>" class="btn btn-default">Cancel</a>
	</div>

    </form>