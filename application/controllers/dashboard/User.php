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
	private $default_url="dashboard/user/";
	private $default_view="dashboard/user/";
	private $view="template/backend";
	private $id="post_id";

	private function global_set($data){
		$data=array(
			'menu'=>'dashboard',
			'submenu_menu'=>false,
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-tasks",
			'view'=>"views/dashboard/user/index.php",
			'detail'=>true,
			'edit'=>false,
			'delete'=>false,
		);
		return (object)$data;
	}		
	public function index()
	{

		$global_set=array(
			'submenu'=>false,
			'headline'=>'dashboard',
			'url'=>'dashboard/user/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'nama'=>$this->input->post('nama'),
				'tgllahir'=>date('Y-m-d',strtotime($this->input->post('tgllahir'))),
				'nomerhp'=>$this->input->post('nomerhp'),
				'desa'=>$this->input->post('desa'),
			);
			$file='fileupload';
			if($_FILES[$file]['name']){
				if($this->fileupload($this->path,$file)){
					$file=$this->upload->data('file_name');
					$data['pendaftaran_file']=$file;
					//print_r($data);
				}else{
					$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect(site_url($this->default_url));
				}
			}
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
				'where'=>array('status'=>'lulus')
			);
			$insert=$this->Crud->insert($query);
			$this->notifiaksi($insert);
			redirect(site_url($this->default_url));
			//print_r($data);
		}else{
			$data=array(
				'global'=>$global,
				'menu'=>$this->menu($this->userlevel),
			);			
			$this->load->view($this->view,$data);
			//$this->dumpdata($data);
		}
	}
	private function get_data($data){
		$query=array(
			'tabel'=>$data['tabel'],
			'order'=>array('kolom'=>$data['id'],'orderby'=>'DESC'),
			'limit'=>$data['limit'],
		);		
		return $query;
	}
	public function tabel(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'data',
			'url'=>'dashboard/user/',
		);
		$global=$this->global_set($global_set);
		$post=array(
			'tabel'=>$this->master_tabel,
			'id'=>$this->id,
			'limit'=>10,
		);
		$media=array(
			'tabel'=>'media',
			'id'=>'media_id',
			'limit'=>10,
		);
		$user=array(
			'tabel'=>'user',
			'id'=>'user_id',
			'limit'=>10,
		);				
		//PROSES TAMPIL DATA
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->read($this->get_data($post))->result(),
			'media'=>$this->Crud->read($this->get_data($media))->result(),
			'user'=>$this->Crud->read($this->get_data($user))->result(),
		);
		$this->load->view($this->default_view.'tabel',$data);		
		//$this->dumpdata($data);
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'dashboard',
			'url'=>'dashboard/user/', //AKAN DIREDIRECT KE INDEX
		);
		$user=array(
			'tabel'=>"user",
			'order'=>array('kolom'=>'user_id','orderby'=>'DESC'),
			);		
		$global=$this->global_set($global_set);
		$data=array(
			//'user'=>$this->Crud->read($user)->result(),
			'global'=>$global,
			);

		$this->load->view($this->default_view.'add',$data);		
	}	
	public function edit(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>'dashboard/user/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'nama'=>$this->input->post('nama'),
				'tgllahir'=>date('Y-m-d',strtotime($this->input->post('tgllahir'))),
				'nomerhp'=>$this->input->post('nomerhp'),
				'desa'=>$this->input->post('desa'),
				//'pendaftaran_tersimpan'=>date('Y-m-d')
			);
			// $file='fileupload';
			// if($_FILES[$file]['name']){
			// 	if($this->fileupload($this->path,$file)){
			// 		$file=$this->upload->data('file_name');
			// 		$data['pendaftaran_file']=$file;
			// 		//print_r($data);
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
				'where'=>array('id'=>$id),
			);
			$user=array(
				'tabel'=>"user",
				'order'=>array('kolom'=>'user_id','orderby'=>'ASC'),
				);			
			$data=array(
				'data'=>$this->Crud->read($query)->row(),
				'global'=>$global,
			);
			//print_r($data['data']);
			$this->load->view($this->default_view.'edit',$data);
		}
	}	
	public function detail(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'detail pendaftaran',
			'url'=>'user/pendaftaran/edit',
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
