<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lokasi_model');
        $this->load->model('Admin_model');
//        $this->load->library('session');
//        $this->load->helper('file');
//        $this->load->library('ftp');
        $this->load->helper('url');
    }

    public function tambah_lokasi() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        $data["status"] = $this->session->flashdata("status");
//        $this->Lokasi_model->tambah_lokasi_baru();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->session->userdata("Level") == 0) {
            $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
            $this->form_validation->set_rules('kabupaten', 'Kabupeten', 'required');
//        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
//        $this->form_validation->set_rules('desa', 'Desa', 'required');

            if ($this->input->post("hid")) {
                if ($this->form_validation->run() == FALSE) {
//                $this->load->view('v_head');
//                $this->load->view('v_navigation');
//                $this->load->view('v_tambah_lokasi', $data);
                } else {
                    if ($this->input->post("IDAdmin") && $this->input->post("IDAdmin_kantor")) {
                        $this->Lokasi_model->tambah_cabang_baru();
                        redirect("lokasi/tambah_lokasi");
                    } else {
                        $this->session->set_flashdata("status", "<i class='fa fa-info-circle'></i> Tidak Terdapat Admin Lapangan / Admin Kantor yang dapat ditugaskan dalam Cabang baru tersebut!");
                    }
                }
            }
            $data["username"] = $this->session->userdata("Username");
            $data['status'] = $this->session->flashdata('status');
            $data["admin"] = $this->Admin_model->get_admin_not_in_cabang();
            $data["admin_kantor"] = $this->Admin_model->get_admin_kantor_not_in_cabang();
            $data["lokasi"] = $this->Lokasi_model->get_lokasi();
        } else if ($this->session->userdata("Level") == 1) {

            $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
            $this->form_validation->set_rules('desa', 'Desa', 'required');

            if ($this->input->post("hid")) {
                if ($this->form_validation->run() == FALSE) {
                    
                } else {
                    $this->Lokasi_model->tambah_lokasi_baru();
                    redirect("lokasi/tambah_lokasi");
                }
            }

            $data["username"] = $this->session->userdata("Username");
            $data['status'] = $this->session->flashdata('status');
            $data["cabang"] = $this->Lokasi_model->get_admin_cabang();
            $data["lokasi"] = $this->Lokasi_model->get_admin_lokasi();
//            print_r($data["lokasi"]); exit;
        }
        $this->load->view('v_head');
        $this->load->view('v_navigation', $data);
        $this->load->view('v_tambah_lokasi', $data);
    }

    function get_detail_lokasi() {
        if ($this->input->post("IDLokasi")) {
            $this->load->model("Lokasi_model");
            echo json_encode($this->Lokasi_model->get_detail_cabang_lokasi($this->input->post("IDLokasi")));
        }
    }

    function tambah_cabang() {
        $this->load->model("Lokasi_model");
        $this->Lokasi_model->tambah_cabang();
    }

    function edit_cabang() {
        $this->load->model("Lokasi_model");
        echo json_encode($this->Lokasi_model->edit_cabang());
    }

    function delete_lokasi($IDLokasi = FALSE) {
        if ($IDLokasi) {
            $this->Lokasi_model->delete_lokasi($IDLokasi);
        }
        redirect('lokasi/tambah_lokasi');
    }

}
