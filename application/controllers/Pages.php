<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		// check_not_login();
		// check_admin();
		$this->load->model(['model_produk', 'model_kategori', 'model_brand']);
		$this->kategori = $this->model_kategori->get();
	}

	public function produk()
	{
		$id = $this->uri->segment(3);
		// var_dump($id);
		// exit();
		$this->db->select('tb_produk.*, tb_kategori.*');
		$this->db->from('tb_produk');
		$this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
		$this->db->where('id_produk', $id);
		$cek_row = $this->db->get()->row();

		$data = array(
			'title'         => 'Produk',
			'row'        	=> $cek_row,
			'kategori'      => $this->kategori,
			'brands'	=> $this->model_brand->get(),
			'produk'	=> $this->model_produk->get(),
			'act_produk'    => 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/produk', $data);
		$this->load->view('templates/frontend_footer');
	}
}
