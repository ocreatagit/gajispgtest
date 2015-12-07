<div class="container" style="margin-top: 80px; height: 100%;; background-color: white; padding: 0px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Ganti Password</h3>
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
                                    <label>Password</label>
                                    <input type="password" class="form-control siku" name="password" placeholder="Masukkan Password">
                                    <?php if (form_error("password") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("password"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Ulangi Password</label>
                                    <input type="password" class="form-control siku" name="ulangi_password" placeholder="Ulangi Password">
                                    <?php if (form_error("ulangi_password") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("ulangi_password"); ?></span>                                  
                                    <?php endif; ?>
                                </div>
<!--                                <hr>                                
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control siku" name="email" placeholder="Masukkan Email" value="<?php echo set_value('email') ?>">
                                    <?php if (form_error("email") != "") : ?>
                                        <span style="color: red;"><?php echo form_error("email"); ?></span>                                  
                                    <?php endif; ?>
                                </div>-->
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