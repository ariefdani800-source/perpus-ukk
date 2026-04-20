<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

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
        $id_anggota = $this->session->userdata('id_anggota');

        $data['title'] = 'Dashboard Siswa';

        // 🔥 FIX: fallback kalau session kosong
        if (!$id_anggota) {
            $data['anggota'] = [
                'nama'   => 'Data tidak ditemukan',
                'nis'    => '-',
                'kelas'  => '-',
                'telepon'=> '-'
            ];
            $data['total_pinjaman'] = 0;
            $data['pinjaman_aktif'] = 0;
            $data['riwayat_terbaru'] = [];
        } else {
            $anggota = $this->Anggota_model->get_by_id($id_anggota);

            // kalau data anggota tidak ada di DB
            if (!$anggota) {
                $data['anggota'] = [
                    'nama'   => 'Data tidak ditemukan',
                    'nis'    => '-',
                    'kelas'  => '-',
                    'telepon'=> '-'
                ];
                $data['total_pinjaman'] = 0;
                $data['pinjaman_aktif'] = 0;
                $data['riwayat_terbaru'] = [];
            } else {
                $data['anggota'] = $anggota;
                $data['total_pinjaman'] = $this->Peminjaman_model->count_by_anggota($id_anggota);
                $data['pinjaman_aktif'] = $this->Peminjaman_model->count_active_by_anggota($id_anggota);
                $data['riwayat_terbaru'] = $this->Peminjaman_model->get_by_anggota($id_anggota, 5);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_siswa', $data);
        $this->load->view('siswa/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_kartu() {
        $id_anggota = $this->session->userdata('id_anggota');

        if (!$id_anggota) {
            show_404();
        }

        $data['anggota'] = $this->Anggota_model->get_by_id($id_anggota);

        if (!$data['anggota']) {
            show_404();
        }

        $data['title'] = 'Cetak Kartu Anggota';
        $this->load->view('admin/anggota/cetak_kartu', $data);
    }
}