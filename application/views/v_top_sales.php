<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Top Sales</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Top Sales</a></li>
            </ol>
        </div>
    </div>
    <div class="row" style="">
        <div class="col-lg-12">
            <div class="panel panel-default siku">
                <div class="panel-body siku">
                    <form class="form-horizontal" method="POST" action="<?php echo current_url(); ?>">
                        <?php if ($this->session->userdata('Level') == 0) {
                            ?>
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
                        <?php }
                        ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="exampleInputName2">Jenis Pencarian</label>                    
                            <label class="checkbox-inline"><input type="radio" checked name="kategori" value="Periode">Periode</label>
                            <label class="checkbox-inline"><input type="radio" name="kategori" value="Bulan">Bulan</label>
                        </div>
                        <div id="periode" class="form-group">
                            <label class="col-lg-2 control-label" for="exampleInputName2">Dari</label>
                            <div class="col-lg-3">
                                <input class="form-control siku" type="text" id="datepicker1" placeholder="Dari" name="tanggal_awal" value="">
                            </div>
                            <label class="col-lg-1 control-label" for="exampleInputName2">Sampai</label>
                            <div class="col-lg-3">
                                <input class="form-control siku" type="text" id="datepicker2" placeholder="Sampai" name="tanggal_akhir" value="">
                            </div>                    
                            <div class="col-lg-1">                        
                                <button class="btn btn-primary siku" type="submit" value="kategori" name="submit">Pilih</button>
                            </div>
                        </div>
                        <div id="monthly" class="form-group">
                            <label class="col-lg-2 control-label">Bulan</label>
                            <div class="col-lg-3">
                                <select class="form-control siku" name="monthly">
                                    <option selected disabled>-- Pilih Bulan --</option>
                                    <option value="1" >Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-lg-1">                        
                                <button class="btn btn-primary siku" type="submit" value="kategori" name="submit">Pilih</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="panel panel-default siku">
                <div class="panel-body siku">
                    <h2 style="margin-left: 15px; margin-top: 0px;">TOP SALES <?php echo $data ?></h2>
                    <div class="col-lg-12">
                        <?php
                        $counter = 1;
                        if (count($topbarangs) > 0) {
                            foreach ($topbarangs as $sales) :
                                ?> 
                                <div class="col-md-3">
                                    <div class="panel panel-success siku">
                                        <div class="panel-heading">
                                            <h5 style="font-size: x-large"><strong><?php echo $sales->nama ?></strong></h5>
                                        </div>
                                        <div class="panel-body">
                                            <div style="text-align: center;">
                                                <img src="<?php echo base_url() ?>uploads/<?php echo $sales->foto ?>" alt="<?php echo $sales->foto ?>" width="200" >
                                            </div>
                                            <?php if ($counter <= 3) { ?>
                                                <img src="<?php echo base_url() ?>images/peringkat<?php echo $counter ?>.png" alt="<?php echo $counter ?>" width="75" style="position: absolute; right: 14px; top: 0px;" > 
                                                <?php
                                            } else {
                                                echo "<h2 style='position: absolute; top: -10px; right: 25px;'>" . $counter . "</h2>";
                                            }
                                            $counter++;
                                            ?>
                                            <br>
                                            <strong>Total Pendapatan :<br> Rp. <?php echo number_format($sales->jumlah, 0, ',', '.') ?>,-</strong>
                                            <div style="position: absolute; bottom: 35px; right: 30px;">                                                
                                                <button type="button" class="btn-sm btn-primary siku" data-toggle="modal" data-target="#myModal<?php echo $sales->IDSales ?>"><i class='fa fa-pie-chart'></i>  </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        } else {
                            ?>
                            <div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> Tidak ada data penjualan pada periode ini</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <?php
    if (count($modalsales)) {
        foreach ($modalsales as $modal) {
            ?>
            <div class="modal fade" id="myModal<?php echo $modal[0]->IDSales ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Daftar Penjualan</h4>
                            <h4 class="modal-title">Nama : <?php echo $modal[0]->nama ?></h4>
                        </div>
                        <div class="modal-body">                            
                            <table>
                                <thead>
                                    <tr>
                                        <td>Nama Barang</td>
                                        <td>Jumlah Terjual</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($barangs as $semuabarang) {
                                        $tulis = true;
                                        ?>                                    
                                        <tr>
                                            <td><?php
                                                echo $semuabarang->namaBarang
                                                ?></td>
                                            <td>
                                                <?php foreach ($modal as $mbarang) { ?>
                                                    <?php
                                                    if ($semuabarang->namaBarang == $mbarang->namaBarang) {
                                                        echo $mbarang->jumlah;
                                                        $tulis = false;
                                                    }
                                                    ?>
                                                    <?php
                                                } if ($tulis) {
                                                    echo "0";
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <!-- modal -->
</div>


<script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>bootstrap/js/ajaxLaporan.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>Datatable/js/jquery.dataTables.js"></script>



<script>
    $(document).ready(function () {
        $("#lokasi").val('');
        $("#salesnya_admin").val('');
        $("#nama_produk").val('');
        $('#list_laporan').DataTable({});
        $('#monthly').hide();
        $(document).ready(function () {
            $('input[type=radio][name=kategori]').change(function () {
                if (this.value == 'Periode') {
                    $('#periode').show();
                    $('#monthly').hide();
                }
                else if (this.value == 'Bulan') {
                    $('#periode').hide();
                    $('#monthly').show();
                }
            });
        });
    });
</script>
<style type="text/css">
    .ui-datepicker-year, .ui-datepicker-month{
        color: black;
    }
</style>
<script>
    $("#datepicker1").datepicker({
        inline: true,
        dateFormat: "dd-mm-yy",
        changeYear: true,
        changeMonth: true
    });
    $("#datepicker2").datepicker({
        inline: true,
        dateFormat: "dd-mm-yy",
        changeYear: true,
        changeMonth: true
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


