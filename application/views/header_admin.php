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

.alert-success{
  background-color: #6C7A89;
  color: white;
}
.navbar{
  border-radius: 0px;
}
</style>

</head>
<body>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url().'home' ?>" id="fontku">Administrator</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url().'home' ?>">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Entry Matakuliah <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url().'Matakuliah' ?>">MataKuliah</a></li>
						<li><a href="<?= base_url().'minat' ?>">Bidangminat</a></li>

            <li><a href="<?= base_url().'Mk_syarat' ?>">MataKuliah Bersyarat</a></li>

            <li><a href="<?= base_url().'paketmatakuliah' ?>">Paket Matakuliah</a></li>
            <li><a href="<?= base_url().'bidangminat_bersyarat' ?>">Bidang Minat Bersyarat</a></li>
            <li><a href="<?= base_url().'Bidangminat' ?>">Rekomendasi Bidang Minat</a></li>
 <li><a href="<?= base_url().'mk_tawaran' ?>">Matakuliah Yang di Tawarkan</a></li>

 <li><a href="<?= base_url().'SyaratBatasSks' ?>">Syarat batas Sks</a></li>

          </ul>
        </li>


           <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Mahasiswa <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"></a></li>
            <li><a href="<?= base_url().'Mahasiswa' ?>">Data Mahasiswa</a></li>
          <!--  <li><a href="<?= base_url() ?>">Jurusan</a></li> --->
            <li><a href="<?= base_url().'Semester' ?>">Semester</a></li>
            <li><a href="<?= base_url().'Nilai' ?>">Nilai</a></li>
						  <li><a href="<?= base_url().'semestersekarang' ?>">Semester Sekarang</a></li>
          </ul>
        </li>


        <li><a href="<?= base_url().'dpam' ?>">DPAM</a></li>


<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Rule Expert KRS <span class="caret"></span></a>
          <ul class="dropdown-menu">
						<li><a href="<?= base_url().'pertanyaan' ?>">Expert Rule</a></li>
						<li><a href="<?= base_url().'jawaban' ?>">Hasil jawaban</a></li>


          </ul>
        </li>


           <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Jadwal <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"></a></li>
            <li><a href="<?= base_url().'kelas' ?>">Kelas</a></li>
            <li><a href="<?= base_url().'jadwal_mk' ?>">Jadwal Kuliah</a></li>
            <li><a href="<?= base_url().'ruang_kuliah' ?>">Ruangan</a></li>

          </ul>
        </li>




      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?= base_url().'admin' ?>"><span class="glyphicon glyphicon-user"></span>
         <?php echo $email ?></a></li>
        <li><a href="<?php echo base_url().'login/logout' ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
