<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		// check_admin();
		$this->load->model(['model_kategori', 'model_brand']);
	}

	public function index()
	{
		$data = array(
			'title'             => 'Kategori',
			'row'               => $this->model_kategori->get(),
			'act_kategori'		=> 'active',
			'act_kategori1'		=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('kategori/data');
		$this->load->view('templates/backend_footer');
	}

	public function tambah()
	{
		$kategori = new stdClass;
		$kategori->id_kategori      = null;
		$kategori->nama_kategori 	= null;

		$query_brand = $this->model_brand->get();
		$brand[null] = '-Pilih Brand-';
		foreach ($query_brand->result() as $brn) {
			$brand[$brn->id_brand] = ucfirst($brn->nama_brand);
		}

		$data = array(
			'title'			=> 'Kategori',
			'page'			=> 'tambah',
			'row'			=> $kategori,
			'brand'			=> $brand,
			'selectedbrand'	=> null,
			'idkategori' 	=> $this->model_kategori->idkategori(),
			'act_kategori'	=> 'active',
			'act_kategori2'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('kategori/kategori_form');
		$this->load->view('templates/backend_footer');
	}

	public function edit($id)
	{
		$query = $this->model_kategori->get($id);

		if ($query->num_rows() > 0) {

			$query_brand = $this->model_brand->get();
			$brand[null] = '-Pilih Brand-';
			foreach ($query_brand->result() as $brn) {
				$brand[$brn->id_brand] = ucfirst($brn->nama_brand);
			}

			$kategori = $query->row();

			$data = array(
				'title' 			=> 'Kategori',
				'page' 				=> 'edit',
				'row'				=> $kategori,
				'brand'      		=> $brand,
				'selectedbrand'		=> $kategori->id_brand,
				'act_kategori'		=> 'active'
			);
			$this->load->view('templates/backend_header', $data);
			$this->load->view('templates/backend_sidebar');
			$this->load->view('kategori/kategori_form');
			$this->load->view('templates/backend_footer');
		} else {
			echo "<script>alert('Data tidak ditemukan.');</script>";
			echo "<script>window.location='" . site_url('kategori') . "'</script>";
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);

		if (isset($_POST['tambah'])) {
			$this->form_validation->set_rules('nama_kategori', 'Nama kategori', 'required', array('required' => '%s wajib diisi'));
			$this->form_validation->set_rules('id_brand', 'Nama Brand', 'required', array('required' => '%s harus dipilih'));

			$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

			if ($this->form_validation->run() == FALSE) {
				$this->tambah();
			} else {
				if ($this->model_kategori->check_kategori($post['nama_kategori'], $post['id_kategori'], $post['id_brand'])->num_rows() > 0) {
					$brand = $this->model_brand->get($post['id_brand'])->row();
					$this->session->set_flashdata('error', "<small>Kategori <u>" . ucwords($post['nama_kategori']) . "</u> sudah ada di Brand <u>" . ucwords($brand->nama_brand) . "</u>.</small>");
					redirect('kategori/tambah');
				} else {
					$post = $this->input->post(null, TRUE);
					$this->model_kategori->add($post);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata("sukses", "<small>Kategori berhasil disimpan</small>");
					}
					redirect('kategori/tambah');
				}
			}
		} else if (isset($_POST['edit'])) {
			$this->form_validation->set_rules('nama_kategori', 'Nama kategori', 'required', array('required' => '%s wajib diisi'));
			$this->form_validation->set_rules('id_brand', 'Nama Brand', 'required', array('required' => '%s harus dipilih'));

			$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

			if ($this->form_validation->run() == FALSE) {
				$id = $this->input->post('id_kategori');
				$query = $this->model_kategori->get($id);

				if ($query->num_rows() > 0) {
					$this->edit($id);
				} else {
					echo "<script> alert('Data tidak ditemukan.');";
					echo "window.location='" . site_url('kategori') . "';</script>";
				}
			} else {
				if ($this->model_kategori->check_kategori($post['nama_kategori'], $post['id_kategori'], $post['id_brand'])->num_rows() > 0) {
					$this->session->set_flashdata('error', "<small>Kategori $post[nama_kategori] sudah ada.</small>");
					redirect('kategori/edit/' . $post['id_kategori']);
				} else {
					$this->model_kategori->edit($post);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('sukses', '<small>Data kategori berhasil diperbaharui.</small>');
					}
					redirect('kategori');
				}
			}
		}
	}

	public function hapus($id)
	{
		$this->model_kategori->del($id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('sukses', "<small>Data kategori berhasil dihapus.</small>");
		}
		redirect('kategori');
	}
}
