<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Account - Bootstrap Admin Template</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">    

        <!--<link href="../../bootstrap_template/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="<?php echo base_url(); ?>bootstrap_template/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>bootstrap_template/css/bootstrap-responsive.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>bootstrap_template/css/font-awesome.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>bootstrap_template/css/style.css" rel="stylesheet">


        <style>
            body{
                font-family: Tahoma;
            }
        </style>
    </head>

    <body>

        <div class="navbar navbar-fixed-top">

            <div class="navbar-inner">

                <div class="container">

                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="brand" href="index.html">
                        Penggajian			
                    </a>		

                    <div class="nav-collapse">
                        <ul class="nav pull-right">

                            <li class="dropdown">						
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-user"></i> 
                                    putraops
                                    <b class="caret"></b>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="javascript:;">Profile</a></li>
                                    <li><a href="javascript:;">Logout</a></li>
                                </ul>						
                            </li>
                        </ul>


                    </div><!--/.nav-collapse -->	

                </div> <!-- /container -->

            </div> <!-- /navbar-inner -->

        </div> <!-- /navbar -->


        <div class="subnavbar">
            <div class="subnavbar-inner">
                <div class="container">
                    <ul class="mainnav">
                        <li class="active">
                            <a href="index.php">
                                <i class="icon-dashboard"></i>
                                <span>Laporan Penjualan</span>
                            </a>	    				
                        </li>
                        <li>
                            <a href="reports.html">
                                <i class="icon-list-alt"></i>
                                <span>Master Data</span>
                            </a>    				
                        </li>
                        <li>					
                            <a href="guidely.html">
                                <i class="icon-facetime-video"></i>
                                <span>Pencarian</span>
                            </a>  									
                        </li>
                        <li>					
                            <a href="charts.html">
                                <i class="icon-bar-chart"></i>
                                <span>Laporan</span>
                            </a>  									
                        </li>
                        <li>					
                            <a href="shortcodes.html">
                                <i class="icon-code"></i>
                                <span>Profile</span>
                            </a>  									
                        </li>
                        <li class="dropdown">					
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-long-arrow-down"></i>
                                <span>Drops</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="icons.html">Icons</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="pricing.html">Pricing Plans</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="signup.html">Signup</a></li>
                                <li><a href="error.html">404</a></li>
                            </ul>    				
                        </li>

                    </ul>

                </div> <!-- /container -->

            </div> <!-- /subnavbar-inner -->

        </div> <!-- /subnavbar -->



        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12">                            
                            <div class="widget ">
                                <div class="widget-header">
                                    <i class="icon-user"></i>
                                    <h3>Your Account</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">



                                    <div class="tabbable">
                                        <ul class="nav nav-tabs">
                                            <li>
                                                <a href="#formcontrols" data-toggle="tab">Form Controls</a>
                                            </li>
                                            <li  class="active"><a href="#jscontrols" data-toggle="tab">JS Controls</a></li>
                                        </ul>

                                        <br>

                                        <div class="tab-content">
                                            <div class="tab-pane" id="formcontrols">
                                                <form id="edit-profile" class="form-horizontal">
                                                    <fieldset>

                                                        <div class="control-group">											
                                                            <label class="control-label" for="username">Username</label>
                                                            <div class="controls">
                                                                <input type="text" class="span6 disabled" id="username" value="Example" disabled>
                                                                <p class="help-block">Your username is for logging in and cannot be changed.</p>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                        <div class="control-group">											
                                                            <label class="control-label" for="firstname">First Name</label>
                                                            <div class="controls">
                                                                <input type="text" class="span6" id="firstname" value="John">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                        <div class="control-group">											
                                                            <label class="control-label" for="lastname">Last Name</label>
                                                            <div class="controls">
                                                                <input type="text" class="span6" id="lastname" value="Donga">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                        <div class="control-group">											
                                                            <label class="control-label" for="email">Email Address</label>
                                                            <div class="controls">
                                                                <input type="text" class="span4" id="email" value="john.donga@egrappler.com">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                        <br /><br />

                                                        <div class="control-group">											
                                                            <label class="control-label" for="password1">Password</label>
                                                            <div class="controls">
                                                                <input type="password" class="span4" id="password1" value="thisispassword">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                        <div class="control-group">											
                                                            <label class="control-label" for="password2">Confirm</label>
                                                            <div class="controls">
                                                                <input type="password" class="span4" id="password2" value="thisispassword">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->



                                                        <div class="control-group">											
                                                            <label class="control-label">Checkboxes</label>


                                                            <div class="controls">
                                                                <label class="checkbox inline">
                                                                    <input type="checkbox"> Option 01
                                                                </label>

                                                                <label class="checkbox inline">
                                                                    <input type="checkbox"> Option 02
                                                                </label>
                                                            </div>		<!-- /controls -->		
                                                        </div> <!-- /control-group -->



                                                        <div class="control-group">											
                                                            <label class="control-label">Radio Buttons</label>


                                                            <div class="controls">
                                                                <label class="radio inline">
                                                                    <input type="radio"  name="radiobtns"> Option 01
                                                                </label>

                                                                <label class="radio inline">
                                                                    <input type="radio" name="radiobtns"> Option 02
                                                                </label>
                                                            </div>	<!-- /controls -->			
                                                        </div> <!-- /control-group -->




                                                        <div class="control-group">											
                                                            <label class="control-label" for="radiobtns">Combined Textbox</label>

                                                            <div class="controls">
                                                                <div class="input-prepend input-append">
                                                                    <span class="add-on">$</span>
                                                                    <input class="span2" id="appendedPrependedInput" type="text">
                                                                    <span class="add-on">.00</span>
                                                                </div>
                                                            </div>	<!-- /controls -->			
                                                        </div> <!-- /control-group -->





                                                        <div class="control-group">											
                                                            <label class="control-label" for="radiobtns">Textbox with Buttons </label>

                                                            <div class="controls">
                                                                <div class="input-append">
                                                                    <input class="span2 m-wrap" id="appendedInputButton" type="text">
                                                                    <button class="btn" type="button">Go!</button>
                                                                </div>
                                                            </div>	<!-- /controls -->			
                                                        </div> <!-- /control-group -->





                                                        <div class="control-group">											
                                                            <label class="control-label" for="radiobtns">Dropdown in a button group</label>

                                                            <div class="controls">
                                                                <div class="btn-group">
                                                                    <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> User</a>
                                                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                                                                        <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                                                        <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="#"><i class="i"></i> Make admin</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>	<!-- /controls -->			
                                                        </div> <!-- /control-group -->





                                                        <div class="control-group">											
                                                            <label class="control-label" for="radiobtns">Button sizes</label>

                                                            <div class="controls">
                                                                <a class="btn btn-large" href="#"><i class="icon-star"></i> Star</a>
                                                                <a class="btn btn-small" href="#"><i class="icon-star"></i> Star</a>
                                                                <a class="btn btn-mini" href="#"><i class="icon-star"></i> Star</a>
                                                            </div>	<!-- /controls -->			
                                                        </div> <!-- /control-group -->



                                                        <br />


                                                        <div class="form-actions">
                                                            <button type="submit" class="btn btn-primary">Save</button> 
                                                            <button class="btn">Cancel</button>
                                                        </div> <!-- /form-actions -->
                                                    </fieldset>
                                                </form>
                                            </div>

                                            <div class="tab-pane active" id="jscontrols">
                                                <form id="edit-profile2" class="form-vertical">
                                                </form>
                                            </div>

                                        </div>


                                    </div>





                                </div> <!-- /widget-content -->

                            </div> <!-- /widget -->

                        </div> <!-- /span8 -->




                    </div> <!-- /row -->

                </div> <!-- /container -->

            </div> <!-- /main-inner -->

        </div> <!-- /main -->




        <!-- /extra -->




        <div class="footer">

            <div class="footer-inner">

                <div class="container">

                    <div class="row">

                        <div class="span12">
                            &copy; 2013 <a href="http://www.egrappler.com/">Bootstrap Responsive Admin Template</a>.
                        </div> <!-- /span12 -->

                    </div> <!-- /row -->

                </div> <!-- /container -->

            </div> <!-- /footer-inner -->

        </div> <!-- /footer -->



        <script src="<?php echo base_url(); ?>bootstrap_template/js/jquery-1.7.2.min.js"></script>

        <script src="<?php echo base_url(); ?>bootstrap_template/js/bootstrap.js"></script>
        <!--<script src="js/base.js"></script>-->


    </body>

</html>
