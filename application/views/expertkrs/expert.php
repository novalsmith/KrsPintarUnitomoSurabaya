<style type="text/css" media="screen">
  #jarak
  {
    margin-top: 5px;
  }
  #bawah_tetap
  {
    height: 15px;
    padding-top: 0px;
  }

</style>

<?php

if ($semester_sekarang->sekarang == 'Ganjil'):
?>



<?php if ( $max_semester->total=="" ||$max_semester->total ==1 ): ?> <!---semester 1--->




         <div class="panel panel-default">
           <div class="panel-body">
             <h3>   Sekarang Anda adalah mahasiswa Baru    </h3>
            <p>Adan secara otomatis di berikan matakuliah paket untuk semester 1</p>
             <br>
   <table class="table table-bordered">
     <thead>
       <th>Matakuliah</th>
       <th>Semester</th>
       <th>Jam Masuk</th>
       <th>Jam Selesai</th>
       <th>Ruang Kuliah</th>
 <th>Kelas</th>
 <th>Hari</th>
     </thead>
     <?php
     foreach ($sem_1 as $key): ?>  <tr>
       <td><?php echo $key->nama_matakuliah ?></td>
       <td><?php echo $key->nama_semester ?></td>
       <td><?php echo $key->jam_masuk ?></td>
       <td><?php echo $key->jam_selesai ?></td>
       <td><?php echo $key->nama_ruangan ?></td>

       <td><?php echo $key->nama_kelas ?></td>
       <td><?php echo $key->hari ?></td>

     </tr>
   <?php endforeach; ?>
   </table>
           </div>



<div class="col-md-1">
</div>




<?php elseif($max_semester->total+=2):  // sama dengan 3 ?>


      <div class="panel panel-default">
        <div class="panel-body">
          <h3>   Apakah Anda ingin Kontrak Matakuliah Pada semester 3 Saja..?  </h3>
        </div>
        <div class="panel-footer">
          <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
          </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
        </div>
      </div>
<?php elseif($max_semester->total+=4): // sama dengan 5 ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <h3>   Semester 5   </h3>
    </div>
    <div class="panel-footer">
      <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
      </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
    </div>
  </div>

<?php elseif($max_semester->total +=6):  // sama dengan 7 ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <h3>   Semester 7   </h3>
    </div>
    <div class="panel-footer">
      <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
      </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
    </div>
  </div>


<?php else: ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <h3>   MAAF Semester GANJIL BELUM ADA   </h3>
    </div>
    <div class="panel-footer">
      <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
      </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
    </div>
  </div>

<?php endif; ?>



<?php else: ?>

<!--untuk semester genap here-->
<?php
// Query untuk semester 1 ( kategori mahasiswa baru )
$this->db->where('mulai', 'Y');
$this->db->where('id_semester', 12);

$semester_1  = $this->db->get('pertanyaan')->result();
 ?>



<?php if($max_semester->total+=1): // sama dengan 2 ?>
  <?php foreach ($semester_1 as $key): ?>

  <div class="panel panel-default">
    <div class="panel-body">
      <h3>   Semester 2   </h3>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        <h3>   <?php echo $key->nama_pertanyaan ?>    </h3>
      </div>
      <div class="panel-footer">
        <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
        </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
      </div>
    </div>
<?php endforeach; ?>
<?php elseif($max_semester->total+=3): // sama saja dengan  4?>
  <div class="panel panel-default">
    <div class="panel-body">
      <h3>   Semester 4   </h3>
    </div>
    <div class="panel-footer">
      <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
      </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
    </div>
  </div>
<?php elseif($max_semester->total+=5): // sama dengan 6  ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <h3>   Semester 6   </h3>
    </div>
    <div class="panel-footer">
      <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
      </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
    </div>
  </div>

<?php elseif($max_semester->total+=7): // sama dengan 8 ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <h3>   Semester 8   </h3>
    </div>
    <div class="panel-footer">
      <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
      </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
    </div>
  </div>


<?php else: ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <h3>   MAAF SEMESTER GENAP BELUM ADA  </h3>
    </div>
    <div class="panel-footer">
      <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
      </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
    </div>
  </div>
<?php endif; ?>











  <?php
endif; ?>
