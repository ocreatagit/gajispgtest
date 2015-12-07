<?php date_default_timezone_set("Asia/Jakarta") ?>
<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px; border-bottom: #000 solid 1px;">LAPORAN PENJUALAN</h1>
        </div>
    </div>
    <div class="row" style="">
        <div class="col-lg-12">
            <h2 style="margin-top: 0px; border-bottom: #000 solid 1px; padding-bottom: 5px;">Informasi Penjualan</h2>
            <h3 style="">Lokasi &nbsp;&nbsp;: <b> <?php echo $laporan_penjualan->provinsi . " - " . $laporan_penjualan->kabupaten; ?> </b>
            </h3>
            <h3 style="padding-bottom: 10px;">Tanggal : <b><?php echo strftime("%d-%B-%Y", strtotime($laporan_penjualan->tanggal)) ?> </b> </h3>

            <table id="data-table" class="tablesorter tablesorter-blue" border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr style="background-color: whitesmoke;">
                        <th id="tengah">Lokasi</th>
                        <th id="tengah">Team Leader</th>
                        <th id="tengah">SPG</th>
                        <th id="tengah">Barang</th>
                        <th id="tengah" style="width: 60px;">Jumlah</th>
                        <th id="tengah">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $totalJual = 0;
                    foreach ($info_penjualans as $value):
                        ?>
                        <tr>
                            <td><?php echo $value->namalokasi ?></td>
                            <td><?php echo $value->namaTeamLeader ?></td>
                            <td><?php echo $value->namasales ?></td>
                            <td><?php echo $value->namabarang ?></td>
                            <td align="right" id="tengah"><?php echo $value->jumlah ?></td>
                            <td align="right">Rp.<?php echo number_format($value->penjualan, 0, ",", ".") ?>,-</td>
                        </tr>
                        <?php
                        $totalJual += $value->jumlah;
                        $total += $value->penjualan;
                    endforeach;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" align="right"><strong>Total Pendapatan</strong></td>
                        <td align="center"><?php echo number_format($totalJual, 0, ",", ".") ?></td>
                        <td align="right">Rp.<?php echo number_format($total, 0, ",", ".") ?>,-</td>
                    </tr>
                </tfoot>
            </table>
            <br>
            <h2 style="margin-top: 0px; border-bottom: #000 solid 1px; padding-bottom: 5px;">Total Penjualan Per Team Leader</h2>
            <table id="data-table" class="tablesorter tablesorter-blue" border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr style="background-color: whitesmoke;">
                        <th id="tengah">Nama Barang</th>
                        <th id="tengah">Team Leader</th>
                        <th id="tengah" style="width: 60px;">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalJual = 0;
                    foreach ($info_total_per_team_leader as $value):
                        ?>
                        <tr>
                            <td><?php echo $value->namabarang ?></td>
                            <td><?php echo $value->namaTeamLeader ?></td>
                            <td align="right" id="tengah"><?php echo $value->jumlah ?></td>
                        </tr>
                        <?php
                        $totalJual += $value->jumlah;
                    endforeach;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" align="right"><strong>Total Terjual</strong></td>
                        <td align="center"><?php echo number_format($totalJual, 0, ",", ".") ?></td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <h2 style=""> Keterangan : </h2>
    <div class="" style="width: 100%; border: #000 solid 1px; padding: 15px;">
        <?php echo $laporan_penjualan->keterangan; ?>
    </div>
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>"/>
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