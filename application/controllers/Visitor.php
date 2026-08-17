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
        $this->load->library('pagination');
    }
    public function index()
    {
        $data['title'] = 'LiteraciaPro';
        $data['artikel'] = $this->artikelmodel->getArtikelForVisitor();
        $this->load->view('templates/frontend/header', $data);
        $this->load->view('visitor/index', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function semuaArtikel($offset = 0)
    {
        $data['title'] = 'Tentang Kami';

        $rekap = $this->artikelmodel->getRekapArtikel();

        $per_page = 5;
        $config['base_url'] = site_url('/semuaArtikel');
        $config['total_rows'] = $rekap['PUBLISH'];
        $config['per_page'] = $per_page;
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['artikel'] = $this->artikelmodel->getArtikelForVisitor($per_page, $offset);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('visitor/semua_artikel', $data);
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
