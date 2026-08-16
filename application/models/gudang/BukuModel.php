<?php
Defined('BASEPATH') or exit('No direct script access allowed');

class BukuModel extends CI_Model
{

    protected $table = 'bukupro';

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil semua data yang belum dihapus (soft delete)
    public function get_all()
    {
        $this->db->where('DELETED', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    // Ambil satu data berdasarkan id
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->where('DELETED', 0);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    // Tambah buku baru
    public function insert($data)
    {
        $insert = [
            'isbn'    => $data['isbn'],
            'judul'   => $data['judul'],
            'penulis' => $data['penulis'],
            'tahun'   => $data['tahun'],
            'stok'    => $data['stok'],
            'DELETED' => 0,
        ];

        $this->db->insert($this->table, $insert);
        return $this->db->affected_rows();
    }

    // Ubah data buku
    public function update($id, $data)
    {
        $update = [
            'isbn'    => $data['isbn'],
            'judul'   => $data['judul'],
            'penulis' => $data['penulis'],
            'tahun'   => $data['tahun'],
            'stok'    => $data['stok'],
        ];

        $this->db->where('id', $id);
        $this->db->update($this->table, $update);
        return $this->db->affected_rows();
    }

    // Hapus data (soft delete)
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, ['DELETED' => 1]);
        return $this->db->affected_rows();
    }
}
