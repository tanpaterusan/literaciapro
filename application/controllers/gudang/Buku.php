<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property BukuModel $bukumodel
 * @property CI_Session $session
 * @property CI_Input $input
 */

class Buku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('bukumodel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        echo 'Masuk ke BukuController';
    }

    public function buku()
    {
        $data['title'] = 'Buku';
        $data['buku'] = $this->bukumodel->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('buku/index', $data);
        $this->load->view('templates/footer', $data);
    }

    // POST /buku/tambah
    public function tambah()
    {
        // set rules
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            // validasi gagal, tampilkan lagi form dengan pesan error
            $data['title'] = 'Tambah Buku';

            $this->load->view('templates/header', $data);
            $this->load->view('buku/create', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // validasi berhasil, simpan data
            $dataInsert = [
                'judul'   => $this->input->post('judul'),
                'penulis' => $this->input->post('penulis'),
                'isbn'    => $this->input->post('isbn'),
                'stok'    => $this->input->post('stok'),
                'tahun'   => $this->input->post('tahun'),
            ];


            if ($this->input->method() === 'post') {
                $post = $this->input->post();
                $this->bukumodel->insert($dataInsert);

                if ($this->bukumodel->insert($post) > 0) {
                    $this->session->set_flashdata('message', 'buku berhasil ditambahkan!');
                } else {
                    $this->session->set_flashdata('message', 'buku gagal ditambahkan!');
                }
            }
            redirect('index.php/buku/buku'); // arahkan balik ke halaman index setelah simpan
        }
    }

    // GET /buku/edit/{id} -> tampilkan form edit
    public function edit($id = null)
    {
        if ($id === null) {
            redirect('index.php/buku/buku');
        }

        $data['buku'] = $this->bukumodel->get_by_id($id);

        if (!$data['buku']) {
            $this->session->set_flashdata('message', 'data buku tidak ditemukan!');
            redirect('index.php/buku/buku');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('buku/edit', $data);
        $this->load->view('templates/footer', $data);
    }

    // POST /buku/update/{id} -> proses simpan hasil edit
    public function update($id = null)
    {
        if ($id === null) {
            redirect('index.php/buku/buku');
        }

        if ($this->input->method() === 'post') {
            $post = $this->input->post();

            if ($this->bukumodel->update($id, $post) > 0) {
                $this->session->set_flashdata('message', 'buku berhasil diubah!');
            } else {
                $this->session->set_flashdata('message', 'buku gagal diubah!');
            }
        }

        redirect('index.php/buku/buku');
    }

    // GET /buku/hapus/{id}
    public function hapus($id = null)
    {
        if ($id === null) {
            redirect('index.php/buku/buku');
        }

        if ($this->bukumodel->delete($id) > 0) {
            $this->session->set_flashdata('message', 'buku berhasil dihapus!');
        } else {
            $this->session->set_flashdata('message', 'buku gagal dihapus!');
        }

        redirect('index.php/buku/buku');
    }
}
