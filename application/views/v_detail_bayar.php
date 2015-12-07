<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Detail Bayar Gaji</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href="<?php echo base_url(); ?>index.php/Laporan/laporan_gaji"><i class="fa fa-home"></i> Daftar Laporan Pembayaran Gaji</a></li>
                <li><a href="">Detail Bayar Gaji </a></li>
            </ol>
        </div>
    </div>
    <div style="background-color: white; height: 70px;">
        <div class="col-md-12">
            <a href="<?php echo base_url(); ?>index.php/laporan/laporan_gaji" class="btn btn-primary" style="border-radius: 0px; margin-top: 10px;" style="border-radius: 0px;"><i class="fa fa-backward">&nbsp</i> Kembali</a>
        </div>
    </div>
    <div class="col-md-12" style="background-color: white;">
        <table class='table table-striped table-hover' id="list_laporan">
            <thead>
                <tr>
                    <!--<th>#</th>-->
                    <th>Tanggal</th>
                    <th>Admin</th>
                    <th>Total Pengeluaran</th>
                    <!--<th style="text-align: center;">Aksi</th>-->
                </tr>
            </thead>
            <tbody>
                <?php
                // $nomor = 1;
                foreach ($detail_bayars as $detail_bayar):
                    ?>
                    <tr>
                        <!--<td><?php echo $nomor++; ?></td>-->
                        <td><?php echo strftime("%d-%m-%Y", strtotime($detail_bayar->tanggal)); ?></td>
                        <td><?php echo $detail_bayar->nama; ?></td>
                        <td>Rp <?php echo number_format($detail_bayar->total_gaji, 0, ",", ".") ?>.- </td>
<!--                        <td style="text-align: center;">
                            <a href="<?php echo base_url(); ?>index.php/laporan/detail_gaji/<?php echo $detail_bayar->IDPenggajian ?>" class="btn btn-sm btn-default siku"><i class="fa fa-info"></i></a>
                            <a href="<?php echo base_url(); ?>index.php/laporan/cetaklaporan/<?php echo $detail_bayar->IDPenggajian ?>" class="btn btn-sm btn-info siku"><i class="fa fa-print"></i></a>
                        </td>-->
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
    $(document).ready(function() {
        $("#lokasi").val('');
        $("#salesnya_admin").val('');
        $("#nama_produk").val('');
        $('#list_laporan').DataTable({
            "order": [[0, "desc"]]
//            "bFilter": false,
//            "bPaginate": false,
//            "bLengthChange": false,
//            "bInfo": false,
//            "oLanguage": {
//                "sEmptyTable": '',
//                "sInfoEmpty": ''
//            },
//            "sEmptyTable": "",
        });
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
    });
</script>
</body>
</html>