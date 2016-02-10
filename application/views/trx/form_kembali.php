

<h1><?php echo $title; ?></h1>
<div id='isi'>
<?php echo validation_errors(); ?>
<?php echo form_open('catalog'); ?>
<fieldset id='fieldset'>
<legend>Loan Form</legend>
<table width="100%">
	<tr>
		<td>Loan Id</td><td>: <input type='text' name='kode' id='kode' class='input span2' value='Auto Generate' disabled='disabled'></td>
		<td width='150px;'></td>
	</tr>
	<tr>
		<td>Book Code</td><td>: 
		<select name='jenis' id='jenis'>
			<option value=''>-- SELECT ONE --</option>
			<?php 
				$q = $this->AppModel->getAllData("tb_buku");
				foreach($q->result() as $data){
					echo "<option value='$data->kode' title='$data->kode'>".strtoupper(substr($data->judul, 0,50))."...</option>";
				}
			?>
		</select></td>
	</tr>
	<tr>
		<td>Book Title</td><td>: <input type='text' name='judul' id='judul' class='input span2'></td>
		<td width='100px;'></td>
	</tr>
	<tr>
		<td>Authors</td><td>: <input type='text' name='pengarang' id='pengarang' class='input span2'></td>
		<td width='100px;'></td>
		
	</tr>
</table>
</fieldset>

<input type='submit' name='save' id='save' value='Save Data'>
<?php echo form_close(); ?>
</div>