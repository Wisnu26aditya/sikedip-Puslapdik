<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_akses extends CI_Model
{
    public function getListAkses($user)
    {
        
        $query = "SELECT a.module_id, a.module_nama FROM master_modules a
                    WHERE a.module_id NOT IN 
                    ( 
                        SELECT b.module_id FROM master_akses b where b.akses_user = '".$user."'
                    )";
        return $this->db->query($query)->result_array();
    }

    public function getAkunId()
    {
        $query = "SELECT    a.id,
                            a.name,
                            a.email,
                            a.image,
                            b.role,
                            case 
                                when a.is_active='1' then 'Active'
                                ELSE 'Not Active'
                                END aktif,
                            case
                                when a.is_upload='1' then 'Allow'
                                ELSE 'Not Allowed'
                                END upload,
                            case
                                when a.is_download='1' then 'Allow'
                                ELSE 'Not Allowed'
                                END download
                from login a
                JOIN user_role b ON a.role_id = b.id";
        return $this->db->query($query)->result_array();
    }

    public function getAksesId($id)
    {
        $query = "SELECT a.id, a.name, a.email, a.image,
                    a.role_id, a.is_active, a.is_upload, a.is_download FROM login a
                    where a.id = '" . $id . "'";
        return $this->db->query($query)->row();
    }

    function akses($cb_akses, $created, $id)
    {
        $hsl = $this->db->query("INSERT INTO master_akses(akses_user,module_id,created_date)
                                    VALUES ('$id','$cb_akses','$created')");
        return $hsl;
    }

    function updown($upload, $download, $urut)
    {
        $hsl = $this->db->query("UPDATE login 
                                    SET is_download = '" . $download . "', 
                                    is_upload = '" . $upload . "'
                                    where id = '" . $urut . "'");
        return $hsl;
    }

    function editakses($id, $image, $role, $is_active, $is_upload, $is_download)
    {
        $hsl = $this->db->query("UPDATE login 
                                    SET 
                                    image = '$image',
                                    role_id = '$role',
                                    is_active = '$is_active',
                                    is_upload = '$is_upload',
                                    is_download = '$is_download'
                                    where id = '$id'");
        return $hsl;
    }
}
