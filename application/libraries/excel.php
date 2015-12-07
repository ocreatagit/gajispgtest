<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/libraries/PHPExcel/PHPExcel.php";

class Excel extends PHPExcel {
    
    private $activateWorksheet;

    public function __construct() {
        parent::__construct();
    }

    public function declare_excel($activateWorksheet = 0, $worksheetName = "Worksheet 1") {
        //activate worksheet number 1
        parent::setActiveSheetIndex($activateWorksheet);
        //name the worksheet
        $this->activateWorksheet = parent::getActiveSheet();
        $this->activateWorksheet->setTitle($worksheetName);
    }

    function insert_cell($kolom = 'A', $baris = 0, $value = '', $font_size = 14, $merge = FALSE, $border = FALSE, $auto_width = FALSE, $number_format = FALSE) {
        $C = ord($kolom);
        $this->activateWorksheet->setCellValue(chr($C) . $baris, $value);
        $this->activateWorksheet->getStyle(chr($C) . $baris)->getFont()->setSize($font_size);
        $this->activateWorksheet->getStyle(chr($C) . $baris)->getFont()->setBold(true);
        $this->activateWorksheet->getStyle(chr($C) . $baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        if ($merge != FALSE) {
            $this->activateWorksheet->mergeCells(chr($C) . $baris . ":" . chr($merge[1] + $C) . ($merge[0] + $baris));
            $this->merge_border_cell($C, $baris, $merge);
        }
        if ($auto_width)
            $this->activateWorksheet->getColumnDimension(substr(chr($C) . $baris, 0, 1))->setAutoSize(true);
        if ($border) {
            $this->activateWorksheet->getStyle(chr($C) . $baris)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->activateWorksheet->getStyle(chr($C) . $baris)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->activateWorksheet->getStyle(chr($C) . $baris)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->activateWorksheet->getStyle(chr($C) . $baris)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        }
        if ($number_format)
            $this->activateWorksheet->getStyle(chr($C) . $baris)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
    }

    function merge_border_cell($startColumn, $startRow, $arr) {
        $endRow = $startRow + $arr[0];
        $endColumn = $startColumn + $arr[1];
        for (; $startRow <= $endRow; $startRow++) {
            for (; $startColumn <= $endColumn; $startColumn++) {
                $this->activateWorksheet->getStyle(chr($startColumn) . $startRow)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $this->activateWorksheet->getStyle(chr($startColumn) . $startRow)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $this->activateWorksheet->getStyle(chr($startColumn) . $startRow)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $this->activateWorksheet->getStyle(chr($startColumn) . $startRow)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            }
        }
    }

    function end_excel($Filename = "book1") {
//        $filename = 'laporan_penjualan_SPG.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $Filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    /* TEST */

    /* END TEST */
}
