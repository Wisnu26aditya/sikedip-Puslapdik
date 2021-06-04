<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT a.* FROM master_modules a";
        return $this->db->query($query)->result_array();
    }

    public function getMenuId($menuid)
    {
        $query = "SELECT a.module_id, a.module_nama, a.module_path, a.module_icons,
                    a.module_level, a.module_parent_id, a.show_item FROM master_modules a
                    where module_id = '" . $menuid . "'";
        return $this->db->query($query)->row();
    }

    public function ubah_menu($moduleid,$nama,$path,$icons,$level,$parent,$active)
    {
        $hsl = $this->db->query("UPDATE master_modules SET module_nama='$nama',
                            module_path='$path', 
                            module_icons='$icons', 
                            module_level='$level', 
                            module_parent_id='$parent', 
                            show_item='$active'
                            where module_id='$moduleid'");
        return $hsl;
    }
}
