<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_vicon extends CI_Model
{
    function simpan_vicon($awal, $akhir,$tgl, $rapat, $jam1, $jam2, $meetnum, $pic, $meetpass, $url)
    {
        $hsl = $this->db->query("INSERT INTO list_vicon(kunci_awal,kunci_akhir,created_date,jam_awal,jam_akhir,kunci_namarapat,kunci_pj,kunci_link,meeting_number,meeting_password) 
        VALUES ('$awal','$akhir','$tgl','$jam1','$jam2','$rapat','$pic','$url','$meetnum','$meetpass')");
        return $hsl;
    }

    public function getviconid($id)
    {
        $query = "SELECT 
                         a.kunci_namarapat,
                         a.kunci_awal,
                         a.kunci_akhir,
                         a.jam_awal,
                         a.jam_akhir,
                         a.meeting_number,
                         a.meeting_password,
                         a.kunci_pj,
                         a.kunci_link
                    from list_vicon a where a.kunci_id = '".$id."'";
        return $this->db->query($query)->row();
    }
}
