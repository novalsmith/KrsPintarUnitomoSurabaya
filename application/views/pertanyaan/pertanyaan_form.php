




        <h2 style="margin-top:0px">Rule Pertanyaan / Jawaban <?php echo $button ?></h2>

                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>

        <form action="<?php echo $action; ?>" method="post">

          <div class="col-md-5">


            <?php $data = $this->uri->segment(3); ?>

            <?php if ($data): ?>
              <div class="form-group">
                    <label for="nama_DataKasus">Kode Rule Pertanyaan / Hasil <?php echo form_error('tanya') ?></label>
                    <input disabled="disabled" class="form-control" rows="3" name="tanya" id="tanya"
                    placeholder="Kode Rule" value="<?php echo $id_pertanyaan ?>">
                </div>
            <?php else: ?>
              <div class="form-group">
                <label for="nama_DataKasus">Kode Rule Pertanyaan / Hasil <?php echo form_error('tanya') ?></label>
                <input  class="form-control" rows="3" name="tanya" id="tanya"  placeholder="Kode Rule">
                </div>
            <?php endif; ?>



            <div class="form-group">
            <label for="int">Semester <?php echo form_error('id_semester') ?></label>
            <select   class="form-control" name="id_semester" id="id_semester" placeholder="Semester"  required="required" >
          <option value="">Pilih Semester Untuk Rule Pertanyaan</option>
          <?php
         $mk = $this->db->get('semester');
          foreach ($mk->result() as $key): ?>
              <option
              <?php if ($id_semester==$key->id_semester) { ?>
                    value="<?php echo $id_semester?>" selected
                <?php   } ?>
          value="<?php echo $key->id_semester ?>">
            <?php echo $key->nama_semester ?>
              </option>
      <?php endforeach ?>
          </select>
              <small>Semester ini bertujuan untuk menentukan Rule pertanyaan berada pada semester Berapa </small>
            </div>

	    <div class="form-group">
            <label for="nama_pertanyaan">isi Pertanyaan / Jawaban <?php echo form_error('nama_pertanyaan') ?></label>
            <textarea class="form-control" rows="3" name="nama_pertanyaan" id="nama_pertanyaan" placeholder="Isi Pertanyaan Anda di sini"><?php echo $nama_pertanyaan; ?></textarea>
        </div>

        <label for="int">Mulai</label>

        <div class="form-group well">


<?php
$uri = $this->uri->segment(3);
 if ($uri==''): ?>
 <input type="radio" name="mulai" value="Y"> YA
 <input type="radio" name="mulai" value="T"> TIDAK
<?php else: ?>

<?php     $mulai = $this->db->get_where('pertanyaan',
array('id_pertanyaan' => $uri  ))->row();
 ?>

 <?php if ($mulai->mulai=='Y'): ?>
   <input type="radio" name="mulai" value="Y" checked="checked"> YA
   <input type="radio" name="mulai" value="T"> TIDAK

<?php else: ?>
  <input type="radio" name="mulai" value="Y"> YA
  <input type="radio" name="mulai" value="T" checked="checked"> TIDAK <?php endif; ?>

<?php endif; ?>

          </div>
          <small>Apakah Anda ingin Pertanyaan ini di akses pada Kondisi pertanyaan Pertama saat
          Aplikasi di jalankan..? </small>
</div>


<div class="col-md-5">

  <label for="varchar">Jika YA </label>
    <div class="form-group well">

   <select   class="form-control" name="jika_ya" id="id_mk" placeholder="matakuliah"  >
    <option value="">Pilih Aksi Jika YA</option>
    <?php
    $mk = $this->db->get('pertanyaan');
    foreach ($mk->result() as $key): ?>
    <option
    <?php if ($jika_ya==$key->id_pertanyaan) {
    ?>
          value="<?php echo $jika_ya?>" selected
    <?php
    } ?>
  value="<?php echo $key->id_pertanyaan ?>">[<?php echo $key->id_pertanyaan ?>]<?php echo $key->nama_pertanyaan ?></option>
    <?php endforeach ?>
      </select>


        </div><!--batas well jika ya-->

        <label for="varchar">Jika TIDAK </label>

	    <div class="form-group well">


       <select   class="form-control" name="jika_tidak" id="jika_tidak">
        <option value="">Pilih Aksi Jika TIDAK</option>
        <?php
        $mk = $this->db->get('pertanyaan');
        foreach ($mk->result() as $key): ?>
        <option
        <?php if ($jika_tidak==$key->id_pertanyaan) {
        ?>
              value="<?php echo $jika_tidak?>" selected
        <?php
        } ?>
      value="<?php echo $key->id_pertanyaan ?>">[<?php echo $key->id_pertanyaan ?>]<?php echo $key->nama_pertanyaan ?></option>
        <?php endforeach ?>
          </select>



        </div><!--batas well jika ya-->


      <input type="hidden" name="id_pertanyaan" value="<?php echo $id_pertanyaan; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('pertanyaan') ?>" class="btn btn-default">Cancel</a>

</div>
<div class="col-md-2">
  <p class="alert alert-warning">Jika Pernyataan Ya, maka aksi apa yang akan di pilih Apakah langsung menemukan Hasil..?  atau lanjut pada pertanyaan berikutnya.. di samping ini adalah pilihah pertanyaan dan jawaban !  </p>
</div>
	</form>
