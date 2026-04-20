<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library(['session', 'form_validation']);
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $role = $this->session->userdata('role');

            if ($role == 'admin') {
                redirect('admin');
            } else {
                redirect('siswa');
            }
        }

        $this->load->view('auth/login');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Nama', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->Auth_model->login($username);

            // LOGIN PASSWORD TEXT BIASA
            if ($user && $password == $user['password']) {

                $session_data = [
                    'user_id'    => $user['id_user'] ?? $user['id'], // handle generic users table
                    'username'   => $user['username'],
                    'role'       => $user['role'],
                    'id_anggota' => $user['id_anggota'],
                    'foto'       => $user['foto'] ?? 'default.png',
                    'logged_in'  => TRUE
                ];

                $this->session->set_userdata($session_data);

                if ($user['role'] == 'admin') {
                    redirect('admin');
                } else {
                    redirect('siswa');
                }

            } else {
                $this->session->set_flashdata('error', 'Nama atau password salah!');
                redirect('auth');
            }
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|is_unique[anggota.nis]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {

            $data_anggota = [
                'nis'   => $this->input->post('nis'),
                'nama'  => $this->input->post('nama'),
                'kelas' => $this->input->post('kelas')
            ];

            $id_anggota = $this->Auth_model->register_anggota($data_anggota);

            if ($id_anggota) {

                // 🔥 USERNAME = NAMA SISWA
                $data_user = [
                    'username'   => $this->input->post('nama'),
                    'password'   => $this->input->post('password'),
                    'role'       => 'siswa',
                    'id_anggota' => $id_anggota
                ];

                $this->Auth_model->register_user($data_user);

                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('auth');

            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal!');
                redirect('auth/register');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}