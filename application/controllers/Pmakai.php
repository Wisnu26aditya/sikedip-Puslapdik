<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pmakai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_pmakai');
        is_login();
    }

    function index()
    {

        $data['title'] = 'Persediaan Keluar - Pemakaian';

        $data['js'] = 'pmakai.js'; //untuk manggil js yang dibutuhkan

        $this->load->model('m_pmakai', 'xpmakai');
        $data['Pemakai'] = $this->xpmakai->getPemakai();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/v_pmakai', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function ins_pmakai()
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('m_pmakai', 'pmakai');
        $kode_dok = $this->pmakai->kode_pmakai();

        $jml_in = $this->input->post('jml_in');
        $jml_out = $this->input->post('jml_out');
        $satuan = $this->input->post('satuan');

        $sskel_brg = $this->input->post('kodesskel');
        $ket = $this->input->post('ket');
        $hrg_satuan = $this->input->post('hrg_satuan');
        $hrg_satuan_clear = str_replace(',', '', $hrg_satuan);
        $hrg_total = $jml_out * $hrg_satuan_clear;
        $status    = 1;
        $show_item    = 1;
        $created = date('d-m-Y H:i:s');
        $created_by = $this->session->userdata['id'];

        $insert['dok_id'] = $kode_dok;
        $insert['sskel_brg'] = $sskel_brg;
        $insert['jml_out'] = $jml_out;
        $insert['ket'] = $ket;
        $insert['status'] = $status;
        $insert['show_item'] = $show_item;
        $insert['hrg_satuan'] = $hrg_satuan_clear;
        $insert['hrg_total'] = $hrg_total;
        $insert['created_date'] = $created;
        $insert['created_by'] = $created_by;

        if (intval($jml_out) > intval($jml_in)) {
            $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Data not inserted! Permintaan: ' . $jml_out . ' ' . $satuan . ' > ' . $jml_in . '</div>');
            redirect('pmakai');
        } else {
            $this->m_pmakai->ins_pmakai($insert);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Inserted!</div>');
            redirect('pmakai');
        }
    }

    function acc_pmakai()
    {
        date_default_timezone_set('Asia/Jakarta');

        $sskel_brg = $this->input->post('asskel_brg');
        $dok_id = $this->input->post('adok');
        $jml_out = $this->input->post('ajml_out');
        $update_date = date('d-m-Y H:i:s');
        $update_by =  $this->session->userdata['id'];

        $this->m_pmakai->acc_pkdt($dok_id, $sskel_brg, $update_date, $update_by);
        $this->m_pmakai->acc_stok_brg($sskel_brg, $jml_out, $update_date, $update_by);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data has been Accepted!</div>');
        redirect('pmakai');
    }

    function getPemakaiId()
    {
        $this->load->model('m_pmakai', 'xpmakai');
        $id2 = $_GET['qry2'];
        $data2 = $this->xpmakai->getPemakaiId($id2);
        $json = array();
        foreach ($data2 as $a2) {
            $isi2['kode_brg'] = $a2->sskel_brg;
            $isi2['hrg_satuan'] = number_format($a2->hrg_satuan, 0);
            $isi2['satuan'] = $a2->satuan;
            $isi2['jml_in'] = $a2->saldo_awal . " " . $a2->satuan;
            $isi2['text'] = $a2->sskel_brg . " - " . trim($a2->nama_brg);
            $json2[] = $isi2;
        }
        $b2['results'] = $json2;
        echo json_encode($b2);
    }

    function getDataPakaiId()
    {
        $this->load->model('m_pmakai', 'xpakai');
        $id = $_GET['id'];
        $data = $this->xpakai->getDataPakaiId($id);
        echo json_encode($data);
    }
}
