<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

public function __construct()
{
	parent::__construct();
	if ($this->session->userdata('level')!='kasir') {
			redirect('Home','refresh');
		}
	$this->load->model('M_Buku');
	$this->load->model('M_Transaksi');
}
	public function index()
	{
		$data['judul']="History Penjualan";
		$data['konten']="v_history";
		$data['phsearch']="Cari Berdasarkan Nama Kasir";
		$data['searchaction']=base_url()."index.php/Transaksi";
		$data['aktif']="history";
		$data['linktambah']="#";
		$data['btntambah']="#";
		$data['form_tambah']="#";
		$data['transaksi']=$this->M_Transaksi->getTransaksi();
		$this->load->view('header', $data);
	}
	public function TambahTransaksi($kode)
	{
		$buku=$this->M_Buku->getDetailBuku($kode);
		if($this->input->post('totalbeli')>$buku->stok){
			$this->session->set_flashdata('pesan', 'Pesanan anda melebihi stok');
		}
		else{
		$data = array(
			'id'      => $kode,
			'qty'     => $this->input->post('totalbeli'),
			'price'   => $buku->harga-($buku->harga*$buku->diskon/100),
			'name'    => $buku->judul,
			'options' => array('gambarbuku' => $buku->foto_cover, 'kategori' => $buku->nama_kategori,'diskon'=>$buku->diskon)
		);
		
		if($this->cart->insert($data)){
			$stokawal=$buku->stok;
			$stokakhir=$stokawal- $this->input->post('totalbeli');
			$this->M_Buku->updateStokBuku($kode,$stokakhir);
		}
		}
		redirect('Home/DataBuku','refresh');
	}
	public function UpdateTotalBeli($rowid)
	{
		$cart = $this->cart->get_item($rowid);
		$buku=$this->M_Buku->getDetailBuku($cart['id']);
		if($this->input->post('totalbeli')>$buku->stok){
			$this->session->set_flashdata('pesan_update_cart', 'Total beli melebihi stok');
		}
		else{
		if($cart['qty']>$this->input->post('totalbeli')){
			$stok = $cart['qty']-$this->input->post('totalbeli');
			$stokawal = $buku->stok;
			$stokakhir = $stokawal+$stok;
			$this->M_Buku->updateStokBuku($cart['id'],$stokakhir);
		}
		else if($cart['qty']<$this->input->post('totalbeli')){
			$stok = $this->input->post('totalbeli')-$cart['qty'];
			$stokawal = $buku->stok;
			$stokakhir = $stokawal-$stok;
			$this->M_Buku->updateStokBuku($cart['id'],$stokakhir);
		}
		$data = array(
			'rowid' => $rowid,
			'qty'   => $this->input->post('totalbeli')
		);
		$this->cart->update($data);
		}
		redirect('Home/DataBuku','refresh');
	}
	public function ProsesCheckout()
	{
		if($this->input->post('bayar')<$this->cart->total()){
			$this->session->set_flashdata('pesan_update_cart', 'Bayar kurang dari total');
			redirect('Home','refresh');
		}else{
			foreach ($this->cart->contents() as $c) {
			$buku = $this->M_Buku->getDetailBuku($c['id']);
			$this->M_Buku->updateLaku($buku->terjual+$c['qty'],$c['id']);
			}
		$kode=$this->M_Transaksi->checkout();
		if ($kode>0) {
			$this->cart->destroy();
			redirect('Transaksi/CetakNota/'.$kode,'refresh');
		}
		}
	}
	public function CetakNota($kodeTransaksi)
	{
		$data['detail_transaksi']=$this->M_Transaksi->getDetailTransaksi($kodeTransaksi);
		$this->load->view('v_cetaknota', $data);
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */