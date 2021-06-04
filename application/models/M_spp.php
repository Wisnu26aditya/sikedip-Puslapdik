<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_spp extends CI_Model
{
    function simpan_spp($dok, $nospp, $tgl, $nilaispp, $created, $tgl_pengajuan, $created_by)
    {
        $hsl = $this->db->query("INSERT INTO spp(spp_no,spp_tgl,spp_nilai,spp_dok_id,tgl_pengajuan,created_date,created_by) 
        VALUES ('$nospp','$tgl','$nilaispp','$dok','$tgl_pengajuan','$created','$created_by')");
        return $hsl;
    }

    function ubah_spp($dok, $nospp, $tgl, $nilaispp, $created, $tgl_pengajuan, $created_by)
    {
        $query = "UPDATE spp
        SET 
        spp_no = '$nospp',
        spp_tgl = '$tgl', 
        spp_nilai = '$nilaispp',
        tgl_pengajuan = '$tgl_pengajuan',
        created_date = '$created',
        created_by = '$created_by'
        where spp_dok_id = '$dok'";
        $hsl = $this->db->query($query);
        return $hsl;
    }
}
