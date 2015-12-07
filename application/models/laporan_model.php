<?php

class Laporan_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
        $this->load->helper('string');
        $this->load->helper('date');
    }

    function get_cabang_id($idCabang) {
        if ($idCabang == 0) {
            return "Semua Cabang";
        } else {
            $res = $this->db->get_where("cabang", array('IDCabang' => $idCabang))->row();
            return $res->provinsi . " - " . $res->kabupaten;
        }
    }

    function select_laporan() {
        $sql = "";
        if ($this->session->userdata("Level") == 0) {
            $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi, lp.status_kas
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin";
            if ($this->input->post("btn_pilih")) {
                if ($this->input->post("cabang") != 0) {
                    $sql.= " WHERE c.IDCabang = " . $this->input->post("cabang") . ";";
                }
            }
        } else if ($this->session->userdata("Level") == 1) {
            $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi, lp.status_kas
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin WHERE a.username = '" . $this->session->userdata("Username") . "'";
        } else if ($this->session->userdata("Level") == 2) {
            $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi, lp.status_kas
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin_kantor WHERE a.username = '" . $this->session->userdata("Username") . "'";
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    function select_laporan_pembatalan() {
        $sql = "";
        if ($this->session->userdata("Level") == 0) {
            $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi, lp.status_kas
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin";
            if ($this->input->post("btn_pilih")) {
                if ($this->input->post("cabang") != 0) {
                    $sql.= " WHERE c.IDCabang = " . $this->input->post("cabang") . " AND lp.status_kas = 0 AND AND lp.IDPenjualan NOT IN (SELECT lb.IDPenjualan FROM laporan_pembatalan_penjualan lb);";
                } else {
                    $sql .= "WHERE lp.status_kas = 0 AND lp.IDPenjualan NOT IN (SELECT lb.IDPenjualan FROM laporan_pembatalan_penjualan lb);";
                }
            }
            else {
                $sql .= "WHERE lp.status_kas = 0 AND lp.IDPenjualan NOT IN (SELECT lb.IDPenjualan FROM laporan_pembatalan_penjualan lb);";
            }
        } else if ($this->session->userdata("Level") == 1) {
            $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi, lp.status_kas
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin WHERE a.username = '" . $this->session->userdata("Username") . "' AND lp.status_kas = 0 AND lp.IDPenjualan NOT IN (SELECT lb.IDPenjualan FROM laporan_pembatalan_penjualan lb);";
        } else if ($this->session->userdata("Level") == 2) {
            $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi, lp.status_kas
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin_kantor WHERE a.username = '" . $this->session->userdata("Username") . "' AND lp.status_kas = 0 AND lp.IDPenjualan NOT IN (SELECT lb.IDPenjualan FROM laporan_pembatalan_penjualan lb);";
        }
        
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_saldo_kantor($IDCabang) {
        $sql = "SELECT s.*, c.provinsi, c.kabupaten
                FROM setoran_bank s
                INNER JOIN cabang c ON c.IDCabang = s.IDCabang
                WHERE c.IDCabang = " . $IDCabang . ";";
        return $this->db->query($sql)->result();
    }

    function get_saldo_kas_bank($IDCabang) {
        $sql = "SELECT t.*, c.provinsi, c.kabupaten
                FROM tarik_kas_bank t
                INNER JOIN cabang c ON c.IDCabang = t.IDCabang
                WHERE c.IDCabang = " . $IDCabang . ";";
        return $this->db->query($sql)->result();
    }

    function select_laporan_periode($awal, $akhir) {
        if ($this->input->post("cabang")) {
//            echo $this->input->post("cabang"); exit;
            if ($this->input->post("cabang") == 0) {
                $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin
                Where DATE(tanggal) BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'";
            } else {
                $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin
                Where DATE(tanggal) BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "' AND c.IDCabang = " . $this->input->post("cabang");
            }
        } else {
            $sql = "SELECT lp.IDPenjualan as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, lp.keterangan as keterangan, a.username as username, lp.totalPenjualan as totalPenjualan, lp.totalKomisi as totalKomisi
                FROM cabang c
                INNER JOIN laporan_penjualan lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin
                Where DATE(tanggal) BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    function select_laporan_pengeluaran() {
        $sql = "";
        if ($this->session->userdata("Level") == 0) {
            $sql = "SELECT lp.IDPengeluaran as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, a.username as username, lp.totalPengeluaran as totalPengeluaran
                FROM cabang c
                INNER JOIN laporan_pengeluaran lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin";
            if ($this->input->post("btn_pilih")) {
                if ($this->input->post("cabang") != 0) {
                    $sql.= " WHERE c.IDCabang = " . $this->input->post("cabang") . ";";
                }
            }
        } else if ($this->session->userdata("Level") == 1) {
            $sql = "SELECT lp.IDPengeluaran as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, a.username as username, lp.totalPengeluaran as totalPengeluaran
                FROM cabang c
                INNER JOIN laporan_pengeluaran lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin WHERE a.username = '" . $this->session->userdata("Username") . "'";
        } else if ($this->session->userdata("Level") == 2) {
            $sql = "SELECT lp.IDPengeluaran as idlaporan, lp.IDCabang as idcabang, lp.tanggal as tanggal, a.username as username, lp.totalPengeluaran as totalPengeluaran
                FROM cabang c
                INNER JOIN laporan_pengeluaran lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin_kantor WHERE a.username = '" . $this->session->userdata("Username") . "'";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_laporan_gaji() {
        if ($this->session->userdata("Level") == 0) {
            $sql = "SELECT lp.*, c.provinsi, c.kabupaten, a.IDAdmin, c.saldo, a.username
                FROM cabang c
                INNER JOIN laporan_penggajian lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin_kantor 
                WHERE lp.keterangan = 'gaji' ";
            if ($this->input->post("btn_submit")) {
                if ($this->input->post("cabang")) {
                    $sql.= "AND c.IDCabang = " . $this->input->post('cabang') . ";";
                }
            }
        } else {
            $sql = "SELECT lp.*, c.provinsi, c.kabupaten, a.IDAdmin, c.saldo, a.username
                FROM cabang c
                INNER JOIN laporan_penggajian lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin_kantor 
                WHERE a.username = '" . $this->session->userdata("Username") . "' AND lp.keterangan = 'gaji';";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    function cek_laporan_per_tanggal() {
        date_default_timezone_set('Asia/Jakarta');
        $isValue = "0";

        $tanggal_laporan = strftime("%Y-%m-%d", strtotime($this->input->post("tanggal")));

        $sql = "Select * From laporan_penjualan  Where tanggal = '$tanggal_laporan'";
        $result = $this->db->query($sql);

        if ($result->num_rows() > 0) {
            $isValue = "1";
        }

        return $isValue;
    }

    function get_laporan_gaji_id($IDLaporan) {
        return $this->db->get_where("laporan_penggajian", array("IDPenggajian" => $IDLaporan))->row();
    }

    function get_detail_laporan_gaji($IDLaporan) {
        $sql = "SELECT dp.*, s.IDSales, s.nama, s.totalGaji
                FROM detail_penggajian dp
                INNER JOIN sales s ON s.IDSales = dp.IDSales
                WHERE dp.IDPenggajian = $IDLaporan;";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_sales($IDSales) {
        return $this->db->get_where("sales", array("IDSales" => $IDSales))->row();
    }

    function get_barang($IDBarang) {
        return $this->db->get_where("barang", array("IDBarang" => $IDBarang))->row();
    }

    function get_lokasi($IDLokasi) {
        return $this->db->query("SELECT l.IDLokasi as id_lokasi, l.desa, l.kecamatan as lokasi
                                FROM cabang c
                                INNER JOIN lokasi l ON l.IDCabang = c.IDCabang 
                                WHERE l.IDLokasi = $IDLokasi")->row();
    }

    function get_stok_cabang($username) {
        $cabang = $this->db->query("SELECT c.IDCabang FROM cabang c INNER JOIN admin a ON a.IDAdmin = c.IDAdmin WHERE a.username = '" . $username . "';")->row();
        $sql = "SELECT b.IDBarang, b.namaBarang, cb.jumlah FROM cabang c INNER JOIN cabang_barang cb ON cb.IDCabang = c.IDCabang INNER JOIN barang b ON b.IDBarang = cb.IDBarang WHERE c.IDCabang = " . $cabang->IDCabang;
        return $this->db->query($sql)->result();
    }

    function select_top_sales() {
        $sql = "SELECT * 
                FROM(Select s.nama as nama, s.foto as foto, (Select SUM(j1.hargaJual) 
			FROM jual as j1
			Where j1.IDSales = j.IDSales) as totalpenjualan
                FROM sales s
                INNER JOIN jual as j ON j.IDSales = s.IDSales
                INNER JOIN laporan_penjualan as lp ON lp.IDPenjualan = j.IDPenjualan
                GROUP BY s.IDSales) as table1 
                ORDER BY table1.totalpenjualan DESC";
//        echo $sql; exit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    function select_top_sales_periode($awal, $akhir) {
        $awal = strftime("%Y-%m-%d", strtotime($awal));
        $akhir = strftime("%Y-%m-%d", strtotime($akhir));
        $sql = "Select s.nama as nama, (Select SUM(j1.hargaJual) 
			FROM jual as j1
			Where j1.IDSales = j.IDSales) as totalpenjualan
                FROM sales s
                INNER JOIN jual as j ON j.IDSales = s.IDSales
                INNER JOIN laporan_penjualan as lp ON lp.IDPenjualan = j.IDPenjualan
                Where DATE(lp.tanggal) BETWEEN '$awal' AND '$akhir'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /* Daniel */

    function select_all_pengeluaran($awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        $sql = "SELECT * 
                from ((
                        SELECT laporan_pengeluaran.IDCabang as IDCabang,laporan_pengeluaran.tanggal, detail_pengeluaran.keterangan as keterangan, SUM(detail_pengeluaran.total_pengeluaran) as jumlah, detail_pengeluaran.keterangan_lanjut
                        FROM detail_pengeluaran 
                        INNER JOIN laporan_pengeluaran on laporan_pengeluaran.IDPengeluaran = detail_pengeluaran.IDPengeluaran
                        GROUP BY keterangan, keterangan_lanjut, tanggal) 
                        UNION (
                        SELECT laporan_penggajian.IDCabang as IDCabang, detail_penggajian.Tanggal, CONCAT(laporan_penggajian.keterangan,' ', sales.nama) as keterangan, detail_penggajian.total_gaji as jumlah, '' as keterangan_lanjut
                        FROM detail_penggajian 
                        INNER JOIN sales on sales.IDSales = detail_penggajian.IDSales 
                        INNER JOIN laporan_penggajian ON laporan_penggajian.IDPenggajian = detail_penggajian.IDPenggajian) 
                        ORDER BY tanggal DESC) as table1 ";
        if ($awal && $akhir) {
            $sql.=" WHERE table1.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else if ($bulan) {
            $sql.=" WHERE month(table1.tanggal) = $bulan AND year(table1.tanggal) = year(now()) ";
        } else {
            $sql.=" WHERE month(table1.tanggal) = month(now()) AND year(table1.tanggal) = year(now()) ";
        }
        if ($this->input->post("cabang")) {
            if ($this->input->post("cabang") != 0) {
                $sql.=" AND table1.IDCabang = " . $this->input->post("cabang");
            }
        } else if ($this->session->userdata('Level') != 0) {
            $sql.=" AND table1.IDCabang = " . $this->session->userdata('IDCabang') . " ";
        }
//        print_r($sql);exit;                
        return $this->db->query($sql)->result();
    }

    function select_lain_lain($awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        $sql = "SELECT laporan_pengeluaran.tanggal, detail_pengeluaran.keterangan, SUM(detail_pengeluaran.total_pengeluaran) as jumlah, detail_pengeluaran.keterangan_lanjut FROM detail_pengeluaran INNER JOIN laporan_pengeluaran on laporan_pengeluaran.IDPengeluaran = detail_pengeluaran.IDPengeluaran ";
        if ($awal && $akhir) {
            $sql.=" WHERE tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else if ($bulan) {
            $sql.=" WHERE month(tanggal) = $bulan AND year(tanggal) = year(now()) ";
        } else {
            $sql.=" WHERE month(tanggal) = month(now()) AND year(tanggal) = year(now()) ";
        }
        if ($this->input->post("cabang")) {
            if ($this->input->post("cabang") != 0) {
                $sql.=" AND laporan_pengeluaran.IDCabang = " . $this->input->post("cabang");
            }
        } else if ($this->session->userdata('Level') != 0) {
            $sql.=" AND laporan_pengeluaran.IDCabang = " . $this->session->userdata('IDCabang') . " ";
        }
        $sql.= " AND detail_pengeluaran.keterangan NOT IN ('Bensin', 'Makan', 'Parkir', 'Tol') GROUP BY keterangan, laporan_pengeluaran.tanggal, keterangan_lanjut ORDER BY tanggal DESC";
//        print_r($sql);
//        exit;
        return $this->db->query($sql)->result();
    }

    function select_gaji($jenis, $awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        if ($this->input->post("cabang")) {
            $sql = "SELECT '' as keterangan_lanjut, detail_penggajian.Tanggal as tanggal, CONCAT(lp.keterangan, ' ', sales.nama) as keterangan, detail_penggajian.total_gaji as jumlah FROM detail_penggajian INNER JOIN sales on sales.IDSales = detail_penggajian.IDSales INNER JOIN laporan_penggajian lp ON lp.IDPenggajian = detail_penggajian.IDPenggajian ";
        } else {
            $sql = "SELECT '' as keterangan_lanjut, detail_penggajian.Tanggal as tanggal, CONCAT(lp.keterangan, ' ', sales.nama) as keterangan, detail_penggajian.total_gaji as jumlah FROM detail_penggajian INNER JOIN sales on sales.IDSales = detail_penggajian.IDSales INNER JOIN laporan_penggajian lp ON lp.IDPenggajian = detail_penggajian.IDPenggajian ";
        }
        if ($awal && $akhir) {
            $sql.=" WHERE tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else if ($bulan) {
            $sql.=" WHERE month(detail_penggajian.tanggal) = $bulan AND year(detail_penggajian.tanggal) = year(now()) ";
        } else {
            $sql.=" WHERE month(detail_penggajian.tanggal) = month(now()) AND year(detail_penggajian.tanggal) = year(now()) ";
        }
        if ($this->input->post("cabang")) {
            if ($this->input->post("cabang") != 0) {
                $sql.=" AND lp.IDCabang = " . $this->input->post("cabang");
            }
        } else if ($this->session->userdata('Level') != 0) {
            $sql.=" AND lp.IDCabang = " . $this->session->userdata('IDCabang') . " ";
        }
        $sql.= "AND lp.keterangan = '$jenis' ORDER BY tanggal DESC";
//        print_r($sql); exit;
        return $this->db->query($sql)->result();
    }

    function select_per_jenis($jenis, $awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        $sql = "SELECT laporan_pengeluaran.tanggal, SUM(detail_pengeluaran.total_pengeluaran) as jumlah FROM detail_pengeluaran INNER JOIN laporan_pengeluaran on laporan_pengeluaran.IDPengeluaran = detail_pengeluaran.IDPengeluaran ";
        if ($awal && $akhir) {
            $sql.=" WHERE tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else if ($bulan) {
            $sql.=" WHERE month(tanggal) = $bulan AND year(tanggal) = year(now()) ";
        } else {
            $sql.=" WHERE month(tanggal) = month(now()) AND year(tanggal) = year(now()) ";
        }
        if ($this->input->post("cabang")) {
            if ($this->input->post("cabang") != 0) {
                $sql.=" AND laporan_pengeluaran.IDCabang = " . $this->input->post("cabang") . " ";
            }
        } else if ($this->session->userdata('Level') != 0) {
            $sql.=" AND laporan_pengeluaran.IDCabang = " . $this->session->userdata('IDCabang') . " ";
        }
        $sql.= "AND detail_pengeluaran.keterangan = '$jenis' GROUP BY tanggal ORDER BY tanggal DESC";
//        print_r($sql); exit;
        return $this->db->query($sql)->result();
    }

}
