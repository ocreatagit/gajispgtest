<?php date_default_timezone_set("Asia/Jakarta") ?>
<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px; border-bottom: #000 solid 1px; padding-bottom: 10px;">Laporan Pembayaran Gaji</h1>
        </div>
    </div>
    <div class="row" style="">
        <div class="col-lg-12">
            <h2 style="">Tanggal : <?php echo strftime("%d-%m-%Y", strtotime($laporan_bayar_gaji->tanggal)) ?></h2>
            <h2 style="border-bottom: #000 solid 1px; padding-bottom: 10px;">Detail Pembayaran</h2>
            <table id="data-table" class="tablesorter tablesorter-blue" border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr style="background-color: whitesmoke;">
                        <th id="tengah">Tanggal Pembayaran</th>
                        <th id="tengah">SPG</th>
                        <th id="tengah">Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($detail_bayar_gajis as $value):
                        ?>
                        <tr>
                            <td><?php echo strftime("%d-%m-%Y", strtotime($value->tanggal)) ?></td>
                            <td><?php echo $value->nama ?></td>
                            <td align="right">Rp. <?php echo number_format($value->total_gaji, 0, ',', '.') ?>.,-</td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" align="right"><strong>Total Bayar</strong></td>
                        <td align="right">Rp.<?php echo number_format($laporan_bayar_gaji->totalPenggajian, 0, ",", ".") ?>,-</td>
                    </tr>
                </tfoot>
            </table>
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
    $(document).ready(function() {
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

    $(document).ready(function() {
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
            title: 'Informasi',
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

    alertify
            .alert("Tekan tombol 'CTRL + P' Untuk Print Dokument!", function () {
//                alertify.message('OK');
            });
</script>
</body>
</html>