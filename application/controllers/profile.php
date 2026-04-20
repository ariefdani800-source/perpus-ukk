<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

        // Support both user_id and id_user just in case
        $id = $this->session->userdata('user_id') ?? $this->session->userdata('id_user');
        if (!$id) {
            redirect('auth');
        }
    }

    public function index()
    {
        $id = $this->session->userdata('user_id') ?? $this->session->userdata('id_user');
        $id_anggota = $this->session->userdata('id_anggota');

        $data['user'] = $this->User_model->get_by_id($id);
        
        $this->load->model('Anggota_model');
        $data['anggota'] = $id_anggota ? $this->Anggota_model->get_by_id($id_anggota) : null;

        $this->load->view('profile/index', $data);
    }

    public function update_foto()
    {
        $id = $this->session->userdata('user_id') ?? $this->session->userdata('id_user');

        // 🔥 CONFIG UPLOAD (PRO VERSION)
        $config['upload_path']   = './assets/upload/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE; // biar nama file aman & random

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            // kalau gagal
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('profile');
        }

        // sukses upload
        $upload = $this->upload->data();
        $new_foto = $upload['file_name'];

        // ambil user lama
        $user = $this->User_model->get_by_id($id);

        // hapus foto lama (kalau ada)
        if (!empty($user['foto']) && file_exists('./assets/upload/user/' . $user['foto'])) {
            unlink('./assets/upload/user/' . $user['foto']);
        }

        // update DB
        $this->User_model->update_foto($id, $new_foto);
        $this->session->set_userdata('foto', $new_foto);

        $this->session->set_flashdata('success', 'Foto berhasil diupdate!');
        redirect('profile');
    }

    public function update()
    {
        $id = $this->session->userdata('user_id') ?? $this->session->userdata('id_user');
        $id_anggota = $this->session->userdata('id_anggota');

        $username = $this->input->post('username', true);
        $password = $this->input->post('password');

        $data = [
            'username' => $username,
        ];

        if (!empty($password)) {
            $data['password'] = $password; 
        }

        $this->User_model->update_profile($id, $data);

        // Update session userdata for username
        $this->session->set_userdata('username', $username);

        if ($id_anggota) {
            $this->load->model('Anggota_model');
            $nama = $this->input->post('nama', true);
            $kelas = $this->input->post('kelas', true);
            $telepon = $this->input->post('telepon', true);
            
            $data_anggota = [];
            if ($nama) $data_anggota['nama'] = $nama;
            if ($kelas) $data_anggota['kelas'] = $kelas;
            if ($telepon !== null) $data_anggota['telepon'] = $telepon;
            
            if (!empty($data_anggota)) {
                $this->Anggota_model->update($id_anggota, $data_anggota);
            }
        }

        $this->session->set_flashdata('success', 'Profil berhasil diupdate!');
        redirect('profile');
    }
}
