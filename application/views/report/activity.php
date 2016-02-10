<h1><?php echo $title; ?></h1>

<div id='isi'>
<div id='nav'>
<?php echo $paginator; ?>
</div>
<div id='crud'>
<!--<a href="<?php echo base_url()."report/drop"; ?>" onclick="return confirm('Are you sure to DELETE this data?')">Drop Data</a>-->
<br>
<?php echo validation_errors(); ?>
</div>
<table border='0px' width='100%' class='TableContent'>
	<tr class='TableHeader'>
		<td>No</td>
		<td>Username</td>
		<td>Activity Record</td>
		<td>Detail Activity Record</td>
		<td>IP Address</td>
		<td>Date Time</td>
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
		<td><?php echo $dp['sess_id'];?></td>
		<td><?php echo $dp['last_act'];?></td>
		<td><?php echo $dp['notes'];?></td>
		<td><?php echo $dp['ip'];?></td>
		<td><?php echo $dp['time'];?></td>
	</tr>
	<?php $no++; } ?>
</table>
<br>
<div id='nav'>
<?php echo $paginator; ?>
</div>
</div>