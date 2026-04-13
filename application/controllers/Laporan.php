<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek login admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
        
        $this->load->model('Peminjaman_model');
    }

    public function index() {
        $data['title'] = 'Laporan Transaksi';

        // Filter parameters
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $status = $this->input->get('status');

        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['status'] = $status;

        // Default get all if no filter is applied
        if ($tgl_awal || $tgl_akhir || $status) {
            $data['laporan'] = $this->Peminjaman_model->filter_laporan($tgl_awal, $tgl_akhir, $status);
        } else {
            $data['laporan'] = $this->Peminjaman_model->get_all_with_detail();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/laporan/index', $data);
        $this->load->view('templates/footer');
    }

    public function cetak() {
        $data['title'] = 'Cetak Laporan Transaksi';

        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $status = $this->input->get('status');

        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['status'] = $status;

        if ($tgl_awal || $tgl_akhir || $status) {
            $data['laporan'] = $this->Peminjaman_model->filter_laporan($tgl_awal, $tgl_akhir, $status);
        } else {
            $data['laporan'] = $this->Peminjaman_model->get_all_with_detail();
        }

        $this->load->view('admin/laporan/cetak', $data);
    }
}
