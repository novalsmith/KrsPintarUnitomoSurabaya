
        <h2 style="margin-top:0px">Rekomendasi Bidang Minat <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">


<div class="col-md-5">


  <div class="form-group">
        <label for="int">Nama Semester <?php echo form_error('semester') ?></label>

<select   class="form-control" name="semester" id="semester" placeholder="Semester"  required="required" >

<option value="">Tawaran Semester</option>

            <?php

$mks = $this->db->get('semester');
            foreach ($mks->result() as $key): ?>

                <option


                <?php if ($semester==$key->nama_semester) {
                    ?>

                    value="<?php echo $semester?>" selected
                    <?php
                } ?>


                value="<?php echo $key->nama_semester ?>">

                <?php echo $key->nama_semester ?>

                </option>

            <?php endforeach ?>


        </select>
    </div>


     <div class="form-group">
            <label for="varchar">Nama Matakuliah <?php echo form_error('kode_mk') ?></label>


            <select  class="form-control" name="kode_mk" id="kode_mk" placeholder="Kode Mk" required="required">
                <option value="">Pilih Matakuliah</option>

            <?php if ($mk=='')
            {
?>

<option value="">Opps.. Matakuliah Masih Kosong</option>
<?php }else
{?>




                <?php foreach ($mk->result() as $key): ?>
                    <option


                    <?php if ($kode_mk==$key->id_mk) {
                        ?>
                        value="<?php echo $kode_mk?>" selected
                        <?php
                    } ?>


                    value="<?php echo $key->id_mk ?>"><?php echo $key->nama_matakuliah ?></option>
                <?php endforeach ?>

     <?php } ?>

            </select>









        </div>
        <div class="form-group">
            <label for="varchar">Bidang Minat <?php echo form_error('nama_bidangminat') ?></label>


            <select  class="form-control"  name="nama_bidangminat" id="nama_bidangminat" placeholder="Nama Bidangminat" required="required">
                <option value="">Pilih Bidang Minat</option>

            <?php if ($minat=='')
            {
?>

<option value="">Opps.. Matakuliah Masih Kosong</option>
<?php }else
{?>




                <?php foreach ($minat->result() as $key): ?>
                    <option


                    <?php if ($nama_bidangminat==$key->id_minat) {
                        ?>
                        value="<?php echo $nama_bidangminat?>" selected
                        <?php
                    } ?>


                    value="<?php echo $key->id_minat ?>"><?php echo $key->nama_minat ?></option>
                <?php endforeach ?>

     <?php } ?>

            </select>



        </div>
        <input type="hidden" name="id_bidangminat" value="<?php echo $id_bidangminat; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('bidangminat') ?>" class="btn btn-default">Cancel</a>

</div>



	</form>
