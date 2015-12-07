<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Sales_model');
        $this->load->model('Barang_model');
        $this->load->model('Lokasi_model');
        $this->load->model('Laporan_model');
        $this->load->library('cart');
//        $this->load->library('session');
//        $this->load->helper('file');
//        $this->load->library('ftp');
        $this->load->helper('url');
    }

    public function Harian() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }

        $awal = "";
        $akhir = "";
        $data['username'] = $this->session->userdata('Username');

        if ($this->input->post('btn_pilih')) {
            $awal = $this->input->post('tanggal_awal');
            $akhir = $this->input->post('tanggal_akhir');
        }
        if ($this->session->userdata("Level") == 0) {
            $data["cabangs"] = $this->Admin_model->get_all_cabang();
        }
        $data['laporans'] = $this->Laporan_model->select_laporan();
        if ($this->input->post("btn_pilih")) {
            if ($awal != "" && $akhir != "") {
                $data['laporans'] = $this->Laporan_model->select_laporan_periode($awal, $akhir);
            } else {
                $data['laporans'] = $this->Laporan_model->select_laporan();
            }
        }
        if ($this->input->post("btn_export")) {
            $this->cetak_excel();
        }

        if ($this->input->post('logout')) {
            $this->session->unset_userdata('Username');
            redirect('welcome/index');
        }

        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_pencarian', $data);
//        $this->load->view('v_foot');
    }

    public function Harian_Periode($awal, $akhir) {
//            $data['username'] = $this->session->userdata('Username');
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');

            $data['laporans'] = $this->Laporan_model->select_laporan();
        } else {
            redirect('welcome/index');
        }

        if ($this->input->post('logout')) {
            $this->session->unset_userdata('Username');
            redirect('welcome/index');
        }

        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_pencarian', $data);
//        $this->load->view('v_foot');
    }

    /* DANIEL */

    public function history_gaji() {

        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        $awal = "";
        $akhir = "";

        if ($this->input->post('btn_pilih')) {
            $awal = $this->input->post('tanggal_awal');
            $akhir = $this->input->post('tanggal_akhir');
        }

        if ($awal == "" && $akhir == "") {
            $data['laporans'] = $this->Laporan_model->select_laporan();
        } else {
            $data['laporans'] = $this->Laporan_model->select_laporan_periode($awal, $akhir);
        }

        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_pencarian_sales', $data);
    }

    public function penjualan() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        $awal = "";
        $akhir = "";

        $data['datasales'] = $this->Sales_model->get_sales_tiap_admin($data['username']);
        $data['barangs'] = $this->Barang_model->get_all_barang();
        $arrIDSales = array();
        foreach ($data['datasales'] as $sales) {
            array_push($arrIDSales, $sales->id_sales);
        }

        if ($this->input->post('btn_pilih')) {
            $awal = $this->input->post('tanggal_awal');
            $akhir = $this->input->post('tanggal_akhir');
        }
        $data['selectBarang'] = $this->input->post('filterBarang');
        $data['selectSeles'] = $this->input->post('filter');
        
        if ($this->session->userdata("Level") == 0) {
            $data["cabangs"] = $this->Admin_model->get_all_cabang();
        }

        if ($awal == "" && $akhir == "") {
            $data['datapenjualan'] = $this->Sales_model->get_penjualan($arrIDSales);
        } else {
            $data['datapenjualan'] = $this->Sales_model->get_penjualan($arrIDSales, $awal, $akhir);
        }

        if ($this->input->post("btn_export")) {
            $this->cetak_penjualan_sales();
        }

        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_penjualan_spg', $data);
    }

    /* Daniel */

    public function TopBarang() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }

        $data['topbarangs'] = $this->Barang_model->select_top_barang();
        $data['admincabang'] = $this->Barang_model->get_all_admincabang();
        //print_r($data['admincabang']);exit;
        $data['data'] = "BULAN INI";
        if ($this->input->post('submit')) {
            if ($this->input->post('kategori') == 'Periode') {
                $awal = $this->input->post('tanggal_awal');
                $akhir = $this->input->post('tanggal_akhir');
                $data['topbarangs'] = $this->Barang_model->select_top_barang($awal, $akhir);
                $data['data'] = "Periode $awal sampai $akhir";
            } else {
                $BulanIndo = array("Januari", "Februari", "Maret",
                    "April", "Mei", "Juni",
                    "Juli", "Agustus", "September",
                    "Oktober", "November", "Desember");
                $data['topbarangs'] = $this->Barang_model->select_top_barang(false, false, $this->input->post('monthly'));
                $data['data'] = "Periode Bulan " . $BulanIndo[(int) $this->input->post('monthly') - 1];
            }
        }

        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_top_barang', $data);
    }

    public function TopLokasi() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }

        if ($this->session->userdata("Level") == 0) {
            $data["cabangs"] = $this->Admin_model->get_all_cabang();
        }
        $data['topbarangs'] = $this->Barang_model->select_top_lokasi();
        $data['barangs'] = $this->Barang_model->get_barang();
        $data['data'] = "BULAN INI";
        $IDLokasi = array();
        foreach ($data['topbarangs'] as $lokasi) {
            array_push($IDLokasi, $lokasi->IDLokasi);
        }
