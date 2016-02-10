

<h1><?php echo 'Form Pengembalian Buku'; ?></h1>
<div id='isi'>
<?php echo validation_errors(); ?>
<?php echo form_open('pengembalian'); ?>
<fieldset class='filset'>
<legend>Peminjam Buku</legend>
<table width="100%" width="100%">
     <tr>
          <td>Peminjam</td><td>
          <select name='peminjam' id='peminjam'>
               <option value=''>-- PILIH SALAH SATU --</option>
               <?php 
                    $q = $this->AppModel->manualQuery("SELECT a.*, b.user_id, b.namalengkap FROM vw_tampil_pinjam a INNER JOIN tb_user b ON a.user_id = b.user_id where a.status = '2' group by b.namalengkap order by b.namalengkap ASC");
                    foreach($q->result() as $data){
                         echo "<option value='$data->user_id' title='$data->user_id'>$data->namalengkap</option>";
                    }
               ?>
          </select>
          </td>
     </tr>
     <!--
     <tr>
          <td>Judul Buku</td><td>
          <select name='kode_buku' id='kode_buku'>
               <option value=''>-- PILIH SALAH SATU --</option>
               <?php 
                    $q = $this->AppModel->manualQuery("SELECT a.*, b.user_id, b.namalengkap FROM vw_tampil_pinjam a INNER JOIN tb_user b ON a.user_id = b.user_id where a.status = '2'");
                    foreach($q->result() as $data){
                         echo "<option value='$data->kode' title='$data->kode'>".strtoupper(substr($data->judul, 0,50))."...</option>";
                    }
               ?>
          </select>
          </td>
     </tr>
     -->
</table>

<input type='submit' name='tampil' id='tampil' value='Tampilkan Data'>
</fieldset>

<?php echo form_close(); ?>
</div>