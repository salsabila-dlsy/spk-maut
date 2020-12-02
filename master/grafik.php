<?php
$koneksi     = mysqli_connect("localhost", "root", "", "spk_dosen");
$vektor       = mysqli_query($koneksi, "SELECT * FROM dosen_peserta");
$alt = mysqli_query($koneksi, "SELECT * FROM dosen_peserta");
?>
<?php include 'theme/header.php'; ?>
<html>
    <head>
        <title>Belajarphp.net - ChartJS</title>
        <script src="assets/Chart.bundle.js"></script>

        <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>
    <div class="content-wrapper">
    <body>
        <section class="content">
        <div class="container">
            <canvas id="myChart" width="100" height="100"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($alt)) { echo '"A' . $b['id_dosen'] . '",';}?>],
                    datasets: [{
                            label: 'Vektor V',
                            data: [<?php while ($p = mysqli_fetch_array($vektor)) { echo '"' . round($p['vektor_v'],4) . '",';}?>],
                            borderWidth: 3,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
        <div class="box">
        <div class="box-body">
                               <table id="example1" class="table table-striped dataTable no-footer">
                    <thead>
                      <tr> 
                        <th>#</th>
                        <th>Alternatif</th>
                        <th>Nama</th>
                        <th>Vektor V</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql="select * from dosen_peserta";
                        $no=1;
                        if (!$result=  mysqli_query($config, $sql)){
                        die('Error:'.mysqli_error($config));
                        }  else {
                        if (mysqli_num_rows($result)> 0){
                        while ($row =  mysqli_fetch_assoc($result)){
                    ?>
                    
                        <tr>
                            <td><?php echo $no ;?></td>
                            <td>A<?php echo $row['id_dosen'];?></td>
                            <td><?php echo $row['nama'];?></td>
                            <td><?php echo round($row['vektor_v'],4) ;?></td>
                        </tr> 
                            <?php    
                    $no++;                    
                        }
                    }  else {
                    echo '';    
                    }
                    }?>
                    </tbody>
                   
                     
                  </table>
            </div></div>
    </div>
    </body><?php include 'theme/footer.php'; ?></section>

</html>