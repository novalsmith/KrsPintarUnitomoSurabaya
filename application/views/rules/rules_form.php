
        <h2 style="margin-top:0px">Rules <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">

<div class="col-md-5">


        <div class="form-group">
        			<label for="int">Pertanyaan <?php echo form_error('id_pertanyaan') ?></label>


        	 <select   class="form-control" name="id_pertanyaan" id="id_mk" placeholder="matakuliah"  >

        		<option value="">Pilih Pertanyaan</option>

        			<?php

        $mk = $this->db->get('pertanyaan');
        				foreach ($mk->result() as $key): ?>

        					<option


        					<?php if ($id_pertanyaan==$key->id_pertanyaan) {
        						?>

        						value="<?php echo $id_pertanyaan?>" selected
        						<?php
        					} ?>


        					value="<?php echo $key->id_pertanyaan ?>">[<?php echo $key->id_pertanyaan ?>]<?php echo $key->nama_pertanyaan ?></option>

        				<?php endforeach ?>


        			</select>


        		</div>






            <div class="form-group">
                  <label for="int">Jawaban <?php echo form_error('id_jawaban') ?></label>


               <select   class="form-control" name="id_jawaban" id="id_jawaban" placeholder="matakuliah"  >

                <option value="">Pilih Jawaban</option>

                  <?php

            $mk = $this->db->get('jawaban');
                    foreach ($mk->result() as $key): ?>

                      <option


                      <?php if ($id_jawaban==$key->id_jawaban) {
                        ?>

                        value="<?php echo $id_jawaban?>" selected
                        <?php
                      } ?>


                      value="<?php echo $key->id_jawaban ?>">[<?php echo $key->id_jawaban ?>]
                      <?php echo $key->nama_jawaban ?></option>

                    <?php endforeach ?>


                  </select>


                </div>











	    <input type="hidden" name="id_rules" value="<?php echo $id_rules; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('rules') ?>" class="btn btn-default">Cancel</a>

</div>
  </form>
