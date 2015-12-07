<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Transaksi Kas Bank</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 0px;">
                <li><a href="<?php echo base_url(); ?>index.php/Laporan/daftar_tarik_bank"><i class="fa fa-home"></i> Daftar Pengambilan Kas Bank</a></li>
                <li><a href="">Buat Transaksi Kas Bank</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Tambah Transaksi Pengambilan Kas Bank</h3>
                </div>
                <div class="panel-body siku">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($status != "") {
                                ?>
                                <div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $status ?></div>
                            <?php }
                            ?>

                            <form method="post" action="<?php echo current_url(); ?>" accept-charset="utf-8" class="form-horizontal" id="form_setor">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tanggal : </label>
                                    <div class="col-lg-9">
                                        <input class="form-control siku" type="text" name="tanggal" id="datepicker" placeholder="Pilih Tanggal">
                                        <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
                                        <?php if (form_error("tanggal") != "") : ?>
                                            <span style="color: red;"><?php echo form_error("tanggal"); ?></span>                                  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Saldo Admin : </label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" disabled="" value="Rp <?php echo number_format($saldo_admin, 0, ',', '.'); ?> ,-" id="gaji" />
                                        <input type="hidden" value="<?php echo $saldo_admin; ?>" name="saldo_admin" id="saldo_admin" />
                                        <input type="hidden" value="<?php echo $IDCabang; ?>" name="IDCabang" id="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Total Setor : </label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="number" min="0" name="total_setor" value="<?php echo $saldo_admin; ?>" id="bayar"/>
                                        <?php if (form_error("total_setor") != "") : ?>
                                            <span style="color: red;"><?php echo form_error("total_setor"); ?></span>                                  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Keterangan : </label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control siku" rows="3" name="keterangan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3"></label>
                                    <div class="col-lg-9">
                                        <button name="btn_submit" value="btn_submit" type="submit" class="btn btn-info siku" id="bayar_button">Setor Ke Bank</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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

//                                            $("#inputCheck").click(function () {
//                                                event.preventDefault();
//                                                var r = confirm("Apakah Data yang telah Di Masukan Benar?");
//                                                if (r == true) {
//                                                    var a = $(this).attr("href");
//                                                    window.location.assign(a);
//                                                }
//                                            });

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

    $("#bayar_button").click(function (event) {
        event.preventDefault();
        alertify.confirm('Apakah Data yang telah Di Masukan Benar?', function (e) {
            if (e) {
                $("#form_setor").submit();
            } else {
                //after clicking Cancel
            }
        });
    });
</script>