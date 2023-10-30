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
					<li class="nav-item"><a class="nav-link active" href="objek_wisata.php">Objek Wisata</a></li>
					<li class="nav-item"><a class="nav-link" href="kriteria.php">Kriteria</a></li>
					<li class="nav-item"><a class="nav-link" href="alternatif.php">Nilai Alternatif</a></li>
					<li class="nav-item"><a class="nav-link" href="perhitungan.php">Perhitungan</a></li>
					<li class="nav-item"><a href="../logout.php" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- End Navbar -->
	
	<!-- Update Data -->
	<div class="container">   
        <div class="row" style="padding-top: 80px; padding-bottom: 20px;">
			<div class="col-lg-12 p-3">
				<section class="card p-3">
				<div class="col-lg-12">
					<h3 class="text-center">OBJEK WISATA</h3>
				</div>
				
				<div class="alert alert-secondary" role="alert">
					<strong>Update Data Objek Wisata</strong>
				</div>
				
				<!-- awal proses update -->
				<?php 
				include '../config.php';
				
				if(isset($_POST['update'])){
					
					//mengambil data dari form
					$id_objek = $_POST['id_objek'];
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
					//die();
					// proses update
					$sql = "UPDATE objek_wisata SET nama_wisata='$nama_wisata',htm='$htm',wahana='$wahana',r2='$r2',r4='$r4',bus='$bus',jarak='$jarak',lokasi='$lokasi',fasilitas='$fasilitas',jml_fst='$jml_fst',ket='$ket',gambar='$gambar',tgl='$date_now'  WHERE id_objek='$id_objek'";
					if ($conn->query($sql) === TRUE) {
						header('location:objek_wisata.php');
					}
				}

				//menggambil id dari variabel
				$id=$_GET['id'];

				//menampilkan data objek wisata
				$sql = "SELECT * FROM objek_wisata WHERE id_objek='$id'";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				?>
				<!-- akhir proses update -->
				
				<form action="" id="form" method="post" enctype="multipart/form-data">
					<div class="row p-2">
						<div class="col-lg-2">
							<label>No ID</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="id_objek" id="id_objek" class="form-control" maxlength="100" readonly
							value="<?php echo $row['id_objek']; ?>">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Nama Wisata</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="nama_wisata" id="nama_wisata" class="form-control" maxlength="100" required value="<?php echo $row['nama_wisata']; ?>">
						</div>
						
						<div class="col-lg-2">
							<label>Harga Tiket Masuk</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="htm" id="htm" class="form-control" maxlength="50" required
							value="<?php echo $row['htm']; ?>">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Nama Wahana</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="wahana" id="wahana" class="form-control" maxlength="100" required
							value="<?php echo $row['wahana']; ?>">
						</div>
						
						<div class="col-lg-2">
							<label>Parkir Roda 2</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="r2" id="r2" class="form-control" maxlength="50" required
							value="<?php echo $row['r2']; ?>">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Parkir Roda 4</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="r4" id="r4" class="form-control" maxlength="50" required
							value="<?php echo $row['r4']; ?>">
						</div>
						
						<div class="col-lg-2">
							<label>Parkir Bus</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="bus" id="bus" class="form-control" maxlength="50" required
							value="<?php echo $row['bus']; ?>">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Jarak</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="jarak" id="jarak" class="form-control" maxlength="50" required
							value="<?php echo $row['jarak']; ?>">
						</div>
						
						<div class="col-lg-2">
							<label>Lokasi</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="lokasi" id="lokasi" class="form-control" maxlength="100" required
							value="<?php echo $row['lokasi']; ?>">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Fasilitas</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="fasilitas" id="fasilitas" class="form-control" required value="<?php echo $row['fasilitas']; ?>">
						</div>
						
						<div class="col-lg-2">
							<label>Jumlah Fasilitas</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="jml_fst" id="jml_fst" class="form-control" maxlength="100" required
							value="<?php echo $row['jml_fst']; ?>">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Keterangan Tempat</label>
						</div>
						<div class="col-lg-4">
							<textarea class="form-control" name="ket" id="ket" required
							value="<?php echo $row['ket']; ?>"></textarea>
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
							<button type="submit" name="update" id="update" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update</button>
							<a class="btn btn-danger" href="objek_wisata.php">Batal</a>
						</div>
					</div>
				</form>
				</section>
			</div>
		</div>
	</div>
	<!-- End Update Data -->
	
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