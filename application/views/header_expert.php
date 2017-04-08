<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $judul; ?></title>
      <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>


<style type="text/css">
@font-face{
    font-family: "ballpark";
    src: url("<?php echo base_url().'assets/bootstrap/fonts/1.otf' ?>");
}


#fontku {
  font-family: "ballpark";
  font-weight: bold;
}
.navbar-inverse
{
  background-color: #373a3c;
}
.btn-primary
{
  background-color: #22A7F0;
  border: none;

}
.btn
{
  border-radius:0px;
}
.btn-primary:hover{
  background-color: #34495E;
  color: white;
  border: none;
}
.pagination>.active>a
{
    background-color: #22A7F0;
    border: none;
}
.pagination>.active>a:hover
{
    background-color: #34495E;
  color: white;
  border: none;
}
.navbar-collapse .text-muted {
  color: #818a91;
}
.jumbotron .container {
  max-width: 40rem;
}

.jumbotron-heading {
  font-weight: 300;
}
  .jumbotron
  {
      padding-top: 6rem;
  padding-bottom: 6rem;
  margin-bottom: 0;
  background-color: #fff;
  }

.btn-default:hover {
    color: white;
    background-color: #34495E;
    border-color: white;
}
.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:focus
{
  background-color: #6C7A89;
}
.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover, .navbar-inverse .navbar-nav>.open>a:focus
{
  background-color: #6C7A89;
}


.navbar{
  border-radius: 0px;
}
#fixatas
{

}
.label-primary {

background-color:#22A7F0;
}
.well {

    padding: 19px;
    min-height: 20px;
    background-color: white;
    margin-bottom: 20px;
    border-radius: 0px;
    border:0px;
        box-shadow: none;
     padding-top:0px;
     margin-top:0px;
  }



</style>
</head>
<body>










<nav class="navbar navbar-default" id="fixatas">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url().'home' ?>" id="fontku">Smart KRS Unitomo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
       <li class="active"> <a href="#" data-toggle="collapse" data-target="#demo"> <p class="glyphicon glyphicon-dashboard"></p>  Lihat History Matakuliah</a>
  </li>



      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?= base_url().'admin' ?>"><span class="glyphicon glyphicon-user"></span>
         <?php echo $nama_mahasiswa ?></a></li>
        <li><a href="<?php echo base_url().'loginmhs/logout' ?>" class=""><span class="glyphicon glyphicon-log-in"></span> Simpan</a></li>
      </ul>
    </div>

  </div>

</nav>

