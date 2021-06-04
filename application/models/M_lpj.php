<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_lpj extends CI_Model
{
    function simpan_lpj($nospp, $tgl, $nilaispm, $uraian, $nosp2d, $tglsp2d, $nilaisp2d, $nama_keg, $tgl_keg, $kode_mak, $dokumen_id, $created, $created_by)
    {
        $hsl = $this->db->query("INSERT INTO lpj(lpj_nomorsppspm,lpj_tgl,lpj_nilaispm,lpj_uraian,lpj_nomorsp2d,lpj_tglsp2d,lpj_nilaisp2d,nama_keg,tgl_keg,kode_mak,dokumen_id,created_date, created_by) 
        VALUES ('$nospp','$tgl', '$nilaispm','$uraian','$nosp2d','$tglsp2d','$nilaisp2d','$nama_keg','$tgl_keg','$kode_mak','$dokumen_id','$created', '$created_by')");
        return $hsl;
    }

    function ubah_lpj($nospp, $tgl, $nilaispm, $uraian, $nosp2d, $tglsp2d, $nilaisp2d, $nama_keg, $tgl_keg, $kode_mak, $lpj_id, $created)
    {
        echo $query = "UPDATE lpj
        SET 
        lpj_nomorsppspm = '$nospp',
        lpj_tgl = '$tgl', 
        lpj_nilaispm = '$nilaispm',
        lpj_uraian = '$uraian',
        lpj_nomorsp2d = '$nosp2d',
        lpj_tglsp2d = '$tglsp2d',
        lpj_nilaisp2d = '$nilaisp2d',
        nama_keg = '$nama_keg',
        tgl_keg = '$tgl_keg',
        kode_mak = '$kode_mak',
        update_date = '$created'
        where lpj_id = '$lpj_id'";
        $hsl = $this->db->query($query);
        return $hsl;
    }
}
