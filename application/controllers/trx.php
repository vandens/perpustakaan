<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Trx extends CI_Controller{
	/*
		###	Controller : Trx.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	//Status (1) = Menunggu persetujuan
	//Status (2) = Dipinjam
	//Status (3) = Dikembalikan
	//Status (4) = Ditolak

	function rent(){


		if($this->session->userdata('status') == '1'){
			$user = $this->session->userdata('user');
			if(isset($_POST['save']))
			{

				//Mengecek ID tertinggi dari tb_pinjam utk membuat ID Baru
				$data = $this->AppModel->manualQuery("SELECT MAX(id) as maxID from tb_pinjam");
							foreach($data->result() as $dt){
								$idMax = $dt->maxID;
								$b		= "P";
								$noUrut = (int) substr($idMax, 1, 6);
								$noUrut++;
								$newID = $b.sprintf("%06s", $noUrut);
								}

				//Men-generate tanggal pengembalian sesuai dengan lamanya peminjaman di pengaturan
				$tgl_kembali = $this->AppModel->tgl_kembali($_POST['tgl']);
				$data = array ('id' 				=> $newID,
								'user_id' 			=> $_POST['user'],
								'kode_buku' 		=> $_POST['kode_buku'],
								'tgl_order' 		=> $_POST['tgl'],
								'status'			=> 1,
								'pinjam_by'			=> $user);
				$this->AppModel->insertData('tb_pinjam',$data);



				$this->AppModel->activity("Peminjaman Buku","Simpan data order buku oleh user = ".$user." dan id = ".$newID."");

				
				header('location:../trx/rent');


			}elseif(isset($_POST['reject'])){
				$d['title'] = "Peminjaman Buku";
				$field_key = array('id' => $_POST['id']);
				$data = array('status' => 4,
							  'reject_by' => $this->session->userdata('user'),
							  'tgl_reject_stamp' => date('Y-m-d H:i:s'));
				$this->AppModel->updateData("tb_pinjam",$data,$field_key);

				$this->AppModel->activity($d['title'],"Reject Peminjaman dengan ID ".$_POST['id']."");
				$d['hasil'] = "Peminjaman Buku dengan ID ".$_POST['id']." <br>berhasil direject!";
				$d['menu'] = $this->load->view('menu');
				$d['content'] = $this->load->view('trx/notif',$d,true);
				$this->load->view('HomeView',$d);

			}elseif(isset($_POST['approve'])){
				$id = $_POST['id'];

			}elseif($this->uri->segment(3) == 'peminjaman'){
				$d['title']		= 'Daftar Peminjaman Buku';
				$d['menu'] 		=$this->load->view('menu');
				$d['content']	= $this->load->view('trx/form_pinjam',$d,true);
				$this->load->view('HomeView',$d);
				$this->AppModel->activity($d['title'],'');
			}else{

						$d['title'] ="Daftar Peminjaman Buku";
						$page=$this->uri->segment(3);
					
						$limit = $this->AppModel->setting("tb_setting","limit_page");
						if(!$page):
						$offset = 0;
						else:
						$offset = $page;
						endif;

						$this->AppModel->activity($d['title'],'');

						$d['tot'] = $offset;
						$tot_hal = $this->AppModel->getAllData("vw_tampil_pinjam");
						$config['base_url'] = site_url() . '/trx/rent/index';
						$config['total_rows'] = $tot_hal->num_rows();
						$config['per_page'] = $limit;
						$config['uri_segment'] = 3;
						$config['first_link'] = 'Awal';
						$config['last_link'] = 'Akhir';
						$config['next_link'] = 'Selanjutnya';
						$config['prev_link'] = 'Sebelumnya';
						$this->pagination->initialize($config);
						$d["paginator"] =$this->pagination->create_links();
						
						$d['data'] = $this->AppModel->getAllDataLimited("vw_tampil_pinjam",$limit,$offset);
						$d['menu'] =$this->load->view('menu');
						$d['content']= $this->load->view('trx/form_pinjam',$d,true);
						$d['content'].= $this->load->view('trx/list_pinjam',$d,true);
						$this->load->view('HomeView',$d);
				
			}


		}
		else
		{
			header('location:'.base_url());
		}


		
	}




}