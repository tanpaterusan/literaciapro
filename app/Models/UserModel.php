<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama', 'alamat', 'kontak', 'username', 'password', 'role', 'deleted'];
    protected $primaryKey = '';
}
