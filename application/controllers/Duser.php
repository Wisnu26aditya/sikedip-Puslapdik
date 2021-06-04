<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Duser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_duser');
        is_login();
    }

    public function index()
    {
        $data['title'] = 'Dashboard Pengajuan LPJ';
        $data['user'] = $this->db->get_where('login', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('m_duser', 'data_lpj');

        $data['add'] = $this->data_lpj->jmladd($this->session->userdata('id'));
        $data['del'] = $this->data_lpj->jmldel($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/v_duser', $data);
        $this->load->view('templates/footer');
    }
}
