<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Input Komisi Sales</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 0px;">
                <li><a href="<?php echo base_url(); ?>index.php/komisi/laporan_komisi"><i class="fa fa-home"></i> Daftar Laporan Pembayaran Komisi</a></li>
                <li><a href="">Komisi Sales </a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-success siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Tambah Data Komisi</h3>
                </div>
                <div class="panel-body siku">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($status != "") {
                                ?>
                                <div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $status ?></div>
                            <?php }
                            ?>
                            <form id="form_s" method="post" action="<?php echo current_url(); ?>" accept-charset="utf-8" class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tanggal : </label>
                                    <div class="col-lg-9">
                                        <input class="form-control siku" type="text" name="tanggal" id="datepicker" placeholder="Pilih Tanggal" value="<?php echo set_value('tanggal') ?>">
                                        <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
                                        <input type="hidden" name="hid" value="7482hdyueldplf"/>
                                        <?php if (form_error("tanggal") != "") : ?>
                                            <span style="color: red;"><?php echo form_error("tanggal"); ?></span>                                  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Sales : </label>
                                    <div class="col-lg-9">
                                        <select name="sales" id="sales" class="form-control" onchange="get_komisi()">
                                            <option value="0">--- Pilih Sales ---</option>
                                            <?php
                                            foreach ($saless as $sales) {
                                                ?>
                                                <option value="<?php echo $sales->id_sales ?>"><?php echo $sales->nama ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Komisi : </label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" disabled="" value="---" id="komisi" />
                                        <input type="hidden" value="" name="komisi_hidden" id="komisi_hidden" />
                                        <input type="hidden" value="" name="nama_sales" id="nama_sales" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Pembayaran : </label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="number" min="0" name="bayar" value="<?php echo set_value('bayar') ?>" id="bayar"/>
                                        <?php if (form_error("bayar") != "") : ?>
                                            <span style="color: red;"><?php echo form_error("bayar"); ?></span>                                  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3"></label>
                                    <div class="col-lg-9">
                                        <button name="btn_submit" value="btn_submit" type="submit" class="btn btn-info siku" id="bayar">Tambah Pembayaran</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-info siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Informasi</h3>
                </div>
                <div class="panel-body siku">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Sales</th>
                                <th>Komisi</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($this->cart->contents() as $items):
                                if (strpos($items["id"], "komisi") !== FALSE):
                                    ?>
                                    <tr>
                                        <td><?php echo strftime("%d-%m-%Y", strtotime($items["options"]["tanggal"])) ?></td>
                                        <td><?php echo $items["name"] ?></td>
                                        <td>Rp.<?php echo number_format($items["options"]["komisi"], 0, ',', '.') ?>,-</td>
                                        <td>Rp.<?php echo number_format($items["price"], 0, ',', '.') ?>,-</td>
                                        <td><a href="<?php echo base_url() ?>index.php/komisi/delete_cart_pembayaran/<?php echo $items["id"] ?>"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <br>
                    <div class="text-right">
                        <a id="inputCheck" onclick="inputCheck()" href="<?php echo base_url() ?>index.php/komisi/simpan_komisi" class="btn btn-primary siku"><i class="fa fa-forward"></i> Lanjutkan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>bootstrap/js/ajaxLaporan.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>Datatable/js/jquery.dataTables.js"></script>
<script>
                            $("#datepicker").datepicker({
                                inline: true,
                                dateFormat: "dd-mm-yy"
                            });

                            $("#datatable").dataTable();

                            $(document).ready(function () {
                                $("#lokasi").val('');
                                $("#salesnya_admin").val('');
                                $("#gaji_sales").val('');
                                $("#nama_produk").val('');
                                $(".kas_keluar").val('');
                                $("#bayar_gaji").hide();
                            });

//                            $("#inputCheck").click(function() {
//                                event.preventDefault();
//                                var r = confirm("Apakah Data yang telah Di Masukan Benar?");
//                                if (r == true) {
//                                    var a = $(this).attr("href");
//                                    window.location.assign(a);
//                                }
//                            });

</script>
<script src="<?php echo base_url(); ?>alertify/alertify.min.js"></script>
<script>

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
</script>