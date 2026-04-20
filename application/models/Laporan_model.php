<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function getLaporan($tgl_awal, $tgl_akhir, $status, $jenis)
    {
        $this->db->select('*');
        $this->db->from('transaksi');

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('tanggal_pinjam >=', $tgl_awal);
            $this->db->where('tanggal_pinjam <=', $tgl_akhir);
        }

        if ($status != 'semua') {
            $this->db->where('status', $status);
        }

        if ($jenis != 'semua') {
            $this->db->where('jenis', $jenis);
        }

        return $this->db->get()->result_array();
    }
}
    