//        if (count($IDLokasi) > 0) {
        $data['modalbarang'] = $this->Barang_model->select_top_lokasi_barang($IDLokasi);
//        }
        if ($this->input->post('submit')) {
            if ($this->input->post('kategori') == 'Periode') {
                $awal = $this->input->post('tanggal_awal');
                $akhir = $this->input->post('tanggal_akhir');
                $data['topbarangs'] = $this->Barang_model->select_top_lokasi($awal, $akhir);
                $data['data'] = "Periode $awal sampai $akhir";
                foreach ($data['topbarangs'] as $lokasi) {
                    array_push($IDLokasi, $lokasi->IDLokasi);
                }
                if (count($IDLokasi) > 0) {
                    $data['modalbarang'] = $this->Barang_model->select_top_lokasi_barang($IDLokasi, $awal, $akhir);
                }
            } else {
                $BulanIndo = array("Januari", "Februari", "Maret",
                    "April", "Mei", "Juni",
                    "Juli", "Agustus", "September",
                    "Oktober", "November", "Desember");
                $data['topbarangs'] = $this->Barang_model->select_top_lokasi(false, false, $this->input->post('monthly'));
                $data['data'] = "Periode Bulan " . $BulanIndo[(int) $this->input->post('monthly') - 1];
                foreach ($data['topbarangs'] as $lokasi) {
                    array_push($IDLokasi, $lokasi->IDLokasi);
                }
                if (count($IDLokasi) > 0) {
                    $data['modalbarang'] = $this->Barang_model->select_top_lokasi_barang($IDLokasi, false, false, $this->input->post('monthly'));
                }
            }
        }

        /* load data modal */

        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_top_lokasi', $data);
    }

    public function TopSales() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        if ($this->session->userdata("Level") == 0) {
            $data["cabangs"] = $this->Admin_model->get_all_cabang();
        }
        
        $data['barangs'] = $this->Barang_model->get_barang();
        $data['topbarangs'] = $this->Barang_model->select_top_seles();
        $IDSales = array();
        foreach ($data['topbarangs'] as $lokasi) {
            array_push($IDSales, $lokasi->IDSales);
        }
        $data['data'] = "BULAN INI";
        $data['modalsales'] = $this->Barang_model->select_top_sales_barang($IDSales);
        if ($this->input->post('submit')) {
            if ($this->input->post('kategori') == 'Periode') {
                $awal = $this->input->post('tanggal_awal');
                $akhir = $this->input->post('tanggal_akhir');
                $data['topbarangs'] = $this->Barang_model->select_top_seles($awal, $akhir);
                $data['data'] = "Periode $awal sampai $akhir";
                if (count($IDSales) > 0) {
                    $data['modalsales'] = $this->Barang_model->select_top_sales_barang($IDSales, $awal, $akhir);
                }
            } else {
                $BulanIndo = array("Januari", "Februari", "Maret",
                    "April", "Mei", "Juni",
                    "Juli", "Agustus", "September",
                    "Oktober", "November", "Desember");
                $data['topbarangs'] = $this->Barang_model->select_top_seles(false, false, $this->input->post('monthly'));
                $data['data'] = "Periode Bulan " . $BulanIndo[(int) $this->input->post('monthly') - 1];
                if (count($IDSales) > 0) {
                    $data['modalsales'] = $this->Barang_model->select_top_sales_barang($IDSales, false, false, $this->input->post('monthly'));
                }
            }
//            print_r(($data["modalsales"]));exit;
        }
        
        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_top_sales', $data);
    }

    /* Daniel End */

    function cetak_excel() {
        $awal = '';
        $akhir = '';
        $total_penjualan = 0;
        $total_pengeluaran = 0;
        $total_komisi = 0;

        if ($this->input->post('btn_export')) {
            $awal = $this->input->post('tanggal_awal');
            $akhir = $this->input->post('tanggal_akhir');
        }
        $data['laporans'] = $this->Laporan_model->select_laporan();
        if ($this->input->post("btn_export")) {
            if ($awal != "" && $akhir != "") {
                $data['laporans'] = $this->Laporan_model->select_laporan_periode($awal, $akhir);
            }
        }
        $awal = $awal == '' ? '---' : $awal;
        $akhir = $akhir == '' ? '---' : $akhir;

        $this->declare_excel();
        $this->insert_cell("A1", "Daftar Laporan Harian", 20, 'A1:F1', FALSE, FALSE, FALSE);
        $this->insert_cell("A2", "Periode");
        $this->insert_cell("B2", $awal . " S/D " . $akhir, 14, "B2:D2");

        if ($this->input->post('cabang')) {
            $this->insert_cell("A3", "Cabang");
            $this->insert_cell("B3", $this->Admin_model->get_detail_cabang($this->input->post('cabang'))->provinsi . " - " . $this->Admin_model->get_detail_cabang($this->input->post('cabang'))->kabupaten, 14, "B3:D3");
        }
        
        $this->insert_cell("A4", "No", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("B4", "Tanggal", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("C4", "Admin", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("D4", "Keterangan", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("E4", "Total Penjualan", 14, FALSE, TRUE, TRUE, FALSE);

        $no = 1;
        $ke = 5;
        foreach ($data["laporans"] as $laporan) {
            $this->insert_cell('A' . $ke, $no, 14, FALSE, TRUE, TRUE, TRUE);
            $this->insert_cell('B' . $ke, strftime("%d-%m-%Y", strtotime($laporan->tanggal)), 14, FALSE, TRUE, TRUE, TRUE);
            $this->insert_cell('C' . $ke, $laporan->username, 14, FALSE, TRUE, TRUE, FALSE);
            $this->insert_cell('D' . $ke, $laporan->keterangan, 14, FALSE, TRUE, TRUE, FALSE);
            $this->insert_cell('E' . $ke, $laporan->totalPenjualan, 14, FALSE, TRUE, TRUE, TRUE);

            $total_penjualan += $laporan->totalPenjualan;
            $total_komisi += $laporan->totalKomisi;

            $no++;
            $ke++;
        }

        $this->excel->getActiveSheet()->setCellValue('A' . $ke, "");
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->mergeCells('A' . $ke . ':E' . $ke);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '#FCFF0F')
                    )
                )
        );
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $ke++;

        /* ------------------------------------- */
        $this->excel->getActiveSheet()->setCellValue('A' . $ke, "Total Penjualan");
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->mergeCells('A' . $ke . ':D' . $ke);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()
                ->getStyle('A' . $ke)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->setCellValue('E' . $ke, $total_penjualan);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $ke++;

        /* ------------------------------------- */

        $this->excel->getActiveSheet()->setCellValue('A' . $ke, "Total Komisi");
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->mergeCells('A' . $ke . ':D' . $ke);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()
                ->getStyle('A' . $ke)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->setCellValue('E' . $ke, $total_komisi);
        $ke++;

        /* ------------------------------------- */

        $filename = 'laporan_harian.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    function cetak_penjualan_sales() {
        $data = array();
        $total = array();
        $awal = '';
        $akhir = '';

        $data['username'] = $this->session->userdata('Username');
        $data['level'] = $this->session->userdata('Level');
        $data['IDCabang'] = $this->session->userdata('IDCabang');

        if ($this->input->post('btn_export')) {
            $awal = $this->input->post('tanggal_awal');
            $akhir = $this->input->post('tanggal_akhir');
        }

        $data['datasales'] = $this->Sales_model->get_sales_tiap_admin($data['username']);
        $data['barangs'] = $this->Barang_model->get_all_barang();
        $arrIDSales = array();
        foreach ($data['datasales'] as $sales) {
            array_push($arrIDSales, $sales->id_sales);
        }

        $data['selectBarang'] = $this->input->post('filterBarang');
        $data['selectSeles'] = $this->input->post('filter');

        if ($awal == "" && $akhir == "") {
            $data['datapenjualan'] = $this->Sales_model->get_penjualan($arrIDSales);
        } else {
            $data['datapenjualan'] = $this->Sales_model->get_penjualan($arrIDSales, $awal, $akhir);
        }

        $awal = $awal == '' ? '---' : $awal;
        $akhir = $akhir == '' ? '---' : $akhir;
        $data['selectBarang'] = $data['selectBarang'] == 0 ? '---' : $data['selectBarang'];
        $data['selectSeles'] = $data['selectSeles'] == 0 ? '---' : $data['selectSeles'];

        $this->declare_excel();
        $this->insert_cell("A1", "Daftar Penjualan SPG", 20, 'A1:F1', FALSE, FALSE, FALSE);
        $this->insert_cell("A2", "Periode");
        $this->insert_cell("B2", $awal . " S/D " . $akhir, 14, "B2:D2");
        $this->insert_cell("E2", "Filter Barang : " . $data['selectBarang'], 14);
        $this->insert_cell("F2", "Filter SPG : " . $data['selectSeles'], 14);
        $this->insert_cell("A4", "No", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("B4", "Tanggal", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("C4", "SPG", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("D4", "Nama Barang", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("E4", "Penjualan (PCS)", 14, FALSE, TRUE, TRUE, FALSE);
        $this->insert_cell("F4", "Lokasi", 14, FALSE, TRUE, TRUE, FALSE);

        $no = 1;
        $ke = 5;
        foreach ($data['datapenjualan'] as $penjualan):
            $total[$penjualan->IDBarang] = 0;
        endforeach;

        foreach ($data['datapenjualan'] as $penjualan):
//            print_r($data['datapenjualan']);
//            exit;
            $total[$penjualan->IDBarang] += intval($penjualan->jumlah);

            $this->insert_cell('A' . $ke, $no, 14, FALSE, TRUE, TRUE, TRUE);
            $this->insert_cell('B' . $ke, strftime("%d-%m-%Y", strtotime($penjualan->tanggal)), 14, FALSE, TRUE, TRUE, TRUE);
            $this->insert_cell('C' . $ke, $penjualan->nama, 14, FALSE, TRUE, TRUE, FALSE);
            $this->insert_cell('D' . $ke, $penjualan->namaBarang, 14, FALSE, TRUE, TRUE, FALSE);
            $this->insert_cell('E' . $ke, $penjualan->jumlah, 14, FALSE, TRUE, TRUE, TRUE);
            $this->insert_cell('F' . $ke, $penjualan->desa, 14, FALSE, TRUE, TRUE, TRUE);

            $no++;
            $ke++;
        endforeach;

        $this->excel->getActiveSheet()->setCellValue('A' . $ke, "");
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->mergeCells('A' . $ke . ':F' . $ke);

        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $ke++;

        // --------------------------------------

        $this->excel->getActiveSheet()->setCellValue('A' . $ke, "TOTAL PENJUALAN");
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->mergeCells('A' . $ke . ':F' . $ke);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '#FCFF0F')
                    )
                )
        );
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $ke++;

        $counter = 0;
        foreach ($total as $value) :
            $this->insert_cell("A" . $ke, $data['barangs'][$counter++]->namaBarang, 14, "A" . $ke . ":D" . $ke, TRUE);
            $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('A' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('B' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('C' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('D' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $this->insert_cell("E" . $ke, $value, 14, "E" . $ke . ":F" . $ke, TRUE);

            $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('E' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle('F' . $ke)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $ke++;

        endforeach;

        $filename = 'laporan_penjualan_SPG.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    function declare_excel() {
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Worksheet 1');
    }

    function insert_cell($nama_cell = '', $value = '', $font_size = 14, $merge = FALSE, $border = FALSE, $auto_width = FALSE, $number_format = FALSE) {
        $this->excel->getActiveSheet()->setCellValue($nama_cell, $value);
        $this->excel->getActiveSheet()->getStyle($nama_cell)->getFont()->setSize($font_size);
        $this->excel->getActiveSheet()->getStyle($nama_cell)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle($nama_cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        if ($merge != FALSE)
            $this->excel->getActiveSheet()->mergeCells($merge);
        if ($auto_width)
            $this->excel->getActiveSheet()->getColumnDimension(substr($nama_cell, 0, 1))->setAutoSize(true);
        if ($border) {
            $this->excel->getActiveSheet()->getStyle($nama_cell)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle($nama_cell)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle($nama_cell)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->excel->getActiveSheet()->getStyle($nama_cell)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        }
        if ($number_format)
            $this->excel->getActiveSheet()->getStyle($nama_cell)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
    }

}
