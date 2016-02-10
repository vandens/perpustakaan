<script type="text/javascript" src="<?php echo base_url('media/js/jquery.js'); ?>"></script>
<script>
jQuery(function($) {
 $("form input[id='check_all']").click(function() { // triggred check

   var inputs = $("form input[type='checkbox']"); // get the checkbox

   for(var i = 0; i < inputs.length; i++) { // count input tag in the form
   var type = inputs[i].getAttribute("type"); //  get the type attribute
    if(type == "checkbox") {
     if(this.checked) {
      inputs[i].checked = true; // checked
     } else {
      inputs[i].checked = false; // unchecked
       }
    }
  }
 });

  $("form input[id='delete']").click(function() {  // triggred submit

   var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
  if(count_checked == 0) {
   alert("Please select a product(s) to delete.");
   return false;
  }
  if(count_checked == 1) {
   return confirm("Are you sure you want to delete these product?");
  } else {
   return confirm("Are you sure you want to delete these products?");
    }
 });
}); // jquery end


</script>


<h1><?php echo "Daftar Peminjaman Buku"; ?></h1>

<div id='isi'>
<form name="form1" method="post" action="<?=base_url()?>peminjaman">
<table border='0px' width='100%' class='TableContent'>
	<tr class='TableHeader'>
		<td width='30px' align='center'>No</td>
		<td width='75px'>Kode Pinjam</td>
		<td width='100px'>Peminjam</td>
		<td width=''>Judul Buku</td>
		<td width='125px'>Tgl Order</td>
		<td width='50px'>Status</td>
		<td width='80px' align='center'>Check All<br><input type="checkbox" id="check_all" value=""></td>
	</tr>
	<?php
		$no=1;
	if ($data->num_rows() > 0){
		foreach($data->result_array() as $dp){
			if($no % 2 == 1)
				$warna = 'ganjil';
			else
				$warna = 'genap';
			

			$kode = $dp['id'];
				if($dp['status'] == 1){
					$flag = '<img src="'.base_url('media/img/21.png').'" title="Menunggu Persetujuan">';
				}
			$btn = "enabled='enabled'";

	?>	
	<tr id='TableHover' class='<?php echo $warna; ?>'>
		<td  align='center'><?php echo $no; ?></td>
		<td><?php echo $dp['id'];?></td>
		<td><?php echo $dp['namalengkap'];?></td>
		<td><?php echo $dp['judul'];?></td>
		<td><?php echo $this->AppModel->tgl_indo($dp['tgl_order']); ?></td>
		<td><?php echo $flag;?></td>
		<td align='center' valign='middle'> 
		<input name="checkbox[]" type="checkbox" id="checkbox[]" value="<? echo $dp['id']; ?>">
		</td>
	</tr>
	<?php 
	$no++; 	} 

	}else{
		$btn = "disabled='disabled'";
	}?>
</table>
	<div style="float:right;">
			<input type='hidden' name='id' value='<?=$kode; ?>'>
			<input type='submit' name='approve' value='Setujui' <?=$btn;?>>
			<input type='submit' name='reject' value='Tolak' <?=$btn;?> onclick="return confirm('Anda yakin ingin menolak peminjaman ini?')">
			<input type='submit' name='delete' value='Hapus' <?=$btn;?> onclick="return confirm('Anda yakin ingin menghapus peminjaman ini?')">
		
	</div>
		<?php echo form_close(); ?>
	<br>
</div>
