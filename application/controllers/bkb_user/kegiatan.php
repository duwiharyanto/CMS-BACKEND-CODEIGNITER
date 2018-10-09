<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		if(($this->session->userdata('login')!=true) AND ($this->session->userdata('login')==1) ){
			redirect(site_url('login/logout'));
		}
		$this->userid=$this->session->userdata('user_id');
	}
	private $master_tabel="kegiatan"; //Tabel Master
	private $default_url="user/kegiatan"; //Url redirect di kontroller
	private $default_view="frontend/kegiatan/"; //url view
	private $view="frontend"; //template view
	private $id="kegiatan_id"; //Global id
	private $path="./fileupload/";
	
	private function global_set($data){
		$data=array(
			'menu'=>'kegiatan',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-database",
			'view'=>"views/frontend/kegiatan/index.php",
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
			'headline'=>'kegiatan', //headline pada view
			'url'=>'user/kegiatan/', //url view
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			$data=array(
				'kegiatan_userid'=>$this->userid,
				'kegiatan_tgl'=>date('Y-m-d',strtotime($this->input->post('kegiatan_tgl'))),
				'kegiatan_keterangan'=>$this->input->post('kegiatan_keterangan'),
				'kegiatan_judul'=>$this->input->post('kegiatan_judul'),
				'kegiatan_tersimpan'=>date('Y-m-d')
			);
			$file='fileupload';
			if($_FILES[$file]['name']){
				if($this->fileupload($this->path,$file)){
					$file=$this->upload->data('file_name');
					$data['kegiatan_file']=$file;
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
				'order'=>array('kolom'=>'kegiatan_id','orderby'=>'DESC'),
				'where'=>array('kegiatan_userid'=>$this->userid),
				);
			$data=array(
				'global'=>$global,
				'data'=>$this->Crud->read($query)->result(),
			);
			//echo "hello";
			//$this->load->view($this->default_view.'index.php',$data);
			$this->load->view($this->view,$data);
			//print_r($data['data']);
		}
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'kegiatan',
			'url'=>'user/kegiatan/',
		);
		$global=$this->global_set($global_set);
		$data=array(
			'global'=>$global,
			);

		$this->load->view($this->default_view.'add',$data);		
	}
	public function edit(){
		$global_set=array(
			'submenu'=>'kategori',
			'headline'=>'edit kategori',
			'url'=>'user/kegiatan/edit',//DEFAULT URL DI VIEW
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'kegiatan_tgl'=>date('Y-m-d',strtotime($this->input->post('kegiatan_tgl'))),
				'kegiatan_keterangan'=>$this->input->post('kegiatan_keterangan'),
				'kegiatan_judul'=>$this->input->post('kegiatan_judul'),
				'kegiatan_tersimpan'=>date('Y-m-d')
			);
			$file='fileupload';
			if($_FILES[$file]['name']){
				if($this->fileupload($this->path,$file)){
					$file=$this->upload->data('file_name');
					$data['kegiatan_file']=$file;
					//print_r($data);
				}else{
					$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect(site_url($this->default_url));
				}
			}				
			$query=array(
				'data'=>$data,
				'where'=>array($this->id=>$id),
				'tabel'=>$this->master_tabel,
				);
			$update=$this->Crud->update($query);
			$this->notifiaksi($update);
			redirect(site_url($this->default_url));
		}else{
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array($this->id=>$id),
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
			'where'=>array($this->id=>$id),
			);
		$delete=$this->Crud->delete($query);
		$this->notifiaksi($delete);
		redirect(site_url($this->default_url));
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
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
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
