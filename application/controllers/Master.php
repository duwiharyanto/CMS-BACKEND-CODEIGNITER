<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	public function __construct(){
		//$this->load->model('Crud');
		parent::__construct();
	}
	protected function notifiaksi($param){
		if($param==1){
			$this->session->set_flashdata('success','proses berhasil');
		}else{
			$this->session->set_flashdata('error',$param);
		}		
	}
	protected function dumpdata($param){
		echo "<pre>";
		print_r($param);
	}
	protected function cekloginuser(){ //KHUSUS DILOAD DI LOGIN
		if($this->session->userdata('login')==true AND $this->session->userdata('user_level')==1 ){
			redirect(site_url('dashboard/admin'));
		}elseif($this->session->userdata('login')==true AND $this->session->userdata('user_level')!=1 ){
			redirect(site_url('dashboard/user'));
		}		
	}	
	protected function cekuseradmin(){ //KHUSUS DILOAD DI CONTROLLER
		if(($this->session->userdata('login')!=true) || ($this->session->userdata('user_level')!=1) ){
			redirect(site_url('login/logout'));
		}		
	}
	protected function cekuser(){ //KHUSUS DILOAD DI CONTROLLER
		if(($this->session->userdata('login')!=true) || ($this->session->userdata('user_level')!=0) ){
			redirect(site_url('login/logout'));
		}		
	}	
	protected function fileupload($path,$file){
		$config=array(
			'upload_path'=>$path,
			'allowed_types'=>'pdf',
			'max_size'=>5000, //5MN
			'encrypt_name'=>true, //ENCTYPT
		);
		$this->load->library('upload',$config);
		return $this->upload->do_upload($file);
	}
	protected function uploadgambar($path,$file){
		$config=array(
			'upload_path'=>$path,
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>5000, //5MN
			'encrypt_name'=>true, //ENCTYPT
		);
		$this->load->library('upload',$config);
		return $this->upload->do_upload($file);
	}	
	protected function downloadfile($path,$file){
		$link=$path.$file;
		if(file_exists($link)){
			$url=file_get_contents($link);
			force_download($file,$url);
		}else{
			$this->session->set_flashdata('error','File tidak ditemukan');
		}						
	}
	protected function matauang($param){
		$level1=str_replace('Rp ', '', $param);
		$level2=str_replace('.', '', $level1);
		return $level2;
	}
	protected function menu($levelakses){
		$main_menu=array(
			'tabel'=>'menu',
			'where'=>array(array('menu_is_mainmenu'=>'0'),array('menu_status'=>'1'),array('menu_akses_level'=>$levelakses)),
			'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
		);
		$menu_akhir=array();
		$menu=$this->Crud->read($main_menu)->result();
		if(count($menu)>0){
			foreach ($menu as $index => $row) {
				$menu_akhir[$index]=$row;
				$sub_menu=array(
					'tabel'=>'menu',
					'where'=>array(array('menu_is_mainmenu '=>$row->menu_id)),
				);
				$submenu=$this->Crud->read($sub_menu)->result();
				if(count($submenu)>0){
					$menu_akhir[$index]->status=1;
					//$submenu=array();
					$menu_akhir[$index]->submenu=$submenu;
				}else{
					$menu_akhir[$index]->status=0;
					$menu_akhir[$index]->submenu=0;
				}				
			}
		}
		return $menu_akhir;		
	}	
	protected function hapusfileupload($data){
		$query=array(
			'tabel'=>$data['tabel'],
			'where'=>array(array($data['kolomid']=>$data['valueid']))
		);
		$row=$this->Crud->read($query)->row();
		$kolomfile=$data['kolomfile'];
		if($row->$kolomfile){
			$pathfull=$data['path'].$row->$kolomfile;
			unlink($pathfull);
		}		
	}	
}
