<?php
include 'theme/header.php';
switch($_GET['act'])

{
	default:?>	
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
		<div class="box">
			<div class="box-body">
				<form action="aksi.php?sender=anggota" method=POST>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12 form-group">
								<label>Nama</label>
								<input type="text" name="nama" class="form-control" placeholder="Enter..." autocomplete="off" required="">
							</div>
							<div class="col-md-12 form-group">
								<label>NIK</label>
								<input type="text" name="nik" class="form-control" placeholder="Enter..." autocomplete="off" required="">
							</div>
							<div class="col-md-12 form-group">
								<label>Alamat</label>
								<input type="text" name="alamat" class="form-control" placeholder="Enter..." autocomplete="off" required="">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" class="btn btn-info btn-flat"> Tambah</button> 
								<input class="btn btn-default" type="reset" value="Reset">
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
							<th>Nama</th>
							<th>NIK</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$no=0;
					$tampil = mysqli_query($config, "SELECT * FROM dt_penduduk");
					while($r=mysqli_fetch_array($tampil))
					{
						$no=$no+1;?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $r['nama']; ?></td>
								<td><?php echo $r['nik']; ?></td>
								<td><?php echo $r['alamat']; ?></td>
								<td>
									<a href="?page=penduduk&act=ubah&id_penduduk=<?php echo $r['id_penduduk']; ?>" class="btn btn-info"><li class="fa fa-pencil"></li></a>
									<a href="./aksi.php?sender=hapus&id_penduduk=<?php echo $r['id_penduduk']; ?>" class="btn btn-danger"><li class="fa fa-trash-o"></li></a>
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
	break;
?>
<?php
case "ubah":
$id_penduduk=$_GET['id_penduduk'];
$edit = mysqli_query($config, "SELECT * FROM dt_penduduk WHERE id_penduduk LIKE '$_GET[id_penduduk]'");
$r= mysqli_fetch_array($edit);
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
		<div class="box">
			<div class="box-body">
				<div class="box-header with-border">
					Edit Data Penduduk
				</div>
				<form action="aksi.php?sender=edit" method=POST>
					<div class="box-body">	
						<div class="row">
							<div class="col-md-12 form-group">
								<label>Nama</label>
								<input type=hidden name="id_penduduk" value="<?php echo $r['id_penduduk'];?>">	
								<input type=text name="nama" class="form-control" value="<?php echo $r['nama'];?>" required/>
							</div>	
							<div class="col-md-12 form-group">
								<label>NIK</label>
								<input type=text name="nik" class="form-control"value="<?php echo $r['nik'];?>"  required/>
							</div>
							<div class="col-md-12 form-group">
								<label>Alamat</label>
								<input type=text name="alamat" class="form-control"value="<?php echo $r['alamat'];?>"  required/>
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
</div
			
<?php	
break;	
}
 ?>
 <?php  include 'theme/footer.php'; ?>