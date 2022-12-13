<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		// check_admin();
		$this->load->model(['model_produk', 'model_pembeli', 'model_pemesanan', 'model_penjual']);
	}

	public function laptransaksi()
	{
		$data = array(
			'title'				=> 'Laporan Transaksi',
			'row'				=> $this->model_pemesanan->get(),
			'act_transaksi'		=> 'active',
			'act_transaksi1'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('transaksi/transaksipembeli');
		$this->load->view('templates/backend_footer');
	}

	public function transaksiPenjual()
	{
		#menampilkan data penjual berdasarkan id user login
		$profil = $this->model_penjual->byIdUser($this->fungsi->user_login()->user_id)->row();
		#menampilkan data transaksi pembeli untuk mendapatkan id pembeli
		$transaksi = $this->model_pemesanan->transaksiPenjual($profil->id_penjual)->result_array();
		#menampilkan data transaksi pembeli, lalu menampilkan datanya ke dalam tabel
		$transaksi2 = $this->model_pemesanan->transaksiPenjual($profil->id_penjual);

		$data = array(
			'title'				=> 'Transaksi',
			'row'				=> $transaksi2,
			'profil' 			=> $profil,
			'act_transaksi'		=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('transaksi/transaksipenjual');
		$this->load->view('templates/backend_footer');
	}

	public function transaksisaya()
	{
		$data = array(
			'title'				=> 'Transaksi Saya',
			'row'				=> $this->model_pemesanan->transaksisaya($this->fungsi->user_login()->user_id),
			'act_transaksisaya'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('transaksi/transaksisaya');
		$this->load->view('templates/backend_footer');
	}

	public function kirimbarang($id)
	{
		$params = array(
			'status'     => 1
		);

		$this->db->where('id_do', $id);
		$this->db->update('tb_detail_order', $params);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("sukses", "<small>Barang sudah berhasil dikirim</small>");
		}

		redirect('transaksi/laptransaksi');
	}

	public function terimabarang($id)
	{
		$params = array(
			'status'     => 2
		);

		$this->db->where('id_do', $id);
		$this->db->update('tb_detail_order', $params);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("sukses", "<small>Barang sudah diterima</small>");
		}

		redirect('transaksi/transaksisaya');
	}

	public function konfirmasiPembayaran($id)
	{
		$params = array(
			'status_order'     => 2
		);

		$this->db->where('id_order', $id);
		$this->db->update('tb_order', $params);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("sukses", "<small>Konfirmasi pembayaran selesai.</small>");
		}

		redirect('transaksi/laptransaksi');
	}
}
