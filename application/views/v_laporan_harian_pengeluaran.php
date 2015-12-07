<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">

    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Input Data Pengeluaran</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="<?= base_url() ?>index.php/laporan/laporan_pengeluaran">Daftar Laporan Pengeluaran</a></li>
                <li><a>Pengeluaran</a></li>
            </ol>
        </div>

    </div>
    <!--    <div class="row" id='add_success'>
            <div class="col-lg-12">
                <div class= 'alert alert-success siku alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>×</span></button>
                    <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
                </div>
            </div>    
        </div>-->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-danger siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Kas Keluar</h3>
                </div>
                <div class="panel-body siku">
                    <form class="form-horizontal" id='kas_keluar' method='post' action="<?php echo current_url(); ?>">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-4 control-label">Tanggal : </label>
                            <div class="col-sm-8">
                                <input type="text" name="tanggal_keluar" id="tanggal" class="form-control siku" value="<?php echo $this->session->userdata("tanggal_jual"); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-4 control-label">Kas Keluar: </label>
                            <div class="col-sm-8">
                                <select class="form-control siku kas_keluar" onchange="update_kas_keluar()" name='jenis_pengeluaran'>
                                    <option value="Bensin">Bensin</option>
                                    <option value="Makan">Makan</option>
                                    <option value="Parkir">Parkir</option>
                                    <option value="Tol">Tol</option>
                                    <!--<option value="Gaji">Gaji</option>-->
                                    <option value="lain-lain">Lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <div id="bayar_gaji">
                            <div class="form-group" >
                                <label for="inputPassword" class="col-sm-4 control-label">Bayar Gaji Sales: </label>
                                <div class="col-sm-8">
                                    <select class="form-control siku" id='gaji_sales' name="gaji_sales" onchange="get_current_gaji('gaji_sales')">
                                        <?php foreach ($info_salesess as $value): ?>
                                            <option value='<?php echo $value->id_sales; ?>'><?php echo $value->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="col-sm-4 control-label">Gaji Saat Ini: </label>
                                <div class="col-sm-8" style="padding-top: 10px;">
                                    <span id="gaji_label" style="color: red;">Rp.0,-</span>
                                </div>
                            </div>
                            <!--                            <div class="form-group" >
                                                            <label class="col-sm-4 control-label">Nominal: </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control siku" id="nominal_gaji" placeholder="Nominal">
                                                            </div>
                                                        </div>-->
                        </div>
                        <div class="form-group" id="">
                            <label class="col-sm-4 control-label">Nominal: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control siku" id="nominal" placeholder="Nominal" name='nominal'>
                                <?php if (form_error('nominal')) {
                                    ?>
                                    <div class="warna"><?php echo form_error('nominal'); ?>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                        <div id="kas-lain-lain" class="form-group"></div>


                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-primary siku" style="width: 100%;" name='btn_tambah' value='btn_tambah'>Tambahkan Data > </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="panel panel-danger siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Informasi Kas Keluar</h3>
                </div>
                <div class="panel-body siku" id=''>
                    <table class='table table-striped table-hover' id="show_kas_keluar">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th style="text-align: right;">Nominal</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="baris_kas_keluar">
                            <?php
                            foreach ($this->cart->contents() as $items) {
                                if (strpos($items["id"], "KasKeluar") !== FALSE) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($items["options"]["Keterangan"] == "Gaji") ? $items["name"] : $items["options"]["Keterangan"] ?><?php echo isset($items["options"]["Keterangan_lainnya"]) ? '&nbsp; - &nbsp;'.$items["options"]["Keterangan_lainnya"] : '' ?></td>
                                        <td align="right">Rp <?php echo number_format($items["price"], 0, ",", ".") ?></td>
                                        <td align="center">
                                            <a href="<?php echo base_url() ?>index.php/laporan/hapus_cart_pengeluaran/<?php echo $items["id"] ?>" class="btn btn-danger siku">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col-sm-6">
            <!--            <button type="button" class="btn btn-primary siku" onclick="laporan_selesai()" style="width: 100%;">Selesai</button>-->
            <a id="inputCheck" href="<?php echo base_url() ?>index.php/laporan/insert_pengeluaran" class="btn btn-primary siku" style="width: 100%;">Selesai Input Pengeluaran</a>
        </div>
        <!--        <div class="col-sm-6">
                    <button type="button" class="btn btn-success siku" onclick="print_laporan()" style="width: 100%;">Print Laporan</button>
                </div>-->
    </div>   
    <!--<br>-->
    <!--<div class="row">-->
    <!-- </div> -->
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>"/>
</div>
<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <button type="button" class="btn btn-default" onclick="dismiss_modal()"><i class="fa fa-times"></i> Tutup</button>
                <button type="button" class="btn btn-primary" onclick="tambah_lokasi()"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
    </div>
</div>-->

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
                                            //                                                        $('#informasi').DataTable({
                                            //                                                            "bFilter": false,
                                            //                                                            "bPaginate": false,
                                            //                                                            "bLengthChange": false,
                                            //                                                            "bInfo": false,
                                            //                                                            "oLanguage": {
                                            //                                                                "sEmptyTable": '',
                                            //                                                                "sInfoEmpty": ''
                                            //                                                            },
                                            //                                                            "sEmptyTable": "",
                                            //                                                        });
                                        });
</script>
<script>
    $("#datepicker").datepicker({
        inline: true,
        dateFormat: "dd-mm-yy"
    });

    $(document).ready(function () {
        $("#lokasi").val('');
        $("#salesnya_admin").val('');
        $("#gaji_sales").val('');
        $("#nama_produk").val('');
        $(".kas_keluar").val('');
        $("#bayar_gaji").hide();
        $("#add_success").hide();

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

    function submit_tanggal() {
//        document.getElementById("form_tanggal").submit();
    }

    alertify.defaults = {
        // dialogs defaults
        modal: true,
        basic: false,
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

    $("#inputCheck").click(function (event) {
        event.preventDefault();
        alertify.confirm('Apakah Data yang telah Di Masukan Benar?', function (e) {
            if (e) {
                var a = $("#inputCheck").attr("href");
                window.location.assign(a);
            } else {
                //after clicking Cancel
            }
        });
    });
    
    $("#tanggal").datepicker();
</script>
</body>
</html>