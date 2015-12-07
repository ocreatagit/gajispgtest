<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Pengeluaran</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Pengeluaran</a></li>
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
                            <label for="inputPassword" class="col-sm-2 control-label">Jenis Pengeluaran</label>
                            <div class="col-sm-3">
                                <select id="jenispengeluaran" onchange="change_pengeluaran()" class="form-control siku" name='jenis_pengeluaran'>
                                    <option value="Semua Jenis">Semua Jenis</option>
                                    <option value="Bensin">Bensin</option>
                                    <option value="Makan">Makan</option>
                                    <option value="Parkir">Parkir</option>
                                    <option value="Tol">Tol</option>
                                    <option value="Gaji">Gaji</option>
                                    <option value="Komisi">Komisi</option>
                                    <option value="Lain-Lain">Lain-lain</option>
                                </select>                                
                            </div>
                        </div>
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
                            <div class="col-lg-3">                        
                                <button class="btn btn-primary siku" type="submit" value="kategori" name="submit">Pilih</button>
                                <button class="btn btn-success siku" type="submit" value="excel" name="btn_convert"><i class="fa fa-book"></i> Export To XLS</button>

                            </div>
                        </div>
                        <div id="monthly" class="form-group">
                            <label class="col-lg-2 control-label">Bulan</label>
                            <div class="col-lg-3">
                                <select class="form-control siku" name="monthly">
                                    <option selected disabled>-- Pilih Bulan --</option>
                                    <option value="1">Januari</option>
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
                            <div class="col-lg-3">                        
                                <button class="btn btn-primary siku" type="submit" value="kategori" name="submit">Pilih</button>
                                <button class="btn btn-success siku" type="submit" value="excel" name="btn_convert"><i class="fa fa-book"></i> Export To XLS</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default siku">
                <div class="panel-body siku">
                    <h2 style="margin-left: 15px; margin-top: 0px;">Pengeluaran <small><?php echo $searchby ?> - Periode <?php echo $data ?></small></h2>

                    <div class="col-lg-6" style="height: 500px; overflow-y: auto;">
                        <table class="table table-hover" id="datatable">
                            <thead style="text-align: center; background-color: #ffcc33 ">
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <?php if ($kolom): ?>
                                        <td><strong>Keterangan</strong></td>
                                    <?php endif; ?>
                                    <td><strong>Jumlah Pengeluaran</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                if (count($isi_tabel) > 0) {
                                    foreach ($isi_tabel as $isi):
                                        ?>
                                        <tr>
                                            <td><?php echo date('d-m-Y', strtotime($isi->tanggal)) ?></td>
                                            <?php if ($kolom): ?>
                                                <td><?php echo $isi->keterangan . ($isi->keterangan_lanjut != "" ? " - " . $isi->keterangan_lanjut : "" ) ?></td>
                                            <?php endif; ?>
                                            <td>Rp. <?php echo number_format($isi->jumlah, 0, ',', '.') ?>,-</td>
                                        </tr>
                                        <?php
                                        $total+= $isi->jumlah;
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center">Tidak ada data penjualan pada periode ini</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td <?php echo $kolom ? 'colspan="2"' : '' ?> align="right"> Total Pengeluaran </td>
                                    <td  align="left">Rp. <?php echo number_format($total, 0, ',', '.') ?>,-</td>
                                </tr>
                            </tfoot>
                        </table>
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
                                    $(document).ready(function () {
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
</script>
</body>
</html>



