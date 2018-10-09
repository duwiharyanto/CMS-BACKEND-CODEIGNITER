<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/Master.php';	
class User extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		$this->userlevel=$this->session->userdata('user_level');
		$this->cekuser();
	}
	//VARIABEL
	private $master_tabel="post";
	private $default_url="berita/user/";
	private $default_view="berita/user/";
	private $view="template/backend";
	private $id="post_id";
	private $path='./upload/featuredimage/';

	private function global_set($data){
		$data=array(
			'menu'=>'berita',
			'submenu_menu'=>'berita',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-tags",
			'view'=>"views/berita/user/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}
	private function uploadform(){
		$file='fileupload';
		if($_FILES[$file]['name']){
			if($this->uploadgambar($this->path,$file)){
				$fileupload=$this->upload->data('file_name');
			}else{
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect(site_url($this->default_url));
			}
		}
		return $fileupload;		
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

	public function index()
	{
		$global_set=array(
			'submenu'=>false,
			'headline'=>'berita',
			'url'=>'berita/user/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'post_judul'=>$this->input->post('post_judul'),
				'post_status'=>$this->input->post('post_status'),
				'post_idkategori'=>$this->input->post('post_idkategori'),
				'post_post'=>$this->input->post('post_post'),
				'post_tersimpan'=>date('Y-m-d',strtotime($this->input->post('post_tersimpan'))),
			);
			$data['post_featuredimage']=$this->uploadform();
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
			'url'=>'berita/user/',
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
			'headline'=>'berita',
			'url'=>'berita/user/', //AKAN DIREDIRECT KE INDEX
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
			'url'=>'berita/user/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'post_judul'=>$this->input->post('post_judul'),
				'post_status'=>$this->input->post('post_status'),
				'post_idkategori'=>$this->input->post('post_idkategori'),
				'post_post'=>$this->input->post('post_post'),
				'post_tersimpan'=>date('Y-m-d',strtotime($this->input->post('post_tersimpan'))),
			);
			$upload=$this->uploadform();
			if($upload){
				//AMBIL FILLAMA DAN KEMUDIAN HAPUS
				$filelama=array(
					'tabel'=>$this->master_tabel,
					'kolomid'=>$this->id,
					'valueid'=>$id,
					'kolomfile'=>'post_featuredimage',
					'path'=>$this->path,
				);
				$this->hapusfileupload($filelama);				
				$data['post_featuredimage']=$upload;			
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
			$kategori=array(
				'tabel'=>'kategori',
				'order'=>array('kolom'=>'kategori_id','orderby'=>'ASC'),
			);				
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array(array($this->id=>$id)),
			);					
			$data=array(
				'kategori'=>$this->Crud->read($kategori)->result(),
				'data'=>$this->Crud->read($query)->row(),
				'global'=>$global,
			);
			$this->load->view($this->default_view.'edit',$data);
			//$this->dumpdata($data);
		}
	}	
	public function hapus($id){
		$data=array(
			'tabel'=>$this->master_tabel,
			'kolomid'=>$this->id,
			'valueid'=>$id,
			'kolomfile'=>'post_featuredimage',
			'path'=>$this->path,
		);
		$this->hapusfileupload($data);
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array($this->id=>$id),
		);
		$delete=$this->Crud->delete($query);
		$this->notifiaksi($delete);
		redirect(site_url($this->default_url));
	}
	// public function downloadberkas($file){
	// 	$path=$this->path;
	// 	$this->downloadfile($path,$file);
	// }
	// public function detail(){
	// 	$global_set=array(
	// 		'submenu'=>false,
	// 		'headline'=>'detail pendaftaran',
	// 		'url'=>'user/pendaftaran/edit',
	// 	);
	// 	$global=$this->global_set($global_set);		
	// 	$id=$this->input->post('id');
	// 	$query=array(
	// 		'select'=>'a.pendaftaran_id,a.pendaftaran_userid,a.pendaftaran_tgl,a.pendaftaran_judul,a.pendaftaran_keterangan,a.pendaftaran_file,a.pendaftaran_tersimpan,b.user_username,b.user_email',
	// 		'tabel'=>'pendaftaran a',
	// 		'join'=>array(array('tabel'=>'user b','ON'=>'b.user_id=a.pendaftaran_userid','jenis'=>'inner')),
	// 		'order'=>array('kolom'=>'a.pendaftaran_id','orderby'=>'ASC'),
	// 		'where'=>array('a.pendaftaran_id'=>$id),
	// 	);
	// 	$data=array(
	// 		'data'=>$this->Crud->join($query)->row(),
	// 		'global'=>$global,
	// 	);
	// 	$this->load->view($this->default_view.'detail',$data);		
	// }	
}
