
        <h2 style="margin-top:0px">Ruang kuliah <?php echo $button ?></h2>
       
        <div class="col-md-5">
            
       

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Ruangan <?php echo form_error('nama_ruangan') ?></label>
            <input type="text" class="form-control" name="nama_ruangan" id="nama_ruangan" placeholder="Nama Ruangan" value="<?php echo $nama_ruangan; ?>" />
        </div>
	    <div class="form-group">
            <label for="ket_ruangan">Ket Ruangan <?php echo form_error('ket_ruangan') ?></label>
            <textarea class="form-control" rows="3" name="ket_ruangan" id="ket_ruangan" placeholder="Ket Ruangan"><?php echo $ket_ruangan; ?></textarea>
        </div>
	    <input type="hidden" name="id_ruang_kuliah" value="<?php echo $id_ruang_kuliah; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ruang_kuliah') ?>" class="btn btn-default">Cancel</a>
	</form>
 </div>