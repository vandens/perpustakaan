<script type='text/javascript'>
function hapusData(kode){
  var pilih = confirm('Yakin akan menghapus data ini  = '+kode+ '?');
  if (pilih==true) 
  		return true;
  	else
  		return false;  
}
</script>

<h1><?php echo $title; ?></h1>
<fieldset id='fieldset'>
<legend>Search Menu Item</legend>
<?php echo validation_errors(); ?>
<?php echo form_open('catalog/search'); ?>
<table>
<tr><td>Item Search</td><td>
<select name='cat' id='cat'>
<option value=''>--- Select One ---</option>
<option value='kode'>Book Code</option>
<option value='judul'>Book Title</option>
<option value='pengarang'>Authors</option>
<option value='penerbit'>Publisher</option>
<option value='tahun'>Publish Year</option>
</select>

</td><td><input type='text' name='item' id='item' value='Type search item here' onblur="if(this.value=='') this.value = 'Type search item here'" onfocus="if(this.value=='Type search item here') this.value=''"></td></tr>

<tr><td>Category</td><td>
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
<td><input type='submit' name='search' id='search' value='search'><?php //echo anchor('catalog/search','Search'); ?></td><td></td><td></td>
</table>
<?php echo form_close(); ?>
</fieldset>
<div id='isi'>

<div id='nav'>
<?php echo $paginator; ?>
</div>

<div id='crud'>
<img src="<?php echo base_url(); ?>/media/img/add.png ?>"><?php echo anchor('catalog/addnew','Add New'); ?>
<!-- <?php echo '<a href="'.base_url().'catalog/addnew" class="button">Add New</a>'; ?> -->
</div>
<table border='0px' width='100%' class='TableContent'>
	<tr class='TableHeader'>
		<td  align='center'>No</td>
		<td>Code</td>
		<td>Category</td>
		<td>Title</td>
		<td>Authors</td>
		<td>Publisher</td>
		<td>Year</td>
		<td  align='center'>Stock</td>
		<td  align='center'>Action</td>
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
		<td align='center'>Edit | <a href="<?php echo base_url()."catalog/delete/$kode";?>" onclick="hapusData('<?php echo $dp['kode'] ?>')">Delete</a> | <a href="<?php echo base_url()."catalog/detail/$kode";?>">Detail</a></td>
	</tr>
	<?php $no++; } ?>
</table>
<br>
<div id='nav'>
<?php echo $paginator; ?>
</div>
</div>