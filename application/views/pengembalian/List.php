<h1><?php echo $title; ?></h1>

<fieldset id='fieldset'>
<legend>Form Pencarian</legend>
<?php echo validation_errors(); ?>
<?php echo form_open('pengembalian'); ?>
<table>
<tr><td>Item Pencarian</td><td>
<select name='cat' id='cat'>
<option value=''>--- Pilih salah satu ---</option>
<option value='id'>Kode Peminjaman</option>
<option value='kode'>Kode Buku</option>
<option value='namalengkap'>Peminjam</option>
<option value='judul'>Judul Buku</option>
</select>

</td><td><input type='text' name='item' id='item' value='Ketik kata kunci disini' onblur="if(this.value=='') this.value = 'Ketik kata kunci disini'" onfocus="if(this.value=='Ketik kata kunci disini') this.value=''"></td></tr>

<tr><td>Status Peminjaman</td><td>
<select name='status' id='status'>

	<option value=''>--- Pilih salah satu ---</option>
	<option value='1'>Menunggu</option>
	<option value='2'>Dipinjam</option>
	<option value='3'>Komplit</option>
	<option value='4'>Ditolak</option>
</select>
</td><td></td></tr>
<td><input type='submit' name='search' id='search' value='Set Filter'></td><td></td><td></td>
</table>
<?php echo form_close(); ?>
</fieldset>
<br/>
<div id='isi'>
 <a href="pengembalian/kembali" onclick="PopUp(this.href);return false"><img src="<?php echo base_url('media/img/add.png'); ?>"> Pengembalian Buku</A>
<div id='nav'>
	<?php echo $paginator; ?>
</div>

<table border='0px' width='100%' class='TableContent'>
	<tr class='TableHeader' align='center'>
		<td width='30px' align='center'>No</td>
		<td width='75px'>Kode Pinjam</td>
		<td width='100px'>Peminjam</td>
		<td width=''>Judul Buku</td>
		<td width="125px">Tgl Pinjam</td>
		<td width='125px'>Tgl Wjb Kembali</td>
		<td width='35px'>Status</td>
		<td width='50px'>Telat (Hari)</td>
		<td width='50px'>Denda (Rp)</td>
	</tr>
	<?php
		$no=1;

		foreach($data->result_array() as $dp){
			if($no % 2 == 1)
				$warna = 'ganjil';
			else
				$warna = 'genap';
			

			$kode = $dp['id'];
			if($dp['status'] == 1){
				$flag = '<img src="'.base_url('media/img/21.png').'" title="Menunggu Persetujuan">';
			}elseif($dp['status'] == 2){
				$flag = '<img src="'.base_url('media/img/22.png').'" title="Sedang Dipinjam">';
			}elseif($dp['status'] == 3){
				$flag = '<img src="'.base_url('media/img/23.png').'" title="Sudah Dikembalikan">';
			}elseif($dp['status'] == 4){
				$flag = '<img src="'.base_url('media/img/24.png').'" title="Peminjaman Ditolak">';
			}

			if($dp['tgl_wjb_kembali'] != NULL){
			$x	 	= $this->AppModel->setting("tb_setting","fine");
			$skg = date('Y-m-d');

			$pecah1 = explode("-", $dp['tgl_wjb_kembali']);
			$tgl1 	= $pecah1[2];
			$bln1 	= $pecah1[1];
			$thn1 	= $pecah1[0];
			$pecah2 = explode("-", $skg);
			$tgl2 	= $pecah2[2];
			$bln2 	= $pecah2[1];
			$thn2	= $pecah2[0];
			$jd1 = GregorianToJD($bln1, $tgl1, $thn1);
			$jd2 = GregorianToJD($bln2, $tgl2, $thn2);
			$selisih = $jd2-$jd1;

				if($selisih > 0){
					$denda = $selisih * $x;
					$hari = $selisih;
				}else{
					$denda = '0';
					$hari 	= '0';
				}


			}else{
				$denda = '0';
				$selisih = '0';
			}


	?>	
	<tr id='TableHover' class='<?php echo $warna; ?>' align='center'>
		<td><?php echo $no; ?></td>
		<td><?php echo $dp['id'];?></td>
		<td align='left'><?php echo $dp['namalengkap'];?></td>
		<td  align='left' width='300px'><?php echo $dp['judul'];?></td>
		<td><?php echo $this->AppModel->tgl_indo($dp['tgl_pinjam']); ?></td>
		<td><?php echo $this->AppModel->tgl_indo($dp['tgl_wjb_kembali']); ?></td>
		<td><?php echo $flag;?></td>
		<td width='30px'><?php echo $hari;?></td>
		<td width='30px'><?php echo $denda; ?></td>
		
	</tr>
	<?php 
	$no++; } ?>
</table>
<div id='nav'>
<?php echo $paginator; ?>
</div>
</div>