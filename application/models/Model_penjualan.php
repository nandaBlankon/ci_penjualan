<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_penjualan extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('tb_penjualan.*, tb_merk.*, tb_penjual.*, tb_penjual.nama as nama_lapak');
        $this->db->from('tb_penjualan');
        $this->db->join('tb_merk', 'tb_merk.id_merk = tb_penjualan.id_merk');
        $this->db->join('tb_penjual', 'tb_penjual.id_penjual = tb_penjualan.id_penjual');
        $this->db->order_by('id_penjualan', 'DESC');

        if ($id != null) {
            $this->db->where('id_penjualan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function find($id)
    {
        $result = $this->db->where('id_penjualan', $id)->limit(1)->get('tb_penjualan');

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function view($slug)
    {
        $this->db->select('tb_penjualan.*, tb_merk.*, tb_penjual.*, tb_penjual.nama as nama_lapak');
        // $this->db->from('tb_penjualan');
        $this->db->join('tb_merk', 'tb_merk.id_merk = tb_penjualan.id_merk', 'inner');
        $this->db->join('tb_penjual', 'tb_penjual.id_penjual = tb_penjualan.id_penjual');
        $this->db->get_where('tb_penjualan', array('judul' => $slug));

        $query = $this->db->get('tb_penjualan');
        return $query;
    }

    public function getByIdPenjual($id)
    {
        $this->db->select('tb_penjualan.*, tb_merk.*');
        $this->db->from('tb_penjualan');
        $this->db->join('tb_merk', 'tb_merk.id_merk = tb_penjualan.id_merk');
        $this->db->where('id_penjual', $id);
        $this->db->order_by('id_penjualan', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function getByIdMerk($id)
    {
        $this->db->select('tb_penjualan.*, tb_merk.*, tb_penjual.*, tb_penjual.nama as nama_lapak');
        $this->db->from('tb_penjualan');
        $this->db->join('tb_merk', 'tb_merk.id_merk = tb_penjualan.id_merk');
        $this->db->join('tb_penjual', 'tb_penjual.id_penjual = tb_penjualan.id_penjual');
        $this->db->where('tb_penjualan.id_merk', $id);
        $this->db->order_by('id_penjualan', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function getImage($id = null)
    {
        $this->db->select('tb_image.*, tb_penjualan.*');
        $this->db->from('tb_image');
        $this->db->join('tb_penjualan', 'tb_image.id_penjualan = tb_penjualan.id_penjualan');
        if ($id != null) {
            $this->db->where('id_penjualan', $id);
        }

        $query = $this->db->get();
        return $query;

        // $hasil=$this->db->query("SELECT * FROM tb_image WHERE tb_image.id_penjualan='$id'");
        // return $hasil->result();
    }

    public function getImageById($id)
    {
        $this->db->from('tb_image');
        $this->db->where('id_image', $id);

        $query = $this->db->get();
        return $query;
    }

    public function getWarna($id = null)
    {
        // $this->db->select('tb_warna.*, tb_penjualan.*');
        $this->db->from('tb_warna');
        // $this->db->join('tb_penjualan', 'tb_warna.id_penjualan = tb_penjualan.id_penjualan');
        if ($id != null) {
            $this->db->where('id_warna', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    // EDITED
    public function warnaTerpilih($id = null, $warna = "")
    {
        $this->db->select('*');
        $this->db->from('tb_penjualan_warna');
        if ($id != null) {
            $this->db->where('id_penjualan', $id);
        }
        if ($warna != "") {
            $this->db->where('id_warna', $warna);
        }

        $query = $this->db->get();
        return $query;
    }
    // END EDITED

    // BACKUP function Warna Terpilih
    // public function warnaTerpilih($id = null)
    // {
    //     $this->db->select('tb_penjualan_warna.*, tb_warna.*');
    //     $this->db->from('tb_penjualan_warna');
    //     $this->db->join('tb_warna', 'tb_penjualan_warna.id_warna = tb_warna.id_warna');
    //     if ($id != null) {
    //         $this->db->where('id_penjualan', $id);
    //     }

    //     $query = $this->db->get();
    //     return $query;
    // }
    // END BACKUP

    public function add($post)
    {
        $params = array(
            'id_penjual'    => $post['id_penjual'],
            'id_merk'       => $post['id_merk'],
            'judul'         => $post['judul'],
            'deskripsi'     => $post['deskripsi'],
            'harga'         => $post['harga'],
            'stok'          => $post['stok'],
            'berat'         => $post['berat'],
            'kondisi'       => $post['kondisi'],
        );

        $this->db->insert('tb_penjualan', $params);
    }

    public function edit($post)
    {
        $params = array(
            'id_penjual'    => $post['id_penjual'],
            'id_merk'       => $post['id_merk'],
            'judul'         => $post['judul'],
            'deskripsi'     => $post['deskripsi'],
            'harga'         => $post['harga'],
            'stok'          => $post['stok'],
            'berat'         => $post['berat'],
            'kondisi'       => $post['kondisi'],
        );

        $this->db->where('id_penjualan', $post['id_penjualan']);
        $this->db->update('tb_penjualan', $params);
    }

    public function del($id)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->delete('tb_penjualan');
    }

    public function addFoto($post)
    {
        $params = [
            'id_penjualan'  => $post['id_penjualan'],
            'image'         => $post['image'],
        ];
        $this->db->insert('tb_image', $params);
    }

    public function editFoto($post)
    {
        $params = [
            'id_penjualan' => $post['id_penjualan'],
        ];

        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('id_image', $post['id_image']);
        $this->db->update('tb_image', $params);
    }

    public function delFoto($id)
    {
        $this->db->where('id_image', $id);
        $this->db->delete('tb_image');
    }
}
