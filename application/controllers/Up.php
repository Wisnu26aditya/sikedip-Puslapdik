<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Up extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_lpj');
        $this->load->model('m_up');
        $this->load->library('upload');
        is_login();
    }

    function index()
    {

        $data['title'] = 'Uang Persediaan';

        $data['menu'] = $this->db->get('master_modules')->result_array();

        $data['js'] = 'up.js';

        $this->load->model('m_up', 'xup');

        //$data['list_up'] = $this->db->get('dokumen_lpj')->result_array();
        $data['Up'] = $this->xup->getUp($this->session->userdata['id']);
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('lpj/v_up', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function simpan_up()
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
        $file_bukti = null;
        $file_pajak = null;
        $file_pengembalian = null;

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
        if (!empty($_FILES['file_bukti']['name']) || $_FILES['file_bukti']['name'] != "") {
            if ($this->upload->do_upload('file_bukti') && !empty($_FILES['file_bukti']['name'])) {
                $gbrfile_bukti = $this->upload->data();
                $file_bukti = $gbrfile_bukti['file_name'];
                $insert['dokumen_buktipengeluaran'] = $file_bukti;
            }
        }
        if (!empty($_FILES['file_pajak']['name']) || $_FILES['file_pajak']['name'] != "") {
            if ($this->upload->do_upload('file_pajak') && !empty($_FILES['file_pajak']['name'])) {
                $gbrfile_pajak = $this->upload->data();
                $file_pajak = $gbrfile_pajak['file_name'];
                $insert['dokumen_setorpajak'] = $file_pajak;
            }
        }
        if (!empty($_FILES['file_pengembalian']['name']) || $_FILES['file_pengembalian']['name'] != "") {
            if ($this->upload->do_upload('file_pengembalian') && !empty($_FILES['file_pengembalian']['name'])) {
                $gbrfile_pengembalian = $this->upload->data();
                $file_pengembalian = $gbrfile_pengembalian['file_name'];
                $insert['dokumen_setorpengembalian'] = $file_pengembalian;
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

        $this->load->model('m_up', 'kode');
        $kode_up = $this->kode->kode_up();
        $dokumen_id = $kode_up;

        $created = date('d-m-Y H:i:s');
        $created_by = $this->session->userdata['id'];

        $insert['created_date'] = $created;
        $insert['dokumen_id'] = $dokumen_id;

        $this->m_lpj->simpan_lpj($nospp, $tgl, $nilaispm, $uraian, $nosp2d, $tglsp2d, $nilaisp2d, $dokumen_id, $created, $created_by);

        $this->m_up->ins_up($insert);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Added!</div>');
        redirect('up');
    }

    function ubah_up()
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
        $file_bukti = null;
        $file_pajak = null;
        $file_pengembalian = null;
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
        if (!empty($_FILES['file_bukti']['name']) || $_FILES['file_bukti']['name'] != "") {
            if ($this->upload->do_upload('file_bukti') && !empty($_FILES['file_bukti']['name'])) {
                $gbrfile_bukti = $this->upload->data();
                $file_bukti = $gbrfile_bukti['file_name'];
                $update['dokumen_buktipengeluaran'] = $file_bukti;
            }
        }
        if (!empty($_FILES['file_pajak']['name']) || $_FILES['file_pajak']['name'] != "") {
            if ($this->upload->do_upload('file_pajak') && !empty($_FILES['file_pajak']['name'])) {
                $gbrfile_pajak = $this->upload->data();
                $file_pajak = $gbrfile_pajak['file_name'];
                $update['dokumen_setorpajak'] = $file_pajak;
            }
        }
        if (!empty($_FILES['file_pengembalian']['name']) || $_FILES['file_pengembalian']['name'] != "") {
            if ($this->upload->do_upload('file_pengembalian') && !empty($_FILES['file_pengembalian']['name'])) {
                $gbrfile_pengembalian = $this->upload->data();
                $file_pengembalian = $gbrfile_pengembalian['file_name'];
                $update['dokumen_setorpengembalian'] = $file_pengembalian;
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
        $dokumen_id = $this->input->post('kode_up');

        date_default_timezone_set('Asia/Jakarta');
        $created = date('d-m-Y H:i:s');
        $update['update_date'] = $created;
        $this->m_lpj->ubah_lpj($nospp, $tgl, $nilaispm, $uraian, $nosp2d, $tglsp2d, $nilaisp2d, $lpj_id, $created);

        // $this->m_perjadin->ubah_perjadin($dokumen_id, $file_spp, $file_spm, $file_sp2d, $file_sk, $file_kuitansi, $file_laporan, $file_biodata, $file_daftar, $file_atk, $created);
        $this->m_up->up_up($update, $dokumen_id);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Updated!</div>');
        redirect('up');
    }


    function hapus_up()
    {
        date_default_timezone_set('Asia/Jakarta');

        $dokumen_id = $this->input->post('dkode_up');
        $file_spp = $this->input->post('dfile_spp');
        $file_spm = $this->input->post('dfile_spm');
        $file_sp2d = $this->input->post('dfile_sp2d');
        $file_bukti = $this->input->post('dfile_bukti');
        $file_pajak = $this->input->post('dfile_pajak');
        $file_pengembalian = $this->input->post('dfile_pengembalian');

        if ($file_spp != null) {
            unlink('src/upload/lpj/' . $file_spp);
        }
        if ($file_spm != null) {
            unlink('src/upload/lpj/' . $file_spm);
        }
        if ($file_sp2d != null) {
            unlink('src/upload/lpj/' . $file_sp2d);
        }
        if ($file_bukti != null) {
            unlink('src/upload/lpj/' . $file_bukti);
        }
        if ($file_pajak != null) {
            unlink('src/upload/lpj/' . $file_pajak);
        }
        if ($file_pengembalian != null) {
            unlink('src/upload/lpj/' . $file_pengembalian);
        }
        $deleted = date('d-m-Y H:i:s');
        $this->m_up->hapus_up($dokumen_id, $deleted);
        $this->session->set_flashdata('messege', '<div class="alert alert-warning" role="alert">Data has been deleted!</div>');
        redirect('up');
    }

    function getUpId()
    {
        $this->load->model('m_up', 'xup');
        $id = $_GET['id'];
        $data = $this->xup->getUpId($id);
        echo json_encode($data);
    }

}
