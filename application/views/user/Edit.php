<h1><?php echo $title;
foreach($data->result_array() as $dt){ 
	$id=$dt['user_id'];

	if($dt['status'] == '1')
	$val = 'Administrator';
	elseif($dt['status'] == '2')
	$val = 'User Member';
	else
	$val = 'Head Office';
	
	if($dt['is_active'] == '1')
		$status = "<label><input type='radio' name='is_active' value='1' checked='checked'> Active</label>
				   <label><input type='radio' name='is_active' value='0'> Inactive</label>";
	else
		$status = "<label><input type='radio' name='is_active' value='1'> Active</label>
				   <label><input type='radio' name='is_active' value='0' checked='checked'><font color='red'>Inactive</font></label>";
}
?></h1>

<div id='isi'>
<?php echo validation_errors(); ?>
<?php echo form_open('user'); ?>
<!-- 
<fieldset id='fieldset'>
<legend>User Member Edit</legend>
<table>
	<tr>
		<td>Username</td><td>: <input type='text' name='user' id='user' class='input span2' value='<?=$dt['username'];?>'></td>
		<td width='100px;'></td>
		<td></td><td> : <input type='password' name='pass' id='pass' class='input span2'></td>
	</tr>
	<tr>
		<td>User Level</td><td> : <select name='level' id='level'>
									<option value='<?php echo $dt['status']; ?>' selected='selected'><? echo $val; ?></option>
									<option value=''>-- Select One --</option>
									<option value='1' disabled='disabled'>Administrator</option>
									<option value='2'>User Member</option>
									<option value='3'>Head Office</option>
								</select></td>
		<td width='100px;'></td>
		<td></td><td> : <input type='password' name='pass2' id='pass2' class='input span2'></td>

	</tr>
	<tr>
		<td>Password</td><td>: <input type='password' name='pass' id='pass' class='input span2' value='<?=$dt['password'];?>' disabled='disabled'></td>
		<td width='100px;'></td>
		<td></td><td></td>
	</tr>
</table>
</fieldset>
-->
<p>
<fieldset id='fieldset'>
<legend>Data Pribadi</legend>
<table>
	<tr>
		<td>Nama Lengkap</td><td>: <input type='text' name='nama' id='nama' class='input span2' value='<?=$dt['namalengkap'];?>'></td>
		<td width='40px;'></td>
		<td valign='top' width='110px'>Kelas</td><td valign='top'>: <input type='text' name='kelas' id='kelas' class='input span2' value='<?=$dt['kelas'];?>'></td>
	</tr>
	<tr>
		<td>Sekolah</td><td> : <input type='text' name='sekolah' id='sekolah' class='input span2' value='<?=$dt['sekolah'];?>'></td>
		<td width='40px;'></td>
		<td>No Telepon #1</td><td> : <input type='text' name='notelp' id='notelp' class='input span2' value='<?=$dt['notelp'];?>'></td>
	</tr>
	<tr>
		<td>Email</td><td> : <input type='text' name='email' id='email' class='input span2' value='<?=$dt['email'];?>'></td>
		<td width='40px;'></td>
		<td>No Telepon #2</td><td> : <input type='text' name='notelp2' id='notelp2' class='input span2' value='<?=$dt['notelp2'];?>'></td>
	</tr>
	<tr valign='top'>
		<td>Alamat</td><td>  <textarea name='alamat' id='alamat' class='input span2' rows='3' cols='25'><?=$dt['alamat'];?></textarea></td>
		<td width='40px;'></td>
		<td>Status</td><td>
		<?=$status;?>
		</td>
	</tr>
</table>
</fieldset>
<br>
<input type='hidden' name='user_id' value='<?=$id;?>'><input type='hidden' name='dt' value='<?=$dt;?>'>
<input type='submit' name='update' id='update' value='Update Data'><input type='submit' name='back' id='back' value='Back'>
<?php echo form_close(); ?>


</div>