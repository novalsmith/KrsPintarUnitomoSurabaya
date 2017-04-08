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
if ($semester_sekarang->sekarang == 'Genap') {
?>

<?php


foreach ($expert_genap as $k) {


     $id_mk[]           = $k['id_mk'];
     $id_mk_tawaran[]           = $k['id_mk_tawaran'];
     $nama_matakuliah[] = $k['nama_matakuliah'];
     $sks[]             = $k['sks'];
     $kode_mk[]         = $k['kode_mk'];
     $nama_semester[]   = $k['nama_semester'];


}

 ?>



<script>
<?php
echo "var jumlah = ".count($id_mk).";\n";
echo "var sks = new Array();\n";
//mengambil sks matakuliah dan memasukkan ke array javascript
for($j=0;$j<count($id_mk);$j++){
    echo "sks['".$id_mk[$j]."'] = ".$sks[$j].";\n";
}
?>
function hitungtotal(){
    jum = 0;
    for(i=0;i<jumlah;i++){
        id = "mk"+i;
        td1 = "k1"+i;
        td2 = "k2"+i;
        td3 = "k3"+i;
        td4 = "k4"+i;
        td5 = "k5"+i;
        if(document.getElementById(id).checked){
            kode = document.getElementById(id).value
            jum = jum + sks[kode];
            //untuk mengubah warna latar tabel apabila diceklist
            document.getElementById(td1).style.backgroundColor  = "lightblue";
            document.getElementById(td2).style.backgroundColor  = "lightblue";
            document.getElementById(td3).style.backgroundColor  = "lightblue";
            document.getElementById(td4).style.backgroundColor  = "lightblue";
             document.getElementById(td5).style.backgroundColor = "lightblue";
        }else {
            document.getElementById(td1).style.backgroundColor = "white";
            document.getElementById(td2).style.backgroundColor = "white";
            document.getElementById(td3).style.backgroundColor = "white";
            document.getElementById(td4).style.backgroundColor = "white";

            document.getElementById(td5).style.backgroundColor = "white";
        }
    }
    //menampilkan total jumlah SKS yang diambil
var total = <?php echo 24 ?>;
if(jum >total)
{
 alert('Opps..Maaf Anda Melebihi SKS, Maksimal Anda Adalah : '+total);
   window.location.href = 'entry' ;

}else
{
     document.getElementById("jsks").innerHTML = jum;
}

}
</script>

   <?php
$data = $this->Mk_tawaran_model->join_expert();
    ?>






    <h2 id="jarak">Kartu Rencana Studi</h2>
  <p>Silahkan Centang Matakuliah di bawah ini</p>
  <form role="form">

   <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Semester</th>
                    <th>Kode mk</th>
                    <th>Nama Matakuliah</th>
                    <th>SKS</th>
                    <th>Pilih</th>
                </tr>
            </thead>
            <tbody>
            <?php
//menampilkan matakuliah ke dalam tabel


for($i=0;$i<count($id_mk);$i++){

echo "<tr>";
if ($nama_semester[$i]==2) {
   echo "<td id=k1$i><p class='btn btn-success'> ".$nama_semester[$i]."</p></td>";
} elseif($nama_semester[$i]==4) {
 echo "<td id=k1$i><p class='btn btn-primary'> ".$nama_semester[$i]."</p></td>";
}elseif($nama_semester[$i]==6) {
 echo "<td id=k1$i><p class='btn btn-info'> ".$nama_semester[$i]."</p></td>";
}elseif($nama_semester[$i]==8) {
 echo "<td id=k1$i><p class='btn btn-warning'> ".$nama_semester[$i]."</p></td>";
}


    echo "<td id=k2$i>".$kode_mk[$i]."</td>";
    echo "<td id=k3$i>".$nama_matakuliah[$i]."</td>";
    echo "<td id=k4$i>".$sks[$i]."</td>";
    echo "<td  id=k5$i><input type=checkbox name=mk[] onclick=hitungtotal()
    value=".$id_mk[$i]. " id=mk".$i."></td>";

    echo '

   <input hidden="" value="">

    ';



}
?>

            </tbody>
        </table>
   </div>

 <div class="navbar navbar-default navbar-fixed-bottom" role="navigation" id="bawah_tetap">
<div class="container">

    <table class="table">


     <tr >
            <td width='100'>
               <input type="submit" value=" EXPERT PROCESS" class="btn btn-primary btn-large">

            </td><td></td>
            <td>JUMLAH YANG DIAMBIL</td>
              <td>


            </td>
              <td>
               <span id='jsks' class="btn btn-primary"></span>
            </td>
            <td>
            </td>



        </tr>

 </table>
            </div>
            </div>
  </form>


<?php
}else

