<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Catalog extends CI_Controller{
	/*
		###	Controller : Catalog.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	public function index(){

		if(($this->session->userdata('user')!="") AND ($this->session->userdata('is_active') ==1))
		{
			if(isset($_POST['edit']))
			{
					if($this->session->userdata('status') == '1'){

						$kode = $_POST['code'];
						$d['title'] = "Catalog Data Edit";
						$act= "Edit Data Book for Code = $kode";
						$this->AppModel->activity($d['title'],$act);

						$dat = array('kode' => $kode);
						$d['data'] = $this->AppModel->getSelectedData("tb_buku",$dat);
						$d['menu'] = $this->load->view('menu');
						$d['content'] = $this->load->view('catalog/Edit',$d,true);
						$this->load->view('HomeView',$d);
					
					}else{ header('location:'.base_url()); }


			}elseif(isset($_POST['delete'])){
					if($this->session->userdata('status') == '1'){

						$kode = $_POST['code'];
						$d['title'] ="Catalog Delete Proccess";
						$data = array('kode'=>$kode);

						$this->AppModel->deleteData("tb_buku",$data);

						$act= "Catalog Delete Successed for book code  $kode";
						$this->AppModel->activity($d['title'],$act);

						$d['hasil'] = "Delete Proccess Successed for book code $kode";
						$d['menu'] = $this->load->view('menu');
						$d['content'] = $this->load->view('catalog/notif',$d,true);
						$this->load->view('HomeView',$d);

					}else{ header('location:'.base_url()); }

			}elseif(isset($_POST['detail'])){

						$kode = $_POST['code'];
						$d['title'] = "Catalog Data Detail";

						$act= "View detail Catalog for Code = $kode";
						$this->AppModel->activity($d['title'],$act);

						$dat = array('kode' => $kode);
						$d['data'] = $this->AppModel->getSelectedData("tb_buku",$dat);
						$d['menu'] = $this->load->view('menu');
						$d['content'] = $this->load->view('catalog/Detail',$d,true);
						$this->load->view('HomeView',$d);

			}elseif(isset($_POST['update'])){

						$d['title'] = "Catalog Data Update Proccess";
						$this->form_validation->set_rules('jenis','Category','required');
						$this->form_validation->set_rules('judul','Book Title','required');
						$this->form_validation->set_rules('tahun','Book Year','numeric|max_length[4]');
						$this->form_validation->set_rules('stok','Stock','required|numeric|max_length[4]');

						if($this->form_validation->run() == FALSE)
						{

							$this->AppModel->activity($d['title'],'Failed Proccess, Not Pass Validation');

							$kode = $_POST['code'];

							$dat = array('kode' => $kode);
							$d['data'] = $this->AppModel->getSelectedData("tb_buku",$dat);
							$d['menu'] = $this->load->view('menu');
							$d['content'] = $this->load->view('catalog/Edit',$d,true);
							$this->load->view('HomeView',$d);

						}else{

							$field_key = array('kode' => $_POST['code']);

							$data = array(
									'jenis' => $_POST['jenis'],
									'judul' => $_POST['judul'],
									'pengarang'=> $_POST['pengarang'],
									'penerbit' => $_POST['penerbit'],
									'tahun' => $_POST['tahun'],
									'stok' => $_POST['stok'],
									'harga' => $_POST['harga'],
									'sinopsis' => $_POST['sinopsis']);
							$this->AppModel->updateData('tb_buku',$data,$field_key);

							$act = "Update Proccess Successed for book code $_POST[code]";
							$this->AppModel->activity($d['title'],$act);

							$d['hasil'] = $act;
							$d['menu'] =$this->load->view('menu');
							$d['content']= $this->load->view('catalog/notif',$d,true);
							$this->load->view('HomeView',$d);
						}


			}elseif(isset($_POST['save'])){

						$d['title'] = "Catalog Data Saving Proccess";
						$this->form_validation->set_rules('jenis','Category','required');
						$this->form_validation->set_rules('judul','Book Title','required');
						$this->form_validation->set_rules('tahun','Book Year','numeric|max_length[4]');
						$this->form_validation->set_rules('stok','Stock','required|numeric|max_length[4]');
						$this->form_validation->set_rules('harga','Price','numeric');

						if($this->form_validation->run() == FALSE)
						{

							$this->AppModel->activity($d['title'],'Failed Proccess, Not Pass Validation');

							$d['menu'] =$this->load->view('menu');
							$d['content']= $this->load->view('catalog/Form',$d,true);
							$this->load->view('HomeView',$d);

						}else{

							$data = $this->AppModel->manualQuery("SELECT MAX(kode) as maxID from tb_buku");
							foreach($data->result() as $dt){
								$idMax = $dt->maxID;
								$b		= "B";
								$noUrut = (int) substr($idMax, 1, 6);
								$noUrut++;
								$newID = $b.sprintf("%06s", $noUrut);
								}

							$data = array(
									'kode' => $newID,
									'jenis' => $_POST['jenis'],
									'judul' => $_POST['judul'],
									'pengarang'=> $_POST['pengarang'],
									'penerbit' => $_POST['penerbit'],
									'tahun' => $_POST['tahun'],
									'stok' => $_POST['stok'],
									'harga' => $_POST['harga'],
									'sinopsis' => $_POST['sinopsis']);
							$this->AppModel->insertData('tb_buku',$data);

							$act = "Saving Proccess Successed for book code $newID";
							$this->AppModel->activity($d['title'],$act);

							$d['hasil'] = "Saving Proccess Successed for book code $newID<br/><br/><a href='catalog'>View List</a> <a href='catalog/addnew'>Add New</a>";
							$d['menu'] =$this->load->view('menu');
							$d['content']= $this->load->view('catalog/notif',$d,true);
							$this->load->view('HomeView',$d);
						}

			}elseif(isset($_POST['search'])){

							$d['title'] = "Catalog | Search Data";
							$cat = $_POST['cat'];
							$s = $_POST['item'];
							if($s == 'Type search item here' AND $cat =='')
								$itm = "";
							elseif($cat == $cat AND $s== 'Type search item here')
								$itm = "";
							elseif($cat == '' AND $s == $s )
								$itm = "";
							elseif($s == $s AND $cat == $cat)
								$itm = "$cat like '%$s%' OR";
							$jenis = strtoupper($_POST['jenis']);

								$d["paginator"] =$this->pagination->create_links();
								$d['data'] = $this->AppModel->manualQuery("SELECT * FROM tb_buku where $itm jenis = '$jenis'");
								$d['menu'] =$this->load->view('menu');
								$d['content']= $this->load->view('catalog/List',$d,true);
								$this->load->view('HomeView',$d);
							$act = "Search Data for category item search $cat, $itm, $jenis";
							$this->AppModel->activity($d['title'],$act);
			}else{


						// MENAMPILKAN DATA INDEX CATALOG
						$d['title'] ="Catalog List";
						$page=$this->uri->segment(3);
					
						$limit = $this->AppModel->setting("tb_setting","limit_page");
						if(!$page):
						$offset = 0;
						else:
						$offset = $page;
						endif;

						$this->AppModel->activity($d['title'],'');

						$d['tot'] = $offset;
						$tot_hal = $this->AppModel->getAllData("tb_buku");
						$config['base_url'] = site_url() . '/catalog/index';
						$config['total_rows'] = $tot_hal->num_rows();
						$config['per_page'] = $limit;
						$config['uri_segment'] = 3;
						$config['first_link'] = 'Awal';
						$config['last_link'] = 'Akhir';
						$config['next_link'] = 'Selanjutnya';
						$config['prev_link'] = 'Sebelumnya';
						$this->pagination->initialize($config);
						$d["paginator"] =$this->pagination->create_links();
						
						$d['data'] = $this->AppModel->getAllDataLimited("tb_buku",$limit,$offset);
						$d['menu'] =$this->load->view('menu');
						$d['content']= $this->load->view('catalog/List',$d,true);
						$this->load->view('HomeView',$d);
			}


		}elseif(($this->session->userdata('user')!="") AND ($this->session->userdata('is_active') ==0)){
			redirect('home');
		}else{
			redirect('login');
		}

	}




	function addnew(){
			if($this->session->userdata('status') == '1'){
						$d['title'] ="Catalog Add New Data";
						$this->AppModel->activity($d['title'],'');
						$d['menu'] =$this->load->view('menu');
						$d['content']= $this->load->view('catalog/Form',$d,true);
						$this->load->view('HomeView',$d);
			}else{ header('location:'.base_url()); }
		}

#End of File Catalog.php
#Created by Lentinganjariku
}