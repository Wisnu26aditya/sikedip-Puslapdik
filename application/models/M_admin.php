<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function jmlAkun()
    {
        $query = $this->db->get_where('login', array('is_active' => 1));
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function jmlAkunpending()
    {
        $query = $this->db->get_where('login', array('is_active' => 0));
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function jmllpj_perjadin()
    {
        $query = "select * from lpj where dokumen_id like 'PRJ-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmllpj_honkeg()
    {
        $query = "select * from lpj where dokumen_id like 'HKG-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmllpj_honbul()
    {
        $query = "select * from lpj where dokumen_id like 'HBL-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmllpj_up()
    {
        $query = "select * from lpj where dokumen_id like 'UP-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmllpj_tup()
    {
        $query = "select * from lpj where dokumen_id like 'TUP-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmllpj_pbjbwh50()
    {
        $query = "select * from lpj where dokumen_id like 'PBJB-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmllpj_pbjatas50()
    {
        $query = "select * from lpj where dokumen_id like 'PBJD-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmllpj_pbj200()
    {
        $query = "select * from lpj where dokumen_id like 'PBJA-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmlls_bendahara()
    {
        $query = "select * from spp where spp_dok_id like 'LSB-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmlls_tiga()
    {
        $query = "select * from spp where spp_dok_id like 'LST-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmlgaji()
    {
        $query = "select * from spp where spp_dok_id like 'GJ-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmluangmakan()
    {
        $query = "select * from spp where spp_dok_id like 'UM-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmlspp_up()
    {
        $query = "select * from spp where spp_dok_id like 'SPPU-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

    public function jmlspp_tup()
    {
        $query = "select * from spp where spp_dok_id like 'SPPT-%' and show_item='1'";
        return $this->db->query($query)->num_rows();
    }

}
