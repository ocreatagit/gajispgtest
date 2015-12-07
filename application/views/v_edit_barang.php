<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Edit Barang</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Edit Barang</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php if ($status_barang == 1) { ?>
                <div class="alert alert-warning siku alert-dismissible" role="alert">
                    <p style="margin-bottom: 10px;"> <strong>Peringatan!</strong> Barang ini sudah digunakan Laporan Harian! Apakah tetap Ingin Mengubahnya? </p>
                    <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <a href="" id="btn_ya" class="btn btn-default siku" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-check"></i> Ya</a>
                    <a href="<?php echo base_url() ?>index.php/barang/tambah_barang" class="btn btn-danger siku"><i class="fa fa-times"></i> Tidak</a>
                </div>
            <?php } ?>

            <div class="panel panel-danger siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Edit Barang</h3>
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
                            <form id="form_s" class="form-horizontal" method="POST" action="<?php echo current_url() ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Barang : </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_barang" class="form-control siku"placeholder="Masukkan Nama Barang" required="" title="Nama Barang Harus Diisi!" value="<?php echo set_value('nama_barang', $barang->namaBarang) ?>">
                                        <input type="hidden" name="hid" value="7482hdyueldplf"/>
                                        <input type="hidden" name="IDBarang" value="<?php echo $barang->IDBarang ?>"/>
                                        <?php if (form_error("nama_barang") != "") {
                                            ?>
                                            <label style="color: red;"><?php echo form_error("nama_barang") ?></label>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ganti Foto Barang : </label>
                                    <div class="col-sm-10" style="margin-top: 10px;">
                                        <input type="file" name="foto_barang" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Foto Barang : </label>
                                    <div class="col-sm-10" style="margin-top: 10px;">
                                        <img src="<?php echo base_url(); ?>barangs/<?php echo $gambar_barang ?>" class="thumbnail" style="width: 40%"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <a href="<?php echo base_url() ?>index.php/barang/tambah_barang" class="btn btn-default siku"><i class="fa fa-backward"></i> Kembali</a>
                                        <button id="btn_submit" type="submit" value="tambah_barang" name="btn_submit" class="btn btn-primary siku" id="inputCheck" <?php if ($status_barang == 1) {
                                            echo "disabled";
                                        } ?>>Edit Barang</button>
                                    </div>
                                </div>
                            </form>  
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

    $("#datatable").dataTable();

//    $("#btn_submit").attr("disabled", "disabled");

    $("#btn_ya").click(function () {
        $('#btn_submit').prop('disabled', false);
    });
</script>
</body>
</html>