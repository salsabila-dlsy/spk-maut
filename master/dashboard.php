<?php 
  // $fitur1 = "10";
  // $z = "fitur1";
  // echo ${$z};
  // $headers = [
  //   "fitur1",
  //   "fitur2",
  //   "fitur3",
  // ];
  // $obj1 = 
  // (object)  
  // (
  //     array(
  //       "fitur1" => 3, 
  //       "fitur2" => 4, 
  //       "fitur3" => 3, 
  //     )
  //   );

  // $obj2 = 
  //   (object)  
  //   (
  //       array(
  //         "fitur1" => 0, 
  //         "fitur2" => 0, 
  //         "fitur3" => 4, 
  //       )
  //     );
  
  //   $arr_obj = [
  //     $obj1,
  //     $obj2,
  //   ];
  
  // function euclid_dist( $a, $b ){
  //   $headers = [
  //     "fitur1",
  //     "fitur2",
  //     // "fitur3",
  //   ];
  //   $sum = 0;
  //   foreach( $headers as $header ){
  //     $sum +=  pow( $a->$header - $b->$header, 2 ) ;
  //     // echo $sum."<br>";

  //   }
  //   return sqrt($sum);
  // }
  // $dist = euclid_dist( $obj1, $obj2 ) ;
  // echo $dist."<br>";
  // // foreach( $arr_obj as $val )
  // // {
  // //     foreach( $headers as $header )
  // //       echo $val->$header." ";
  // //     echo "<br>";
  // // }
      
  // die;
  session_start();
  if (!isset($_SESSION['admin'])){
      header("Location: index.php");
  }
  include 'theme/header.php'; ?>
<?php
  $s = mysqli_query($config, "SELECT * FROM dt_penduduk");
  $jml = mysqli_num_rows($s);

?>
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $jml; ?></h3>
                  <p>Jumlah Peserta</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-people"></i>
                </div>
                <a href="?page=penduduk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row ">
                    <div class="col">
                        <div class=" text-center">
                          <h1>Selamat Datang Admin</h1>
                          <p>Sistem Pendukung Keputusan Penerima Bantuan Program Keluarga Harapan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     
<?php include 'theme/footer.php'; ?>