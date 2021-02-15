<?php
include 'theme/header.php';
switch($_GET['act'])

{
	default:?>	
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
			Penilaian
			</h1>
			<ol class="breadcrumb">
			<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Penilaian</a></li>
			<li class="active">Penilaian</li>
			</ol>
		</section>
		<section class="content">
			<div class="box">
				<div class="box-body">
					<table id="example1" class="table table-striped dataTable no-footer">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>NIK</th>
								<th>Alamat</th>
								<th>Total Nilai</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=0;
							$tampil2=mysqli_query($config, "SELECT * FROM dt_penduduk");
							while($r2=mysqli_fetch_array($tampil2))
							{
								
								$no=$no+1;
								
								?>
								
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $r2['nama']; ?></td>
										<td><?php echo $r2['nik']; ?></td>
										<td><?php echo $r2['alamat']; ?></td>
										<?php
										$id_penduduk=$r2['id_penduduk'];
										$hitung=mysqli_query($config, "SELECT SUM(nilai) AS totalnilai FROM penilaian WHERE id_penduduk='$id_penduduk'");
										while ($row=mysqli_fetch_array($hitung)) {
											echo "<td>$row[totalnilai]</td>";
										}	
										?>
										<td>
											<a href="?page=nilai&act=ubah&id_penduduk=<?php echo $r2['id_penduduk']; ?>" class="btn btn-info"><li class="fa fa-pencil"></li></a>
										</td>
									</tr>
								<?php
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
	<?php
break; ?>
<?php
	case "ubah":
			$bobot=0;
			$tampil=mysqli_query($config, "SELECT * FROM dt_penduduk WHERE id_penduduk='$_GET[id_penduduk]'");
			$r=mysqli_fetch_array($tampil);
			
				$id_penduduk=$r['id_penduduk'];
				$tampil2=mysqli_query($config, "SELECT * FROM kriteria ORDER BY kode_kriteria DESC");
				while($r2=mysqli_fetch_array($tampil2))
				{
					$kode_kriteria=$r2['kode_kriteria'];
					$k_on_k = mysqli_query($config,"SELECT COUNT(kode_kriteria) AS total FROM kriteria");
					$cek = mysqli_fetch_assoc($k_on_k);
					$k_jumlah = $cek['total'];
					$k_on_p = mysqli_query($config,"SELECT COUNT(kode_kriteria) AS k_total FROM penilaian WHERE id_penduduk='$id_penduduk'");
					$cek1 = mysqli_fetch_assoc($k_on_p);
					$k_jumlah1 = $cek1['k_total'];
					$cari=mysqli_query($config, "SELECT * FROM penilaian WHERE kode_kriteria='$kode_kriteria' AND id_penduduk='$id_penduduk' AND id_penduduk='$id_penduduk'");
					$r3=mysqli_fetch_array($cari);
					if($k_jumlah1<$k_jumlah){
						$oke= mysqli_query($config, "INSERT INTO penilaian(id_penduduk,kode_kriteria,nilai)
						values('$id_penduduk','$kode_kriteria','$bobot')");
					}
				
				}?>	
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
				Penilaian
				</h1>
				<ol class="breadcrumb">
				<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Penilaian</a></li>
				<li class="active">Penilaian</li>
				</ol>
			</section>
			<section class="content">
				<div class="box">
					<div class="box-body">
						
						<?php
						$tampil=mysqli_query($config, "SELECT * FROM dt_penduduk WHERE id_penduduk LIKE '$_GET[id_penduduk]'");
						$r=mysqli_fetch_array($tampil);
						echo"<div class='col-md-18 form-group'>
							<input disabled type='text' name='k_komponen' class='form-control' placeholder='$r[nama]' required=''>
						</div>";
						$no=0;
						$tampil = mysqli_query($config, "SELECT * FROM penilaian JOIN kriteria 
							ON penilaian.kode_kriteria=kriteria.kode_kriteria
							WHERE id_penduduk='$_GET[id_penduduk]' ORDER BY id_nilai");
						while($r=mysqli_fetch_array($tampil))
						{
							$kode_kriteria=$r['kode_kriteria'];
							$kode_bobot=$r['kode_bobot'];
						?>
						<form action="aksi.php?sender=n_edit" method="POST">
							<input type="hidden" name="id_nilai" value="<?php echo $r['id_nilai']; ?>">
							<input type="hidden" name="id_penduduk" value="<?php echo $_GET['id_penduduk']; ?>">
							<div class="col-md-18 form-group">
								<label><?php echo $r['k_nama']; ?></label>
							
						<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<select class="form-control" id="exampleInputEmail1" name="kode_bobot" onChange=this.form.submit()>
								<?php
								$tampil22=mysqli_query($config, "SELECT * FROM bobot_nilai WHERE kode_kriteria='$kode_kriteria'");
								while($r22=mysqli_fetch_array($tampil22))
								{
									if ($r22[kode_bobot]==$r[kode_bobot])
									{
										echo "<option value=$r22[kode_bobot] selected>";if($r22[n_bobot]==2){echo "Lebih dari atau Sama dengan $r22[n_bobot]";}else{echo "$r22[n_bobot]";}
									}
									else
									{
										echo "<option value=$r22[kode_bobot]>";if($r22[n_bobot]==2){echo "Lebih dari atau Sama dengan $r22[n_bobot]";}else{echo "$r22[n_bobot]";}
									}
								}
								echo "</select>
								</form><br>
										
								</form>
								</div>
								";
							}?>

						<a href="?page=nilai"><input type=button class="btn btn-primary btn-flat" value="Simpan"></a>
					</div>
				</div>
			</section>
		</div>
				<?php
			break;

}
?>
<?php  include 'theme/footer.php';?>
