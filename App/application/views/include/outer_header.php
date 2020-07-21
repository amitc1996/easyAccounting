<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <!DOCTYPE html>
<html>
  <head>
  <title><?php echo $title; ?></title>
    <meta charset="UTF-8">
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme style -->
    <!-- font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">
   <!--  <link href="<?php echo base_url(); ?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />  -->
    <link href="<?php echo base_url(); ?>assets/css/outer_app.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/plugins/iCheck/square/green.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo base_url('assets/img/logosm.png');?>">
<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/parsley.css') ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('/assets/js/jquery-1.10.2.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/parsley.min.js')?>"></script>

        
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <style type="text/css">
       body.auth .alert {
        position: unset!important;
    }
        html {
            display: table;
            height: 100%;
            width: 100%;
        }
        .alert-success {
         color: #3c763d!important;
        background-color: #dff0d8!important;
        border-color: #d6e9c6!important;
        } 
        .logo-lg{
          font-size: 30px;
        }
        .label-custom{
          color: #fff;
        }
      </style>
  </head>
  <body class="auth">
<div class="box">
  <div class="logo">
            <span class="logo-lg"><label for="" class="label label-primary">Am</label> <label for="" class="label-custom">Enterprises</label>
      </span>
             <!--   <img style="width: 75%;" src="<?php echo base_url('assets/img/logo-lg-sharp.png');?>"  alt="User Image"> -->
   </div>     