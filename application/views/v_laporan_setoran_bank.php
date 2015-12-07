<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Daftar Setoran Bank</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href="<?php echo base_url(); ?>index.php/Laporan/daftar_setoran_bank"><i class="fa fa-home"></i> Daftar Setoran Bank</a></li>
            </ol>
        </div>
    </div>
    <?php if ($this->session->userdata("Level") != 0) { ?>
        <div style="background-color: white; height: 70px;">
            <div class="col-md-12">
                <a href="<?php echo base_url(); ?>index.php/laporan/setoran_bank" class="btn btn-primary" style="border-radius: 0px; margin-top: 10px;" style="border-radius: 0px;"><i class="fa fa-plus">&nbsp</i> Buat Setoran Bank</a>
            </div>
        </div>
        <?php }
    ?>

    <div class="col-md-12" style="background-color: white;">
        <table class='table table-striped table-hover' id="list_laporan">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Admin <?php
                        if ($this->session->userdata("Level") == 0) {
                            echo "Cabang";
                        }
                        ?></th>
                    <th>Total Setoran</th>
                    <!--<th>Aksi</th>-->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($laporans as $laporan):
                ?>
                    <tr>
                        <td><?php echo strftime("%d-%m-%Y", strtotime($laporan->tanggal)); ?></td>
                        <td><?php echo $laporan->provinsi." - ".$laporan->kabupaten; ?></td>
                        <td>Rp <?php echo number_format($laporan->jumlah, 0, ",", ".") ?>.- </td>
<!--                        <td style="width: 50px; text-align: center;">
                            <a href="<?php echo base_url(); ?>index.php/laporan/cetaklaporanpengeluaran/<?php echo $laporan->IDSetoran ?>" class="btn btn-sm btn-info siku"><i class="fa fa-print"></i></a>
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