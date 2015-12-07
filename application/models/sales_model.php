<?php

class Sales_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
        $this->load->helper('string');
        $this->load->helper('date');
    }

    function get_sales_tiap_admin($username) {
        $sql = "SELECT level FROM admin WHERE username = '$username'";
        $level = $this->db->query($sql)->row()->level;
        if ($level == 1) {
            $sql = "Select s.IDSales as id_sales, s.nama as nama
                    From Sales s
                    INNER JOIN cabang c on c.IDCabang = s.IDCabang
                    INNER JOIN Admin a ON c.IDAdmin = a.IDAdmin
                    WHERE a.Username = '$username' and s.pangkat = 'SPG'";
        } else if ($level == 2) {
            $sql = "Select s.IDSales as id_sales, s.nama as nama
                    From Sales s
                    INNER JOIN cabang c on c.IDCabang = s.IDCabang
                    INNER JOIN Admin a ON c.IDAdmin_kantor = a.IDAdmin
                    WHERE a.Username = '$username' and s.pangkat = 'SPG'";
        } else if ($level == 0) {
            $sql = "Select s.IDSales as id_sales, s.nama as nama
                    From Sales s
                    WHERE s.pangkat = 'SPG'";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_team_leader_tiap_admin($username) {
        $sql = "Select s.IDSales as id_sales, s.nama as nama
                                    From Sales s
                                    INNER JOIN cabang c on c.IDCabang = s.IDCabang
                                    INNER JOIN Admin a ON c.IDAdmin = a.IDAdmin
                                    WHERE a.Username = '$username' AND s.pangkat = 'Team Leader'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_barang_sales() {
        $IDSales = $this->input->post("IDSales");
        $IDBarang = $this->input->post("IDBarang");
        $result = $this->db->get_where("komisi", array("IDSales" => $IDSales, "IDBarang" => $IDBarang));
        if ($result->num_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function insert_sales_jual() {
        $array = array(
            "IDSales" => $this->input->post("IDSales"),
            "IDBarang" => $this->input->post("IDBarang"),
            "jumlah" => $this->input->post("Jumlah"),
            "hargaJual" => $this->input->post("Komisi")
        );
        $this->db->insert("jual", $array);
        if ($this->db->affected_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function get_penjualan_sales() {
        $sql = "SELECT j.*, s.nama, b.namaBarang FROM jual j INNER JOIN sales s ON s.IDSales = j.IDSales 
                INNER JOIN barang b ON b.IDBarang = j.IDBarang";
        $rs = $this->db->query($sql);
        if ($rs->num_rows() == 0) {
            return array();
        } else {
            return $rs->result();
        }
    }

    function get_komisi($data) {
        $array = array();
        foreach ($data as $row) {
            array_push($array, $this->db->get_where("komisi", array("IDSales" => $row->IDSales, "IDBarang" => $row->IDBarang))->row());
        }
        return $array;
//        return ;
    }

    function get_komisi_sales_barang($IDSales, $IDBarang) {
        $query = $this->db->query(" Select k.komisi as komisi
                                    From sales s
                                    INNER JOIN komisi k ON k.IDSales = s.IDSales
                                    INNER JOIN barang b ON k.IDBarang = b.IDBarang
                                    Where k.IDSales = $IDSales AND k.IDBarang = $IDBarang");
        return $query->row()->komisi;
    }

    function get_gaji_sales() {
        $sql = "SELECT totalGaji FROM sales WHERE IDSales = " . $this->input->post("IDSaless");
        return $this->db->query($sql)->row()->totalGaji;
    }

    function tambah_gaji_dan_komisi_sales($IDPenjualan, $IDSales, $nominal_komisi) {
        date_default_timezone_set('Asia/Jakarta');
//        $IDPenjualan = $this->input->post('IDPenjualan');
        /* Tambahkan Gaji & Komisi */
        /* Harus ada pengecekan sudah pernah dapat gaji. */

        /* Ambil Nilai Awal */
//        $sales = $this->input->post("IDSalez");
        $tanggal_laporan = strftime("%Y-%m-%d", strtotime($this->session->userdata("tanggal_jual")));

        $sql = "SELECT gaji, totalGaji, totalKomisi FROM sales WHERE IDSales = " . $IDSales;
        $result = $this->db->query($sql)->row();

        $gaji = $result->gaji;
        $totalgaji = $result->totalGaji;
        $totalkomisi = $result->totalKomisi;
        $tampKomisi = $nominal_komisi;

        /* Catat Total Pengeluaran Komisi */
        $query = "SELECT totalKomisi FROM laporan_penjualan WHERE IDPenjualan = " . $IDPenjualan;
        $hasil = $this->db->query($query)->row(); //
        $current_komisi = $hasil->totalKomisi;

        $current_komisi += ($tampKomisi + 0);

        /* Update Total Komisi Pada Penjualan */
        $data = array("totalKomisi" => ($current_komisi));
        $this->db->where("IDPenjualan", $IDPenjualan);
        $this->db->update('laporan_penjualan', $data);

        /* -- */
        /* Update Total Komisi Pada Sales */
        $data = array("totalKomisi" => ($tampKomisi + $totalkomisi + 0));
        $this->db->where("IDSales", $IDSales);
        $this->db->update('sales', $data);

        /* Masukkan History Komisi */
        /* History Komisi */
        $data = array(
            "IDSales" => $IDSales,
            "Nominal" => $nominal_komisi,
            "Tanggal" => $tanggal_laporan,
            "Keterangan" => "Komisi diperoleh"
        );
        $this->db->insert("historykomisi", $data);
        /* Catat Total Pengeluaran Komisi */



        /* Cek Sudah Pernah Memperoleh Gajian */
        $query = $this->db->query("Select * 
            From historygaji    
            Where Tanggal = '$tanggal_laporan' AND IDSales = '$IDSales'");

        if ($query->num_rows() > 0) {
            /* Sales Ini sudah pernah digaji per tanggal pembuatan laporan */
        } else {
            $data = array("totalGaji" => ($totalgaji + $gaji));
            $this->db->where("IDSales", $IDSales);
            $this->db->update('sales', $data);

            /* History Gaji */
            $data = array(
                "IDSales" => $IDSales,
                "Nominal" => $gaji,
                "Tanggal" => $tanggal_laporan,
                "Keterangan" => "Gaji diperoleh"
            );
            $this->db->insert("historygaji", $data);
        }

        return "1";
    }

    function get_komisi_sales() {
        if ($this->input->post("btn_submit")) {
            $sql = "SELECT totalKomisi FROM sales WHERE IDSales = " . $this->input->post("sales");
        } else {
            $sql = "SELECT totalKomisi FROM sales WHERE IDSales = " . $this->input->post("IDSales");
        }
        $result = $this->db->query($sql)->row();
        return $result->totalKomisi;
    }

    function insert_laporan_komisi() {
        $data = array(
            "IDCabang" => $this->Admin_model->get_cabang($this->session->userdata('Username')),
            "tanggal" => date("Y-m-d"),
            "totalPenggajian" => 0,
            "keterangan" => "komisi"
        );
        $this->db->insert("laporan_penggajian", $data);
        return $this->db->insert_id();
    }

    function update_komisi($IDSales, $komisi_diambil, $IDPenggajian) {
        $data = array(
            "IDPenggajian" => $IDPenggajian,
            "IDSales" => $IDSales,
            "tanggal" => strftime("%Y-%m-%d", strtotime(date("Y-m-d"))),
            "total_gaji" => $komisi_diambil
        );
        $this->db->insert("detail_penggajian", $data);

        $penggajian = $this->db->get_where("laporan_penggajian", array("IDPenggajian" => $IDPenggajian))->row();
        $data = array(
            "totalPenggajian" => ($penggajian->totalPenggajian + $komisi_diambil)
        );
        $this->db->where("IDPenggajian", $IDPenggajian);
        $this->db->update("laporan_penggajian", $data);

        $admin = $this->db->query("SELECT c.IDCabang, c.saldo FROM admin a INNER JOIN cabang c ON c.IDAdmin_kantor = a.IDAdmin WHERE a.username = '" . $this->session->userdata('Username') . "'")->row();
        $saldo = $admin->saldo - $komisi_diambil;
        $data = array(
            'saldo' => $saldo
        );
        $this->db->where("IDCabang", $admin->IDCabang);
        $this->db->update("cabang", $data);

        $sales = $this->db->get_where("sales", array("IDSales" => $IDSales))->row();
        $data = array("totalKomisi" => ($sales->totalKomisi - $komisi_diambil));
        $this->db->where("IDSales", $IDSales);
        $this->db->update("sales", $data);
    }

    function report_tabel_penjualan($kodejual) {
        $query = $this->db->query("Select b.namaBarang as namabarang, l.desa as namalokasi, s.nama as namasales, 
                                    j.jumlah as jumlah, j.hargaJual as penjualan, s1.nama as namaTeamLeader
                                    From jual j
                                    INNER JOIN sales s ON s.IDSales = j.IDSales
                                    INNER JOIN sales s1 ON s1.IDSales = j.IDTeamLeader
                                    INNER JOIN barang b ON j.IDBarang = b.IDBarang
                                    INNER JOIN lokasi l ON j.IDLokasi = l.IDLokasi
                                    Where j.IDPenjualan = $kodejual");
        return $query->result();
    }
    
    function get_detail_stok_team_leader($kodejual){
        $query = $this->db->query("Select b.namaBarang as namabarang,
                                    SUM(j.jumlah) as jumlah, s1.nama as namaTeamLeader
                                    From jual j
                                    INNER JOIN sales s ON s.IDSales = j.IDSales
                                    INNER JOIN sales s1 ON s1.IDSales = j.IDTeamLeader
                                    INNER JOIN barang b ON j.IDBarang = b.IDBarang
                                    Where j.IDPenjualan = $kodejual
                                    GROUP BY b.namaBarang, s1.nama 
                                    ORDER BY s1.nama ASC
                                    ");
        return $query->result();
    }
                function get_laporan_penjualan($kodejual) {
        $sql = "SELECT * FROM laporan_penjualan lp INNER JOIN cabang c ON c.IDCabang = lp.IDCabang WHERE lp.IDPenjualan = $kodejual;";
        return $this->db->query($sql)->row();
//        return $this->db->get_where("laporan_penjualan", array("IDPenjualan" => $kodejual))->row();
    }

    function get_laporan_pengeluaran($kodejual) {
        $sql = "Select p.IDPengeluaran as IDPengeluaran, total_pengeluaran, keterangan, keterangan_lanjut
                                    FROM detail_pengeluaran p
                                    WHERE p.IDPengeluaran = $kodejual 
                                    UNION 
                                    SELECT b.IDBayarGaji as IDPengeluaran, jumlah, CONCAT('Gaji ', s.nama) as keterangan, '' as keterangan_lanjut
                                    FROM bayar_gaji b
                                    INNER JOIN sales s ON s.IDSales = b.IDSales
                                    WHERE b.IDPenjualan = $kodejual;";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function update_komisi_sales($IDSales, $komisi_diambil) {
        $sales = $this->db->get_where("sales", array("IDSales" => $IDSales))->row();
        $data = array("totalKomisi" => ($sales->totalKomisi - $komisi_diambil));
        $this->db->where("IDSales", $IDSales);
        $this->db->update("sales", $data);
    }

//    function update_total_gaji($IDSales, $gaji_diambil) {
//        $sales = $this->db->get_where("sales", array("IDSales" => $IDSales))->row();
//        $data = array("totalGaji" => ($sales->totalGaji - $gaji_diambil));
//        $this->db->where("IDSales", $IDSales);
//        $this->db->update("sales", $data);
//    }

    /* Daniel */

    function select_sales($IDSales = NULL) {
        $this->db->select("sales.*,cabang.*");
        $this->db->from('sales');
        $this->db->join('cabang', 'sales.IDCabang = cabang.IDCabang');
        if ($IDSales != NULL) {
            $this->db->where('sales.IDSales', $IDSales);
        }
        if ($this->session->userdata("Level") != 0) {
            $this->db->where('sales.IDCabang', $this->session->userdata('IDCabang'));
        }
        if ($this->input->post("btn_submit")) {
            if ($this->input->post('cabang') != 0) {
                $this->db->where('sales.IDCabang', $this->input->post('cabang'));
            }
        }
        $this->db->order_by('IDSales', 'DESC');
        $res = $this->db->get();
//        echo $this->db->last_query();
//        exit;
        return $res->result();
    }

    function insert_sales() {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 12; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        $temp = $str . "sales.jpg";
        $data = array(
            "nama" => $this->input->post("nama"),
            "noTelp" => $this->input->post("notelp"),
            "foto" => $temp,
            "gaji" => $this->input->post("gaji"),
            "tempatLahir" => $this->input->post("tempatLahir"),
            "pangkat" => $this->input->post("pangkat"),
            "tanggalLahir" => date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post("tanggalLahir")))),
            "IDCabang" => $this->session->userdata('IDCabang')
        );

        $this->db->insert("sales", $data);
        $this->session->set_flashdata("status", "Sales Telah Ditambahkan!");

        return array($temp, $this->db->insert_id());
    }

    function insert_komisi($IDSales, $arrBarang) {
        $data = array();
        $counter = 1;
        foreach ($arrBarang as $barang) {
            array_push($data, array(
                'IDSales' => $IDSales,
                'IDBarang' => $barang->IDBarang,
                'komisi' => $this->input->post('KomisiBarang' . $counter)));
            $counter++;
        }
        $this->db->insert_batch('komisi', $data);
    }

    function select_komisi($IDSales) {
        return $this->db->get_where('komisi', array('IDSales' => $IDSales))->result();
    }

    function update_sales($id) {
        date_default_timezone_set("Asia/Jakarta");
        $temp = $this->input->post('fotolama');
        if (!empty($_FILES['foto_sales']['name'])) {
            $str = "";
            $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 12; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            $temp = $str . "sales.jpg";
        }
        $data = array(
            "nama" => $this->input->post("nama"),
            "noTelp" => $this->input->post("notelp"),
            "tempatLahir" => $this->input->post("tempatLahir"),
            "gaji" => $this->input->post("gaji"),
            "pangkat" => $this->input->post("pangkat"),
            "tanggalLahir" => date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post("tanggalLahir")))),
            "foto" => $temp
        );

        $this->db->where('IDSales', $id);
        $this->db->update('sales', $data);
        return $temp;
    }

    function delete_sales($id) {
        $this->db->delete('sales', array('IDSales' => $id));
    }

    function get_idcabang() {
        if ($this->session->userdata("Level") == 1) {
            $this->db->select('IDCabang');
            $this->db->from('admin');
            $this->db->join('cabang', 'cabang.IDAdmin = admin.IDAdmin');
            $this->db->where('admin.username', $this->session->userdata('Username'));
            $hasil = $this->db->get();
            $hasil->num_rows() != 0 ? $this->session->set_userdata('IDCabang', $hasil->row()->IDCabang) : $this->session->set_userdata('IDCabang', 0);
        } else if ($this->session->userdata("Level") == 2) {
            $this->db->select('IDCabang');
            $this->db->from('admin');
            $this->db->join('cabang', 'cabang.IDAdmin_kantor = admin.IDAdmin');
            $this->db->where('admin.username', $this->session->userdata('Username'));
            $hasil = $this->db->get();
            $hasil->num_rows() != 0 ? $this->session->set_userdata('IDCabang', $hasil->row()->IDCabang) : $this->session->set_userdata('IDCabang', 0);
        } else {
            $this->session->set_userdata('IDCabang', 0);
        }
    }

    function ganti_komisi($IDSales, $arrBarang) {
        $counter = 1;
        foreach ($arrBarang as $barang) {
            $data = array('komisi' => $this->input->post('KomisiBarang' . $counter));
            $counter++;
            $this->db->where('IDBarang', $barang->IDBarang);
            $this->db->where('IDSales', $IDSales);
            $this->db->update('komisi', $data);
        }
    }

    function get_penjualan($arrID, $awal = false, $akhir = false) {
        if ($this->session->userdata("Level") == 1) {
            $sql = "SELECT c.IDCabang FROM admin a INNER JOIN cabang c ON c.IDAdmin = a.IDAdmin WHERE username = '" . $this->session->userdata("Username") . "'";
        } else if ($this->session->userdata("Level") == 2) {
            $sql = "SELECT c.IDCabang FROM admin a INNER JOIN cabang c ON c.IDAdmin_kantor = a.IDAdmin WHERE username = '" . $this->session->userdata("Username") . "'";
        }
        if ($this->session->userdata("Level") == 0) {
            $admin = 0;
        } else {
            $admin = $this->db->query($sql)->row()->IDCabang;
        }

        $this->db->select('laporan_penjualan.tanggal, sales.nama, barang.namaBarang, jual.jumlah, lokasi.desa, jual.IDBarang');
        $this->db->from('jual');
        $this->db->join('barang', 'barang.IDBarang=jual.IDBarang', 'inner');
        $this->db->join('lokasi', 'lokasi.IDLokasi=jual.IDLokasi', 'inner');
        $this->db->join('laporan_penjualan', 'laporan_penjualan.IDPenjualan=jual.IDPenjualan', 'inner');
        $this->db->join('Sales', 'sales.IDSales=jual.IDSales', 'inner');
        if ($awal && $akhir) {
            $this->db->where('laporan_penjualan.tanggal >=', strftime("%Y-%m-%d", strtotime($awal)));
            $this->db->where('laporan_penjualan.tanggal <=', strftime("%Y-%m-%d", strtotime($akhir)));
        }
        if (isset($_POST['filterBarang'])) {
            if ($this->input->post('filterBarang') != 0) {
                $this->db->where('jual.IDBarang', $this->input->post('filterBarang'));
            }
        }
        if (isset($_POST['filter'])) {
            if ($this->input->post('filter') != 0) {
                $this->db->where('jual.IDSales', $this->input->post('filter'));
            }
        }
        if ($this->input->post("cabang")) {
            if ($this->input->post("cabang") != 0) {
                $this->db->where('lokasi.IDCabang', $this->input->post('cabang'));
            }
        }
        if (count($arrID) > 0)
            $this->db->where_in('jual.IDSales', $arrID);

        if ($this->session->userdata("Level") != 0) {
            $this->db->where('laporan_penjualan.IDCabang', $admin);
        }


        $this->db->order_by('laporan_penjualan.tanggal', 'asc');
        return $this->db->get()->result();
    }

    function get_laporan_komisi() {
        if ($this->session->userdata("Level") == 0) {
            $sql = "SELECT lp.*, c.provinsi, c.kabupaten, a.IDAdmin, c.saldo, a.username
                FROM cabang c
                INNER JOIN laporan_penggajian lp ON c.IDCabang = lp.IDCabang
                INNER JOIN admin a ON a.IDAdmin = c.IDAdmin_kantor 
                WHERE lp.keterangan = 'komisi' ";
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
                WHERE a.username = '" . $this->session->userdata("Username") . "' AND lp.keterangan = 'komisi' ";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_detail_laporan_komisi($IDLaporan) {
        $sql = "SELECT dp.*, s.IDSales, s.nama, s.totalGaji
                FROM detail_penggajian dp
                INNER JOIN sales s ON s.IDSales = dp.IDSales
                WHERE dp.IDPenggajian = $IDLaporan;";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_laporan_komisi_id($IDLaporan) {
        return $this->db->get_where("laporan_penggajian", array("IDPenggajian" => $IDLaporan))->row();
    }

    /* Daniel */
    
    function insert_kehadiran($arrSales) {
//        print_r($arrSales);exit;
        if (count($arrSales) > 0) {
            $query = $this->db->query("Select * 
            From kehadiran    
            Where tanggal = '" . $arrSales[0]['tanggal'] . "' ");

            if ($query->num_rows() == 0) {
                $this->db->insert_batch('kehadiran', $arrSales);
            }
        }
    }

    function get_kehadiran($awal = FALSE, $akhir = FALSE, $IDSales = FALSE) {
        $sql = "Select sales.IDSales, sales.foto, sales.nama, COUNT(IF( kehadiran.status = 'H', kehadiran.status, NULL )) as hadir, COUNT(IF( kehadiran.status = 'A', kehadiran.status, NULL )) as absen
                From sales
                INNER JOIN kehadiran on kehadiran.IDSales = sales.IDSales ";
        if ($awal && $akhir) {
            $sql.=" WHERE tanggal BETWEEN '" . strftime("%Y-%m-%d", strtotime($awal)) . "' AND '" . strftime("%Y-%m-%d", strtotime($akhir)) . "'  ";
        } else {
            $sql.=" WHERE month(tanggal) = month(now()) AND year(tanggal) = year(now()) ";
        }
        if ($IDSales != 0) {
            $sql .= " AND sales.IDSales = " . $IDSales;
        }
        if ($this->session->userdata('Level') == 0) {
            if($this->input->post('cabang') != 0) {
                $sql .= " AND sales.IDCabang = " . $this->input->post('cabang');
            }
        }
        $sql .= ($this->session->userdata("Level") == 0 ? "" : " AND sales.IDCabang = " . $this->session->userdata("IDCabang")) .
                " GROUP BY sales.IDSales";
        return $this->db->query($sql)->result();
    }
    
    /* Daniel */
}
