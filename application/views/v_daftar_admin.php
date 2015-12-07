  

<div class="container" style="">
    <!--<div--> 
    <div class="row" style="margin-top: 70px;">
        <div class="col-lg-12">
            <div class="panel panel-default siku">
                <a href="<?php echo base_url() . 'index.php/Admin/tambah_admin' ?>" class="btn btn-info siku" role="button" style="margin: 10px;">Tambah Admin</a>
            </div>
        </div>
        <div class="col-lg-12" style="margin-top: -10px;">
            <?php if ($status != "") { ?>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> <?php echo $status ?>
                </div>
            <?php } ?>
            <div class="panel panel-info siku">
                <div class="panel-heading siku">
                    <h3 class="panel-title">Daftar Admin</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-12" style="background-color: white;">
                        <table class='table table-bordered table-hover table-responsive' id="gUser">
                            <thead>
                                <tr style='background-color: #999'>
                                    <th>#</th>
                                    <th>Cabang</th>
                                    <th>Nama Admin</th>
                                    <th>Email</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                <?php foreach ($admins as $admin) : ?> 

                                    <?php echo "<tr>"; ?>
                                    <?php echo "<td>" . $nomor++ . "</td>"; ?>
                                    <?php echo "<td>" . $admin->nama . "</td>"; ?>
                                    <?php echo "<td>" . $admin->nama . "</td>"; ?>
                                    <?php echo "<td>" . $admin->email . "</td>"; ?>
                                    <?php echo "<td align='center'>"; ?>
                                    <?php echo "<a href='" . base_url() . "index.php/admin/edit_admin/" . $admin->IDAdmin . "' class='btn btn-primary btn-sm siku'><i class='fa fa-pencil'></i></a>"; ?>
                                    <?php echo "<a href='' class='btn btn-danger btn-sm siku'><i class='fa fa-trash'></i></a>"; ?>                                
                                    <?php echo "</td>"; ?>
                                    <?php echo "</tr>"; ?>
                                <?php endforeach; ?>
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

</body>
</html>