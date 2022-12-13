<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['model_produk', 'model_brand', 'model_kategori']);
    }

    public function index()
    {
        $data = array(
            'title'             => 'Produk',
            'row'               => $this->model_produk->get(),
            'act_produk'        => 'active',
            'act_produk1'       => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('produk/data');
        $this->load->view('templates/backend_footer');
    }

    public function tambah()
    {
        $produk = new stdClass;
        $produk->id_produk      = null;
        $produk->id_kategori      = null;
        $produk->judul     = null;
        $produk->deskripsi     = null;
        $produk->harga     = null;
        $produk->stok     = null;
        $produk->satuan     = null;
        $produk->manfaat     = null;
        $produk->cara_penggunaan     = null;
        $produk->keterangan     = null;
        $produk->produk_status     = null;

        $query_brand = $this->model_brand->get();

        $data = array(
            'title'               => 'Produk',
            'page'                => 'tambah',
            'row'                 => $produk,
            'brand'               => $query_brand,
            'act_produk'          => 'active',
            'act_produk2'         => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('produk/produk_form');
        $this->load->view('templates/backend_footer');
    }

    public function edit($id)
    {
        $query = $this->model_produk->get($id);

        if ($query->num_rows() > 0) {

            $query_brand = $this->model_brand->get();

            $produk = $query->row();

            $data = array(
                'title'             => 'produk',
                'page'                 => 'edit',
                'row'                => $produk,
                'brand'              => $query_brand,
                'act_produk'        => 'active'
            );
            $this->load->view('templates/backend_header', $data);
            $this->load->view('templates/backend_sidebar');
            $this->load->view('produk/produk_form');
            $this->load->view('templates/backend_footer');
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('produk') . "'</script>";
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);

        if (isset($_POST['tambah'])) {
            $this->form_validation->set_rules('judul', 'Nama produk', 'required', array('required' => '%s wajib diisi'));
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' => '%s belum diisi'));
            $this->form_validation->set_rules('harga', 'Harga produk', 'required', array('required' => '%s belum ditentukan'));
            $this->form_validation->set_rules('satuan', 'Satuan', 'required', array('required' => '%s belum dipilih.'));
            $this->form_validation->set_rules('stok', 'Stok produk', 'required', array('required' => '%s belum diisi'));
            $this->form_validation->set_rules('manfaat', 'Manfaat produk', 'required', array('required' => '%s belum ditulis'));
            $this->form_validation->set_rules('cara_penggunaan', 'Cara penggunaan produk', 'required', array('required' => '%s belum ditulis'));
            $this->form_validation->set_rules('produk_status', 'Produk status', 'required', array('required' => '%s belum dipilih.'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $this->tambah();
            } else {
                if ($this->model_produk->check_produk($post['judul'], $post['id_produk'])->num_rows() > 0) {
                    $produk = $this->model_produk->get($post['id_produk'])->row();
                    $this->session->set_flashdata('error', "<small>Judul <u>" . ucwords($post['judul']) . "</u> sudah ada</u>.</small>");
                    redirect('produk-tambah');
                } else {
                    $post = $this->input->post(null, TRUE);
                    $this->model_produk->add($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata("sukses", "<small>Produk berhasil disimpan</small>");
                    }
                    redirect('produk-tambah');
                }
            }
        } else if (isset($_POST['edit'])) {
            $this->form_validation->set_rules('judul', 'Nama produk', 'required', array('required' => '%s wajib diisi'));
            $this->form_validation->set_rules('id_produk', 'Nama produk', 'required', array('required' => '%s harus dipilih'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_produk');
                $query = $this->model_produk->get($id);

                if ($query->num_rows() > 0) {
                    $this->edit($id);
                } else {
                    echo "<script> alert('Data tidak ditemukan.');";
                    echo "window.location='" . site_url('produk') . "';</script>";
                }
            } else {
                if ($this->model_produk->check_produk($post['judul'], $post['id_produk'], $post['id_produk'])->num_rows() > 0) {
                    $this->session->set_flashdata('error', "<small>produk $post[judul] sudah ada.</small>");
                    redirect('produk/edit/' . $post['id_produk']);
                } else {
                    $this->model_produk->edit($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', '<small>Data produk berhasil diperbaharui.</small>');
                    }
                    redirect('produk');
                }
            }
        }
    }

    public function hapus($id)
    {
        $this->model_produk->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', "<small>Data produk berhasil dihapus.</small>");
        }
        redirect('produk');
    }

    public function uploadFoto($id)
    {
        $produk = $this->model_produk->get($id)->row();

        $uploadfoto = new stdClass;
        $uploadfoto->id_image        = null;
        $uploadfoto->id_produk        = null;
        $uploadfoto->image             = null;

        $data = array(
            'title'         => 'Produk',
            'page'             => 'tambah',
            'row'            => $uploadfoto,
            'produk'        => $produk,
            'act_produk'    => 'active',
            'act_produk2'   => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('produk/uploadfoto_form');
        $this->load->view('templates/backend_footer');
    }

    public function editfoto($id)
    {
        $query = $this->model_produk->imageById($id);

        if ($query->num_rows() > 0) {
            $image = $query->row();
            $data = array(
                'title'     => 'Produk',
                'page'         => 'edit',
                'row'        => $image,
                'act_produk'    => 'active',
                'act_produk2' => 'active',
            );

            $this->load->view('templates/backend_header', $data);
            $this->load->view('templates/backend_sidebar');
            $this->load->view('produk/uploadfoto_form');
            $this->load->view('templates/backend_footer');
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('produk') . "'</script>";
        }
    }

    public function prosesfoto()
    {
        $config['upload_path']        = './uploads/produk/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']            = 2048;
        $config['file_name']        = 'ip-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);

        if (isset($_POST['tambah'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $post['image'] = $this->upload->data('file_name');
                    $this->model_produk->addFoto($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Foto produk berhasil diunggah.');
                    }
                    redirect('produk/uploadfoto/' . $post['id_produk']);
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('produk/uploadfoto/' . $post['id_produk']);
                }
            } else {
                $post['image'] = null;
                $this->model_produk->addFoto($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('sukses', 'Foto produk berhasil diunggah.');
                }
                redirect('produk/uploadfoto/' . $post['id_produk']);
            }
        } else if (isset($_POST['edit'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {

                    $produk = $this->model_produk->imageById($post['id_image'])->row();
                    if ($produk->image != null) {
                        $target_file = './uploads/produk/' . $produk->image;
                        unlink($target_file);
                    }

                    $post['image'] = $this->upload->data('file_name');
                    $this->model_produk->editFoto($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Foto produk berhasil diganti.');
                    }
                    redirect('produk');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('produk/editfoto/' . $post['id_image']);
                }
            } else {
                $post['image'] = null;
                $this->model_produk->editFoto($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('sukses', 'Foto produk berhasil diganti.');
                }
                redirect('produk');
            }
        }

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil disimpan.');</script>";
        }
        echo "<script>window.location='" . site_url('produk') . "'</script>";
    }

    public function hapusfoto($id)
    {
        $berkas = $this->model_produk->getImage($id)->row();
        if ($berkas->image != null) {
            $target_file = './uploads/produk/' . $berkas->image;
            unlink($target_file);
        }

        $this->model_produk->delFoto($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Foto produk berhasil dihapus.');</script>";
        }
        echo "<script>window.location='" . site_url('produk') . "'</script>";
    }
}
