<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <?php if ($this->session->userdata("Level") != 0) { ?>
                <h1 class="page-header" style="margin-top: 0px;">Input Stok</h1>
                <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                    <li><a href="<?php echo base_url(); ?>index.php/Laporan/stok_cabang"><i class="fa fa-home"></i> Stok </a></li>
                </ol>
            <?php } else {
                ?><h1 class="page-header" style="margin-top: 0px;">Input Stok Cabang</h1>
                <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                    <li><a href="<?php echo base_url() ?>index.php/barang/super_admin_input_data"><i class="fa fa-home"></i> Stok Cabang</a></li>
                    <li><a href="">Input Stok </a></li>
                </ol>
            <?php }
            ?>
        </div>
    </div>
    <div class="row" style="background-color: white; margin: 0px; padding-top: 15px;">
        <div class="col-lg-12">
            <div class="panel panel-danger siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Barang</h3>
                </div>
                <div class="panel-body siku">
                    <div class="row">
                        <div class="col-lg-12">                            
                            <form class="form-horizontal" method="POST" action="<?php echo base_url() ?>index.php/barang/tambah_barang_lokasi">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Admin: </label>
                                    <div class="col-sm-10">
                                        <!--<input type="text" name="nama_lokasi" value="<?php echo $Cabang; ?>" disabled="true" class="form-control siku"/>-->
                                        <label class="control-label"><?php echo $username ?></label>
                                    </div>
                                    <input type="hidden" name="kode_lokasi" value="<?php echo $IDCabang; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Barang: </label>
                                    <div class="col-sm-10">                                                                                
                                        <select name="kode_barang" class="form-control">                                           
                                            <?php foreach ($all_barang as $barang) : ?>
                                                <option value="<?php echo $barang->IDBarang; ?>"><?php echo $barang->namaBarang; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Stok (Pcs): </label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" name="jumlah_barang" class="form-control siku" placeholder="Masukkan Stok Barang" aria-describedby="basic-addon2">
                                        <!--<span class="input-group-addon" id="basic-addon2">Pcs</span>-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <?php if ($level == 0) { ?>
                                            <a href="<?php echo base_url() ?>index.php/barang/super_admin_input_data" class="btn btn-default siku"><i class="fa fa-backward"></i> Kembali</a>
                                        <?php } ?>
                                        <button type="submit" value="tambah_barang_lokasi" name="btn_submit" class="btn btn-primary siku">Tambah Barang</button>
                                    </div>
                                </div>
                            </form>

                            <div class="panel-footer" style="background-color: white;">
                                <strong>Daftar Lokasi Penjualan</strong>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-offset-3 col-sm-6 table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <td><strong>No.</strong></td>
<!--                                                    <td>Provinsi</td>
                                                    <td>Kabupaten/Kota</td>-->
                                                    <td><strong>Nama Barang</strong></td>
                                                    <td><strong>Stok</strong></td>
                                                    <td><strong>Aksi</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (count($barang_lokasi) == 0) {
                                                    ?>
                                                    <tr><td colspan="5"> Tidak Terdapat Data!</td></tr>
                                                    <?php
                                                } else {
                                                    $no = 1;
                                                    foreach ($barang_lokasi as $row) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no ?></td>
        <!--                                                            <td><?php // echo $row->provinsi     ?></td>
                                                            <td><?php // echo $row->kabupaten     ?></td>-->
                                                            <td><?php echo $row->namaBarang ?></td>
                                                            <td><?php echo $row->jumlah ?></td>  
                                                            <td>
                                                                <button type="button" class="btn-sm btn-primary siku" data-toggle="modal" data-target="#myModal<?php echo $row->IDBarang ?>"><i class='fa fa-pencil'></i> Ubah</button></td>
                                                        </tr>
                                                        <?php
                                                        $no++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>                                        
                                </div>
                            </div
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modals -->
<?php foreach ($barang_lokasi as $row): ?>
    <div class="modal fade" id="myModal<?php echo $row->IDBarang ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah Stok Barang</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="<?php echo base_url() ?>index.php/barang/ubah_stok">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Barang: </label>
                            <div class="col-sm-9">   
                                <label class="control-label"><?php echo $row->namaBarang ?> </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Stok (Pcs): </label>
                            <div class="col-sm-9">
                                <input type="number" value="<?php echo $row->jumlah ?>" min="0" name="jumlah_barang" class="form-control siku" placeholder="Masukkan Stok Barang" aria-describedby="basic-addon2">
                                <!--<span class="input-group-addon" id="basic-addon2">Pcs</span>-->
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="hidden" name="IDBarang" value="<?php echo $row->IDBarang; ?>" >
                                <input type="hidden" name="IDCabang" value="<?php echo $row->IDCabang; ?>" >
                                <input type="hidden" name="lokasi" value="<?php echo $row->kabupaten; ?> - <?php echo $row->provinsi; ?>" >
                                <button type="submit" value="tambah_barang_lokasi" name="btn_submit" class="btn btn-primary siku">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- end modals -->
<script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>

</body>
</html>
