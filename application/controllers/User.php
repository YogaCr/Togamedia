<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username')!=null) {
			redirect('Home','refresh');
		}
		$this->load->model('M_User');
	}
	public function index()
	{
		$data['konten']='v_login';
		$data['judul']='Login';
		$this->load->view('header_login', $data);
	}
	public function ProsesLogin()
	{
		$user=$this->M_User->Login();
		if($user->num_rows()>0){
			$object = array('kode_user' => $user->row()->kode_user,
			'nama_user'=>$user->row()->nama_user,
			'username'=>$user->row()->username,
			'password'=>$user->row()->password,
			'level'=>$user->row()->level );
			$this->session->set_userdata($object);
			redirect('Home','refresh');
		}
		else{
			$this->session->set_flashdata('pesan', 'Username atau password salah');
			redirect('User','refresh');
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */