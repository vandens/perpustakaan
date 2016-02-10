<h1><?php echo $title; ?></h1>

<div id='isi'>
<div id='nav'>
<?php echo $paginator; ?>
</div>
<div id='crud'>
<a href="<?php echo base_url()."activity/drop"; ?>" onclick="return confirm('Are you sure to DELETE this data?')">Drop Data</a>
<?php echo validation_errors(); ?>
</div>
<table border='0px' width='100%' class='TableContent'>
	<tr class='TableHeader'>
		<td>No</td>
		<td>User Id</td>
		<td>Postal Mail Template</td>
		<td>Status</td>
		<td>Request by</td>
		<td>Date Time</td>
		<td align='center' width='200px' valign='middle'>Action</td>
	</tr>
	<?php
		$no=1;

		foreach($data->result_array() as $dp){
			if($no % 2 == 1)
				$warna = 'ganjil';
			else
				$warna = 'genap';
	?>
		<tr id='TableHover' class='<?php echo $warna; ?>'>
		<td><?php echo $no; ?></td>
		<td><?php echo $dp['user_id'];?></td>
		<td><?php echo $dp['postal_mail_temp'];?></td>
		<td><?php echo $dp['status'];?></td>
		<td><?php echo $dp['requested'];?></td>
		<td><?php echo $dp['timestamp'];?></td>
		<td align='center' width='200px' valign='middle'> 
		<?php echo form_open('report/postalmail'); ?>
			<input type='hidden' name='id' value="<?=$dp['id'];?>">
			<input type='hidden' name='user_id' value='<?=$user_id; ?>'>
			<input type='submit' name='delete' value='Delete Mail' onclick="return confirm('Are you sure to DELETE this data?')">
			<input type='submit' name='viewmail' value='View Mail'>
			<?php echo form_close(); ?>
		</td>
	</tr>
	<?php $no++; } ?>
</table>
<br>
<div id='nav'>
<?php echo $paginator; ?>
</div>
</div>