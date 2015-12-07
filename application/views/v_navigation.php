<nav class="navbar navbar-default navbar-fixed-top " style="border-radius: 0px; background: #00BA8B none repeat scroll 0% 0% !important;">
    <div class="container"  style="background: #00BA8B none repeat scroll 0% 0% !important;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class='' style=''>
            <div class="navbar-header" style='padding-top: 0px;'>
                <a class="navbar-brand" href="#" style="color: white;">
                    <strong>Laporan Penggajian SPG</strong>
                </a>
                <button  style='border-radius: 0px;' type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"  style="border-radius: 0px; background: #00BA8B none repeat scroll 0% 0% !important;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"  style='padding-top: 0px; background: #00BA8B none repeat scroll 0% 0% !important;'>
                <ul class="nav navbar-nav">
                    <!--<li class="active"><a href="<?php // echo base_url() . 'index.php/Laporan/harian'              ?>">Input Data</a></li>-->
                    <li class="dropdown">
                        <a href="#"  style="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Input Data <span class="caret"></span></a>
                        <ul class="dropdown-menu siku">
                            <?php if ($level != 2): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Laporan/harian' ?>" style=''><span id='submenu'>Penjualan</span></a></li>
                            <?php endif; ?>
                            <?php if ($level != 1): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Laporan/kas' ?>" style=''>Kas</a></li>
                            <?php endif; ?>
                            <?php if ($level != 1): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Laporan/laporan_pengeluaran' ?>" style=''>Pengeluaran</a></li>
                            <?php endif; ?>
                            <?php if ($level != 2): ?>
                                <li><a href="<?php echo base_url() . 'index.php/laporan/stok_cabang' ?>" style=''>Stok</a></li>
                            <?php endif; ?>
                            <?php if ($level != 1): ?>
                                <li><a href="<?php echo base_url() . 'index.php/komisi/laporan_komisi' ?>" style=''>Komisi Sales</a></li>
                            <?php endif; ?>
                            <?php if ($level != 1): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Laporan/laporan_gaji' ?>" style=''>Bayar Gaji</a></li>
                            <?php endif; ?>
                            <?php if ($level != 1): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Laporan/daftar_setoran_bank' ?>" style=''>Setoran Bank</a></li>
                            <?php endif; ?>
                            <?php if ($level != 1): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Laporan/daftar_tarik_kas_bank' ?>" style=''>Pengambilan Kas Bank</a></li>
                            <?php endif; ?>
                            <?php if ($level != 2): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Laporan/pembatalan_nota' ?>" style=''>Pembatalan Nota</a></li>                                
                            <?php endif; ?>
                        </ul>                                
                    </li>
                    <?php if ($level != 2): ?>
                        <li class="dropdown">
                            <a href="#"  style="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master Data <span class="caret"></span></a>
                            <ul class="dropdown-menu siku">
                                <li><a href="<?php echo base_url() . 'index.php/lokasi/tambah_lokasi' ?>" style=''><span id='submenu'>Lokasi</span></a></li>
                                <li><a href="<?php echo base_url() . 'index.php/barang/tambah_barang' ?>" style=''>Barang</a></li>
                                <!--<li><a href="#" style=''>SPG</a></li>-->
                            </ul>                                
                        </li>
                    <?php endif; ?>
                    <!--<li><a href="#">Pencarian</a></li>-->
                    <li class="dropdown">
                        <a href="#"  style="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Top <span class="caret"></span></a>
                        <ul class="dropdown-menu siku">
                            <li><a href="<?php echo base_url() . 'index.php/pencarian/TopLokasi' ?>" style=''><span id='submenu'>Top Lokasi</span></a></li>
                            <li><a href="<?php echo base_url() . 'index.php/pencarian/TopBarang' ?>" style=''><span id='submenu'>Top Barang</span></a></li>
                            <li><a href="<?php echo base_url() . 'index.php/pencarian/TopSales' ?>" style=''><span id='submenu'>Top Sales</span></a></li>
                        </ul>                                
                    </li>
                    <!--<li><a href="#">Laporan</a></li>-->
                    <li class="dropdown">
                        <a href="#"  style="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
                        <ul class="dropdown-menu siku">
                            <li><a href="<?php echo base_url() . 'index.php/pencarian/harian' ?>" style=''><span id='submenu'>Laporan Kas</span></a></li>
                            <li><a href="<?php echo base_url() . 'index.php/pencarian/penjualan' ?>" style=''><span id='submenu'>Penjualan SPG</span></a></li>
                            <li><a href="<?php echo base_url() . 'index.php/laporan/pengeluaran' ?>" style=''>Laporan Pengeluaran</a></li>
                            <li><a href="<?php echo base_url() . 'index.php/Laporan/laporan_mutasi_kas' ?>" style=''>Laporan Mutasi Kas</a></li>
                            <?php if ($level != 1): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Laporan/laporan_mutasi_kas_bank' ?>" style=''>Laporan Mutasi Kas Bank</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo base_url() . 'index.php/Sales/kehadiran_sales' ?>" style=''>Laporan Kehadiran</a></li>
                            <!--<li><a href="#" style=''>SPG</a></li>-->
                        </ul>                                
                    </li>
                    <!--<li><a href="#">Profile</a></li>-->
                    <li class="dropdown">
                        <a href="#"  style="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu siku">
                            <li><a href="<?php echo base_url() . 'index.php/Sales/daftar_sales' ?>" style=''><span id='submenu'>Sales</span></a></li>
                            <?php if ($level == 0): ?>
                                <li><a href="<?php echo base_url() . 'index.php/Admin/daftar_admin' ?>" style=''>Admin</a></li>
                            <?php endif; ?>
                        </ul>                                
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $username; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu siku">
                            <li><a href="<?php echo base_url('index.php/Admin/GVlg7Mq9vc6y0LyijfKx') ?>">Ubah Password</a></li>
                            <li><a href="<?php echo base_url('index.php/Admin/logout'); ?>" name="logout">Logout</a></li>                                
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div><!-- /.container-fluid -->
</nav>