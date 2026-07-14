<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $allowedFields = ['id', 'id_baca', 'id_nulis', 'judul', 'penulis', 'status', 'genre', 'deleted'];
    protected $primaryKey = 'id';
}
