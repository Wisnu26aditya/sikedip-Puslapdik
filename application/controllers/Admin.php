<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        is_login();
    }

    public function index(){
        $data['title'] = 'Dashboard';
        
        $this->load->model('m_admin', 'Admin');
        
        $data['akun'] = $this->Admin->jmlAkun();
        $data['pending'] = $this->Admin->jmlAkunpending();

        $data['jmlperjadin'] = $this->Admin->jmllpj_perjadin();
        $data['jmlhonkeg'] = $this->Admin->jmllpj_honkeg();
        $data['jmlhonbul'] = $this->Admin->jmllpj_honbul();
        $data['jmlup'] = $this->Admin->jmllpj_up();
        $data['jmltup'] = $this->Admin->jmllpj_tup();
        $data['jmlpbjbwh50'] = $this->Admin->jmllpj_pbjbwh50();
        $data['jmlpbjatas50'] = $this->Admin->jmllpj_pbjatas50();
        $data['jmlpbj200'] = $this->Admin->jmllpj_pbj200();

        $data['jmllsbendahara'] = $this->Admin->jmlls_bendahara();
        $data['jmllstiga'] = $this->Admin->jmlls_tiga();
        $data['jmlgaji'] = $this->Admin->jmlgaji();
        $data['jmluangmakan'] = $this->Admin->jmluangmakan();
        $data['jmlsppup'] = $this->Admin->jmlspp_up();
        $data['jmlspptup'] = $this->Admin->jmlspp_tup();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}