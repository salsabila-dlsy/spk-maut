<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LOGIN</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min2.css">
    <!-- Font Awesome -->
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>

    <style type="text/css">
    .login-page{
      background: #3c8dbc;
    }
    .login-box-body{
      background: #ecf0f1;
      height: auto;
    }
    .login-logo{
      margin-bottom: 10PX;
    }
    .footer{
      text-align: center;
      margin-top: 20px;
      color: white;
    }
    .btn-success{
      background: #16a085;
    }
    .btn-danger {
      background: #c0392b;
    }
    </style>
  
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">SISTEM PENDUKUNG KEPUTUSAN PENERIMA BANTUAN PROGRAM KELUARGA HARAPAN</p>
            <p class="login-box-msg">Login Admin PKH</p>
            <form action='<?= "login.php"?>' method="post" id="form">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" required="" placeholder="Username" name="username" autocomplete="off" autofocus="">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" required="" placeholder="Password" name="password" autocomplete="off">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-block btn-flat">Masuk</button>
                    </div>
                </div>
            </form>
    
        </div>
        <div class="footer">
            Copyright © <br>All rights reserved.
        </div>
    </div>
</body>
</html>