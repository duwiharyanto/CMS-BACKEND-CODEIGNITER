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
	private $master_tabel="slide";
	private $default_url="slide/admin/";
	private $default_view="slide/admin/";
	private $view="template/backend";
	private $id="slide_id";
	private $path='./upload/slide/';

	private function global_set($data){
		$data=array(
			'menu'=>'slide',
			'submenu_menu'=>false,
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-tasks",
			'view'=>"views/slide/admin/index.php",
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
			'headline'=>'slide',
			'url'=>'slide/admin/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'slide_nama'=>$this->input->post('slide_nama'),
				'slide_idkategori'=>$this->input->post('slide_idkategori'),
				'slide_tersimpan'=>date('Y-m-d',strtotime($this->input->post('slide_tersimpan'))),
			);
			$file='fileupload';
			if($_FILES[$file]['name']){
				if($this->uploadgambar($this->path,$file)){
					$file=$this->upload->data('file_name');
					$data['slide_path']=$file;
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
			'url'=>'slide/admin/',
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
			'headline'=>'slide',
			'url'=>'slide/admin/', //AKAN DIREDIRECT KE INDEX
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
			'url'=>'slide/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'slide_nama'=>$this->input->post('slide_nama'),
				'slide_idkategori'=>$this->input->post('slide_idkategori'),
				'slide_tersimpan'=>date('Y-m-d',strtotime($this->input->post('slide_tersimpan'))),
			);
			$file='fileupload';
			if($_FILES[$file]['name']){
				if($this->fileupload($this->path,$file)){
					$file=$this->upload->data('file_name');
					$data['slide_path']=$file;
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
		if($row->slide_path){
			$path=$this->path.$row->slide_path;
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
