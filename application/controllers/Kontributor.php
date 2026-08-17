<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property ArtikelModel $artikelmodel
 * @property UserModel $usermodel
 * @property CI_Session $session
 * @property CI_Input $input
 */

class Kontributor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('artikelmodel');
        $this->load->model('usermodel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $data['user'] = $this->usermodel->getUserByUsername($username);

        $data['title'] = 'Daftar Kontribusi Anda';
        $data['artikel'] = $this->artikelmodel->getArtikel($username);

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/kontributor_sidebar', $data);
        $this->load->view('kontributor/index', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    public function getStatus($id)
    {
        if (empty($id)) {
            echo json_encode(['status' => 'error', 'message' => 'ID artikel tidak valid!']);
            return;
        }
        $artikel = $this->artikelmodel->getArtikelById($id);

        if ($artikel) {
            echo json_encode(['status' => 'success', 'artikel' => $artikel]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Artikel tidak ditemukan!']);
        }
    }

    public function bacaArtikel($id)
    {
        $username = $this->session->userdata('username');
        $data['user'] = $this->usermodel->getUserByUsername($username);

        $data['title'] = 'Baca Artikel';
        $data['artikel'] = $this->artikelmodel->getArtikelbyId($id);
        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/kontributor_sidebar', $data);
        $this->load->view('kontributor/baca_artikel', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    public function tulisArtikel()
    {
        $username = $this->session->userdata('username');
        $data['user'] = $this->usermodel->getUserByUsername($username);

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim|min_length[10]', [
            'required' => 'Judul wajib diisi!',
            'min_length' => 'Judul minimal 10 karakter!'
        ],);
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim', [
            'required' => 'Kategori wajib dipilih!',
        ],);
        $this->form_validation->set_rules('isi_artikel', 'Isi Artikel', 'required|trim|min_length[100]', [
            'min_length' => 'Isi artikel minimal 100 karakter!',
        ],);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tulis Artikel';
            $data['artikel'] = $this->artikelmodel->getArtikel($username);
            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/kontributor_sidebar', $data);
            $this->load->view('kontributor/tulis_artikel', $data);
            $this->load->view('templates/backend/footer', $data);
        } else {
            $upload_gambar = $_FILES['gambar']['name'];
            if (!empty($upload_gambar)) {
                $config['upload_path']   = './assets/img/gambar/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 1024;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->trans_start();

            $insertArtikel = [
                'judul' => htmlspecialchars($this->input->post('judul')),
                'penulis' => htmlspecialchars($data['user']['nama']),
                'isi_artikel' => htmlspecialchars($this->input->post('isi_artikel')),
                'gambar' => htmlspecialchars($gambar),
                'deleted' => 0,
                'kategori' => htmlspecialchars($this->input->post('kategori')),
            ];
            $this->db->insert('artikel', $insertArtikel);

            // status: request, approved, rejected, takedown
            // published: 0 = not published, 1 = published
            $idArtikel = $this->db->insert_id();

            $insertValidasi = [
                'id_artikel' => $idArtikel,
                'status' => 'request',
                'published' => 0,
            ];
            $this->db->insert('validasi', $insertValidasi);

            $this->db->trans_complete();

            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata('message', 'Artikel gagal dikirim!');
            } else {
                $this->session->set_flashdata('message', 'Artikel berhasil dikirim! Menunggu validasi.');
            }

            redirect('kontributor/index');
        }
    }

    public function editArtikel($id)
    {
        $username = $this->session->userdata('username');
        $data['user'] = $this->usermodel->getUserByUsername($username);
        $data['artikel'] = $this->artikelmodel->getArtikelbyId($id);

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim|min_length[10]', [
            'required' => 'Judul tidak boleh kosong!',
            'min_length' => 'Judul minimal 10 karakter!'
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim', [
            'required' => 'Kategori wajib dipilih!'
        ]);
        $this->form_validation->set_rules('isi_artikel', 'Isi Artikel', 'required|trim|min_length[100]', [
            'required' => 'Isi artikel tidak boleh kosong!',
            'min_length' => 'Isi artikel minimal 100 karakter!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Artikel';

            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/kontributor_sidebar', $data);
            $this->load->view('kontributor/edit_artikel', $data);
            $this->load->view('templates/backend/footer', $data);
        } else {

            $gambar = $data['artikel']['gambar'];
            $upload_gambar = $_FILES['gambar']['name'];
            if (!empty($upload_gambar)) {
                $config['upload_path']   = FCPATH . 'assets/img/gambar/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 1024;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $old_image = $data['artikel']['gambar'];
                    if ($old_image != 'default.jpg' && file_exists('./assets/img/gambar/' . $old_image)) {
                        unlink('./assets/img/gambar/' . $old_image);
                    }
                    $gambar = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('kontributor/editArtikel/' . $id);
                    return;
                }
            }

            $update = [
                'judul'       => htmlspecialchars($this->input->post('judul')),
                'penulis'     => htmlspecialchars($data['user']['nama']),
                'isi_artikel' => htmlspecialchars($this->input->post('isi_artikel')),
                'gambar'      => $gambar,
                'deleted'     => 0,
                'kategori'    => htmlspecialchars($this->input->post('kategori')),
            ];

            $this->db->where('id', $id);
            $this->db->update('artikel', $update);
            $this->session->set_flashdata('message', 'Artikel berhasil diperbarui!');
            redirect('kontributor/index');
        }
    }

    public function hapusArtikel($id)
    {
        $artikel = $this->artikelmodel->getArtikelbyId($id);
        if ($artikel) {
            $this->db->where('id', $id);
            $this->db->update('artikel', ['deleted' => 1]);
            $this->session->set_flashdata('message', 'Artikel berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Artikel tidak ditemukan!');
        }
        redirect('kontributor/index');
    }
}
