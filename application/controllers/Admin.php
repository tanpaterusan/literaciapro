<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property ArtikelModel $artikelmodel
 * @property UserModel $usermodel
 *  @property CI_Session $session
 * @property CI_Input $input
 */

class Admin extends CI_Controller
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

        $data['title'] = 'Dashboard';
        $data['artikel'] = $this->artikelmodel->getRekapArtikel();
        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/admin_sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    public function manageUser()
    {
        $username = $this->session->userdata('username');
        $data['user'] = $this->usermodel->getUserByUsername($username);

        $data['title'] = 'Kelola User';
        $data['userAll'] = $this->usermodel->getUserAll();
        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/admin_sidebar', $data);
        $this->load->view('admin/m_user', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    public function setUser()
    {
        $username = $this->input->post('username');
        $is_active = $this->input->post('is_active');
        $role = $this->input->post('role');

        // var_dump($username);
        // var_dump($is_active);
        // var_dump($role);
        // die;

        if (empty($username)) {
            echo json_encode(['status' => 'error', 'message' => 'Username tidak valid!']);
            return;
        }

        $data = [
            'is_active' => $is_active,
            'role' => $role,
        ];

        $result = $this->usermodel->setUser($username, $data);

        if ($result > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diubah!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data gagal diubah, atau tidak ada perubahan!']);
        }
    }

    public function manageArtikel()
    {
        $username = $this->session->userdata('username');
        $data['user'] = $this->usermodel->getUserByUsername($username);

        $data['title'] = 'Kelola Artikel';
        $data['artikel'] = $this->artikelmodel->getArtikel();
        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/admin_sidebar', $data);
        $this->load->view('admin/m_artikel', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    public function setArtikel()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        $published = $this->input->post('published');
        // var_dump($id, $status, $keterangan, $published);
        // die;

        if (empty($id)) {
            echo json_encode(['status' => 'error', 'message' => 'ID artikel tidak valid!']);
            return;
        }

        $data = [
            'status' => $status,
            'keterangan' => $keterangan,
            'published' => $published
        ];

        $result = $this->artikelmodel->setArtikel($id, $data);

        if ($result > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diubah!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data gagal diubah, atau tidak ada perubahan!']);
        }
    }

    public function bacaArtikel($id)
    {
        $username = $this->session->userdata('username');
        $data['user'] = $this->usermodel->getUserByUsername($username);

        $data['title'] = 'Baca Artikel';
        $data['artikel'] = $this->artikelmodel->getArtikelbyId($id);
        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/admin_sidebar', $data);
        $this->load->view('admin/m_baca', $data);
        $this->load->view('templates/backend/footer', $data);
    }
}
