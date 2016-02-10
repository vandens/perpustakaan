<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller{
	
	/*
		###	Controller : Email.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/

	function index()
	{
		$config = array(
			'protocol'		=> 'smtp',
			'smtp_crypto'	=> 'ssl',
			'smtp_host'		=> 'smtp.gmail.com',
			'smtp_port'		=> 465,
			'smtp_user'		=> 'topan.pandenis@gmail.com',
			'$smtp_pass'	=>	'mcmaddens',
			'mailtype'		=> 'text',
			'charset'		=> 'iso-8859-1'
		);

		$this->load->library('email',$config);
		$this->email->set_newline('\r\n');

		$this->email->from('topan.pandenis@gmail.com','Topan Pandenis');
		$this->email->to('beautifullday@rocketmail.com');
		$this->email->subject('This is an email test');
		$this->email->message('It is working buddy!!!, Great!!');

		if($this->email->send())
		{
			echo "Your Email has been sent!!";
		}else{
			show_error($this->email->print_debugger());
		}
	}

}