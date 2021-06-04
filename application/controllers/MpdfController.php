<?php

use Fpdf\Fpdf;
use Mpdf\Mpdf;

defined('BASEPATH') or exit('No direct script access allowed');

class MpdfController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dftrps');
    }

    public function Report_vicon()
    {
        // $tanggal = date('d-m-Y');
        $this->load->model('m_dftrps', 'daftar');
        $vicon = $_GET['id'];
        $namavicon = $_GET['name'];
        // $datapeserta = $this->db->get_where('data_peserta', ['kunci_id' => '3']);
        $pdf = new FPDF('L', 'mm', 'A4'); //L = lanscape P= potrait
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        $ya = 44;
        // mencetak string 
        $datavicon = $this->daftar->getdatavicon($vicon);
        $pdf->Cell(50, 8, 'Rekap Daftar Hadir Video Conference Puslapdik', 0, 1, 'L');
        $pdf->Cell(100, 8, $namavicon, 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 8, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 8, 'No.', 1, 0, 'C');
        $pdf->Cell(40, 8, 'Nama', 1, 0, 'C');
        $pdf->Cell(40, 8, 'Nip/Nik', 1, 0, 'C');
        $pdf->Cell(50, 8, 'Instansi', 1, 0, 'C');
        $pdf->Cell(30, 8, 'Npwp', 1, 0, 'C');
        $pdf->Cell(40, 8, 'Golongan', 1, 0, 'C');
        $pdf->Cell(35, 8, 'No. Hp', 1, 0, 'C');
        $pdf->Cell(30, 8, 'ttd', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 8);
        // $data = $this->db->get_where('data_peserta', ['kunci_id' => $vicon])->result();
        $data = $this->daftar->getDataPeserta($vicon);
        $asalurl = "http://" . $_SERVER['HTTP_HOST'] . "/absenvicon/";
        $i = 1;
        foreach ($data as $row) {
            $ttd = $row->ttd;
            $gabungan = $asalurl . $ttd;
            $gambar = $pdf->Image($gabungan, $pdf->GetX() + 260, $pdf->GetY(), 6, 8);
            // $pdf->Ln();
            $pdf->Cell(10, 8, $i++, 1, 0);
            $pdf->Cell(40, 8, $row->data_nama, 1, 0);
            $pdf->Cell(40, 8, $row->data_nip, 1, 0);
            $pdf->Cell(50, 8, $row->data_instansi, 1, 0);
            $pdf->Cell(30, 8, $row->data_npwp, 1, 0);
            $pdf->Cell(40, 8, $row->data_gol, 1, 0);
            $pdf->Cell(35, 8, $row->data_tlp, 1, 0);
            // $pdf->Image($gabungan, $pdf->GetX() + 165, $pdf->GetY(), 5, 10);
            $pdf->Cell(30, 8, $gambar,  1, 1, 'C');
        }
        $pdf->Output();
    }

    // private function datarow($mpdf, $no, $datap)
    // {
    //     $asalurl = "http://" . $_SERVER['HTTP_HOST'] . "/absenvicon/";
    //     $data_ttd = $datap['ttd'];

    //     $mpdf->Cell(10, 10, $no, 1, 0, 'C');
    //     $mpdf->Cell(60, 10, $datap['data_nama'], 1, 0, 'L');
    //     $mpdf->Cell(45, 10, $datap['data_nip'], 1, 0, 'L');
    //     $mpdf->Cell(55, 10, $datap['data_instansi'], 1, 0, 'L');
    //     $mpdf->Cell(35, 10, $datap['data_tlp'], 1, 0, 'L');
    //     $mpdf->Cell(55, 10, $mpdf->Image('<img src=' . $asalurl . $data_ttd . ' width=40 height=60/>', 0, 0, 40, 60, 'png', '', true, false), 1, 1, 'L');
    //     // $mpdf->Cell(50, 10, $show_ttd, 1, 1, 'L');
    //     // $mpdf->Image('files/images/frontcover.jpg', 0, 0, 210, 297, 'jpg', '', true, false);
    // }
}
