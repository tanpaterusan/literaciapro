<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BukuModel;

class UserController extends BaseController
{
    protected $UserModel;
    protected $BukuModel;

    public function __construct()
    {
        $this->UserModel = new UserModel;
        $this->BukuModel = new BukuModel;
    }


    public function index()
    {
        $data['title'] = 'Buku - LiteraciaPro';
        // $data['buku'] = $this->BukuModel->findAll();
        return view('user/v_user', $data);
    }

    public function create()
    {
        return view('user/create');
    }

    public function store()
    {
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $userModel->insert($data);

        return redirect()->to('/users');
    }
}
