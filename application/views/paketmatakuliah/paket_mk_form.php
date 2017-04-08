
        <h2 style="margin-top:0px">Paket Mata Kuliah <?php echo $button ?></h2>

        <div class="col-md-5">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Semester <?php echo form_error('id_semester') ?></label>


<select   class="form-control" name="id_semester" id="id_semester" placeholder="Semester"  required="required" >

<option value="">Pilih Paket Untuk Semester</option>

                <?php

$mk = $this->db->get('semester');
                foreach ($mk->result() as $key): ?>

                    <option


                    <?php if ($id_semester==$key->id_semester) {
                        ?>

                        value="<?php echo $id_semester?>" selected
                        <?php
                    } ?>


                    value="<?php echo $key->id_semester ?>">

                    <?php echo $key->nama_semester ?>

                    </option>

                <?php endforeach ?>


            </select>



        </div>
	    <div class="form-group">
            <label for="int">MataKuliah <?php echo form_error('id_mk') ?></label>


<select   class="form-control" name="id_mk" id="id_mk" placeholder="Matakuliah"  required="required" >

<option value="">Pilih Paket Matakuliah</option>

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
	    <input type="hidden" name="id_paket" value="<?php echo $id_paket; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('paketmatakuliah') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
