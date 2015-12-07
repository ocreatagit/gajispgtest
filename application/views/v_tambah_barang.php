<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Tambah Barang</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Tambah Barang</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-danger siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Barang</h3>
                </div>
                <div class="panel-body siku">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($status != "") {
                                ?>
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> <?php echo $status ?>
                                </div>
                            <?php }
                            ?>
                            <form id="form_s" class="form-horizontal" method="POST" action="<?php echo base_url() ?>index.php/barang/tambah_barang" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Barang : </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_barang" class="form-control siku"placeholder="Masukkan Nama Barang" required="" title="Nama Barang Harus Diisi!">
                                        <input type="hidden" name="hid" value="7482hdyueldplf"/>
                                        <?php if (form_error("nama_barang") != "") {
                                            ?>
                                            <label style="color: red;"><?php echo form_error("nama_barang") ?></label>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Foto Barang : </label>
                                    <div class="col-sm-10" style="margin-top: 10px;">
                                        <input type="file" name="foto_barang" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" value="tambah_barang" name="btn_submit" class="btn btn-primary siku" id="inputCheck">Tambah Barang</button>
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div><br><br>
                    <div class="panel-footer" style="background-color: white;">
                        <strong>Daftar Stok Barang</strong><hr>
                        <div class="row">
                            <style>
                                td:first-child {
                                    text-align: center;
                                } 
                            </style>
                            <div class="row">
                                <?php foreach ($all_barang as $barang): ?>
                                    <div class="col-lg-3">
                                        <div class="panel panel-success siku">
                                            <div class="panel-heading">
                                                <h5 style="font-size: x-large"><strong><?php echo $barang->namaBarang ?></strong></h5>
                                            </div>
                                            <div class="panel-body">
                                                <div style="text-align: center;" class="text-center">
                                                    <?php
                                                    $this->load->helper("file");
                                                    $img = '';
                                                    $array = get_filenames("./barangs");
                                                    foreach ($array as $key => $value) {
                                                        if (strpos($value, $barang->IDBarang) !== FALSE) {
                                                            $img = $value;
                                                            break;
                                                        }
                                                    }
                                                    ?>
                                                    <img class="thumbnail" style="width: 200px" src="<?php echo base_url() ?>barangs/<?php echo $img ?>" />
                                                </div>
                                                <div style="text-align: center" id="tbl">
                                                    <a href='<?php echo base_url() ?>index.php/barang/barang_edit/<?php echo $barang->IDBarang ?>' class='btn btn-primary btn-sm siku'><i class='fa fa-pencil'></i> Edit</a>
                                                    <a href='<?php echo base_url() ?>index.php/barang/barang_delete/<?php echo $barang->IDBarang ?>' class='btn btn-danger btn-sm siku inputDelete' onclick="delete_barang(this)" id=""><i class='fa fa-trash'></i> Hapus</a>                                                   
                                                    <hr style="margin: .5em 0;">
                                                    <button type="button" class="btn-sm btn-success siku" data-toggle="modal" data-target="#ModalSatuan<?php echo $barang->IDBarang ?>"><i class='fa fa-bar-chart'></i> Input Satuan</button>
                                                    <button type="button" class="btn-sm btn-warning siku" data-toggle="modal" data-target="#ModalHarga<?php echo $barang->IDBarang ?>"><i class='fa fa-money'></i> Input Harga</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
        $counter = 0;
        $c_satuan = 0;
        foreach ($all_barang as $barang):
            ?>
            <!-- modal Satuan -->
            <div class="modal fade" id="ModalSatuan<?php echo $barang->IDBarang ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title text-center">Input Satuan</h2>
                            <br>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <h4 class="modal-title col-lg-3">Nama Barang : </h4>
                                    <div class="col-lg-4">
                                        <input class="form-control siku" type="text" value="<?php echo $barang->namaBarang ?>" readonly>
                                    </div>
                                </div>                                
                            </form>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" action="<?= base_url() ?>index.php/Barang/konversi_satuan/<?= $barang->IDBarang ?>" method="POST">                                
                                <h3>Satuan</h3>
                                <label class="col-sm-3 text-right">1 Karton :</label>
                                <div class="input-group col-sm-5">
                                    <input type="number" min="0" class="form-control siku text-right" name="satuan" placeholder="Satuan" value="<?php if(count($konv_satuan)>$c_satuan) echo $konv_satuan[$c_satuan++]->total_konversi ?>">
                                    <div class="input-group-addon siku">Lusin</div>
                                    <button class="btn btn-success form-control siku col-sm-offset-6" type="submit" name="btnSimpan" value="karton">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Satuan -->
            <!-- modal Harga -->
            <div class="modal fade" id="ModalHarga<?php echo $barang->IDBarang ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center">Input Harga Satuan</h4>
                            <br>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <h4 class="modal-title col-lg-3">Nama Barang : </h4>
                                    <div class="col-lg-4">
                                        <input class="form-control siku" type="text" value="<?php echo $barang->namaBarang ?>" readonly>
                                    </div>
                                </div>                                
                            </form>
                        </div>
                        <div class="modal-body">     
                            <form class="form-inline" action="<?= base_url() ?>index.php/Barang/harga_satuan/<?= $barang->IDBarang ?>" method="POST">
                                <div class="form-group">
                                    <label class="col-sm-4 text-right">1 Karton :</label>
                                    <div class="input-group col-lg-8">
                                        <div class="input-group-addon">Rp.</div>
                                        <input type="number" min="0" class="form-control text-right" value="<?php if (count($harga_satuan) > $counter) echo $harga_satuan[$counter]->IDBarang == $barang->IDBarang && $harga_satuan[$counter]->IDSatuan == '3' ? $harga_satuan[$counter++]->harga_konversi : 0 ?>" name="hargaKarton" placeholder="Harga">
                                        <div class="input-group-addon">.00</div>
                                    </div><br>
                                    <label class="col-sm-4 text-right">1 Lusin :</label>
                                    <div class="input-group col-lg-8">
                                        <div class="input-group-addon">Rp.</div>
                                        <input type="number" min="0" class="form-control text-right" value="<?php if (count($harga_satuan) > $counter) echo $harga_satuan[$counter]->IDBarang == $barang->IDBarang && $harga_satuan[$counter]->IDSatuan == '2' ? $harga_satuan[$counter++]->harga_konversi : 0 ?>" name="hargaLusin" placeholder="Harga">
                                        <div class="input-group-addon">.00</div>
                                    </div><br>
                                    <label class="col-sm-4 text-right">1 Pcs :</label>
                                    <div class="input-group col-lg-8">
                                        <div class="input-group-addon">Rp.</div>
                                        <input type="number" min="0" class="form-control text-right" value="<?php if (count($harga_satuan) > $counter) echo $harga_satuan[$counter]->IDBarang == $barang->IDBarang && $harga_satuan[$counter]->IDSatuan == '1' ? $harga_satuan[$counter++]->harga_konversi : 0 ?>" name="hargaPcs" placeholder="Harga">
                                        <div class="input-group-addon">.00</div>
                                    </div>
                                    <br>
                                    <br>
                                    <button class="btn btn-success col-sm-offset-6" type="submit" name="btn" value="harga">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Harga -->
        <?php endforeach; ?>
    </div>

    <script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>alertify/alertify.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>Datatable/js/jquery.dataTables.js"></script>
    <script>

                                                        alertify.defaults = {
                                                            // dialogs defaults
                                                            modal: true,
                                                            basic: false,
                                                            frameless: false,
                                                            movable: true,
                                                            resizable: true,
                                                            closable: true,
                                                            closableByDimmer: true,
                                                            maximizable: true,
                                                            startMaximized: false,
                                                            pinnable: true,
                                                            pinned: true,
                                                            padding: true,
                                                            overflow: true,
                                                            maintainFocus: true,
                                                            transition: 'pulse',
                                                            autoReset: true,
                                                            // notifier defaults
                                                            notifier: {
                                                                // auto-dismiss wait time (in seconds)  
                                                                delay: 5,
                                                                // default position
                                                                position: 'bottom-right'
                                                            },
                                                            // language resources 
                                                            glossary: {
                                                                // dialogs default title
                                                                title: 'Konfirmasi',
                                                                // ok button text
                                                                ok: 'OK',
                                                                // cancel button text
                                                                cancel: 'Cancel'
                                                            },
                                                            // theme settings
                                                            theme: {
                                                                // class name attached to prompt dialog input textbox.
                                                                input: 'ajs-input',
                                                                // class name attached to ok button
                                                                ok: 'ajs-ok',
                                                                // class name attached to cancel button 
                                                                cancel: 'ajs-cancel'
                                                            }
                                                        };

                                                        $("#inputCheck").click(function (event) {
                                                            event.preventDefault();
                                                            alertify.confirm('Apakah Data yang telah Di Masukan Benar?', function (e) {
                                                                if (e) {
                                                                    $("#form_s").submit();
                                                                } else {
                                                                    //after clicking Cancel
                                                                }
                                                            });
                                                        });

                                                        $("#tbl .inputDelete").click(function (event) {
                                                            event.preventDefault();
                                                            var a = this.href;
                                                            alertify.confirm('Hapus Barang yang diPilih?', function (e) {
                                                                if (e) {
                                                                    window.location.assign(a);
                                                                } else {
                                                                    //after clicking Cancel
                                                                }
                                                            });
                                                        });

                                                        $("#datatable").dataTable();

                                                        function delete_barang(btn) {
                                                            document.preventDefault();
                                                            alert();
                                                        }
    </script>
</body>
</html>