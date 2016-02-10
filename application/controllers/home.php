<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Home extends CI_Controller{
	/*
		###	Controller : Home.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	public function index(){

	
		if(($this->session->userdata('user')!="") AND ($this->session->userdata('is_active') ==1))
		{
		if(isset($_POST['sendmail'])){
									
				$d['title'] = "User Member Sending Mail";
				$email = $_POST['email'];
				$active = $_POST['activecode'];
				$nama = $_POST['nama'];

				$this->email->from('admin@lentinganjariku.16mb.com','Administrator'); 
				$this->email->to("$email");  //diisi dengan alamat tujuan
				$this->email->subject('Activation Code Confirmation'); 
				$this->email->message("Mr. $nama <br> Here I send you an Activation Code $active"); 
				$this->email->send();


				$act = "Mr. $nama <br> Here I send you an Activation Code $active";
				$this->AppModel->activity($d['title'],$act);
					
				$d["paginator"] =$this->pagination->create_links();
				$d['hasil'] = "An email to $email is processing
								<br/><br/><a href='user'>View List</a> <a href='user/addnew'>Add New</a>";
				$d['menu'] =$this->load->view('menu');
				$d['content']= $this->load->view('user/notif',$d,true);
				$this->load->view('HomeView',$d);


			}
				$d['title']			= 'Welcome to ';
				$d['menu'] =$this->load->view('menu');
				$d['content']= $this->load->view('content',$d,true);
				$this->load->view('HomeView',$d);
			
		}
		elseif(($this->session->userdata('user')!="") AND ($this->session->userdata('is_active') ==0))
		{

			$d['title']			= "Reset Password";
			$d['menu'] 			= $this->load->view('menu');
			$d['content']		= $this->load->view('login/reset_pass',$d,true);
			$this->load->view('HomeView',$d);
			$this->AppModel->activity($d['title'],"");
			#header('location:'.base_url().'');
		}
		else
		{
			redirect('login');
		}

	}


	function changepwd(){

		if($this->session->userdata('user') !=""){
			$this->form_validation->set_rules('pass1','Password','required|matches[pass2]');
			$this->form_validation->set_rules('pass2','Confirm Password','required');
		
				if($this->form_validation->run() == false){
					$d['title']			= "Failed Reset Password, not pass validation";
					$d['menu'] 			= $this->load->view('menu');
					$d['content']		= $this->load->view('login/reset_pass',$d,true);
					$this->load->view('HomeView',$d);
					$this->AppModel->activity($d['title'],"");
				}else{
					$user = $this->session->userdata('username');
					$pass1 	= $_POST['pass1'];
					$pass2	= $_POST['pass2'];
					$md = md5($pass1);
					$this->AppModel->manualQuery("Update tb_user set password='$md', is_active=1 where username='$user'");
					redirect('home');
				}
			}

		}





	function dashboard(){
		if($this->session->userdata('status') == '1'){
			$d['title']		= "General Setting";
			
			if(isset($_POST['save'])){
				$act = "Update general setting";
				$field_key = array ('id' => $_POST['id']);

				$data = array('app_name' => $_POST['app_name'],
				'instance_name' => $_POST['instance_name'],
				'limit_page' => $_POST['limited'],
				'limit_loan' => $_POST['limit_day'],
				'fine' => $_POST['fine'],
				'email_def_acc' => $_POST['emailsender'],
				'email_def_cc' => $_POST['emailcc'],
				/*
				'email_conf_pass' => $_POST['email_conf_pass'], 
				'email_forgot_pass' => $_POST['email_forgot_pass'],
				*/
				'postal_mail' => $_POST['postal_mail']);
				
				$this->AppModel->updateData("tb_setting",$data,$field_key);				
				
			}else{
				
				$act = "View general setting";
				
			}
		
		
			$this->AppModel->activity($d['title'],$act);
			$d['data']		= $this->AppModel->getAllData("tb_setting");
			$d['menu'] 		= $this->load->view('menu');
			$d['content']	= $this->load->view('dashboard/setting',$d,true);
			$this->load->view('HomeView',$d);
			
		}else{
			header('location:'.base_url().'');
		}
	}


}