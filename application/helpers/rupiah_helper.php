<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        $hasil_rupiah = number_format($angka, 0, ',', '.');
        //$kode_rupiah = 'Rp. ' . $hasil_rupiah;
        return $hasil_rupiah;
    }
}
