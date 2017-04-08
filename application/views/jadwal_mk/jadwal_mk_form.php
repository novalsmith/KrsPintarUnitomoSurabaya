
        <h2 style="margin-top:0px">Jadwal Matakuliah <?php echo $button ?></h2>
         <div class="col-md-5">
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="int">Matakuliah <?php echo form_error('id_mk_tawaran') ?></label>



 <select   class="form-control" name="id_mk_tawaran" id="id_mk"
 placeholder="matakuliah">

        <option value="">Pilih Matakuliah</option>

            <?php


                foreach ($mk_tawaran as $key): ?>

                    <option


                    <?php if ($id_mk_tawaran==$key->id_mk_tawaran) {  ?>

                        value="<?php echo $id_mk_tawaran?>" selected
                        <?php
                    } ?>


                    value="<?php echo $key->id_mk_tawaran ?>"><?php echo'[ '. $key->nama_semester.' ] '. $key->nama_matakuliah ?></option>

                <?php endforeach ?>


            </select>


        </div>


        <div class="form-group">
            <label for="varchar">Ruangan <?php echo form_error('id_ruang_kuliah') ?></label>


 <select   class="form-control" name="id_ruang_kuliah" id="id_ruang_kuliah"
 placeholder="matakuliah">

        <option value="">Pilih Matakuliah</option>

            <?php

          $rk = $this->db->get('ruang_kuliah');
                foreach ($rk->result() as $key): ?>

                    <option


                    <?php if ($id_ruang_kuliah==$key->id_ruang_kuliah) {  ?>

                        value="<?php echo $id_ruang_kuliah?>" selected
                        <?php
                    } ?>


                    value="<?php echo $key->id_ruang_kuliah ?>"><?php echo $key->nama_ruangan ?></option>

                <?php endforeach ?>


            </select>


        </div>
        <div class="form-group">
            <label for="varchar">Hari <?php echo form_error('hari') ?></label>


            <select class="form-control" name="hari" id="hari" required="required">
               <option value="">Pilih Hari Kuliah</option>




               <?php
                      $cek_hari = $this->db->get_where('jadwal_mk',$this->uri->segment(3))->row();
                        if ($cek_hari->hari=$hari) {
                           ?>
      <option value=" <?php echo $hari ?>" selected="selected">
          <?php echo $hari ?>      </option>
 <option value="SENIN">SENIN</option>
                <option value="SELASA">SELASA</option>
                <option value="RABU">RABU</option>
                <option value="KAMIS">KAMIS</option>
                <option value="JUMAT">JUMAT</option>
                <option value="SABTU">SABTU</option>
                <option value="MINGGU">MINGGU</option>

                            <?php

                        }else
                        {
                            ?>
  <option value="SENIN">SENIN</option>
                <option value="SELASA">SELASA</option>
                <option value="RABU">RABU</option>
                <option value="KAMIS">KAMIS</option>
                <option value="JUMAT">JUMAT</option>
                <option value="SABTU">SABTU</option>
                <option value="MINGGU">MINGGU</option>
                            <?php

                        }

                ?>





            </select>



        </div>
        <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('jadwal_mk') ?>" class="btn btn-default">Cancel</a>


  </div>

       <div class="col-md-5">

   <div class="form-group">
            <label for="varchar">Jam Masuk <?php echo form_error('jam_masuk') ?></label>
            <input type="text" required="required" class="form-control" name="jam_masuk" id="jam_masuk" placeholder="Jam Masuk" value="<?php echo $jam_masuk; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Jam Selesai <?php echo form_error('jam_selesai') ?></label>
            <input type="text" required="required" class="form-control" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai" value="<?php echo $jam_selesai; ?>" />
        </div>


            </form>
            </div>
