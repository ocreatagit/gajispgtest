<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Input Data Penjualan</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href="<?php echo base_url(); ?>index.php/Laporan/harian"><i class="fa fa-home"></i> Daftar Laporan Harian</a></li>
                <li class="active"> Input Data Penjualan </li>
            </ol>
        </div>
    </div>
    <?php if ($this->session->flashdata("status")) { ?>
        <div class="alert alert-info siku"><i class="fa fa-info-circle"></i> <?php echo $this->session->flashdata("status") ?></div>
    <?php } ?>
    <form id="form_penjualan" method="post" action="<?php echo current_url(); ?>">
    <!--<form name="form_tanggal" id="form_tanggal" method="POST" action="<?php echo base_url() ?>index.php/laporan/insert_laporan_penjualan" class="form-horizontal">-->
        <div class="row">
            <div class="col-lg-5">
                <div class="panel panel-default siku" style="padding-top: 10px;">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Hari / Tanggal: </label>
                            <div class="col-sm-7">
                                <input class="form-control siku" type="text" id="datepicker" placeholder="Pilih Tanggal" name="tanggal" value="<?php if ($this->session->userdata("tanggal_jual") != "") echo $this->session->userdata("tanggal_jual"); ?>">
                                <span id="tanggal_error" style="color: red;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="panel panel-default siku" style="padding-left: 20px; height: 61px; vertical-align: central;">
                    <h2 class="text text-danger" style="margin: 0px; padding: 0px; margin-top: 10px;"><i class="fa fa-info-circle"></i> Jangan Lupa Menambah Stok! <button type="button" class="btn btn-primary siku" data-toggle="modal" data-target="#myModalStok">Lihat Stok</button></h2>
