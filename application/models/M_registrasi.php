<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_registrasi extends CI_Model
{

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

    public function getRegId($id)
    {
        $query = "SELECT a.id, a.name, a.email, a.image,
                    a.role_id, a.is_active, a.is_upload, a.is_download FROM login a
                    where a.is_active=1 and a.id = '" . $id . "'";
        return $this->db->query($query)->row();
    }

    function up_akun($where,$update)
    {
        $this->db->where($where);
        $this->db->update('login',$update);

        $this->db->where($where);
        $this->db->update('master_updown',$update);
    }

    function hapus_reg($id)
    {
        $hsl = $this->db->query("DELETE login where id='$id'");
    }

    
}
