<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->AppModel->setting("tb_setting",'app_name'); ?></title>
   	<link href='<?php echo base_url();?>media/css/bootstrap.css' rel='stylesheet'>
</head>
<body>
<form class="well span5" method="post" action="<?php echo base_url(); ?>login/CheckLogin" style="margin-left:35%; margin-right:25%; margin-top:7%;">
	<fieldset>
	<legend style="background-image:url('<?php echo base_url('media/img/grad.gif'); ?>');
background-repeat:repeat-x; padding:0px; text-align:center; color:white;">Welcome to <?php echo $this->AppModel->setting("tb_setting",'app_name'); ?></legend>
		Silahkan isi form dibawah ini untuk masuk ke system...
		<?php echo "<font color='red'>".validation_errors()."</font>"; ?>
		<div style="margin-left:10%;">
		<label>Username</label>
		<input type="text" name="username" id="username" class="span4" placeholder="Ketik Username disini...">
		<br/><label>Password</label>
		<input type='password' name='password' id='password' class="span4" placeholder="Ketik Password disini...">

		<br>
		<div style="margin-left:60%;">
		<input type='submit' name='login' id='login' value="Login" class="btn btn-primary">
		<input type='button' name='clear' id='clear' value="Clear" class="btn">
		</div>
		</div>
	</fieldset>
	<!--<?php echo anchor('login/forgot_pass','Forgot Password?');?>-->
</form>
</body>
</html>