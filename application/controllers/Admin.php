<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

public function __construct()
{
	parent::__construct();
	if ($this->session->userdata('level')!='admin') {
		redirect('Home','refresh');
	}
	$this->load->model('M_Buku');
	$this->load->model('M_User');
}
	public function index()
	{
		redirect('Home','refresh');
	}
	public function KelolaKasir()
	{
		$data['judul']="Kelola Kasir";
		$data['konten']="v_daftarkasir";
		$data['phsearch']="Cari Kasir";
		$data['searchaction']=base_url()."index.php/Admin/KelolaKasir";
		$data['aktif']="kasir";
		$data['linktambah']="#";
		$data['btntambah']="Tambah Kasir";
		$data['form_tambah']="<h3>Tambah</h3>
				<form method='post' action='".base_url()."index.php/Admin/ProsesTambahKasir'>
				
								<input type='text' name='name' class='form-control' placeholder='Nama' required='' style='width:80%;''>
								<br>
									<input type='text' name='username' class='form-control' placeholder='Username' required='' style='width:80%;'>
								<br>
									<input type='password' name='password' class='form-control' placeholder='Password' required='' style='width:80%;'>
								<br>
								<button type='submit' class='btn btn-primary btn-lg btn-block' style='width:80%;'>Tambah</button>
							
			
			</form>";
		$data['user']=$this->M_User->getKasir();
		$this->load->view('header', $data);
	}
	public function KelolaKategori()
	{
		$data['judul']="Kelola Kategori";
		$data['konten']="v_daftarkategori";
		$data['phsearch']="Cari Kategori";
		$data['searchaction']=base_url()."index.php/Admin/KelolaKategori";
		$data['aktif']="kategori";
		$data['linktambah']="#";
		$data['btntambah']="Tambah Kategori";
		$data['form_tambah']="<h3>Tambah</h3>
				<form action='".base_url()."index.php/Admin/ProsesTambahKategori' method='post'>
								<input type='text' name='name' class='form-control' placeholder='Nama Kategori' required='' style='width:80%;''>
								<br>
								<button type='submit' class='btn btn-primary btn-lg btn-block' style='width:80%;'>Tambah</button>
			</form>";
		$data['kategori']=$this->M_Buku->getKategori();
		$this->load->view('header', $data);
	}
	public function ProsesTambahBuku()
	{
		$nama=$_FILES['gambarbuku']['name'];
		if($nama!=""){
			$config['upload_path'] = './assets/img/buku/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '3000';
			$config['max_width']  = '2000';
			$config['max_height']  = '1000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambarbuku')){
				echo $this->upload->display_errors();
			}
			else{
				if($this->M_Buku->insertBuku($this->upload->data('file_name'))){
					redirect('Home','refresh');
				}
			}
		}
		else{
			if($this->M_Buku->insertBuku($nama)){
			}
			redirect('Home','refresh');
		}
	}
	public function ProsesEditBuku($kode)
	{
		$gambar=$_FILES['gambarbuku']['name'];
		if($gambar!=""){
			$config['upload_path'] = './assets/img/buku/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '3000';
			$config['max_width']  = '2000';
			$config['max_height']  = '1000';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('gambarbuku')){
				echo $this->upload->display_errors();
			}
			else{
				if($this->M_Buku->updateBuku($kode,$this->upload->data('file_name'))){
					redirect('Home','refresh');
				}
			}
		}
		else{
			if($this->M_Buku->updateBuku($kode,$gambar)){
					redirect('Home','refresh');
			}
		}
	}
	public function HapusBuku($kode)
	{
		if($this->M_Buku->deleteBuku($kode)){
			redirect('Home','refresh');
		}
	}
	public function ProsesTambahKasir()
	{
		if($this->M_User->insertKasir()){
			redirect('Admin/KelolaKasir','refresh');
		}
	}
	public function ProsesEditKasir($kodekasir)
	{
		if($this->M_User->updateKasir($kodekasir)){
			redirect('Admin/KelolaKasir','refresh');
		}
	}
	public function HapusKasir($kode)
	{
		if($this->M_User->hapusKasir($kode)){
			redirect('Admin/KelolaKasir','refresh');
		}
	}
	public function ProsesTambahKategori()
	{
		if($this->M_Buku->insertKategori()){
			redirect('Admin/KelolaKategori','refresh');
		}
	}
	public function ProsesEditKategori($kode)
	{
		if($this->M_Buku->updateKategori($kode)){
			redirect('Admin/KelolaKategori','refresh');
		}
	}
	public function HapusKategori($kode)
	{
		if($this->M_Buku->deleteKategori($kode)){
			redirect('Admin/KelolaKategori','refresh');
		}
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */