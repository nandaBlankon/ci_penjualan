<?php defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// check_not_login();
		// check_admin();
		//load libary pagination
		$this->load->library('pagination');
		$this->load->library('cart');
		$this->load->model(['model_user', 'model_penjual', 'model_brand', 'model_produk', 'model_pembeli', 'model_pemesanan', 'model_kategori']);
	}

	public function index()
	{
		$data = array(
			'title' 	=> 'Home',
			'brands'	=> $this->model_brand->get(),
			'produk'	=> $this->model_produk->get(),
			'act_home'	=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('welcome', $data);
		$this->load->view('templates/frontend_footer');
	}

	public function tambah()
	{
		$post = $this->input->post(null);
		$brg = $this->model_produk->find($post['id']);
		$img = $this->db->query("SELECT * FROM tb_image_produk WHERE tb_image_produk.id_produk='$post[id]'");
		$gmb = $img->row();

		$data = array(
			'id'      => $brg->id_produk,
			'qty'     => 1,
			'price'   => $brg->harga,
			'name'    => url_title($brg->judul, 'dash', true),
			'image'	  => $gmb->image,
		);

		$this->cart->insert($data);

		// redirect('');
		$referred_from = $this->session->userdata('referred_from');
		redirect($referred_from, 'refresh');
	}

	function show()
	{
		$data = array(
			'title' 	=> 'Keranjang Belanja Anda',
			'brands'	=> $this->model_brand->get(),
			'produk'	=> $this->model_produk->get(),
			'act_cart'	=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pemesanan/cart', $data);
		$this->load->view('templates/frontend_footer');
	}

	public function update()
	{
		$post = $this->input->post(null);
		$data = array(
			'rowid' => $post['rowid'],
			'qty'   => $post['qty']
		);

		$this->cart->update($data);
		redirect('view-cart');
	}

	function hapus($rowid)
	{
		if ($rowid == "all") {
			$this->cart->destroy();
		} else {
			$data = array(
				'rowid' => $rowid,
				'qty' => 0
			);
			$this->cart->update($data);
		}
		redirect('view-cart');
	}

	public function login()
	{
		$data = array(
			'title' 		=> 'Login',
			'brands'	=> $this->model_brand->get(),
			'act_login'		=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('login');
		$this->load->view('templates/frontend_footer');
	}

	public function register()
	{
		$post = $this->input->post(null);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama lengkap', 'trim|required', array('required' => '%s tidak boleh kosong.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tb_user.username]', array('required' => '%s wajib diisi.', 'valid_email' => '%s ini tidak valid. Masukkan email yang benar.', 'is_unique' => '%s ini sudah terdaftar. Gunakan yang lain'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => '%s tidak boleh kosong.'));

		$this->form_validation->set_error_delimiters('<small class="text-danger small">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'title' 		=> 'Daftar',
				'brands'	=> $this->model_brand->get(),
				'act_login'		=> 'active',
				'kodeunik' 		=> $this->model_user->kodeunik(),
			);

			$this->load->view('templates/frontend_header', $data);
			$this->load->view('daftar');
			$this->load->view('templates/frontend_footer');
		} else {
			$this->model_user->add($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('sukses', 'Pendaftaran akun berhasil. Silakan login dengan email dan password anda.');
			}
			redirect('login');
		}
	}

	public function loginproses()
	{
		$post = $this->input->post(null, TRUE);

		$query = $this->model_user->login($post);

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$params = array(
				'user_id' => $row->user_id,
				'level' => $row->level,
			);
			$this->session->set_userdata($params);

			if ($row->level == 1) {
				redirect('dashboard');
			} else if ($row->level == 2) {
				redirect('');
			}
		} else {
			$this->session->set_flashdata("error", "<small>Login gagal, username atau password salah</small>");
			redirect('login');
		}
	}

	public function produk($id)
	{
		$data = array(
			'title' 		=> 'Produk',
			'produk'		=> $this->model_produk->get($id)->row(),
			'act_login'		=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/produk');
		$this->load->view('templates/frontend_footer');
	}

	public function semuaproduk()
	{
		//konfigurasi pagination
		$config['base_url'] = site_url('welcome/semuaproduk'); //site url
		$config['total_rows'] = $this->db->count_all('tb_produk'); //total row
		$config['per_page'] = 6;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		$config['first_link']       = 'Pertama';
		$config['last_link']        = 'Terakhir';
		$config['next_link']        = 'Selanjutnya';
		$config['prev_link']        = 'Sebelumnya';
		$config['full_tag_open']    = '<div class="pagging text-center">MENAMPILKAN ' . $config['per_page'] . ' DARI ' . $config['total_rows'] . ' TOTAL PRODUK <nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data = array(
			'title' 		=> 'Semua Produk',
			'produk'		=> $this->model_user->get_produk_list($config["per_page"], $data['page']),
			'brand' 			=> $this->model_brand->get()->result(),
			'penjual' 		=> $this->model_penjual->get()->result(),
			'pagination'	=> $this->pagination->create_links(),
			'act_produk'	=> 'active',
			'jumlah'		=> $config['total_rows']
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/semuaproduk.php');
		$this->load->view('templates/frontend_footer');
	}

	public function semualapak()
	{
		//konfigurasi pagination
		$config['base_url'] = site_url('welcome/semualapak'); //site url
		$config['total_rows'] = $this->db->count_all('tb_penjual'); //total row
		$config['per_page'] = 4;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		$config['first_link']       = 'Pertama';
		$config['last_link']        = 'Terakhir';
		$config['next_link']        = 'Selanjutnya';
		$config['prev_link']        = 'Sebelumnya';
		$config['full_tag_open']    = '<div class="pagging text-center">MENAMPILKAN ' . $config['per_page'] . ' DARI ' . $config['total_rows'] . ' TOTAL LAPAK <nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data = array(
			'title' 		=> 'Semua Lapak',
			'produk'		=> $this->model_produk->get()->result(),
			'brand' 			=> $this->model_brand->get()->result(),
			'penjual' 		=> $this->model_user->get_lapak_list($config["per_page"], $data['page']),
			'pagination'	=> $this->pagination->create_links(),
			'act_lapak'		=> 'active',
			'jumlah'		=> $config['total_rows']
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/semualapak.php');
		$this->load->view('templates/frontend_footer');
	}

	// public function penjual($id)
	// {
	// 	$data = array(
	// 		'title' 		=> 'Lapak Penjual',
	// 		'produk'		=> $this->model_produk->getByIdPenjual($id)->result(),
	// 		'penjual' 		=> $this->model_penjual->get($id)->row(),
	// 		'act_lapak'		=> 'active',
	// 	);

	// 	$this->load->view('templates/frontend_header', $data);
	// 	$this->load->view('penjual/penjual.php');
	// 	$this->load->view('templates/frontend_footer');
	// }

	public function brands($id)
	{
		$brand = $this->model_brand->get($id);

		$data = array(
			'title' 		=> 'Brands',
			'brand'			=> $brand->row(),
			'brands'		=> $this->model_brand->get(),
			'produk'		=> $this->model_produk->get(),
			'act_brand'		=> 'active',

		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('brand/brands');
		$this->load->view('templates/frontend_footer');
	}

	public function cats($id)
	{
		$kategori = $this->model_kategori->get($id);

		$data = array(
			'title' 		=> 'Kategori',
			'kategori'		=> $kategori->row(),
			'brands'		=> $this->model_brand->get(),
			'produk'		=> $this->model_produk->get(),
			'act_cats'		=> 'active',

		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('kategori/kategori');
		$this->load->view('templates/frontend_footer');
	}

	public function checkout()
	{
		$data = array(
			'title' 		=> 'Checkout',
			'brands'	=> $this->model_brand->get(),
			'produk'	=> $this->model_produk->get(),
			'act_lapak'		=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pemesanan/checkout');
		$this->load->view('templates/frontend_footer');
	}

	public function prosescheckout()
	{
		$post = $this->input->post(null);

		// input data order
		$order = array(
			'id_pembeli' => $post['id_pembeli'],
			'grand_total' => $post['grand_total']
		);

		$idorder = $this->model_pemesanan->tambah_order($order);


		// input data detail order
		if ($cart = $this->cart->contents()) {
			foreach ($cart as $item) {
				$data_detail = array(
					'id_order' => $idorder,
					'id_produk' => $item['id'],
					'telp' => $post['telp'],
					'alamat' => $post['alamat'],
					'kec' => $post['kec'],
					'kab' => $post['kab'],
					'qty' => $item['qty'],
					'total_harga' => $item['subtotal']
				);
				$proses = $this->model_pemesanan->tambah_detail_order($data_detail);

				$produk = $this->model_produk->get($data_detail['id_produk'])->result_array();
				$stok = $produk[0]['stok'] - $data_detail['qty'];

				$this->model_pemesanan->updateStok($produk[0]['id_produk'], $stok);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata("sukses", "Transaksi anda berhasil.");
				}
			}
		}
		$this->cart->destroy();

		redirect('pesan');
	}

	public function pesan()
	{
		$data = array(
			'title' 	=> 'Informasi',
			'brands'	=> $this->model_brand->get(),
			'produk'	=> $this->model_produk->get(),
			'act_pesan'	=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pemesanan/pesan');
		$this->load->view('templates/frontend_footer');
	}

	public function logout()
	{
		$params = array('user_id', 'level');
		$this->session->unset_userdata($params);
		redirect('');
	}

	public function tentang()
	{
		$data = array(
			'title' 		=> 'Tentang Kami',
			'act_tentang'	=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/tentang');
		$this->load->view('templates/frontend_footer');
	}

	public function kontak()
	{
		$data = array(
			'title' 		=> 'Kontak Kami',
			'act_kontak'	=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/kontak');
		$this->load->view('templates/frontend_footer');
	}

	public function carapesan()
	{
		$data = array(
			'title' 		=> 'Cara Pembayaran',
			'act_cara'		=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/carapesan');
		$this->load->view('templates/frontend_footer');
	}

	public function kebijakan()
	{
		$data = array(
			'title' 			=> 'Kebijakan Privasi',
			'act_kebijakan'		=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/kebijakan');
		$this->load->view('templates/frontend_footer');
	}

	public function syarat()
	{
		$data = array(
			'title' 			=> 'Syarat dan Ketentuan',
			'act_syarat'		=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pages/syarat');
		$this->load->view('templates/frontend_footer');
	}
}
