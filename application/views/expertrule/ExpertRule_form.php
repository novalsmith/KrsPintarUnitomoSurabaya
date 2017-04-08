
        <h2 style="margin-top:0px">ExpertRule <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">

          <div class="col-md-5">

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

            <small>Apakah Anda ingin Pertanyaan ini di akses pada Kondisi pertanyaan Pertama saat
            Aplikasi di jalankan..? </small>
<br><br>
            <label for="int">Mulai <?php echo form_error('id_semester') ?></label>

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




	    <div class="form-group">
            <label for="varchar">Id Expert Kasus <?php echo form_error('id_expert_kasus') ?></label>
            <input type="text" class="form-control" name="id_expert_kasus" id="id_expert_kasus" placeholder="Id Expert Kasus" value="<?php echo $id_expert_kasus; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Id Expert Jawaban <?php echo form_error('id_expert_jawaban') ?></label>
            <input type="text" class="form-control" name="id_expert_jawaban" id="id_expert_jawaban" placeholder="Id Expert Jawaban" value="<?php echo $id_expert_jawaban; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jika Ya <?php echo form_error('jika_ya') ?></label>
            <input type="text" class="form-control" name="jika_ya" id="jika_ya" placeholder="Jika Ya" value="<?php echo $jika_ya; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jika Tidak <?php echo form_error('jika_tidak') ?></label>
            <input type="text" class="form-control" name="jika_tidak" id="jika_tidak" placeholder="Jika Tidak" value="<?php echo $jika_tidak; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mulai <?php echo form_error('mulai') ?></label>
            <input type="text" class="form-control" name="mulai" id="mulai" placeholder="Mulai" value="<?php echo $mulai; ?>" />
        </div>
	    <input type="hidden" name="id_expertrule" value="<?php echo $id_expertrule; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('expertrule') ?>" class="btn btn-default">Cancel</a>
	</form>
