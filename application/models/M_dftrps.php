<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dftrps extends CI_Model
{
    function simpan_vicon($awal, $akhir, $tgl, $rapat, $jam1, $jam2, $meetnum, $pic, $meetpass, $url)
    {
        $hsl = $this->db->query("INSERT INTO list_vicon(kunci_awal,kunci_akhir,created_date,jam_awal,jam_akhir,kunci_namarapat,kunci_pj,kunci_link,meeting_number,meeting_password) 
        VALUES ('$awal','$akhir','$tgl','$jam1','$jam2','$rapat','$pic','$url','$meetnum','$meetpass')");
        return $hsl;
    }

    public function getDataPeserta($vicon)
    {
        $query = "SELECT 	a.data_nama,
                            a.data_nip,
                            a.data_uker,
                            a.data_gol,
                            a.data_instansi,
                            a.data_tlp,
                            a.data_email,
                            a.data_npwp,
                            a.data_norek,
                            a.data_namarek,
                            a.data_namabank,
                            a.ttd,
                            a.kunci_id,
                            b.kunci_namarapat
                    FROM data_peserta a
                    JOIN list_vicon b ON a.kunci_id = b.kunci_id
                    where a.kunci_id ='" . $vicon . "'";
        return $this->db->query($query)->result();
    }

    public function getdatavicon($vicon)
    {
        $query = "SELECT 	a.kunci_id,
                            a.kunci_namarapat,
                            a.created_date
                    FROM list_vicon a
                    WHERE a.kunci_id='" . $vicon . "'";
        return $this->db->query($query)->result();
    }

    public function getVicon()
    {
        $query = $this->db->get('list_vicon');
        return $query;
    }
}
