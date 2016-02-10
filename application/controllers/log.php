<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	/*
		###	Controller : Login.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	public function index()
	{
		$d['title'] = $this->config->item('app_name');
		
		$d['app_name'] = $this->config->item('app_name');
		$d['powered'] = $this->config->item('powered');
		$cek = $this->session->userdata('user');
		
		if(empty($cek)){
			
			$this->load->view('login/form',$d);

		}else{

			redirect('home');
		}
		/*
		if(empty($cek)){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('login/login',$d);
			}else{
				$u = $this->input->post('username');
				$p = md5($this->input->post('password'));
				$r = $this->input->post('level');
				$this->app_model->getLoginData($u,$p,$r);
			}
		}else{
		*/
		// }
		
	}
	
	public function CheckLogin(){
	$this->form_validation->set_rules('username','username','required');
	$this->form_validation->set_rules('password','password','required|callback_Verify');
	if($this->form_validation->run() == false){
			$this->load->view('login/form');
		}else{
			return true;

			}		
	}


	function Verify(){
		$data = array('username' => $_POST['username'], 'password'=>md5($_POST['password']));
		$query = $this->AppModel->getSelectedData('tb_user',$data);
		if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
					{
						$data['username']	= $row->username;
						$data['user'] 		= $row->namalengkap;
						$data['status']		= $row->status;
						$data['is_active']	= $row->is_active;
						$data['Logged_in']	= true;
						$this->session->set_userdata($data);
						
						$this->AppModel->manualQuery("Update tb_user set visit=visit+1 where username='$user'");
						redirect('home');
					}
					return true;
			}else{
				$this->form_validation->set_message('Verify','Incorect Username or Password, Please try again!');
				return false;
			}
	}


	public function forgot_pass(){
		if(isset($_POST['sendpass']))
		{	
			$d['title'] = "Forgot Password Request";
			$this->form_validation->set_rules('email','Email','required|valid_email|callback_verifyEmail');
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('login/forgot_password');
			}else{
				$to = $_POST['email'];
				$data = array('email' =>$to);
				$sql = $this->AppModel->getSelectedData("tb_user",$data);
				if($sql->num_rows()>0)
				{

					foreach ($sql->result() as $data) 
					{
						$newcode 	= substr(md5($data->activecode),5,10);
						$pwd 		= md5($newcode);

						$id 		= array('user_id'=> $data->user_id);
						$array		= array('password' => $pwd, 'activecode' => $newcode, 'is_active' =>0);
						$sql = $this->AppModel->updateData('tb_user',$array,$id);
						/*
						if($data->status == '1')
							$status = 'Administrator';
						elseif($data->status == '2')
							$status = 'User Member';
						elseif($data->status == '3');
							$status = 'Head Office';
						*/

			              $getTemp 	= $this->AppModel->setting("tb_setting","email_forgot_pass");
			              $from 	= $this->AppModel->setting("tb_setting","email_def_acc");
			              $ccmail 	= $this->AppModel->setting("tb_setting","email_def_cc"); 
						  $subject 	= "Reset Password Request";
			            

			              $data = array('[[USER_ID]]' 	=> $data->user_id,
			                      '[[USER]]' 			=> $data->username,
			                      '[[PASSWORD]]' 		=> $newcode,
			                      '[[STATUS]]' 			=> $data->status,
			                      '[[FULLNAME]]' 		=> $data->namalengkap,
			                      '[[APP_NAME]]' 		=> $this->AppModel->setting("tb_setting","app_name"),
			                      '[[POWERED]]' 		=> $this->config->item('powered'),
			                      '[[EMAIL]]' 			=> $from);

			              $content = strtr($getTemp,$data);

			              $headers = "From: " . strip_tags($from) . "\r\n";
			              $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
			              $headers .= "CC: ". strip_tags($ccmail) . "\r\n";
			              $headers .= "MIME-Version: 1.0\r\n";
			              $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			              $message = '<html><body>';
			              $message .= "$content";
			              $message .= "</body></html>";
			              if(mail($to, $subject, $message, $headers))
							{
								$record = array('id'=>'',
									'sess_id' => $to,
									'last_act'=> "Forgot Password Request",
									'notes' => "Sending Email Forgot Password Requested by Mr(s). $data->namalengkap ($to) has been successed!!",
									'ip'=> $_SERVER['REMOTE_ADDR']);
									$this->AppModel->insertData("history_activity",$record);
							}else{

								$record = array('id'=>'',
									'sess_id' => $to,
									'last_act'=> "Forgot Password Request",
									'notes' => "Sending Email Forgot Password Requested Mr(s). data->namalengkap ($to) is failed, please check your both configuration and connection!!",
									'ip' => $_SERVER['REMOTE_ADDR']);
									$this->AppModel->insertData("history_activity",$record);
							}
						redirect('home');

					}


				}else{
					
					$this->form_validation->set_message('email','Unregistered Email Account, Please try again!');
					$this->load->view('login/forgot_password');
				}
			}
			

		}else{

		$this->load->view('login/forgot_password');
		}
	}


	public function logout(){
		$act = $this->session->userdata('username');
		$this->AppModel->activity('User LogOut',$act);
		$this->AppModel->manualQuery('Update tb_user set last_login = now()');
		$this->session->sess_destroy();
		header('location:'.base_url().'');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */