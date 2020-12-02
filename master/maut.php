<?php
include 'theme/header.php';
switch($_GET['act'])

{
	default:
//MENENTUKAN NILAI MAXSIMUM MINIMUM
    $kriteria=mysqli_query($config, "SELECT DISTINCT kode_kriteria FROM penilaian");
    while($r=mysqli_fetch_array($kriteria))
    {
        $kode_kriteria=$r[kode_kriteria];
        $cari = mysqli_query($config, "SELECT MAX(nilai) FROM penilaian WHERE kode_kriteria='$kode_kriteria'");
        $r1 = mysqli_fetch_array($cari);
        $max = $r1[0];
        mysqli_query($config, "UPDATE penilaian set max='$max' WHERE kode_kriteria='$kode_kriteria'");
        $cari2 = mysqli_query($config, "SELECT MIN(nilai) FROM penilaian WHERE kode_kriteria='$kode_kriteria'");
        $r2 = mysqli_fetch_array($cari2);
        $min = $r2[0];
        mysqli_query($config, "UPDATE penilaian set min='$min' WHERE kode_kriteria='$kode_kriteria'");
    }

//MENGHITUNG NILAI UTILITY
    $kriteria=mysqli_query($config, "SELECT * FROM penilaian");
    while($r=mysqli_fetch_array($kriteria))
    {
        $kode_kriteria=$r[kode_kriteria];
        $id_penduduk=$r[id_penduduk];
        $cari=mysqli_query($config, "SELECT * FROM penilaian WHERE kode_kriteria='$kode_kriteria' AND id_penduduk='$id_penduduk'");
        while($r1=mysqli_fetch_array($cari))
        {
            // RUMUS UTILITY
            $tot = ($r1[nilai]-$r1[min])/($r1[max]-$r1[min]);
            mysqli_query($config, "UPDATE penilaian SET nilai1='$tot' WHERE kode_kriteria='$kode_kriteria' AND id_penduduk='$id_penduduk'");
        }
    }

//MENORMALISASI DENGAN BOBOT KRITERIA
    $cari = mysqli_query($config,"SELECT penilaian.nilai1, penilaian.id_penduduk, kriteria.k_bobot FROM penilaian INNER JOIN kriteria WHERE penilaian.kode_kriteria=kriteria.kode_kriteria");
    while($r= mysqli_fetch_array($cari)){
        $nilai = $r[nilai1];
        $id_penduduk = $r[id_penduduk];
        // TAHAP NORMASLISASI
        $normalisasi = $r[nilai1]*$r[k_bobot];
        // echo "hasil = $normalisasi";
        mysqli_query($config, "UPDATE penilaian set nilai2='$normalisasi' WHERE nilai1='$nilai' AND id_penduduk='$id_penduduk'");
    }
//MENJUMLAHKAN NILAI ALTERNATIF UNTUK MASING2 KRITERIA
    $cari = mysqli_query($config,"SELECT * FROM dt_penduduk");
    while($r=mysqli_fetch_array($cari)){
        $id_penduduk = $r[id_penduduk];
        $tambah=mysqli_query($config, "SELECT SUM(nilai2) FROM penilaian WHERE id_penduduk='$id_penduduk'");
        while($r2=mysqli_fetch_array($tambah)){
            $sum = $r2[0];
            mysqli_query($config, "UPDATE penilaian set nilai3='$sum' WHERE id_penduduk='$id_penduduk'");
        }
    }
// INPUT NILAI AKHIR KE TABEL HASIL
    $query = mysqli_query($config, "SELECT DISTINCT id_penduduk, nilai3 FROM penilaian");
    while($input = mysqli_fetch_array($query)){
        $input1=$input[id_penduduk];
        $input2=$input[nilai3];
        mysqli_query($config, "UPDATE hasil SET nilai='$input2' WHERE id_penduduk='$input1'");
    }

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Penduduk
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Data</a></li>
      <li class="active">Data Penduduk</li>
    </ol>
  </section>
  <section class="content">
        <!-- Hasil Rangking -->
        <div class="box">
            <div class="box-header with-border">
                Hasil Rangking
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-striped dataTable no-footer">
                    <thead>
                    <tr> 
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no=0;
                        $tampil=mysqli_query($config, "SELECT * FROM hasil JOIN dt_penduduk ON dt_penduduk.id_penduduk=hasil.id_penduduk ORDER BY nilai DESC");
                        while($r=mysqli_fetch_array($tampil))
                        {
                            $no=$no+1;
                            $id_penduduk=$r[id_penduduk];
                            echo "
                            <tr>
                                <td>$no</td>
                                <td>$r[nama]</td>
                                <td>$r[nilai]</td>
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Hasil Rangking Berdasarkan Komponen -->
        <div class="box">
            <div class="box-header with-border">
                Hasil Rangking Berdasarkan Komponen
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <div class='col-md-12 form-group'>
                    <a href="?page=maut&act=pendidikan"><button type='submit' class='btn btn-info btn-flat'> Pendidikan</button> </a>
                    <a href="?page=maut&act=kesehatan"><button type='submit' class='btn btn-info btn-flat'> Kesehatan</button> </a>
                    <a href="?page=maut&act=sosial"><button type='submit' class='btn btn-info btn-flat'> Kesejahteraan Sosial</button> </a>
                </div>
            </div>
        </div>
  </section>
</div>
<?php 
break;
 ?>
<?php
 case "pendidikan":
//MENGHITUNG NILAI UTILITY
    $cari=mysqli_query($config, "SELECT * FROM penilaian JOIN kriteria WHERE kriteria.k_komponen='Pendidikan' AND penilaian.kode_kriteria=kriteria.kode_kriteria");
    while($r1=mysqli_fetch_array($cari))
    {
        $kode_kriteria = $r1[kode_kriteria];
        $id_penduduk = $r1[id_penduduk];
        $tot1 = ($r1[nilai]-$r1[min])/($r1[max]-$r1[min]);
        mysqli_query($config, "UPDATE penilaian SET n_komponen='$tot1' WHERE kode_kriteria='$kode_kriteria' AND id_penduduk='$id_penduduk'");
    }

//MENORMALISASI DENGAN BOBOT KRITERIA
    $cari = mysqli_query($config,"SELECT * FROM penilaian JOIN kriteria WHERE kriteria.k_komponen='Pendidikan' AND penilaian.kode_kriteria=kriteria.kode_kriteria");
    while($r= mysqli_fetch_array($cari)){
        $nilai = $r[n_komponen];
        $id_penduduk = $r[id_penduduk];
        $normalisasi = $r[n_komponen]*$r[k_bobot];
        mysqli_query($config, "UPDATE penilaian SET n_komponen2='$normalisasi' WHERE n_komponen='$nilai' AND id_penduduk='$id_penduduk'");
    }
//MENJUMLAHKAN NILAI ALTERNATIF UNTUK MASING2 KRITERIA
    $cari = mysqli_query($config,"SELECT * FROM dt_penduduk");
    while($r=mysqli_fetch_array($cari)){
        $id_penduduk = $r[id_penduduk];
        $tambah2=mysqli_query($config, "SELECT SUM(n_komponen2) FROM penilaian JOIN kriteria ON penilaian.kode_kriteria=kriteria.kode_kriteria WHERE kriteria.k_komponen='Pendidikan' AND penilaian.id_penduduk='$id_penduduk'");
        while($r2=mysqli_fetch_array($tambah2)){
            $sum2 = $r2[0];
            mysqli_query($config, "UPDATE hasil SET n_komponen='$sum2' WHERE id_penduduk='$id_penduduk'");
        }
    }

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Penduduk
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Data</a></li>
      <li class="active">Data Penduduk</li>
    </ol>
  </section>
  <section class="content">
        <!-- Hasil Rangking -->
        <div class="box">
            <div class="box-header with-border">
                Hasil Rangking
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-striped dataTable no-footer">
                    <thead>
                    <tr> 
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no=0;
                        $tampil=mysqli_query($config, "SELECT * FROM hasil JOIN dt_penduduk ON dt_penduduk.id_penduduk=hasil.id_penduduk ORDER BY nilai DESC");
                        while($r=mysqli_fetch_array($tampil))
                        {
                            $no=$no+1;
                            $id_penduduk=$r[id_penduduk];
                            echo "
                            <tr>
                                <td>$no</td>
                                <td>$r[nama]</td>
                                <td>$r[nilai]</td>
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Hasil Rangking Berdasarkan Komponen -->
        <div class="box">
            <div class="box-header with-border">
                Hasil Rangking Berdasarkan Komponen Pendidikan
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <div class='col-md-12 form-group'>
                    <input type=button class='btn btn-primary btn-flat' value="Kembali" onclick=self.history.back()>
                </div>
                <table id="example3" class="table table-striped dataTable no-footer">
                    <thead>
                    <tr> 
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no=0;
                        $tampil=mysqli_query($config, "SELECT * FROM hasil JOIN dt_penduduk ON dt_penduduk.id_penduduk=hasil.id_penduduk ORDER BY n_komponen DESC");
                        while($r=mysqli_fetch_array($tampil))
                        {
                            $no=$no+1;
                            $id_penduduk=$r[id_penduduk];
                            echo "
                            <tr>
                                <td>$no
                                <td>$r[nama]
                                <td>$r[n_komponen]
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
  </section>
</div>
<?php 
break;
 ?>
<?php
 case "kesehatan":
//MENGHITUNG NILAI UTILITY
    $cari=mysqli_query($config, "SELECT * FROM penilaian JOIN kriteria WHERE kriteria.k_komponen='Kesehatan' AND penilaian.kode_kriteria=kriteria.kode_kriteria");
    while($r1=mysqli_fetch_array($cari))
    {
        $kode_kriteria = $r1[kode_kriteria];
        $id_penduduk = $r1[id_penduduk];
        $tot1 = ($r1[nilai]-$r1[min])/($r1[max]-$r1[min]);
        // echo "oke = $tot1";
        mysqli_query($config, "UPDATE penilaian SET n_komponen='$tot1' WHERE kode_kriteria='$kode_kriteria' AND id_penduduk='$id_penduduk'");
    }

//MENORMALISASI DENGAN BOBOT KRITERIA
    $cari = mysqli_query($config,"SELECT * FROM penilaian JOIN kriteria WHERE kriteria.k_komponen='Kesehatan' AND penilaian.kode_kriteria=kriteria.kode_kriteria");
    while($r= mysqli_fetch_array($cari)){
        $nilai = $r[n_komponen];
        $id_penduduk = $r[id_penduduk];
        $normalisasi = $r[n_komponen]*$r[k_bobot];
        // echo "hasil = $normalisasi";
        mysqli_query($config, "UPDATE penilaian SET n_komponen2='$normalisasi' WHERE n_komponen='$nilai' AND id_penduduk='$id_penduduk'");
    }
//MENJUMLAHKAN NILAI ALTERNATIF UNTUK MASING2 KRITERIA
    $cari = mysqli_query($config,"SELECT * FROM dt_penduduk");
    while($r=mysqli_fetch_array($cari)){
        $id_penduduk = $r[id_penduduk];
        $tambah2=mysqli_query($config, "SELECT SUM(n_komponen2) FROM penilaian JOIN kriteria ON penilaian.kode_kriteria=kriteria.kode_kriteria WHERE kriteria.k_komponen='Kesehatan' AND penilaian.id_penduduk='$id_penduduk'");
        while($r2=mysqli_fetch_array($tambah2)){
            $sum2 = $r2[0];
            mysqli_query($config, "UPDATE hasil SET n_komponen='$sum2' WHERE id_penduduk='$id_penduduk'");
        }
    }

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Penduduk
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Data</a></li>
      <li class="active">Data Penduduk</li>
    </ol>
  </section>
  <section class="content">
        <!-- Hasil Rangking -->
        <div class="box">
            <div class="box-header with-border">
                Hasil Rangking
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-striped dataTable no-footer">
                    <thead>
                    <tr> 
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no=0;
                        $tampil=mysqli_query($config, "SELECT * FROM hasil JOIN dt_penduduk ON dt_penduduk.id_penduduk=hasil.id_penduduk ORDER BY nilai DESC");
                        while($r=mysqli_fetch_array($tampil))
                        {
                            $no=$no+1;
                            $id_penduduk=$r[id_penduduk];
                            echo "
                            <tr>
                                <td>$no</td>
                                <td>$r[nama]</td>
                                <td>$r[nilai]</td>
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Hasil Rangking Berdasarkan Komponen -->
        <div class="box">
            <div class="box-header with-border">
                Hasil Rangking Berdasarkan Komponen Kesehatan
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <div class='col-md-12 form-group'>
                    <input type=button class='btn btn-primary btn-flat' value="Kembali" onclick=self.history.back()>
                </div>
                <table id="example3" class="table table-striped dataTable no-footer">
                    <thead>
                    <tr> 
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no=0;
                        $tampil=mysqli_query($config, "SELECT * FROM hasil JOIN dt_penduduk ON dt_penduduk.id_penduduk=hasil.id_penduduk ORDER BY n_komponen DESC");
                        while($r=mysqli_fetch_array($tampil))
                        {
                            $no=$no+1;
                            $id_penduduk=$r[id_penduduk];
                            echo "
                            <tr>
                                <td>$no
                                <td>$r[nama]
                                <td>$r[n_komponen]
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
  </section>
</div>
<?php 
break;
 ?>
<?php
 case "sosial":
//MENGHITUNG NILAI UTILITY
    $cari=mysqli_query($config, "SELECT * FROM penilaian JOIN kriteria WHERE kriteria.k_komponen='Kesejahteraan Sosial' AND penilaian.kode_kriteria=kriteria.kode_kriteria");
    while($r1=mysqli_fetch_array($cari))
    {
        $kode_kriteria = $r1[kode_kriteria];
        $id_penduduk = $r1[id_penduduk];
        $tot1 = ($r1[nilai]-$r1[min])/($r1[max]-$r1[min]);
        // echo "oke = $tot1";
        mysqli_query($config, "UPDATE penilaian SET n_komponen='$tot1' WHERE kode_kriteria='$kode_kriteria' AND id_penduduk='$id_penduduk'");
    }

//MENORMALISASI DENGAN BOBOT KRITERIA
    $cari = mysqli_query($config,"SELECT * FROM penilaian JOIN kriteria WHERE kriteria.k_komponen='Kesejahteraan Sosial' AND penilaian.kode_kriteria=kriteria.kode_kriteria");
    while($r= mysqli_fetch_array($cari)){
        $nilai = $r[n_komponen];
        $id_penduduk = $r[id_penduduk];
        $normalisasi = $r[n_komponen]*$r[k_bobot];
        // echo "hasil = $normalisasi";
        mysqli_query($config, "UPDATE penilaian SET n_komponen2='$normalisasi' WHERE n_komponen='$nilai' AND id_penduduk='$id_penduduk'");
    }
//MENJUMLAHKAN NILAI ALTERNATIF UNTUK MASING2 KRITERIA
    $cari = mysqli_query($config,"SELECT * FROM dt_penduduk");
    while($r=mysqli_fetch_array($cari)){
        $id_penduduk = $r[id_penduduk];
        $tambah2=mysqli_query($config, "SELECT SUM(n_komponen2) FROM penilaian JOIN kriteria ON penilaian.kode_kriteria=kriteria.kode_kriteria WHERE kriteria.k_komponen='Kesejahteraan Sosial' AND penilaian.id_penduduk='$id_penduduk'");
        while($r2=mysqli_fetch_array($tambah2)){
            $sum2 = $r2[0];
            mysqli_query($config, "UPDATE hasil SET n_komponen='$sum2' WHERE id_penduduk='$id_penduduk'");
        }
    }

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Penduduk
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Data</a></li>
      <li class="active">Data Penduduk</li>
    </ol>
  </section>
  <section class="content">
        <!-- Hasil Rangking -->
        <div class="box">
            <div class="box-header with-border">
                Hasil Rangking
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-striped dataTable no-footer">
                    <thead>
                    <tr> 
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no=0;
                        $tampil=mysqli_query($config, "SELECT * FROM hasil JOIN dt_penduduk ON dt_penduduk.id_penduduk=hasil.id_penduduk ORDER BY nilai DESC");
                        while($r=mysqli_fetch_array($tampil))
                        {
                            $no=$no+1;
                            $id_penduduk=$r[id_penduduk];
                            echo "
                            <tr>
                                <td>$no</td>
                                <td>$r[nama]</td>
                                <td>$r[nilai]</td>
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Hasil Rangking Berdasarkan Komponen -->
        <div class="box">
            <div class="box-header with-border">
                Hasil Rangking Berdasarkan Komponen Kesejahteraan Sosial
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <div class='col-md-12 form-group'>
                    <input type=button class='btn btn-primary btn-flat' value="Kembali" onclick=self.history.back()>
                </div>
                <table id="example3" class="table table-striped dataTable no-footer">
                    <thead>
                    <tr> 
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no=0;
                        $tampil=mysqli_query($config, "SELECT * FROM hasil JOIN dt_penduduk ON dt_penduduk.id_penduduk=hasil.id_penduduk ORDER BY n_komponen DESC");
                        while($r=mysqli_fetch_array($tampil))
                        {
                            $no=$no+1;
                            $id_penduduk=$r[id_penduduk];
                            echo "
                            <tr>
                                <td>$no
                                <td>$r[nama]
                                <td>$r[n_komponen]
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
  </section>
</div>
<?php 
break;
} ?>
<?php  include 'theme/footer2.php';?>
