<?php date_default_timezone_set("Asia/Jakarta") ?>
<style>
    td:first-child{
        text-align: right;
    }
</style>  
<div class="container" style="margin-top: 80px; height: 100%; padding: 0px; margin-bottom: 50px;">

    <div class="row" style="">
        <div class="col-lg-12">
            <h2 class="page-header" style="margin-top: 0px;">Penjualan SPG</h2>
            <ol class="breadcrumb" style="background-color: white; margin-top: 00px;">
                <li class="active"><i class="fa fa-home"></i> Penjualan SPG</li>
            </ol>
        </div>
    </div>
    <!--<div--> 
    <div style="background-color: white; height: 170px;">
        <div class="col-md-12" style="margin-top: 17px;">
            <form class="form-inline" method="post" action="<?php
            echo current_url();
            $total = array();
            ?>">
                      <?php if ($this->session->userdata("Level") == 0) : ?>
                    <div class="form-group">
                        <label class="">Cabang : </label>
                        <select class="form-control siku" style="width: 200px" name="cabang">
                            <option value="0"> --- Semua Cabang ---</option>
                            <?php foreach ($cabangs as $cabang): ?>
                                <option value="<?php echo $cabang->idcabang ?>" <?php echo $cabang->idcabang == $selectCabang ? "selected" : "" ?>><?php echo $cabang->provinsi ?> - <?php echo $cabang->kabupaten ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br><br>
                <?php endif; ?>
                <div class="form-group">
                    <label for="exampleInputName2">Periode : </label>
                    <input class="form-control siku" type="text" id="datepicker1" placeholder="Dari" name="tanggal_awal" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Sampai : </label>
                    <input class="form-control siku" type="text" id="datepicker2" placeholder="Sampai" name="tanggal_akhir" value="">
                </div>
                <br>        
                <br>        
                <div class="form-group" >
                    <label for="filterSPG">Nama Toko : </label>
                    <select name="filter" id="filterSPG" style="width: 200px" class="form-control siku">
                        <option value="0">Semua Toko</option>
                        <!-- looping toko -->
                        <!-- end looping toko -->
                    </select>
                </div>                            
                &nbsp;<button type="submit" name='btn_pilih' value='btn_pilih' class="btn btn-primary siku">&nbsp;&nbsp;Pilih&nbsp;&nbsp;</button>
                &nbsp;<button id="btn_export" type="submit" name='btn_export' value='btn_export' class="btn btn-success siku">&nbsp;&nbsp;<i class="fa fa-book"></i> Export To XLS&nbsp;&nbsp;</button>
            </form>

        </div>
    </div>
    <hr>
    <div class="row" >
        <div class="col-lg-12" style="margin-top: -10px;">
            <div class="panel panel-info siku">
                <div class="panel-heading siku">
                    <div class="panel-title">                                                    
                        <h2 style="margin-top: 5px;">Laporan SPG MT</h2>                        
                    </div>
                </div>
                <div class="panel-body">   
                    <!-- loop isi -->
                    <div class="col-md-3">
                        <div class="panel panel-success siku">
                            <div class="panel-heading">
                                <h5 style="font-size: x-large"><strong><?php echo "nama" ?></strong></h5>
                            </div>
                            <div class="panel-body">
                                <div style="text-align: center;">
                                    <img src="<?php echo base_url() ?>uploads/a.jpg" alt="a.jpg" width="200" >
                                </div>
                                <p>Pendapatan : </p><button class="btn btn-success col-sm-6">Detail</button>
                                
                            </div>
                        </div>
                    </div>
                    <!-- end loop isi -->
                </div>
            </div>
        </div>
    </div>  

</div>

<script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>
<style type="text/css">
    .ui-datepicker-year, .ui-datepicker-month{
        color: black;
    }
</style>
<script>
    $('#ListView').hide();
    $('#btn_export').hide();
    function gridview() {
        $('#GridView').show();
        $('#ListView').hide();
        $('#btn_export').hide();
    }
    function listview() {
        $('#GridView').hide();
        $('#ListView').show();
        $('#btn_export').show();
    }
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

