<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//$this->load->library('upload');
		$this->load->model('Crud');
		if(($this->session->userdata('login')!=true) || ($this->session->userdata('login')!=1) ){
			redirect(site_url('login/logout'));
		}
	}
	//VARIABEL
	private $master_tabel="kegiatan";
	private $default_url="admin/kegiatan";
	private $default_view="backend/kegiatan/";
	private $view="backend";
	private $id="kegiatan_id";
	private $path="./fileupload/";

	private function global_set($data){
		$data=array(
			'menu'=>'kegiatan',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-tasks",
			'view'=>"backend/kegiatan/index.php",
			'path_add'=>"views/backend/kegiatan/add.php",
			'path_edit'=>"views/backend/kegiatan/edit.php"
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
	public function fileupload($path,$file){
		$config=array(
			'upload_path'=>$path,
			'allowed_types'=>'pdf',
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
	public function index()
	{
		$global_set=array(
			'submenu'=>false,
			'headline'=>'kegiatan',
			'url'=>'admin/kegiatan/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'kegiatan_userid'=>$this->input->post('kegiatan_userid'),
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
			if($insert==1){
				$this->session->set_flashdata('success',$global->msg_success);
			}else{
				$this->session->set_flashdata('error',$insert);
			}
			redirect(site_url($this->default_url));
			//print_r($data);

		}else{
			//PROSES TAMPIL DATA
			$query=array(
				'select'=>'a.kegiatan_id,a.kegiatan_userid,a.kegiatan_tgl,a.kegiatan_judul,a.kegiatan_keterangan,a.kegiatan_file,a.kegiatan_tersimpan,b.user_username',
				'tabel'=>'kegiatan a',
				'join'=>array(array('tabel'=>'user b','ON'=>'b.user_id=a.kegiatan_userid','jenis'=>'inner')),
				'order'=>array('kolom'=>'a.kegiatan_id','orderby'=>'DESC'),
				);
			$data=array(
				'global'=>$global,
				'data'=>$this->Crud->join($query)->result(),
			);
			$this->load->view($this->view,$data);
			//print_r($data['data']);
		}
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'kegiatan',
			'url'=>'admin/kegiatan/',
		);
		$user=array(
			'tabel'=>"user",
			'order'=>array('kolom'=>'user_id','orderby'=>'DESC'),
			);		
		$global=$this->global_set($global_set);
		$data=array(
			'user'=>$this->Crud->read($user)->result(),
			'global'=>$global,
			);

		$this->load->view($this->default_view.'add',$data);		
	}	
	public function edit(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit kegiatan',
			'url'=>'admin/kegiatan/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'kegiatan_userid'=>$this->input->post('kegiatan_userid'),
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
				'select'=>'a.kegiatan_id,a.kegiatan_userid,a.kegiatan_tgl,a.kegiatan_judul,a.kegiatan_keterangan,a.kegiatan_file,a.kegiatan_tersimpan,b.user_username',
				'tabel'=>'kegiatan a',
				'join'=>array(array('tabel'=>'user b','ON'=>'b.user_id=a.kegiatan_userid','jenis'=>'inner')),
				'order'=>array('kolom'=>'a.kegiatan_id','orderby'=>'ASC'),
				'where'=>array('a.kegiatan_id'=>$id),
				);
			$user=array(
				'tabel'=>"user",
				'order'=>array('kolom'=>'user_id','orderby'=>'ASC'),
				);			
			$data=array(
				'data'=>$this->Crud->join($query)->row(),
				'user'=>$this->Crud->read($user)->result(),
				'global'=>$global,
			);
			//print_r($data['data']);
			$this->load->view($this->default_view.'edit',$data);
		}
	}	
	public function detail(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'detail kegiatan',
			'url'=>'admin/kegiatan/edit',
		);
		$global=$this->global_set($global_set);		
		$id=$this->input->post('id');
		$query=array(
			'select'=>'a.kegiatan_id,a.kegiatan_userid,a.kegiatan_tgl,a.kegiatan_judul,a.kegiatan_keterangan,a.kegiatan_file,a.kegiatan_tersimpan,b.user_username,b.user_email',
			'tabel'=>'kegiatan a',
			'join'=>array(array('tabel'=>'user b','ON'=>'b.user_id=a.kegiatan_userid','jenis'=>'inner')),
			'order'=>array('kolom'=>'a.kegiatan_id','orderby'=>'ASC'),
			'where'=>array('a.kegiatan_id'=>$id),
		);
		$data=array(
			'data'=>$this->Crud->join($query)->row(),
			'global'=>$global,
		);
		$this->load->view($this->default_view.'detail',$data);		
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
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
}
