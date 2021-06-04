<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uangmakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_uangmakan');
        $this->load->model('m_spp');
        $this->load->library('upload');
        is_login();
    }

    function index()
    {

        $data['title'] = 'Uang Makan';

        $data['menu'] = $this->db->get('master_modules')->result_array();

        $data['js'] = "uangmakan.js";

        $this->load->model('m_uangmakan', 'uangmakan');

        $data['xls'] = $this->db->get('spp')->result_array();
        $data['Uangmakan'] = $this->uangmakan->getuangmakanBy($this->session->userdata('id'));

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spp/v_uangmakan', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function ubah_uangmakan()
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
        if (!empty($_FILES['file_dpp']['name']) || $_FILES['file_dpp']['name'] != "") {
            if ($this->upload->do_upload('file_dpp') && !empty($_FILES['file_dpp']['name'])) {
                $gbrfile_dpp = $this->upload->data();
                $file_dpp = $gbrfile_dpp['file_name'];
                $update['dok_dpp'] = $file_dpp;
            }
        }
        if (!empty($_FILES['file_spp']['name']) || $_FILES['file_spp']['name'] != "") {
            if ($this->upload->do_upload('file_spp') && !empty($_FILES['file_spp']['name'])) {
                $gbrfile_spp = $this->upload->data();
                $file_spp = $gbrfile_spp['file_name'];
                $update['dok_spp'] = $file_spp;
            }
        }
        if (!empty($_FILES['file_ssp']['name']) || $_FILES['file_ssp']['name'] != "") {
            if ($this->upload->do_upload('file_ssp') && !empty($_FILES['file_ssp']['name'])) {
                $gbrfile_ssp = $this->upload->data();
                $file_ssp = $gbrfile_ssp['file_name'];
                $update['dok_ssp'] = $file_ssp;
            }
        }

        foreach ($nospp as $key => $value) {
            date_default_timezone_set('Asia/Jakarta');
            $dok = $this->input->post('kode_um');
            $created = date('d-m-Y H:i:s');
            $tgl_pengajuan = date('d-m-Y');
            $created_by = $this->session->userdata['id'];
            $update['update_date'] = $created;
            $update['update_by'] = $created_by;
            $update['spp_dok_id'] = $dok;

            $this->m_uangmakan->up_uangmakan($update, $dok);
            $this->m_spp->ubah_spp($dok, $value, $tgl[$key], $nilaispp[$key], $created, $tgl_pengajuan, $created_by);
        }
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Updated!</div>');
        redirect('uangmakan');
    }

    function simpan_uangmakan()
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
        if (!empty($_FILES['file_dpp']['name']) || $_FILES['file_dpp']['name'] != "") {
            if ($this->upload->do_upload('file_dpp') && !empty($_FILES['file_dpp']['name'])) {
                $gbrfile_dpp = $this->upload->data();
                $file_dpp = $gbrfile_dpp['file_name'];
                $insert['dok_dpp'] = $file_dpp;
            }
        }
        if (!empty($_FILES['file_spp']['name']) || $_FILES['file_spp']['name'] != "") {
            if ($this->upload->do_upload('file_spp') && !empty($_FILES['file_spp']['name'])) {
                $gbrfile_spp = $this->upload->data();
                $file_spp = $gbrfile_spp['file_name'];
                $insert['dok_spp'] = $file_spp;
            }
        }
        if (!empty($_FILES['file_ssp']['name']) || $_FILES['file_ssp']['name'] != "") {
            if ($this->upload->do_upload('file_ssp') && !empty($_FILES['file_ssp']['name'])) {
                $gbrfile_ssp = $this->upload->data();
                $file_ssp = $gbrfile_ssp['file_name'];
                $insert['dok_ssp'] = $file_ssp;
            }
        }

        foreach ($nospp as $key => $value) {
            date_default_timezone_set('Asia/Jakarta');
            $this->load->model('m_uangmakan', 'kode');
            $kode_ls = $this->kode->kode_um();
            $dok = $kode_ls;
            $created = date('d-m-Y H:i:s');
            $tgl_pengajuan = date('d-m-Y');
            $created_by = $this->session->userdata['id'];
            $insert['created_date'] = $created;
            $insert['created_by'] = $created_by;
            $insert['spp_dok_id'] = $dok;

            $this->m_uangmakan->ins_uangmakan($insert);
            $this->m_spp->simpan_spp($dok, $value, $tgl[$key], $nilaispp[$key], $created, $tgl_pengajuan, $created_by);
        }
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Added!</div>');
        redirect('uangmakan');
    }

    function hapus_uangmakan()
    {
        date_default_timezone_set('Asia/Jakarta');

        $dokumen_id = $this->input->post('dkode_um');

        $file_dpp = $this->input->post('dfile_dpp');
        $file_spp = $this->input->post('dfile_spp');
        $file_ssp = $this->input->post('dfile_ssp');
        
        if ($file_dpp != null) {
            unlink('src/upload/spp/' . $file_dpp);
        }
        if ($file_spp != null) {
            unlink('src/upload/spp/' . $file_spp);
        }
        if ($file_ssp != null) {
            unlink('src/upload/spp/' . $file_ssp);
        }

        $deleted = date('d-m-Y H:i:s');
        $deleted_by = $this->session->userdata['id'];
        $this->m_uangmakan->hapus_uangmakan($dokumen_id, $deleted, $deleted_by);
        $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">Data has been deleted!</div>');
        redirect('uangmakan');
    }

    function getLsUangmakan()
    {
        $this->load->model('m_uangmakan', 'xum');
        $id = $_GET['id'];
        $data = $this->xum->getUangmakan($id);
        echo json_encode($data);
    }
}
