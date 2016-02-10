<script type='text/javascript'>

</script>

<h1><?php echo $title; 
foreach($data->result_array() as $dt){ 
	$kode=$dt['kode'];
}
?></h1>

<div id='isi'>
<?php echo validation_errors(); ?>
<?php echo form_open('catalog'); ?>
<fieldset id='fieldset'>
<legend>Detail Buku</legend>
<input type='hidden' name='code' value='<?php echo $dt['kode']; ?>'>
<table>
	<tr>
		<td>Kode Buku</td><td>: <?php echo "<strong>$dt[kode]</strong>"; ?></td>
		<td width='100px;'></td>
		<td>Penerbit</td><td>: <input type='text' name='penerbit' id='penerbit' class='input span2' value='<?php echo $dt['penerbit']; ?>'></td>
	</tr>
	<tr>
		<td>Kategori</td><td>: 
		<select name='jenis' id='jenis'>
			<option value=''>-- Pilih salah satu --</option>
			<option value='<?php echo strtoupper($dt['jenis']); ?>' selected='selected'><?php echo $dt['jenis']; ?></option>
			<?php 
				$q = $this->AppModel->getAllData("tb_jenis");
				foreach($q->result() as $data){
					echo "<option value='$data->jenis'>$data->jenis</option>";
				}
			?>
		</select>  <a href=''><img src="<?php echo base_url('media/img/add.png'); ?>"></a> </td>
		<td width='100px;'></td>
		<td>Tahun</td><td> : <input type='text' name='tahun' id='tahun' class='inputspan1' value='<?php echo $dt['tahun']; ?>'></td>
	</tr>
	<tr>
		<td>Judul Buku</td><td>: <input type='text' name='judul' id='judul' class='input span2' value='<?php echo $dt['judul']; ?>'></td>
		<td width='100px;'></td>
		<td>Stock</td><td>: <input type='text' name='stok' id='stok' class='inputspan1' value='<?php echo $dt['stok']; ?>'></td>
	</tr>
	<tr>
		<td>Pengarang</td><td>: <input type='text' name='pengarang' id='pengarang' class='input span2' value='<?php echo $dt['pengarang']; ?>'></td>
		<td width='100px;'></td>
		<td>Harga (Rp)</td><td>: <input type='text' name='harga' id='harga' class='inputspan2' value='<?php echo $dt['harga']; ?>'></td>
	</tr>
</table>
</fieldset>
<fieldset id='fieldset'>
<legend>Sinopsis</legend>
<textarea class="ckeditor" id="editor1" name="sinopsis"><?php echo $dt['sinopsis']; ?></textarea>
</fieldset>
<br>
<input type='submit' name='update' id='update' value='Update'><input type='submit' name='kembali' value='Back'>
<?php echo form_close(); ?>
</div>