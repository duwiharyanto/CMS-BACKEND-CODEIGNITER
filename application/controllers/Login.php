<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/Master.php';	
class Login extends Master
	{
		function __construct(){
			parent::__construct();
			$this->load->model('Crud');
		}
		private $master_tabel='user';
		private $id='user_id';

		function index($param=null){
			$this->cekloginuser();
			//JIKA PARAM DISET
			if($param=='logout'){
				$this->session->set_flashdata('success','Logout Berhasil');
			}
			$this->load->view('template/login');
			//redirect(site_url('crud/admin'));
		}
		function aksi_login(){
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array(array('user_username'=>$username),array('user_password'=>$password)),
				'limit'=>1,
			);
			$cek_user=$this->Crud->read($query);
			if($cek_user->num_rows()==1){
				$user=$cek_user->row();
				$dt_session=array(
					'user_id'=>$user->user_id,
					'user_username'=>$user->user_username,
					'user_nama'=>$user->user_nama,
					'user_level'=>$user->user_level,
					'user_terdaftar'=>$user->user_terdaftar,
					'user_email'=>$user->user_email,
					'login'=>true,
				);
				$this->session->set_userdata($dt_session);				
				if($this->session->userdata('user_level')==1){
				  redirect(site_url("dashboard/admin"));
				}else{
				  redirect(site_url("dashboard/user"));	
				}
			}else{
				$this->session->set_flashdata('error','username tidak ditemukan');
				redirect(base_url('Login'));
			}
		}
		function logout(){
			$this->session->sess_destroy();
			redirect(site_url('Login/index/logout'));
		}	
	
	}
?>