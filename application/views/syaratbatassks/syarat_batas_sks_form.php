
        <h2 style="margin-top:0px">Syarat Batas Sks <?php echo $button ?></h2>

<div class="col-md-5">


        <form action="<?php echo $action; ?>" method="post">




        <div class="form-group">
              <label for="int">Nama MataKuliah <?php echo form_error('id_mk') ?></label>


      <select   class="form-control" name="id_mk" id="id_mk" placeholder="Matakuliah"  required="required" >

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


                      value="<?php echo $key->id_mk ?>">

                      <?php echo $key->nama_matakuliah ?>

                      </option>

                  <?php endforeach ?>


              </select>




          </div>



	    <div class="form-group">
            <label for="int">Batas SKS <?php echo form_error('batas_sks') ?></label>
            <input type="text" class="form-control" name="batas_sks" id="batas_sks" placeholder="Batas Sks" value="<?php echo $batas_sks; ?>" />
        </div>
	    <input type="hidden" name="id_mk_syarat_sks" value="<?php echo $id_mk_syarat_sks; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('SyaratBatasSks') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
