
        <h2 style="margin-top:0px">Jurusan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	  <div class="col-md-5">
        <div class="form-group">
            <label for="varchar">Kode Jurusan <?php echo form_error('kode_jurusan') ?></label>
            <input type="text" class="form-control" name="kode_jurusan" id="kode_jurusan" placeholder="Kode Jurusan" value="<?php echo $kode_jurusan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Jurusan <?php echo form_error('nama_jurusan') ?></label>
            <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" placeholder="Nama Jurusan" value="<?php echo $nama_jurusan; ?>" />
        </div>
	    <input type="hidden" name="id_jurusan" value="<?php echo $id_jurusan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jurusan') ?>" class="btn btn-default">Cancel</a>
	</div>
    </form>