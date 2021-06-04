<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_spptup extends CI_Model
{
    public function getSpptup($id)
    {
        $query = "SELECT 	a.spp_id,
                            a.spp_no,
                            a.spp_tgl,
                            a.spp_nilai,
                            a.spp_dok_id,
                            a.tgl_pengajuan,
                            b.dok_nominatif, 
                            b.dok_spp,
                            b.dok_sk,
                            b.dok_ssp,
                            b.dok_pengadaan,
                            b.dok_karwas,
                            b.dok_persetujuan,
                            b.dok_dpp,
                            b.dok_drpp,
                            b.dok_sptb,
                            a.created_date,
                            a.created_by
                    FROM spp a
                    JOIN dokumen_spp b ON a.spp_dok_id = b.spp_dok_id
                    WHERE a.spp_id = '" . $id . "' 
                    ORDER BY a.spp_id";
        return $this->db->query($query)->row();
    }

    public function getspptupBy($user)
    {
        $query = "SELECT 	a.spp_id,
                            a.spp_no,
                            a.spp_tgl,
                            a.spp_nilai,
                            a.spp_dok_id,
                            a.tgl_pengajuan,
                            a.created_date,
                            a.created_by
                    FROM spp a
                    WHERE a.spp_dok_id LIKE 'SPPT-%' 
                    and a.created_by = '" . $user . "' and a.show_item='1'
                    ORDER BY a.spp_id";
        return $this->db->query($query)->result_array();
    }

    public function kode_spptup()
    {

        $this->db->select('RIGHT(spp.spp_id,4) as kode', FALSE);
        $this->db->order_by('spp_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('spp');      //cek dulu apakah ada sudah ada kode di tabel.    
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
        $kodejadi = "SPPT-" . $datenow . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    function ins_spptup($data)
    {
        $this->db->insert('dokumen_spp', $data);
    }

    function up_spptup($data, $id)
    {
        $this->db->update('dokumen_spp', $data, array('spp_dok_id' => $id));
    }

    function hapus_spptup($dokumen_id, $deleted_date, $deleted_by)
    {
        $hsl = $this->db->query("UPDATE spp SET show_item=3, deleted_date='$deleted_date', deleted_by='$deleted_by' where spp_dok_id = '$dokumen_id'");
        $hsl = $this->db->query("UPDATE dokumen_spp SET show_item=3, deleted_date='$deleted_date' where spp_dok_id = '$dokumen_id'");
        return $hsl;
    }
}
