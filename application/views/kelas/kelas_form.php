
        <h2 style="margin-top:0px">Kelas <?php echo $button ?></h2>
<div class="col-md-5">

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Kelas <?php echo form_error('nama_kelas') ?></label>
            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" value="<?php echo $nama_kelas; ?>" />
        </div>

        <div class="form-group">
              <label for="varchar">Kapasitas Ruang Kelas <?php echo form_error('kapasitas') ?></label>
              <input type="text" class="form-control" name="kapasitas" id="kapasitas" placeholder="Nama Kelas"
              value="<?php echo $kapasitas; ?>" />
          </div>



	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('kelas') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
