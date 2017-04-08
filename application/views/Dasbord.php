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
.starter-template  body {
    padding-top: 5rem;
  }
  .starter-template {
    padding: 2rem 1.5rem;
    text-align: center;
  }
  .lead {
      margin-bottom: 20px;
      font-size: 16px;
      font-weight: 200;
      line-height: 1.4;
      color:#5a5a5a;
  }


</style>



  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

</script>
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





    </div>

  </div>

</nav>


      <div class="container">
<div class="ROW">
  <div class="starter-template">
    <h1>Selamat Datang di SMART KRS</h1>
    <p class="lead">
      Smart Krs ini adalah penerapan sistem berbasis pengetahuan yang menggunakan sistem pakar
      <br> dimana sitem pakar mengambil alih dalam pemrosesan data matakuliah secara otomatis. dalam Aplikasi ini matakuliah prasyarat di terapkan, rekomendasi matakuliah, rekomendasi Bidang Minat di lakukan secara otomatis dilakukan berdasarkan kurikulum Prodi Teknik Informatika. Jika anda ingin melihat kurikulum Prodi Teknik Informatika silahkan <a href="<?php echo base_url()?>assets/kurikulum2013.pdf" class="link">Klik Disini</a> untuk melihat kurikulum <br><br>

    Aplikasi ini di bangun dengan Mesin Inferensi Forward Chaining <br> sehingga Model penyajian Data dalam bentuk Pertanyaan, untuk contohnya dapat lihat <a href="<?php echo base_url() ?>assets/contohsemester3.png" class="link">Disini</a>    </p>
              <p><a class="btn btn-primary btn-lg"
                href="<?php echo base_url()?>loginmhs" role="button">Lanjut KRS &raquo;</a></p>

    </div>



</div>

        </div>



  <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
         <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
         <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
         <script type="text/javascript">
             $(document).ready(function () {
                 $("#mytable").dataTable();
             });
         </script>
     <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>


 <script>
