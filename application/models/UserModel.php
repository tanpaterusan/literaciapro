<?php
Defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    public function getUserByUsername($username = '')
    {
        if ($username == '' || $username == null) {
            $username = $this->session->userdata('username');
        }
        $sql = " SELECT * FROM USER
                    WHERE DELETED = 0 
                    AND IS_ACTIVE = 1
                    AND USERNAME = '" . $username . "'
                ";

        $query = $this->db->query($sql)->row_array();
        return $query;
    }

    public function getUserAll()
    {
        $sql = " SELECT NAMA, 
                        ALAMAT, 
                        KONTAK, 
                        USERNAME, 
                        ROLE, 
                        CASE WHEN IS_ACTIVE = 1 THEN 'aktif' ELSE 'nonaktif' 
                            END AS IS_ACTIVE
                FROM USER
                WHERE DELETED = 0 
                ";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function setUser($username, $data)
    {
        $update = [
            'IS_ACTIVE' => htmlspecialchars($data['is_active']),
            'ROLE' => htmlspecialchars($data['role']),
        ];

        $this->db->where('USERNAME', $username);
        $this->db->update('user', $update);

        return $this->db->affected_rows();
    }
}
