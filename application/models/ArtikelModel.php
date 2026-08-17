<?php
Defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property ArtikelModel $artikelmodel
 * @property UserModel $usermodel
 * @property CI_Session $session
 * @property CI_Input $input
 */

class ArtikelModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
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
        $sql = " SELECT a.*, v.*
                FROM ARTIKEL a
                LEFT JOIN VALIDASI v 
                ON a.ID = v.ID_ARTIKEL
                WHERE a.DELETED = 0";

        if ($username) {
            $sql .= " AND a.PENULIS IN (SELECT NAMA FROM USER WHERE USERNAME = '$username') ";
        }

        $sql .= " ORDER BY v.TGL_PUBLIKASI DESC";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getArtikelbyId($id)
    {
        $sql = " SELECT a.*, v.*
                FROM ARTIKEL a
                LEFT JOIN VALIDASI v 
                ON a.ID = v.ID_ARTIKEL
                WHERE a.DELETED = 0 
                AND ID = '$id' ";

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

    public function setArtikel($id, $data)
    {
        $update = [
            'STATUS' => htmlspecialchars($data['status']),
            'KETERANGAN' => htmlspecialchars($data['keterangan']),
            'PUBLISHED' => htmlspecialchars($data['published']),
            'TGL_PUBLIKASI' => date('Y-m-d H:i:s'),
        ];

        $this->db->where('ID_ARTIKEL', $id);
        $this->db->update('validasi', $update);

        return $this->db->affected_rows();
    }

    public function getArtikelForVisitor($limit = null, $offset = null)
    {

        if (!$limit && !$offset) {
            $sql = "SELECT a.*, v.*
                FROM ARTIKEL a
                LEFT JOIN VALIDASI v ON a.ID = v.ID_ARTIKEL
                WHERE a.DELETED = 0
                AND PUBLISHED = 1
                ORDER BY v.TGL_PUBLIKASI DESC";
            $query = $this->db->query($sql)->result_array();
        } else {
            $sql = "SELECT a.*, v.*
                FROM ARTIKEL a
                LEFT JOIN VALIDASI v ON a.ID = v.ID_ARTIKEL
                WHERE a.DELETED = 0
                AND PUBLISHED = 1
                ORDER BY v.TGL_PUBLIKASI DESC
                LIMIT ? OFFSET ?";
            $query = $this->db->query($sql, [$limit, $offset])->result_array();
        }
        return $query;
    }
}
