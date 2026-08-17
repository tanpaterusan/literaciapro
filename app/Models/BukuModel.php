<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'bukupro';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'isbn',
        'judul',
        'penulis',
        'tahun',
        'stok'
    ];

    /**
     * Menampilkan seluruh data buku
     */
    public function getBuku()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }

    /**
     * Menampilkan satu data buku berdasarkan ID
     */
    public function getBukuById($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Menambah data buku
     */
    public function tambahBuku($data)
    {
        return $this->insert($data);
    }

    /**
     * Mengubah data buku
     */
    public function updateBuku($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Menghapus data buku
     */
    public function hapusBuku($id)
    {
        return $this->delete($id);
    }
}
