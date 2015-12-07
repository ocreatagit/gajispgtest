<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Administrator</title>   

        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">     

        <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url(); ?>jquery-ui/jquery-ui.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>Datatable/css/jquery.dataTables.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>Datatable/css/jquery.dataTables.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>Datatable/css/jquery.dataTables.css" rel="stylesheet">

        <!-- include the style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>alertify/css/alertify.min.css" />
        <!-- include a theme -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>alertify/css/themes/default.min.css" />



        <style type="text/css">
            body{
                font-family: Tahoma;
                background: #F9F6F1 none repeat scroll 0% 0%;
            }
            #kiri, #kanan{
                height: 600px;
                margin-top: -20px;
            }
            #kiri{
                background-color: yellow;
            }
            #kanan{
                background-color: black;
            }
            .siku{
                border-radius: 0px;
            }
            /*            .active{
                            background-color: red;
                        }*/

            /*            .custom > li > a:hover {
                            color: black;
                        }*/
            .navbar-default .navbar-nav > li > a{
                color: white;
            }
            .navbar-default .navbar-nav > .active > a, 
            .navbar-default .navbar-nav > .active > a:hover, 
            .navbar-default .navbar-nav > .active > a:focus {
                color: black;
                background: transparent;
                box-shadow: none !important;
                -webkit-box-shadow: none !important;
                /*box-shadow: 0px 3px 9px rgba(0, 0, 0, 0.075) inset;*/
            }
            .navbar-default .navbar-nav > .active > a, 
            .navbar-default .navbar-nav > .open > a{
                color: black;
                background: transparent;
                box-shadow: none !important;
                -webkit-box-shadow: none !important; 
            }
            .navbar-default .navbar-nav > .open > a, 
            .navbar-default .navbar-nav > .open > a:focus, 
            .navbar-default .navbar-nav > .open > a:hover,
            .navbar-default .navbar-nav > .open > a:checked{
                background-color: transparent;    
            }
            .navbar-default .navbar-nav > .active{ 
                /*padding-left: 15px;*/
                color: #333;
                text-decoration: none;
                background-color: transparent;
                background-image: url(<?php echo base_url(); ?>images/lineactive.png);
                background-repeat: repeat-x;
            }
            ul.nav > li > a:hover {
                color: #333;
                text-decoration: none;
                background-color: transparent;
                background-image: url(<?php echo base_url(); ?>images/line.png);
                background-repeat: repeat-x;
                /*                                background-color: transparent;
                                                color: black;
                                                border-style: none;*/
            }

            ul.dropdown-menu > li > a:hover{ 
                color: #333;
                text-decoration: none;
                background-color: transparent;
                background-image: url(<?php echo base_url(); ?>images/line30.png);
                background-repeat: repeat-x;
                box-shadow: none !important;
                -webkit-box-shadow: none !important;
            }

            /* Kategori Produk */
            .panel-heading{
                border-color: transparent;
                background-color: red;
            }
            /*            .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover{
                            
                        }*/

            .warna{
                color: red;
            }

            body a, p, label, h3 {
                font-size: 18px;
            }

            body label{
                font-weight: normal;
            }

            #tengah{
                text-align: center;
            }

            table{
                width: 100%;
            }
            table, td, th {
                border: 1px solid black;
            }
            th{
                padding: 5px;
                background-color: silver;
            }
            td {
                padding: 5px;
            }
            .datatable_header th{
                background-color: #2B669A;
                color: white;
            }
        </style>

    </head>
    <body style="background-color: whitesmoke;">