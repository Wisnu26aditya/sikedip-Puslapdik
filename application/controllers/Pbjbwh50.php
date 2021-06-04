<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pbjbwh50 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_lpj');
        $this->load->model('m_pbj');
        $this->load->library('upload');
        is_login();
    }

    function index()
    {

        $data['title'] = 'Pengadaan Barang/Jasa dibawah 50 Juta';

        $data['menu'] = $this->db->get('master_modules')->result_array();

        $data['js'] = 'pbjbwh50.js';

        $this->load->model('m_pbj', 'xpbj');

        $data['list_pbj'] = $this->db->get('dokumen_lpj')->result_array();
        $data['Pbj'] = $this->xpbj->getPbj_b($this->session->userdata['id']);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('lpj/v_pbjbwh50', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function simpan_pbjbwh50()
    {
        $config['upload_path'] = './src/upload/lpj/'; //path folder
        $config['allowed_types'] = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        //$config['file_name'] = $nospp;
        $config['max_size'] = 2048; //ukuran file

        $this->upload->initialize($config);
        $file_spp = null;
        $file_spm = null;
        $file_sp2d = null;
        $file_pembelian = null;

        // untuk file Dokumen SPP
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
        if (!empty($_FILES['file_pembelian']['name']) || $_FILES['file_pembelian']['name'] != "") {
            if ($this->upload->do_upload('file_pembelian') && !empty($_FILES['file_pembelian']['name'])) {
                $gbrfile_pembelian = $this->upload->data();
                $file_pembelian = $gbrfile_pembelian['file_name'];
                $insert['dokumen_buktipembelian'] = $file_pembelian;
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

        $this->load->model('m_pbj', 'kode');
        $kode_pbj = $this->kode->kode_pbj_b();
        $dokumen_id = $kode_pbj;

        $created = date('d-m-Y H:i:s');
        $created_by = $this->session->userdata['id'];

        $insert['created_date'] = $created;
        $insert['dokumen_id'] = $dokumen_id;

        $this->m_lpj->simpan_lpj($nospp, $tgl, $nilaispm, $uraian, $nosp2d, $tglsp2d, $nilaisp2d, $dokumen_id, $created, $created_by);

        $this->m_pbj->ins_pbj($insert);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Added!</div>');
        redirect('pbjbwh50');
    }

    function ubah_pbjbwh50()
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
        $file_pembelian = null;
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
        if (!empty($_FILES['file_pembelian']['name']) || $_FILES['file_pembelian']['name'] != "") {
            if ($this->upload->do_upload('file_pembelian') && !empty($_FILES['file_pembelian']['name'])) {
                $gbrfile_pembelian = $this->upload->data();
                $file_pembelian = $gbrfile_pembelian['file_name'];
                $update['dokumen_buktipengeluaran'] = $file_pembelian;
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
        $dokumen_id = $this->input->post('kode_pbj');

        date_default_timezone_set('Asia/Jakarta');
        $created = date('d-m-Y H:i:s');
        $update['update_date'] = $created;
        $this->m_lpj->ubah_lpj($nospp, $tgl, $nilaispm, $uraian, $nosp2d, $tglsp2d, $nilaisp2d, $lpj_id, $created);

        // $this->m_perjadin->ubah_perjadin($dokumen_id, $file_spp, $file_spm, $file_sp2d, $file_sk, $file_kuitansi, $file_laporan, $file_biodata, $file_daftar, $file_atk, $created);
        $this->m_pbj->up_pbj($update, $dokumen_id);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Updated!</div>');
        redirect('pbjbwh50');
    }

    function hapus_pbjbwh50()
    {
        date_default_timezone_set('Asia/Jakarta');

        $dokumen_id = $this->input->post('dkode_pbj');
        $file_spp = $this->input->post('dfile_spp');
        $file_spm = $this->input->post('dfile_spm');
        $file_sp2d = $this->input->post('dfile_sp2d');
        $file_pembelian = $this->input->post('dfile_pembelian');
        if ($file_spp != null) {
            unlink('src/upload/lpj/' . $file_spp);
        }
        if ($file_spm != null) {
            unlink('src/upload/lpj/' . $file_spm);
        }
        if ($file_sp2d != null) {
            unlink('src/upload/lpj/' . $file_sp2d);
        }
        if ($file_pembelian != null) {
            unlink('src/upload/lpj/' . $file_pembelian);
        }
        $deleted = date('d-m-Y H:i:s');
        $deleted_by = $this->session->userdata['id'];
        $this->m_pbj->hapus_pbj($dokumen_id, $deleted, $deleted_by);
        $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">Data has been deleted!</div>');
        redirect('pbjbwh50');
    }

    function getPbjbwh50Id()
    {
        $this->load->model('m_pbj', 'xpbj');
        $id = $_GET['id'];
        $data = $this->xpbj->getPbj_bId($id);
        echo json_encode($data);
    }
}
