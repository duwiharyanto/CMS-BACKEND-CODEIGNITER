<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/Master.php';	
class Admin extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		$this->userlevel=$this->session->userdata('user_level');
		$this->cekuseradmin();
	}
	//VARIABEL
	private $master_tabel="user";
	private $default_url="user/admin/";
	private $default_view="user/admin/";
	private $view="template/backend";
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
	private function get_data($data){
		$query=array(
			'tabel'=>$data['tabel'],
			'order'=>array('kolom'=>$data['id'],'orderby'=>'DESC'),
		);	
		if($data['limit']){
			$query['limit']=$data['limit'];
		}	
		return $query;
	}	
	private function getrow($id){
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array(array($this->id=>$id))
		);
		return $this->Crud->read($query)->row();
	}	
	public function index()
	{
		$global_set=array(
			'submenu'=>false,
			'headline'=>'user',
			'url'=>'user/admin/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'user_nama'=>$this->input->post('user_nama'),
				'user_username'=>$this->input->post('user_username'),
				'user_terdaftar'=>date('Y-m-d',strtotime($this->input->post('user_tersimpan'))),
				'user_password'=>$this->input->post('user_password'),
				'user_email'=>$this->input->post('user_email'),
				'user_level'=>$this->input->post('user_level'),
				'user_status'=>$this->input->post('user_status'),
			);
			// $file='fileupload';
			// if($_FILES[$file]['name']){
			// 	if($this->uploadgambar($this->path,$file)){
			// 		$file=$this->upload->data('file_name');
			// 		$data['user_path']=$file;
			// 	}else{
			// 		$this->session->set_flashdata('error',$this->upload->display_errors());
			// 		redirect(site_url($this->default_url));
			// 	}
			// }
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
			);
			$insert=$this->Crud->insert($query);
			$this->notifiaksi($insert);
			redirect(site_url($this->default_url));
		}else{
			$data=array(
				'global'=>$global,
				'menu'=>$this->menu($this->userlevel),
			);			
			$this->load->view($this->view,$data);
			//$this->dumpdata($data);
		}
	}
	public function tabel(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'data',
			'url'=>'user/admin/',
		);
		$global=$this->global_set($global_set);
		$post=array(
			'tabel'=>$this->master_tabel,
			'id'=>$this->id,
			'limit'=>false,
		);			
		//PROSES TAMPIL DATA
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->read($this->get_data($post))->result(),
		);
		$this->load->view($this->default_view.'tabel',$data);		
		//$this->dumpdata($data);
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'user',
			'url'=>'user/admin/', //AKAN DIREDIRECT KE INDEX
		);
		$global=$this->global_set($global_set);
		$kategori=array(
			'tabel'=>'kategori',
			'order'=>array('kolom'=>'kategori_id','orderby'=>'ASC'),
		);		
		$data=array(
			'kategori'=>$this->Crud->read($kategori)->result(),
			'global'=>$global,
			);
		$this->load->view($this->default_view.'add',$data);		
	}	
	public function edit(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>'user/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'user_nama'=>$this->input->post('user_nama'),
				'user_username'=>$this->input->post('user_username'),
				'user_terdaftar'=>date('Y-m-d',strtotime($this->input->post('user_tersimpan'))),
				'user_password'=>$this->input->post('user_password'),
				'user_email'=>$this->input->post('user_email'),
				'user_level'=>$this->input->post('user_level'),
				'user_status'=>$this->input->post('user_status'),
			);
			// $file='fileupload';
			// if($_FILES[$file]['name']){
			// 	if($this->fileupload($this->path,$file)){
			// 		$file=$this->upload->data('file_name');
			// 		$data['user_path']=$file;
			// 	}else{
			// 		$this->session->set_flashdata('error',$this->upload->display_errors());
			// 		redirect(site_url($this->default_url));
			// 	}
			// }			
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
				'where'=>array(array($this->id=>$id)),
			);	
			$kategori=array(
				'tabel'=>'kategori',
				'order'=>array('kolom'=>'kategori_id','orderby'=>'ASC'),
			);				
			$data=array(
				'data'=>$this->Crud->read($query)->row(),
				'kategori'=>$this->Crud->read($kategori)->result(),
				'global'=>$global,
			);
			$this->load->view($this->default_view.'edit',$data);
			//$this->dumpdata($data);
		}
	}	
	public function detail(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'detail pendaftaran',
			'url'=>'admin/pendaftaran/edit',
		);
		$global=$this->global_set($global_set);		
		$id=$this->input->post('id');
		$query=array(
			'select'=>'a.pendaftaran_id,a.pendaftaran_userid,a.pendaftaran_tgl,a.pendaftaran_judul,a.pendaftaran_keterangan,a.pendaftaran_file,a.pendaftaran_tersimpan,b.user_username,b.user_email',
			'tabel'=>'pendaftaran a',
			'join'=>array(array('tabel'=>'user b','ON'=>'b.user_id=a.pendaftaran_userid','jenis'=>'inner')),
			'order'=>array('kolom'=>'a.pendaftaran_id','orderby'=>'ASC'),
			'where'=>array('a.pendaftaran_id'=>$id),
		);
		$data=array(
			'data'=>$this->Crud->join($query)->row(),
			'global'=>$global,
		);
		$this->load->view($this->default_view.'detail',$data);		
	}

	public function hapus($id){
		$row=$this->getrow($id);
		if($row->user_path){
			$path=$this->path.$row->user_path;
			unlink($path);
		}
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
