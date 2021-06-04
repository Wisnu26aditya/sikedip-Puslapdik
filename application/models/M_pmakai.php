<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pmakai extends CI_Model
{
    public function getPemakai()
    {
        $query = "SELECT 	
                        a.dok_id, a.hrg_satuan, a.hrg_total, a.ket,
                        a.jml_out, a.status, b.nama_brg, b.satuan
                        FROM psedia_pkdt a
                        JOIN psedia_mstbrg b ON a.sskel_brg = b.sskel_brg
                    WHERE a.show_item=1";
        return $this->db->query($query)->result_array();
    }

    public function kode_pmakai()
    {

        $this->db->select('RIGHT(psedia_pkdt.dt_id,4) as kode', FALSE);
        $this->db->order_by('dt_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('psedia_pkdt');      //cek dulu apakah ada sudah ada kode di tabel.    
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
        $kodejadi = "PEM-" . $datenow . $kodemax;    // hasilnya MST-9921-0001 dst.
        return $kodejadi;
    }

    function ins_pmakai($data)
    {
        $this->db->insert('psedia_pkdt', $data);
    }

    function acc_pkdt($dok_id, $sskel_brg, $update_date, $update_by)
    {
        $hsl = $this->db->query("UPDATE psedia_pkdt SET status=2, updated_date='$update_date', updated_by='$update_by' where dok_id = '$dok_id' and sskel_brg = '$sskel_brg'");
        return $hsl;
    }
    function acc_stok_brg($sskel_brg, $jml_out, $update_date, $update_by)
    {
        $hsl = $this->db->query("UPDATE psedia_stok_brg SET jml_out='$jml_out', updated_date='$update_date', updated_by='$update_by' where sskel_brg = '$sskel_brg'");
        return $hsl;
    }

    public function getPemakaiId($id2)
    {

        $query = "SELECT 	
                        a.dok_id, a.no_bukti, a.tgl_dok, a.tgl_buku, 
                        b.hrg_satuan, b.hrg_total, b.akun, b.ket,
                        c.kode_brg, c.nama_brg, c.satuan, c.sskel_brg,
                        d.ms_deptnama,
                        e.jml_in - e.jml_out saldo_awal
                        FROM psedia_tr a
                    JOIN psedia_trdt b ON a.dok_id = b.dok_id
                    JOIN psedia_mstbrg c ON b.sskel_brg = c.sskel_brg
                    JOIN ms_dept d ON c.dept_id = d.ms_deptid
                    JOIN psedia_stok_brg e ON b.sskel_brg = e.sskel_brg
                    WHERE c.nama_brg like '%" . $id2 . "%' 
                    AND a.show_item=1 
                    AND b.show_item=1 
                    AND c.show_item=1 
                    AND d.show_item=1 
                    AND e.show_item=1 
                    limit 0,10";
        return $this->db->query($query)->result();
    }

    public function getDataPakaiId($id)
    {
        $query = "SELECT 	
                        a.dok_id, a.hrg_satuan, a.hrg_total, a.ket,
                        a.jml_out, a.status, b.sskel_brg, b.nama_brg, b.satuan
                        FROM psedia_pkdt a
                        JOIN psedia_mstbrg b ON a.sskel_brg = b.sskel_brg
                    WHERE   a.dok_id = '" . $id . "' 
                            and a.show_item=1";
        return $this->db->query($query)->row();
    }
}
