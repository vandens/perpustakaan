<h1><?=$title;?></h1>

<? echo form_open('home/dashboard'); ?>
<? foreach($data->result() as $dt){
			$data2 = array('[[USER_ID]]' => $dt->user_id,
					'[[USER]]' => $dt->username,
					'[[PASSWORD]]' => $dt->activecode,
					'[[STATUS]]' => $dt->status,
					'[[FULLNAME]]' => $dt->namalengkap,
					'[[APP_NAME]]' => $this->AppModel->setting("tb_setting","app_name"),
					'[[POWERED]]' => $this->config->item('powered'));
	}

	$mailTemp = $this->AppModel->setting("tb_setting",$dt->postal_mail_temp);
	$content = strtr($mailTemp,$data2);

} ?>
<fieldset>
<legend>Detail Account View From Postal Mail</legend>
<table>

<tr valign='top'><?=$content;?></td></tr>
</table>
</fieldset>
<input type='submit' name='save' value='Save'>

<? echo form_close(); ?>