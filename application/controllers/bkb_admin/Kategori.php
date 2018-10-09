<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		if(($this->session->userdata('login')!=true) || ($this->session->userdata('login')!=1) ){
			redirect(site_url('login/logout'));
		}
	}
	private $master_tabel="kategori";
	private $default_url="backend/kategori";
	private $default_view="backend_admin/kategori/";
	private $view="backend";

	private function global_set($data){
		$data=array(
			'menu'=>'master',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-database",
			'view'=>"backend_admin/kategori/index.php",
			'msg_success'=>"proses berhasil",
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
			'submenu'=>'kategori',
			'headline'=>'kategori',
			'url'=>'backend/kategori/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			$data=array(
				'kategori_kode'=>$this->input->post('kategori_kode'),
				'kategori_nama'=>$this->input->post('kategori_nama'),
			);
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
			);
			$insert=$this->Crud->insert($query);
			if($insert==1){
				$this->session->set_flashdata('success',$global->msg_success);
			}else{
				$this->session->set_flashdata('error',$insert);
			}
			redirect(site_url($this->default_url));
		}else{
			$query=array(
				'tabel'=>$this->master_tabel,
				'order'=>array('kolom'=>'kategori_id','orderby'=>'ASC'),
				);
			$data=array(
				'global'=>$global,
				'data'=>$this->Crud->read($query)->result(),
			);
			$this->load->view($this->view,$data);
			//print_r($data['data']);
		}
	}
	public function edit(){
		$global_set=array(
			'submenu'=>'kategori',
			'headline'=>'edit kategori',
			'url'=>'backend/kategori/edit',
		);
		$global=$this->global_set($global_set);
		$kategori_id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'kategori_nama'=>$this->input->post('kategori_nama'),
				'kategori_kode'=>$this->input->post('kategori_kode'),
			);
			$query=array(
				'data'=>$data,
				'where'=>array('kategori_id'=>$kategori_id),
				'tabel'=>$this->master_tabel,
				);
			$update=$this->Crud->update($query);
			$this->notifiaksi($update);
			redirect(site_url($this->default_url));
		}else{
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array('kategori_id'=>$kategori_id),
			);
			$data=array(
				'data'=>$this->Crud->read($query)->row(),
				'global'=>$global,
				);
			$this->load->view($this->default_view.'edit',$data);
		}
	}	
	public function hapus($id){
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array('kategori_id'=>$id),
			);
		$delete=$this->Crud->delete($query);
		$this->notifiaksi($delete);
		redirect(site_url($this->default_url));
	}
}
