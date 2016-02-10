<script type='text/javascript'>

</script>

<h1><?php echo $title; ?></h1>

<div id='isi'>
<?php echo validation_errors(); ?>
<?php echo form_open('user'); ?>

<!--
<fieldset id='fieldset'>
<legend>User Data Login</legend>
<table>
	<tr>
		<td width="120px">Username</td><td>: <input type='text' name='user' id='user' class='input span2'></td>
		<td width="75px"></td>
		<td width="120px">Password</td><td> : <input type='password' name='pass' id='pass' class='input span2'  <?php echo $disabled; ?>></td>
	</tr>
	<tr>
		<td>User Level</td><td> : <select name='level' id='level'>
									<option value=''>-- Select One --</option>
									<option value='1'>Administrator</option>
									<option value='2'>User Member</option>
									<option value='3'>Head Office</option>
								</select></td>
		<td width="75px"></td>
		<td>Send Password Via</td><td> : <label><input type='radio' name='sendpwd' value='1' checked='checked'>Email</label>
				   <label><input type='radio' name='sendpwd' value='0'>Postal Mail</label></td>
	</tr>
</table>
</fieldset>
-->

<fieldset id='fieldset'>
<legend>Personal Data</legend>
<table>
	<tr>
		<td  width="120px">Full Name</td><td>: <input type='text' name='nama' id='nama' class='input span2'></td>
		<td  width="75px"></td>
		<td  width="120px">Class</td><td valign='top'>: <input type='text' name='kelas' id='kelas' class='inputspan2'></td>
	</tr>
	<tr>
		<td>Sekolah</td><td> : <input type='text' name='sekolah' id='sekolah' class='input span2'></td>
		<td width='40px;'></td>
		<td>Phone Number #1</td><td> : <input type='text' name='notelp' id='notelp' class='input span2'></td>
	</tr>
	<tr>
		<td>Email</td><td> : <input type='text' name='email' id='email' class='input span2'></td>
		<td width='40px;'></td>
		<td>Phone Number #2</td><td> : <input type='text' name='notelp2' id='notelp2' class='input span2'></td>
	</tr>
	<tr valign='top'>
		<td>Address</td><td>  <textarea name='alamat' id='alamat' class='input span2' rows='4' cols='30'></textarea></td>
		<td width='40px;'></td>
		<td></td><td></td>
	</tr>

</table>
</fieldset>
<br>
<input type='submit' name='save' id='save' value='Save Data'><input type='submit' name='back' id='back' value='Back'>
<?php echo form_close(); ?>


</div>