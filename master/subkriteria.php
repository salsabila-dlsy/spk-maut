 
<?php
include 'theme/header.php';
switch($_GET['act'])

{
	default:?>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
			Sub Kriteria
			</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Data</a></li>
				<li class="active">Sub Kriteria</li>
			</ol>
		</section>
		<section class="content">
			<div class="box">
				<div class="box-body">
					<table id="example1" class="table table-striped dataTable no-footer">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Kriteria</th>
								<th>Nama Kriteria</th>
								<!-- <th>Nama Kriteria</th> -->
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
									<td>
										<a href="?page=subkriteria&act=isi1&kode_kriteria=<?php echo $r['kode_kriteria']; ?>" class="btn btn-info"><li class="fa fa-pencil"></li></a>
									</td>
								</tr>
							<?php
						} ?>
							<tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
<?php break; ?>

<?php
	case "isi1":
	$edit = mysqli_query($config, "SELECT * FROM kriteria 
		WHERE kriteria.kode_kriteria LIKE '$_GET[kode_kriteria]'");
	$r    = mysqli_fetch_array($edit);?>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Sub Kriteria
			</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Data</a></li>
				<li class="active">Sub Kriteria</li>
			</ol>
		</section>
		<section class="content">
			<div class="box">
				<div class="box-body">
					<div class="box-header with-border">
						Tambah Sub Kriteria
					</div>
					<form action="./aksi.php?sender=b_tambah" method="POST">
						<div class="box-body">	
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Nama Kriteria</label>
									<input type=hidden name="kode_kriteria" value=<?php echo $r['kode_kriteria']; ?>>	
									<input type=text disabled name="k_nama" class="form-control" value="<?php echo $r['k_nama']; ?>" required/>
								</div>	
								<div class="col-md-12 form-group">
									<label>Sub Kriteria</label>
									<input type=text name="b_nama" class="form-control"  required/>
								</div>
								<div class="col-md-12 form-group">
									<label>Nilai Sub Kriteria</label>
									<input type=text name="n_bobot" class="form-control"  required/>
								</div>
								<div class="col-md-12 form-group">
									<button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-send"></span> Simpan</button>
									<a class="btn btn-default" href="?page=subkriteria">Kembali</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="box">
				<div class="box-body">
					<table id="example1" class="table table-striped dataTable no-footer">
						<thead>
							<tr>
								<th>No</th>
								<th>Sub Kriteria</th>
								<th>Nilai</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$no=0;
							$tampil = mysqli_query($config, "SELECT * FROM bobot_nilai WHERE kode_kriteria='$_GET[kode_kriteria]'");
							while($r=mysqli_fetch_array($tampil))
							{
								$no=$no+1;?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $r['b_nama']; ?></td>
										<td><?php echo $r['n_bobot']; ?></td>
										<td>
											<a href="?page=subkriteria&act=ubah&kode_bobot=<?php echo $r['kode_bobot']; ?>" class="btn btn-info"><li class="fa fa-pencil"></li></a>
											<a href="./aksi.php?sender=b_hapus&kode_bobot=<?php echo $r['kode_bobot']; ?>&kode_kriteria=<?php echo $r['kode_kriteria']; ?>" class="btn btn-danger"><li class="fa fa-trash-o"></li></a>
										</td>
									</tr>
								<?php
							} ?>
						<tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
	<?php
	break;
?>
<?php
	case "ubah":
	$edit = mysqli_query($config, "SELECT * FROM bobot_nilai JOIN kriteria  
		ON kriteria.kode_kriteria=bobot_nilai.kode_kriteria WHERE kode_bobot='$_GET[kode_bobot]'");
	$r    = mysqli_fetch_array($edit);?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Sub Kriteria
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
						Edit Sub Kriteria
					</div>
					<form action="aksi.php?sender=b_edit" method="POST">
						<div class="box-body">	
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Nama Kriteria</label>
									<input type=hidden name="kode_kriteria" value=<?php echo $r['kode_kriteria']; ?>>	
									<input type=hidden name="kode_bobot" value=<?php echo $r['kode_bobot']; ?>>	
									<input type=text disabled name="k_nama" class="form-control" value="<?php echo $r['k_nama']; ?>" required/>
								</div>	
								<div class="col-md-12 form-group">
									<label>Sub Kriteria</label>
									<input type=text name="b_nama" class="form-control"value="<?php echo $r['b_nama']; ?>"  required/>
								</div>
								<div class="col-md-12 form-group">
									<label>Nilai</label>
									<input type=text name="n_bobot" class="form-control"value="<?php echo $r['n_bobot']; ?>"  required/>
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
?>
<?php include 'theme/footer.php'; ?>