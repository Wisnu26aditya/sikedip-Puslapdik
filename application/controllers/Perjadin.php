<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perjadin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_lpj');
        $this->load->model('m_perjadin');
        $this->load->library('upload');
        is_login();
    }

    function index()
    {

        $data['title'] = 'Perjalanan Dinas';

        $data['menu'] = $this->db->get('master_modules')->result_array();

        $data['js'] = 'prj.js'; //untuk manggil js yang dibutuhkan

        $this->load->model('m_perjadin', 'xperjadin');
        $data['Perjadin'] = $this->xperjadin->getPerjadin($this->session->userdata['id']);

        //$data['list_perjadin'] = $this->db->get('dokumen_lpj')->result_array();
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('lpj/v_perjadin', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function simpan_perjadin()
    {
        // return var_dump($_FILES['file_spp']['name']);

        //return var_dump($_POST);
        $config['upload_path'] = './src/upload/lpj/'; //path folder
        $config['allowed_types'] = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        //$config['overwrite'] = TRUE;
        $config['max_size'] = 2048; //ukuran file

        $this->upload->initialize($config);
        $file_spp = null;
        $file_spm = null;
        $file_sp2d = null;
        $file_sk = null;
        $file_kuitansi = null;
        $file_laporan = null;
        $file_biodata = null;
        $file_daftar = null;
        $file_atk = null;
        // untuk dokumen yang diupload

        if (!empty($_FILES['file_spp']['name']) || $_FILES['file_spp']['name'] != "") {
            if ($this->upload->do_upload('file_spp') && !empty($_FILES['file_spp']['name'])) {
                $gbrfile_spp = $this->upload->data();
                $file_spp = $gbrfile_spp['file_name'];
                $insert['dokumen_spp'] = $file_spp;
            }
        }
        if (!empty($_FILES['file_spm']['name']) || $_FILES['file_spm']['name'] != "") {
            if ($this->upload->do_upload('file_spm') && !empty($_FILES['file_spm']['name'])) {
                $gbrfile_spm = $this->upload->data();
                $file_spm = $gbrfile_spm['file_name'];
                $insert['dokumen_spm'] = $file_spm;
            }
        }
        if (!empty($_FILES['file_sp2d']['name']) || $_FILES['file_sp2d']['name'] != "") {
            if ($this->upload->do_upload('file_sp2d') && !empty($_FILES['file_sp2d']['name'])) {
                $gbrfile_sp2d = $this->upload->data();
                $file_sp2d = $gbrfile_sp2d['file_name'];
                $insert['dokumen_sp2d'] = $file_sp2d;
            }
        }
        if (!empty($_FILES['file_sk']['name']) || $_FILES['file_sk']['name'] != "") {
            if ($this->upload->do_upload('file_sk') && !empty($_FILES['file_sk']['name'])) {
                $gbrfile_sk = $this->upload->data();
                $file_sk = $gbrfile_sk['file_name'];
                $insert['dokumen_sk'] = $file_sk;
            }
        }
        if (!empty($_FILES['file_kuitansi']['name']) || $_FILES['file_kuitansi']['name'] != "") {
            if ($this->upload->do_upload('file_kuitansi') && !empty($_FILES['file_kuitansi']['name'])) {
                $gbrfile_kuitansi = $this->upload->data();
                $file_kuitansi = $gbrfile_kuitansi['file_name'];
                $insert['dokumen_kuitansi'] = $file_kuitansi;
            }
        }
        if (!empty($_FILES['file_laporan']['name']) || $_FILES['file_laporan']['name'] != "") {
            if ($this->upload->do_upload('file_laporan') && !empty($_FILES['file_laporan']['name'])) {
                $gbrfile_laporan = $this->upload->data();
                $file_laporan = $gbrfile_laporan['file_name'];
                $insert['dokumen_laporan'] = $file_laporan;
            }
        }
        if (!empty($_FILES['file_biodata']['name']) || $_FILES['file_biodata']['name'] != "") {
            if ($this->upload->do_upload('file_biodata') && !empty($_FILES['file_biodata']['name'])) {
                $gbrfile_biodata = $this->upload->data();
                $file_biodata = $gbrfile_biodata['file_name'];
                $insert['dokumen_biodata'] = $file_biodata;
            }
        }
        if (!empty($_FILES['file_daftar']['name']) || $_FILES['file_daftar']['name'] != "") {
            if ($this->upload->do_upload('file_daftar') && !empty($_FILES['file_daftar']['name'])) {
                $gbrfile_daftar = $this->upload->data();
                $file_daftar = $gbrfile_daftar['file_name'];
                $insert['dokumen_daftarhadir'] = $file_daftar;
            }
        }
        if (!empty($_FILES['file_atk']['name']) || $_FILES['file_atk']['name'] != "") {
            if ($this->upload->do_upload('file_atk') && !empty($_FILES['file_atk']['name'])) {
                $gbrfile_atk = $this->upload->data();
                $file_atk = $gbrfile_atk['file_name'];
                $insert['dokumen_atk'] = $file_atk;
            }
        }

        date_default_timezone_set('Asia/Jakarta');

        $nospp = $this->input->post('nospp');
        $tgl = $this->input->post('tgl');
        $nilaispm = $this->input->post('nilaispm');
        $uraian = $this->input->post('uraian');
        $nosp2d = $this->input->post('nosp2d');
        $tglsp2d = $this->input->post('tglsp2d');
        $nilaisp2d = $this->input->post('nilaisp2d');
        $nama_keg = $this->input->post('nama_keg');
        $tgl_keg = $this->input->post('tgl_keg');
        $kode_mak = $this->input->post('kode_mak');

        $this->load->model('m_perjadin', 'kode');
        $kode_prj = $this->kode->kode_prj();
        $dokumen_id = $kode_prj;

        $created = date('d-m-Y H:i:s');
        $created_by = $this->session->userdata['id'];
        
        $insert['created_date'] = $created;
        $insert['dokumen_id'] = $dokumen_id;

        $this->m_lpj->simpan_lpj($nospp, $tgl, $nilaispm, $uraian, $nosp2d, $tglsp2d, $nilaisp2d, $nama_keg, $tgl_keg, $kode_mak, $dokumen_id, $created, $created_by);

        $this->m_perjadin->ins_perjadin($insert);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Inserted!</div>');
        redirect('perjadin');
    }

    function ubah_perjadin()
    {
        // return var_dump($_FILES['file_spp']['name']);

        //return var_dump($_POST);
        $config['upload_path'] = './src/upload/lpj/'; //path folder
        $config['allowed_types'] = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['overwrite'] = TRUE;
        $config['max_size'] = 2048; //ukuran file

        $this->upload->initialize($config);
        $file_spp = null;
        $file_spm = null;
        $file_sp2d = null;
        $file_sk = null;
        $file_kuitansi = null;
        $file_laporan = null;
        $file_biodata = null;
        $file_daftar = null;
        $file_atk = null;
        // untuk dokumen yang diupload

        if (!empty($_FILES['file_spp']['name']) || $_FILES['file_spp']['name'] != "") {
            if ($this->upload->do_upload('file_spp') && !empty($_FILES['file_spp']['name'])) {
                $gbrfile_spp = $this->upload->data();
                $file_spp = $gbrfile_spp['file_name'];
                $update['dokumen_spp'] = $file_spp;
            }
        }
        if (!empty($_FILES['file_spm']['name']) || $_FILES['file_spm']['name'] != "") {
            if ($this->upload->do_upload('file_spm') && !empty($_FILES['file_spm']['name'])) {
                $gbrfile_spm = $this->upload->data();
                $file_spm = $gbrfile_spm['file_name'];
                $update['dokumen_spm'] = $file_spm;
            }
        }
        if (!empty($_FILES['file_sp2d']['name']) || $_FILES['file_sp2d']['name'] != "") {
            if ($this->upload->do_upload('file_sp2d') && !empty($_FILES['file_sp2d']['name'])) {
                $gbrfile_sp2d = $this->upload->data();
                $file_sp2d = $gbrfile_sp2d['file_name'];
                $update['dokumen_sp2d'] = $file_sp2d;
            }
        }
        if (!empty($_FILES['file_sk']['name']) || $_FILES['file_sk']['name'] != "") {
            if ($this->upload->do_upload('file_sk') && !empty($_FILES['file_sk']['name'])) {
                $gbrfile_sk = $this->upload->data();
                $file_sk = $gbrfile_sk['file_name'];
                $update['dokumen_sk'] = $file_sk;
            }
        }
        if (!empty($_FILES['file_kuitansi']['name']) || $_FILES['file_kuitansi']['name'] != "") {
            if ($this->upload->do_upload('file_kuitansi') && !empty($_FILES['file_kuitansi']['name'])) {
                $gbrfile_kuitansi = $this->upload->data();
                $file_kuitansi = $gbrfile_kuitansi['file_name'];
                $update['dokumen_kuitansi'] = $file_kuitansi;
            }
        }
        if (!empty($_FILES['file_laporan']['name']) || $_FILES['file_laporan']['name'] != "") {
            if ($this->upload->do_upload('file_laporan') && !empty($_FILES['file_laporan']['name'])) {
                $gbrfile_laporan = $this->upload->data();
                $file_laporan = $gbrfile_laporan['file_name'];
                $update['dokumen_laporan'] = $file_laporan;
            }
        }
        if (!empty($_FILES['file_biodata']['name']) || $_FILES['file_biodata']['name'] != "") {
            if ($this->upload->do_upload('file_biodata') && !empty($_FILES['file_biodata']['name'])) {
                $gbrfile_biodata = $this->upload->data();
                $file_biodata = $gbrfile_biodata['file_name'];
                $update['dokumen_biodata'] = $file_biodata;
            }
        }
        if (!empty($_FILES['file_daftar']['name']) || $_FILES['file_daftar']['name'] != "") {
            if ($this->upload->do_upload('file_daftar') && !empty($_FILES['file_daftar']['name'])) {
                $gbrfile_daftar = $this->upload->data();
                $file_daftar = $gbrfile_daftar['file_name'];
                $update['dokumen_daftarhadir'] = $file_daftar;
            }
        }
        if (!empty($_FILES['file_atk']['name']) || $_FILES['file_atk']['name'] != "") {
            if ($this->upload->do_upload('file_atk') && !empty($_FILES['file_atk']['name'])) {
                $gbrfile_atk = $this->upload->data();
                $file_atk = $gbrfile_atk['file_name'];
                $update['dokumen_atk'] = $file_atk;
            }
        }

        $lpj_id = $this->input->post('lpj_id');
        $nospp = $this->input->post('nospp');
        $tgl = $this->input->post('tgl');
        $nilaispm = $this->input->post('nilaispm');
        $uraian = $this->input->post('uraian');
        $nosp2d = $this->input->post('nosp2d');
        $tglsp2d = $this->input->post('tglsp2d');
        $nilaisp2d = $this->input->post('nilaisp2d');
        $nama_keg = $this->input->post('nama_keg');
        $tgl_keg = $this->input->post('tgl_keg');
        $kode_mak = $this->input->post('kode_mak');
        $dokumen_id = $this->input->post('kode_prj');

        date_default_timezone_set('Asia/Jakarta');
        $created = date('d-m-Y H:i:s');
        $update['update_date'] = $created;
        $this->m_lpj->ubah_lpj($nospp, $tgl, $nilaispm, $uraian, $nosp2d, $tglsp2d, $nilaisp2d, $nama_keg, $tgl_keg, $kode_mak, $lpj_id, $created);

        // $this->m_perjadin->ubah_perjadin($dokumen_id, $file_spp, $file_spm, $file_sp2d, $file_sk, $file_kuitansi, $file_laporan, $file_biodata, $file_daftar, $file_atk, $created);
        $this->m_perjadin->up_perjadin($update, $dokumen_id);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Updated!</div>');
        redirect('perjadin');
    }

    function hapus_perjadin()
    {
        date_default_timezone_set('Asia/Jakarta');

        $dokumen_id = $this->input->post('dkode_prj');

        $file_spp = $this->input->post('dfile_spp');
        $file_spm = $this->input->post('dfile_spm');
        $file_sp2d = $this->input->post('dfile_sp2d');
        $file_sk = $this->input->post('dfile_sk');
        $file_laporan = $this->input->post('dfile_laporan');
        $file_kuitansi = $this->input->post('dfile_kuitansi');
        $file_biodata = $this->input->post('dfile_biodata');
        $file_daftar = $this->input->post('dfile_daftar');
        $file_atk = $this->input->post('dfile_atk');

        if ($file_spp != null) {
            unlink('src/upload/lpj/' . $file_spp);
        }
        if ($file_spm != null) {
            unlink('src/upload/lpj/' . $file_spm);
        }
        if ($file_sp2d != null) {
            unlink('src/upload/lpj/' . $file_sp2d);
        }
        if ($file_sk != null) {
            unlink('src/upload/lpj/' . $file_sk);
        }
        if ($file_laporan != null) {
            unlink('src/upload/lpj/' . $file_laporan);
        }
        if ($file_kuitansi != null) {
            unlink('src/upload/lpj/' . $file_kuitansi);
        }
        if ($file_biodata != null) {
            unlink('src/upload/lpj/' . $file_biodata);
        }
        if ($file_daftar != null) {
            unlink('src/upload/lpj/' . $file_daftar);
        }
        if ($file_atk != null) {
            unlink('src/upload/lpj/' . $file_atk);
        }
        $deleted = date('d-m-Y H:i:s');
        $deleted_by = $this->session->userdata['id'];
        $this->m_perjadin->hapus_perjadin($dokumen_id, $deleted, $deleted_by);
        $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">Data has been deleted!</div>');
        redirect('perjadin');
    }

    function getPerjadinId()
    {
        $this->load->model('m_perjadin', 'xperjadin');
        $id = $_GET['id'];
        $data = $this->xperjadin->getPerjadinId($id);
        echo json_encode($data);
    }
}
