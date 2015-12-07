<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administrator</title>

        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">         
        <!--<link rel="stylesheet" href="../../bootstrap/css/bootstrap-theme.min.css">-->

        <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


        <link href="<?php echo base_url(); ?>jquery-ui/jquery-ui.css" rel="stylesheet">

        <style>
            body{
                background-color: black;
                font-family: Tahoma;
            }
            #font{
                color: white;
            }
            .siku{
                border-radius: 0px;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid"style='margin-top: 100px;'>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6"  id='font' style='border: solid;' >
                    <h1 style='text-align: center;' id='font'>Penggajian</h1>
                    <h3 style='text-align: center;' id='font'>Form Login</h3>
                    <br>
                    <br>
                    <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                        <?php if ($status != "") : ?>
                            <div class="alert alert-danger" style="">
                                <i class="fa fa-warning"></i> <?php echo $status ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Username: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" placeholder="Username" style="border-radius: 0px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="Password" style="border-radius: 0px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary siku" value="Simpan" name="btn_login">Login</button>
                                <button type="reset" class="btn btn-danger siku" >Reset</button>
                            </div>
                        </div>
                    </form><br>
                </div>
                <div class="col-md-3"></div>

            </div>

        </div>

        <script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
    </body>

</html>
