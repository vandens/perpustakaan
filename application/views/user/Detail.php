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
		$status = 'Active';
	else
		$status = "<font color='red'>Inactive</font>";
}

?>
</h1>

<div id='isi'>
<!--
<fieldset id='fieldset' <?=$disabled;?>>
<legend>User Data Login</legend>
<table>
	<tr>
		<td>User ID</td><td>: <strong><?=$id; ?></strong></td>
		<td width='100px;'></td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Username</td><td>: <?=$dt['username'];?></td>
		<td width='100px;'></td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>User Level</td><td> : <?=$val; ?></td>
		<td></td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Active Code</td><td> : <?=md5($dt['activecode']); ?></td>
		<td></td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Visit</td><td> : <?=$dt['visit']; ?></td>
		<td></td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Last Login</td><td> : <?=$dt['last_login']; ?></td>
		<td></td>
		<td></td><td></td>
	</tr>
</table>
</fieldset>
-->
<p>
<fieldset id='fieldset' <?=$disabled;?>>
<legend>Data Pribadi</legend>
<table>
	<tr>
		<td>Nama Lengkap</td><td>: <?=$dt['namalengkap'];?></td>
		<td width='40px;'></td>
		<td valign='top' width='110px'>Kelas</td><td valign='top'>: <?=$dt['kelas'];?></td>
	</tr>
	<tr>
		<td>Sekolah</td><td> : <?=$dt['sekolah'];?></td>
		<td width='40px;'></td>
		<td>No Telepon #1</td><td> : <?=$dt['notelp'];?></td>
	</tr>
	<tr>
		<td>Email</td><td> : <?=$dt['email'];?></td>
		<td width='40px;'></td>
		<td>No Telepon #2</td><td> : <?=$dt['notelp2'];?></td>
	</tr>
	<tr valign='top'>
		<td>Alamat</td><td width='200px'> : <?=$dt['alamat'];?></td>
		<td width='40px;'></td>
		<td>Status</td><td>: <?=$status;?></td>
	</tr>

</table>
</fieldset>
<br/>
<?php echo form_open('user'); ?>
<input type='hidden' name='user_id' value='<?=$id;?>'>
<input type='hidden' name='email' value='<?=$dt['email'];?>'>
<input type='hidden' name='activecode' value='<?=$dt['activecode'];?>'>
<input type='hidden' name='user' value='<?=$dt['username'];?>'>
<input type='hidden' name='nama' value='<?=$dt['namalengkap'];?>'>
<input type='hidden' name='status' value='<?=$val;?>'>
<input type='submit' name='edit' id='edit' value='Edit Data'>
<!--<input type='submit' name='sendmail' id='sendmail' value='Send Password Via Email'>-->
<input type='submit' name='back' id='back' value='Back'>
<?php echo form_close(); ?>


</div>