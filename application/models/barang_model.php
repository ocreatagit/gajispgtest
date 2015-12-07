<?php

class Barang_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
        $this->load->helper('string');
    }

    function tambah_barang_baru() {
        $result = $this->db->query("SELECT * FROM barang WHERE namaBarang = '" . trim($this->input->post("nama_barang")) . "'");
        if ($result->num_rows() == 0) {
            $data = array(
                'namaBarang' => trim($this->input->post("nama_barang"))
            );
            $this->db->insert('barang', $data);
            $kembali = $this->db->insert_id();
            //set default konversi lusin ke pcs
            $data = array(
                'IDBarang' => $kembali,
                'IDSatuan1' => 1,
                'IDSatuan2' => 2,
                'total_konversi' => 12
            );
            $this->db->insert('satuan_unit', $data);
            $this->session->set_flashdata("status", "Barang Telah Ditambahkan!");
            return $kembali;
        } else {
            $this->session->set_flashdata("status", "Barang '" . $this->input->post("nama_barang") . "' Telah DiDaftarkan!");
            return 0;
        }
    }

    function get_all_barang($sortby = NULL, $urutan = NULL) {
        $this->db->order_by(($sortby == NULL ? 'IDBarang' : $sortby), ($urutan == NULL ? 'ASC' : $urutan));
        return $this->db->get('barang')->result();
    }

    function get_detail_barang($IDBarang) {
        return $this->db->get_where("barang", array("IDBarang" => $IDBarang))->row();
    }

    function get_status($IDBarang) {
        $sql = "SELECT IDBarang FROM cabang_barang WHERE IDBarang = $IDBarang UNION SELECT IDBarang FROM jual WHERE IDBarang = $IDBarang;";
        $res = $this->db->query($sql);
        if ($res->num_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function delete_barang($IDBarang) {
        $result = $this->db->query("SELECT * FROM barang WHERE IDBarang = $IDBarang;");
        if ($result->num_rows() == 0) {
            $this->session->set_flashdata("status", "Barang Tidak Ditemukan dalam System!");
        } else {
            $sql = "SELECT IDBarang FROM cabang_barang WHERE IDBarang = $IDBarang UNION SELECT IDBarang FROM jual WHERE IDBarang = $IDBarang;";
            $res = $this->db->query($sql);
            if ($res->num_rows() == 0) {
                $this->db->where("IDBarang", $IDBarang);
                $this->db->delete("barang");
                $this->session->set_flashdata("status", "Barang Telah DiHapus!");
            } else {
                $this->session->set_flashdata("status", "<b>Barang Tidak Dapat DiHapus! </b> Barang ini sudah digunakan Laporan Harian");
            }
        }
    }

    function edit_barang() {
        $result = $this->db->query("SELECT * FROM barang WHERE namaBarang = '" . trim($this->input->post("nama_barang")) . "' AND IDBarang != " . trim($this->input->post("IDBarang")));
        if ($result->num_rows() == 0) {
            $data = array(
                "namaBarang" => trim($this->input->post("nama_barang"))
            );
            $this->db->where("IDBarang", trim($this->input->post("IDBarang")));
            $this->db->update("barang", $data);
            return $this->input->post("IDBarang");
        } else {
            $this->session->set_flashdata("status", "Barang '" . $this->input->post("nama_barang") . "' Telah DiDaftarkan!");
            return 0;
        }
    }

    function tambah_barang_lokasi($IDLokasi, $IDBarang, $jumlah) {
        $stokLama = $this->db->get_where("cabang_barang", array("IDCabang" => $IDLokasi, "IDBarang" => $IDBarang));
        if ($stokLama->num_rows() == 0) {
            $data = array(
                'IDCabang' => $IDLokasi,
                'IDBarang' => $IDBarang,
                'jumlah' => $jumlah
            );
            return $this->db->insert('cabang_barang', $data);
        } else {
            $temp = $stokLama->row();
            $this->db->set('jumlah', $jumlah + $temp->jumlah);
            $this->db->where('IDCabang', $IDLokasi);
            $this->db->where('IDBarang', $IDBarang);
            return $this->db->update('cabang_barang');
        }
    }

    function update_barang_lokasi($IDLokasi, $IDBarang, $jumlah) {
        $this->db->set('jumlah', $jumlah);
        $this->db->where('IDCabang', $IDLokasi);
        $this->db->where('IDBarang', $IDBarang);
        $this->db->update('cabang_barang');
    }

    function get_barang() {
        return $this->db->get("barang")->result();
    }

    function get_barang_cabang($IDCabang) {
        $sql = "SELECT * FROM cabang c INNER JOIN cabang_barang l ON l.IDCabang = c.IDCabang INNER JOIN barang b ON b.IDBarang = l.IDBarang WHERE c.IDCabang = " . $IDCabang . ";";
        return $this->db->query($sql)->result();
    }

    function total_per_team_leader($cart) {
        $array = array();
        foreach ($cart as $contents) {
            if (strpos($contents["id"], "Jual") !== FALSE) {
                $sql = "Select b.namaBarang as namabarang,
                    SUM(j.jumlah) as jumlah, s1.nama as namaTeamLeader
                    From jual j
                    INNER JOIN sales s ON s.IDSales = j.IDSales
                    INNER JOIN sales s1 ON s1.IDSales = j.IDTeamLeader
                    INNER JOIN barang b ON j.IDBarang = b.IDBarang
                    Where s1.IDSales = " . $contents["options"]["IDTeamLeader"] . " AND s.IDSales = " . $contents["options"]["IDSales"] . " AND b.IDBarang = " . $contents["options"]["IDBarang"] . "
                    GROUP BY b.namaBarang, s1.nama 
                    ORDER BY s1.nama ASC";
                array_push($array, $this->db->query($sql)->row());
            }
        }
//        print_r($array); 
//        exit;
        return $array;
    }

    /* DANIEL */

    function select_top_barang($awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        $sql = "SELECT barang.namaBarang, sum(jual.jumlah) as jumlah FROM `jual` INNER JOIN barang ON barang.IDBarang = jual.IDBarang INNER JOIN laporan_penjualan ON laporan_penjualan.IDPenjualan = jual.IDPenjualan INNER JOIN cabang ON cabang.IDCabang = laporan_penjualan.IDCabang INNER JOIN admin ON admin.IDAdmin = cabang.IDAdmin";
        if ($awal && $akhir) {
            $sql.=" WHERE laporan_penjualan.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else if ($bulan) {
            $sql.=" WHERE month(laporan_penjualan.tanggal) = $bulan AND year(laporan_penjualan.tanggal) = year(now()) ";
        } else {
            $sql.=" WHERE month(laporan_penjualan.tanggal) = month(now()) AND year(laporan_penjualan.tanggal) = year(now()) ";
        }
        if ($this->input->post('cabang') != 0) {
            $sql.=" AND laporan_penjualan.IDCabang = " . $this->input->post('cabang');
        } else if ($this->session->userdata('Level') != 0) {
            $sql.=" AND laporan_penjualan.IDCabang = " . $this->session->userdata('IDCabang') . " ";
        }
        $sql.=" GROUP BY jual.IDBarang ORDER BY jumlah DESC LIMIT 15 ";
        return $this->db->query($sql)->result();
    }

    function get_all_admincabang() {
        return $this->db->query('SELECT cabang.IDCabang, cabang.provinsi, cabang.kabupaten FROM cabang INNER JOIN admin ON cabang.IDAdmin = admin.IDAdmin ORDER BY cabang.IDCabang')->result();
    }

    function select_top_lokasi($awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        $sql = "SELECT jual.IDLokasi, lokasi.desa, SUM(jual.hargaJual) as jumlah FROM jual INNER JOIN lokasi ON lokasi.IDLokasi = jual.IDLokasi INNER JOIN laporan_penjualan on laporan_penjualan.IDPenjualan = jual.IDPenjualan ";
        if ($awal && $akhir) {
            $sql.=" WHERE laporan_penjualan.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else if ($bulan) {
            $sql.=" WHERE month(laporan_penjualan.tanggal) = $bulan AND year(laporan_penjualan.tanggal) = year(now()) ";
        } else {
            $sql.=" WHERE month(laporan_penjualan.tanggal) = month(now()) AND year(laporan_penjualan.tanggal) = year(now()) ";
        }
        if ($this->input->post("cabang")) {
            if ($this->input->post("cabang") != 0) {
                $sql.=" AND laporan_penjualan.IDCabang = " . $this->input->post("cabang") . " ";
            }
        } else if ($this->session->userdata('Level') != 0) {
            $sql.=" AND laporan_penjualan.IDCabang = " . $this->session->userdata('IDCabang') . " ";
        }
        $sql.= " GROUP BY jual.IDLokasi ORDER BY jumlah DESC LIMIT 15";
        return $this->db->query($sql)->result();
    }

    function select_top_seles($awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        $sql = "SELECT sales.IDSales, sales.nama, sales.foto, SUM(jual.hargaJual) as jumlah FROM jual INNER JOIN sales on sales.IDSales = jual.IDSales INNER JOIN laporan_penjualan on laporan_penjualan.IDPenjualan = jual.IDPenjualan ";
        if ($awal && $akhir) {
            $sql.=" WHERE laporan_penjualan.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else if ($bulan) {
            $sql.=" WHERE month(laporan_penjualan.tanggal) = $bulan AND year(laporan_penjualan.tanggal) = year(now()) ";
        } else {
            $sql.=" WHERE month(laporan_penjualan.tanggal) = month(now()) AND year(laporan_penjualan.tanggal) = year(now()) ";
        }
        if ($this->input->post("cabang")) {
            if ($this->input->post("cabang") != 0) {
                $sql.=" AND laporan_penjualan.IDCabang = " . $this->input->post("cabang") . " ";
            }
        } else if ($this->session->userdata('Level') != 0) {
            $sql.=" AND laporan_penjualan.IDCabang = " . $this->session->userdata('IDCabang') . " ";
        }
        $sql.= " GROUP BY sales.IDSales ORDER BY jumlah DESC LIMIT 15";
        return $this->db->query($sql)->result();
    }

    function select_top_lokasi_barang($arr, $awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        $sql = "SELECT jual.IDLokasi, lokasi.desa, jual.IDBarang, barang.namaBarang, sum(jual.jumlah) AS jumlah FROM jual LEFT JOIN laporan_penjualan on laporan_penjualan.IDPenjualan = jual.IDPenjualan LEFT JOIN barang on barang.IDBarang = jual.IDBarang LEFT JOIN lokasi on lokasi.IDLokasi = jual.IDLokasi ";
        if ($awal && $akhir) {
            $sql.=" WHERE laporan_penjualan.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else if ($bulan) {
            $sql.=" WHERE month(laporan_penjualan.tanggal) = $bulan AND year(laporan_penjualan.tanggal) = year(now()) ";
        } else {
            $sql.=" WHERE month(laporan_penjualan.tanggal) = month(now()) AND year(laporan_penjualan.tanggal) = year(now()) ";
        }
        if (count($arr) > 0) {
            $sql .= " AND jual.IDLokasi IN( $arr[0] ";
            for ($i = 1; $i < count($arr); $i++) {
                $sql .= " , $arr[$i] ";
            }
            $sql .= " ) ";
        } else {
            return;
        }
        if ($this->input->post("cabang")) {
            $sql.=" AND laporan_penjualan.IDCabang = " . $this->input->post("cabang") . " ";
        } else if ($this->session->userdata('Level') != 0) {
            $sql.=" AND laporan_penjualan.IDCabang = " . $this->session->userdata('IDCabang') . " ";
        }
        $sql .= " GROUP BY jual.IDBarang, jual.IDLokasi ORDER BY jual.IDLokasi ASC, jual.IDBarang ASC";
//        print_r($sql);exit;
        return $this->db->query($sql)->result();
    }

    function select_top_sales_barang($arr, $awal = FALSE, $akhir = FALSE, $bulan = FALSE) {
        $data = array();
        foreach ($arr as $id) {
            $sql = "select sales.nama, jual.IDSales, barang.namaBarang, sum(jual.jumlah) as jumlah from jual
                    inner join barang on barang.IDBarang = jual. IDBarang
                    inner join laporan_penjualan lp on lp.IDPenjualan = jual.IDPenjualan 
                    inner join sales on sales.IDSales = jual.IDSales";
            if ($awal && $akhir) {
                $sql.=" WHERE lp.tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
            } else if ($bulan) {
                $sql.=" WHERE month(lp.tanggal) = $bulan AND year(lp.tanggal) = year(now()) ";
            } else {
                $sql.=" WHERE month(lp.tanggal) = month(now()) AND year(lp.tanggal) = year(now()) ";
            }
            $sql .= " and jual.IDSales = $id group by jual.IDBarang ORDER BY jual.IDBarang ASC ";
            array_push($data, $this->db->query($sql)->result());
        }
        //print_r($data);exit;
        return $data;
    }

    function insert_harga_satuan($IDBarang = FALSE) {
        if ($IDBarang) {
            if ($this->db->get_where('harga_satuan', array('IDBarang' => $IDBarang))->num_rows() > 0) {
                $this->db->where('IDBarang', $IDBarang);
                $this->db->delete('harga_satuan');
            }
            $satuan[1] = $this->input->post("hargaPcs");
            $satuan[2] = $this->input->post("hargaLusin");
            $satuan[3] = $this->input->post("hargaKarton");
            $data = array();
            for ($i = 1; $i <= 3; $i++) {
                array_push($data, array(
                    'IDBarang' => $IDBarang,
                    'IDSatuan' => $i,
                    'harga_konversi' => $satuan[$i]));
            }
            $this->db->insert_batch('harga_satuan', $data);
            $this->session->set_flashdata("status", "Harga Telah Disimpan!");
        }
    }

    function get_harga_satuan() {
        return $this->db->query('SELECT * FROM harga_satuan WHERE harga_satuan.IDBarang in (SELECT barang.IDBarang FROM barang) ORDER BY harga_satuan.IDBarang ASC, harga_satuan.IDSatuan DESC')->result();
    }

    function get_satuan() {
        return $this->db->query('SELECT * FROM satuan_unit WHERE IDSatuan1 = 3 ORDER BY IDBarang ASC')->result();
    }

    function insert_satuan($IDBarang = FALSE) {
        if ($IDBarang) {
            if ($this->db->get_where('satuan_unit', array('IDBarang' => $IDBarang, 'IDSatuan1' => '3'))->num_rows() > 0) {
                $this->db->where('IDBarang', $IDBarang);
                $this->db->where('IDSatuan1', 3);
                $this->db->delete('satuan_unit');
            }
            $data = array(
                'IDBarang' => $IDBarang,
                'IDSatuan1' => 3,
                'IDSatuan2' => 2,
                'total_konversi' => $this->input->post('satuan')
            );
            $this->db->insert('satuan_unit', $data);
        }
    }

    /* DANIEL */
}
