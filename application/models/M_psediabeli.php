<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_psediabeli extends CI_Model
{
    public function getPsedia()
    {
        $query = "SELECT a.*, sum(b.hrg_total) grand_total FROM psedia_tr a
                    JOIN psedia_trdt b on a.dok_id = b.dok_id
                    where a.show_item=1
                    GROUP BY a.dok_id";
        return $this->db->query($query)->result_array();
    }

    public function getPsediatr($id)
    {
        $query = "SELECT a.dok_id, a.no_bukti, a.tgl_dok, a.tgl_buku, c.nama_brg, c.satuan, b.jml_in, b.hrg_satuan, b.hrg_total,
                    b.akun, b.ket, b.dt_id, c.sskel_brg FROM psedia_tr a
                    JOIN psedia_trdt b ON a.dok_id=b.dok_id
                    JOIN psedia_mstbrg c ON b.sskel_brg=c.sskel_brg
                    where a.show_item=1 and a.dok_id ='" . $id . "'";
        return $this->db->query($query)->result();
    }

    public function getmstbrg()
    {
        $query = $this->db->get('psedia_mstbrg');
        return $query;
    }

    public function kode_psdtr()
    {

        $this->db->select('RIGHT(psedia_tr.tr_id,4) as kode', FALSE);
        $this->db->order_by('tr_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('psedia_tr');      //cek dulu apakah ada sudah ada kode di tabel.    
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
        $kodejadi = "DOK-" . $datenow . $kodemax;    // hasilnya MST-9921-0001 dst.
        return $kodejadi;
    }

    function ins_psediatr($tr)
    {
        $this->db->insert('psedia_tr', $tr);
    }

    function ins_psediatrdt($dt)
    {
        $this->db->insert('psedia_trdt', $dt);
    }

    function ins_psediastok($stok)
    {
        $this->db->insert('psedia_stok_brg', $stok);
    }

    function up_psedia($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function del_psediatr($dokumen_id, $deleted_date, $deleted_by)
    {
        $hsl = $this->db->query("UPDATE psedia_tr SET show_item=3, deleted_date='$deleted_date', deleted_by='$deleted_by' where dok_id = '$dokumen_id'");
        $hsl = $this->db->query("UPDATE psedia_trdt SET show_item=3, deleted_date='$deleted_date' where dok_id = '$dokumen_id'");
        $hsl = $this->db->query("UPDATE psedia_stok_brg SET show_item=3, deleted_date='$deleted_date' where sskel_brg = '$dokumen_id'");
        return $hsl;
    }

    public function getPsediatrId($id)
    {
        $query = "SELECT a.tr_id, a.dok_id, a.no_bukti, a.tgl_dok, a.tgl_buku 
                    FROM psedia_tr a
                    where a.show_item = 1 and
                    a.tr_id ='" . $id . "'";
        return $this->db->query($query)->row();
    }

    public function getPsediatrdtId($id)
    {
        $query = "SELECT a.*,b.* FROM psedia_trdt a
                    JOIN psedia_tr b ON a.dok_id=b.dok_id
                    where a.show_item = 1 and
                    a.dok_id ='" . $id . "'";
        return $this->db->query($query)->row();
    }
}
