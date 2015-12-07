<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Top Lokasi</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Top Lokasi</a></li>
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
                    <h2 style="margin-left: 15px; margin-top: 0px;">TOP LOKASI <?php echo $data ?></h2>
                    <div class="col-lg-6">
                        <table class="table table-hover">
                            <thead style="text-align: center; background-color: #ffcc33 ">
                                <tr>
                                    <td><strong>Peringkat</strong></td>
                                    <td><strong>Nama Lokasi</strong></td>
                                    <td><strong>Total Penjualan</strong></td>
                                    <td><strong>Produk Terjual</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1;
                                if (count($topbarangs) > 0) {
                                    foreach ($topbarangs as $barang) :
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php if ($counter <= 3) { ?>
                                                    <img src="<?php echo base_url() ?>images/peringkat<?php echo $counter ?>.png" alt="<?php echo $counter ?>" width="25" > 
                                                    <?php
                                                } else {
                                                    echo $counter;
                                                }
                                                $counter++;
                                                ?>
                                            </td>
                                            <td style="vertical-align: middle"><?php echo $barang->desa ?></td>
                                            <td style="vertical-align: middle">Rp. <?php echo number_format($barang->jumlah, 0, ',', '.') ?>,-</td>
                                            <!--<td class="text-center" style="vertical-align: middle;"> <button type="button" class="btn-sm btn-primary siku" ><i class='fa fa-pie-chart'></i> Lihat Data</button> </td>-->
                                            <td class="text-center" style="vertical-align: middle;"><button type="button" class="btn-sm btn-primary siku" data-toggle="modal" data-target="#myModal<?php echo $barang->IDLokasi ?>"><i class='fa fa-pie-chart'></i> Lihat Data</button></td>
                                        </tr>
                                        <?php
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center">Tidak ada data penjualan pada periode ini</td>
                                    </tr>                                    
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <?php
    if (count($modalbarang)) {
        for ($i = 0; $i < count($modalbarang); $i++):
            ?>
            <div class="modal fade" id="myModal<?php echo $modalbarang[$i]->IDLokasi ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Daftar Penjualan</h4>
                            <h4 class="modal-title">Lokasi : <?php echo $modalbarang[$i]->desa ?></h4>
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
                                    $temp = $i;
                                    foreach ($barangs as $barang) {
                                        ?>
                                        <tr>
                                            <td><?php echo $barang->namaBarang ?></td>
                                            <td><?php
                                                if ($temp < count($modalbarang)) {
                                                    if ($barang->IDBarang == $modalbarang[$temp]->IDBarang) {
                                                        echo $modalbarang[$temp]->jumlah;
                                                        if ($temp + 1 < count($modalbarang)) {
                                                            if ($modalbarang[$temp + 1]->IDLokasi == $modalbarang[$temp]->IDLokasi) {
                                                                $temp++;
                                                            }
                                                        }
                                                    } else {
                                                        echo 0;
                                                    }
                                                } else {
                                                    echo 0;
                                                }
                                                ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        endfor;
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

