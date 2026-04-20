<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // cek login admin
        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') !== 'admin'
        ) {
            redirect('auth');
        }

        $this->load->model('Peminjaman_model');
    }

    public function index() {
        $data['title'] = 'Laporan Transaksi';

        $tgl_awal  = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $status    = $this->input->get('status');
        $jenis     = $this->input->get('jenis');

        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['status']    = $status;
        $data['jenis']     = $jenis;

        // filter data
        if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($status)) {
            $data['laporan'] = $this->Peminjaman_model->filter_laporan(
                $tgl_awal,
                $tgl_akhir,
                $status
            );
        } else {
            $data['laporan'] = $this->Peminjaman_model->get_all_with_detail();
        }

        // ✅ FIX TOTAL DATA
        $data['total'] = count($data['laporan']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/laporan/index', $data);
        $this->load->view('templates/footer');
    }

    public function cetak() {
        $data['title'] = 'Cetak Laporan Transaksi';

        $tgl_awal  = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $status    = $this->input->get('status');
        $jenis     = $this->input->get('jenis');

        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['status']    = $status;
        $data['jenis']     = $jenis;

        if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($status)) {
            $data['laporan'] = $this->Peminjaman_model->filter_laporan(
                $tgl_awal,
                $tgl_akhir,
                $status
            );
        } else {
            $data['laporan'] = $this->Peminjaman_model->get_all_with_detail();
        }

        // total data cetak
        $data['total'] = count($data['laporan']);

        $this->load->view('admin/laporan/cetak', $data);
    }

    public function export_pdf() {
        $data['title'] = 'Export Laporan Transaksi';

        $tgl_awal  = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $status    = $this->input->get('status');
        $jenis     = $this->input->get('jenis');

        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['status']    = $status;
        $data['jenis']     = $jenis;

        if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($status)) {
            $data['laporan'] = $this->Peminjaman_model->filter_laporan(
                $tgl_awal,
                $tgl_akhir,
                $status
            );
        } else {
            $data['laporan'] = $this->Peminjaman_model->get_all_with_detail();
        }

        // total export
        $data['total'] = count($data['laporan']);

        $this->load->view('admin/laporan/pdf', $data);
    }
}