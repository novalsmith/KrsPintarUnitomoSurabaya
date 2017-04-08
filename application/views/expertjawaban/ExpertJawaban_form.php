
        <h2 style="margin-top:0px">ExpertJawaban <?php echo $button ?></h2>

<div class="col-md-5">

        <form action="<?php echo $action; ?>" method="post">


          <?php $data = $this->uri->segment(3); ?>
                  <form action="<?php echo $action; ?>" method="post">

          <?php if ($data): ?>
            <div class="form-group">
                  <label for="nama_DataKasus">Kode Jawaban <?php echo form_error('kode_jawaban') ?></label>
                  <input disabled="disabled" class="form-control" rows="3" name="kode_jawaban" id="kode_DataKasus"
                  placeholder="Kode Jawaban" value="<?php echo $id_expert_jawaban ?>">
              </div>
          <?php else: ?>
            <div class="form-group">
              <label for="nama_DataKasus">Kode Jawaban <?php echo form_error('kode_jawaban') ?></label>
              <input  class="form-control" rows="3" name="kode_jawaban" id="kode_DataKasus"
                  placeholder="Kode Jawaban" required="required">
              </div>
          <?php endif; ?>



      <div class="form-group">
            <label for="nama_jawaban">Nama Jawaban <?php echo form_error('nama_jawaban') ?></label>
            <textarea class="form-control" rows="3" name="nama_jawaban" id="nama_jawaban" placeholder="Nama Jawaban"><?php echo $nama_jawaban; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="solusi">Solusi <?php echo form_error('solusi') ?></label>
            <textarea class="form-control" rows="3" name="solusi" id="solusi" placeholder="Solusi"><?php echo $solusi; ?></textarea>
        </div>
	    <input type="hidden" name="id_expert_jawaban" value="<?php echo $id_expert_jawaban; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('expertjawaban') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
