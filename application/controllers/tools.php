<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Tools extends CI_Controller{
	/*
		###	Controller : Tools.php
		###	by Topan Pandenis
		###	http://lentinganjariku.wordpress.com
	*/
	public function index(){
			$d['title'] ="General Setting";
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
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

}