<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_login();
        $this->load->model('Buku_model');
        $this->load->model('Anggota_model');
        $this->load->model('Peminjaman_model');
    }

    private function _check_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard Admin';
        $data['total_buku'] = $this->Buku_model->count_all();
        $data['total_anggota'] = $this->Anggota_model->count_all();
        $data['total_peminjaman'] = $this->Peminjaman_model->count_active();
        $data['peminjaman_terbaru'] = $this->Peminjaman_model->get_recent(5);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }
}
