<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stkbrg extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_psedia');
        is_login();
    }

    function index()
    {

        $data['title'] = 'Stok Barang';

        $this->load->model('m_psedia', 'xpsedia');
        $data['Pstok'] = $this->xpsedia->getStok();

        $data['kodesskel'] = $this->xpsedia->getsskel()->result();

        $data['dept'] = $this->xpsedia->getdept()->result();

        //$data['list_perjadin'] = $this->db->get('dokumen_lpj')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/v_stkbrg', $data);
            $this->load->view('templates/footer', $data);
        }
    }
}
