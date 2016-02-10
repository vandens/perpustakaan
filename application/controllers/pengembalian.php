<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Pengembalian extends CI_Controller{
	/*
		###	Controller : Peminjaman.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	public function index(){

		if(($this->session->userdata('user')!="") AND ($this->session->userdata('is_active') ==1))
		{
		
			if(isset($_POST['tampil'])){

						$d['title'] = "Simpan data order peminjaman Buku oleh ".$this->session->userdata('user')."";
						$this->form_validation->set_rules('peminjam','Peminjam','required');
						$user_id 		= $_POST['peminjam'];

						if($this->form_validation->run() == FALSE)
						{

							$this->AppModel->activity($d['title'],'Proses simpan gagal!, Validasi Error!');

							$d['menu']		= $this->load->view('list_head');
							$d['notif']		= "";
							$d['data'] 		= $this->AppModel->manualQuery("SELECT * FROM vw_tampil_pinjam where status='2' AND user_id = '$user_id'");
							$d['content']	= $this->load->view('pengembalian/form_kembali',$d,true);
							$d['content']	.= $this->load->view('pengembalian/list_popUp',$d,true);
							$this->load->view('HomeView',$d);

						}else{

							
							$d['menu']		= $this->load->view('list_head');
							$d['notif']		= "";
							$d['data'] 		= $this->AppModel->manualQuery("SELECT * FROM vw_tampil_pinjam where status='2' AND user_id = '$user_id'");
							$d['content']	= $this->load->view('pengembalian/form_kembali',$d,true);
							$d['content']	.= $this->load->view('pengembalian/list_popUp',$d,true);
							$this->load->view('HomeView',$d);
						}

			}elseif(isset($_POST['search'])){

							$d['title'] = "Data Pengembalian | Pencarian Data";
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
							$act = "Pencarian data pengembalian dengan kategori $cat, $itm, $status";
							$this->AppModel->activity($d['title'],$act);
			


		}elseif(isset($_POST['kembali'])){

					if($this->session->userdata('status') == '1'){
						

						$d['title'] = "Proses Pengembalian Buku";
						$i = "";
								for($i=0;$i<count($_POST['checkbox']);$i++){
									$id =$_POST['checkbox'][$i];
									$q = $this->AppModel->manualQuery("select * FROM vw_tampil_pinjam where id='$id'");
									
									foreach($q->result() as $data){

										$x	 	= $this->AppModel->setting("tb_setting","fine");
										$skg 	= date('Y-m-d');

										$pecah1 = explode("-", $data->tgl_wjb_kembali);
										$tgl1 	= $pecah1[2];
										$bln1 	= $pecah1[1];
										$thn1 	= $pecah1[0];
										$pecah2 = explode("-", $skg);
										$tgl2 	= $pecah2[2];
										$bln2 	= $pecah2[1];
										$thn2	= $pecah2[0];
										$jd1 = GregorianToJD($bln1, $tgl1, $thn1);
										$jd2 = GregorianToJD($bln2, $tgl2, $thn2);
										$selisih = $jd2-$jd1;
										$denda	= $selisih * $x;


									$this->AppModel->manualQuery("UPDATE tb_pinjam set status = 3,
																		tgl_kembali = '$skg',
																		denda = '$denda',
																		kembali_by = '',
																		tgl_kembali_stamp = date('Y-m-d H:i:s')
																		where id = '$id'");
									

										$q = $this->AppModel->manualQuery("SELECT kode_buku FROM tb_pinjam where id = '$id'");
									
										foreach($q->result() as $data){
											$kode = $data->kode_buku;
											$this->AppModel->manualQuery("UPDATE tb_buku set stok = stok+1 where kode = '$kode'");
										}

									}


								}

							$d['hasil'] = "Pengembalian Buku berhasil diproses!
							<br><a href='pengembalian/kembali'>Kembali</a> <a href='' onclick='javascript:window.close()'>Tutup</a>";
							//$d['menu'] = $this->load->view('list_head');
							$d['content'] = $this->load->view('pengembalian/notif',$d,true);
							$this->load->view('HomeView',$d);


					}else{ header('location:'.base_url()); }

			}elseif(isset($_POST['delete'])){
					if($this->session->userdata('status') == '1'){

								$d['title'] = "Peminjaman Buku";
								$user = $this->session->userdata('user');
								$i = "";
								for($i=0;$i<count($_POST['checkbox']);$i++){
									$id=$_POST['checkbox'][$i];
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
						$d['title'] ="Daftar Buku Dipinjam";
						$page=$this->uri->segment(3);
					
						$limit = $this->AppModel->setting("tb_setting","limit_page");
						if(!$page):
						$offset = 0;
						else:
						$offset = $page;
						endif;

						$this->AppModel->activity($d['title'],'');
						$dt 	= array('status'=>2);
						$d['tot'] = $offset;
						$tot_hal = $this->AppModel->getSelectedData("vw_tampil_pinjam",$dt);
						$config['base_url'] = site_url() . '/pengembalian/index';
						$config['total_rows'] = $tot_hal->num_rows();
						$config['per_page'] = $limit;
						$config['uri_segment'] = 3;
						$config['first_link'] = 'Awal';
						$config['last_link'] = 'Akhir';
						$config['next_link'] = 'Selanjutnya';
						$config['prev_link'] = 'Sebelumnya';
						$this->pagination->initialize($config);
						$d["paginator"] =$this->pagination->create_links();
						
						$d['data'] = $this->AppModel->getSelectedData("vw_tampil_pinjam",$dt);
						$d['menu'] =$this->load->view('menu');
						$d['content']= $this->load->view('pengembalian/List',$d,true);
						$this->load->view('HomeView',$d);
			}


		}elseif(($this->session->userdata('user')!="") AND ($this->session->userdata('is_active') ==0)){
			redirect('home');
		}else{
			redirect('login');
		}

	}



	function kembali(){

					$d['title']		= 'Form Peminjaman Buku';
					$d['menu']		= $this->load->view('list_head');
					$user_id 		= "";
					$d['notif']		= "";
					$d['data'] 		= $this->AppModel->manualQuery("SELECT * FROM vw_tampil_pinjam where status='2' AND user_id = '$user_id'");
					$d['content']	= $this->load->view('pengembalian/form_kembali',$d,true);
					$d['content']	.= $this->load->view('pengembalian/list_popUp',$d,true);
					$this->load->view('HomeView',$d);
					$this->AppModel->activity($d['title'],'');
	}
#End of File Catalog.php
#Created by Lentinganjariku
}