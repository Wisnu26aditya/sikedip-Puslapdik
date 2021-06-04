<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lshonor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_lshonor');
        $this->load->model('m_spp');
        $this->load->library('upload');
        is_login();
    }

    function index()
    {

        $data['title'] = 'LS Bendahara - Honor';

        $data['menu'] = $this->db->get('master_modules')->result_array();

        $data['js'] = "lshonor.js";

        $this->load->model('m_lshonor', 'lshonor');

        $data['xls'] = $this->db->get('spp')->result_array();
        $data['Lsh'] = $this->lshonor->getlshonorBy($this->session->userdata('id'));

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spp/v_lshonor', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function ubah_lshonor()
    {
        $config['upload_path'] = './src/upload/spp/'; //path folder
        $config['allowed_types'] = 'pdf|doc|docx|pptx'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        //$config['file_name'] = $nospp; //sesuai no spp
        $config['max_size'] = 2048; //ukuran file
        $config['overwrite'] = TRUE;

        $this->upload->initialize($config);

        $nospp = $this->input->post('nospp');
        $tgl = $this->input->post('tgl');
        $nilaispp = $this->input->post('nilaispp');

        // untuk dokumen yang diupload
        if (!empty($_FILES['file_spp']['name']) || $_FILES['file_spp']['name'] != "") {
            if ($this->upload->do_upload('file_spp') && !empty($_FILES['file_spp']['name'])) {
                $gbrfile_spp = $this->upload->data();
                $file_spp = $gbrfile_spp['file_name'];
                $update['dok_spp'] = $file_spp;
            }
        }
        if (!empty($_FILES['file_nominatif']['name']) || $_FILES['file_nominatif']['name'] != "") {
            if ($this->upload->do_upload('file_nominatif') && !empty($_FILES['file_nominatif']['name'])) {
                $gbrfile_nominatif = $this->upload->data();
                $file_nominatif = $gbrfile_nominatif['file_name'];
                $update['dok_nominatif'] = $file_nominatif;
            }
        }
        if (!empty($_FILES['file_sk']['name']) || $_FILES['file_sk']['name'] != "") {
            if ($this->upload->do_upload('file_sk') && !empty($_FILES['file_sk']['name'])) {
                $gbrfile_sk = $this->upload->data();
                $file_sk = $gbrfile_sk['file_name'];
                $update['dok_sk'] = $file_sk;
            }
        }
        foreach ($nospp as $key => $value) {
            date_default_timezone_set('Asia/Jakarta');
            $dok = $this->input->post('kode_lsh');
            $created = date('d-m-Y H:i:s');
            $tgl_pengajuan = date('d-m-Y');
            $created_by = $this->session->userdata['id'];
            $update['update_date'] = $created;
            $update['update_by'] = $created_by;
            $update['spp_dok_id'] = $dok;

            $this->m_lshonor->up_lshonor($update, $dok);
            $this->m_spp->ubah_spp($dok, $value, $tgl[$key], $nilaispp[$key], $created, $tgl_pengajuan, $created_by);
        }
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Updated!</div>');
        redirect('lshonor');
    }

    function simpan_lshonor()
    {
        $config['upload_path'] = './src/upload/spp/'; //path folder
        $config['allowed_types'] = 'pdf|doc|docx|pptx'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        //$config['file_name'] = $nospp; //sesuai no spp
        $config['max_size'] = 2048; //ukuran file

        $this->upload->initialize($config);

        $nospp = $this->input->post('no');
        $tgl = $this->input->post('tgl');
        $nilaispp = $this->input->post('nilai');

        // untuk dokumen yang diupload
        if (!empty($_FILES['file_spp']['name']) || $_FILES['file_spp']['name'] != "") {
            if ($this->upload->do_upload('file_spp') && !empty($_FILES['file_spp']['name'])) {
                $gbrfile_spp = $this->upload->data();
                $file_spp = $gbrfile_spp['file_name'];
                $insert['dok_spp'] = $file_spp;
            }
        }
        if (!empty($_FILES['file_nominatif']['name']) || $_FILES['file_nominatif']['name'] != "") {
            if ($this->upload->do_upload('file_nominatif') && !empty($_FILES['file_nominatif']['name'])) {
                $gbrfile_nominatif = $this->upload->data();
                $file_nominatif = $gbrfile_nominatif['file_name'];
                $insert['dok_nominatif'] = $file_nominatif;
            }
        }
        if (!empty($_FILES['file_sk']['name']) || $_FILES['file_sk']['name'] != "") {
            if ($this->upload->do_upload('file_sk') && !empty($_FILES['file_sk']['name'])) {
                $gbrfile_sk = $this->upload->data();
                $file_sk = $gbrfile_sk['file_name'];
                $insert['dok_sk'] = $file_sk;
            }
        }
        foreach ($nospp as $key => $value) {
            date_default_timezone_set('Asia/Jakarta');
            $this->load->model('m_lshonor', 'kode');
            $kode_ls = $this->kode->kode_lsh();
            $dok = $kode_ls;
            $created = date('d-m-Y H:i:s');
            $tgl_pengajuan = date('d-m-Y');
            $created_by = $this->session->userdata['id'];
            $insert['created_date'] = $created;
            $insert['created_by'] = $created_by;
            $insert['spp_dok_id'] = $dok;

            $this->m_lshonor->ins_lshonor($insert);
            $this->m_spp->simpan_spp($dok, $value, $tgl[$key], $nilaispp[$key], $created, $tgl_pengajuan, $created_by);
        }
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Added!</div>');
        redirect('lshonor');
    }

    function hapus_lshonor()
    {
        date_default_timezone_set('Asia/Jakarta');

        $dokumen_id = $this->input->post('dkode_lsh');

        $file_spp = $this->input->post('dfile_spp');
        $file_nominatif = $this->input->post('dfile_nominatif');
        $file_sk = $this->input->post('dfile_sk');

        if ($file_spp != null) {
            unlink('src/upload/spp/' . $file_spp);
        }
        if ($file_nominatif != null) {
            unlink('src/upload/spp/' . $file_nominatif);
        }
        if ($file_sk != null) {
            unlink('src/upload/spp/' . $file_sk);
        }
        $deleted = date('d-m-Y H:i:s');
        $deleted_by = $this->session->userdata['id'];
        $this->m_lshonor->hapus_lshonor($dokumen_id, $deleted, $deleted_by);
        $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">Data has been deleted!</div>');
        redirect('lshonor');
    }

    function getLsHonor()
    {
        $this->load->model('m_lshonor', 'xlshonor');
        $id = $_GET['id'];
        $data = $this->xlshonor->getLsh($id);
        echo json_encode($data);
    }
}
