<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/libraries/PHPExcel/PHPExcel.php";

class Custom_Excel extends PHPExcel {

    private $activateWorksheet;
    private $column;
    private $row;
    private $cell;
    private $merge = FALSE;
    private $border = FALSE;

    public function __construct() {
        parent::__construct();
    }

    public function declare_excel($activateWorksheet = 0, $worksheetName = "Worksheet 1") {
        parent::setActiveSheetIndex($activateWorksheet);
        $this->activateWorksheet = parent::getActiveSheet();
        $this->activateWorksheet->setTitle($worksheetName);
    }

    function add_cell($value = '', $column = 'A', $row = 1) {
        
        $this->column = ord($column);
        $this->row = $row;
        $this->cell = chr($this->column) . $this->row;
        $this->merge = FALSE;
        $this->border = FALSE;
        
        $this->activateWorksheet->setCellValue($this->cell, $value);
        $this->activateWorksheet->getStyle($this->cell)->getFont()->setSize(12);
        $this->activateWorksheet->getStyle($this->cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        return $this;
    }

    function font($size = 12, $bold = FALSE, $italic = FALSE) {
        $style = $this->activateWorksheet->getStyle($this->cell)->getFont();
        $style->setSize($size);
        $style->setBold($bold);
        $style->setItalic($italic);
        return $this;
    }

    function alignment($align = 'left') {
        $this->activateWorksheet->getStyle($this->cell)->getAlignment()->setHorizontal($align);
        return $this;
    }

    function autoWidth($autowidth = TRUE) {
        $this->activateWorksheet->getColumnDimension(chr($this->column))->setAutoSize($autowidth);
        return $this;
    }

    function border($border = TRUE) {
        $this->border = $border;
        if ($border) {
            $cell = $this->activateWorksheet->getStyle($this->cell)->getBorders();
            $cell->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $cell->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $cell->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $cell->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            if ($this->merge) {
                $this->merge_border_cell($this->column, $this->row, $this->merge);
            }
        }
        return $this;
    }

    function merge($arrmerge) {
        $this->merge = $arrmerge;
        $this->activateWorksheet->mergeCells($this->cell . ":" . chr($this->merge[1] + $this->column) . ($this->merge[0] + $this->row));
        if ($this->border) {
            $this->merge_border_cell($this->column, $this->row, $arrmerge);
        }
        return $this;
    }

//    function insert_cell($kolom = 'A', $baris = 0, $value = '', $font_size = 14, $merge = FALSE, $border = FALSE, $auto_width = FALSE, $number_format = FALSE) {        
//        if ($number_format)
//            $this->activateWorksheet->getStyle(chr($C) . $baris)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
//    }

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
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $Filename . '.xls"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    function test1() {
        return $this;
    }

    function test2() {
        print_r("COBA BERHASIL");
        exit;
    }

}
