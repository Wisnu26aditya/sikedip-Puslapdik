<?php
    function is_login()
    {
        // cek login atau belum dan role nya apa ??
        $ci = get_instance();
        if(!$ci->session->userdata('email')) {
            redirect('auth');
        } else {
            $role_id = $ci->session->userdata('role_id');
            $menu = $ci->uri->segment(1);
            

            $query_menu = $ci->db->get_where('master_modules', ['module_path' => $menu])->row_array();
            $menu_id = $query_menu['module_id'];

            $userAccess = $ci->db->get_where('master_akses', [
                'akses_user' => $role_id,
                'module_id' => $menu_id
            ]);

            if ($userAccess->num_rows() > 1) {
                redirect('auth/blocked');
            }
        }
    }
