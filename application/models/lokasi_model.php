<?php

class Lokasi_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
        $this->load->helper('string');
    }

    function tambah_cabang_baru() {
        $data = array(
            'IDAdmin' => $this->input->post("IDAdmin"),
            'IDAdmin_kantor' => $this->input->post("IDAdmin_kantor"),
            'Provinsi' => $this->input->post("provinsi"),
            'Kabupaten' => $this->input->post("kabupaten")
        );

        $this->db->insert('cabang', $data);
        $this->session->set_flashdata("status", "Cabang Telah Ditambahkan!");
    }

    function tambah_lokasi_baru() {
        $data = array(
            'Kecamatan' => $this->input->post("kecamatan"),
            'Desa' => $this->input->post("desa"),
            'IDCabang' => $this->input->post("IDCabang")
        );

        $this->db->insert('lokasi', $data);
        $this->session->set_flashdata("status", "Lokasi Telah Ditambahkan!");
    }

    function get_lokasi() {
        $sql = "SELECT c.* FROM cabang c";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_admin_lokasi() {
        $admin = $this->db->get_where("admin", array("username" => $this->session->userdata("Username")))->row();
        $sql = "SELECT c.*, s.* FROM cabang c INNER JOIN lokasi s ON s.IDCabang = c.IDCabang WHERE c.IDAdmin = " . $admin->IDAdmin;
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_admin_cabang() {
        $admin = $this->db->get_where("admin", array("username" => $this->session->userdata("Username")))->row();
        return $this->db->get_where("cabang", array("IDAdmin" => $admin->IDAdmin))->row();
    }

    /* ronald */

    function get_detail_cabang_lokasi($IDLokasi) {
        $sql = "SELECT l.IDLokasi as id_lokasi, l.desa, l.kecamatan, l.kabupaten, l.wilayah, c.provinsi FROM lokasi l INNER JOIN cabang c ON c.IDCabang = l.IDCabang WHERE l.IDLokasi = " . $IDLokasi;
        return $this->db->query($sql)->row();
    }

    function tambah_cabang() {
        $admin = $this->db->get_where("admin", array("username" => $this->session->userdata("Username")))->row();
        $sql = "SELECT * FROM cabang WHERE IDAdmin = " . $admin->IDAdmin;
        $cabang = $this->db->query($sql)->row();

        $data = array(
            'kabupaten' => $this->input->post("kabupaten"),
            'wilayah' => $this->input->post("wilayah"),
            'kecamatan' => $this->input->post("kecamatan"),
            'desa' => $this->input->post("daerah"),
            'IDCabang' => $cabang->IDCabang
        );

        $this->db->insert('lokasi', $data);
    }

    function get_detail_lokasi($IDLokasi) {
        $query = $this->db->query("SELECT l.IDLokasi as id_lokasi, l.desa, l.kecamatan, l.kabupaten, l.wilayah, c.provinsi
                                FROM cabang c
                                INNER JOIN lokasi l ON l.IDCabang = c.IDCabang
                                INNER JOIN admin a ON c.IDAdmin = a.IDAdmin
                                WHERE l.IDLokasi = " . $IDLokasi);
        return $query->row();
    }

    function edit_cabang() {
        $data = array(
            'kabupaten' => $this->input->post("kabupaten"),
            'wilayah' => $this->input->post("wilayah"),
            'kecamatan' => $this->input->post("kecamatan"),
            'desa' => $this->input->post("daerah")
        );

        $this->db->where("IDLokasi", $this->input->post("IDLokasi"));
        $this->db->update('lokasi', $data);
        
        $query = $this->db->query("SELECT l.IDLokasi as id_lokasi, l.desa, l.kecamatan, l.kabupaten, l.wilayah, c.provinsi
                                FROM cabang c
                                INNER JOIN lokasi l ON l.IDCabang = c.IDCabang
                                INNER JOIN admin a ON c.IDAdmin = a.IDAdmin
                                WHERE l.IDLokasi = " . $this->input->post("IDLokasi"));
        return $query->row();
    }

    /* ronald */
    
    function delete_lokasi($IDLokasi) {
        if ($this->db->get_where('jual', array('IDLokasi' => $IDLokasi))->num_rows() == 0) {
            $this->db->delete('lokasi', array('IDLokasi' => $IDLokasi));
            $this->session->set_flashdata("status", "Lokasi telah dihapus!");
        } else {
            $this->session->set_flashdata("status", "Maaf lokasi tidak dapat dihapus karena lokasi tersebut digunakan di Laporan Penjualan");
        }
    }
}
