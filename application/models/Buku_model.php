<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

    private $table = 'buku';

    // 🔥 Ambil semua buku
    public function get_all() {
        $this->db->order_by('judul', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    // 🔥 Ambil berdasarkan ID
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    // 🔥 Ambil buku yang masih bisa dipinjam (stok > 0)
    public function get_available() {
        $this->db->where('stok >', 0);
        $this->db->order_by('judul', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    // 🔥 Tambah buku
    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // 🔥 Update buku
    public function update($id, $data) {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    // 🔥 Hapus buku
    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    // 🔥 Hitung semua buku
    public function count_all() {
        return $this->db->count_all($this->table);
    }

    // 🔥 CEK STATUS OTOMATIS (biar cocok sama landing)
    public function get_with_status() {
        $this->db->select("*, 
            CASE 
                WHEN stok > 0 THEN 'tersedia'
                ELSE 'dipinjam'
            END as status_view
        ");
        return $this->db->get($this->table)->result_array();
    }
}
