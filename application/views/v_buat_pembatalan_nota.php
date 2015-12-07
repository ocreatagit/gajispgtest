<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">    
    <div class="row" style="">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0px;">Daftar Pembatalan Nota</h1>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li><a href="<?php echo base_url(); ?>index.php/Laporan/daftar_tarik_bank"><i class="fa fa-home"></i> Daftar Pembatalan Nota </a></li>
                <li><a href="">Buat Pembatalan Nota</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Tambah Data Setoran</h3>
                </div>
                <div class="panel-body siku">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($status != "") {
                                ?>
                                <div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $status ?></div>
                            <?php }
                            ?>

                            <form method="post" action="<?php echo current_url(); ?>" accept-charset="utf-8" class="form-horizontal" id="form_setor">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tanggal : </label>
                                    <div class="col-lg-9">
                                        <input class="form-control siku" type="text" name="tanggal" id="datepicker" placeholder="Pilih Tanggal">
                                        <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url() ?>">
                                        <?php if (form_error("tanggal") != "") : ?>
                                            <span style="color: red;"><?php echo form_error("tanggal"); ?></span>                                  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Nota Penjualan : </label>
                                    <div class="col-lg-9">
                                        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary siku">Ambil Nota Penjualan</button>
                                        <?php if (form_error("IDPenjualan") != "") : ?>
                                            <span style="color: red;"><?php echo form_error("IDPenjualan"); ?></span>                                  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Tanggal Nota Penjualan : </label>
                                    <div class="col-lg-9">
                                        <input class="form-control siku" type="text" name="tanggal_nota" id="tanggal_nota" placeholder="" disabled="" value="" id="tanggal_nota">
                                        <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Total Penjualan : </label>
                                    <div class="col-lg-9">
                                        <input type="hidden" id="IDPenjualan" value="" name="IDPenjualan"/>
                                        <input type="text" id="total_penjualan" value="" name="total_penjualan" class="form-control siku" disabled=""/>
                                        <!--<textarea class="form-control siku" rows="3" name="keterangan"></textarea>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Keterangan : </label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control siku" rows="3" name="keterangan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3"></label>
                                    <div class="col-lg-9">
                                        <button name="btn_submit" value="btn_submit" type="submit" class="btn btn-info siku" id="bayar_button">Buat Pembatalan Nota</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">                            
                    <table class='table table-striped table-hover' id="list_laporan">
                        <thead>
                            <tr>
                                <!--<th style="display: none;">ID</th>-->
                                <th>Tanggal</th>
                                <th>Admin <?php
                                    if ($this->session->userdata("Level") == 0) {
                                        echo "Cabang";
                                    }
                                    ?></th>
                                <th>Total Penjualan</th>
                                <!--<th>Total Pengeluaran</th>-->
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($laporans as $laporan):
                                ?>
                                <tr>
                                    <td id="tanggal<?php echo $laporan->idlaporan ?>"><?php echo strftime("%d-%m-%Y", strtotime($laporan->tanggal)); ?></td>
                                    <td><?php echo $laporan->username; ?>
                                        <input type="hidden" id="idnota<?php echo $laporan->idlaporan; ?>" value="<?php echo $laporan->idlaporan; ?>" name="idnota<?php echo $no; ?>"/>
                                    </td>
                                    <td id="total<?php echo $laporan->idlaporan ?>">Rp <?php echo number_format($laporan->totalPenjualan, 0, ",", ".") ?>.-
                                    </td>
                                    <td><?php echo $laporan->keterangan; ?></td>
                                    <td style="width: 50px; text-align: center;">
                                        <button type="button" id="" onclick="pilih_nota(<?php echo $laporan->idlaporan ?>)" class="btn btn-sm btn-primary siku"><i class=""></i> Pilih</button>
                                    </td>
                                </tr>

                                <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
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
                                        $("#datepicker").datepicker({
                                            inline: true,
                                            dateFormat: "dd-mm-yy"
                                        });

                                        $("#datatable").dataTable();

                                        $("#list_laporan").dataTable();

                                        $(document).ready(function () {
                                            $("#lokasi").val('');
                                            $("#salesnya_admin").val('');
                                            $("#gaji_sales").val('');
                                            $("#nama_produk").val('');
                                            $(".kas_keluar").val('');
                                            $("#bayar_gaji").hide();
                                        });

//                                            $("#inputCheck").click(function () {
//                                                event.preventDefault();
//                                                var r = confirm("Apakah Data yang telah Di Masukan Benar?");
//                                                if (r == true) {
//                                                    var a = $(this).attr("href");
//                                                    window.location.assign(a);
//                                                }
//                                            });

</script>
<script src="<?php echo base_url(); ?>alertify/alertify.min.js"></script>
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
                                                    var a = $("#inputCheck").attr("href");
                                                    window.location.assign(a);
                                                } else {
                                                    //after clicking Cancel
                                                }
                                            });
                                        });

                                        $("#bayar_button").click(function (event) {
                                            event.preventDefault();
                                            alertify.confirm('Apakah Data yang telah Di Masukan Benar?', function (e) {
                                                if (e) {
                                                    $("#form_setor").submit();
                                                } else {
                                                    //after clicking Cancel
                                                }
                                            });
                                        });

                                        function pilih_nota(nota) {
                                            var tgl_nota = $("#tanggal" + nota).html();
                                            var total_nota = $("#total" + nota).html();
                                            var IDNota = $("#idnota" + nota).val();
                                            
                                            $('#myModal').modal('hide');
                                            $("#tanggal_nota").val(tgl_nota);
                                            $("#total_penjualan").val(total_nota);
                                            $("#IDPenjualan").val(IDNota);
                                        }
</script>