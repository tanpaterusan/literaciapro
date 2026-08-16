<?php
Defined('BASEPATH') or exit('No direct script access allowed');

class ArtikelModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getRekapArtikel()
    {
        $sql = " SELECT SUM(KONTRIBUTOR) KONTRIBUTOR, SUM(PUBLISH) PUBLISH, SUM(UNPUBLISH) UNPUBLISH, SUM(KATEGORI) KATEGORI FROM 
                    (
                    SELECT COUNT(DISTINCT PENULIS) KONTRIBUTOR, 0 PUBLISH, 0 UNPUBLISH, 0 KATEGORI FROM ARTIKEL WHERE DELETED = 0
                    UNION ALL
                    SELECT 0 KONTRIBUTOR, COUNT(DISTINCT JUDUL) PUBLISH, 0 UNPUBLISH, 0 KATEGORI FROM ARTIKEL A
                        LEFT JOIN VALIDASI V ON A.id = V.id_artikel
                        WHERE DELETED = 0 AND PUBLISHED = 1
                    UNION ALL
                    SELECT 0 KONTRIBUTOR, 0 PUBLISH, COUNT(DISTINCT JUDUL) UNPUBLISH, 0 KATEGORI FROM ARTIKEL A
                        LEFT JOIN VALIDASI V ON A.id = V.id_artikel
                        WHERE DELETED = 0 AND PUBLISHED = 0
                    UNION ALL
                    SELECT 0 KONTRIBUTOR, 0 PUBLISH, 0 UNPUBLISH, COUNT(DISTINCT KATEGORI) KATEGORI FROM ARTIKEL WHERE DELETED = 0
                ) as REKAP;
            ";
        $query = $this->db->query($sql)->row_array();
        return $query;
    }

    public function getArtikel($username = null)
    {
        $sql = "SELECT * FROM ARTIKEL a
                LEFT JOIN USER u ON a.PENULIS = u.NAMA
                WHERE a.DELETED = 0 ";

        if ($username) {
            $sql .= " AND u.USERNAME = '$username' ";
        }
        $sql .= " ORDER BY a.TGL_PUBLIKASI DESC";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getArtikelbyId($id)
    {
        $sql = "SELECT * FROM ARTIKEL 
                WHERE DELETED = 0 AND ID = '$id' ";
        $query = $this->db->query($sql)->row_array();
        return $query;
    }

    public function setTulisArtikel($data)
    {
        $insert = [
            'JUDUL' => htmlspecialchars($data['judul']),
            'PENULIS' => htmlspecialchars($data['penulis']),
            'ISI_ARTIKEL' => htmlspecialchars($data['isi_artikel']),
            'TGL_PUBLIKASI' => date('Y-m-d H:i:s'),
            'GAMBAR' => htmlspecialchars($data['gambar']),
            'DELETED' => 0,
            'KATEGORI' => htmlspecialchars($data['kategori']),
        ];

        $this->db->insert('artikel', $insert);
        return $this->db->affected_rows();
    }

    public function getArtikelForAdmin()
    {
        $sql = "SELECT a.*, v.ID_ARTIKEL, v.STATUS STATUS, v.KETERANGAN KETERANGAN, v.PUBLISHED PUBLISHED
                FROM ARTIKEL a
                LEFT JOIN VALIDASI v ON a.ID = v.ID_ARTIKEL
                WHERE a.DELETED = 0
                ORDER BY a.TGL_PUBLIKASI DESC";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function setArtikel($id, $data)
    {
        $update = [
            'STATUS' => htmlspecialchars($data['status']),
            'KETERANGAN' => htmlspecialchars($data['keterangan']),
            'PUBLISHED' => htmlspecialchars($data['published']),
        ];

        $this->db->where('ID_ARTIKEL', $id);
        $this->db->update('validasi', $update);

        return $this->db->affected_rows();
    }
}
