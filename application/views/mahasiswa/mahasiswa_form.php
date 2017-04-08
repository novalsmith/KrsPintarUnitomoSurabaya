
        <h2 style="margin-top:0px">Mahasiswa <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	  <div class="col-md-5">
        <div class="form-group">
            <label for="int">Nim <?php echo form_error('nim') ?></label>
            <input type="text" class="form-control" name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Mahasiswa <?php echo form_error('nama_mahasiswa') ?></label>
            <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" placeholder="Nama Mahasiswa" value="<?php echo $nama_mahasiswa; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Pin <?php echo form_error('pin') ?></label>
            <input type="text" class="form-control" name="pin" id="pin" placeholder="Pin" value="<?php echo $pin; ?>" />
        </div>

        <label for="int">Jenis Kelas <?php echo form_error('jenis_kelas') ?></label>

        <div class="form-group well">


                  <?php
                  $uri = $this->uri->segment(3);
                   if ($uri==''): ?>
                   <input type="radio" name="jenis_kelas" value="Pagi"> Kelas Pagi
                   <input type="radio" name="jenis_kelas" value="Sore"> Kelas Sore
                  <?php else: ?>

                  <?php     $kelas = $this->db->get_where('mahasiswa',
                  array('id_mahasiswa' => $uri  ))->row();
                   ?>

                   <?php if ($kelas->jenis_kelas=='Pagi'): ?>


                     <input type="radio" name="jenis_kelas" value="Pagi" checked="checked"> Kelas Pagi
                     <input type="radio" name="jenis_kelas" value="Sore"> Kelas Sore

                  <?php else: ?>

                    <input type="radio" name="jenis_kelas" value="Pagi" checked="checked"> Kelas Pagi
                    <input type="radio" name="jenis_kelas" value="Sore" checked="checked"> Kelas Sore
                  <?php endif; ?>

                  <?php endif; ?>

          </div>



	    <input type="hidden" name="id_mahasiswa" value="<?php echo $id_mahasiswa; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('mahasiswa') ?>" class="btn btn-default">Cancel</a>
	</div>
    </form>
