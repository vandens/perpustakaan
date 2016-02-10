

<h1><?php echo 'Form Peminjaman Buku'; ?></h1>
<div id='isi'>
<?php echo validation_errors(); ?>
<?php echo form_open('../trx/rent/'); ?>
<fieldset id='fieldset'>
<legend>Form Peminjaman</legend>
<table width="100%">
     <tr>
          <td>Id Peminjaman</td><td>: <input type='text' name='id' id='id' class='input span2' value='Auto Generate' disabled='disabled'></td>
          <td width='150px;'></td>
     </tr>
     <tr>
          <td>Peminjam</td><td>: 
          <select name='user' id='user'>
               <option value=''>-- PILIH SALAH SATU --</option>
               <?php 
                    $q = $this->AppModel->getAllData("tb_user");
                    foreach($q->result() as $data){
                         echo "<option value='$data->user_id' title='$data->user_id'>$data->user_id | $data->namalengkap</option>";
                    }
               ?>
          </select>
          </td>
     </tr>
     
     <tr>
          <td>Judul Buku</td><td>: 
          <select name='kode_buku' id='kode_buku'>
               <option value=''>-- PILIH SALAH SATU --</option>
               <?php 
                    $q = $this->AppModel->getAllData("tb_buku");
                    foreach($q->result() as $data){
                         echo "<option value='$data->kode' title='$data->kode'>".strtoupper(substr($data->judul, 0,50))."...</option>";
                    }
               ?>
          </select>
          </td>
     </tr>
     <tr>
          <td>Tanggal Pinjam</td><td>: <input type='text' name='tgl' id='tgl' class='inputspan2' value='<?=date('Y-m-d');?>'></td>
     </tr>
</table>

<input type='submit' name='save' id='save' value='Simpan Data'>
</fieldset>

<?php echo form_close(); ?>
</div>