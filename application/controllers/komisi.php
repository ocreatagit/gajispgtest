<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Komisi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Sales_model');
        $this->load->model('Barang_model');
        $this->load->model('Lokasi_model');
        $this->load->model('Laporan_model');
        $this->load->helper('url');
        $this->load->library("cart");
        $this->load->library("form_validation");
    }

    public function laporan_komisi() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');

            $data['laporans'] = $this->Sales_model->get_laporan_komisi();
            $data['saldo'] = $this->Admin_model->get_saldo($data['username']);
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

        if ($this->input->post('logout')) {
            $this->session->unset_userdata('Username');
            redirect('welcome/index');
        }
        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_laporan_komisi', $data);
    }

    public function tambah_komisi() {

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('bayar', 'Pembayaran', 'required');
//        echo $this->session->userdata('Username'); exit;
//        echo "adasadssa"; exit;
        if ($this->session->userdata('Username')) {
//            echo "adasadssa"; exit;
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }

        if ($this->input->post("btn_submit")) {
            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post("sales") != 0) {
                    if ($this->input->post("bayar") <= $this->input->post("komisi_hidden")) {
                        $rowid = "";
                        foreach ($this->cart->contents() as $items) {
                            if ($items["name"] == $this->input->post("nama_sales")) {
                                $rowid = $items["rowid"];
                                break;
                            }
                        }
                        if ($rowid == "") {
                            $data = array(
                                'id' => 'komisi_' . ($this->cart->total_items() + 1),
                                'qty' => 1,
                                'price' => $this->input->post("bayar"),
                                'name' => $this->input->post("nama_sales"),
                                'options' => array(
                                    'IDSales' => $this->input->post("sales"),
                                    'tanggal' => $this->input->post("tanggal"),
                                    'komisi' => $this->input->post("komisi_hidden")
                                )
                            );
                            $this->cart->insert($data);
                        } else {
                            $this->session->set_flashdata("status", "Komisi Sales Telah Diinputkan!");
                            $rowid = "";
                        }
                    } else {
                        $this->session->set_flashdata("status", "Total Komisi Sales Tidak Mencukupi Pembayaran!");
                    }
//                print_r($this->cart->contents());
//                exit;
                } else {
                    $this->session->set_flashdata("status", "Mohon Pilih Sales yang Tersedia!");
                }
//            } else {
//                echo validation_errors(); exit;
//                echo "adsaa"; exit;
            } else {
                
            }
        }

        $data['username'] = $this->session->userdata('Username');
        $data['level'] = $this->session->userdata('Level');
        $data['IDCabang'] = $this->session->userdata('IDCabang');
        $data['status'] = $this->session->flashdata('status');
        $data['saless'] = $this->Sales_model->get_sales_tiap_admin($data["username"]);
        $data["cart"] = $this->cart->contents();
//        print_r($data["cart"]); exit;
        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_input_data_komisi', $data);
    }

    function get_komisi_sales() {
        if ($this->input->post("btn_submit")) {
            return $this->Sales_model->get_komisi_sales();
        } else {
            echo $this->Sales_model->get_komisi_sales();
        }
//        echo $this->input->post("IDSales");
    }

    function delete_cart_pembayaran($id = FALSE) {
        if ($id == FALSE) {
            redirect("komisi/tambah_komisi");
        }
        $rowid = "";
        if ($this->cart->total_items() > 0) {
            foreach ($this->cart->contents() as $items) {
                if ($items["id"] == $id) {
                    $rowid = $items["rowid"];
                    break;
                }
            }

            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);

            $this->session->set_flashdata("status", "Data Telah Dihapus!");
        }
        redirect("komisi/tambah_komisi");
    }

    function simpan_komisi() {
        if ($this->cart->total_items() > 0) {
            $id_laporan = $this->Sales_model->insert_laporan_komisi();
            foreach ($this->cart->contents() as $items) {
//                $this->Sales_model->update_komisi($items["options"]["IDSales"], $items["price"], $id_laporan);
                
                // Jurnal
                $this->load->model('Jurnal_model');
                $this->Jurnal_model->insert_jurnal_pengeluaran($id_laporan, 'Bayar Komisi SPG', $items["price"]);
            }
            $this->session->set_flashdata("status", "Komisi telah Diambil!!");
            $this->cart->destroy();
        } else {
            $this->session->set_flashdata("status", "Tidak Terdapat Data yang DiMasukan!");
        }
        redirect("komisi/tambah_komisi");
    }

    function detail_komisi($IDLaporan) {
        if ($IDLaporan == FALSE) {
            redirect("komisi/laporan_komisi");
        }
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        $data["detail_bayars"] = $this->Sales_model->get_detail_laporan_komisi($IDLaporan);
//        print_r($data["detail_bayars"]); exit;
        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_detail_komisi', $data);
    }

    function cetak_laporan_komisi($IDLaporan) {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');

            $data['detail_bayar_komisis'] = $this->Sales_model->get_detail_laporan_komisi($IDLaporan);
            $data['laporan_bayar_komisi'] = $this->Sales_model->get_laporan_komisi_id($IDLaporan);
        } else {
            redirect('welcome/index');
        }
        if ($this->input->post('logout')) {
            $this->session->unset_userdata('Username');
            redirect('welcome/index');
        }
        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_laporan_komisi_cetak', $data);
    }

}
