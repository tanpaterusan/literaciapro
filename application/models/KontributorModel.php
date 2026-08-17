<?php
Defined('BASEPATH') or exit('No direct script access allowed');

class KontributorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getArtikel()
    {
        $sql = "SELECT * FROM artikel WHERE DELETED = 0 ORDER BY id ASC";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }
}
