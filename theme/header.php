<!DOCTYPE html>
<html>
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SPK Penerima PKH</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="bootstrap/js/lumino.glyphs.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="../assets/css/morris.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
     
   
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="dashboard.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SPK</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Admin <b>SPK</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
            
           
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="logout.php"><i class="fa fa-user-times">&nbsp; Log out</i></a>
              </li>

            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
           
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">
            <center><img src="img/mubar.png" width="100px" height="100px"></center>
            </li>
            <li class="header">MAIN NAVIGATION</li>
            <li <?php if ($get=='dashboard') echo "class='active'";?>>
              <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=dashboard">
                 <i class="fa fa-home"></i> <span>Dashboard</span>
              </a>
            </li>
            <li <?php if ($get=='penduduk') echo "class='active'";?>>
              <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=penduduk">
                <i class="fa fa-user"></i> <span>Data Penduduk</span>  
              </a>
            </li> 
            <li <?php if ($get=='kriteria') echo "class='active'";?>>
              <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=kriteria">
                <i class="fa fa-check-square"></i> <span>Kriteria</span>  
              </a>
            </li>
            <li <?php if ($get=='subkriteria') echo "class='active'";?>>
              <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=subkriteria">
                <i class="fa fa-list-alt"></i> <span>Sub Kriteria</span>  
              </a>
            </li>
            <li <?php if ($get=='nilai') echo "class='active'";?>>
              <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=nilai">
                <i class="fa fa-calculator"></i> <span>Penilaian</span>  
              </a>
            </li>
            <li <?php if ($get=='maut') echo "class='active'";?>>
              <a href="<?php $_SERVER[SCRIPT_NAME];?>?page=maut">
                <i class="fa fa-file"></i> <span>Hasil</span>  
              </a>
            </li>
           </ul>
        </section>
        <!-- /.sidebar -->
      </aside>