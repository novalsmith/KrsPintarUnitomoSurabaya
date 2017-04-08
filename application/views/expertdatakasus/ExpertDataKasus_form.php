
        <h2 style="margin-top:0px">ExpertDataKasus <?php echo $button ?></h2>
<div class="col-md-5">


<?php $data = $this->uri->segment(3); ?>
        <form action="<?php echo $action; ?>" method="post">

<?php if ($data): ?>
  <div class="form-group">
        <label for="nama_DataKasus">Kode DataKasus <?php echo form_error('kode_DataKasus') ?></label>
        <input disabled="disabled" class="form-control" rows="3" name="kode_DataKasus" id="kode_DataKasus"
        placeholder="Kode DataKasus" value="<?php echo $id_expert_kasus ?>">
    </div>
<?php else: ?>
  <div class="form-group">
        <label for="nama_DataKasus">Kode DataKasus <?php echo form_error('kode_DataKasus') ?></label>
        <input class="form-control" rows="3" name="kode_DataKasus" id="kode_DataKasus"
        placeholder="Kode DataKasus" required="required">
    </div>
<?php endif; ?>



      <div class="form-group">
            <label for="nama_DataKasus">Nama DataKasus <?php echo form_error('nama_DataKasus') ?></label>
            <textarea class="form-control" rows="3" name="nama_DataKasus" id="nama_DataKasus" placeholder="Nama DataKasus"><?php echo $nama_DataKasus; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <input type="hidden" name="id_expert_kasus" value="<?php echo $id_expert_kasus; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('expertdatakasus') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
