<style type="text/css" media="screen">
	body
	{
		background-image: url(<?=base_url().'asset/img/pohon.jpg' ?>);
	}
	#user
	{
		height: 30px;
	}
	#a
	{
		box-shadow: 2px 13px 15px black;
	}
</style>



<?php $this->load->view('header'); ?>

<div class="container">
	<div class="row">

	<div class="span4">	</div>

	<div class="span4 well" id="a" style="border:4px solid #4A89DC;margin-top:10%;">	
	<?=$this->session->flashdata('pesan_login');  ?>
		<?=$this->session->flashdata('pesan_kesalahan');  ?>

<legend><?=$admin_judul ?></legend>

<?php echo form_open(base_url().'login/index'); ?>


  <?php if (! empty($pesan)) : ?>
        <p class="text text-error">
            <?php echo $pesan; ?>
        </p>
    <?php endif ?>


<?php

$username = array(
			'name' 		=> 'username',
			'class'		=> 'span4',
			'id'		=>	'user',
			'placeholder' => ' Masukan Username Anda',
			'required'  => 'masukan');

echo form_label('Username');
echo form_input($username);
 echo form_error('username', '<p class="text-error">', '</p>');
 ?>
 <?php
$password = array(
			'name' 		=> 'password',
			'class'		=> 'span4',
			'id'		=>	'user',
			'type'		=>	'password',
			'placeholder' => ' Masukan Password Anda',
				'required'  => 'masukan' );

echo form_label('Password');
echo form_input($password);
 echo form_error('password', '<p class="text-error">', '</p>');

 ?>



<button type="submit" class="btn btn-primary"><i class="icon icon-white icon-th-large"></i> Login Masuk</button>

<?php echo form_close()?>







	</div>
	<div class="span4">	</div>



	</div>
</div>



<?php $this->load->view('footer'); ?>
