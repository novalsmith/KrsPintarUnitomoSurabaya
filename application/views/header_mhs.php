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
.label-primary {
     background-color: #22A7F0;
}

.well {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: white;
border:0px;
    border-radius: 0px;
        box-shadow: none;
     padding-top:0px;
     margin-top:0px;
  }
</style>



  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

</script>
</head>
<body>


<nav class="navbar navbar-inverse">
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
  