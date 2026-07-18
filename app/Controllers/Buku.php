<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $model;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->model = new BukuModel();
    }

    /**
     * Menampilkan daftar buku
     */
    public function index()
    {
        $data = [
            'title' => 'Data Buku',
            'buku'  => $this->model->getBuku()
        ];

        return view('buku/index', $data);
    }

    /**
     * Menampilkan form tambah buku
     */
    public function create()
    {
        return view('buku/create', [
            'title' => 'Tambah Buku',
            'validation' => \Config\Services::validation()
        ]);
    }

    /**
     * Menyimpan data buku
     */
    public function store()
    {
        $rules = [
            'isbn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ISBN wajib diisi.'
                ]
            ],
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul wajib diisi.'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penulis wajib diisi.'
                ]
            ],
            'tahun' => [
                'rules' => 'required|numeric|greater_than[1900]|less_than_equal_to[' . date('Y') . ']',
                'errors' => [
                    'required' => 'Tahun wajib diisi.',
                    'numeric' => 'Tahun harus berupa angka.',
                    'greater_than' => 'Tahun tidak valid.',
                    'less_than_equal_to' => 'Tahun tidak boleh melebihi tahun sekarang.'
                ]
            ],
            'stok' => [
                'rules' => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Stok wajib diisi.',
                    'integer' => 'Stok harus berupa angka.',
                    'greater_than_equal_to' => 'Stok tidak boleh kurang dari 0.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/buku/tambah')
                ->withInput()
                ->with('validation', $this->validator);
        }

        $data = [
            'isbn'     => $this->request->getPost('isbn'),
            'judul'    => $this->request->getPost('judul'),
            'penulis'  => $this->request->getPost('penulis'),
            'tahun'    => $this->request->getPost('tahun'),
            'stok'     => $this->request->getPost('stok')
        ];

        $this->model->tambahBuku($data);

        return redirect()->to('/buku')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Buku',
            'buku' => $this->model->getBukuById($id),
            'validation' => \Config\Services::validation()
        ];

        return view('buku/edit', $data);
    }

    /**
     * Mengupdate data buku
     */
    public function update($id)
    {
        $rules = [
            'isbn' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'tahun' => 'required|numeric|greater_than[1900]|less_than_equal_to[' . date('Y') . ']',
            'stok' => 'required|integer|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/buku/edit/' . $id)
                ->withInput()
                ->with('validation', $this->validator);
        }

        $data = [
            'isbn'     => $this->request->getPost('isbn'),
            'judul'    => $this->request->getPost('judul'),
            'penulis'  => $this->request->getPost('penulis'),
            'tahun'    => $this->request->getPost('tahun'),
            'stok'     => $this->request->getPost('stok')
        ];

        $this->model->updateBuku($id, $data);

        return redirect()->to('/buku')
            ->with('success', 'Data buku berhasil diubah.');
    }

    /**
     * Menghapus data buku
     */
    public function delete($id)
    {
        $this->model->hapusBuku($id);

        return redirect()->to('/buku')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}