<div class="container">
<div class="col-md-12">

   <table class='table table-bordered' id="tabs">
        <tr>
            <td width='150'>NAMA</td><td><?php echo  $this->session->userdata('nama_mahasiswa'); ?></td>
            <td width='100'>NIM</td><td><?php echo  $this->session->userdata('nim'); ?></td>

             <td width='150'>SKS MAX</td>
             <td>



                <?php
                $mhs = $this->session->userdata('id_mahasiswa');
                $dataget = $this->db->query('select max(semester_aktif) as semester_sekarang from entry where id_mahasiswa='.$mhs)->row();

                $semester_sekarang = $this->db->get('semester_sekarang')->row();
               ?>
                <?php if ($semester_sekarang->sekarang == 'Ganjil'):?>
               <?php if ( $max_semester->total=="" ||$max_semester->total ==1 ):?>

                 <!--ipk-->
                 <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
                  join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=1')->row();
                 $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
                  join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=1')->row();
                 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
                 $view_ipk = number_format($ipk,2)   ;
                  ?>

                  <?php if ($view_ipk >=3.00 ): ?>
                     <a href="#" class="btn-primary btn-primary btn-sm"> 24</a>
                  <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                       <a href="#" class="btn-primary btn-primary btn-sm"> 21</a>
                  <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
                     <a href="#" class="btn-primary btn-primary btn-sm"> 18</a>
                  <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                     <a href="#" class="btn-primary btn-primary btn-sm"> 15</a>
                  <?php elseif($view_ipk <=1.99): ?>
                     <a href="#" class="btn-primary btn-primary btn-sm"> 12</a>
                    <?php else: ?>

                  <p>Maff, untuk sementara Belum ada IPK</p>
                  <?php endif; ?>


                 <?php elseif ($max_semester->total==3 or $max_semester->total==2):?>

                    <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
                    join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=2')->row();
                   $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
                    join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=2')->row();
                   $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
                   $view_ipk = number_format($ipk,2)   ;
                    ?>

                    <?php if ($view_ipk >=3.00 ): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 24</a>
                    <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                        <a href="#" class="btn-primary btn-primary btn-sm"> 21</a>
                    <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 18</a>
                    <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 15</a>
                    <?php elseif($view_ipk <=1.99): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 12</a>
                      <?php else: ?>

                    <p>Maff, untuk sementara Belum ada IPK</p>
                    <?php endif; ?>

                 <?php elseif ($max_semester->total==5 or $max_semester->total==4) :?>

                    <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
                    join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=4')->row();
                   $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
                    join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=4')->row();
                   $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
                   $view_ipk = number_format($ipk,2)   ;
                    ?>

                    <?php if ($view_ipk >=3.00 ): ?>
                    <a href="#" class="btn-primary btn-primary btn-sm"> 24</a>
                    <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 21</a>
                    <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
                    <a href="#" class="btn-primary btn-primary btn-sm"> 18</a>
                    <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                    <a href="#" class="btn-primary btn-primary btn-sm"> 15</a>
                    <?php elseif($view_ipk <=1.99): ?>
                    <a href="#" class="btn-primary btn-primary btn-sm"> 12</a>
                      <?php else: ?>

                    <p>Maff, untuk sementara Belum ada IPK</p>
                    <?php endif; ?>

                 <?php elseif ($max_semester->total>=7 or $max_semester->total==6) :?>
 
                    <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
                    join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=6')->row();
                   $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
                    join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=6')->row();
                   $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
                   $view_ipk = number_format($ipk,2)   ;
                    ?>

                    <?php if ($view_ipk >=3.00 ): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 24</a>
                    <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                        <a href="#" class="btn-primary btn-primary btn-sm"> 21</a>
                    <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 18</a>
                    <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 15</a>
                    <?php elseif($view_ipk <=1.99): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 12</a>
                      <?php else: ?>

                    <p>Maff, untuk sementara Belum ada IPK</p>
                    <?php endif; ?>


                 <?php else:?>
               <p>semester ganjil belum ada mahasiswa</p>


               <?php endif;?>


               <?php else:?>
                <?php if ($max_semester->total==2 or $max_semester->total==1):?>

                  <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
                   join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=1')->row();
                  $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
                   join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=1')->row();
                  $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
                  $view_ipk = number_format($ipk,2)   ;
                   ?>

                   <?php if ($view_ipk >=3.00 ): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 24</a>
                   <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                        <a href="#" class="btn-primary btn-primary btn-sm"> 21</a>
                   <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 18</a>
                   <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 15</a>
                   <?php elseif($view_ipk <=1.99): ?>
                      <a href="#" class="btn-primary btn-primary btn-sm"> 12</a>
                     <?php else: ?>

                   <p>Maff, untuk sementara Belum ada IPK</p>
                   <?php endif; ?>


               <?php elseif ($max_semester->total==4 or $max_semester->total==3) :?>


                 <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
                  join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=3')->row();
                 $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
                  join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=3')->row();
                 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
                 $view_ipk = number_format($ipk,2)   ;
                  ?>

                  <?php if ($view_ipk >=3.00 ): ?>
                     <a href="#" class="btn-primary btn-primary btn-sm"> 24</a>
                  <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                       <a href="#" class="btn-primary btn-primary btn-sm"> 21</a>
                  <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
                     <a href="#" class="btn-primary btn-primary btn-sm"> 18</a>
                  <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                     <a href="#" class="btn-primary btn-primary btn-sm"> 15</a>
                  <?php elseif($view_ipk <=1.99): ?>
                     <a href="#" class="btn-primary btn-primary btn-sm"> 12</a>
                    <?php else: ?>

                  <p>Maff, untuk sementara Belum ada IPK</p>
                  <?php endif; ?>

               <?php elseif ($max_semester->total==6 or $max_semester->total==5):?>


                 <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
                  join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18
                   and s.nama_semester=5')->row();
                
                 $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
                  join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 
                  and s.nama_semester=5')->row();
                 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
                 $view_ipk = number_format($ipk,2)   ;
                  ?>

                  <?php if ($view_ipk >=3.00 ): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 24</a>
                  <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 21</a>
                  <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 18</a>
                  <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 15</a>
                  <?php elseif($view_ipk <=1.99): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 12</a>
                    <?php else: ?>

                  <p>Maff, untuk sementara Belum ada IPK</p>
                  <?php endif; ?>

               <?php elseif ($max_semester->total>=8 or $max_semester->total==7) :?>


                 <?php $bobot_dan_sks = $this->db->query('SELECT sum(n.bobot * n.sks) as total from nilai n
                  join semester s on n.id_semester=s.id_semester where n.id_mahasiswa=18 and s.nama_semester=7')->row();
                 $maks_sks      = $this->db->query('SELECT sum(n.sks) as sks_maks from nilai n
                  join semester s on n.id_semester=s.id_semester 
                  where n.id_mahasiswa=18 and s.nama_semester=7')->row();

                 $ipk = $bobot_dan_sks->total /   $maks_sks->sks_maks;
                 $view_ipk = number_format($ipk,2)   ;
                  ?>

                  <?php if ($view_ipk >=3.00 ): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 24</a>
                  <?php elseif($view_ipk >=2.50 AND $view_ipk <=2.99): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 21</a>
                  <?php elseif($view_ipk >=2.00 AND $view_ipk <=2.49): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 18</a>
                  <?php elseif($view_ipk >=1.50 AND $view_ipk <=1.99): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 15</a>
                  <?php elseif($view_ipk <=1.99): ?>
                  <a href="#" class="btn-primary btn-primary btn-sm"> 12</a>
                    <?php else: ?>

                  <a href="#" class="btn-primary btn-primary btn-sm"> Maff, untuk sementara Belum ada IPK</a>
                  <?php endif; ?>


               <?php else: ?>

                  <a href="#" class="btn-primary btn-primary btn-sm"> semester genap belum ada mahasiswa</a>

               <?php endif;?>
               <?php endif;?>


         </td>

            <td rowspan='2' width='70'>
            <img src="<?php echo base_url()?>assets/img/noprofile.gif" width="50"></td>
        </tr>


        <tr>

            <td>Prodi, Konsentrasi</td><td>Teknik Informatika</td>
            <td>Semester</td><td>

<?php
$mhs = $this->session->userdata('id_mahasiswa');
$dataget = $this->db->query('select max(semester_aktif) as semester_sekarang from entry where id_mahasiswa='.$mhs)->row();

$semester_sekarang = $this->db->get('semester_sekarang')->row();

if ($semester_sekarang->sekarang == 'Ganjil')
 //if ini berguna untuk semester ganjil
{

 if ( $max_semester->total=="" ||$max_semester->total ==1 )
 {
   echo "1";

 }elseif ($max_semester->total==3 or $max_semester->total==2) {
   # code...
   echo "3";

 }elseif ($max_semester->total==5 or $max_semester->total==4) {
   # code...
   echo "5";

 }elseif ($max_semester->total>=7 or $max_semester->total==6) {
   # code...
   echo "7";

 }else {
   # code...
   echo "semester ganjil belum ada mahasiswa";

 }


}

else // else ini berguna untuk semester genap
{
  if ($max_semester->total==2 or $max_semester->total==1) {
    # code...
    echo "2";
  }elseif ($max_semester->total==4 or $max_semester->total==3) {
    # code...
    echo "4";
  }elseif ($max_semester->total==6 or $max_semester->total==5) {
    # code...
    echo "6";
  }elseif ($max_semester->total>=8 or $max_semester->total==7) {
    # code...
    echo "8";
  }else {
    # code...
    echo "semester genap belum ada mahasiswa";

  }
}
 ?>
            </td>
            <td>IPS</td><td>

<?php
echo $view_ipk;
 ?>


            </td>

        </tr>

        </table>
</div>
</div>
