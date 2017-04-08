
        <h2 style="margin-top:0px">Semester Sekarang <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
<div class="col-md-5">


	    <div class="form-group">
      <label for="varchar">Sekarang <?php echo form_error('sekarang') ?></label>
 <select   class="form-control" name="sekarang" id="sekarang" placeholder="sekarang" required="required" >
		<option value="">Pilih Semester Sekarang</option>
<?php
if ($sekarang == 'Ganjil') {
?>
<option value="Ganjil" selected>Ganjil</option>
<option value="Genap">Genap</option>
<?php
}elseif($sekarang=='Genap'){ ?>

<option value="Ganjil">Ganjil</option>
<option value="Genap" selected>Genap</option>

<?php }
else
{
 ?>

<option value="Ganjil">Ganjil</option>
<option value="Genap">Genap</option>
 <?php } ?>
</select>
        </div>

        <div class="form-group">
        <label for="varchar">Tahun Akademik <?php echo form_error('tahun_ajaran') ?></label>
        <?php
          $dat = date('Y');
            $dat2 = date('Y')-1;
         ?>
        <input class="form-control" type="text" value="<?php echo $tahun_ajaran?>" name="tahun_ajaran" placeholder="<?php echo $dat2.'/'.$dat ?>">
        <p>Masukan Tahun Akademik seperti contoh didalam Form Tersebut, Tergantung Waktu Akademik yang Berjalan</p>
      </div>

	    <input type="hidden" name="id_semester_sekarang" value="<?php echo $id_semester_sekarang; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('semestersekarang') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
