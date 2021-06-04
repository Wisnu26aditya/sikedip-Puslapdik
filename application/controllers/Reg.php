<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reg extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_registrasi');
        is_login();
    }

    public function index()
    {
        $data['title'] = 'Registrasi Akun';
        $data['user'] = $this->db->get_where('login', ['email' => $this->session->userdata('email')])->row_array();

        $data['akun'] = $this->db->get_where('login', array('is_active' => 1))->result_array();

        $data['js'] = 'registrasi.js';

        $data['user'] = $this->db->get('user_role')->result();
        
        $this->form_validation->set_rules('akun', 'Akun', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/v_reg', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Menu Added!</div>');
            redirect('menu');
        }
    }

    function getRegId()
    {
        $this->load->model('m_registrasi', 'xreg');
        $id = $_GET['id'];
        $data = $this->xreg->getRegId($id);
        echo json_encode($data);
    }

    function up_akun()
    {
        if (empty($id)) {

            $id   = $this->input->post('id');
            $role      = $this->input->post('user_role');
            $is_active      = $this->input->post('active');
            $is_upload     = $this->input->post('is_upload');
            $is_download     = $this->input->post('is_download');

            $where['id'] = $id;
            $update['role_id'] = $role;
            $update['is_active'] = $is_active;
            $update['is_upload'] = $is_upload;
            $update['is_download'] = $is_download;
            $this->m_registrasi->up_akun($where,$update);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Aprroved!</div>');
            redirect('reg');
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">No data Aprroved!</div>');
            redirect('reg');
        }
    }

    function hapus_reg()
    {
        $id = $this->input->post('userid');
        $this->m_registrasi->hapus_reg($id);
        $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">User has been Dele!</div>');
        redirect('reg');
    }
}
