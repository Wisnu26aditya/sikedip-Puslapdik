<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ls3 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_ls3');
        $this->load->model('m_spp');
        $this->load->library('upload');
        is_login();
    }

    function index()
    {

        $data['title'] = 'LS Pihak Ketiga';

        $data['menu'] = $this->db->get('master_modules')->result_array();

        $data['js'] = "ls3.js";

        $this->load->model('m_ls3', 'ls3');

        $data['xls'] = $this->db->get('spp')->result_array();
        $data['Ls3'] = $this->ls3->getls3By($this->session->userdata('id'));

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spp/v_ls3', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function ubah_ls3()
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
        if (!empty($_FILES['file_pengadaan']['name']) || $_FILES['file_pengadaan']['name'] != "") {
            if ($this->upload->do_upload('file_pengadaan') && !empty($_FILES['file_pengadaan']['name'])) {
                $gbrfile_pengadaan = $this->upload->data();
                $file_pengadaan = $gbrfile_pengadaan['file_name'];
                $update['dok_pengadaan'] = $file_pengadaan;
            }
        }
        if (!empty($_FILES['file_karwas']['name']) || $_FILES['file_karwas']['name'] != "") {
            if ($this->upload->do_upload('file_karwas') && !empty($_FILES['file_karwas']['name'])) {
                $gbrfile_karwas = $this->upload->data();
                $file_karwas = $gbrfile_karwas['file_name'];
                $update['dok_karwas'] = $file_karwas;
            }
        }
        if (!empty($_FILES['file_persetujuan']['name']) || $_FILES['file_persetujuan']['name'] != "") {
            if ($this->upload->do_upload('file_persetujuan') && !empty($_FILES['file_persetujuan']['name'])) {
                $gbrfile_persetujuan = $this->upload->data();
                $file_persetujuan = $gbrfile_persetujuan['file_name'];
                $update['dok_persetujuan'] = $file_persetujuan;
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
            $dok = $this->input->post('kode_ls3');
            $created = date('d-m-Y H:i:s');
            $tgl_pengajuan = date('d-m-Y');
            $created_by = $this->session->userdata['id'];
            $update['update_date'] = $created;
            $update['update_by'] = $created_by;
            $update['spp_dok_id'] = $dok;

            $this->m_ls3->up_ls3($update, $dok);
            $this->m_spp->ubah_spp($dok, $value, $tgl[$key], $nilaispp[$key], $created, $tgl_pengajuan, $created_by);
        }
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Updated!</div>');
        redirect('ls3');
    }

    function simpan_ls3()
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
        if (!empty($_FILES['file_pengadaan']['name']) || $_FILES['file_pengadaan']['name'] != "") {
            if ($this->upload->do_upload('file_pengadaan') && !empty($_FILES['file_pengadaan']['name'])) {
                $gbrfile_pengadaan = $this->upload->data();
                $file_pengadaan = $gbrfile_pengadaan['file_name'];
                $insert['dok_pengadaan'] = $file_pengadaan;
            }
        }
        if (!empty($_FILES['file_karwas']['name']) || $_FILES['file_karwas']['name'] != "") {
            if ($this->upload->do_upload('file_karwas') && !empty($_FILES['file_karwas']['name'])) {
                $gbrfile_karwas = $this->upload->data();
                $file_karwas = $gbrfile_karwas['file_name'];
                $insert['dok_karwas'] = $file_karwas;
            }
        }
        if (!empty($_FILES['file_persetujuan']['name']) || $_FILES['file_persetujuan']['name'] != "") {
            if ($this->upload->do_upload('file_persetujuan') && !empty($_FILES['file_persetujuan']['name'])) {
                $gbrfile_persetujuan = $this->upload->data();
                $file_persetujuan = $gbrfile_persetujuan['file_name'];
                $insert['dok_persetujuan'] = $file_persetujuan;
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
            $this->load->model('m_ls3', 'kode');
            $kode_ls = $this->kode->kode_ls3();
            $dok = $kode_ls;
            $created = date('d-m-Y H:i:s');
            $tgl_pengajuan = date('d-m-Y');
            $created_by = $this->session->userdata['id'];
            $insert['created_date'] = $created;
            $insert['created_by'] = $created_by;
            $insert['spp_dok_id'] = $dok;

            $this->m_ls3->ins_ls3($insert);
            $this->m_spp->simpan_spp($dok, $value, $tgl[$key], $nilaispp[$key], $created, $tgl_pengajuan, $created_by);
        }
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Added!</div>');
        redirect('ls3');
    }

    function hapus_ls3()
    {
        date_default_timezone_set('Asia/Jakarta');

        $dokumen_id = $this->input->post('dkode_ls3');

        $file_pengadaan = $this->input->post('dfile_pengadaan');
        $file_karwas = $this->input->post('dfile_karwas');
        $file_persetujuan = $this->input->post('dfile_persetujuan');
        $file_spp = $this->input->post('dfile_spp');
        $file_ssp = $this->input->post('dfile_ssp');

        if ($file_pengadaan != null) {
            unlink('src/upload/spp/' . $file_pengadaan);
        }
        if ($file_karwas != null) {
            unlink('src/upload/spp/' . $file_karwas);
        }
        if ($file_persetujuan != null) {
            unlink('src/upload/spp/' . $file_persetujuan);
        }
        if ($file_spp != null) {
            unlink('src/upload/spp/' . $file_spp);
        }
        if ($file_ssp != null) {
            unlink('src/upload/spp/' . $file_ssp);
        }

        $deleted = date('d-m-Y H:i:s');
        $deleted_by = $this->session->userdata['id'];
        $this->m_ls3->hapus_ls3($dokumen_id, $deleted, $deleted_by);
        $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">Data has been deleted!</div>');
        redirect('ls3');
    }

    function getLsTiga()
    {
        $this->load->model('m_ls3', 'xls3');
        $id = $_GET['id'];
        $data = $this->xls3->getLs3($id);
        echo json_encode($data);
    }
}
