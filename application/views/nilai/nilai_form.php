
        <h2 style="margin-top:0px"> <?php echo $button ?> Nilai</h2>
        <form action="<?php echo $action; ?>" method="post">


<div class="col-md-5">
      <div class="form-group">

<?php

$mks = $this->db->query('select mk.nama_matakuliah,
mhs.nama_mahasiswa,
mhs.nim,
mk.id_mk,
et.semester_aktif from entry et
join mk_tawaran mt on mt.id_mk_tawaran=et.id_mk_tawaran
join matakuliah mk on mk.id_mk=mt.id_mk_tawaran
join mahasiswa  mhs on mhs.id_mahasiswa= et.id_mahasiswa');


$this->db->join('mk_tawaran mt', 'mt.id_mk_tawaran = et.id_mk_tawaran');
$this->db->join('matakuliah mk', 'mk.id_mk = mt.id_mk');
$this->db->join('mahasiswa mhs', 'mhs.id_mahasiswa = et.id_mahasiswa');
$mk = $this->db->get('entry et');
 ?>


            <label for="int">Mata Kuliah <?php echo form_error('id_mk') ?></label>


            <select   class="form-control" name="id_mk" id="id_mk" placeholder="Id Mk" required="required"  >
             <option value="">Pilih Matakuliah</option>


                <?php foreach ($mk->result() as $key): ?>

                    <option


                    <?php if ($id_mk==$key->id_mk) {
                        ?>
                        value="<?php echo $id_mk?>" selected
                        <?php
                    } ?>


                    value="<?php echo $key->id_mk?>">

            <?php
            echo ' ( '.$key->semester_aktif.' ) '.$key->nim.' - '.$key->nama_mahasiswa.' - '. $key->nama_matakuliah ?></option>

                <?php endforeach ?>


            </select>




        </div>
        <div class="form-group">
            <label for="int">Mahasiswa <?php echo form_error('id_mahasiswa') ?></label>




<?php

$mhs = $this->db->query('select distinct(en.id_mahasiswa)
,mhs.id_mahasiswa,mhs.nama_mahasiswa,mhs.nim from entry en
join mk_tawaran mt on mt.id_mk_tawaran=en.id_mk_tawaran

join matakuliah mk on mk.id_mk=en.id_mk_tawaran join mahasiswa
    mhs on mhs.id_mahasiswa= en.id_mahasiswa
 order by en.id_entry asc');


 ?>



            <select   class="form-control" name="id_mahasiswa" id="id_mahasiswa"
            placeholder="mahasiswa" required="required" >

          <option value="">Nama Mahasiswa</option>


                <?php foreach ($mhs->result() as $key): ?>

                    <option


                    <?php if ($id_mahasiswa==$key->id_mahasiswa) {
                        ?>
                        value="<?php echo $id_mahasiswa?>" selected
                        <?php
                    } ?>


                    value="<?php echo $key->id_mahasiswa ?>"><?php echo $key->nama_mahasiswa ?></option>

                <?php endforeach ?>


            </select>





        </div>
        <div class="form-group">
            <label for="int">Semester <?php echo form_error('id_semester') ?></label>


<?php

$Semester = $this->db->get('semester');


 ?>



            <select   class="form-control" name="id_semester" id="id_semester" placeholder="semester"  >

             <option value="">Pilih Semester</option>

                <?php foreach ($Semester->result() as $key): ?>

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
            <label for="decimal">Tugas <?php echo form_error('tugas') ?></label>
            <input type="text" class="form-control" name="tugas" id="tugas" placeholder="Tugas" value="<?php echo $tugas; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Uts <?php echo form_error('uts') ?></label>
            <input type="text" class="form-control" name="uts" id="uts" placeholder="Uts" value="<?php echo $uts; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Uas <?php echo form_error('uas') ?></label>
            <input type="text" class="form-control" name="uas" id="uas" placeholder="Uas" value="<?php echo $uas; ?>" />
        </div>



</div>


    <div class="col-md-6">
          <input type="hidden" name="id_nilai" value="<?php echo $id_nilai; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('nilai') ?>" class="btn btn-default">Cancel</a>
    </div>
    </form>
