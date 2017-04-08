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


.well {
    min-height: 20px;
    padding: 19px;
    margin-top: 10px;


    background-color: white;
    background-attachment: fixed;


    border-radius:4px;
    box-shadow: 1px 0px 10px 0px black;
}
body{


    background-color: #6C7A89;
}

</style>

</head>
<body id='isi'>




<form action="<?php echo base_url().'logindpam/cek_login' ?>" method="post" accept-charset="utf-8">
	


<div class="col-md-4"></div>


<div class="col-md-4 ">
	<center>
  <img src="<?php echo base_url().'assets/img/logo_unitomo.gif' ?>" alt="SMART KRS INFORMATIKA UNITOMO"></center>

  <div class="col-md-12 well ">
	<h2 id="fontku" align="center">Login DPAM SMART KRS Unitomo</h2>
<br>
     <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
        <div class="form-group">
            <label for="int">Username <br> <?php echo form_error('username') ?></label>
<input type="text" name="username" class="form-control" required="required" placeholder="username">
            </div>



        <div class="form-group">
            <label for="int">Password <br> <?php echo form_error('password') ?></label>
<input type="password" name="password" class="form-control" required="required" placeholder="password">
            </div>

        <div class="form-group">
    
<input type="submit" name="simpan" value="Masuk" class="btn btn-primary" required="required">
            </div>

</div>

</div>



<div class="col-md-4"></div>

</form>


 <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

</script>

</body>
</html>