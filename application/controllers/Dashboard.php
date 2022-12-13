<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		// check_admin();
		$this->load->model(['model_user', 'model_produk', 'model_pembeli', 'model_brand', 'model_pemesanan', 'model_kategori']);
	}

	public function index()
	{
		if ($this->fungsi->user_login()->level == 1) {

			$tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
			$tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

			if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
				$data = array(
					'title'				=> 'Dashboard',
					'transaksi'			=> $this->model_pemesanan->get(),
					'brand'				=> $this->model_brand->get(),
					'kategori'			=> $this->model_kategori->get(),
					'produk'			=> $this->model_produk->get(),
					'act_dashboard'		=> ' active',
				);
			} else { // Jika terisi
				$transaksi = $this->model_pemesanan->view_by_date($tgl_awal, $tgl_akhir);

				$data = array(
					'title'				=> 'Dashboard',
					'transaksi'			=> $this->model_pemesanan->get(),
					'brand'				=> $this->model_brand->get(),
					'kategori'			=> $this->model_kategori->get(),
					'produk'			=> $this->model_produk->get(),
					'order'				=> $transaksi,
					'act_dashboard'		=> ' active',
				);
			}
		} elseif ($this->fungsi->user_login()->level == 2) {
			$data = array(
				'title'				=> 'Dashboard',
				'act_dashboard'		=> ' active',
				// 'profil' 			=> $this->model_penjual->byIdUser($this->fungsi->user_login()->user_id)->row()
			);
		}
		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('dashboard');
		$this->load->view('templates/backend_footer');
	}

	public function datapenjual()
	{
		$data = array(
			'title'				=> 'Data Penjual',
			'row' 				=> $this->model_penjual->get(),
			'act_member'		=> 'active',
			'act_member1'		=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('admin/datapenjual');
		$this->load->view('templates/backend_footer');
	}

	public function datapembeli()
	{
		$data = array(
			'title'				=> 'Data Pembeli',
			'row' 				=> $this->model_pembeli->get(),
			'act_member'		=> 'active',
			'act_member2'		=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('admin/datapembeli');
		$this->load->view('templates/backend_footer');
	}

	public function profil()
	{
		if ($this->fungsi->user_login()->level == 1) {
			$data = array(
				'title'				=> 'Profil Saya',
				'act_profil'		=> ' active',
			);
		} elseif ($this->fungsi->user_login()->level == 2) {
			$data = array(
				'title'				=> 'Profil Saya',
				'act_profil'		=> ' active',
				// 'profil' 			=> $this->model_penjual->byIdUser($this->fungsi->user_login()->user_id)->row()
			);
		}

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('profil');
		$this->load->view('templates/backend_footer');
	}

	#Proses update profil akun
	public function profilakun()
	{
		$this->form_validation->set_rules('nama', 'Nama lengkap', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('username', 'Username', 'required|trim|callback_username_check', array('required' => '%s wajib diisi'));

		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'trim');
			$this->form_validation->set_rules(
				'passconf',
				'Ulangi Password',
				'trim|matches[password]',
				array(
					'matches' => '%s tidak sesuai dengan password'
				)
			);
		}
		if ($this->input->post('passconf')) {
			$this->form_validation->set_rules(
				'passconf',
				'Ulangi Password',
				'trim|matches[password]',
				array(
					'matches' => '%s tidak sesuai dengan password'
				)
			);
		}

		$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$query = $this->model_user->get();

			if ($query->num_rows() > 0) {
				$this->profil();
			} else {
				echo "<script> alert('Data tidak ditemukan.');";
				echo "window.location='" . site_url('dashboard/profil') . "';</script>";
			}
		} else {
			$post = $this->input->post(null);

			$this->model_user->edit($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('sukses', 'Informasi akun berhasil diperbaharui.');
			}
			redirect('dashboard/profil');
		}
	}

	#Proses update foto profil
	public function profilpicupdate()
	{
		$config['upload_path']		= './uploads/profil/';
		$config['allowed_types']	= 'jpg|jpeg|png';
		$config['max_size']			= 2048;
		$config['file_name']		= 'image-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);

		$post = $this->input->post(null, TRUE);

		if (@$_FILES['image']['name'] != null) {
			if ($this->upload->do_upload('image')) {

				$profil = $this->model_user->get($post['user_id'])->row();
				if ($profil->image != null) {
					$target_file = './uploads/profil/' . $profil->image;
					unlink($target_file);
				}

				$post['image'] = $this->upload->data('file_name');
				$this->model_user->editFoto($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('sukses', 'Foto profil berhasil diganti.');
				}
				redirect('profil-saya');
			} else {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect('profil-saya');
			}
		} else {
			$post['image'] = null;
			$this->model_user->editFoto($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('sukses', 'Foto profil berhasil diganti.');
			}
			redirect('profil-saya');
		}
	}

	public function username_check()
	{
		$post = $this->input->post(null);
		$query = $this->db->query("SELECT * FROM tb_user WHERE username='$post[username]' AND user_id != '$post[user_id]'");

		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check', '{field} ini sudah dipakai, gunakan yang lain.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
