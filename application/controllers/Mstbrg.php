<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mstbrg extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_psedia');
        is_login();
    }

    function index()
    {

        $data['title'] = 'Master Barang';

        $data['js'] = 'psedia.js'; //untuk manggil js yang dibutuhkan

        $this->load->model('m_psedia', 'xpsedia');
        $data['Psedia'] = $this->xpsedia->getPsedia();

        $data['kodesskel'] = $this->xpsedia->getsskel()->result();

        $data['dept'] = $this->xpsedia->getdept()->result();

        //$data['list_perjadin'] = $this->db->get('dokumen_lpj')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/v_mstbrg', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function ins_psedia()
    {
        date_default_timezone_set('Asia/Jakarta');

        $kodesskel = $this->input->post('kodesskel');

        $dept = $this->input->post('dept');

        $this->load->model('m_psedia', 'kode');
        $kode_brg = $this->kode->kode_psd();

        $nmbrg = $this->input->post('nmbrg');
        $satuan = $this->input->post('satuan');

        $created = date('d-m-Y H:i:s');
        $created_by = $this->session->userdata['id'];

        $insert['sskel_brg'] = $kodesskel;
        $insert['dept_id'] = $dept;
        $insert['kode_brg'] = $kode_brg;
        $insert['nama_brg'] = $nmbrg;
        $insert['satuan'] = $satuan;
        $insert['created_date'] = $created;
        $insert['created_by'] = $created_by;

        $this->m_psedia->ins_psedia($insert);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Inserted!</div>');
        redirect('mstbrg');
    }

    function up_psedia()
    {

        date_default_timezone_set('Asia/Jakarta');

        $kodesskel = $this->input->post('esskel_brg');
        $dept = $this->input->post('edept');
        $nmbrg = $this->input->post('enama_brg');
        $satuan = $this->input->post('esatuan');
        $kode_id = $this->input->post('eid');

        $updated = date('d-m-Y H:i:s');
        $updated_by = $this->session->userdata['id'];

        $data = array(
            'sskel_brg' => $kodesskel,
            'dept_id' => $dept,
            'nama_brg' => $nmbrg,
            'satuan' => $satuan,
            'updated_date' => $updated,
            'updated_by' => $updated_by
        );

        $where = array(
            'kode_id' => $kode_id
        );

        $this->m_psedia->up_psedia($where, $data, 'psedia_mstbrg');
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data Updated!</div>');
        redirect('mstbrg');
    }

    function getPsediaId()
    {
        $this->load->model('m_psedia', 'xpsedia');
        $id = $_GET['id'];
        $data = $this->xpsedia->getPsediaId($id);
        echo json_encode($data);
    }

    function getMstBrgId()
    {
        $this->load->model('m_psedia', 'xpsedia');
        $id = $_GET['qry'];
        $data = $this->xpsedia->getMstBrgId($id);
        $json = array();
        foreach ($data as $a) {
            $isi['id'] = $a->kd_brg;
            $isi['text'] = $a->kd_brg . " - " . trim($a->ur_sskel);
            $json[] = $isi;
        }
        $b['results'] = $json;
        echo json_encode($b);
    }
}
