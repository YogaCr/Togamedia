<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Buku extends CI_Model {

public function getBuku()
	{
		if($this->input->get('searchBox')){
		return $this->db->join('kategori','kategori.kode_kategori=buku.kode_kategori')->like('judul',$this->input->get('searchBox'))->get('buku');	
		}
		return $this->db->join('kategori','kategori.kode_kategori=buku.kode_kategori')->get('buku');
	}	
	public function getKategori()
	{
		if($this->input->get('searchBox')){
		return $this->db->like('nama_kategori',$this->input->get('searchBox'))->get('kategori');	
		}
		return $this->db->get('kategori');
	}
	public function getDetailBuku($kode)
	{
		return $this->db->join('kategori','kategori.kode_kategori=buku.kode_kategori')->where('kode_buku',$kode)->get('buku')->row();
	}
	public function updateStokBuku($kode,$stok)
	{
		$object = array('stok' => $stok );
		return $this->db->where('kode_buku',$kode)->update('buku', $object);
	}
	public function insertBuku($gambarbuku)
	{
		$object = array('kode_buku' => $this->input->post('kode_buku'),
		'judul'=>$this->input->post('Judul'),'tahun'=>$this->input->post('Tahun'),'kode_kategori'=>$this->input->post('Kategori'),'harga'=>$this->input->post('Harga'),'foto_cover'=>$gambarbuku,'penulis'=>$this->input->post('Penulis'),'penerbit'=>$this->input->post('Penerbit'),'stok'=>$this->input->post('Stok'),'diskon'=>$this->input->post('Diskon') );
		return $this->db->insert('buku', $object);
	}
	public function updateLaku($laku,$kode)
	{
		$object = array('terjual' => $laku );
		return $this->db->where('kode_buku',$kode)->update('buku', $object);
	}
	public function updateBuku($kode,$gambarbuku)
	{
		if($gambarbuku==""){
			$object = array('kode_buku' => $this->input->post('kode_buku'),
			'judul'=>$this->input->post('judul'),
			'penulis'=>$this->input->post('penulis'),
			'penerbit'=>$this->input->post('penerbit'),
			'tahun'=>$this->input->post('tahunterbit'),
			'kode_kategori'=>$this->input->post('kategori'),
			'stok'=>$this->input->post('stok'),
			'harga'=>$this->input->post('harga'),
			'diskon'=>$this->input->post('diskon') ,
		);
		}
		else{
			$object = array('kode_buku' => $this->input->post('kode_buku'),
			'judul'=>$this->input->post('judul'),
			'penulis'=>$this->input->post('penulis'),
			'penerbit'=>$this->input->post('penerbit'),
			'tahun'=>$this->input->post('tahunterbit'),
			'kode_kategori'=>$this->input->post('kategori'),
			'stok'=>$this->input->post('stok'),
			'harga'=>$this->input->post('harga'),
			'foto_cover'=>$gambarbuku,
			'diskon'=>$this->input->post('diskon') );
		}
		return $this->db->where('kode_buku',$kode)->update('buku', $object);
	}
	public function deleteBuku($kode)
	{
		return $this->db->where('kode_buku',$kode)->delete('buku');
	}
	public function insertKategori()
	{
		$object = array('nama_kategori' => $this->input->post('name'));
		return $this->db->insert('kategori', $object);
	}
	public function updateKategori($kode)
	{
		$object = array('nama_kategori' => $this->input->post('name'));
		return $this->db->where('kode_kategori',$kode)->update('kategori', $object);
	}
	public function deleteKategori($kode)
	{
		return $this->db->where('kode_kategori',$kode)->delete('kategori');
	}
}

/* End of file M_Buku.php */
/* Location: ./application/models/M_Buku.php */