<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        is_login();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('login', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('master_modules')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('master_modules', [
                'module_id' => $this->input->post('mid'),
                'module_nama' => $this->input->post('menu'),
                'module_path' => $this->input->post('path'),
                'module_icons' => $this->input->post('icons'),
                'module_level' => $this->input->post('level'),
                'module_parent_id' => $this->input->post('parent'),
                'show_item' => $this->input->post('active')
            ]);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Menu Added!</div>');
            redirect('menu');
        }
    }

    function getMenuId()
    {
        $this->load->model('Menu_model', 'xmenu');
        $menuid = $_GET['menuid'];
        $data = $this->xmenu->getMenuId($menuid);
        echo json_encode($data);
    }

    function ubah_menu()
    {
        $moduleid   = $this->input->post('module_id');
        $nama       = $this->input->post('menu');
        $path       = $this->input->post('path');
        $icons      = $this->input->post('icons');
        $level      = $this->input->post('level');
        $parent     = $this->input->post('parent');
        $active     = $this->input->post('active');
        $this->menu_model->ubah_menu($moduleid, $nama, $path, $icons, $level, $parent, $active);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Menu Added!</div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('login', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Menu_model', 'menu');

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">New Sub Menu Added!</div>');
            redirect('menu/submenu');
        }
    }
}
