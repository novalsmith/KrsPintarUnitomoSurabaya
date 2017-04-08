
        <h2 style="margin-top:0px"> <?php echo $nama.'  '.$button ?></h2>
        <form action="<?php echo $action; ?>" method="post">

<div class="col-md-4">

        <div class="form-group">
            <label for="int">Baidang Minat <?php echo form_error('id_minat') ?></label>




     <select   class="form-control" name="id_minat" id="id_minat" placeholder="Bidang Minat"  required="required" >

<option value="">Pilih Bidang Minat</option>

                <?php

$mk = $this->db->get('minat');
                foreach ($mk->result() as $key): ?>

                    <option


                    <?php if ($id_minat==$key->id_minat) {
                        ?>

                        value="<?php echo $id_minat?>" selected
                        <?php
                    } ?>


                    value="<?php echo $key->id_minat ?>">

                    <?php echo $key->nama_minat ?>

                    </option>

                <?php endforeach ?>


            </select>






        </div>
	    <div class="form-group">
            <label for="int">Nama MataKuliah <?php echo form_error('id_mk') ?></label>



    <select   class="form-control" name="id_mk" id="id_mk" placeholder="Mata Kuliah"  >

<option value="">Pilih MataKuliah</option>

          <?php
          $matakuliah = $this->db->get('matakuliah');

           ?>
                <?php foreach ($matakuliah->result() as $key): ?>

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
	    <input type="hidden" name="id_bminat_syarat" value="<?php echo $id_bminat_syarat; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('bidangminat_bersyarat') ?>" class="btn btn-default">Cancel</a>

</div>
    </form>
