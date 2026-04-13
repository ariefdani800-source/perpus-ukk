<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    // 🔥 LOGIN (SUDAH FIX 1 PARAMETER)
    public function login($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }

        return false;
    }

    // 🔥 REGISTER ANGGOTA
    public function register_anggota($data)
    {
        $this->db->insert('anggota', $data);
        return $this->db->insert_id();
    }

    // 🔥 REGISTER USER
    public function register_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    // 🔥 GET USER
    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('users')->row_array();
    }

    // 🔥 GET ANGGOTA
    public function get_anggota_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('anggota')->row_array();
    }
}

