<script type='text/javascript'>

</script>

<h1><?php echo $title; 
foreach($data->result_array() as $dt){ 
	$kode=$dt['kode'];
}
?></h1>

<div id='isi'>

<?php echo form_open('catalog'); ?>
<input type='hidden' name='code' value='<?php echo $kode; ?>'>
<fieldset id='fieldset' disabled='disabled'>
<legend>Detail Buku</legend>
<table>
	<tr>
		<td>Kode Buku</td><td>: <?php echo $dt['kode']; ?></td>
		<td width='100px;'></td>
		<td>Penerbit</td><td>: <?php echo $dt['penerbit']; ?></td>
	</tr>
	<tr>
		<td>Kategori</td><td>: <?php echo $dt['jenis']; ?></td>
		<td width='100px;'></td>
		<td>Tahun</td><td> : <?php echo $dt['tahun']; ?></td>
	</tr>
	<tr>
		<td>Judul Buku</td><td>: <?php echo $dt['judul']; ?></td>
		<td width='100px;'></td>
		<td>Stok</td><td>: <?php echo $dt['stok']; ?></td>
	</tr>
	<tr>
		<td>Pengarang</td><td>: <?php echo $dt['pengarang']; ?></td>
		<td width='100px;'></td>
		<td></td><td></td>
	</tr>
</table>
</fieldset>
<fieldset id='fieldset'>
<legend>Sinopsis</legend>
<?php echo $dt['sinopsis']; ?>
</fieldset>
<br>
<input type='submit' name='edit' id='edit' value='Edit'><input type='submit' name='kembali' value='Back'>
<?php echo form_close(); ?>
</div>