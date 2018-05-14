<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

	public function checkout()
	{
		$object = array('kode_user' => $this->session->userdata('kode_user'),
		'nama_pembeli'=>$this->input->post('namapembeli'),
		'total'=>$this->cart->total(),
		'bayar'=>$this->input->post('bayar'),
		'tgl_beli'=>date('Y-m-d'));
		$this->db->insert('transaksi', $object);

		$kode_transaksi=$this->db->order_by('kode_transaksi','desc')->limit(1)->where('kode_user',$this->session->userdata('kode_user'))->get('transaksi')->row();
		foreach ($this->cart->contents() as $c) {
			$arr = array('kode_transaksi' => $kode_transaksi->kode_transaksi,'kode_buku'=>$c['id'],'jumlah'=>$c['qty'],'diskon_detail'=>$c['options']['diskon'] );
			if(!$this->db->insert('detail_transaksi', $arr)){
				break;
				$this->db->where('kode_transaksi',$kode_transaksi->kode_transaksi)->delete('transaksi');
				return 0;
			}
		}
		return $kode_transaksi->kode_transaksi;
	}
	public function getDetailTransaksi($kodeTransaksi)
	{
		return $this->db->join('transaksi','transaksi.kode_transaksi=detail_transaksi.kode_transaksi')->join('user','user.kode_user=transaksi.kode_user')->join('buku','buku.kode_buku=detail_transaksi.kode_buku')->where('detail_transaksi.kode_transaksi',$kodeTransaksi)->get('detail_transaksi')->result();
	}
	public function getAllDetailTransaksi()
	{
		return $this->db->join('transaksi','transaksi.kode_transaksi=detail_transaksi.kode_transaksi')->join('user','user.kode_user=transaksi.kode_user')->join('buku','buku.kode_buku=detail_transaksi.kode_buku')->get('detail_transaksi');
	}
	public function getTransaksi()
	{
		if($this->input->get('searchBox')){
		return $this->db->join('user','user.kode_user=transaksi.kode_user')->like('user.nama_user',$this->input->get('searchBox'))->get('transaksi');	
		}
		return $this->db->join('user','user.kode_user=transaksi.kode_user')->get('transaksi');
	}
}

/* End of file M_Transaksi.php */
/* Location: ./application/models/M_Transaksi.php */