
<h1><?php echo $title; ?></h1>

<fieldset id='fieldset'>
<legend>Search Menu Item</legend>
<?php echo validation_errors(); ?>
<?php echo form_open('catalog'); ?>
<table>
<tr><td>Item Search</td><td>
<select name='cat' id='cat'>
<option value=''>--- Pilih salah satu ---</option>
<option value='kode'>Kode Buku</option>
<option value='judul'>Judul Buku</option>
<option value='pengarang'>Pengarang</option>
<option value='penerbit'>Penerbit</option>
<option value='tahun'>Tahun Terbit</option>
</select>

</td><td><input type='text' name='item' id='item' value='Ketik kata kunci disini' onblur="if(this.value=='') this.value = 'Ketik kata kunci disini'" onfocus="if(this.value=='Ketik kata kunci disini') this.value=''"></td></tr>

<tr><td>Category</td><td>
<select name='jenis' id='jenis'>
			<option value=''>--- Pilih salah satu  ---</option>
			<?php 
				$q = $this->AppModel->getAllData("tb_jenis");
				foreach($q->result() as $dt){
					echo "<option value='$dt->jenis'>$dt->jenis</option>";
				}
			?>
		</select>
</td><td></td></tr>
<td><input type='submit' name='search' id='search' value='Cari Data'></td><td></td><td></td>
</table>
<?php echo form_close(); ?>
</fieldset>
<br/>
<div id='isi'>
<a href='catalog/addnew'><img src='<?php echo base_url('media/img/add.png'); ?>'> Tambah Baru</a>
<div id='nav'>
	<?php echo $paginator; ?>
</div>

<table border='0px' width='100%' class='TableContent'>
	<tr class='TableHeader'>
		<td width='30px' align='center'>No</td>
		<td width='75px'>Kode Buku</td>
		<td width='100px'>Kategori</td>
		<td>Judul Buku</td>
		<td width='150px'>Pengarang</td>
		<td width='150px'>Penerbit</td>
		<td>Tahun</td>
		<td width='50px' align='center'>Stok</td>
		<td width='50px' align='center'>Action</td>
	</tr>
	<?php
		$no=1;

		foreach($data->result_array() as $dp){
			if($no % 2 == 1)
				$warna = 'ganjil';
			else
				$warna = 'genap';
			$kode = $dp['kode'];
	?>	
	<tr id='TableHover' class='<?php echo $warna; ?>'>
		<td  align='center'><?php echo $no; ?></td>
		<td><?php echo $dp['kode'];?></td>
		<td><?php echo $dp['jenis'];?></td>
		<td><?php echo $dp['judul'];?></td>
		<td><?php echo $dp['pengarang'];?></td>
		<td><?php echo $dp['penerbit'];?></td>
		<td><?php echo $dp['tahun'];?></td>
		<td  align='center'><?php echo $dp['stok'];?></td>
		<td align='center' width='200px' valign='middle'> 
			<?php echo form_open('catalog'); ?>
			<input type='hidden' name='code' value='<?=$kode; ?>'>
			<input type='submit' name='edit' value='Edit'>
			<input type='submit' name='delete' value='Delete' onclick="return confirm('Kamu yakin ingin menghapus data ini??')">
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