<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_brand extends CI_Model
{

    public function idbrand()
    {
        $this->db->select('RIGHT(tb_brand.id_brand, 4) as kode', FALSE);
        $this->db->order_by('id_brand', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tb_brand'); //cek dulu apakah ada sudah ada kode di tabel.   

        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "IDB-" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    public function get($id = null)
    {
        $this->db->from('tb_brand');
        if ($id != null) {
            $this->db->where('id_brand', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_brand' => $post['id_brand'],
            'nama_brand' => $post['nama_brand'],
        );
        $this->db->insert('tb_brand', $params);
    }

    public function edit($post)
    {
        $params = [
            'id_brand'   => $post['id_brand'],
            'nama_brand' => $post['nama_brand'],
        ];

        $this->db->where('id_brand', $post['id_brand']);
        $this->db->update('tb_brand', $params);
    }

    public function del($id)
    {
        $this->db->where('id_brand', $id);
        $this->db->delete('tb_brand');
    }

    public function check_brand($nama, $id = null)
    {
        $this->db->from('tb_brand');
        $this->db->where('nama_brand', $nama);

        if ($id != null) {
            $this->db->where('id_brand !=', $id);
        }

        $query = $this->db->get();
        return $query;
    }
}
