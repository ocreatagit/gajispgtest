<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Master Data Toko</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Master Data Toko</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-danger siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Toko</h3>
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
                                    <label class="col-sm-2 control-label">Nama Toko : </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_toko" class="form-control siku"placeholder="Masukkan Nama Toko" required="" title="Nama Toko Harus Diisi!">                                                                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Alamat : </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="alamat_toko" class="form-control siku"placeholder="Masukkan Alamat Toko" required="" title="Alamat Harus Diisi!">
                                        <input type="hidden" name="hid" value="7482hdyueldplf"/>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" value="tambah_toko" name="btn_submit" class="btn btn-primary siku" id="inputCheck">Tambah Toko</button>
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div><br><br>
                    <div class="panel-footer" style="background-color: white;">
                        <strong>Daftar Stok Barang</strong><hr>
                        <div class="row col-sm-10">
                            <table class="table table-hover">
                                <thead style="background-color: yellow">
                                    <tr>
                                        <td><strong>Nama Toko</strong></td>
                                        <td><strong>Alamat</strong></td>
                                        <td><strong>Aksi</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="col-sm-2">
                                            <a href="<?php echo base_url(); ?>index.php/" class="btn btn-sm btn-info siku"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="<?php echo base_url(); ?>index.php/" class="btn btn-sm btn-danger siku">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
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

