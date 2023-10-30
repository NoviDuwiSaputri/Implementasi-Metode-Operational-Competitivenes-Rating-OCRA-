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
					<li class="nav-item"><a class="nav-link" href="objek_wisata.php">Objek Wisata</a></li>
					<li class="nav-item"><a class="nav-link  active" href="kriteria.php">Kriteria</a></li>
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
        <div class="row" style="padding-top: 80px; padding-bottom: 105px;">
			<div class="col-lg-12 p-3">
				<section class="card p-3">
				<div class="col-lg-12">
					<h3 class="text-center">KRITERIA</h3>
				</div>
				
				<div class="alert alert-secondary" role="alert">
					<strong>Update Data Kriteria</strong>
				</div>
				
				<!-- awal proses update -->
				<?php 
				include '../config.php';
				
				if(isset($_POST['update'])){
					
					//mengambil data dari form
					$id_kriteria=$_POST['id_kriteria'];
					$kriteria=$_POST['kriteria'];
					$jenis=$_POST['jenis'];
					$bobot=$_POST['bobot'];	

					// proses update
					$sql = "UPDATE kriteria SET kriteria='$kriteria',jenis='$jenis',bobot='$bobot' WHERE id_kriteria='$id_kriteria'";
					if ($conn->query($sql) === TRUE) {
						header('location:kriteria.php');
					}
				}

				//menggambil id dari variabel
				$id=$_GET['id'];

				//menampilkan data kriteria
				$sql = "SELECT * FROM kriteria WHERE id_kriteria='$id'";
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
							<input type="text" name="id_kriteria" id="id_kriteria" class="form-control" maxlength="100" readonly
							value="<?php echo $row['id_kriteria']; ?>">
						</div>
						
						<div class="col-lg-2">
							<label">Nama Kriteria</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="kriteria" id="kriteria" class="form-control" maxlength="100" required
							value="<?php echo $row['kriteria']; ?>">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>Jenis</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="jenis" id="jenis" class="form-control" maxlength="50" required
							value="<?php echo $row['jenis']; ?>">
						</div>
						
						<div class="col-lg-2">
							<label>Bobot (Wj)</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="bobot" id="bobot" class="form-control" maxlength="100" required
							value="<?php echo $row['bobot']; ?>">
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-sm-4">
							<button type="submit" name="update" id="update" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update</button>
							<a class="btn btn-danger" href="kriteria.php">Batal</a>
						</div>
					</div>
				</form>
				</section>
				<?php
				$conn->close();
				?>
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