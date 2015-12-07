<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">
    <div class="row" style="">
        <div class="col-lg-12">
            <h2 class="page-header" style="margin-top: 0px;">History Gaji</h2>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li class="active"><i class="fa fa-home"></i> History Gaji</li>
            </ol>
        </div>
    </div>
    <!--    <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="alert();"><span aria-hidden="true">×</span></button>
            <strong>Berhasil</strong> untuk membuat laporan baru!
        </div>-->

<!--<input class="form-control siku" type="text" id="datepicker" placeholder="Pilih Tanggal" name="tanggal" value="<?php if ($this->session->userdata("tanggal_jual") != "") echo $this->session->userdata("tanggal_jual"); ?>">-->

    <div style="background-color: white; height: 120px;">
        <div class="col-md-12" style="margin-top: 17px;">
            <form class="form-inline" method="post" action="<?php echo current_url(); ?>">
                <div class="form-group">
                    <label for="exampleInputName2">Periode</label>
                    <input class="form-control siku" type="text" id="datepicker1" placeholder="Dari" name="tanggal_awal" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Sampai</label>
                    <input class="form-control siku" type="text" id="datepicker2" placeholder="Sampai" name="tanggal_akhir" value="">
                </div>
                <br>        
                <br>        
                <div class="form-group" style="margin-left: 27px; ">
                    <label for="filter">SPG</label>
                    <select name="filter" class="form-control siku">
                        <option>Semua SPG</option>
                        <option>SPG 1</option>
                    </select>
                </div>
                <button type="submit" name='btn_pilih' value='btn_pilih' class="btn btn-default siku">&nbsp;&nbsp;Pilih&nbsp;&nbsp;</button>
            </form>

        </div>
        <!--        <div class="col-md-1">
                    <dl class="dl-horizontal">
                        <dt>Periode</dt>
                        <dd><input class="form-control siku" type="text" id="datepicker" placeholder="Pilih Tanggal" name="tanggal" value=""></dd>
                    </dl>
                                <input class="form-control siku" type="text" id="datepicker" placeholder="Pilih Tanggal" name="tanggal" value="">
                </div>-->
    </div>
    <hr>
    <div class="col-md-12" style="background-color: white;">
        <table class='table table-striped table-hover' id="list_laporan" style="">
            <thead>
                <tr>
                    <!--<th>#</th>-->
                    <th>Tanggal</th>
                    <th>SPG</th>
                    <th>Gaji</th>
                    <th>Komisi</th>
                    <th>Total Gaji dan Komisi</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>

            <tfoot>
                
            </tfoot>
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
    $("#datepicker1").datepicker({
        inline: true,
        dateFormat: "dd-mm-yy"
    });
    $("#datepicker2").datepicker({
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