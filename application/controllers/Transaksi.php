<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        $this->load->model('Peminjaman_model');
        $this->load->model('Buku_model');
        $this->load->model('Anggota_model');
    }

    public function index() {
        $role = $this->session->userdata('role');
        $data['title'] = 'Daftar Transaksi';

        if ($role == 'admin') {
            $data['transaksi'] = $this->Peminjaman_model->get_all_with_detail();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/transaksi/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user = $this->session->userdata('id_user'); 
            $data['transaksi'] = $this->Peminjaman_model->get_by_user($id_user);
            
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/daftar_transaksi', $data);
            $this->load->view('templates/footer');
        }
    }

    public function detail($id = NULL) {
        $this->_restrict_to_admin();

        if ($id == NULL) redirect('transaksi');

        $data['title'] = 'Detail Transaksi';
        $data['transaksi'] = $this->Peminjaman_model->get_by_id_with_detail($id);
        
        if (!$data['transaksi']) {
            show_404();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/transaksi/detail', $data);
        $this->load->view('templates/footer');
    }

    public function tambah() {
        $this->_restrict_to_admin();

        $this->form_validation->set_rules('id_anggota', 'Anggota', 'required');
        $this->form_validation->set_rules('id_buku', 'Buku', 'required');
        $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
        $this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Transaksi';
            $data['anggota'] = $this->Anggota_model->get_all();
            $data['buku'] = $this->Buku_model->get_available();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/transaksi/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $id_buku = $this->input->post('id_buku');
            $buku = $this->Buku_model->get_by_id($id_buku);

            if ($buku['stok'] < 1) {
                $this->session->set_flashdata('error', 'Stok buku tidak tersedia!');
                redirect('transaksi/tambah');
            }

            $insert_data = array(
                'id_anggota' => $this->input->post('id_anggota'),
                'id_buku' => $id_buku,
                'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
                'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                'status' => 'dipinjam',
                'created_at' => date('Y-m-d H:i:s')
            );

            $this->Peminjaman_model->insert($insert_data);
            $this->Buku_model->update($id_buku, array('stok' => $buku['stok'] - 1));

            $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan!');
            redirect('transaksi');
        }
    }

    public function konfirmasi($id) {
        $this->_restrict_to_admin();
        
        $transaksi = $this->Peminjaman_model->get_by_id($id);
        if (!$transaksi) show_404();

        $today = date('Y-m-d');
        $denda = 0;

        // Logika Denda menggunakan TARIF_DENDA dari constants.php
        if (strtotime($today) > strtotime($transaksi['tanggal_kembali'])) {
            $diff = (strtotime($today) - strtotime($transaksi['tanggal_kembali'])) / (60 * 60 * 24);
            $denda = floor($diff) * TARIF_DENDA;
        }

        $update_data = array(
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => $today,
            'denda' => $denda
        );

        $this->Peminjaman_model->update($id, $update_data);

        // Tambah stok buku kembali
        $buku = $this->Buku_model->get_by_id($transaksi['id_buku']);
        $this->Buku_model->update($transaksi['id_buku'], array('stok' => $buku['stok'] + 1));

        $pesan = 'Buku berhasil dikembalikan!';
        if ($denda > 0) $pesan .= ' Denda: Rp ' . number_format($denda, 0, ',', '.');

        $this->session->set_flashdata('success', $pesan);
        redirect('transaksi');
    }

    public function hapus($id) {
        $this->_restrict_to_admin();
        
        $transaksi = $this->Peminjaman_model->get_by_id($id);
        if (!$transaksi) show_404();

        if ($transaksi['status'] == 'dipinjam') {
            $buku = $this->Buku_model->get_by_id($transaksi['id_buku']);
            $this->Buku_model->update($transaksi['id_buku'], array('stok' => $buku['stok'] + 1));
        }

        $this->Peminjaman_model->delete($id);
        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus!');
        redirect('transaksi');
    }

    private function _restrict_to_admin() {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak! Anda bukan admin.');
            redirect('transaksi');
        }
    }
}