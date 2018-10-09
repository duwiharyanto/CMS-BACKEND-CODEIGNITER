<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		if(($this->session->userdata('login')!=true) || ($this->session->userdata('login')!=1) ){
			redirect(site_url('login/logout'));
		}
	}
	private $master_tabel="user";
	private $default_url="admin/user";
	private $default_view="backend/user/";
	private $view="backend";
	private $id="user_id";

	private function global_set($data){
		$data=array(
			'menu'=>'user',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-users",
			'view'=>"backend/user/index.php",
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
			'headline'=>'user',
			'url'=>'admin/user/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'user_username'=>$this->input->post('user_username'),
				'user_password'=>md5($this->input->post('user_password')),
				'user_levelid'=>$this->input->post('user_level'),
				'user_email'=>$this->input->post('user_email'),
				'user_terdaftar'=>date('Y-m-d')
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
			//PROSES TAMPIL DATA
			$query=array(
				'select'=>'a.user_id,a.user_username,a.user_password,a.user_email,a.user_levelid,a.user_terdaftar,a.user_param,b.level_keterangan',
				'tabel'=>'user a',
				'join'=>array(array('tabel'=>'level b','ON'=>'b.level_id=a.user_levelid','jenis'=>'inner')),
				'order'=>array('kolom'=>'a.user_id','orderby'=>'DESC'),
			);
			$user=$this->Crud->join($query);
			$result_user=array();
			if($user->num_rows()>0){
				$user=$user->result();
				foreach ($user as $index => $row) {
					$result_user[$index]=$row;
					$query=array(
						'tabel'=>'datadiri',
						'where'=>array('datadiri_iduser'=>$row->user_id),
						);
					$status=$this->Crud->read($query)->row();
					if($status){
						$result_user[$index]->status=1;
					}else{
						$result_user[$index]->status=0;
					}
				}
			}
			$level=array(
				'tabel'=>"level",
				'order'=>array('kolom'=>'level_id','orderby'=>'ASC'),
				);
			$data=array(
				'global'=>$global,
				'data'=>$result_user,
				'level'=>$this->Crud->read($level)->result(),
			);
			$this->load->view($this->view,$data);
			//print_r($data['data']);
		}
	}
	public function edit(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit user',
			'url'=>'admin/user/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'user_username'=>$this->input->post('user_username'),
				'user_levelid'=>$this->input->post('user_level'),
				'user_email'=>$this->input->post('user_email')
			);
			if($this->input->post('user_password')){
				$data['user_password']=md5($this->input->post('user_password'));
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
			$level=array(
				'tabel'=>"level",
				'order'=>array('kolom'=>'level_id','orderby'=>'ASC'),
				);			
			$data=array(
				'data'=>$this->Crud->read($query)->row(),
				'level'=>$this->Crud->read($level)->result(),
				'global'=>$global,
				);
			$this->load->view($this->default_view.'edit',$data);
		}
	}
	public function detail(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'detail user',
			'url'=>'admin/user/',
		);
		$global=$this->global_set($global_set);		
		$id=$this->input->post('id');
		$query=array(
			'select'=>'a.user_id,a.user_username,a.user_password,a.user_email,a.user_levelid,a.user_terdaftar,b.datadiri_nama,b.datadiri_tgllahir,
			b.datadiri_notelp,b.datadiri_alamat,b.datadiri_keterangan,b.datadiri_foto',
			'tabel'=>'user a',
			'join'=>array(array('tabel'=>'datadiri b','ON'=>'b.datadiri_iduser=a.user_id','jenis'=>'inner')),
			'where'=>array('a.user_id'=>$id),
		);
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->join($query)->row(),
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
}
