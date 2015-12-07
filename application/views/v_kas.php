<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">
    <div class="row" style="">
        <div class="col-lg-6">            
            <h1 class="page-header" style="margin-top: 0px;">Kas</h1>
        </div>
        <div class="col-lg-6" style="background-color: whitesmoke">
            <h1 class="" id="saldo" style="margin-top: 0px;">Saldo : Rp.<?php echo number_format($saldo, 0, ",", ".") ?>,-</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href="<?php echo base_url(); ?>index.php/Laporan/harian"><i class="fa fa-home"></i> Kas </a></li>
            </ol>
        </div>
    </div>
    <!--    <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="alert();"><span aria-hidden="true">×</span></button>
            <strong>Berhasil</strong> untuk membuat laporan baru!
        </div>-->
    <?php
    if ($filter != "") {
        ?>
        <div class="alert alert-info alert-dismissible siku" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Pencarian Berdasarkan <b>'<?php echo $filter; ?>'</b>
        </div>
    <?php } ?>
    <?php if ($this->session->userdata('Level') == 0) {
        ?>
        <form style="background-color: white; padding: 15px 10px 10px 5px;; margin-bottom: 10px;" class="form-horizontal" action="<?php echo current_url() ?>" method="POST">
            <div class="form-group">
                <label for="exampleInputName2" class="control-label col-lg-2" style=""> Cabang : </label>
                <div class="col-lg-3">
                    <select name="cabang" class="form-control siku" onclick="" id="cabang">
                        <option value="0">--- Semua Cabang ---</option>
                        <?php
                        foreach ($cabangs as $cabang) {
                            ?>
                            <option value="<?php echo $cabang->idcabang ?>"><?php echo $cabang->provinsi . " - " . $cabang->kabupaten ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-2">
                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>"/> 
                    <button type="submit" name='btn_submit' value='btn_pilih' class="btn btn-primary siku">&nbsp;&nbsp;Pilih&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
    <?php }
    ?>
    <div class="col-md-12" style="background-color: white;">
        <table class='table table-striped table-hover' id="list_laporan">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Total Penjualan</th>
                    <th>Status</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // $nomor = 1;
                foreach ($laporans as $laporan):
                    ?>
                    <tr>
                        <td><?php echo strftime("%d-%m-%Y", strtotime($laporan->tanggal)) ?> </td>
                        <td>Rp.<?php echo number_format($laporan->totalPenjualan, 0, ",", ".") ?>.- </td>
                        <td>
                            <?php if ($laporan->status_kas == 0) { ?>
                                <button class="btn btn-default btn-sm siku"><i class="fa fa-minus"></i> Data Belum Diinputkan!</button>
                            <?php } else { ?>
                                <button class="btn btn-success btn-sm siku"><i class="fa fa-check"></i> Data Telah Diinputkan!</button>
                            <?php } ?>
                        </td>
                        <td width="30%" align="center">
                            <a href="<?php echo base_url(); ?>index.php/laporan/cetaklaporan/<?php echo $laporan->idlaporan ?>" class="btn btn-primary siku"><i class="fa fa-info"></i> Detail</a>
                            <?php
                            if ($this->session->userdata("Level") != 0) {
                                if ($laporan->status_kas == 0) {
                                    ?>
                                    <a href="<?php echo base_url(); ?>index.php/laporan/hitung_saldo_laporan/<?php echo $laporan->idlaporan ?>" style="background-color: #4191ff; color: white;" class="btn siku"><i class="fa fa-forward"></i> Masuk ke Kas</a>
                                <?php } else {
                                    ?>
                                    <a href="<?php echo base_url(); ?>index.php/laporan/batal_saldo_laporan/<?php echo $laporan->idlaporan ?>" style="" class="btn btn-danger siku"><i class="fa fa-times-circle"></i> Batalkan Penjualan</a>
                                    <?php
                                }
                            }
                            ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>bootstrap/js/ajaxLaporan.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>Datatable/js/jquery.dataTables.js"></script>



<script>
    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "date-dmy-pre": function (a) {
            if (a == null || a == "") {
                return 0;
            }
            var date = a.split('-');
            return (date[2] + date[1] + date[0]) * 1;
        },
        "date-dmy-asc": function (a, b) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },
        "date-dmy-desc": function (a, b) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
    });

    $(document).ready(function () {
        $("#lokasi").val('');
        $("#salesnya_admin").val('');
        $("#nama_produk").val('');
        $('#list_laporan').DataTable({
            "order": [[0, "desc"]],
            "aoColumnDefs": [
                {"sType": "date-dmy", "aTargets": [0]}
            ]
        });
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
    });
</script>
</body>
</html>