<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Tambah Lokasi</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Tambah Lokasi</a></li>
            </ol>
        </div>
    </div>
    <!--<div--> 
    <div class="row" style="">
        <div class="col-lg-12">
            <div class="panel panel-default siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Form Tambah Lokasi Penjualan</h3>
                </div>
                <div class="panel-body siku">
                    <?php if ($status != "") {
                        ?>
                        <div class='alert alert-info'><?php echo $status; ?></div>
                        <?php
                    }
//                    echo $this->session->userdata("Level"); exit;
                    ?>
                    <form id="form_s" class="form-horizontal" method="post" action="#">
                        <input type="hidden" name="hid" value="7482hdyueldplf"/>
                        <?php if ($this->session->userdata("Level") == 0) { ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Provinsi: </label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php set_value('provinsi'); ?>" class="form-control siku" name="provinsi" id="provinsi" placeholder="Masukkan Provinsi">
                                    
                                    <?php if (form_error("provinsi") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("provinsi"); ?></span>                                  
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kabupaten / Kota: </label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php set_value('kabupaten'); ?>" class="form-control siku" name="kabupaten" placeholder="Masukkan Kabupaten">
                                    <?php if (form_error("kabupaten") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("kabupaten"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kecamatan: </label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo set_value('kecamatan'); ?>" class="form-control siku" id="inputPassword" name="kecamatan" placeholder="Masukkan Kecamatan" disabled="">
                                    <?php if (form_error("kecamatan") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("kecamatan"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Desa / Kelurahan: </label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo set_value('desa'); ?>" class="form-control siku" id="inputPassword" name="desa" placeholder="Masukkan Desa / Kelurahan" disabled="">
                                    <?php if (form_error("desa") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("desa"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Admin Laporan : </label>
                                <div class="col-sm-4">
                                    <?php
                                    if (count($admin) == 0) {
                                        ?>
                                        <input type="text" value="Tidak Terdapat Admin!" class="form-control siku" id="inputPassword" name="desa" disabled="">
                                        <?php
                                    } else {
                                        ?>
                                        <select class="form-control" name="IDAdmin">
                                            <?php foreach ($admin as $row):
                                                ?>
                                                <option value="<?php echo $row->IDAdmin ?>"><?php echo $row->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php
                                    }
                                    ?>                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Admin Kantor : </label>
                                <div class="col-sm-4">
                                    <?php
                                    if (count($admin_kantor) == 0) {
                                        ?>
                                        <input type="text" value="Tidak Terdapat Admin!" class="form-control siku" id="inputPassword" name="desa" disabled="">
                                        <?php
                                    } else {
                                        ?>
                                        <select class="form-control" name="IDAdmin_kantor">
                                            <?php foreach ($admin_kantor as $row):
                                                ?>
                                                <option value="<?php echo $row->IDAdmin ?>"><?php echo $row->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php
                                    }
                                    ?>                                
                                </div>
                            </div>
                        <?php } else if ($this->session->userdata("Level") == 1) {
                            ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Provinsi: </label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo $cabang->provinsi ?>" class="form-control siku" name="provinsi" id="provinsi" placeholder="Masukkan Provinsi" disabled="">
                                    <input type="hidden" value="<?php echo $cabang->IDCabang ?>" name="IDCabang"/>
                                    <?php if (form_error("provinsi") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("provinsi"); ?></span>                                  
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kabupaten / Kota: </label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo $cabang->kabupaten ?>" class="form-control siku" name="kabupaten" placeholder="Masukkan Kabupaten" disabled="">
                                    <?php if (form_error("kabupaten") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("kabupaten"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kecamatan: </label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo set_value('kecamatan'); ?>" class="form-control siku" id="inputPassword" name="kecamatan" placeholder="Masukkan Kecamatan">
                                    <?php if (form_error("kecamatan") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("kecamatan"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Desa / Kelurahan: </label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo set_value('desa'); ?>" class="form-control siku" id="inputPassword" name="desa" placeholder="Masukkan Desa / Kelurahan">
                                    <?php if (form_error("desa") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("desa"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button id="inputCheck" type="submit" class="btn btn-primary siku" value="Simpan" name="btn_submit">Tambah Lokasi Penjualan</button>
                            </div>
                        </div>
                    </form>

                </div><br><br>
                <div class="panel-footer" style="background-color: white;">
                    <strong>Daftar Lokasi Penjualan</strong>
                    <hr>
                    <div class="row">
                        <div class="table-responsive" style="padding: 10px 30px 10px 30px;;">
                            <table class="table table-hover table-striped" id="datatable">
                                <?php
                                if ($this->session->userdata("Level") == 0) {
                                    if (count($lokasi) == 0) {
                                        ?>
                                        <thead>
                                            <tr>
                                                <td>No.</td>
                                                <td>Provinsi</td>
                                                <td>Kabupaten/Kota</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td colspan="5"> Tidak Terdapat Data!</td></tr>
                                        </tbody>
                                        <?php
                                    } else {
                                        ?>
                                        <thead>
                                            <tr>
                                                <td>No.</td>
                                                <td>Provinsi</td>
                                                <td>Kabupaten/Kota</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($lokasi as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $row->provinsi ?></td>
                                                    <td><?php echo $row->kabupaten ?></td>
                                                    <td><a href="<?php echo base_url(); ?>index.php/barang/tambah_barang_lokasi/<?php echo $row->IDCabang; ?>/<?php echo $row->kabupaten . " - " . $row->provinsi; ?>" class="btn-sm btn-primary siku" >Tambah Stok</a></td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                        <?php
                                    }
                                } else if ($this->session->userdata("Level") == 1) {
                                    if (count($lokasi) == 0) {
                                        ?>
                                        <thead>
                                            <tr>
                                                <td>No.</td>
                                                <td>Provinsi</td>
                                                <td>Kabupaten/Kota</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td colspan="5"> Tidak Terdapat Data!</td></tr>
                                        </tbody>
                                        <?php
                                    } else {
                                        ?>
                                        <thead>
                                            <tr>
                                                <td>No.</td>
                                                <td>Provinsi</td>
                                                <td>Kabupaten/Kota</td>
                                                <td>Kecamatan</td>
                                                <td>Desa</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($lokasi as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $row->provinsi ?></td>
                                                    <td><?php echo $row->kabupaten ?></td>
                                                    <td><?php echo $row->kecamatan ?></td>
                                                    <td><?php echo $row->desa ?></td>
                                                    <td style="text-align: center;"><a href="<?php echo base_url() ?>index.php/lokasi/delete_lokasi/<?php echo $row->IDLokasi ?>" onclick="return confirm('Apakah anda yakin menghapus lokasi ( <?php echo $row->desa ?> )')" class="btn-sm btn-danger" >X</a> </td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
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
<script src="<?php echo base_url(); ?>alertify/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>Datatable/js/jquery.dataTables.js"></script>
<script>
    $("#datatable").dataTable();
</script>
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

    $("#inputCheck").click(function(event) {
        event.preventDefault();
        alertify.confirm('Apakah Data yang telah Di Masukan Benar?', function(e) {
            if (e) {
                $("#form_s").submit();
            } else {
                //after clicking Cancel
            }
        });
    });
</script>

</body>
</html>