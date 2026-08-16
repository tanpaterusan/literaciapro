<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property ArtikelModel $artikelmodel
 * @property CI_Session $session
 * @property CI_Input $input
 */

class Artikel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('artikelmodel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        echo 'Masuk ke ArtikelController';

        $data['title'] = 'Rekap Artikel';
        $data['artikel'] = $this->artikelmodel->getRekap();

        $this->load->view('templates/header', $data);
        $this->load->view('artikel/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function artikel()
    {
        $data['title'] = 'Artikel';
        $data['artikel'] = $this->artikelmodel->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('artikel/indexAdmin', $data);
        $this->load->view('templates/footer', $data);
    }
}
