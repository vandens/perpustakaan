
<h1><?php echo $title; ?></h1>

<fieldset id='fieldset'>
<legend>Search Menu Item</legend>
<?php echo validation_errors(); ?>
<?php echo form_open('user'); ?>
<table>
<tr><td>Pencarian</td><td>
<select name='cat' id='cat'>
<option value=''>--- Pilih salah satu ---</option>
<option value='user_id'>ID User</option>
<option value='namalengkap'>Nama</option>
<option value='sekolah'>Sekolah</option>
<option value='kelas'>Kelas</option>
<option value='email'>Email</option>
<option value='notelp'>No Telepon</option>
<option value='alamat'>Alamat</option>
<!-- <option value='status'>Status aktif</option>-->
</select>

</td><td><input type='text' name='item' id='item' value='Ketik kata kunci disini' onblur="if(this.value=='') this.value = 'Ketik kata kunci disini'" onfocus="if(this.value=='Ketik kata kunci disini') this.value=''"></td></tr>

<!-- <tr><td>Category</td><td>
<select name='jenis' id='jenis'>
			<option value=''>--- Select One ---</option>
			<?php 
				$q = $this->AppModel->getAllData("tb_jenis");
				foreach($q->result() as $dt){
					echo "<option value='$dt->jenis'>$dt->jenis</option>";
				}
			?>
		</select>
</td><td></td></tr>
-->
<td><input type='submit' name='search' id='search' value='Search'></td><td></td><td></td>
</table>
<?php echo form_close(); ?>
</fieldset>


<br/>
<div id='isi'>
<a href='user/addnew'><img src="<?php echo base_url('media/img/add.png'); ?>"> Tambah Baru</a>
<div id='nav'>
	<?php echo $paginator; ?>
</div>

<table border='0px' width='100%' class='TableContent'>
	<tr class='TableHeader'  align='center'>
		<td width='30px' align='center'>No</td>
		<td width='75px'>ID User</td>
	<!--	<td width='125px' align='left'>User Name</td> -->
		<td width='200px' align='left'>Nama Lengkap</td>
		<td width='100px'>Status</td>
		<td width='25px'>Kelas</td>
		<td>Email</td>
		<td width='100px'>No Telepon</td>
		<td>Aktif</td>
		<td width='225px'>Action</td>
	</tr>
	<?php
		$no=1;

		foreach($data->result_array() as $dp){
			if($no % 2 == 1)
				$warna = 'ganjil';
			else
				$warna = 'genap';
				$user_id = $dp['user_id'];
			if($dp['is_active'] == 1)
				$aktif = "<img src='".base_url('media/img/ok.png')."' title='Active'>";
			else
				$aktif = "<img src='".base_url('media/img/not_ok.png')."' title='Inactive'>";
			if($dp['status'] == 1)
				$level = "Administrator";
			elseif($dp['status'] == 2)
				$level = "User Member";
			elseif($dp['status'] == 3)
				$level = "Head Office";
	?>	
	<tr id='TableHover' class='<?php echo $warna; ?>'>
		<td  align='center'><?php echo $no; ?></td>
		<td><?php echo $dp['user_id'];?></td>
	<!--	<td><?php echo $dp['username'];?></td> -->
		<td><?php echo $dp['namalengkap'];?></td>
		<td align='center'><?php echo $level; ?></td>
		<td align='center'><?php echo $dp['kelas'];?></td>
		<td><?php echo $dp['email'];?></td>
		<td><?php echo $dp['notelp'];?></td>
		<td align='center'><?php echo $aktif;?></td>
		<td align='center' width='200px' valign='middle'> 
			<?php echo form_open('user'); ?>
			<input type='hidden' name='user_id' value='<?=$user_id; ?>'>
			<input type='submit' name='edit' value='Edit'>
			<input type='submit' name='delete' value='Delete' onclick="return confirm('Are you sure to DELETE this data?')">
			<input type='submit' name='detail' value='Detail'>
			<?php echo form_close(); ?>
		</td>
	</tr>
	<?php 
	$no++; } ?>
</table>
<div id='nav'>
<?php echo $paginator; ?>
</div>
</div>