<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datadiri extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		if(($this->session->userdata('login')!=true) AND ($this->session->userdata('login')==1) ){
			redirect(site_url('login/logout'));
		}
		$this->userid=$this->session->userdata('user_id'); //variabel id sessuin uuser
	}
	private $master_tabel="datadiri"; //Tabel Master
	private $default_url="user/datadiri"; //Url redirect di kontroller
	private $default_view="frontend/datadiri/"; //url view
	private $view="frontend"; //template view
	private $id="datadiri_id"; //Global id
	private $path="./filefoto/";

	private function global_set($data){
		$data=array(
			'menu'=>'datadiri',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-user",
			'view'=>"views/frontend/datadiri/index.php", //defaul pertamakali diklik
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
			'headline'=>'data diri', //headline pada view
			'url'=>'user/datadiri/', //url controller ke view
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			$data=array(
				'datadiri_iduser'=>$this->userid,
				'datadiri_nama'=>$this->input->post('datadiri_nama'),
				'datadiri_notelp'=>$this->input->post('datadiri_notelp'),
				'datadiri_alamat'=>$this->input->post('datadiri_alamat'),
				'datadiri_keterangan'=>$this->input->post('datadiri_keterangan'),
				'datadiri_tgllahir'=>date('Y-m-d',strtotime($this->input->post('datadiri_tgllahir'))),
			);
			$file='fileupload';
			if($_FILES[$file]['name']){
				if($this->fileupload($this->path,$file)){
					$file=$this->upload->data('file_name');
					$data['datadiri_foto']=$file;
					//print_r($data);
				}else{
					$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect(site_url($this->default_url));
				}
			}			
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
			);
			$insert=$this->Crud->insert($query);
			$this->notifiaksi($insert);
			redirect(site_url($this->default_url));
		}else{
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array('datadiri_iduser'=>$this->userid),
				'limit'=>'1',
				);
			$datadiri=$this->Crud->read($query);
			$data=array(
				'global'=>$global,
			);
			$data['data']=array();
			if($datadiri->num_rows()==1){
				$data['data']=$datadiri->row();
			}
			$this->load->view($this->view,$data);
			//print_r($data['data']);
		}
	}
	public function update(){
			$data=array(
				'datadiri_nama'=>$this->input->post('datadiri_nama'),
				'datadiri_notelp'=>$this->input->post('datadiri_notelp'),
				'datadiri_alamat'=>$this->input->post('datadiri_alamat'),
				'datadiri_keterangan'=>$this->input->post('datadiri_keterangan'),
				'datadiri_tgllahir'=>date('Y-m-d',strtotime($this->input->post('datadiri_tgllahir'))),
			);
			$file='fileupload';
			if($_FILES[$file]['name']){
				if($this->fileupload($this->path,$file)){
					$file=$this->upload->data('file_name');
					$data['datadiri_foto']=$file;
					//print_r($data);
				}else{
					$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect(site_url($this->default_url));
				}
			}			
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
				'where'=>array('datadiri_iduser'=>$this->userid),
			);
			$update=$this->Crud->update($query);
			$this->notifiaksi($update);
			redirect(site_url($this->default_url));		
	}
}
