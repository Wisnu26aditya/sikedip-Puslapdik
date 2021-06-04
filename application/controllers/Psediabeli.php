<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Psediabeli extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_psediabeli');
        is_login();
    }

    function index()
    {

        $data['title'] = 'Persediaan Masuk - Pembeliaan';

        $data['menu'] = $this->db->get('psedia_tr')->result_array();

        $data['js'] = 'psediatr.js'; //untuk manggil js yang dibutuhkan

        $this->load->model('m_psediabeli', 'xpsedia');
        $data['Psedia'] = $this->xpsedia->getPsedia();

        $data['mstbrg'] = $this->xpsedia->getmstbrg()->result();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/v_psediabeli', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function ins_psediatr()
    {
        date_default_timezone_set('Asia/Jakarta');

        $no_bukti = $this->input->post('no_bukti');

        $this->load->model('m_psediabeli', 'kode');
        $kode_sskel = $this->kode->kode_psdtr();

        $jml_in = $this->input->post('jml_in');
        $jml_in_clear = str_replace(".", "", $jml_in);
        $sskel_brg = $this->input->post('sskel_brg');
        $tgl_dok = $this->input->post('tgl_dok');
        $akun = $this->input->post('akun');
        $tgl_buku = $this->input->post('tgl_buku');
        $hrg_satuan = $this->input->post('hrg_satuan');
        $hrg_satuan_clear = str_replace(".", "", $hrg_satuan);
        $hrg_total = $jml_in_clear * $hrg_satuan_clear;

        $created = date('d-m-Y H:i:s');
        $created_by = $this->session->userdata['id'];

        $tr['no_bukti'] = $no_bukti;
        $tr['dok_id'] = $kode_sskel;
        $tr['tgl_dok'] = $tgl_dok;
        $tr['tgl_buku'] = $tgl_buku;
        $tr['created_date'] = $created;
        $tr['created_by'] = $created_by;

        $dt['dok_id'] = $kode_sskel;
        $dt['jml_in'] = $jml_in_clear;
        $dt['akun'] = $akun;
        $dt['sskel_brg'] = $sskel_brg;
        $dt['hrg_satuan'] = $hrg_satuan_clear;
        $dt['hrg_total'] = $hrg_total;
        $dt['created_date'] = $created;
        $dt['created_by'] = $created_by;

        $stok['sskel_brg'] = $sskel_brg;
        $stok['jml_in'] = $jml_in;
        $stok['created_date'] = $created;
        $stok['created_by'] = $created_by;

        $this->m_psediabeli->ins_psediatr($tr);
        $this->m_psediabeli->ins_psediatrdt($dt);
        $this->m_psediabeli->ins_psediastok($stok);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Inserted!</div>');
        redirect('psediabeli');
    }

    function up_psediatr()
    {

        date_default_timezone_set('Asia/Jakarta');

        $edok_id = $this->input->post('edok_id');
        $esskel_brg = $this->input->post('esskel_brg');
        $ejml_in = $this->input->post('ejml_in');
        $ejml_in_clear = str_replace(".", "", $ejml_in);
        $eakun = $this->input->post('eakun');
        $eket = $this->input->post('eket');
        $ehrg_satuan = $this->input->post('ehrg_satuan');
        $ehrg_satuan_clear = str_replace(".", "", $ehrg_satuan);
        $ehrg_total = $ejml_in_clear * $ehrg_satuan_clear;

        $ecreated = date('d-m-Y H:i:s');
        $ecreated_by = $this->session->userdata['id'];

        $insert['dok_id'] = $edok_id;
        $insert['sskel_brg'] = $esskel_brg;
        $insert['jml_in'] = $ejml_in_clear;
        $insert['akun'] = $eakun;
        $insert['ket'] = $eket;
        $insert['hrg_satuan'] = $ehrg_satuan_clear;
        $insert['hrg_total'] = $ehrg_total;
        $insert['created_date'] = $ecreated;
        $insert['created_by'] = $ecreated_by;

        $stok['sskel_brg'] = $esskel_brg;
        $stok['jml_in'] = $ejml_in;
        $stok['created_date'] = $ecreated;
        $stok['created_by'] = $ecreated_by;

        $this->m_psediabeli->ins_psediatrdt($insert);
        $this->m_psediabeli->ins_psediastok($stok);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Insert!</div>');
        redirect('psediabeli');
    }

    function del_psediatr()
    {
        $dok_id = $this->input->post('d_dokid');
        $deleted = date('d-m-Y H:i:s');
        $deleted_by = $this->session->userdata['id'];


        $this->m_psediabeli->del_psediatr($dok_id, $deleted_by, $deleted_by);
        $this->m_psediabeli->del_psediastok($dok_id, $deleted_by, $deleted_by);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Data Insert!</div>');
        redirect('psediabeli');
    }

    function getPsediatrId()
    {
        $this->load->model('m_psediabeli', 'xpsedia');
        $id = $_GET['id'];
        $data = $this->xpsedia->getPsediatrId($id);
        echo json_encode($data);
    }

    function getPsediatrdtId()
    {
        $this->load->model('m_psediabeli', 'xpsedia');
        $id = $_GET['id'];
        $data = $this->xpsedia->getPsediatrdtId($id);
        $table = $this->xpsedia->getPsediatr($id);
        $tr = array();
        foreach ($table as $a) {

            $td['nama_brg'] = $a->nama_brg;
            $td['jml_in'] = $a->jml_in;
            $td['satuan'] = $a->satuan;
            $td['hrg_satuan'] = number_format($a->hrg_satuan);
            $td['hrg_total'] = number_format($a->hrg_total);
            $td['akun'] = $a->akun;
            $td['ket'] = $a->ket;
            $td['dt_id'] = $a->dt_id;
            $tr[] = $td;
        }
        $hasil['detail'] = $data;
        $hasil['results'] = $tr;
        echo json_encode($hasil);
    }
    
}
