<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pbj extends CI_Model
{
    public function getPbj_b($user)
    {
        $query = "SELECT a.lpj_id, a.lpj_nomorsppspm, a.dokumen_id, a.lpj_tgl, a.lpj_nilaispm, a.lpj_uraian, 
                    a.lpj_nomorsp2d, a.lpj_tglsp2d, a.lpj_nilaisp2d, a.created_by,
                    b.dokumen_spp, b.dokumen_spm, b.dokumen_sp2d, b.dokumen_buktipembelian, b.dokumen_karwas, b.dokumen_lelang,
                    b.dokumen_pengadaan, a.lpj_id
                    FROM lpj a
                    JOIN dokumen_lpj b ON a.dokumen_id = b.dokumen_id
                    where a.dokumen_id like 'PBJB-%' and a.show_item=1
                    and a.created_by = '".$user."'
                    ORDER BY a.lpj_id";
        return $this->db->query($query)->result_array();
    }

    public function getPbj_d($user)
    {
        $query = "SELECT a.lpj_id, a.lpj_nomorsppspm, a.dokumen_id, a.lpj_tgl, a.lpj_nilaispm, a.lpj_uraian, 
                    a.lpj_nomorsp2d, a.lpj_tglsp2d, a.lpj_nilaisp2d, a.created_by,
                    b.dokumen_spp, b.dokumen_spm, b.dokumen_sp2d, b.dokumen_buktipembelian, b.dokumen_karwas, b.dokumen_lelang,
                    b.dokumen_pengadaan, a.lpj_id
                    FROM lpj a
                    JOIN dokumen_lpj b ON a.dokumen_id = b.dokumen_id
                    where a.dokumen_id like 'PBJD-%' and a.show_item=1
                    and a.created_by = '".$user."'
                    ORDER BY a.lpj_id";
        return $this->db->query($query)->result_array();
    }

    public function getPbj_a($user)
    {
        $query = "SELECT a.lpj_id, a.lpj_nomorsppspm, a.dokumen_id, a.lpj_tgl, a.lpj_nilaispm, a.lpj_uraian, 
                    a.lpj_nomorsp2d, a.lpj_tglsp2d, a.lpj_nilaisp2d, a.created_by,
                    b.dokumen_spp, b.dokumen_spm, b.dokumen_sp2d, b.dokumen_buktipembelian, b.dokumen_karwas, b.dokumen_lelang,
                    b.dokumen_pengadaan, a.lpj_id
                    FROM lpj a
                    JOIN dokumen_lpj b ON a.dokumen_id = b.dokumen_id
                    where a.dokumen_id like 'PBJA-%' and a.show_item=1
                    and a.created_by = '".$user."'
                    ORDER BY a.lpj_id";
        return $this->db->query($query)->result_array();
    }

    public function kode_pbj_b()
    {

        $this->db->select('RIGHT(lpj.lpj_id,4) as kode', FALSE);
        $this->db->order_by('lpj_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('lpj');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $datenow = date('Ymd');
        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "PBJB-" . $datenow . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    public function kode_pbj_d()
    {

        $this->db->select('RIGHT(lpj.lpj_id,4) as kode', FALSE);
        $this->db->order_by('lpj_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('lpj');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $datenow = date('Ymd');
        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "PBJD-" . $datenow . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    public function kode_pbj_a()
    {

        $this->db->select('RIGHT(lpj.lpj_id,4) as kode', FALSE);
        $this->db->order_by('lpj_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('lpj');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $datenow = date('Ymd');
        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "PBJA-" . $datenow . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    function ins_pbj($data)
    {
        $this->db->insert('dokumen_lpj', $data);
    }

    function up_pbj($data, $id)
    {
        $this->db->update('dokumen_lpj', $data, array('dokumen_id' => $id));
    }

    function hapus_pbj($dokumen_id, $deleted_date,$deleted_by)
    {
        $hsl = $this->db->query("UPDATE lpj SET show_item=3, deleted_date='$deleted_date', deleted_by='$deleted_by' where dokumen_id = '$dokumen_id'");
        $hsl = $this->db->query("UPDATE dokumen_lpj SET show_item=3, deleted_date='$deleted_date' where dokumen_id = '$dokumen_id'");
        return $hsl;
    }

    public function getPbj_bId($id)
    {
        $query = "SELECT a.lpj_nomorsppspm, a.dokumen_id, a.lpj_tgl, a.lpj_nilaispm, a.lpj_uraian, 
                    a.lpj_nomorsp2d, a.lpj_tglsp2d, a.lpj_nilaisp2d, a.created_by,
                    b.dokumen_spp, b.dokumen_spm, b.dokumen_sp2d, b.dokumen_buktipembelian, b.dokumen_karwas, b.dokumen_lelang,
                    b.dokumen_pengadaan, b.created_date
                    FROM lpj a
                    JOIN dokumen_lpj b ON a.dokumen_id = b.dokumen_id
                    where a.dokumen_id like 'PBJB-%' and a.show_item=1
                    and  a.lpj_id ='" . $id . "'";
        return $this->db->query($query)->row();
    }

    public function getPbj_dId($id)
    {
        $query = "SELECT a.lpj_nomorsppspm, a.dokumen_id, a.lpj_tgl, a.lpj_nilaispm, a.lpj_uraian, 
                    a.lpj_nomorsp2d, a.lpj_tglsp2d, a.lpj_nilaisp2d, a.created_by,
                    b.dokumen_spp, b.dokumen_spm, b.dokumen_sp2d, b.dokumen_buktipembelian, b.dokumen_karwas, b.dokumen_lelang,
                    b.dokumen_pengadaan, b.created_date
                    FROM lpj a
                    JOIN dokumen_lpj b ON a.dokumen_id = b.dokumen_id
                    where a.dokumen_id like 'PBJD-%' and a.show_item=1
                    and  a.lpj_id ='" . $id . "'";
        return $this->db->query($query)->row();
    }

    public function getPbj_aId($id)
    {
        $query = "SELECT a.lpj_nomorsppspm, a.dokumen_id, a.lpj_tgl, a.lpj_nilaispm, a.lpj_uraian, 
                    a.lpj_nomorsp2d, a.lpj_tglsp2d, a.lpj_nilaisp2d, a.created_by,
                    b.dokumen_spp, b.dokumen_spm, b.dokumen_sp2d, b.dokumen_buktipembelian, b.dokumen_karwas, b.dokumen_lelang,
                    b.dokumen_pengadaan, b.created_date
                    FROM lpj a
                    JOIN dokumen_lpj b ON a.dokumen_id = b.dokumen_id
                    where a.dokumen_id like 'PBJA-%' and a.show_item=1
                    and  a.lpj_id ='" . $id . "'";
        return $this->db->query($query)->row();
    }

}
