
		<h2 style="margin-top:0px"><?php echo $nama.'   '.$button ?></h2>
		<form action="<?php echo $action; ?>" method="post">


		<div class="col-md-4">
<div class="form-group">
			<label for="int">MataKuliah <?php echo form_error('id_mk') ?></label>


	 <select   class="form-control" name="id_mk" id="id_mk" placeholder="matakuliah"  >

		<option value="">Pilih Matakuliah</option>

			<?php

$mk = $this->db->get('matakuliah');
				foreach ($mk->result() as $key): ?>

					<option


					<?php if ($id_mk==$key->id_mk) {
						?>

						value="<?php echo $id_mk?>" selected
						<?php
					} ?>


					value="<?php echo $key->id_mk ?>"><?php echo $key->nama_matakuliah ?></option>

				<?php endforeach ?>


			</select>


		</div>
		<div class="form-group">
			<label for="int">Nama Semester <?php echo form_error('id_semester') ?></label>


				<select   class="form-control" name="id_semester" id="id_semester" placeholder="Smester"  >
		  		<option value="">Pilih Semester</option>

		  <?php
		  $semester = $this->db->get('semester');

		   ?>

				<?php foreach ($semester->result() as $key): ?>

					<option


					<?php if ($id_semester==$key->id_semester) {
						?>
						value="<?php echo $id_semester?>" selected
						<?php
					} ?>


					value="<?php echo $key->id_semester ?>"><?php echo $key->nama_semester ?></option>

				<?php endforeach ?>


			</select>
		</div>


</div>

<div class="col-md-4">


		<div class="form-group">
			<label for="varchar">Matakuliah Syarat <?php echo form_error('syarat') ?></label>


			<select   class="form-control" name="syarat" id="syarat" placeholder="syarat"  >
		  		<option value="">Pilih Syarat Matakuliah</option>

		  <?php
		$nilai_mk = $this->db->get('matakuliah');

		   ?>
				<?php foreach ($nilai_mk->result() as $key): ?>

					<option

					<?php if ($syarat==$key->id_mk) {
						?>
						value="<?php echo $syarat?>" selected
						<?php
					} ?>


					value="<?php echo $key->id_mk ?>">


    <?php echo $key->nama_matakuliah;   ?>

					</option>

				<?php endforeach ?>
			</select>
		</div>

</div>
   <div class="col-md-12">

          <input type="hidden" name="id_syarat" value="<?php echo $id_syarat; ?>" />
		<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
		<a href="<?php echo site_url('mk_syarat') ?>" class="btn btn-default">Cancel</a>

	   </div>
	</form>
