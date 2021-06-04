<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_honbul extends CI_Model
{
    public function getHonbul($user)
    {
        $query = "SELECT a.lpj_id, a.lpj_nomorsppspm, a.dokumen_id, a.lpj_tgl, a.lpj_nilaispm, a.lpj_uraian, 
                    a.lpj_nomorsp2d, a.lpj_tglsp2d, a.lpj_nilaisp2d, a.created_by,
                    b.dokumen_spp, b.dokumen_spm, b.dokumen_sp2d, b.dokumen_sk, b.dokumen_kuitansi
                    FROM lpj a
                    JOIN dokumen_lpj b ON a.dokumen_id = b.dokumen_id
                    where a.dokumen_id like 'HBL-%' and a.show_item=1
                    and a.created_by = '".$user."'
                    ORDER BY a.lpj_id";
        return $this->db->query($query)->result_array();
    }

    public function kode_hbl()
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
        $kodejadi = "HBL-" . $datenow . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    function ins_honbul($data)
    {
        $this->db->insert('dokumen_lpj', $data);
    }
    function up_honbul($data, $id)
    {
        $this->db->update('dokumen_lpj', $data, array('dokumen_id' => $id));
    }
    function hapus_honbul($dokumen_id, $deleted, $deleted_by)
    {
        $hsl = $this->db->query("UPDATE lpj SET show_item=3, deleted_date='$deleted', deleted_by='$deleted_by' where dokumen_id = '$dokumen_id'");
        $hsl = $this->db->query("UPDATE dokumen_lpj SET show_item=3, deleted_date='$deleted' where dokumen_id = '$dokumen_id'");
        return $hsl;
    }

    public function getHonbulId($id)
    {
        $query = "SELECT a.lpj_nomorsppspm, a.dokumen_id, a.lpj_tgl, a.lpj_nilaispm, a.lpj_uraian, 
                    a.lpj_nomorsp2d, a.lpj_tglsp2d, a.lpj_nilaisp2d, a.created_by,
                    b.dokumen_spp, b.dokumen_spm, b.dokumen_sp2d, b.dokumen_sk, b.dokumen_kuitansi,
                    b.created_date
                    FROM lpj a
                    JOIN dokumen_lpj b ON a.dokumen_id = b.dokumen_id
                    where a.dokumen_id like 'HBL-%' and a.show_item=1
                    and  a.lpj_id ='" . $id . "'";
        return $this->db->query($query)->row();
    }
}
