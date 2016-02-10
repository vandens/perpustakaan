<h1><?php echo $title; ?></h1>
<div id='isi'>
<div id='nav'>
	<?php echo $paginator; ?>
</div>

<table border='0px' width='100%' class='TableContent'>
	<tr class='TableHeader'>
		<td width='30px' align='center'>No</td>
		<td width='75px'>Kode Pinjam</td>
		<td width='100px'>Peminjam</td>
		<td width=''>Judul Buku</td>
		<td width='125px'>Tgl Order</td>
		<td width="125px">Tgl Pinjam</td>
		<td width='125px'>Tgl Wjb Kembali</td>
		<td width='150px'>Status</td>
		<td width='100px'>Denda</td>
		<td width='50px' align='center'>Action</td>
	</tr>
	<?php
		$no=1;

		foreach($data->result_array() as $dp){
			if($no % 2 == 1)
				$warna = 'ganjil';
			else
				$warna = 'genap';
			$kode = $dp['id'];
			if($dp['status'] == 1)
				$flag = '<img src="/media/img/21.png" title="Menunggu Persetujuan">';
			elseif($dp['status'] == 2)
				$flag = '<img src="/media/img/22.png" title="Sedang Dipinjam">';
			elseif($dp['status'] == 3)
				$flag = '<img src="/media/img/23.png" title="Sudah Dikembalikan">';
			elseif($dp['status'] == 4)
				$flag = '<img src="/media/img/24.png" title="Peminjaman Ditolak">';

	?>	
	<tr id='TableHover' class='<?php echo $warna; ?>'>
		<td  align='center'><?php echo $no; ?></td>
		<td><?php echo $dp['id'];?></td>
		<td><?php echo $dp['namalengkap'];?></td>
		<td><?php echo $dp['judul'];?></td>
		<td><?php echo $this->AppModel->tgl_indo($dp['tgl_order']); ?></td>
		<td><?php echo $this->AppModel->tgl_indo($dp['tgl_pinjam']); ?></td>
		<td><?php echo $this->AppModel->tgl_indo($dp['tgl_wjb_kembali']);?></td>
		<td><?php echo $flag;?></td>
		<td><?php echo $dp['denda'];?></td>
		<td align='center' width='200px' valign='middle'> 
			<?php echo form_open('trx/rent'); ?>
			<input type='hidden' name='id' value='<?=$kode; ?>'>
			<input type='submit' name='approve' value='Approve'>
			<input type='submit' name='reject' value='Reject' onclick="return confirm('Anda yakin ingin menolak peminjaman ini?')">
			<!--
			<input type='submit' name='delete' value='Delete' onclick="return confirm('Anda yakin ingin menghapus peminjaman ini?')">
			-->
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