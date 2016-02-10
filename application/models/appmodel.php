<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppModel extends CI_Model {

	/*
		###	Controller : AppModel.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	function entries() {
          $this->db->select('judul');
          $this->db->like('judul', $this->input->post('queryString'), 'both'); 
          return $this->db->get('tb_buku', 10);  
     }


	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
	function setting($table,$data)
	{
		$sql = $this->db->query("SELECT $data as data from $table");
			foreach($sql->result() as $dt_set){
				$hasil = $dt_set->data;
			}
		return $hasil;
	}

	function activity($title,$note)
	{
		$data = array('sess_id' => $this->session->userdata['username'],
						'last_act' => $title, 'notes'=> $note, 'ip'=> $_SERVER['REMOTE_ADDR']);
		return	$sql = $this->db->insert('history_activity',$data);
	}

	
	public function selectData($table,$data){

		$sql = $this->db->get_where($table,$data);

		return $sql;
	}
	
	
	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function tgl_jam_sql($date){
		$exp =explode(' ',$date);
		$tgl = $exp[0];
		$jam = $exp[1];	 
		$exp = explode('-',$tgl);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date.' '.$jam;
	}
	
	public function tgl_jam_str($date){
		$exp =explode(' ',$date);
		$tgl = $exp[0];
		$jam = $exp[1];	 
		$exp = explode('-',$tgl);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date.' '.$jam;
	}
	
	/* Tanggal dan Jam */
	public function Jam_Now(){
		date_default_timezone_set("Asia/Jakarta");
   		$jam = date("H:i:s"); 
   		
		return $jam;
		//echo "$jam WIB";
	}
	
	public function Hari_Bulan_Indo(){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum\'at","Sabtu");
		$hari = date("w");
		$hari_ini = $seminggu[$hari];
		
		return $hari_ini;
	}
	
	public function tgl_indo($tanggal){
			date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
			$tgl = $tanggal; //date("Y m d");
			$tanggal = substr($tgl,8,2);
			$bulan = $this->AppModel->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}
	
	public function tgl_kembali($tgl){
		$n = $this->AppModel->setting("tb_setting","limit_loan");
		$nextN = mktime(0, 0, 0, date("m"), date("d") + $n, date("Y"));

		$tgl = date('Y-m-d',$nextN);
		return $tgl;

	}

	public function tgl_now_indo(){
			date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
			$tgl = date("Y m d");
			$tanggal = substr($tgl,8,2);
			$bulan = $this->AppModel->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 


	public function SendEmail($data,$data2)
	{

              $getTemp = $this->AppModel->setting("tb_setting", $data['emailTemp']);
              
              $subject = $data['subject'];
              $from = $this->AppModel->setting("tb_setting","email_def_acc");
              $ccmail = $this->AppModel->setting("tb_setting","email_def_cc"); 

              $to = $data['to'];

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
					$act = "Email sudah dikirim, silahkan buka inbox email Anda!";
					$this->AppModel->activity($data['title'],$act);
				}else{
					$act = "Email gagal dikirimkan, Pastikan konfigurasi Email atau koneksi jaringan internet Anda!";
					$this->AppModel->activity($data['title'],$act);
				}
				return $act;
	}


	public function PostalMail($data)
	{		  $title 				= $data['title'];
              $postalMailTemp	 	= $data['emailTemp'];
              $user_id 				= $data['user_id'];

              $data3 	= array('user_id'=> $user_id,'rec_data'=>$data4,'content'=>$content,'status'=>0);
			  $this->AppModel->insertData("tb_postalMail",$data3);

              $act = "Postal Mail data has been saved with user_id = $user_id";
			  if($this->AppModel->activity($data['title'],$act))
			  {
				  $hasil = "Data berhasil disimpan dengan user id $user_id<br/><a href='user'>Tampilkan Data</a><a href='user/addnew'>Tambah Baru</a><a href='user/'>Postal Mail</a>";
			  }else{
				 $hasil = "Data Postal mail gagal disimpan! Silahkan coba lagi!";
		  	  }
		return $hasil;
	}







	
/* End of file AppModel.php */
/* Location: ./application/models/AppModel.php */
}