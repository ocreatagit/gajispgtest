<?php

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
        $this->load->helper('string');
        $this->load->helper('date');
    }

    function cek_login($username, $password) {
        $query = $this->db->get_where("admin", array("username" => $username));
        if ($query->num_rows() == 0) {
            $this->session->set_flashdata("status", "Username Tidak Terdaftar Dalam Sistem!");
            return false;
        } else {
            $query = $this->db->query("SELECT * FROM admin WHERE username = '$username' and password = '$password'");
            if ($query->num_rows() > 0) {
                return true;
            } else {
                $this->session->set_flashdata("status", "Password yang Diinputkan Salah!");
                return false;
            }
        }
    }

    function cek_level_login($username) {
        $query = $this->db->query("Select level From admin Where username = '$username'");
        return $query->row();
    }

    function get_admin_edit($IDAdmin) {
        $sql = "SELECT * FROM admin WHERE IDAdmin = " . $IDAdmin;
        $res = $this->db->query($sql);
        if ($res->num_rows() == 0) {
            $this->session->set_flashdata("status", "Admin Tidak Ditemukan!");
            return -1;
        } else {
            return $res->row();
        }
    }

    function get_provinsi_kabupaten($username) {
        $query = $this->db->query("SELECT provinsi, kabupaten
                                    FROM cabang c
                                    INNER JOIN admin a ON c.IDAdmin = a.IDAdmin
                                    WHERE a.username = '$username'");
        return $query->row();
    }

    function get_kecamatan_desa($username) {
        $query = $this->db->query("SELECT l.IDLokasi as id_lokasi, l.desa, l.kecamatan as lokasi
                                FROM cabang c
                                INNER JOIN lokasi l ON l.IDCabang = c.IDCabang
                                INNER JOIN admin a ON c.IDAdmin = a.IDAdmin
                                WHERE a.Username = '$username' ORDER BY l.desa");
        return $query->result();
    }

    function insert_admin() {
        $data = array(
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "level" => $this->input->post("level"),
            "nama" => $this->input->post("nama"),
            "email" => $this->input->post("email")
        );
        $this->db->insert("admin", $data);
        $this->session->set_flashdata("status", "Admin Telah Ditambahkan!");

        return $this->db->insert_id();
    }

    function update_admin() {
        $data = array(
            "level" => $this->input->post("level"),
            "nama" => $this->input->post("nama"),
            "email" => $this->input->post("email")
        );
        $this->db->where("IDAdmin", $this->input->post("IDAdmin"));
        $this->db->update("admin", $data);
        $this->session->set_flashdata("status", "Admin Telah Diubah!");
    }

    function get_admin($username, $password) {
        return $this->db->get_where("admin", array("username" => $username, "password" => $password))->row();
    }

    function select_admin() {
        $query = $this->db->get('admin');
        return $query->result();
    }

    function get_admin_not_in_cabang() {
        $sql = "SELECT * FROM admin WHERE IDAdmin NOT IN (SELECT IDAdmin FROM cabang) AND level = 1;";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_admin_kantor_not_in_cabang() {
        $sql = "SELECT * FROM admin WHERE IDAdmin NOT IN (SELECT IDAdmin_kantor FROM cabang) AND level = 2;";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_saldo($username) {
        $sql = "SELECT level FROM admin WHERE username = '$username'";
        $level = $this->db->query($sql)->row()->level;
        if ($level == 1) {
            $sql = "Select c.saldo as saldo
                    From cabang c
                    INNER JOIN admin a ON a.IDAdmin = c.IDAdmin
                    WHERE a.username = '$username'";
        } else {
            $sql = "Select c.saldo as saldo
                    From cabang c
                    INNER JOIN admin a ON a.IDAdmin = c.IDAdmin_kantor
                    WHERE a.username = '$username'";
        }
        if ($level == 0) {
            return 0;
        }
        $query = $this->db->query($sql);
        return $query->row()->saldo;
    }

    function get_saldo_cabang($IDCabang) {
        $sql = "Select c.saldo as saldo From cabang c WHERE c.IDCabang = " . $IDCabang . ";";
        $query = $this->db->query($sql);
        return $query->row()->saldo;
    }

    /* Cek cek Penggajian */

//    function set_tanggal_gaji() {
//        $data = array(
//            "tanggalGaji" => strftime("%Y-%m-%d", strtotime("now"))
//        );
//        $this->db->update('sales', $data);
//    }
//
//    function cek_penggajian() {
//        $query = $this->db->query(" Select tanggalGaji as tanggal_gaji from sales");
//        return $query->row()->tanggal_gaji;
//    }


    /* 13/10/2015 */
    function get_cabang($username) {
        $sql = "SELECT level FROM admin WHERE username = '$username'";
        $level = $this->db->query($sql)->row()->level;
        if ($level == 1) {
            $sql = "SELECT IDCabang as idcabang
                FROM cabang c
                INNER JOIN admin a ON c.IDAdmin = a.IDAdmin
                WHERE a.username = '$username'";
        } else if ($level == 2) {
            $sql = "SELECT IDCabang as idcabang
                FROM cabang c
                INNER JOIN admin a ON c.IDAdmin_kantor = a.IDAdmin
                WHERE a.username = '$username'";
        } else if ($level == 0) {
            
        }
        $query = $this->db->query("$sql");
        return $query->row()->idcabang;
    }

    function get_all_cabang() {
        $sql = "SELECT IDCabang as idcabang, provinsi, kabupaten
                FROM cabang c;";
        $query = $this->db->query("$sql");
        return $query->result();
    }

    function get_detail_cabang($IDCabang) {
        return $this->db->get_where("cabang", array("IDCabang" => $this->input->post('cabang')))->row();
    }

    function insert_pendapatan() {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            "tanggal" => strftime("%Y-%m-%d", strtotime($this->session->userdata("tanggal_jual"))),
            "keterangan" => $this->session->userdata("keterangan"),
            "IDCabang" => $this->Admin_model->get_cabang($this->session->userdata('Username'))
        );
        $this->db->insert("laporan_penjualan", $data);
        return $this->db->insert_id();
    }

    function insert_detail_pendapatan($IDPenjualan, $IDTeamLeader, $IDSales, $IDBarang, $IDLokasi, $qty, $price, $username) {
        $IDCabang = $this->get_cabang($username);

        $data = array(
            "IDPenjualan" => $IDPenjualan,
            "IDTeamLeader" => $IDTeamLeader,
            "IDSales" => $IDSales,
            "IDBarang" => $IDBarang,
            "IDLokasi" => $IDLokasi,
            "jumlah" => $qty,
            "hargaJual" => $price
        );
        $this->db->insert("jual", $data);


        /* TAMBAHIN TOTAL PENJUALAN */
        $query = "SELECT totalPenjualan FROM laporan_penjualan WHERE IDPenjualan = " . $IDPenjualan;
        $result = $this->db->query($query)->row();
        $current_penjualan = $result->totalPenjualan;

        $current_penjualan += ($price + 0);

        $data = array("totalPenjualan" => ($current_penjualan));
        $this->db->where("IDPenjualan", $IDPenjualan);
        $this->db->update('laporan_penjualan', $data);



        /* Kurangi STOK */

        $query = $this->db->query("SELECT jumlah FROM cabang_barang WHERE IDCabang = $IDCabang AND IDBarang = $IDBarang");
        if ($query->num_rows() > 0) {
            $query = "SELECT jumlah FROM cabang_barang WHERE IDCabang = " . $IDCabang . " AND IDBarang = " . $IDBarang;
            $result = $this->db->query($query)->row();
            $current_stok = 0 + ($result->jumlah - $qty);

            $data = array("jumlah" => ($current_stok));
            $this->db->where("IDCabang", $IDCabang);
            $this->db->where("IDBarang", $IDBarang);
            $this->db->update('cabang_barang', $data);
        } else {
            $current_stok = (0 - $qty);
            $data = array(
                "IDCabang" => $IDCabang,
                "IDBarang" => $IDBarang,
                "jumlah" => $current_stok
            );
            $this->db->insert("cabang_barang", $data);
        }
        return "0";
    }

    function insert_laporan_pengeluaran() {
        $data = array(
            "tanggal" => strftime("%Y-%m-%d", strtotime($this->session->userdata("tanggal_jual"))),
            "totalPengeluaran" => 0,
            "IDCabang" => $this->Admin_model->get_cabang($this->session->userdata('Username'))
        );
        $this->db->insert("laporan_pengeluaran", $data);
        return $this->db->insert_id();
    }

    function insert_pengeluaran($IDPengeluaran, $keterangan, $nominal, $keterangan_lainnya) {

        $data = array(
            "keterangan" => $keterangan,
            "total_pengeluaran" => $nominal,
            "IDPengeluaran" => $IDPengeluaran,
            'keterangan_lanjut' => $keterangan_lainnya
        );
        $this->db->insert("detail_pengeluaran", $data);

        /* Get Date of report dan Catat Total Pengeluaran */
        $sql = "SELECT totalPengeluaran FROM laporan_pengeluaran Where IDPengeluaran = $IDPengeluaran";
        $result = $this->db->query($sql)->row();

        $current_pengeluaran = $result->totalPengeluaran;

        $current_pengeluaran += ($nominal + 0);

//        var_dump($nominal); exit;

        $data = array("totalPengeluaran" => ($current_pengeluaran));
        $this->db->where("IDPengeluaran", $IDPengeluaran);
        $this->db->update('laporan_pengeluaran', $data);

        $IDCabang = $this->Admin_model->get_cabang($this->session->userdata('Username'));
        $cabang = $this->db->get_where("cabang", array("IDCabang" => $IDCabang))->row();

//        echo $cabang->saldo; exit;
        $saldo = $cabang->saldo + (-$nominal);

        $data = array(
            "saldo" => $saldo
        );
        $this->db->where("IDCabang", $IDCabang);
        $this->db->update("cabang", $data);
        /* Get Date of report dan Catat Total Pengeluaran */
    }

    function insert_bayar_gaji($IDPenjualan, $IDSales, $nominal) {
        date_default_timezone_set('Asia/Jakarta');
//        $IDPenjualan = $this->input->post("IDPenjualan");
//        $IDSales = $this->input->post("IDSales");
//        $nominal = $this->input->post("nominal");

        /* Insert ke tabel bayar_gaji */
        $data = array(
            "jumlah" => $nominal,
            "IDPenjualan" => $IDPenjualan,
            "IDSales" => $IDSales
        );
        $this->db->insert("bayar_gaji", $data);

        /* Get Info Sales */
        $sales = $this->db->get_where("sales", array("IDSales" => $IDSales))->row();

        /* Get Date of report dan Catat Total Pengeluaran */
        $sql = "SELECT tanggal, totalPengeluaran FROM laporan_penjualan Where IDPenjualan = $IDPenjualan";
        $result = $this->db->query($sql)->row();
        $tanggal_laporan = $result->tanggal;

        $current_pengeluaran = $result->totalPengeluaran;

        $current_pengeluaran += ($nominal + 0);

        $data = array("totalPengeluaran" => ($current_pengeluaran));
        $this->db->where("IDPenjualan", $IDPenjualan);
        $this->db->update('laporan_penjualan', $data);
        /* Get Date of report dan Catat Total Pengeluaran */



        /* Update Total Saldo Gaji Sales */
        $data = array(
            "totalGaji" => ($sales->totalGaji - $nominal)
        );
        $this->db->where("IDSales", $IDSales);
        $this->db->update("sales", $data);

        /* History Gaji */
        $data = array(
            "IDSales" => $IDSales,
            "Nominal" => $nominal,
            "Tanggal" => $tanggal_laporan,
            "Keterangan" => "Gaji diambil"
        );
        $this->db->insert("historygaji", $data);
    }

    function hitung_saldo($IDPenjualan, $username) {
        /* Get Date of report dan Catat Total Pengeluaran */
        $sql = "SELECT totalPenjualan, totalKomisi FROM laporan_penjualan Where IDPenjualan = $IDPenjualan";
        $result = $this->db->query($sql)->row();
        $total_penjualan = $result->totalPenjualan;
        $total_totalKomisi = $result->totalKomisi;

        $IDCabang = $this->get_cabang($username);

        /* Get Date of report dan Catat Total Pengeluaran */
        $query = "SELECT saldo FROM cabang Where IDCabang = '$IDCabang'";
        $result = $this->db->query($query)->row();
        $saldo = $result->saldo;

        $saldo_terakhir = (($saldo + $total_penjualan));

        /* Update Total Saldo Gaji Sales */
        $data = array(
            "saldo" => $saldo_terakhir
        );
        $this->db->where("IDCabang", $IDCabang);
        $this->db->update("cabang", $data);

        /* Update Total Saldo Gaji Sales */
        $data = array(
            "status_kas" => 1
        );
        $this->db->where("IDPenjualan", $IDPenjualan);
        $this->db->update("laporan_penjualan", $data);

        $this->session->set_flashdata("status", "Data Telah Dimasukkan ke dalam Kas!");
    }
    
    function batal_saldo($IDPenjualan, $username) {
        /* Get Date of report dan Catat Total Pengeluaran */
        $sql = "SELECT totalPenjualan, totalKomisi FROM laporan_penjualan Where IDPenjualan = $IDPenjualan";
        $result = $this->db->query($sql)->row();
        $total_penjualan = $result->totalPenjualan;
        $total_totalKomisi = $result->totalKomisi;

        $IDCabang = $this->get_cabang($username);

        /* Get Date of report dan Catat Total Pengeluaran */
        $query = "SELECT saldo FROM cabang Where IDCabang = '$IDCabang'";
        $result = $this->db->query($query)->row();
        $saldo = $result->saldo;

        $saldo_terakhir = (($saldo - $total_penjualan));

        /* Update Total Saldo Gaji Sales */
        $data = array(
            "saldo" => $saldo_terakhir
        );
        $this->db->where("IDCabang", $IDCabang);
        $this->db->update("cabang", $data);

        /* Update Total Saldo Gaji Sales */
        $data = array(
            "status_kas" => 0
        );
        $this->db->where("IDPenjualan", $IDPenjualan);
        $this->db->update("laporan_penjualan", $data);

        $this->session->set_flashdata("status", "Kas Telah DiBatalkan!");
    }

    /* DANIEL */

    function change_data() {
        $data = array(
            'password' => $this->input->post('password')
                //'email' => $this->input->post('email')
        );

        $this->db->where('username', $this->session->userdata('Username'));
        $this->db->update('admin', $data);

        $this->session->set_flashdata("status", "Password telah di ubah!");
    }

    /* DANIEL */

    function insert_penjualan_gaji() {
        $data = array(
            "IDCabang" => $this->Admin_model->get_cabang($this->session->userdata('Username')),
            "tanggal" => date("Y-m-d"),
            "totalPenggajian" => 0,
            "keterangan" => "gaji"
        );
        $this->db->insert("laporan_penggajian", $data);
        return $this->db->insert_id();
    }

    function insert_detail_penggajian($IDPenggajian, $IDSales, $tanggal, $gaji_diambil) {
        $data = array(
            "IDPenggajian" => $IDPenggajian,
            "IDSales" => $IDSales,
            "tanggal" => strftime("%Y-%m-%d", strtotime($tanggal)),
            "total_gaji" => $gaji_diambil
        );
        $this->db->insert("detail_penggajian", $data);

        $penggajian = $this->db->get_where("laporan_penggajian", array("IDPenggajian" => $IDPenggajian))->row();
        $data = array(
            "totalPenggajian" => ($penggajian->totalPenggajian + $gaji_diambil)
        );
        $this->db->where("IDPenggajian", $IDPenggajian);
        $this->db->update("laporan_penggajian", $data);

        $admin = $this->db->query("SELECT c.IDCabang, c.saldo FROM admin a INNER JOIN cabang c ON c.IDAdmin_kantor = a.IDAdmin WHERE a.username = '" . $this->session->userdata('Username') . "'")->row();
        $saldo = $admin->saldo - $gaji_diambil;
        $data = array(
            'saldo' => $saldo
        );
        $this->db->where("IDCabang", $admin->IDCabang);
        $this->db->update("cabang", $data);

        $sales = $this->db->get_where("sales", array("IDSales" => $IDSales))->row();
        $data = array("totalGaji" => ($sales->totalGaji - $gaji_diambil));
        $this->db->where("IDSales", $IDSales);
        $this->db->update("sales", $data);
    }

    function setor_bank() {
        $IDCabang = $this->input->post("IDCabang");
        $saldo = $this->input->post("saldo_admin");
        $total_setor = $this->input->post("total_setor");
        $keterangan = $this->input->post("keterangan");
        $tanggal = $this->input->post("tanggal");

        $data = array(
            "tanggal" => strftime("%Y-%m-%d", strtotime($tanggal)),
            "jumlah" => $total_setor,
            "keterangan" => $keterangan,
            "IDCabang" => $IDCabang
        );
        $this->db->insert("setoran_bank", $data);

        $IDJurnal = $this->db->insert_id();

        $this->load->model('Jurnal_model');
        $array = array(
            "saldo" => ($saldo - $total_setor)
        );
        $this->db->where("IDCabang", $IDCabang);
        $this->db->update('cabang', $array);

        $this->Jurnal_model->insert_jurnal_pengeluaran($IDJurnal, 'Setor Kas Bank', $total_setor);
        $this->Jurnal_model->insert_jurnal_pengeluaran($IDJurnal, 'Terima Setoran Bank', $total_setor, FALSE);
    }

    function tarik_kas_bank() {
        $IDCabang = $this->input->post("IDCabang");
        $saldo = $this->input->post("saldo_admin");
        $saldo_cabang = $this->db->get_where("cabang", array("IDCabang" => $IDCabang))->row()->saldo;
        $total_setor = $this->input->post("total_setor");
        $keterangan = $this->input->post("keterangan");
        $tanggal = $this->input->post("tanggal");

        $data = array(
            "tanggal" => strftime("%Y-%m-%d", strtotime($tanggal)),
            "jumlah" => $total_setor,
            "keterangan" => $keterangan,
            "IDCabang" => $IDCabang
        );
        $this->db->insert("tarik_kas_bank", $data);

        $IDJurnal = $this->db->insert_id();

        $this->load->model('Jurnal_model');
        $array = array(
            "saldo" => ($saldo_cabang + $total_setor)
        );
        $this->db->where("IDCabang", $IDCabang);
        $this->db->update('cabang', $array);

        $this->Jurnal_model->insert_jurnal_pengeluaran($IDJurnal, 'Tarik Kas Bank', $total_setor);
        $this->Jurnal_model->insert_jurnal_pengeluaran($IDJurnal, 'Terima Penarikan Kas Bank', $total_setor, FALSE);
    }

    function buat_pembatalan_nota() {
        $IDCabang = $this->session->userdata("IDCabang");
        $penjualan = $this->db->get_where("laporan_penjualan", array("IDPenjualan" => $this->input->post("IDPenjualan")))->row();

        $data = array(
            "tanggal" => strftime("%Y-%m-%d", strtotime($this->input->post("tanggal"))),
            "total" => $penjualan->totalPenjualan,
            "keterangan" => $this->input->post("keterangan"),
            "IDPenjualan" => $penjualan->IDPenjualan
        );
        $this->db->insert("laporan_pembatalan_penjualan", $data);

        $IDJurnal = $this->db->insert_id();

        $juals = $this->db->get_where("jual", array("IDPenjualan" => $penjualan->IDPenjualan))->result();
        foreach ($juals as $jual) {
            $sql = "SELECT * FROM cabang_barang WHERE IDCabang = $IDCabang AND IDBarang = $jual->IDBarang;";
            $cabang_barang = $this->db->query($sql)->row();
            $data = array(
                "jumlah" => ($cabang_barang->jumlah + $jual->jumlah)
            );
            $this->db->where("IDCabang", $IDCabang);
            $this->db->where("IDBarang", $jual->IDBarang);
            $this->db->update("cabang_barang", $data);
        }
        
        $cabang = $this->db->get_where("cabang", array("IDCabang" => $IDCabang))->row();
        $data = array(
            "saldo" => ($cabang->saldo - $penjualan->totalPenjualan)
        );
        $this->db->where("IDCabang", $IDCabang);
        $this->db->update("cabang", $data);
        
        $this->Jurnal_model->insert_jurnal($IDJurnal, 'Pembatalan Penjualan');
    }

}
