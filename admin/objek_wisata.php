<?php 
include '../config.php';
session_start();
if($_SESSION["id"] != 1){
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SPK OCRA | Admin</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
	<link rel="stylesheet" href="../asset/fontawesome-5.10.2/css/all.css">
	<script type="text/javascript" src="../asset/js/jquery.js"></script>
	<script type="text/javascript" src="../asset/js/bootstrap.js"></script>
	<!-- CSS DataTable -->
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
 	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="../img/logo.png" alt="..." style="height:35px; width: 35px;"> Fajar Tour and Travel
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item "><a class="nav-link" aria-current="page" href="admin.php">Dashboard</a></li>
					<li class="nav-item"><a class="nav-link active" href="objek_wisata">Objek Wisata</a></li>
					<li class="nav-item"><a class="nav-link" href="kriteria.php">Kriteria</a></li>
					<li class="nav-item"><a class="nav-link" href="alternatif.php">Nilai Alternatif</a></li>
					<li class="nav-item"><a class="nav-link" href="perhitungan.php">Perhitungan</a></li>
					<li class="nav-item"><a href="../logout.php" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- End Navbar -->
	
	<!-- Tambahkan Data -->
	<div class="container">   
        <div class="row" style="padding-top: 80px; padding-bottom: 20px;">
			<div class="col-lg-12 p-3">
				<section class="card p-3">
				<div class="col-lg-12">
					<h3 class="text-center">OBJEK WISATA</h3>
				</div>
				
				<div class="alert alert-secondary" role="alert">
					<strong>Tambahkan Data Objek Wisata</strong>
				</div>
				
				<!-- insert file -->
				<?php
					include '../config.php';
					
					if(isset($_POST['Submit'])){
						$nama_wisata =  $_POST['nama_wisata'];
						$htm = $_POST['htm'];
						$wahana = $_POST['wahana'];
						$r2 = $_POST['r2'];
						$r4 = $_POST['r4'];
						$bus = $_POST['bus'];
						$jarak = $_POST['jarak'];
						$lokasi = $_POST['lokasi'];
						$fasilitas = $_POST['fasilitas'];
						$jml_fst = $_POST['jml_fst'];
						$ket = $_POST['ket'];
						$gambar = $_FILES['gambar']['name'];
						$date_now = date("Y/m/d");
						
						$dir = "../gambar/";
						$tmpFile = $_FILES['gambar']['tmp_name'];
						
						move_uploaded_file($tmpFile, $dir.$gambar);
											
						$sql = mysqli_query($conn,"INSERT INTO objek_wisata(nama_wisata, htm, wahana, r2, r4, bus, jarak, lokasi, fasilitas, jml_fst, ket, gambar, tgl) VALUES('$nama_wisata','$htm','$wahana','$r2','$r4','$bus','$jarak','$lokasi','$fasilitas','$jml_fst','$ket','$gambar','$date_now')");
						
						if($sql){
							$tampil = mysqli_query($conn, "SELECT * FROM `objek_wisata` ORDER BY id_objek DESC LIMIT 1");
							//var_dump($tampil);
							while ($row = $tampil->fetch_assoc()){
								$id = $row["id_objek"];
								
								mysqli_query($conn,"INSERT INTO matrik(id_objek, htm3, keindahan3, kebersihan3, fasilitas3, jarak3, akses3, tgl3) VALUES ('$id','0','0','0','0','0','0','$date_now')");
								
								mysqli_query($conn,"INSERT INTO preferensi(id_objek, htm4, keindahan4, kebersihan4, fasilitas4, jarak4, akses4, cost, benefit, cost_lin, benefit_lin, pi) VALUES ('$id','0','0','0','0','0','0','0','0','0','0','0')");
							}
							
							echo "<div class='alert alert-success'> Data objek wisata $nama_wisata berhasil disimpan.</div>";
						}else{
							echo "<div class='alert alert-danger'> Pengisian Gagal.</div>";
						}
					}
				?>
				<!-- end insert file -->
				<form action="" id="form" method="post" enctype="multipart/form-data">
					<div class="row p-2">
						<div class="col-lg-2">
							<input type="hidden" name="id_objek" id="id_objek" class="form-control" maxlength="100">
							<label>Nama Wisata</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="nama_wisata" id="nama_wisata" class="form-control" maxlength="100" required oninvalid="this.setCustomValidity('Nama Wisata Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
						
						<div class="col-lg-2">
							<label>Harga Tiket Masuk</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="htm" id="htm" class="form-control" maxlength="50" required oninvalid="this.setCustomValidity('HTM Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Nama Wahana</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="wahana" id="wahana" class="form-control" maxlength="100" required oninvalid="this.setCustomValidity('Wahana Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
						
						<div class="col-lg-2">
							<label>Parkir Roda 2</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="r2" id="r2" class="form-control" maxlength="50" required oninvalid="this.setCustomValidity('Parkir R2 Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Parkir Roda 4</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="r4" id="r4" class="form-control" maxlength="50" required oninvalid="this.setCustomValidity('Parkir R4 Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
						
						<div class="col-lg-2">
							<label>Parkir Bus</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="bus" id="bus" class="form-control" maxlength="50" required oninvalid="this.setCustomValidity('Parkir Bus Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Jarak</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="jarak" id="jarak" class="form-control" maxlength="50" required oninvalid="this.setCustomValidity('Jarak Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
						
						<div class="col-lg-2">
							<label>Lokasi</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="lokasi" id="lokasi" class="form-control" required oninvalid="this.setCustomValidity('Lokasi Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Fasilitas</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="fasilitas" id="fasilitas" class="form-control" required oninvalid="this.setCustomValidity('Fasilitas Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
						
						<div class="col-lg-2">
							<label>Jumlah Fasilitas</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="jml_fst" id="jml_fst" class="form-control" maxlength="100" required oninvalid="this.setCustomValidity('Jumlah Fasilitas Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Keterangan Tempat</label>
						</div>
						<div class="col-lg-4">
							<textarea class="form-control" name="ket" id="ket" required oninvalid="this.setCustomValidity('Keterangan Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
						</div>
						
						<div class="col-lg-2">
							<label>Upload Gambar</label>
						</div>
						<div class="col-lg-4">
							<input class="form-control" type="file" name="gambar" id="gambar" accept="image/*">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-sm-4">
							<button type="submit" name="Submit" id="Submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambahkan</button>
							<button type="reset" class="btn btn-secondary">Reset</button>
						</div>
					</div>
				</form>
				</section>
			</div>
		</div>
	</div>
	<!-- End Tambahkan Data -->
	
	<!-- Table Data -->
        <div class="row" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
			<div class="card col-lg-12 p-3">
			<h3 class="text-center">Data Objek Wisata</h3>
			<table class="table table-striped table-hover table-bordered table-responsive" id="data-table">
				<thead>
					<tr>
						<td><strong>No</strong></td>
						<td><strong>Wisata</strong></td>
						<td><strong>HTM</strong></td>
						<td><strong>Wahana</strong></td>
						<td><strong>P R2</strong></td>
						<td><strong>P R4</strong></td>
						<td><strong>P Bus</strong></td>
						<td><strong>Jarak</strong></td>
						<td><strong>Lokasi</strong></td>
						<td><strong>Fslts</strong></td>
						<td><strong>Jml Fslt</strong></td>
						<td><strong>Ket</strong></td>
						<td><strong>Gambar</strong></td>
						<td><strong>Aksi</strong></td>
					</tr>
				</thead>
				<tbody>
				<!-- awal proses menampilkan -->
				<?php
				include '../config.php';
				$no=1;
				$sql = "SELECT*FROM objek_wisata";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()) {
				?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?php echo $row['nama_wisata']; ?></td>
						<td><?php echo $row['htm']; ?></td>
						<td><?php echo $row['wahana']; ?></td>
						<td><?php echo $row['r2']; ?></td>
						<td><?php echo $row['r4']; ?></td>
						<td><?php echo $row['bus']; ?></td>
						<td><?php echo $row['jarak']; ?></td>
						<td><?php echo $row['lokasi']; ?></td>
						<td><?php echo $row['fasilitas']; ?></td>
						<td><?php echo $row['jml_fst']; ?></td>
						<td><?php echo $row['ket']; ?></td>
						<td>
							<img src="../gambar/<?php echo $row['gambar']; ?>" style="width: 100px; height: 100px;">
						</td>
						<td class="text-center">
							<a class="btn btn-success btn-sm" href='update_wisata.php?id=<?php echo $row['id_objek']; ?>'><i class="fa fa-edit"></i></a>
							<a class="btn btn-danger btn-sm" href='hapus_wisata.php?id=<?php echo $row['id_objek']; ?>' onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php
					}
				?>
				<!-- akhir proses menampilkan -->
				</tbody>
			</table>
			</div>
		</div>
	<!-- End Table Data -->
	
	<!-- Footer-->
	<footer class="bg-dark text-white mb-3">
	<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
		  &#169;Copyright 2022 Fajar Tour and Travel
		</div>
	</footer>
	<!--end footer-->
	
	<!-- DataTable Plugin -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#data-table').DataTable();
		});
	</script>
</body>
</html>