

        <h2 style="margin-top:0px">Jawaban <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">

<div class="col-md-5">
      <div class="form-group">
            <label for="nama_jawaban">Nama Jawaban <?php echo form_error('nama_jawaban') ?></label>
            <textarea class="form-control" rows="3" name="nama_jawaban" id="nama_jawaban" placeholder="Nama Jawaban"><?php echo $nama_jawaban; ?></textarea>
        </div>


	    <div class="form-group">
            <label for="solusi">Solusi <?php echo form_error('solusi') ?></label>
            <textarea class="form-control" rows="3" name="solusi" id="solusi" placeholder="Solusi"><?php echo $solusi; ?></textarea>
        </div>
	    <input type="hidden" name="id_jawaban" value="<?php echo $id_jawaban; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('jawaban') ?>" class="btn btn-default">Cancel</a>
</div>
  </form>
