<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {

	public function Login()
	{
		return $this->db->where('username',$this->input->post('username'))->where('password',$this->input->post('password'))->get('user');
	}
	public function insertKasir()
	{
		$object = array('nama_user' => $this->input->post('name'),
		'username'=>$this->input->post('username'),
		'password'=>$this->input->post('password'),
		'level'=>'kasir' );
		return $this->db->insert('user', $object);
	}	
	public function getKasir()
	{
		if($this->input->get('searchBox')){
		return $this->db->where('level','kasir')->like('nama_user',$this->input->get('searchBox'))->get('User');	
		}
		return $this->db->where('level','kasir')->get('User');
	}
	public function updateKasir($kode)
	{
		$object = array('nama_user' => $this->input->post('name'.$kode),
		'username'=>$this->input->post('username'.$kode),
		'password'=>$this->input->post('password'.$kode) );
		return $this->db->where('kode_user',$kode)->update('user', $object);
	}
	public function hapusKasir($kode)
	{
		return $this->db->where('kode_user',$kode)->delete('User');
	}
}

/* End of file M_User.php */
/* Location: ./application/models/M_User.php */