<!--                    <span style="font-size: 25px;  padding-top: 10px;" id="text_saldo">Saldo : Rp.<?php // echo number_format($saldo, 0, ",", ".")                                                      ?>,-</span>-->
                    <input type="hidden" name="saldo" id="saldo" value="<?php echo $saldo; ?>"/>
                    <input type="hidden" name="idcabang" id="idcabang" value="<?php echo $cabang; ?>"/>
                </div>
            </div>
        </div>
        <!--</form>-->
        <div class="row">
            <div class="col-lg-5">
                <div class="panel panel-success siku">
                    <div class="panel-heading siku">
                        <h3 class="panel-title">Lokasi Penjualan</h3>
                    </div>
                    <div class="panel-body siku">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">Daerah: </label>
                                <div class="col-sm-9" id="load_lokasi">
                                    <select class="form-control siku" id='lokasi' name='lokasi' onchange="changeLokasi('lokasi')">                               
                                        <?php foreach ($info_lokasis as $info_lokasi): ?>                                    
                                            <option value='<?php echo $info_lokasi->id_lokasi ?>'><?php echo $info_lokasi->desa; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (form_error("lokasi")) {
                                        ?>
                                        <span class='warna' id='lokasi_error'><?php echo form_error("lokasi") ?></span>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: -12px;">
                                <label class="col-sm-3 control-label">Kecamatan: </label>
                                <div class="col-sm-9 lokasi_label" id="kecamatan"></div>
                            </div>
                            <div class="form-group" style="margin-top: -12px;">
                                <label class="col-sm-3 control-label">Wilayah: </label>
                                <div class="col-sm-9 lokasi_label" id="wilayah"></div>
                            </div>
                            <div class="form-group" style="margin-top: -12px;">
                                <label class="col-sm-3 control-label">Kabupaten: </label>
                                <div class="col-sm-9 lokasi_label" id="kabupaten">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: -12px;">
                                <label class="col-sm-3 control-label">Provinsi: </label>
                                <div class="col-sm-9 lokasi_label" id="provinsi">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button type="button" class="btn btn-primary siku" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> Tambah</button>
                                    <button type="button" class="btn btn-info siku" data-toggle="modal" data-target="#myModalEdit" onclick="edit_lokasi()"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="panel panel-info siku">
                    <div class="panel-heading siku">
                        <h3 class="panel-title">Penjualan Sales</h3>
                    </div>
                    <div class="panel-body siku">
                        <img data-holder-rendered="true" 
                             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTA1ZWRiZTBhMyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1MDVlZGJlMGEzIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQwLjk2NjY2NzE3NTI5Mjk3IiB5PSI3NC42ODk5OTk5NjE4NTMwMyI+MTQweDE0MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg=="
                             style="width: 150px; height: 180px; position: absolute; margin-left: 450px;" 
                             data-src="holder.js/140x140" class="img-thumbnail" alt="140x140" id="foto_image">
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>"/>

                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Team Leader : </label>
                                <div class="col-sm-5">
                                    <select class="form-control siku" id='team_leader' name="team_leader">
                                        <?php foreach ($info_team_leaders as $value): ?>
                                            <option value='<?php echo $value->id_sales; ?>'><?php echo $value->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (form_error("team_leader")) {
                                        ?>
                                        <span class='warna' id='lokasi_error'><?php echo form_error("team_leader") ?></span>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Sales: </label>
                                <div class="col-sm-5">
                                    <select class="form-control siku" id='salesnya_admin' name="salesnya_admin" onclick="tampil_foto()">
                                        <?php
                                        $ke = 0;
                                        foreach ($info_saleses as $value):
                                            ?>
                                            <option <?php if ($ke++ == 0) echo "selected" ?> value='<?php echo $value->id_sales; ?>'><?php echo $value->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (form_error("salesnya_admin")) {
                                        ?>
                                        <span class='warna' id='lokasi_error'><?php echo form_error("salesnya_admin") ?></span>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-sm-3 control-label">Nama Barang: </label>
                                <div class="col-sm-5">
                                    <select class="form-control siku" id='nama_produk' name="nama_produk">
                                        <?php foreach ($info_barang as $value): ?>
                                            <option value='<?php echo $value->IDBarang; ?>'><?php echo $value->namaBarang; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (form_error("nama_produk")) {
                                        ?>
                                        <span class='warna' id='lokasi_error'><?php echo form_error("nama_produk") ?></span>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jumlah Terjual: </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control siku" id="jumlah" placeholder="Satuan pcs" min="0" style='text-align: right; width:180px;' name="jumlah">
                                    <input type="hidden" id="tanggal_tampung" value="" name="tanggal_tampung">
                                    <?php if (form_error("jumlah")) {
                                        ?>
                                        <span class='warna' id='lokasi_error'><?php echo form_error("jumlah") ?></span>
                                    <?php }
                                    ?>
                                    <input type="hidden" name="index_combo" value="" id="index_combo"/>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <label id='konversi' class="col-sm-offset-3 control-label"></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Jual </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control siku" id="pendapatan_SPG" placeholder="Satuan Rupiah" min="0" style='text-align: right; width: 180px;' name="pendapatan_SPG">
                                    <?php if (form_error("pendapatan_SPG")) {
                                        ?>
                                        <span class='warna' id='lokasi_error'><?php echo form_error("pendapatan_SPG") ?></span>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">                                   
                                    <button type="submit" name="btn_submit" id='btn_submit' value="submit" class="btn btn-primary siku" onclick="submit_tanggal()">Tambahkan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div> 
    </form>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Informasi</h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class='table table-striped table-hover' id="informasi">
                            <thead>
                                <tr>
                                    <th>Daerah</th>
                                    <th>Team Leader</th>
                                    <th>Sales</th>
                                    <th>Barang</th>
                                    <th style="text-align: right;">Jumlah</th>
                                    <th style="text-align: right;">Penjualan</th>
                                    <th style="text-align: right;">Komisi</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="baris">
                                <?php
//                                print_r($this->cart->contents()); exit;
                                $total_penjualan = 0;
                                $total_komisi = 0;
                                $no = 1;
                                foreach ($this->cart->contents() as $items) {
//                                    print_r($items); exit;
                                    if (strpos($items["id"], "Jual") !== FALSE) {
                                        ?>
                                        <tr>
                                            <td><?php echo $items["options"]["Daerah"] ?></td>
                                            <td><?php echo $items["options"]["NamaTeamLeader"] ?></td>
                                            <td><?php echo $items["options"]["NamaSales"] ?></td>
                                            <td><?php echo $items["options"]["NamaBarang"] ?></td>
                                            <td align='right'>
                                                <input type="hidden" id="id<?php echo $no; ?>" name="id<?php echo $no; ?>" value="<?php echo $items["id"] ?>"/>
                                                <input type="hidden" id="name<?php echo $no; ?>" name="name<?php echo $no; ?>" value="<?php echo $items["name"] ?>"/>
                                                <input type="hidden" id="IDLokasi<?php echo $no; ?>" name="IDLokasi<?php echo $no; ?>" value="<?php echo $items["options"]["IDLokasi"] ?>"/>
                                                <input type="hidden" id="Daerah<?php echo $no; ?>" name="Daerah<?php echo $no; ?>" value="<?php echo $items["options"]["Daerah"] ?>"/>
                                                <input type="hidden" id="IDTeamLeader<?php echo $no; ?>" name="IDTeamLeader<?php echo $no; ?>" value="<?php echo $items["options"]["IDTeamLeader"] ?>"/>
                                                <input type="hidden" id="NamaTeamLeader<?php echo $no; ?>" name="NamaTeamLeader<?php echo $no; ?>" value="<?php echo $items["options"]["NamaTeamLeader"] ?>"/>
                                                <input type="hidden" id="IDSales<?php echo $no; ?>" name="NamaSales<?php echo $no; ?>" value="<?php echo $items["options"]["IDSales"] ?>"/>
                                                <input type="hidden" id="NamaSales<?php echo $no; ?>" name="NamaSales<?php echo $no; ?>" value="<?php echo $items["options"]["NamaSales"] ?>"/>
                                                <input type="hidden" id="IDBarang<?php echo $no; ?>" name="IDBarang<?php echo $no; ?>" value="<?php echo $items["options"]["IDBarang"] ?>"/>
                                                <input type="hidden" id="NamaBarang<?php echo $no; ?>" name="NamaBarang<?php echo $no; ?>" value="<?php echo $items["options"]["NamaBarang"] ?>"/>
                                                <input type="hidden" id="komisi<?php echo $no; ?>" name="komisi<?php echo $no; ?>" value="<?php echo $items["options"]["komisi"] ?>"/>
                                                <input type="hidden" id="price<?php echo $no; ?>" name="price<?php echo $no; ?>" value="<?php echo $items["price"] ?>"/>
                                                <input type="hidden" id="rowid<?php echo $no; ?>" name="rowid<?php echo $no; ?>" value="<?php echo $items["rowid"] ?>"/>
                                                <input type="hidden" id="index_combo<?php echo $no; ?>" name="index_combo<?php echo $no; ?>" value="<?php echo $items["options"]["index_combo"] ?>"/>
                                                <input type="number" id="jumlah<?php echo $no; ?>" value="<?php echo $items["qty"] ?>" name="qty" class="form-control siku text-right" style="padding-right: 10px;" onkeyup="change_qty(<?php echo $no; ?>)" onclick="change_qty(<?php echo $no; ?>)" min="1"/>
                                            </td>
                                            <td align='right'>
                                                <p id="harga<?php echo $no; ?>">                                                                                                        
                                                    Rp <?php echo number_format($items["price"], 0, ',', '.') ?>,-
                                                </p>
                                                <!--<input type="number" value="<?php echo ($items["price"]) ?>" name="price" class="form-control siku text-right"/>-->
                                            </td>
                                            <td align='right'>Rp <?php echo number_format($items["options"]["komisi"], 0, ',', '.') ?>,-</td>
                                            <td align='center'>
        <!--                                                <button type="button" id="edit_cart_jual<?php echo $no; ?>" class="btn btn-info siku btn-sm" onclick="update_cart_jual(<?php echo $no; ?>)"><i class="fa fa-edit"></i></button>-->
                                                <a class="btn btn-danger siku btn-sm" href="<?php echo base_url() ?>index.php/laporan/delete_cart_jual/<?php echo $items["id"] ?>"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                        $total_penjualan += $items["price"] + 0;
                                        $total_komisi += $items["options"]["komisi"] + 0;
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr style="background-color: white">
                                    <td colspan="5" align="right">Total</td>
                                    <td align='right'>Rp <?php echo number_format($total_penjualan, 0, ',', '.') ?>,-</td>
                                    <td align='right'>Rp <?php echo number_format($total_komisi, 0, ',', '.') ?>,-</td>
                                    <td>
                                        <input type="hidden" name="no" id="no" value="<?php echo $no ?>"/>
                                        <button type="button" id="simpan_cart_jual" class="btn btn-info siku btn-sm btn-block" onclick="simpan_cart_jual(<?php echo $no; ?>)"><i class="fa fa-save"></i> Save</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Total Penjualan Per Team Leader</h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class='table table-striped table-hover' id="informasi_leader">
                            <thead>
                                <tr style="" class="datatable_header">
                                    <th id="tengah">Nama Barang</th>
                                    <th id="tengah">Team Leader</th>
                                    <th id="tengah" style="width: 60px;">Jumlah</th>
                                    <th id="tengah" style="">Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody id="baris">
                                <?php
                                $array = array();
                                $no = 0;
                                $total_item = 0;
                                $leader = '';

//                                echo count($this->cart->contents()); exit;
//                                print_r($this->cart->contents());
//                                $array1 = array_multisort(, SORT_ASC);
//                                $array_cart = $this->cart->contents();


                                foreach ($array_cart as $items) {
                                    if (strpos($items["id"], "Jual") !== FALSE) {
                                        if ($leader == '') {
                                            $leader = $items["options"]["NamaTeamLeader"];
                                            $total_item = $items["qty"];
                                            $nama_barang = $items["options"]["NamaBarang"];
                                            $total = $items["price"];

                                            $no++;
                                        } else {
                                            if ($leader == $items["options"]["NamaTeamLeader"]) {
                                                if ($nama_barang == $items["options"]["NamaBarang"]) {
                                                    $total_item += $items["qty"];
                                                    $total += $items["price"];
                                                } else {
                                                    array_push($array, array("NamaTeamLeader" => $leader, "NamaBarang" => $nama_barang, "Jumlah" => $total_item, "Subtotal" => $total));
                                                    $total_item = $items["qty"];
                                                    $nama_barang = $items["options"]["NamaBarang"];
                                                    $total = $items["price"];
                                                }

                                                if (count($this->cart->contents()) == $no) {
                                                    array_push($array, array("NamaTeamLeader" => $leader, "NamaBarang" => $nama_barang, "Jumlah" => $total_item, "Subtotal" => $total));
                                                }
                                                $no++;
                                            } else {
                                                array_push($array, array("NamaTeamLeader" => $leader, "NamaBarang" => $nama_barang, "Jumlah" => $total_item, "Subtotal" => $total));
                                                $leader = $items["options"]["NamaTeamLeader"];
                                                $total_item = $items["qty"];
                                                $nama_barang = $items["options"]["NamaBarang"];
                                                $total = $items["price"];
                                                $no++;
                                            }
                                        }

                                        if (count($this->cart->contents()) == $no) {
                                            array_push($array, array("NamaTeamLeader" => $leader, "NamaBarang" => $nama_barang, "Jumlah" => $total_item, "Subtotal" => $total));
                                        }
                                    }
                                }

                                if (count($array) > 0) {
                                    foreach ($array as $items):
                                        ?>
                                        <tr>
                                            <td><?php echo $items["NamaBarang"] ?></td>
                                            <td><?php echo $items["NamaTeamLeader"] ?></td>
                                            <td align="right" id="tengah"><?php echo $items["Jumlah"] ?></td>
                                            <td align="right" id="tengah">Rp <?php echo number_format($items["Subtotal"], 0, ',', '.'); ?>,-</td>
                                        </tr>
                                        <?php
                                    endforeach;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form id="form_keterangan" method="POST" action="<?php echo base_url() ?>index.php/laporan/insert_laporan_penjualan" class="form-horizontal">
                <div class="panel panel-default siku">
                    <div class="panel-heading siku">
                        <h3 class="panel-title">Keterangan Lainnya</h3>
                    </div>
                    <div class="panel-body siku">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <!--<label for="inputPassword" class="col-sm-5 control-label">Keterangan Lainnya</label><br>-->
                                <textarea class="form-control" rows="3" id="keterangan_lainnya" name="keterangan"><?php echo $this->session->userdata("keterangan") ?></textarea>
                            </div>
                            <button type="submit" id="btn_keterangan" value="keterangan" style="display: none;">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--<button class="btn btn-primary siku" style="width: 100%;" onclick="selesai_penjualan()">Selesai Input Penjualan</button>-->
            <button type="button" id="inputCheck" class="btn btn-primary siku" style="width: 100%;" onclick="" >Selesai Input Penjualan</button>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-map-marker"></i> Tambah Lokasi</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Daerah: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control siku" name="daerah" id="daerah_input" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Kecamatan: </label>
                        <div class="col-sm-9 lokasi_label">
                            <input type="text" class="form-control siku" name="kecamatan" id="kecamatan_input" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Wilayah: </label>
                        <div class="col-sm-9 lokasi_label" id="">
                            <input type="text" class="form-control siku" name="wilayah_input" id="wilayah_input" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Kabupaten: </label>
                        <div class="col-sm-9 lokasi_label" id="kabupaten">
                            <input type="text" class="form-control siku" name="kabupaten" id="kabupaten_input" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Provinsi: </label>
                        <div class="col-sm-9 lokasi_label">
                            <input type="text" class="form-control siku" name="provinsi" id="provinsi_input" value="<?php echo $info_cabangs->provinsi ?>" disabled=""/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="dismiss_modal()"><i class="fa fa-times"></i> Tutup</button>
                <button type="button" class="btn btn-primary" onclick="tambah_lokasi()"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Lokasi</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Daerah: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control siku" name="daerah" id="daerah_edit" value=""/>
                            <input type="hidden" id="IDLokasi_edit" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Kecamatan: </label>
                        <div class="col-sm-9 lokasi_label">
                            <input type="text" class="form-control siku" name="kecamatan" id="kecamatan_edit" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Wilayah: </label>
                        <div class="col-sm-9 lokasi_label" id="">
                            <input type="text" class="form-control siku" name="wilayah" id="wilayah_edit" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Kabupaten: </label>
                        <div class="col-sm-9 lokasi_label" id="kabupaten">
                            <input type="text" class="form-control siku" name="kabupaten" id="kabupaten_edit" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Provinsi: </label>
                        <div class="col-sm-9 lokasi_label">
                            <input type="text" class="form-control siku" name="provinsi" id="provinsi_edit" value="<?php echo $info_cabangs->provinsi ?>" disabled=""/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="" id="edit_dissmis_button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Tutup</button>
                <button type="button" class="btn btn-primary" onclick="simpan_lokasi()" id="btn_edit"><i class="fa fa-edit"></i> Edit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalStok" tabindex="-1" role="dialog" aria-labelledby="myModalLabelStok">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-book"></i> Stok Barang</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    foreach ($stok_cabang as $stok) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $stok->namaBarang ?></td>
                            <td><?php echo number_format($stok->jumlah, 0, ",", ".") ?></td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>bootstrap/js/ajaxLaporan.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>Datatable/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>alertify/alertify.min.js"></script>

<script>
                    $(document).ready(function () {
                        $("#lokasi").val('');
                        $("#salesnya_admin").val('');
                        $("#nama_produk").val('');
                    });
</script>
<script>
    var arrSatuan = [<?php
                    $temp = "";
                    for ($i = 0; $i < count($konversi_satuan); $i++) {
                        if ($i == 0) {
                            $temp .= "" . $konversi_satuan[$i]->total_konversi;
                        } else {
                            $temp .= ", " . $konversi_satuan[$i]->total_konversi;
                        }
                    }
                    echo $temp;
                    ?>];
    var arrharga = [<?php
                    $temp = "";
                    for ($i = 0; $i < count($harga_satuan); $i++) {
                        if ($i == 0) {
                            $temp .= "" . $harga_satuan[$i]->harga_konversi;
                        } else {
                            $temp .= ", " . $harga_satuan[$i]->harga_konversi;
                        }
                    }
                    echo $temp;
                    ?>];
    $('#konversi').hide();
    var idx = 0;
    $('#nama_produk').change(function () {
        idx = $('#nama_produk option:selected').index();
        $("#index_combo").val(idx);
    });
    $('#jumlah').keyup(function () {
        var data = $('#jumlah').val();
        var karton = Math.floor(data / (arrSatuan[idx] * 12));
        data = data % (arrSatuan[idx] * 12);
        var lusin = Math.floor(data / 12);
        data = data % 12;
        var pcs = data;
        $('#konversi').show();
        $('#konversi').html(karton + " Karton " + lusin + " Lusin " + pcs + " Pcs");
        $('#pendapatan_SPG').val(karton * arrharga[idx * 3] + lusin * arrharga[idx * 3 + 1] + pcs * arrharga[idx * 3 + 2]);
    });
</script>
<script>

    var ErrorPenjualan = 0;
    $(document).ready(function () {
        $("#lokasi").val('');
        $("#salesnya_admin").val('');
        $("#gaji_sales").val('');
        $("#nama_produk").val('');
        $(".kas_keluar").val('');
        $("#bayar_gaji").hide();

        $("#datepicker").datepicker({
            inline: true,
            dateFormat: "dd-mm-yy"
        });
    });
    $("#informasi").dataTable();
    $("#informasi_leader").dataTable();

    function submit_tanggal() {
        //        document.getElementById("form_tanggal").submit();
    }

    alertify.defaults = {// dialogs defaults
        modal: true, basic: false,
        frameless: false,
        movable: true,
        resizable: true,
        closable: true,
        closableByDimmer: true,
        maximizable: true,
        startMaximized: false,
        pinnable: true,
        pinned: true,
        padding: true,
        overflow: true,
        maintainFocus: true,
        transition: 'pulse',
        autoReset: true,
        // notifier defaults
        notifier: {
            // auto-dismiss wait time (in seconds)  
            delay: 5,
            // default position
            position: 'bottom-right'
        },
        // language resources 
        glossary: {
            // dialogs default title
            title: 'Konfirmasi',
            // ok button text
            ok: 'OK',
            // cancel button text
            cancel: 'Cancel'
        },
        // theme settings
        theme: {
            // class name attached to prompt dialog input textbox.
            input: 'ajs-input',
            // class name attached to ok button
            ok: 'ajs-ok',
            // class name attached to cancel button 
            cancel: 'ajs-cancel'
        }
    };

    //    function submit_form_keterangan() {
    $("#inputCheck").click(function (event) {
        event.preventDefault();
        alertify.confirm('Apakah Data yang telah Di Masukan Benar?', function (e) {
            if (e) {
                if ($("#datepicker").val()) {
                } else {
                    ErrorPenjualan = 1;
                    $("#tanggal_error").html("Tanggal tidak boleh kosong!");
                }
                if (ErrorPenjualan == 0) {
                    $.ajax({
                        url: "<?php echo base_url() ?>index.php/Laporan/insert_attrib",
                        type: 'POST',
                        data: {
                            "tanggal": $("#datepicker").val(),
                            "keterangan": $("#keterangan_lainnya").val()
                        }
                    });
                    document.getElementById("form_keterangan").submit();
                } else {
                    $('html, body').animate({scrollTop: 0}, 'fast');
                }
            } else {
                //after clicking Cancel
            }
        });
    });
</script>
<script>
    function change_qty(number) {
        var arrSatuan = [<?php
                    $temp = "";
                    for ($i = 0; $i < count($konversi_satuan); $i++) {
                        if ($i == 0) {
                            $temp .= "" . $konversi_satuan[$i]->total_konversi;
                        } else {
                            $temp .= ", " . $konversi_satuan[$i]->total_konversi;
                        }
                    }
                    echo $temp;
                    ?>];
        var arrharga = [<?php
                    $temp = "";
                    for ($i = 0; $i < count($harga_satuan); $i++) {
                        if ($i == 0) {
                            $temp .= "" . $harga_satuan[$i]->harga_konversi;
                        } else {
                            $temp .= ", " . $harga_satuan[$i]->harga_konversi;
                        }
                    }
                    echo $temp;
                    ?>];
        var idx = $("#index_combo" + number).val();
        var data = $('#jumlah' + number).val();
        console.log("ID : " + idx);
        console.log("jumlah : " + data);

        var karton = Math.floor(data / (arrSatuan[idx] * 12));
        data = data % (arrSatuan[idx] * 12);
        console.log("Karton : " + karton);

        var lusin = Math.floor(data / 12);
        data = data % 12;
        console.log("Lusin : " + lusin);

        var pcs = data;
        console.log("pcs : " + pcs);
        console.log("array satuan : " + arrSatuan);
        console.log("array harga : " + arrharga);
//            $('#konversi').show();
//            $('#konversi').html(karton + " Karton " + lusin + " Lusin " + pcs + " Pcs");
        var harga = karton * arrharga[idx * 3] + lusin * arrharga[idx * 3 + 1] + pcs * arrharga[idx * 3 + 2];
        harga = harga.toLocaleString() + "";

        $('#harga' + number).html("Rp " + harga.replace(',', '.') + ",-");
        $('#price' + number).val(harga.replace(',', '') + "");
    }

    function update_cart_jual(number) {

        $.ajax({
            url: "<?php echo base_url() ?>index.php/laporan/edit_cart_jual",
            type: 'POST',
            data: {
                "rowid": $("#rowid" + number).val(),
                "id": $("#id" + number).val(),
                "jumlah": $("#jumlah" + number).val(),
                "harga": $("#price" + number).val(),
                "name": $("#name" + number).val(),
                "IDSales": $("#IDSales" + number).val(),
                "IDBarang": $("#IDBarang" + number).val(),
                "IDLokasi": $("#IDLokasi" + number).val(),
                "NamaSales": $("#NamaSales" + number).val(),
                "NamaBarang": $("#NamaBarang" + number).val(),
                "Daerah": $("#Daerah" + number).val(),
                "komisi": $("#komisi" + number).val(),
                "IDTeamLeader": $("#IDTeamLeader" + number).val(),
                "NamaTeamLeader": $("#NamaTeamLeader" + number).val(),
                "index_combo": $("#index_combo" + number).val()
            }, success: function (data, textStatus, jqXHR) {
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function simpan_cart_jual() {
        var no = $("#no").val();
        for (var i = 1; i < no; i++) {
            update_cart_jual(i);
        }
        window.location.url = "<?php echo current_url(); ?>";
    }
</script>
</body>
</html>