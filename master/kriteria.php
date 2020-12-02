<?php
include 'theme/header.php';
switch($_GET['act'])

{
	default:?>	
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
			Kriteria
			</h1>
			<ol class="breadcrumb">
			<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Kriteria</a></li>
			<li class="active">Daftar Kriteria</li>
			</ol>
		</section>
		<section class="content">
			<div class="box">
				<div class="box-body">
					<form action="aksi.php?sender=k_tambah" method="POST">
						<div class="col-md-12 form-group">
							<label>Kode Kriteria</label>
							<input type="text" name="kode_kriteria" class="form-control" placeholder="Enter..." required="">
						</div>
						<div class="col-md-12 form-group">
							<label>Nama Kriteria</label>
							<input type="text" name="k_nama" autocomplete="off" class="form-control" placeholder="Enter..." required="">
						</div>
						<div class="col-md-12 form-group">
							<label>Komponen Kriteria</label>
							<input type="text" name="k_komponen" class="form-control" placeholder="Enter..." required="">
						</div>
						<div class="col-md-12 form-group">
							<label>Bobot</label>
							<input type="text" autocomplete="off" name="k_bobot" class="form-control" placeholder="Masukan nilai 0 s.d 1" required="">
						</div>
						<?php
						$dt=100;
						$qry = mysqli_query($config, "SELECT SUM(k_bobot) AS total FROM kriteria");
						$row = mysqli_fetch_assoc($qry);
						$aa=$row['total'];
						if($aa<$dt)
						{
							echo"
								<div class='col-md-12 form-group'>
									<button type='submit' class='btn btn-info btn-flat'> Tambah</button> 
									<input class='btn btn-default' type='reset' value='Reset'>
								</div>
								";
						}
						else if($aa<$dt)
						{
							echo"
								
								<p>Anda Tidak Bisa Menambah Kriteria Karena Bobot Melebihi Batas</p>
								</form><br>
								</div>";
						}
						else if($aa==$dt)
						{
							echo"
								Anda Tidak Bisa Menambah Kriteria Silahkan Edit Bobot Sesuai Dengan Kebutuhan
								</form><br>
								</div>";
						}?>
					</form><br>
				</div>
			</div>
				<div class="box">
					<div class="box-body">
						<table id="example1" class="table table-striped dataTable no-footer">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Kriteria</th>
									<th>Nama Kriteria</th>
									<th>Komponen Kriteria</th>
									<th>Bobot</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=0;
							$tampil = mysqli_query($config, "SELECT * FROM kriteria");
							while($r=mysqli_fetch_array($tampil))
							{
								$no=$no+1;?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $r['kode_kriteria']; ?></td>
										<td><?php echo $r['k_nama']; ?></td>
										<td><?php echo $r['k_komponen']; ?></td>
										<td><?php echo $r['k_bobot']; ?></td>
										<td>
											<a href="?page=kriteria&act=ubah&kode_kriteria=<?php echo $r['kode_kriteria']; ?>" class="btn btn-info"><li class="fa fa-pencil"></li></a>
											<a href="./aksi.php?sender=k_hapus&kode_kriteria=<?php echo $r['kode_kriteria']; ?>" class="btn btn-danger"><li class="fa fa-trash-o"></li></a>
										</td>
									</tr>
									<?php
							} ?>
								</tbody>
						</table><br>
					</div>
				</div>
		</section>
	</div>
	<?php
	break; 
	?>

<?php
	case "ubah":
	$edit = mysqli_query($config, "SELECT * FROM kriteria WHERE kriteria.kode_kriteria LIKE '$_GET[kode_kriteria]'");
	$r    = mysqli_fetch_array($edit);?>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Kriteria
			</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Data</a></li>
				<li class="active">Data Penduduk</li>
			</ol>
		</section>
		<section class="content">
			<div class="box">
				<div class="box-body">
					<div class="box-header with-border">
						Edit Kriteria
					</div>
					<form action="aksi.php?sender=k_edit" method=POST>
						<div class="box-body">	
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Kode Kriteria</label>
									<input type=hidden name="kode_kriteria" value="<?php echo $r['kode_kriteria']; ?>">	
									<input type=text name="kode_kriteria" class="form-control" value="<?php echo $r['kode_kriteria']; ?>" required/>
								</div>	
								<div class="col-md-12 form-group">
									<label>Nama Kriteria</label>
									<input type=text name="k_nama" class="form-control"value="<?php echo $r['k_nama']; ?>"  required/>
								</div>
								<div class="col-md-12 form-group">
									<label>Komponen Kriteria</label>
									<input type=text name="k_komponen" class="form-control"value="<?php echo $r['k_komponen']; ?>"  required/>
								</div>
								<div class="col-md-12 form-group">
									<label>Bobot</label>
									<input type=text name="k_bobot" class="form-control"value="<?php echo $r['k_bobot']; ?>"  required/>
								</div>
								<div class="col-md-12 form-group">
									<button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-send"></span> Simpan</button>
									<input type=button class="btn btn-default" value=Batal onclick=self.history.back()>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
	<?php
	break;

}
  include 'theme/footer.php';?>