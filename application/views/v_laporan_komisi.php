<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header" style="margin-top: 0px;">Laporan Pembayaran Komisi</h1>
        </div>
        <?php if ($this->session->userdata("Level") != 0) { ?>
            <div class="col-lg-6">
                <h1 class="page-header" style="margin-top: 0px;">Saldo : Rp.<?php echo number_format($saldo, 0, ",", '.') ?>,-</h1>
            </div>
        <?php } ?>
    </div>
    <div class="row" style="">
        <div class="col-lg-12">
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Daftar Laporan Pembayaran Komisi</a></li>
            </ol>
        </div>
    </div>
    <!--    <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="alert();"><span aria-hidden="true">×</span></button>
            <strong>Berhasil</strong> untuk membuat laporan baru!
        </div>-->
    <?php if ($this->session->userdata("Level") != 0) { ?>
        <div style="background-color: white; height: 70px;">
            <div class="col-md-12">
                <a href="<?php echo base_url(); ?>index.php/komisi/tambah_komisi" class="btn btn-primary" style="border-radius: 0px; margin-top: 10px;" style="border-radius: 0px;"><i class="fa fa-plus">&nbsp</i> Bayar Komisi</a>
            </div>
        </div>
        <?php
    } else {
        if ($filter != "") {
            ?>
            <div class="alert alert-info alert-dismissible siku" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Pencarian Berdasarkan '<?php echo $filter; ?>'
            </div>
        <?php } ?>
        <form style="background-color: white; padding: 15px 10px 10px 5px;; margin-bottom: 10px;" class="form-horizontal" action="<?php echo current_url() ?>" method="POST">
            <div class="form-group">
                <label for="exampleInputName2" class="control-label col-lg-2" style=""> Cabang : </label>
                <div class="col-lg-3">
                    <select name="cabang" class="form-control siku">
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
                    <button type="submit" name='btn_submit' value='btn_pilih' class="btn btn-primary siku">&nbsp;&nbsp;Pilih&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
    <?php } ?>
    <div class="col-md-12" style="background-color: white;">
        <table class='table table-striped table-hover' id="list_laporan">
            <thead>
                <tr>
                    <!--<th>#</th>-->
                    <th>Tanggal</th>
                    <th>Admin</th>
                    <th>Total Pengeluaran</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // $nomor = 1;
                foreach ($laporans as $laporan):
                    ?>
                    <tr>
                        <!--<td><?php echo $nomor++; ?></td>-->
                        <td><?php echo strftime("%d-%m-%Y", strtotime($laporan->tanggal)); ?></td>
                        <td><?php echo $laporan->username; ?></td>
                        <td>Rp <?php echo number_format($laporan->totalPenggajian, 0, ",", ".") ?>.- </td>
                        <td style="text-align: center;">
                            <a href="<?php echo base_url(); ?>index.php/komisi/detail_komisi/<?php echo $laporan->IDPenggajian ?>" class="btn btn-sm btn-default siku"><i class="fa fa-info"></i></a>
                            <a href="<?php echo base_url(); ?>index.php/komisi/cetak_laporan_komisi/<?php echo $laporan->IDPenggajian ?>" class="btn btn-sm btn-info siku"><i class="fa fa-print"></i></a>
                            <!--<a href="<?php echo base_url(); ?>index.php/ubah/laporan/<?php echo $laporan->IDPenggajian ?>" class="btn btn-sm btn-primary siku"><i class="fa fa-pencil"></i></a>-->
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