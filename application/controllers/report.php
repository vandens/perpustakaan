<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Report extends CI_Controller{
	/*
		###	Controller : Report.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	public function index(){

					$d['title']		= 'Laporan Denda Peminjaman';
					$d['menu']		= $this->load->view('list_head');

					$d['data'] = $this->AppModel->manualQuery("SELECT * FROM vw_tampil_pinjam where status = '3'");
					//$d['content']	= $this->load->view('report/form_pinjam',$d,true);
					$d['content']	= $this->load->view('report/list_popUp',$d,true);
					$this->load->view('HomeView',$d);
					$this->AppModel->activity($d['title'],'');
	}

	function drop(){
		$d['data'] = $this->db->query("Truncate history_activity");
		$d['title'] = "Truncate Table Activity Report List";
		$this->AppModel->activity($d['title'],'Truncate table Successed!');
		header('location:'.base_url());
	}


	function activity(){
		if(isset($_POST['submit']))
		{

		}else{

				if($this->session->userdata('status')=='1')
				{
					$d['title'] ="Activity Report List";
					
					$page=$this->uri->segment(4);
					$limit = $this->AppModel->setting("tb_setting","limit_page");
					if(!$page):
					$offset = 0;
					else:
					$offset = $page;
					
					endif;
					
					$d['tot'] = $offset;
					$tot_hal = $this->AppModel->getAllData("history_activity");
					$config['base_url'] = site_url() . '/report/activity/index';
					$config['total_rows'] = $tot_hal->num_rows();
					$config['per_page'] = $limit;
					$config['uri_segment'] = 4;
					$config['first_link'] = 'Awal';
					$config['last_link'] = 'Akhir';
					$config['next_link'] = 'Selanjutnya';
					$config['prev_link'] = 'Sebelumnya';
					$this->pagination->initialize($config);
					$d["paginator"] =$this->pagination->create_links();


					// $this->AppModel->activity($d['title'],'');
					
					$d['data'] = $this->AppModel->getAllDataLimited("history_activity",$limit,$offset);
					$d['menu'] =$this->load->view('menu');
					$d['content']= $this->load->view('report/activity',$d,true);
					$this->load->view('HomeView',$d);
				}
				else
				{
					header('location:'.base_url().'');
				}
		
		}


	}


	function postalmail(){

		if(isset($_POST['viewmail']))
		{	
			$d['title'] = "Postal Mail View Detail";
			$data = array('id'=>$_POST['id']);

			$data2 = array('[[USER_ID]]' => $dt->user_id,
					'[[USER]]' => $dt->username,
					'[[PASSWORD]]' => $dt->activecode,
					'[[STATUS]]' => $dt->status,
					'[[FULLNAME]]' => $dt->namalengkap,
					'[[APP_NAME]]' => $this->AppModel->setting("tb_setting","app_name"),
					'[[POWERED]]' => $this->config->item('powered'));


			$d['data'] = $this->AppModel->manualQuery("SELECT tu.username, tu.activecode, tu.status as stat1, tu.namalengkap,
				tp.");
			$d['menu'] = $this->load->view('menu');
			$d['content'] = $this->load->view('report/postalmail_view',$d,true);
			$this->load->view('HomeView',$d);

			$this->AppModel->activity($d['title'],'Detail view for id ".$_POST[id]."');

		}elseif(isset($_POST['delete'])){
			
			$id = $_POST['id'];
			echo "This is for proces delete with id $id";

		}else{

				if($this->session->userdata('status')=='1')
				{
					$d['title'] ="Postal Mail Report List";
					
					$page=$this->uri->segment(3);
					$limit = $this->AppModel->setting("tb_setting","limit_page");
					if(!$page):
					$offset = 0;
					else:
					$offset = $page;
					
					endif;
					
					$d['tot'] = $offset;
					$tot_hal = $this->AppModel->getAllData("tb_postalMail");
					$config['base_url'] = site_url() . '/postalmail/index';
					$config['total_rows'] = $tot_hal->num_rows();
					$config['per_page'] = $limit;
					$config['uri_segment'] = 3;
					$config['first_link'] = 'Awal';
					$config['last_link'] = 'Akhir';
					$config['next_link'] = 'Selanjutnya';
					$config['prev_link'] = 'Sebelumnya';
					$this->pagination->initialize($config);
					$d["paginator"] =$this->pagination->create_links();


					$data = array('status'=> 0);
					$d['data'] = $this->AppModel->getSelectedData("tb_postalMail",$data,$limit,$offset);
					$d['menu'] =$this->load->view('menu');
					$d['content']= $this->load->view('report/postalmail',$d,true);
					$this->load->view('HomeView',$d);


					$this->AppModel->activity($d['title'],'View Postal Mail List');
				}
				else
				{
					header('location:'.base_url().'');
				}
		
		}

	}
	#end of postal mail function
	
	
	
	
	function denda(){
	
	if(isset($_POST['search'])){

							$d['title'] = "Data Denda | Pencarian Data";
							$cat = $_POST['cat'];
							$s = $_POST['item'];
							if($s == 'Ketik kata kunci disini' AND $cat =='')
								$itm = "";
							elseif($cat == $cat AND $s== 'Ketik kata kunci disini')
								$itm = "";
							elseif($cat == '' AND $s == $s )
								$itm = "";
							elseif($s == $s AND $cat == $cat)
								$itm = "$cat like '%$s%' OR";
							$status = strtoupper($_POST['status']);

								$d["paginator"] =$this->pagination->create_links();
								$d['data'] = $this->AppModel->manualQuery("SELECT * FROM vw_tampil_pinjam where $itm status = '$status'");
								$d['menu'] =$this->load->view('menu');
								$d['content']= $this->load->view('report/List',$d,true);
								$this->load->view('HomeView',$d);
							$act = "Pencarian data laporan denda peminjaman dengan kategori $cat, $itm, $status";
							$this->AppModel->activity($d['title'],$act);
		
		}else{

				if($this->session->userdata('status')=='1')
				{
					$d['title'] ="Data Laporan Denda";
					
					// MENAMPILKAN DATA INDEX PEMINJAMAN
						$page=$this->uri->segment(3);
					
						$limit = $this->AppModel->setting("tb_setting","limit_page");
						if(!$page):
						$offset = 0;
						else:
						$offset = $page;
						endif;


						$d['tot'] = $offset;
						$tot_hal = $this->AppModel->getAllData("vw_tampil_pinjam");
						$config['base_url'] = site_url() . '/denda/index';
						$config['total_rows'] = $tot_hal->num_rows();
						$config['per_page'] = $limit;
						$config['uri_segment'] = 3;
						$config['first_link'] = 'Awal';
						$config['last_link'] = 'Akhir';
						$config['next_link'] = 'Selanjutnya';
						$config['prev_link'] = 'Sebelumnya';
						$this->pagination->initialize($config);
						$d["paginator"] =$this->pagination->create_links();
						
						$d['data'] = $this->AppModel->manualQuery("SELECT * FROM vw_tampil_pinjam where status = '3'",$limit,$offset);
						$d['menu'] =$this->load->view('menu');
						$d['content']= $this->load->view('report/List',$d,true);
						$this->load->view('HomeView',$d);


						$this->AppModel->activity($d['title'],'Halaman Laporan Denda');
				}
				else
				{
					header('location:'.base_url().'');
				}
		
		}
	
	
	
	}
	
	
	#end of denda function


#end of file report.php
#created by Lentingan Jariku
}