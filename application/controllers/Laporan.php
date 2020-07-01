<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }

        $this->load->library('form_validation');
        $this->load->model('Admin_model', 'admin');
    }

    // Laporan Pemasukan
    public function laporanpemasukan()
    {
        $data['title'] = 'Cetak Laporan Pemasukan';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporanpemasukan', $data);
        $this->load->view('templates/footer');
    }

    public function toexcelnow()
    {
        // load excel library
        $this->load->library('excel');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $transaksi = $this->admin->getFilterNow($startdate, $enddate);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nominal');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'BOS');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Lain');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Jumlah');
        // set Row
        $rowCount = 2;
        foreach ($transaksi as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['deskripsi']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['nominal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['bos']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['lain']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['tanggal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list['nominal'] + $list['bos'] + $list['lain']);
            $rowCount++;
        }
        $filename = "Laporan Keuangan " . date("Y-m-d-H-i-s") . ".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function topdfnow()
    {
        $this->load->library('pdf');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $total_nominal = $this->admin->hitungTotalNominalNow($startdate, $enddate);
        $total_bos = $this->admin->hitungTotalBosNow($startdate, $enddate);
        $total_lain = $this->admin->hitungTotalLainNow($startdate, $enddate);
        $total = $total_nominal + $total_bos + $total_lain;

        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PEMASUKAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'SALDO / TOTAL PEMASUKAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 0);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'UANG SEKOLAH', 1, 0);
        $pdf->Cell(50, 6, 'BOS', 1, 0);
        $pdf->Cell(50, 6, 'LAIN-LAIN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->getFilterNow($startdate, $enddate);
        foreach ($transaksi as $row) {
            $transaksi = $row['nominal'];
            $bos = $row['bos'];
            $lain = $row['lain'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($transaksi, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($bos, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($lain, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, $row['tanggal'], 1, 1);
        }
        $pdf->Output();
    }

    public function toexcel()
    {
        // load excel library
        $this->load->library('excel');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $transaksi = $this->admin->getFilter($startdate, $enddate);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nominal');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'BOS');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Lain');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Tanggal');
        // set Row
        $rowCount = 2;
        foreach ($transaksi as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['deskripsi']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['nominal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['bos']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['lain']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['tanggal']);
            $rowCount++;
        }
        $filename = "Laporan Keuangan " . date("Y-m-d-H-i-s") . ".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function topdf()
    {
        $this->load->library('pdf');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $total_nominal = $this->admin->hitungTotalNominal($startdate, $enddate);
        $total_bos = $this->admin->hitungTotalBos($startdate, $enddate);
        $total_lain = $this->admin->hitungTotalLain($startdate, $enddate);
        $total = $total_nominal + $total_bos + $total_lain;

        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PEMASUKAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'SALDO / TOTAL PEMASUKAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 0);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'UANG SEKOLAH', 1, 0);
        $pdf->Cell(50, 6, 'BOS', 1, 0);
        $pdf->Cell(50, 6, 'LAIN-LAIN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->getFilter($startdate, $enddate);
        foreach ($transaksi as $row) {
            $transaksi = $row['nominal'];
            $bos = $row['bos'];
            $lain = $row['lain'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($transaksi, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($bos, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($lain, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, date('d F Y', strtotime(str_replace('/', '-', $row['tanggal']))), 1, 1);
        }
        $pdf->Output();
    }
    // Akhir Laporan Pemasukan

    // Laporan Pengeluaran
    public function laporanpengeluaran()
    {
        $data['title'] = 'Cetak Laporan Pengeluaran';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporanpengeluaran', $data);
        $this->load->view('templates/footer');
    }

    public function toexcelnow2()
    {
        // load excel library
        $this->load->library('excel');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $transaksi = $this->admin->outFilterNow($startdate, $enddate);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'BOS');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'BRS');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Lain');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Jumlah');
        // set Row
        $rowCount = 2;
        foreach ($transaksi as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['deskripsi']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['bos']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['brs']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['lain']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['tanggal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list['bos'] + $list['brs'] + $list['lain']);
            $rowCount++;
        }
        $filename = "Laporan Keuangan Pengeluaran" . date("Y-m-d-H-i-s") . ".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function topdfnow2()
    {
        $this->load->library('pdf');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $total_bos = $this->admin->outTotalBosNow($startdate, $enddate);
        $total_brs = $this->admin->outTotalBrsNow($startdate, $enddate);
        $total_lain = $this->admin->outTotalLainNow($startdate, $enddate);
        $total = $total_bos + $total_brs + $total_lain;

        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PENGELUARAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'TOTAL PENGELUARAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 0);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'BOS', 1, 0);
        $pdf->Cell(50, 6, 'BRS', 1, 0);
        $pdf->Cell(50, 6, 'LAIN-LAIN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->outFilterNow($startdate, $enddate);
        foreach ($transaksi as $row) {
            $bos = $row['bos'];
            $brs = $row['brs'];
            $lain = $row['lain'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($bos, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($brs, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($lain, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, $row['tanggal'], 1, 1);
        }
        $pdf->Output();
    }

    public function toexcel2()
    {
        // load excel library
        $this->load->library('excel');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $transaksi = $this->admin->outFilter($startdate, $enddate);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'BOS');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'BRS');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Lain');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Tanggal');
        // set Row
        $rowCount = 2;
        foreach ($transaksi as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['deskripsi']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['bos']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['brs']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['lain']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['tanggal']);
            $rowCount++;
        }
        $filename = "Laporan Keuangan Pengeluaran" . date("Y-m-d-H-i-s") . ".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function topdf2()
    {
        $this->load->library('pdf');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $total_bos = $this->admin->outTotalBos($startdate, $enddate);
        $total_brs = $this->admin->outTotalBrs($startdate, $enddate);
        $total_lain = $this->admin->outTotalLain($startdate, $enddate);
        $total = $total_bos + $total_brs + $total_lain;

        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PENGELUARAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'TOTAL PENGELUARAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 0);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'BOS', 1, 0);
        $pdf->Cell(50, 6, 'BRS', 1, 0);
        $pdf->Cell(50, 6, 'LAIN-LAIN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->outFilter($startdate, $enddate);
        foreach ($transaksi as $row) {
            $bos = $row['bos'];
            $brs = $row['brs'];
            $lain = $row['lain'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($bos, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($brs, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($lain, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, $row['tanggal'], 1, 1);
        }
        $pdf->Output();
    }
    // Akhir Laporan Pengeluaran

    // Laporan Peminjaman
    public function laporanpeminjaman()
    {
        $data['title'] = 'Cetak Laporan Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporanpeminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function toexcelnow3()
    {
        // load excel library
        $this->load->library('excel');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $transaksi = $this->admin->debtFilterNow($startdate, $enddate);
        $nominal = $this->admin->debtTotalNow($startdate, $enddate);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nominal');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Pihak');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Keterangan');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Jumlah');
        // set Row
        $rowCount = 2;
        foreach ($transaksi as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['deskripsi']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['nominal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['pihak']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['keterangan']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['tanggal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $nominal);
            $rowCount++;
        }
        $filename = "Laporan Keuangan Peminjaman" . date("Y-m-d-H-i-s") . ".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function topdfnow3()
    {
        $this->load->library('pdf');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $total = $this->admin->debtTotalNow($startdate, $enddate);

        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PEMINJAMAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'TOTAL PEMINJAMAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 0);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'NOMINAL', 1, 0);
        $pdf->Cell(50, 6, 'PIHAK', 1, 0);
        $pdf->Cell(50, 6, 'KETERANGAN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->debtFilterNow($startdate, $enddate);
        foreach ($transaksi as $row) {
            $nominal = $row['nominal'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($nominal, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, $row['pihak'], 1, 0);
            $pdf->Cell(50, 6, $row['keterangan'], 1, 0);
            $pdf->Cell(50, 6, $row['tanggal'], 1, 1);
        }
        $pdf->Output();
    }


    public function toexcel3()
    {
        // load excel library
        $this->load->library('excel');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $transaksi = $this->admin->debtFilter($startdate, $enddate);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nominal');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Pihak');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Keterangan');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Tanggal');
        // set Row
        $rowCount = 2;
        foreach ($transaksi as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['deskripsi']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['nominal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['pihak']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['keterangan']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['tanggal']);
            $rowCount++;
        }
        $filename = "Laporan Keuangan Peminjaman" . date("Y-m-d-H-i-s") . ".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function topdf3()
    {
        $this->load->library('pdf');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $total = $this->admin->debtTotal($startdate, $enddate);

        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PEMINJAMAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'TOTAL PEMINJAMAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 0);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'NOMINAL', 1, 0);
        $pdf->Cell(50, 6, 'PIHAK', 1, 0);
        $pdf->Cell(50, 6, 'KETERANGAN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->debtFilter($startdate, $enddate);
        foreach ($transaksi as $row) {
            $nominal = $row['nominal'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($nominal, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, $row['pihak'], 1, 0);
            $pdf->Cell(50, 6, $row['keterangan'], 1, 0);
            $pdf->Cell(50, 6, $row['tanggal'], 1, 1);
        }
        $pdf->Output();
    }

    public function laporanbulanan()
    {
        $data['title'] = 'Cetak Semua Laporan';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporanbulanan', $data);
        $this->load->view('templates/footer');
    }

    public function topdfMonth()
    {
        $this->load->library('pdf');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $total_nominal = $this->admin->hitungTotalNominal($startdate, $enddate);
        $total_bos = $this->admin->hitungTotalBos($startdate, $enddate);
        $total_lain = $this->admin->hitungTotalLain($startdate, $enddate);
        $total_pemasukan = $total_nominal + $total_bos + $total_lain;
        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Image('assets/img/smp.jpg', 10, 5, 30, 30);
        $pdf->Image('assets/img/pgri.jpg', 250, 7, 30, 25);
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 7, 'LAPORAN KEUANGAN', 0, 1, 'C');
        $pdf->Cell(0, 7, 'PER TANGGAL : ' . date('d F Y', strtotime(str_replace('/', '-', $startdate))) . ' s/d ' . date('d F Y', strtotime(str_replace('/', '-', $enddate))), 0, 1, 'C');
        $pdf->Cell(0, 7, '__________________________________________________________________________________________________', 0, 1);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PEMASUKAN', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'UANG SEKOLAH', 1, 0);
        $pdf->Cell(50, 6, 'BOS', 1, 0);
        $pdf->Cell(50, 6, 'LAIN-LAIN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->getFilter($startdate, $enddate);
        foreach ($transaksi as $row) {
            $transaksi = $row['nominal'];
            $bos = $row['bos'];
            $lain = $row['lain'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($transaksi, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($bos, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($lain, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, date('d F Y', strtotime(str_replace('/', '-', $row['tanggal']))), 1, 1);
        }
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'SALDO / TOTAL PEMASUKAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total_pemasukan, 0, ',', '.'), 1, 1);

        $total_bos = $this->admin->outTotalBos($startdate, $enddate);
        $total_brs = $this->admin->outTotalBrs($startdate, $enddate);
        $total_lain = $this->admin->outTotalLain($startdate, $enddate);
        $total_pengeluaran = $total_bos + $total_brs + $total_lain;
        $pdf->Cell(0, 20, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PENGELUARAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'BOS', 1, 0);
        $pdf->Cell(50, 6, 'BRS', 1, 0);
        $pdf->Cell(50, 6, 'LAIN-LAIN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->outFilter($startdate, $enddate);
        foreach ($transaksi as $row) {
            $bos = $row['bos'];
            $brs = $row['brs'];
            $lain = $row['lain'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($bos, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($brs, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($lain, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, date('d F Y', strtotime(str_replace('/', '-', $row['tanggal']))), 1, 1);
        }
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'TOTAL PENGELUARAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total_pengeluaran, 0, ',', '.'), 1, 1);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(70, 20, 'SISA SALDO:', 2, 0);
        $saldo = $total_pemasukan - $total_pengeluaran;
        $pdf->Cell(50, 20, 'Rp. ' . number_format($saldo, 0, ',', '.'), 2, 1);

        // Peminjaman
        $total = $this->admin->debtTotal($startdate, $enddate);
        $pdf->Cell(0, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PEMINJAMAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'NOMINAL', 1, 0);
        $pdf->Cell(50, 6, 'PIHAK', 1, 0);
        $pdf->Cell(50, 6, 'KETERANGAN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->debtFilter($startdate, $enddate);
        foreach ($transaksi as $row) {
            $nominal = $row['nominal'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($nominal, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, $row['pihak'], 1, 0);
            $pdf->Cell(50, 6, $row['keterangan'], 1, 0);
            $pdf->Cell(50, 6, date('d F Y', strtotime(str_replace('/', '-', $row['tanggal']))), 1, 1);
        }
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'TOTAL PEMINJAMAN :', 1, 0);
        $pdf->Cell(50, 7, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 1);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(70, 20, 'SISA SALDO:', 2, 0);
        $sisa_saldo = $saldo + $total;
        $pdf->Cell(50, 20, 'Rp. ' . number_format($sisa_saldo, 0, ',', '.'), 2, 1);
        $pdf->Output();
    }

    public function laporanbulanan1()
    {
        $data['title'] = 'Cetak Semua Laporan';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function topdfAll()
    {
        $this->load->library('pdf');
        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $total_nominal = $this->admin->hitungTotalNominal($startdate, $enddate);
        $total_bos = $this->admin->hitungTotalBos($startdate, $enddate);
        $total_lain = $this->admin->hitungTotalLain($startdate, $enddate);
        $total_pemasukan = $total_nominal + $total_bos + $total_lain;
        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Image('assets/img/smp.jpg', 10, 5, 30, 30);
        $pdf->Image('assets/img/pgri.jpg', 250, 7, 30, 25);
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 7, 'LAPORAN KEUANGAN', 0, 1, 'C');
        $pdf->Cell(0, 7, 'PER TANGGAL : ' . date('d F Y', strtotime(str_replace('/', '-', $startdate))) . ' s/d ' . date('d F Y', strtotime(str_replace('/', '-', $enddate))), 0, 1, 'C');
        $pdf->Cell(0, 7, '__________________________________________________________________________________________________', 0, 1);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PEMASUKAN', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        // pemasukan
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(135, 6, 'KATEGORI', 1, 0);
        $pdf->Cell(135, 6, 'NOMINAL / TOTAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->kategori_pemasukan($startdate, $enddate);

        $pdf->Cell(135, 6, 'SPP', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->spp, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Sarpras', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->sarpras, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Tunggakan', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->tunggakan, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'OSIS', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->osis, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'SAT', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->sat, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Semesteran', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->semesteran, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Ujian Nasional', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->ujian_nasional, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Lain - lain', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->lain_lain, 0, ',', '.'), 1, 1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(135, 7, 'SALDO / TOTAL PEMASUKAN :', 1, 0);
        $pdf->Cell(135, 7, 'Rp. ' . number_format($total_pemasukan, 0, ',', '.'), 1, 1);
        // akhir pemasukan

        // pengeluaran
        $total_bos = $this->admin->outTotalBos($startdate, $enddate);
        $total_brs = $this->admin->outTotalBrs($startdate, $enddate);
        $total_lain = $this->admin->outTotalLain($startdate, $enddate);
        $total_pengeluaran = $total_bos + $total_brs + $total_lain;
        $pdf->Cell(0, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PENGELUARAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(135, 6, 'KATEGORI', 1, 0);
        $pdf->Cell(135, 6, 'NOMINAL / TOTAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->kategori_pengeluaran($startdate, $enddate);

        $pdf->Cell(135, 6, 'SARPRAS', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->sarpras, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'BELANJA HARIAN', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->belanja_harian, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'TAL', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->tal, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'GAJI', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->gaji, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'AIR', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->air, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Insentif Pengawas', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->insentif_pengawas, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Iuran RT', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->iuran_rt, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'OSIS', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->osis, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Iuran Sampah', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->iuran_sampah, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Bulanan', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->bulanan, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Pengelolaan Website', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->pengelolaan_website, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Service AC dan lainnya', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->servic, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'ATK', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->atk, 0, ',', '.'), 1, 1);
        $pdf->Cell(135, 6, 'Lain-lain', 1, 0);
        $pdf->Cell(135, 6, 'Rp. ' . number_format($transaksi->lain_lain, 0, ',', '.'), 1, 1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(135, 7, 'TOTAL PENGELUARAN :', 1, 0);
        $pdf->Cell(135, 7, 'Rp. ' . number_format($total_pengeluaran, 0, ',', '.'), 1, 1);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(70, 20, 'SISA SALDO:', 2, 0);
        $saldo = $total_pemasukan - $total_pengeluaran;
        $pdf->Cell(50, 20, 'Rp. ' . number_format($saldo, 0, ',', '.'), 2, 1);
        // akhir pengeluaran

        // Peminjaman
        $total = $this->admin->debtTotal($startdate, $enddate);
        $pdf->Cell(0, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN PEMINJAMAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 6, 'DESKRIPSI', 1, 0);
        $pdf->Cell(50, 6, 'NOMINAL', 1, 0);
        $pdf->Cell(50, 6, 'PIHAK', 1, 0);
        $pdf->Cell(50, 6, 'KETERANGAN', 1, 0);
        $pdf->Cell(50, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $transaksi = $this->admin->debtFilter($startdate, $enddate);
        foreach ($transaksi as $row) {
            $nominal = $row['nominal'];
            $pdf->Cell(70, 6, $row['deskripsi'], 1, 0);
            $pdf->Cell(50, 6, 'Rp. ' . number_format($nominal, 0, ',', '.'), 1, 0);
            $pdf->Cell(50, 6, $row['pihak'], 1, 0);
            $pdf->Cell(50, 6, $row['keterangan'], 1, 0);
            $pdf->Cell(50, 6, date('d F Y', strtotime(str_replace('/', '-', $row['tanggal']))), 1, 1);
        }
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(70, 7, 'TOTAL PEMINJAMAN :', 1, 0);
        $pdf->Cell(200, 7, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 1);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(70, 20, 'SISA SALDO:', 2, 0);
        $sisa_saldo = $saldo + $total;
        $pdf->Cell(50, 20, 'Rp. ' . number_format($sisa_saldo, 0, ',', '.'), 2, 1);
        $pdf->Output();
    }
}

/* End of file Laporan.php */
