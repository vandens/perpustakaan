<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class User extends CI_Controller{
	/*
		###	Controller : User.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	public function index(){

		if($this->session->userdata('user')!="")
		{
			if(isset($_POST['edit']))
			{
					if($this->session->userdata('status') == '1'){

						$user_id = $_POST['user_id'];
						$d['title'] = "User Member Data Edit";
						$act= "Edit Data Book for User ID = $user_id";
						$this->AppModel->activity($d['title'],$act);

						$data = array('user_id' => $user_id);
						$d['data'] = $this->AppModel->getSelectedData("tb_user",$data);
						$d['menu'] = $this->load->view('menu');
						$d['content'] = $this->load->view('user/Edit',$d,true);
						$this->load->view('HomeView',$d);
					
					}else{ header('location:'.base_url()); }


			}elseif(isset($_POST['delete'])){
					if($this->session->userdata('status') == '1'){

						$user_id = $_POST['user_id'];
						$d['title'] ="User Member Delete Proccess";
						$data = array('user_id'=>$user_id);

						$sq = $this->AppModel->manualQuery("Select * from tb_user where user_id = '$user_id'");
						foreach ($sq->result() as $t) {	}

						$act= "User Member Delete Successed for User ID $user_id,
								Username = $t->username, Name = $t->namalengkap, 
								School = $t->sekolah, Class = $t->kelas, Email = $t->email, 
								Phone No = $t->notelp, status = $t->status, Log Visit = $t->visit
								Last Login = $t->last_login";
						$this->AppModel->activity($d['title'],$act);

						$this->AppModel->deleteData("tb_user",$data);



						$d['hasil'] = "Delete Proccess Successed for user id $user_id<br/><a href='user'>View List</a> <a href='user/addnew'>Add New</a>";
						$d['menu'] = $this->load->view('menu');
						$d['content'] = $this->load->view('catalog/notif',$d,true);
						$this->load->view('HomeView',$d);

					}else{ header('location:'.base_url()); }

			}elseif(isset($_POST['detail'])){

						$user_id = $_POST['user_id'];
						$d['title'] = "User Member Data Detail";

						$act= "View detail user member for User ID = $user_id";
						$this->AppModel->activity($d['title'],$act);

						$dat = array('user_id' => $user_id);
						$d['disabled'] = "disabled='disabled'";
						$d['data'] = $this->AppModel->getSelectedData("tb_user",$dat);
						$d['menu'] = $this->load->view('menu');
						$d['content'] = $this->load->view('user/Detail',$d,true);
						$this->load->view('HomeView',$d);

			}elseif(isset($_POST['update'])){

						$d['title'] = "User Member Data Update Proccess";
						//$this->form_validation->set_rules('user','Username','required|min_length[5]|max_length[10]|xss_clean');
						$this->form_validation->set_rules('nama','Full Name','required');
						$this->form_validation->set_rules('level','Member Status','required');
						$this->form_validation->set_rules('sekolah','School Name','required');
						$this->form_validation->set_rules('email','email','valid_email');
						$this->form_validation->set_rules('notelp','Phone Number #1','required|xss_clean');

						if($this->form_validation->run() == FALSE)
						{
							$act = "Proccess Failed, Not pass validation!";
							$this->AppModel->activity($d['title'],$act);

							$user_id = $_POST['user_id'];
							
							$data = array('user_id' => $user_id);
							$d['data'] = $this->AppModel->getSelectedData("tb_user",$data);
							$d['menu'] = $this->load->view('menu');
							$d['content'] = $this->load->view('user/Edit',$d,true);
							$this->load->view('HomeView',$d);

						}else{

							$field_key = array('user_id' => $_POST['user_id']);

							$data = array(
									//'username' => $_POST['user'],
									//'status' => $_POST['level'],
									'namalengkap'=> $_POST['nama'],
									'sekolah' => $_POST['sekolah'],
									'email' => $_POST['email'],
									'notelp' => $_POST['notelp'],
									'notelp2' => $_POST['notelp2'],
									'alamat' => $_POST['alamat'],
									'is_active' => $_POST['is_active']
									);
							$this->AppModel->updateData('tb_user',$data,$field_key);

							$act = "Update Proccess Successed for User ID $_POST[user_id]";
							$this->AppModel->activity($d['title'],$act);

							$d['hasil'] = $act;
							$d['menu'] =$this->load->view('menu');
							$d['content']= $this->load->view('user/notif',$d,true);
							$this->load->view('HomeView',$d);
						}


			}elseif(isset($_POST['save'])){

						//$this->form_validation->set_rules('user','Username','required|min_length[5]|max_length[10]|xss_clean|is_unique[tb_user.username]');
						$this->form_validation->set_rules('nama','Full Name','required');
						$this->form_validation->set_rules('kelas','Class Name','required');
						//$this->form_validation->set_rules('level','Member Status','required');
						$this->form_validation->set_rules('sekolah','School Name','required');
						$this->form_validation->set_rules('email','email','valid_email|is_unique[tb_user.email]');
						$this->form_validation->set_rules('notelp','Phone Number #1','required|xss_clean|is_unique[tb_user.notelp]');

						if($this->form_validation->run() == FALSE)
						{
							$d['title'] = "User Member Add Data Proccess";
							$this->AppModel->activity($d['title'],'Failed Proccess, Not Pass Validation');
							$d['disabled'] = "disabled='disabled' value='*************************'";
							$d['menu'] =$this->load->view('menu');
							$d['content']= $this->load->view('user/Form',$d,true);
							$this->load->view('HomeView',$d);

						}else{

							$data = $this->AppModel->manualQuery("SELECT MAX(user_id) as maxID from tb_user");
							foreach($data->result() as $dt)
							{
								$idMax = $dt->maxID;
								$u		= "U";
								$noUrut = (int) substr($idMax, 1, 6);
								$noUrut++;
								$newID = $u.sprintf("%06s", $noUrut);
							}
							
							$activeCode = substr(md5($newID),5,10);
							$pwd = md5($activeCode);
							$data = array(
									'user_id' => $newID,
									//'username' => $_POST['user'],
									//'password' => $pwd,
									'status' => 2,
									'namalengkap'=> $_POST['nama'],
									'sekolah' => $_POST['sekolah'],
									'kelas' => $_POST['kelas'],
									'email' => $_POST['email'],
									'notelp' => $_POST['notelp'],
									'notelp2' => $_POST['notelp2'],
									'alamat' => $_POST['alamat'],
									'activecode' => $activeCode,
									'is_active' => 1
									);
							$this->AppModel->insertData('tb_user',$data);
							
							/*
							if($_POST['level'] == 1) $status = 'Administrator'; elseif($_POST['level'] == 2) $status = 'User Member'; elseif($_POST['level'] == 3) $status = 'Head Office';
							
							if($_POST['sendpwd'] == 1)
							{
									$data = array('title' => 'Email Confirmation Account', 'emailTemp' => 'email_conf_pass','subject' => 'Confirmation Email','to' => $_POST['email']);
						            $data2 = array('[[USER_ID]]' => $newID,
						                      '[[USER]]' => $_POST['user'],
						                      '[[PASSWORD]]' => $pwd,
						                      '[[STATUS]]' => $status,
						                      '[[FULLNAME]]' => $_POST['nama'],
						                      '[[APP_NAME]]' => $this->AppModel->setting("tb_setting","app_name"),
						                      '[[POWERED]]' => $this->config->item('powered'));
						            $this->AppModel->SendEmail($data,$data2);

						            $d['title'] = "User Member Add Data Proccess";


							}else{
								*/
									$data = array(	'user_id'			=> $newID,
												 	'postal_mail_temp' 	=> 'postal_mail',
												 	'status'			=> 0,
												 	'requested'			=> $this->session->userdata('username'));
						            $this->AppModel->insertData('tb_postalMail',$data);


						            $d['title'] = "User Member Add Data Proccess";
						            $hasil = "Postal mail Confirmation Account for member by ID $newID";
						            $this->AppModel->activity($d['title'],$hasil);
							// }
							
							$d['hasil'] = "Data berhasil ditambahkan!<br/><br/><a href='user'>Tampilkan Data</a> <a href='user/addnew'>Tambah  Baru</a>";
							$d['menu'] =$this->load->view('menu');
							$d['content']= $this->load->view('user/notif',$d,true);
							$this->load->view('HomeView',$d);
						}

			}elseif(isset($_POST['search'])){

							$d['title'] = "Catalog | Search Data";
							$cat = $_POST['cat'];
							$s = $_POST['item'];
							if($cat == '' AND $s == 'Type search item here')
								$cari = "";
							elseif($cat == '' AND $s == $s)
								$cari = "";
							else
								$cari = "where $cat like '%$s%'";

							$d["paginator"] =$this->pagination->create_links();
							$d['data'] = $this->AppModel->manualQuery("SELECT * FROM tb_user ".$cari);
							$d['menu'] =$this->load->view('menu');
							$d['content']= $this->load->view('user/List',$d,true);
							$this->load->view('HomeView',$d);
							$act = "Search Data for user member with item search $cat = $s";
							$this->AppModel->activity($d['title'],$act);



			}elseif(isset($_POST['sendmail'])){

			$data = array('emailTemp' => 'email_conf_pass','subject' => 'Confirmation Email','to' => $email);
            $data2 = array('[[USER_ID]]' => $_POST['user_id'],
                      '[[USER]]' => $_POST['user'],
                      '[[PASSWORD]]' => $_POST['activecode'],
                      '[[STATUS]]' => $_POST['status'],
                      '[[FULLNAME]]' => $_POST['nama'],
                      '[[APP_NAME]]' => $this->config->item('app_name'),
                      '[[POWERED]]' => $this->config->item('powered'));
            $this->AppModel->SendEmail($data,$data2);
			
			$d['hasil'] = $act;
			$d['hasil'] = "<br/><br/><a href='user'>View List</a> <a href='user/addnew'>Add New</a>";
			$d['menu'] =$this->load->view('menu');
			$d['content']= $this->load->view('user/notif',$d,true);
			$this->load->view('HomeView',$d);




	}else{
		
			$d['title'] ="User Member List";
			$page=$this->uri->segment(3);
			$limit = $this->AppModel->setting("tb_setting","limit_page");
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;

			$this->AppModel->activity($d['title'],'');

			$d['tot'] = $offset;
			$tot_hal = $this->AppModel->getAllData("tb_user");
			$config['base_url'] = site_url() . '/user/index';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			
			$d['data'] = $this->AppModel->getAllDataLimited("tb_user",$limit,$offset);
			$d['menu'] =$this->load->view('menu');
			$d['content']= $this->load->view('user/List',$d,true);
			$this->load->view('HomeView',$d);


			}

		}



	}


	function addnew(){
			if($this->session->userdata('status') == '1'){
						$d['title'] ="User Member Add New Data";
						$this->AppModel->activity($d['title'],'');
						$d['disabled'] = "disabled='disabled' value='*************************'";
						$d['menu'] =$this->load->view('menu');
						$d['content']= $this->load->view('user/Form',$d,true);
						$this->load->view('HomeView',$d);
			}else{ header('location:'.base_url()); }
		}






#End of File User.php
#Created by Lentinganjariku.wordpress.com
}
