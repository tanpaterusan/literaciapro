<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property ArtikelModel $artikelmodel
 */

class Visitor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('artikelmodel');
    }
    public function index()
    {
        $data['title'] = 'Baca Artikel Literasi Hari ini';
        $data['artikel'] = $this->artikelmodel->getArtikel();
        $this->load->view('templates/frontend/header', $data);
        $this->load->view('visitor/index', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function about()
    {
        $data['title'] = 'Tentang Kami';
        $data['artikel'] = $this->artikelmodel->getArtikel();
        $this->load->view('templates/frontend/header', $data);
        $this->load->view('visitor/about', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function baca($id)
    {
        $data['title'] = 'Baca Artikel';
        $data['artikel'] = $this->artikelmodel->getArtikelbyId($id);
        $this->load->view('templates/frontend/header', $data);
        $this->load->view('visitor/baca', $data);
        $this->load->view('templates/frontend/footer', $data);
    }
}
