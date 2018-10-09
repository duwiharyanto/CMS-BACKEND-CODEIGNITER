<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		if(($this->session->userdata('login')!=true) AND ($this->session->userdata('login')==1) ){
			redirect(site_url('login/logout'));
		}
		$this->userid=$this->session->userdata('user_id');
	}
	private $master_tabel="user"; //Tabel Master
	private $default_url="user/password"; //Url redirect di kontroller
	private $default_view="frontend/password/"; //url view
	private $view="frontend"; //template view
	private $id="user_id"; //Global id
	//private $path="./fileupload/";
	
	private function global_set($data){
		$data=array(
			'menu'=>'password',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-lock",
			'view'=>"views/frontend/password/index.php",
		);
		return (object)$data;
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
			'headline'=>'password', //headline pada view
			'url'=>'user/password/', //url view
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			$data=array(
				'user_username'=>$this->input->post('user_username'),
			);			
			if($this->input->post('user_password')){
				$data['user_password']=md5($this->input->post('user_password'));
			}
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
				'where'=>array($this->id=>$this->userid)
			);
			$update=$this->Crud->update($query);
			$this->notifiaksi($update);
			redirect(site_url($this->default_url));
		}else{
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array($this->id=>$this->userid),
				);
			$data=array(
				'global'=>$global,
				'data'=>$this->Crud->read($query)->row(),
			);
			$this->load->view($this->view,$data);
			//print_r($data['data']);
		}
	}	
}
