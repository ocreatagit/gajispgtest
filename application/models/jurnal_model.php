<?php

class Jurnal_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
        $this->load->helper('string');
        $this->load->helper('date');
    }

    function get_kas() {
        $this->load->model('Admin_model');
        $IDCabang = $this->Admin_model->get_cabang($this->session->userdata("Username"));
        $sql = "";
        if ($this->session->userdata("Level") == 0) {
            $sql = "Select c.saldo as saldo From cabang c WHERE c.IDCabang = " . $IDCabang . ";";
            $query = $this->db->query($sql);
        } else if ($this->session->userdata("Level") == 1) {
            $sql = "Select nilai_akun as saldo From akun_cabang ac WHERE ac.IDCabang = " . $IDCabang . " AND IDAkun = 1;";
            $query = $this->db->query($sql);
        } else {
            $sql = "Select nilai_akun as saldo From akun_cabang ac WHERE ac.IDCabang = " . $IDCabang . " AND IDAkun = 2;";
            $query = $this->db->query($sql);
        }
        return $query->row()->saldo;
    }

    function get_kas_bank() {
        $this->load->model('Admin_model');
        $IDCabang = $this->Admin_model->get_cabang($this->session->userdata("Username"));
        $sql = "Select nilai_akun as saldo From akun_cabang ac WHERE ac.IDCabang = " . $IDCabang . " AND IDAkun = 3;";
        $query = $this->db->query($sql);
        return $query->row()->saldo;
    }

    function select_laporan_mutasi_kas($awal = FALSE, $akhir = FALSE) {
        $this->load->model('Admin_model');
        $IDCabang = $this->Admin_model->get_cabang($this->session->userdata("Username"));

        if ($this->session->userdata("Level") == 0) {
            $sql = "SELECT j.IDJurnal, j.keterangan, j.tanggal, j.sifat, (CASE WHEN j.sifat = 'D' THEN j.nilai_jurnal ELSE 0 END) as kasmasuk, (CASE WHEN j.sifat = 'K' THEN j.nilai_jurnal ELSE 0 END) as kaskeluar
                FROM jurnal j 
                INNER JOIN cabang c ON c.IDCabang = j.IDCabang " . ($awal && $akhir ? "WHERE j.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'" : "") . "
                GROUP BY j.IDJurnal, j.IDCabang;";
        } else {
            $sql = "SELECT j.IDJurnal, j.keterangan, j.tanggal, j.sifat, (CASE WHEN j.sifat = 'D' THEN j.nilai_jurnal ELSE 0 END) as kasmasuk, (CASE WHEN j.sifat = 'K' THEN j.nilai_jurnal ELSE 0 END) as kaskeluar
                FROM jurnal j 
                INNER JOIN cabang c ON c.IDCabang = j.IDCabang 
                WHERE j.IDCabang = $IDCabang AND j.keterangan IN (SELECT t1.keterangan FROM transaksi t1 WHERE t1.level = " . $this->session->userdata("Level") . ") " . ($awal && $akhir ? "AND j.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'" : "" ) .
                    " GROUP BY j.IDJurnal, j.IDCabang;";
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    function select_laporan_mutasi_kas_bank($awal = FALSE, $akhir = FALSE) {
        $this->load->model('Admin_model');
        $IDCabang = $this->Admin_model->get_cabang($this->session->userdata("Username"));
        
        $sql = "SELECT j.IDJurnal, j.keterangan, j.tanggal, j.sifat, (CASE WHEN j.sifat = 'D' THEN j.nilai_jurnal ELSE 0 END) as kasmasuk, (CASE WHEN j.sifat = 'K' THEN j.nilai_jurnal ELSE 0 END) as kaskeluar
                FROM jurnal j 
                INNER JOIN cabang c ON c.IDCabang = j.IDCabang 
                WHERE j.IDCabang = $IDCabang AND j.keterangan IN (SELECT t1.keterangan FROM transaksi t1 WHERE t1.level = 0) " . ($awal && $akhir ? "AND j.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'" : "" ) .
                    " GROUP BY j.IDJurnal, j.IDCabang;";
        
        $query = $this->db->query($sql);
        return $query->result();
    }

    function insert_jurnal($noBukti, $jenis_transaksi, $saldo = TRUE) {
        $this->load->model('Admin_model');
        $IDCabang = $this->Admin_model->get_cabang($this->session->userdata("Username"));

        $penjualan = $this->db->get_where("laporan_penjualan", array('IDPenjualan' => $noBukti))->row();
        $totalPenjualan = $penjualan->totalPenjualan;

        $SQL = "SELECT * FROM transaksi WHERE keterangan = '$jenis_transaksi';";
        $transaksi = $this->db->query($SQL)->row();

        $sql = "SELECT t.IDTransaksi, t.keterangan, a.IDAkun, a.namaAkun, ta.sifat
                FROM transaksi t
                INNER JOIN transaksi_akun ta ON ta.IDTransaksi = t.IDTransaksi
                INNER JOIN akun a ON a.IDAkun = ta.IDAkun 
                WHERE t.keterangan = '$jenis_transaksi';";
        $result = $this->db->query($sql)->result();

        $data = array(
            'IDCabang' => $IDCabang,
            'tanggal' => date('Y-m-d H:i:s'),
            'sifat' => $transaksi->sifat,
            'nilai_jurnal' => $totalPenjualan,
            'keterangan' => $jenis_transaksi
        );
        $this->db->insert('jurnal', $data);

        $IDJurnal = $this->db->insert_id();

        foreach ($result as $trans) {
            $data = array(
                "IDJurnal" => $IDJurnal,
                "IDAkun" => $trans->IDAkun,
                "sifat" => $trans->sifat,
                "nilai" => $totalPenjualan
            );
            $this->db->insert("jurnal_akun", $data);

            $tamp = $this->db->query("SELECT * FROM akun_cabang WHERE IDAkun = " . $trans->IDAkun . " AND IDCabang = $IDCabang;")->row();

            if ($saldo) {
                $data = array(
                    "nilai_akun" => $tamp->nilai_akun + (($totalPenjualan * 1) * ($trans->sifat == 'K' ? -1 : 1))
                );

                $this->db->where("IDAkun", $trans->IDAkun);
                $this->db->where("IDCabang", $IDCabang);
                $this->db->update("akun_cabang", $data);
            }
        }
    }

    function insert_jurnal_pengeluaran($noBukti, $jenis_transaksi, $nilai_transaksi, $saldo = true) {
        $this->load->model('Admin_model');
        $IDCabang = $this->Admin_model->get_cabang($this->session->userdata("Username"));
        $penjualan = array();
        $totalPenjualan = $nilai_transaksi;

        $SQL = "SELECT * FROM transaksi WHERE keterangan = '$jenis_transaksi';";
        $transaksi = $this->db->query($SQL)->row();

        $data = array(
            'IDCabang' => $IDCabang,
            'tanggal' => date('Y-m-d H:i:s'),
            'sifat' => $transaksi->sifat,
            'nilai_jurnal' => $totalPenjualan,
            'keterangan' => $jenis_transaksi
        );
        $this->db->insert('jurnal', $data);
        $IDJurnal = $this->db->insert_id();

        $sql = "SELECT t.IDTransaksi, t.keterangan, a.IDAkun, a.namaAkun, ta.sifat
                FROM transaksi t
                INNER JOIN transaksi_akun ta ON ta.IDTransaksi = t.IDTransaksi
                INNER JOIN akun a ON a.IDAkun = ta.IDAkun 
                WHERE t.keterangan = '$jenis_transaksi';";
        $result = $this->db->query($sql)->result();

        foreach ($result as $trans) {
            $data = array(
                "IDJurnal" => $IDJurnal,
                "IDAkun" => $trans->IDAkun,
                "sifat" => $trans->sifat,
                "nilai" => $totalPenjualan
            );
            $this->db->insert("jurnal_akun", $data);

            $tamp = $this->db->query("SELECT * FROM akun_cabang WHERE IDAkun = " . $trans->IDAkun . " AND IDCabang = $IDCabang;")->row();

            if ($saldo) {
                $data = array(
                    "nilai_akun" => $tamp->nilai_akun + (($totalPenjualan * 1) * ($trans->sifat == 'K' ? -1 : 1))
                );

                $this->db->where("IDAkun", $trans->IDAkun);
                $this->db->where("IDCabang", $IDCabang);
                $this->db->update("akun_cabang", $data);
            }
        }
    }

//    function insert_jurnal_penggajian($noBukti, $jenis_transaksi, $nilai_transaksi) {
//        $this->load->model('Admin_model');
//        $IDCabang = $this->Admin_model->get_cabang($this->session->userdata("Username"));
//        $penjualan = array();
//        $totalPenjualan = $nilai_transaksi;
//
//        $SQL = "SELECT * FROM transaksi WHERE keterangan = '$jenis_transaksi';";
//        $transaksi = $this->db->query($SQL)->row();
//
//        $sql = "SELECT t.IDTransaksi, t.keterangan, a.IDAkun, a.namaAkun, ta.sifat
//                FROM transaksi t
//                INNER JOIN transaksi_akun ta ON ta.IDTransaksi = t.IDTransaksi
//                INNER JOIN akun a ON a.IDAkun = ta.IDAkun 
//                WHERE t.keterangan = '$jenis_transaksi';";
//        $result = $this->db->query($sql)->result();
//
//        $data = array(
//            'IDCabang' => $IDCabang,
//            'tanggal' => date('Y-m-d'),
//            'sifat' => $transaksi->sifat,
//            'nilai_jurnal' => $totalPenjualan,
//            'keterangan' => $jenis_transaksi
//        );
//        $this->db->insert('jurnal', $data);
//
//        $IDJurnal = $this->db->insert_id();
//
//        foreach ($result as $trans) {
//            $data = array(
//                "IDJurnal" => $IDJurnal,
//                "IDAkun" => $trans->IDAkun,
//                "sifat" => $trans->sifat,
//                "nilai" => $totalPenjualan
//            );
//            $this->db->insert("jurnal_akun", $data);
//        }
//    }
}
