<?php
Defined('BASEPATH') or exit('No direct script access allowed');

class ArtikelModel extends CI_Model
{

    protected $table = 'artikel';

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil total kategori, total artikel yang belum dihapus (soft delete)
    public function getRekap()
    {
        $this->db->where('DELETED', 0);
        $this->db->order_by('id', 'ASC');
        $this->db->select('COUNT(DISTINCT kategori) AS total_kategori, COUNT(*) AS total_artikel');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    // Ambil semua data yang belum dihapus (soft delete)
    public function getAll()
    {
        $this->db->where('DELETED', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}
