<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		if(($this->session->userdata('login')!=true) AND ($this->session->userdata('login')==1) ){
			redirect(site_url('login/logout'));
		}
		$this->userid=$this->session->userdata('user_id'); //variabel id sessuin uuser
	}
	private $master_tabel="datadiri"; //Tabel Master
	private $default_url="user/dashboard"; //Url redirect di kontroller
	private $default_view="frontend/dashboard/"; //url view
	private $view="frontend"; //template view
	private $id="datadiri_id"; //Global id
	private $path="./filefoto/";

	private function global_set($data){
		$data=array(
			'menu'=>'dashboard',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-user",
			'view'=>"views/frontend/dashboard/index.php", //defaul pertamakali diklik
		);
		return (object)$data;
	}
	public function fileupload($path,$file){
		$config=array(
			'upload_path'=>$path,
			'allowed_types'=>'jpg|JPEG',
			'max_size'=>5000,
			'encrypt_name'=>true,
		);

		$this->load->library('upload',$config);
		return $this->upload->do_upload($file);
	}
	public function downloadfile($path,$file){
			$link=$path.$file;
			if(file_exists($link)){
				$url=file_get_contents($link);
				force_download($file,$url);
			}else{
				$this->session->set_flashdata('error','File tidak ditemukan');
				redirect(site_url($this->default_url));	
			}						
	}	
	private function notifiaksi($param){
		if($param==1){
			$this->session->set_flashdata('success','proses berhasil');
		}else{
			$this->session->set_flashdata('error',$param);
		}		
	}
	public function index()
	{
		$global_set=array(
			'submenu'=>false,
			'headline'=>'dashboard', //headline pada view
			'url'=>'user/dashboard/', //url controller ke view
		);
		$global=$this->global_set($global_set);
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array('datadiri_iduser'=>$this->userid),
			);
		$kegiatan=array(
			'tabel'=>'kegiatan',
			'where'=>array('kegiatan_userid'=>$this->userid),
			'limit'=>'5',
			'order'=>array('kolom'=>'kegiatan_tgl','orderby'=>'DESC'),
		);
		$datadiri=$this->Crud->read($query);
		$data=array(
			'global'=>$global,
			'kegiatan'=>$this->Crud->read($kegiatan)->result(),
		);
		$data['data']=array();
		if($datadiri->num_rows()==1){
			$data['data']=$datadiri->row();
		}
		$this->load->view($this->view,$data);
		//print_r($data['kegiatan']);		
	}
	public function detail(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'detail kegiatan', //headline pada view
			'url'=>'user/dashboard/', //url controller ke view
		);
		$global=$this->global_set($global_set);		
		$id=$this->input->post('id');
		$kegiatan=array(
			'tabel'=>'kegiatan',
			'where'=>array('kegiatan_id'=>$id),
		);
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->read($kegiatan)->row(),
		);
		$this->load->view($this->default_view.'detailkegiatan',$data);
	}
}
