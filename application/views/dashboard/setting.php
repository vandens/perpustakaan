<h1><?=$title;?></h1>

<? echo form_open('home/dashboard'); ?>
<? foreach($data->result() as $t){} ?>
<fieldset>
<legend>Headers Setting</legend>
<table>
<input type="hidden" name="id" value="<? echo $t->id;?>">

<tr valign='top'><td width='200px' valign='top'>Nama Aplikasi</td><td>:</td><td><input type='text' name='app_name' value='<? echo $t->app_name;?>' class='input span2'></td></tr>
<tr valign='top'><td width='200px' valign='top'>Nama Sekolah</td><td>:</td><td><input type='text' name='instance_name' value='<? echo $t->instance_name;?>' class='input span2'></td></tr>
<tr valign='top'><td width='200px' valign='top'>Tampilan Data per Halaman</td><td>:</td><td><input type='text' name='limited' value='<? echo $t->limit_page;?>' class='inputspan2'></td></tr>
<tr valign='top'><td width='200px' valign='top'>Lama Peminjaman</td><td>:</td><td><input type='text' name='limit_day' value='<? echo $t->limit_loan;?>' class='inputspan2'></td></tr>
<tr valign='top'><td width='200px' valign='top'>Denda perHari (IDR)</td><td>:</td><td><input type='text' name='fine' value='<? echo $t->fine;?>' class='inputspan2'></td></tr>
<tr valign='top'><td width='200px' valign='top'>Alamat Email Pengirim</td><td>:</td><td><input type='text' name='emailsender' value='<? echo $t->email_def_acc;?>'></td></tr>
<tr valign='top'><td width='200px' valign='top'>Alamat Email CC</td><td>:</td><td><input type='text' name='emailcc' value='<? echo $t->email_def_cc;?>'></td></tr>
</table>
</fieldset>

<fieldset>
<legend>Email Template</legend>
<table>
<!--<tr valign='top'><td width='200px' valign='top'>Email Konfirmasi Password</td><td>:</td><td><textarea name='email_conf_pass' id='editor1' class='ckeditor'><? echo $t->email_conf_pass;?></textarea></td></tr>
<tr valign='top'><td width='200px' valign='top'>Email Lupa Password</td><td>:</td><td><textarea name='email_forgot_pass' id='editor1' class='ckeditor'><? echo $t->email_forgot_pass;?></textarea></td></tr>
-->
<tr valign='top'><td width='200px' valign='top'>Postal Mail</td><td>:</td><td><textarea name='postal_mail' id='editor1' class='ckeditor'><? echo $t->postal_mail;?></textarea></td></tr>
</table>
</fieldset>
<input type='submit' name='save' value='Save'>

<? echo form_close(); ?>