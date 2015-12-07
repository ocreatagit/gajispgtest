<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Top Penjualan Sales</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Top Penjualan Sales</a></li>
            </ol>
        </div>
    </div>
    <!--    <div class="row" style="">
            <div class="col-lg-12">
                <h2 class="page-header" style="margin-top: 0px;">Top Penjualan Sales</h2>
                <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                    <li class="active"><i class="fa fa-home"></i> Top Penjualan Sales</li>
                </ol>
            </div>
        </div>-->
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info siku" role="alert"><b>Pilih Filter Untuk Melihat Secara Total Penjualan Sales<br></b><br>
                <form class="form-horizontal" action="<?php echo current_url(); ?>" method="POST" style="color: black;">
                    <div class="form-group container">
                        <div class="row container">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Periode</label>
                                    <input class="form-control siku" type="text" id="datepicker1" placeholder="Sampai" name="tanggal_awal" value="">
                                </div>
                            </div>
                            <div class="col-md-1"> </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sampai</label>
                                    <input class="form-control siku" type="text" id="datepicker2" placeholder="Sampai" name="tanggal_akhir" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row container">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <button type="submit" name="btn_sumit" value="btn_sumit" class="btn btn-primary siku" style="width: 100%;">Pilih</button>
                                </div> 
                            </div>
                        </div>
                        <hr>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary siku">
                            <div class="panel-heading siku">
                                <h3 class="panel-title">Top Penjualan Sales</h3>
                            </div>
                            <div class="panel-body siku">
                                <div class="row">
                                    <?php
                                    $ke = 1;
                                    foreach ($laporans as $laporan):
                                        ?>
                                        <div class='col-sm-3 col-md-3'>
                                            <div class='thumbnail siku'>
                                                <img data-holder-rendered='true' src='<?php echo base_url() ?>uploads/<?php echo $laporan->foto ?>' style='height: 250px; width: 100%; display: block;' data-src='holder.js/100%x200' alt='100%x200'>
                                                <div class='caption'>
                                                    <h1 style='margin-top: -260px; position: absolute; font-size: 50px;'><?php echo $ke; ?></h1>
                                                    <p>Nama : <?php echo $laporan->nama ?><br/></p>
                                                    <p><strong>Total Penjualan: </strong><br>Rp <?php echo number_format($laporan->totalpenjualan, 0, ',', '.') ?>,-</p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                    $ke++;
                                    endforeach; ?>
                                    <!--                                    <div class="col-sm-3 col-md-3">
                                                                            <div class="thumbnail siku">
                                                                                <img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjI0IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDYyNCAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTRmZDIxZWNiMmIgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZTozMXB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNGZkMjFlY2IyYiI+PHJlY3Qgd2lkdGg9IjYyNCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIyMzEuNTU4MzM0MzUwNTg1OTQiIHk9IjExNC4xIj42MjR4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+" style="height: 200px; width: 100%; display: block;" data-src="holder.js/100%x200" alt="100%x200">
                                                                                <div class="caption">
                                                                                    <h1 style="margin-top: -210px; position: absolute; font-size: 50px;">1</h1>
                                                                                    <p>Nama : blablabla<br>
                                                                                        Penjualan : <br>
                                                                                    <ol>
                                                                                        <li>Babylon 30ml: 120pcs</li>
                                                                                        <li>Babylon 430ml: 25pcs</li>
                                                                                    </ol>
                                                                                    </p>
                                                                                    <p><strong>Total Penjualan: </strong>Rp 1.623.343
                                                                                    </p>
                                                                                    <br>
                                                                                    <p>
                                                                                        <a href="#" class="btn btn-primary siku" role="button" style="width: 100%;">Lihat Detail!</a> 
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                      
                                                                        <div class="col-sm-3 col-md-3">
                                                                            <div class="thumbnail siku">
                                                                                <img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjI0IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDYyNCAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTRmZDIxZWNiMmIgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZTozMXB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNGZkMjFlY2IyYiI+PHJlY3Qgd2lkdGg9IjYyNCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIyMzEuNTU4MzM0MzUwNTg1OTQiIHk9IjExNC4xIj42MjR4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+" style="height: 200px; width: 100%; display: block;" data-src="holder.js/100%x200" alt="100%x200">
                                                                                <div class="caption">
                                                                                    <h1 style="margin-top: -210px; position: absolute; font-size: 50px;">2</h1>
                                                                                    <p>Nama : blablabla<br>
                                                                                        Penjualan : <br>
                                                                                    <ol>
                                                                                        <li>Babylon 30ml: 120pcs</li>
                                                                                        <li>Babylon 430ml: 25pcs</li>
                                                                                    </ol>
                                                                                    </p>
                                                                                    <p><strong>Total Penjualan: </strong>Rp 1.623.343
                                                                                    </p>
                                                                                    <br>
                                                                                    <p>
                                                                                        <a href="#" class="btn btn-primary siku" role="button" style="width: 100%;">Lihat Detail!</a> 
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                      
                                                                        <div class="col-sm-3 col-md-3">
                                                                            <div class="thumbnail siku">
                                                                                <img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjI0IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDYyNCAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTRmZDIxZWNiMmIgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZTozMXB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNGZkMjFlY2IyYiI+PHJlY3Qgd2lkdGg9IjYyNCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIyMzEuNTU4MzM0MzUwNTg1OTQiIHk9IjExNC4xIj42MjR4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+" style="height: 200px; width: 100%; display: block;" data-src="holder.js/100%x200" alt="100%x200">
                                                                                <div class="caption">
                                                                                    <h1 style="margin-top: -210px; position: absolute; font-size: 50px;">3</h1>
                                                                                    <p>Nama : blablabla<br>
                                                                                        Penjualan : <br>
                                                                                    <ol>
                                                                                        <li>Babylon 30ml: 120pcs</li>
                                                                                        <li>Babylon 430ml: 25pcs</li>
                                                                                    </ol>
                                                                                    </p>
                                                                                    <p><strong>Total Penjualan: </strong>Rp 1.623.343
                                                                                    </p>
                                                                                    <br>
                                                                                    <p>
                                                                                        <a href="#" class="btn btn-primary siku" role="button" style="width: 100%;">Lihat Detail!</a> 
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                      
                                                                        <div class="col-sm-3 col-md-3">
                                                                            <div class="thumbnail siku">
                                                                                <img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjI0IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDYyNCAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTRmZDIxZWNiMmIgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZTozMXB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNGZkMjFlY2IyYiI+PHJlY3Qgd2lkdGg9IjYyNCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIyMzEuNTU4MzM0MzUwNTg1OTQiIHk9IjExNC4xIj42MjR4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+" style="height: 200px; width: 100%; display: block;" data-src="holder.js/100%x200" alt="100%x200">
                                                                                <div class="caption">
                                                                                    <h1 style="margin-top: -210px; position: absolute; font-size: 50px;">4</h1>
                                                                                    <p>Nama : blablabla<br>
                                                                                        Penjualan : <br>
                                                                                    <ol>
                                                                                        <li>Babylon 30ml: 120pcs</li>
                                                                                        <li>Babylon 430ml: 25pcs</li>
                                                                                    </ol>
                                                                                    </p>
                                                                                    <p><strong>Total Penjualan: </strong>Rp 1.623.343
                                                                                    </p>
                                                                                    <br>
                                                                                    <p>
                                                                                        <a href="#" class="btn btn-primary siku" role="button" style="width: 100%;">Lihat Detail!</a> 
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                      -->
                                </div>                                    
                            </div>
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