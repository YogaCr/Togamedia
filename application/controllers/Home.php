<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username')==null){
			redirect('User','refresh');
		}
		$this->load->model('M_Buku');
		$this->load->model('M_Transaksi');
	}

	public function index()
	{
		if($this->session->userdata('level')!='kasir'){
			redirect('Home/DataBuku','refresh');
		}
		$data['judul']="DiagramPenjualan";
		$data['konten']="v_diagram";
		$data['phsearch']="#";
		$data['searchaction']="#";
		$data['aktif']="statistik";
		$data['linktambah']="#";
		$data['btntambah']="#";
		$data['form_tambah']="#";
		$data['bukuterjual']=$this->M_Buku->getBuku();
		$this->load->view('header', $data);
	}
	public function DataBuku()
	{
		$data['judul']="Homepage";
		$data['konten']="v_daftarbuku";
		$data['phsearch']="Cari Buku";
		$data['searchaction']=base_url()."index.php/Home/DataBuku";
		$data['aktif']="buku";
		$data['linktambah']="#";
		$data['btntambah']="Tambah Buku";
		$form_tambah="<h3>Tambah</h3>
				<form method='post' action='".base_url()."index.php/Admin/ProsesTambahBuku' enctype='multipart/form-data'>
				<input type='text' name='kode_buku' class='form-control' id='signin-email' placeholder='Kode Buku' required='' style='width:80%;''>
								<br>
									<input type='text' name='Judul' class='form-control' id='signin-email' placeholder='Judul Buku' required='' style='width:80%;''>
								<br>
									<input type='text' name='Penulis' class='form-control' id='signin-email' placeholder='Penulis' required='' style='width:80%;'>
								<br>
									<input type='text' name='Penerbit' class='form-control' id='signin-email' placeholder='Penerbit' required='' style='width:80%;''>
								<br>
								<input type='number' name='Tahun' class='form-control' id='signin-email' placeholder='Tahun Terbit' required='' style='width:80%;''>
								<br>
								<input type='number' name='Harga' class='form-control' id='signin-email' placeholder='Harga' required='' style='width:80%;''>
								<br>
								<input type='number' name='Stok' class='form-control' id='signin-email' placeholder='Stok' required='' style='width:80%;''>
								<br>
								<input type='number' name='Diskon' class='form-control' id='signin-email' placeholder='Diskon' required='' style='width:80%;''>
								<br>
								Kategori : <select name='Kategori' class='form-control' style='width:80%;'>
								";
		foreach ($this->M_Buku->getKategori()->Result() as $k) {
			$form_tambah=$form_tambah."<option value='".$k->kode_kategori."'>".$k->nama_kategori."</option>";
		}
		$form_tambah=$form_tambah."</select><br>
		Gambar Buku : <input type='file' name='gambarbuku'><br>
		<button type='submit' class='btn btn-primary btn-lg btn-block' style='width:80%;'>Tambah</button></form>";
		$data['form_tambah']=$form_tambah;
		$data['kategori']=$this->M_Buku->getKategori();
		$data['buku']=$this->M_Buku->getBuku();
		$this->load->view('header', $data);
	}
	public function Logout()
	{
		if($this->cart->total_items()>0){
			foreach ($this->cart->contents() as $c) {
				$stokawal=$this->M_Buku->getDetailBuku($c['id'])->stok;
				$stokakhir = $stokawal+$c['qty'];
				$this->M_Buku->updateStokBuku($c['id'],$stokakhir);
			}
			$this->cart->destroy();
		}
		$this->session->sess_destroy();
		redirect('User','refresh');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */