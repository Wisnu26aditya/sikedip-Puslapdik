<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_psedia extends CI_Model
{
    public function getPsedia()
    {
        $query = "SELECT a.*, b.ur_sskel, c.ms_deptnama FROM psedia_mstbrg a
                    JOIN psedia_kodesskel b ON a.sskel_brg = b.kd_brg
                    JOIN ms_dept c ON a.dept_id = c.ms_deptid";
        return $this->db->query($query)->result_array();
    }

    public function getStok()
    {
        $query = "SELECT 	
                            a.stok_id,
                            a.sskel_brg,
                            a.jml_in,
                            a.jml_out,
                            a.show_item,
                            b.nama_brg,
                            b.satuan,
                            c.ms_deptnama
                    FROM psedia_stok_brg a
                    JOIN psedia_mstbrg b ON a.sskel_brg = b.sskel_brg
                    JOIN ms_dept c ON b.dept_id = c.ms_deptid";
        return $this->db->query($query)->result_array();
    }

    public function getsskel()
    {
        $query = $this->db->get('psedia_kodesskel');
        return $query;
    }

    public function getdept()
    {
        $query = $this->db->get('ms_dept');
        return $query;
    }

    public function kode_psd()
    {

        $this->db->select('RIGHT(psedia_mstbrg.kode_id,4) as kode', FALSE);
        $this->db->order_by('kode_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('psedia_mstbrg');      //cek dulu apakah ada sudah ada kode di tabel.    
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
        $kodejadi = "MST-" . $datenow . $kodemax;    // hasilnya MST-9921-0001 dst.
        return $kodejadi;
    }

    function ins_psedia($data)
    {
        $this->db->insert('psedia_mstbrg', $data);
    }
    function up_psedia($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapus_psedia($dokumen_id, $deleted_date, $deleted_by)
    {
        $hsl = $this->db->query("UPDATE lpj SET show_item=3, deleted_date='$deleted_date', deleted_by='$deleted_by' where dokumen_id = '$dokumen_id'");
        $hsl = $this->db->query("UPDATE dokumen_lpj SET show_item=3, deleted_date='$deleted_date' where dokumen_id = '$dokumen_id'");
        return $hsl;
    }

    public function getPsediaId($id)
    {
        $query = "SELECT a.kode_id, a.sskel_brg, a.kode_brg, a.nama_brg, a.satuan, b.ms_deptnama 
                    FROM psedia_mstbrg a
                    JOIN ms_dept b ON a.dept_id = b.ms_deptid
                    where a.show_item = 1 and
                    a.kode_id ='" . $id . "'";
        return $this->db->query($query)->row();
    }

    public function getMstBrgId($id)
    {

        $query = "SELECT a.kd_brg, a.ur_sskel 
                    FROM psedia_kodesskel a
                    where a.ur_sskel like '%" . $id . "%'
                    limit 0,10";
        return $this->db->query($query)->result();
    }
}
