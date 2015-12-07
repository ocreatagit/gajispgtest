<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Input Stok Cabang</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href=""><i class="fa fa-home"></i> Stok Cabang</a></li>
            </ol>
        </div>
    </div>
    <!--<div--> 
    <div class="row" style="">
        <div class="col-lg-12">
            <div class="panel panel-default siku">
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