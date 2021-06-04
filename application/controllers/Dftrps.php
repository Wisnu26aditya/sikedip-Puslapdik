<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dftrps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dftrps');
        is_login();
    }

    function index()
    {
        $data['title'] = 'Daftar Hadir Peserta Video Conference Puslapdik';

        $this->load->model('m_dftrps', 'daftar');
        // $data['listabsen'] = $this->daftar->getDataPeserta();
        $data['listvicon'] = $this->daftar->getVicon()->result();

        $data['js'] = 'vicon.js';

        $vicon = $this->input->post('vicon');
        $data['searchingvicon'] = $this->daftar->getDataPeserta($vicon);

        $this->form_validation->set_rules('list', 'List', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/v_dftrps', $data);
            $this->load->view('templates/footer');
        }
    }
}