{
  ?>

<?php


foreach ($expert_ganjil as $k) {


     $id_mk[]           = $k['id_mk_tawaran'];
      $id_mk_tawaran[]           = $k['id_mk_tawaran'];
     $nama_matakuliah[] = $k['nama_matakuliah'];
     $sks[]             = $k['sks'];
     $kode_mk[]         = $k['kode_mk'];
     $nama_semester[]   = $k['nama_semester'];


}

 ?>



<script>
<?php
echo "var jumlah = ".count($id_mk).";\n";
echo "var sks = new Array();\n";
//mengambil sks matakuliah dan memasukkan ke array javascript
for($j=0;$j<count($id_mk);$j++){
    echo "sks['".$id_mk[$j]."'] = ".$sks[$j].";\n";
}
?>
function hitungtotal(){
    jum = 0;
    for(i=0;i<jumlah;i++){
        id  = "mk"+i;
        td1 = "k1"+i;
        td2 = "k2"+i;
        td3 = "k3"+i;
        td4 = "k4"+i;
        td5 = "k5"+i;
        if(document.getElementById(id).checked){
            kode = document.getElementById(id).value
            jum = jum + sks[kode];
            //untuk mengubah warna latar tabel apabila diceklist
            document.getElementById(td1).style.backgroundColor = "lightblue";
            document.getElementById(td2).style.backgroundColor = "lightblue";
            document.getElementById(td3).style.backgroundColor = "lightblue";
            document.getElementById(td4).style.backgroundColor = "lightblue";
             document.getElementById(td5).style.backgroundColor = "lightblue";
        }else {
            document.getElementById(td1).style.backgroundColor = "white";
            document.getElementById(td2).style.backgroundColor = "white";
            document.getElementById(td3).style.backgroundColor = "white";
            document.getElementById(td4).style.backgroundColor = "white";

            document.getElementById(td5).style.backgroundColor = "white";
        }
    }
    //menampilkan total jumlah SKS yang diambil
var total = <?php echo 24 ?>;
if(jum >total)
{
 alert('Opps..Maaf Anda Melebihi SKS, Maksimal Anda Adalah : '+total);

   window.location.href = 'entry' ;

}else
{
     document.getElementById("jsks").innerHTML = jum;
}


}
</script>



   <?php
$data = $this->Mk_tawaran_model->join_expert();
    ?>


  <form role="form" action="<?php echo site_url('entry/create_action') ?>" method="post">



   <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
   <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Semester</th>
                    <th>Kode mk</th>
                    <th>Nama Matakuliah</th>
                    <th>SKS</th>
                    <th>Pilih</th>
                </tr>
            </thead>
            <tbody>

      <?php
//menampilkan matakuliah ke dalam tabel


for($i=0;$i<count($id_mk);$i++){

echo "<tr>";




if ($nama_semester[$i]==1) {
   echo "<td id=k1$i><p class='btn btn-success'> ".$nama_semester[$i]."</p></td>";
} elseif($nama_semester[$i]==3) {
 echo "<td id=k1$i><p class='btn btn-primary'> ".$nama_semester[$i]."</p></td>";
}elseif($nama_semester[$i]==5) {
 echo "<td id=k1$i><p class='btn btn-info'> ".$nama_semester[$i]."</p></td>";
}elseif($nama_semester[$i]==7) {
 echo "<td id=k1$i><p class='btn btn-warning'> ".$nama_semester[$i]."</p></td>";
}


    echo "<td id=k2$i  align='center' >".$kode_mk[$i]."</td>";

    echo "<td id=k3$i>".$nama_matakuliah[$i]."</td>";
    echo "<td id=k4$i>".$sks[$i]."</td>";
    echo "<td  id=k5$i><input type=checkbox name=mk[] onclick=hitungtotal()
    value=".$id_mk_tawaran[$i]. " id=mk".$i."></td>";

  }
?>

            </tbody>
        </table>
   </div>


<div class="navbar navbar-default navbar-fixed-bottom" role="navigation" id="bawah_tetap">
<div class="container">

    <table class="table">


     <tr >
            <td width='100'>
               <input type="submit" value=" EXPERT PROCESS" class="btn btn-primary btn-large">

            </td><td></td>
            <td>JUMLAH YANG DIAMBIL</td>
              <td>


            </td>
              <td>
              <span id='jsks' class="btn btn-primary"></span>
            </td>
            <td>
            </td>



        </tr>

 </table>
            </div>
            </div>


  </form>

    <?php } ?>
