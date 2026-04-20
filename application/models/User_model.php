<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_by_id($id)
    {
        return $this->db->get_where('users', ['id_user' => $id])->row_array();
    }

    public function update_foto($id, $foto)
    {
        return $this->db->where('id_user', $id)
                        ->update('users', ['foto' => $foto]);
    }

    public function update_profile($id, $data)
    {
        return $this->db->where('id_user', $id)
                        ->update('users', $data);
    }

    public function get_user_by_anggota($id_anggota)
    {
        return $this->db->get_where('users', ['id_anggota' => $id_anggota])->row_array();
    }
}
