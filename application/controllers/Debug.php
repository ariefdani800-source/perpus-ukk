<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller
{
    public function index()
    {
        if (!is_cli()) {
            echo "<pre>";
        }
        $fields = $this->db->list_fields('peminjaman');
        file_put_contents('debug_output.json', json_encode($fields, JSON_PRETTY_PRINT));
        echo "Done writing structure to debug_output.json";
    }
}
