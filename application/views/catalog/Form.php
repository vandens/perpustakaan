

<h1><?php echo $title; ?></h1>
<div id='isi'>
<?php echo validation_errors(); ?>
<?php echo form_open('catalog'); ?>
<fieldset id='fieldset'>
<legend>Tambah Data Baru</legend>
<table>
	<tr>
		<td>Kode Buku</td><td>: <input type='text' name='kode' id='kode' class='input span2' value='Auto Generate' disabled='disabled'></td>
		<td width='100px;'></td>
		<td>Penerbit</td><td>: <input type='text' name='penerbit' id='penerbit' class='input span2'></td>
	</tr>
	<tr>
		<td>Kategori</td><td>: 
		<select name='jenis' id='jenis'>
			<option value=''>-- Pilih salah satu --</option>
			<?php 
				$q = $this->AppModel->getAllData("tb_jenis");
				foreach($q->result() as $data){
					echo "<option value='$data->jenis'>$data->jenis</option>";
				}
			?>
		</select>  <a href=''><img src="<?php echo base_url('media/img/add.png'); ?>"></a> </td>
		<td width='100px;'></td>
		<td>Tahun</td><td> : <input type='text' name='tahun' id='tahun' class='inputspan1'></td>
	</tr>
	<tr>
		<td>Judul Buku</td><td>: <input type='text' name='judul' id='judul' class='input span2'></td>
		<td width='100px;'></td>
		<td>Stok</td><td>: <input type='text' name='stok' id='stok' class='inputspan1'></td>
	</tr>
	<tr>
		<td>Pengarang</td><td>: <input type='text' name='pengarang' id='pengarang' class='input span2'></td>
		<td width='100px;'></td>
		<td>Harga (IDR)</td><td>: <input type='text' name='harga' id='harga' class='inputspan2'></td>
	</tr>
	<tr>
		<td>Sinopsis</td><td>:</td>
		<td width='100px;'></td>
		<td></td><td></td>
	</tr>
</table>
</fieldset>
<fieldset id='fieldset'>
<legend>Sinopsis</legend>
<textarea class="ckeditor" id="editor1" name="sinopsis"></textarea><br>
</fieldset>
<input type='submit' name='save' id='save' value='Save Data'>
<?php echo form_close(); ?>
</div>