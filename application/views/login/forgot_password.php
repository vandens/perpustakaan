<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->AppModel->setting("tb_setting",'app_name'); ?></title>
   	<link href='<?php echo base_url();?>media/css/bootstrap.css' rel='stylesheet'>
</head>
<body>
<form class="well span5" method="post" action="<?php echo base_url(); ?>login/forgot_pass" style="margin-left:35%; margin-right:25%; margin-top:7%;">
	<fieldset>
	<legend style="background-color:darkgreen; padding:0px; text-align:center; color:white;">Welcome to <?php echo $this->AppModel->setting("tb_setting",'app_name'); ?></legend>
		Please input your email that has been registered before
		<?php echo "<font color='red'>".validation_errors()."</font>"; ?>
		<div style="margin-left:10%;">
		<label>Email Address</label>
		<input type='email1' name='email' id='email' placeholder='Type Email address here...' class='span4'>
		<br><br>
		<div style="margin-left:80%;">
		<input type='submit' name='sendpass' id='sendpass' value="Send" class="btn btn-primary">
		</div>
		</div>
	</fieldset>
	<?=anchor('home','Back');?>
</form>
</body>
</html>