<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_login();
        $this->load->model('Buku_model');
        $this->load->model('Peminjaman_model');
        $this->load->model('Anggota_model');
    }

    private function _check_login() {
        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') != 'siswa'
        ) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Daftar Buku';

        $search = $this->input->get('search');

        // 🔍 SEARCH BUKU
        if ($search) {
            $this->db->like('judul', $search);
            $data['buku'] = $this->db->get('buku')->result();
        } else {
            $data['buku'] = $this->Buku_model->get_available();
        }

        $id_anggota = $this->session->userdata('id_anggota');
        $data['riwayat'] = $this->Peminjaman_model->get_by_anggota_with_detail($id_anggota);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_siswa', $data);
        $this->load->view('siswa/peminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function pinjam($id_buku) {
        $id_anggota = $this->session->userdata('id_anggota');

        $existing = $this->Peminjaman_model->check_existing($id_anggota, $id_buku);
        if ($existing) {
            $this->session->set_flashdata('error', 'Anda sudah meminjam buku ini dan belum dikembalikan!');
            redirect('peminjaman');
        }

        $buku = $this->Buku_model->get_by_id($id_buku);
        if (!$buku || $buku['stok'] < 1) {
            $this->session->set_flashdata('error', 'Stok buku tidak tersedia!');
            redirect('peminjaman');
        }

        $data = [
            'id_anggota'      => $id_anggota,
            'id_buku'         => $id_buku,
            'tanggal_pinjam'  => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
            'status'          => 'dipinjam'
        ];

        $this->Peminjaman_model->insert($data);

        // stok buku berkurang
        $this->Buku_model->update($id_buku, [
            'stok' => $buku['stok'] - 1
        ]);

        $this->session->set_flashdata(
            'success',
            'Buku berhasil dipinjam! Batas pengembalian: ' . date('d/m/Y', strtotime('+7 days'))
        );

        redirect('peminjaman/riwayat');
    }

    public function riwayat() {
        $id_anggota = $this->session->userdata('id_anggota');

        $data['title'] = 'Riwayat Peminjaman';
        $data['riwayat'] = $this->Peminjaman_model->get_by_anggota_with_detail($id_anggota);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_siswa', $data);
        $this->load->view('siswa/riwayat', $data);
        $this->load->view('templates/footer');
    }

    // 🔥 FUNCTION KEMBALIKAN BUKU
    public function kembalikan($id) {
        $peminjaman = $this->Peminjaman_model->get_by_id($id);

        if (!$peminjaman) {
            $this->session->set_flashdata('error', 'Data peminjaman tidak ditemukan!');
            redirect('peminjaman/riwayat');
        }

        // update status jadi dikembalikan
        $data = [
            'status' => 'dikembalikan',
            'tanggal_kembali' => date('Y-m-d')
        ];

        $this->Peminjaman_model->update($id, $data);

        // stok buku balik
        $buku = $this->Buku_model->get_by_id($peminjaman['id_buku']);
        if ($buku) {
            $this->Buku_model->update($peminjaman['id_buku'], [
                'stok' => $buku['stok'] + 1
            ]);
        }

        $this->session->set_flashdata('success', 'Buku berhasil dikembalikan!');
        redirect('peminjaman/riwayat');
    }
}