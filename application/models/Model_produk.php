<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_produk extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('tb_produk.*, tb_kategori.*');
        $this->db->from('tb_produk');
        $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
        if ($id != null) {
            $this->db->where('id_produk', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_produk'         => $post['id_produk'],
            'id_kategori'       => $post['id_kategori'],
            'judul'             => $post['judul'],
            'deskripsi'         => $post['deskripsi'],
            'harga'             => $post['harga'],
            'stok'              => $post['stok'],
            'satuan'              => $post['satuan'],
            'manfaat'           => $post['manfaat'],
            'cara_penggunaan'   => $post['cara_penggunaan'],
            'keterangan'        => $post['keterangan'],
            'produk_status'        => $post['produk_status'],
        );
        $this->db->insert('tb_produk', $params);
    }

    public function edit($post)
    {
        $params = array(
            'id_produk'         => $post['id_produk'],
            'id_kategori'       => $post['id_kategori'],
            'judul'             => $post['judul'],
            'deskripsi'         => $post['deskripsi'],
            'harga'             => $post['harga'],
            'stok'              => $post['stok'],
            'satuan'              => $post['satuan'],
            'manfaat'           => $post['manfaat'],
            'cara_penggunaan'   => $post['cara_penggunaan'],
            'keterangan'        => $post['keterangan'],
            'produk_status'        => $post['produk_status'],
        );

        $this->db->where('id_produk', $post['id_produk']);
        $this->db->update('tb_produk', $params);
    }

    public function del($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('tb_produk');
    }

    public function check_produk($nama, $id = null)
    {
        $this->db->from('tb_produk');
        $this->db->where('judul', $nama);

        if ($id != null) {
            $this->db->where('id_produk !=', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    public function getImage($id = null)
    {
        $this->db->select('tb_image_produk.*, tb_produk.*');
        $this->db->from('tb_image_produk');
        $this->db->join('tb_produk', 'tb_image_produk.id_produk = tb_produk.id_produk');
        if ($id != null) {
            $this->db->where('id_produk', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    public function imageById($id)
    {
        $this->db->from('tb_image_produk');
        $this->db->where('id_image', $id);

        $query = $this->db->get();
        return $query;
    }

    public function addFoto($post)
    {
        $params = [
            'id_produk'  => $post['id_produk'],
            'image'         => $post['image'],
        ];
        $this->db->insert('tb_image_produk', $params);
    }

    public function editFoto($post)
    {
        $params = [
            'id_produk' => $post['id_produk'],
        ];

        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('id_image', $post['id_image']);
        $this->db->update('tb_image_produk', $params);
    }

    public function delFoto($id)
    {
        $this->db->where('id_image', $id);
        $this->db->delete('tb_image_produk');
    }

    public function find($id)
    {
        $result = $this->db->where('id_produk', $id)->limit(1)->get('tb_produk');

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }
}
