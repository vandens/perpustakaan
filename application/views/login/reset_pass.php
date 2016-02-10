<h1><?php echo $this->session->userdata('user');?>, Welcome to <?php echo $this->AppModel->setting("tb_setting","app_name"); ?> </h1>
<div id='isi'>

<?php echo form_open('home/changepwd'); ?>
<fieldset id='fieldset' style="margin:auto;">
<legend>Reset Password</legend>
		The system require you to change your password<br> so please change your password to secure your account!
		<br/>
		<?php echo "<font color='red'>".validation_errors()."</font>"; ?>
		<table align="center">
		<tr><td>New Password</td><td><input type='password' name='pass1' id='pass1'></td></tr>
		<tr><td>Confirm New Password</td><td><input type='password' name='pass2' id='pass2'></td></tr>
		<tr><td></td><td align='right'>
		<input type='submit' name='changepwd' id='changepwd' value="Save">
		</td></tr>
		</table>
		<? echo anchor('login/logout','Log Out'); ?>
</fieldset>
<?php echo form_close(); ?>
</div>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('app_name'); ?></title>
	
    <link href="<?php echo base_url(); ?>media/css/login.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>asset/js/jquery172.js" type="text/javascript"></script>
</head>
<body>
<div id="container">

	<h1>Hi, <?php echo $this->session->userdata('user');?> </h1>
	<div id="body">
		 Welcome to <?php echo $this->config->item('app_name'); ?>
		 <br/>
		This is for the first time you login, so please change your password to secure your account!
		<br/>
		<?php echo validation_errors(); ?>
		<?php echo form_open('login/changepwd'); ?>
		<table align="center">
		<tr><td>New Password</td><td><input type='password' name='pass1' id='pass1'></td></tr>
		<tr><td>Confirm New Password</td><td><input type='password' name='pass2' id='pass2'></td></tr>
		<tr><td></td><td align='right'>
		<input type='submit' name='save' id='save' value="Save">
		</td></tr>
		</table>
		</form>
		<? echo anchor('login/logout','Log Out'); ?>
	</div>
	<p class="footer"><?php echo $this->config->item('powered'); ?>  Page rendered in <strong>{elapsed_time}</strong> seconds </p>

-->