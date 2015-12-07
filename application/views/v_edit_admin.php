<div class="container" style="margin-top: 80px; height: 100%;; background-color: white; padding: 0px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Tambah Admin Baru</h3>
                </div>
                <div class="panel-body siku">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($status != "") {
                                ?>
                                <div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $status ?></div>
                            <?php }
                            ?>

                            <form method="post" action="<?php echo current_url(); ?>" accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="IDAdmin" type="hidden" value="<?php echo $admin->IDAdmin ?>"/>
                                    <input type="text" class="form-control siku" name="username" placeholder="Masukkan Username" value="<?php echo set_value('username', $admin->username) ?>" disabled="">
                                    <?php if (form_error("username") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("username"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control siku" name="nama" placeholder="Masukkan Nama" value="<?php echo set_value('nama', $admin->nama) ?>">
                                    <?php if (form_error("nama") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("nama"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control siku" name="email" placeholder="Masukkan Email" value="<?php echo set_value('email', $admin->email) ?>">
                                    <?php if (form_error("email") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("email"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <?php if ($admin->level != 0) {
                                        ?>
                                        <select class="form-control siku" name="level">
                                            <option value="1" <?php if ($admin->level == 1) echo "selected"; ?>>Admin Lapangan</option>
                                            <option value="2" <?php if ($admin->level == 2) echo "selected"; ?>>Admin Kantor</option>
                                        </select>
                                    <?php } else {
                                        ?>
                                        <input type="hidden" name="level" value="0"/>
                                        <input type="text" disabled="" value="Super Admin" class="form-control siku"/>
                                        <?php
                                    }
                                    ?>
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                                </div>

                                <div class="form-group">
                                    <label>Foto : </label>
                                    <div>
                                        <img src="<?php echo base_url() ?>uploads/<?php echo $admin->IDAdmin ?>" class="thumbnail" style="height: 20%;" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Foto Admin</label>
                                    <input type="file" name="foto_admin" id="exampleInputFile" accept="">
                                    <!--<p class="help-block">Example block-level help text here.</p>-->
                                </div>
                                <a href="<?php echo base_url() ?>index.php/admin/daftar_admin" class="btn btn-default siku"><i class='fa fa-backward'></i> Kembali</a>
                                <button name="btn_submit" value="btn_submit" type="submit" class="btn btn-info siku" id="selesai">Selesai</button>
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

</body>
</html>