<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dvicon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_vicon');
        is_login();
    }

    function index()
    {
        $data['title'] = 'Kegiatan Video Conference';

        $data['list'] = $this->db->get('list_vicon')->result_array();

        $data['js'] = 'vicon.js';

        $this->form_validation->set_rules('list', 'List', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/v_vicon', $data);
            $this->load->view('templates/footer');
        }
    }

    function simpan_vicon()
    {
        function password_generate($chars)
        {
            $gen = '12346789ABCDEFGHJKLMNPQRTUVWXYZabcefghjkmnpqrtuvwxyz';
            return substr(str_shuffle($gen), 0, $chars);
        }

        $awal = password_generate(2);
        $akhir = password_generate(3);

        $tgl = $this->input->post('tanggal');
        $rapat = $this->input->post('rapat');
        $jam1 = $this->input->post('awal');
        $jam2 = $this->input->post('akhir');
        $meetnum = $this->input->post('meetnum');
        $pic = $this->input->post('pic');
        $meetpass = $this->input->post('meetpass');
        $optionsRadios = $this->input->post('optionsRadios');
        if ($optionsRadios == "eksternal") {
            $url = 'http://ringkas.kemdikbud.go.id/viconpuslapdik';
        } elseif ($optionsRadios == "internal") {
            $url = 'http://ringkas.kemdikbud.go.id/viconinternal';
        }

        $this->m_vicon->simpan_vicon($awal, $akhir, $tgl, $rapat, $jam1, $jam2, $meetnum, $pic, $meetpass, $url);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Schedule Added!</div>');
        redirect('dvicon');
    }

    function getviconid()
    {
        $this->load->model('m_vicon', 'vicon');
        $id = $_GET['id'];
        $data = $this->vicon->getviconid($id);
        echo json_encode($data);
    }
}
