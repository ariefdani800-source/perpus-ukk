<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function index()
    {
        $this->load->model('Buku_model');
        $data['buku'] = $this->Buku_model->get_all();

        $this->load->view('landing/index', $data);
    }
}
