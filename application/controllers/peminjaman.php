<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Peminjaman extends CI_Controller{
	/*
		###	Controller : Peminjaman.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	public function index(){

		if(($this->session->userdata('user')!="") AND ($this->session->userdata('is_active') ==1))
		{
		
			if(isset($_POST['save'])){

						$d['title'] = "Simpan data order peminjaman Buku oleh ".$this->session->userdata('user')."";
						$this->form_validation->set_rules('user','User','required');
						$this->form_validation->set_rules('kode_buku','Kode Buku','required');
						$this->form_validation->set_rules('tgl','Tanggal','date');

						if($this->form_validation->run() == FALSE)
						{

							$this->AppModel->activity($d['title'],'Proses simpan gagal!, Validasi Error!');

							$d['menu'] =$this->load->view('list_head');
							$d['content']= $this->load->view('peminjaman/form_pinjam',$d,true);
							$this->load->view('HomeView',$d);

						}else{
							
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
							$kode = $_POST['kode_buku'];
							$tgl_kembali = $this->AppModel->tgl_kembali($_POST['tgl']);
							$data = array ('id' 				=> $newID,
											'user_id' 			=> $_POST['user'],
											'kode_buku' 		=> $_POST['kode_buku'],
											'tgl_order' 		=> $_POST['tgl'],
											'status'			=> 1,
											'pinjam_by'			=> $this->session->userdata('user'));
							$this->AppModel->insertData('tb_pinjam',$data);
							$this->AppModel->manualQuery("UPDATE tb_buku set stok = stok-1 where kode = '$kode'");


							$this->AppModel->activity("Peminjaman Buku","Simpan data order buku oleh user = ".$this->session->userdata('user')." dan id = ".$newID."");
							header('location:peminjaman/tambah');
						}

			}elseif(isset($_POST['search'])){

							$d['title'] = "Data Peminjaman | Pencarian Data";
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
							$act = "Pencarian data peminjaman dengan kategori $cat, $itm, $status";
							$this->AppModel->activity($d['title'],$act);
			


			}elseif(isset($_POST['approve'])){

				$d['title'] = "Peminjaman Buku";
				$this->AppModel->activity($d['title'],"Peminjaman dengan ID ".$_POST['id']."berhasil diproses!");

				$tgl_pinjam 		= date('Y-m-d');
				$tgl_wjb_kembali 	= $this->AppModel->tgl_kembali('');
				$i = "";
				for($i=0;$i<count($_POST['checkbox']);$i++){


				//$field_key 			= array('id' => $_POST['checkbox']['$i']);

				//$data = array('status' 				=> 2,
				//			  'tgl_pinjam' 			=> $tgl_pinjam,
				//			  'tgl_wjb_kembali'		=> $tgl_wjb_kembali,
				//			  'tgl_pinjam_stamp' 	=> date('Y-m-d H:i:s'));
				//$this->AppModel->updateData("tb_pinjam",$data,$field_key);

					$id=$_POST['checkbox'][$i];
					$this->AppModel->manualQuery("UPDATE tb_pinjam set status = 2,
																		tgl_pinjam = '$tgl_pinjam',
																		tgl_wjb_kembali = '$tgl_wjb_kembali',
																		tgl_pinjam_stamp = date('Y-m-d H:i:s')
																		where id = '$id'");

				}


				$d['hasil'] = "Peminjaman Buku dengan ID ".$_POST['id']." <br>berhasil diproses!
				<br><a href='peminjaman/tambah'>Tambah baru</a> <a href='' onclick='javascript:window.close()'>Tutup</a>";
				$d['menu'] = $this->load->view('list_head');
				$d['content'] = $this->load->view('peminjaman/notif',$d,true);
				$this->load->view('HomeView',$d);




			}elseif(isset($_POST['reject'])){

					if($this->session->userdata('status') == '1'){

								$d['title'] = "Peminjaman Buku";
								$user = $this->session->userdata('user');
								$i = "";
								for($i=0;$i<count($_POST['checkbox']);$i++){
									$id=$_POST['checkbox'][$i];
									$this->AppModel->manualQuery("UPDATE tb_pinjam set status = 4,
																						reject_by = '$user',
																						tgl_reject_stamp = date('Y-m-d H:i:s')
																						where id = '$id'");

									$q = $this->AppModel->manualQuery("SELECT kode_buku FROM tb_pinjam where id = '$id'");
								
									foreach($q->result() as $data){
										$kode = $data->kode_buku;
										$this->AppModel->manualQuery("UPDATE tb_buku set stok = stok+1 where kode = '$kode'");
									}


								}

								$this->AppModel->activity($d['title'],"Reject Peminjaman dengan ID ".$_POST['id']."");
								$d['hasil'] = "Peminjaman Buku dengan ID ".$_POST['id']." <br>berhasil direject!<br><a href='peminjaman/tambah'>Tambah baru</a> <a href='javascript:window.close()'>Tutup</a>";
								$d['menu'] = $this->load->view('list_head');
								$d['content'] = $this->load->view('peminjaman/notif',$d,true);
								$this->load->view('HomeView',$d);

					}else{ header('location:'.base_url()); }


			}elseif(isset($_POST['delete'])){
					if($this->session->userdata('status') == '1'){

								$d['title'] = "Peminjaman Buku";
								$user = $this->session->userdata('user');
								$i = "";
								for($i=0;$i<count($_POST['checkbox']);$i++){
									$id=$_POST['checkbox'][$i];

									$ql = $this->AppModel->manualQuery("SELECT kode_buku FROM tb_pinjam where id = '$id'");
								
									foreach($ql->result() as $dt){
										$kode = $dt->kode_buku;
										$this->AppModel->manualQuery("UPDATE tb_buku set stok = stok+1 where kode = '$kode'");
									}

									
									$this->AppModel->manualQuery("DELETE FROM tb_pinjam where id = '$id'");


							}

								$this->AppModel->activity($d['title'],"Hapus Peminjaman dengan ID ".$_POST['id']."");
								$d['hasil'] = "Peminjaman Buku dengan ID ".$_POST['id']." <br>berhasil dihapus!<br><a href='peminjaman/tambah'>Tambah baru</a> <a href='javascript:window.close()'>Tutup</a>";
								$d['menu'] = $this->load->view('list_head');
								$d['content'] = $this->load->view('peminjaman/notif',$d,true);
								$this->load->view('HomeView',$d);


					}else{ header('location:'.base_url()); }
			
			}else{


						// MENAMPILKAN DATA INDEX PEMINJAMAN
						$d['title'] ="Daftar Peminjaman";
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
						$config['base_url'] = site_url() . '/peminjaman/index';
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
						$d['content']= $this->load->view('peminjaman/List',$d,true);
						$this->load->view('HomeView',$d);
			}


		}elseif(($this->session->userdata('user')!="") AND ($this->session->userdata('is_active') ==0)){
			redirect('home');
		}else{
			redirect('login');
		}

	}



	function tambah(){

					$d['title']		= 'Form Peminjaman Buku';
					$d['menu']		= $this->load->view('list_head');

					$d['data'] = $this->AppModel->manualQuery("SELECT * FROM vw_tampil_pinjam where status='1'");
					$d['content']	= $this->load->view('peminjaman/form_pinjam',$d,true);
					$d['content']	.= $this->load->view('peminjaman/list_popUp',$d,true);
					$this->load->view('HomeView',$d);
					$this->AppModel->activity($d['title'],'');
	}
#End of File Catalog.php
#Created by Lentinganjariku
}