<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_akses');
        is_login();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Hak Akses';

        $data['akun'] = $this->db->get_where('login', array('is_active' => 1))->result_array();

        //$data['akses'] = $this->db->get('master_modules')->result_array();

        $this->load->model('m_akses','xakses');

        $data['Listakses'] = $this->xakses->getListAkses($this->session->userdata['id']);

        $data['js'] = 'akses.js';

        $this->form_validation->set_rules('akun', 'Akun', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/v_akses', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Menu Added!</div>');
            redirect('akses');
        }
    }

    function getRegId()
    {
        $this->load->model('m_registrasi', 'xreg');
        $id = $_GET['id'];
        $data = $this->xreg->getRegId($id);
        echo json_encode($data);
    }

    function akses()
    {
        if (empty($cb_akses)) {
            $cb_akses = $this->input->post('cb_akses');
            $id     = $this->input->post('userid');
            $urut     = $this->input->post('urut');
            date_default_timezone_set('Asia/Jakarta');
            $created = date('d-m-Y H:i:s');
            $download = $this->input->post('inlineRadioOptions');
            $upload = $this->input->post('inlineRadioOptions2');
    
            for ($i = 0; $i < sizeof($cb_akses); $i++) {
                $this->m_akses->akses($cb_akses[$i], $created, $id);
                $this->m_akses->updown($upload, $download, $urut);
            }
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Role Akses Added!</div>');
            redirect('akses');
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">No data Akses Added!</div>');
            redirect('akses');
        }
    }

    function editakses()
    {
        if (empty($id)) {

            $id   = $this->input->post('id');
            $image      = $this->input->post('image');
            $role      = $this->input->post('role');
            $is_active      = $this->input->post('active');
            $is_upload     = $this->input->post('upload');
            $is_download     = $this->input->post('download');
            $this->m_akses->editakses($id, $image, $role, $is_active, $is_upload, $is_download);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Updated!</div>');
            redirect('akses');
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">No data Updated!</div>');
            redirect('akses');
        }
    }

    function getAksesId()
    {
        $this->load->model('m_akses', 'xakses');
        $id = $_GET['id'];
        $data = $this->xakses->getAksesId($id);
        echo json_encode($data);
    }
}
