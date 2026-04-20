<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_login();

        $this->load->model('Buku_model');
        $this->load->model('Anggota_model');
        $this->load->model('Peminjaman_model');
        $this->load->model('Auth_model');

        $this->load->database();
    }

    // 🔐 CEK LOGIN ADMIN
    private function _check_login() {
        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') != 'admin'
        ) {
            redirect('auth');
        }
    }

    // 🔥 DASHBOARD
    public function index() {
        $data['title'] = 'Dashboard Admin';

        $data['total_buku']       = $this->Buku_model->count_all();
        $data['total_anggota']    = $this->Anggota_model->count_all();
        $data['total_peminjaman'] = $this->Peminjaman_model->count_active();
        $data['peminjaman_terbaru'] = $this->Peminjaman_model->get_recent(5);

        // 🔥 TOTAL DENDA
        if ($this->db->field_exists('denda', 'peminjaman')) {
            $this->db->select_sum('denda');
            $total_denda = $this->db->get('peminjaman')->row_array();
            $data['total_denda'] = $total_denda['denda'] ?? 0;
        } else {
            $data['total_denda'] = 0;
        }

        // 🔥 BUKU TERSEDIA
        if ($this->db->field_exists('stok', 'buku')) {
            $data['buku_tersedia'] = $this->db
                ->where('stok >', 0)
                ->count_all_results('buku');
        } else {
            $data['buku_tersedia'] = $data['total_buku'];
        }

        // 🔥 CHART KATEGORI
        $this->db->select('kategori, COUNT(*) as jumlah');
        $this->db->from('buku');
        $this->db->group_by('kategori');
        $data['chart'] = $this->db->get()->result_array();

        // 🔥 CHART BULANAN
        $data['chart_bulanan'] = $this->db->query("
            SELECT 
                MONTH(tanggal_pinjam) as bulan_angka,
                DATE_FORMAT(MIN(tanggal_pinjam), '%b') as bulan,
                COUNT(*) as total
            FROM peminjaman
            GROUP BY MONTH(tanggal_pinjam)
            ORDER BY bulan_angka
        ")->result_array();

        // 🔥 CHART STATUS
        $data['chart_status'] = $this->db->query("
            SELECT status, COUNT(*) as total
            FROM peminjaman
            GROUP BY status
        ")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }

    // 🔥 DATA USER
    public function data_user() {
        $data['title'] = 'Data User';
        $data['users'] = $this->Auth_model->getAllUsers();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('templates/footer');
    }

    // 🔥 DETAIL USER
    public function detail_user($id) {
        $data['title'] = 'Detail User';

        $data['user'] = $this->db
            ->get_where('users', ['id' => $id])
            ->row();

        if (!$data['user']) {
            show_404();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/detail_user', $data);
        $this->load->view('templates/footer');
    }

    // 🔥 DETAIL ANGGOTA
    public function detail_anggota($id) {
        $data['title'] = 'Kartu Anggota';
        $data['anggota'] = $this->Anggota_model->get_by_id($id);

        if (!$data['anggota']) {
            show_404();
        }

        $this->load->model('User_model');
        $data['user_foto'] = $this->User_model->get_user_by_anggota($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/anggota/cetak_kartu', $data);
        $this->load->view('templates/footer');
    }

    // 🔥 LAPORAN PEMINJAMAN
    public function laporan() {
        redirect('laporan');
    }
} 