<style type="text/css" media="screen">
  #tengah{
    text-align: center;
  }
  #tengah th{
      text-align: center;
  }
</style>

<div class="col-md-12" style="margin-bottom: 80px">
        <table class="table table-bordered table-striped" id="tengah">
            <thead>
                <tr>

                    <th align="center">Matakuliah</th>
                    <th align="center">Mahasiswa</th>
                    <th align="center">waktu</th>
                    <th align="center">Semester aktif</th>
                </tr>
            </thead>
            <tbody align="center">

<?php
$data_loop = $this->db->get('entry_temporary');

foreach ($data_loop->result() as $key ) {
   ?>
<tr>

<td><?php echo $key->id_mk_tawaran?></td>
<td><?php echo $key->id_mahasiswa?></td>
<td><?php echo $key->waktu_entry?></td>
<td><?php echo $key->semester_aktif?></td>
</tr>

   <?php
 }

 ?>


            </tbody>
            </table>


    </div>





















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

    <?php $parameter = $this->uri->segment(3); ?>
    <?php if ($parameter==""): ?>




    <div class="col-md-1">
    </div>
    <div class="col-md-10">
      <div class="row">

    <?php
    // Query untuk semester 1 ( kategori mahasiswa baru )
    $this->db->where('mulai', 'Y');
    $semester_1  = $this->db->get('pertanyaan')->result();
     ?>

     <?php foreach ($semester_1 as $key): ?>


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


     <?php


    else: ?>


    <?php
    $result = substr($parameter,0,1);

    $this->db->where('id_jawaban', $parameter);
    $jawab = $this->db->get('jawaban')->result();
    if ($result=="H"):?>

       <?php foreach ($jawab as $key): ?>

             <div class="panel panel-default">
               <div class="panel-body">
                 <h3>   <?php echo $key->nama_jawaban ?>    </h3>
                 <p> <?php echo $key->solusi ?></p>
               </div>
               <div class="panel-footer">
                 <p class="bgbottom">
         <button class="btn btn-warning btn-lg" onClick="javascript: history.go(-1)" value="Back"> <b  class="glyphicon glyphicon-repeat"></b> Back</button>
               </div>
               </div>
             </div>
       <?php endforeach; ?>

    <?php
    $result = substr($parameter,0,1);

    elseif($result=="Z"): ?>

      <?php
      // Query untuk semester 1 ( kategori mahasiswa baru )
      $this->db->where('id_jawaban', $parameter);
      $jawab = $this->db->get('jawaban')->result();
       ?>


       <?php foreach ($jawab as $key): ?>




          <div class="panel panel-default">
            <div class="panel-body">
              <h3>   <?php echo $key->nama_jawaban ?>    </h3>
             <p><?php echo $key->solusi ?></p>
              <a href="<?php echo base_url().'smart/index/'.$parameter?>/3"
                class="btn btn-primary btn-lg" role="button">Semester 3 </a>
              <a href="<?php echo base_url().'smart/index/'.$parameter?>/5"
                 class="btn btn-primary btn-lg" role="button">Semester 5 </a>
              <a href="<?php echo base_url().'smart/index/'.$parameter?>/7"
                 class="btn btn-primary btn-lg" role="button">Semester 7 </a>


                    <?php if ($this->uri->segment(4)==""): ?>
    <h5>Anda Harus Memilih salah-satu Semester diatas</h5>
    <div class="panel-footer">
                 <button class="btn btn-warning btn-lg" onClick="javascript: history.go(-1)" value="Back"> <b  class="glyphicon glyphicon-repeat"></b> Back</button></p>
    </div>
                    <?php else: ?>


    <table class="table">
      <thead>
        <th>Matakuliah</th>
        <th>Semester</th>

      </thead>
      <?php

      foreach ($push as $key): ?>  <tr>
        <td><?php echo $key->nama_matakuliah ?></td>
        <td><?php echo $key->nama_semester ?></td>

      </tr>
    <?php endforeach; ?>

    </table>
            </div>
            <div class="panel-footer">
                         <button class="btn btn-warning btn-lg" onClick="javascript: history.go(-1)" value="Back"> <b  class="glyphicon glyphicon-repeat"></b> Back</button></p>
            </div>
          </div>

      <?php endif; ?>

       <?php endforeach; ?>


       <?php
       $result = substr($parameter,0,1);

       elseif($result=="K"): ?>

         <?php
         // Query untuk semester 1 ( kategori mahasiswa baru )
         $this->db->where('id_jawaban', $parameter);
         $jawab = $this->db->get('jawaban')->result();
          ?>

          <?php foreach ($jawab as $key): ?>




             <div class="panel panel-default">
               <div class="panel-body">
                 <h3>   <?php echo $key->nama_jawaban ?>    </h3>
                <p><?php echo $key->solusi ?></p>
                 <a href="<?php echo base_url().'smart/index/'.$parameter?>/1"
                   class="btn btn-primary btn-lg" role="button">Semester 1 </a>



       <table class="table">
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
               <div class="panel-footer">
                            <button class="btn btn-warning btn-lg" onClick="javascript: history.go(-1)" value="Back"> <b  class="glyphicon glyphicon-repeat"></b> Back</button></p>
               </div>
             </div>
          <?php endforeach; ?>










    <?php else: ?>

      <?php
      // Query untuk semester 1 ( kategori mahasiswa baru )
      $this->db->where('id_pertanyaan', $parameter);
      $semester_1  = $this->db->get('pertanyaan')->result();
       ?>

       <?php foreach ($semester_1 as $key): ?>


          <div class="panel panel-default">
            <div class="panel-body">
              <h3>   <?php echo $key->nama_pertanyaan ?>    </h3>

            </div>
            <div class="panel-footer">
              <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_ya; ?>" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
              </a>  <a href="<?php echo base_url()?>smart/index/<?php echo $key->jika_tidak; ?>" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a>

                   <button class="btn btn-warning btn-lg pull-right" onClick="javascript: history.go(-1)" value="Back"> <b  class="glyphicon glyphicon-repeat"></b> Back</button></p>
            </div>
          </div>



       <?php endforeach; ?>

    <?php endif; ?>
     <?php endif; ?>

      </div>
    </div>
    <div class="col-md-1">
    </div>




    <?php elseif($max_semester->total+=2):  // sama dengan 3 ?>


          <div class="panel panel-default">
            <div class="panel-body">
              <h3>   Semester 3   </h3>
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


    <?php if($max_semester->total+=1): // sama dengan 2 ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>   Semester 2   </h3>
        </div>
        <div class="panel-footer">
          <p class="bgbottom"><a href="<?php echo base_url()?>smart/index/" class="btn btn-primary btn-lg" role="button">YES <b  class="glyphicon glyphicon-ok"></b>
          </a>  <a href="<?php echo base_url()?>smart/index/" class="btn btn-default btn-lg" role="button">NO <b  class="glyphicon glyphicon-remove"></b> </a></p>
        </div>
      </div>
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
