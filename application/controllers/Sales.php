<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sales_model');
        $this->load->model('Admin_model');
        $this->load->model('Laporan_model');
//        $this->load->library('session');
//        $this->load->helper('file');
//        $this->load->library('ftp');
        $this->load->helper('url');
    }

    public function daftar_sales_tiap_admin() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        $data['admins'] = $this->Sales_model->get_sales_tiap_admin();

        $this->load->view('v_head', $data);
        $this->load->view('v_navigation', $data);
        $this->load->view('v_daftar_admin', $data);
        $this->load->view('v_foot');
    }

    public function daftar_sales() {
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
        $data["filter"] = "";
        if ($this->input->post("btn_submit")) {
            $data["filter"] = $this->Laporan_model->get_cabang_id($this->input->post("cabang"));
        }
        $data['username'] = $this->session->userdata('Username');
        $this->Sales_model->get_idcabang();
        $data['saless'] = $this->Sales_model->select_sales();

        $this->load->view('v_head', $data);
        $this->load->view('v_navigation', $data);
        $this->load->view('v_daftar_sales', $data);
        $this->load->view('v_foot');
    }

    public function delete_sales($IDSales) {
        $this->Sales_model->delete_sales($IDSales);
        redirect('sales/daftar_sales');
    }

    public function tambah_sales($IDSales = NULL) {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        $data['status'] = $this->session->flashdata('status');
        $data['username'] = $this->session->userdata('Username');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model("barang_model");
        $data['barangs'] = $this->barang_model->get_barang();
        $data['data_sales'] = NULL;
        if ($IDSales == NULL) {
            if ($this->input->post("btn_submit")) {
                    $this->load->model("Sales_model");
                    $dataController = $this->Sales_model->insert_sales();
                    $this->Sales_model->insert_komisi($dataController[1], $data['barangs']);

                    $config['upload_path'] = "./uploads";
                    $config['allowed_types'] = 'jpg|png|gif';
                    $config['max_size'] = 0;
                    $config['file_name'] = $dataController[0];
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload("foto_sales")) {
                        echo $response = $this->upload->display_errors();
                        exit;
                    } else {
                        $response = $this->upload->data();
                        redirect("Sales/daftar_sales");
                    }
            } else {
                $this->load->view('v_head');
                $this->load->view('v_navigation', $data);
                $this->load->view('v_tambah_sales', $data);
            }
        } else {
            $this->load->model("Sales_model");
            $data['data_sales'] = $this->Sales_model->select_sales($IDSales);
            $data['komisi_sales'] = $this->Sales_model->select_komisi($IDSales);                       
            
            if ($this->input->post("btn_submit")) {
                
                $this->load->model("Sales_model");
                $namafile = $this->Sales_model->update_sales($IDSales);
                $this->Sales_model->ganti_komisi($IDSales,$data['barangs']);
                
                if (!empty($_FILES['foto_sales']['name'])) {
                    $config['upload_path'] = "./uploads";
                    $config['allowed_types'] = 'jpg|png|gif';
                    $config['max_size'] = 0;
                    $config['file_name'] = $namafile;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload("foto_sales")) {
                        echo $response = $this->upload->display_errors();
                        exit;
                    } else {
                        $response = $this->upload->data();
                        
                    }
                }
                redirect("Sales/daftar_sales");
            }

            $this->load->view('v_head');
            $this->load->view('v_navigation', $data);
            $this->load->view('v_tambah_sales', $data);
        }
    }
    
    public function kehadiran_sales() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }

        if ($this->session->userdata("Level") == 0) {
            $data["cabangs"] = $this->Admin_model->get_all_cabang();
            $data['selectCabang'] = $this->input->post('cabang');
        }

        $data['selectSeles'] = $this->input->post('filter');
        $data['datasales'] = $this->Sales_model->get_sales_tiap_admin($data['username']);
        $data['kehadirans'] = $this->Sales_model->get_kehadiran();

        if ($this->input->post('btn_pilih') || $this->input->post('btn_export')) {
            $awal = $this->input->post('tanggal_awal');
            $akhir = $this->input->post('tanggal_akhir');
            $data['tanggal'] = ($awal ? $awal : "--") . " s/d " . ($akhir ? $akhir : "--");
            $data['kehadirans'] = $this->Sales_model->get_kehadiran($this->input->post('tanggal_awal'), $this->input->post('tanggal_akhir'), $this->input->post('filter'));
        }

        if ($this->input->post('btn_export')) {
            $this->excel_kehadiran($data);
        }

        $this->load->view('v_head', $data);
        $this->load->view('v_navigation', $data);
        $this->load->view('v_kehadiran', $data);
        $this->load->view('v_foot');
    }

    public function excel_kehadiran($data) {
        $this->load->library('custom_excel');
        $excel = $this->custom_excel;
        $excel->declare_excel();
        $row = 1;
        /* array = merge(berapa baris, berapa kolom) */
        $excel->add_cell("Daftar Kehadiran", 'A', $row++)->font(20)->merge(array(0, 2))->alignment('center');
        if ($data['tanggal'] != "-- s/d --") {
            $excel->add_cell("Tanggal :", 'A', $row)->alignment('right');
            $excel->add_cell($data['tanggal'], 'B', $row++)->merge(array(0, 1))->alignment('center');
        } else {
            $excel->add_cell("Bulan :", 'A', $row)->alignment('right');
            $excel->add_cell(date("F"), 'B', $row++)->merge(array(0, 1))->alignment('center');
        }
        $row++;

        $excel->add_cell('Nama SPG', 'A', $row)->alignment('center')->border()->autoWidth()->font(14);
        $excel->add_cell('Hadir', 'B', $row)->alignment('center')->border()->autoWidth()->font(14);
        $excel->add_cell('Absen', 'C', $row++)->alignment('center')->border()->autoWidth()->font(14);

        foreach ($data['kehadirans'] as $kehadiran) {
            $excel->add_cell($kehadiran->nama, 'A', $row)->border()->autoWidth();
            $excel->add_cell($kehadiran->hadir, 'B', $row)->alignment('center')->border()->autoWidth();
            $excel->add_cell($kehadiran->absen, 'C', $row++)->alignment('center')->border()->autoWidth();
        }
        $excel->end_excel("laporan_kehadiran");
    }

}
