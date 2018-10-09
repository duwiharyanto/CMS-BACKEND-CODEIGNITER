<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/Master.php';	
class Home extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
	}
	//VARIABEL
	private $master_tabel="user";
	private $default_url="user/admin/";
	private $default_view="user/admin/";
	private $view="template/webfrontend";
	private $id="user_id";
	private $path='./upload/user/';

	private function global_set($data){
		$data=array(
			'menu'=>'user',
			'submenu_menu'=>false,
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-users",
			'view'=>"views/user/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'submenu'=>false,
			'headline'=>'user',
			'url'=>'user/admin/',
		);
		$global=$this->global_set($global_set);
		$data=array(
			'global'=>$global,
		);			
		$this->load->view($this->view,$data);
		//$this->dumpdata($data);
	}
}
