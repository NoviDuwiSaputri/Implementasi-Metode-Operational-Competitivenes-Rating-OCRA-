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
					<li class="nav-item"><a class="nav-link" href="kriteria.php">Kriteria</a></li>
					<li class="nav-item"><a class="nav-link active" href="alternatif.php">Nilai Alternatif</a></li>
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
					<h3 class="text-center">NILAI ALTERNATIF</h3>
				</div>
				
				<div class="alert alert-secondary" role="alert">
					<strong>Update Nilai Alternatif</strong>
				</div>
				
				<!-- awal proses update -->
				<?php 
				include '../config.php';
				
				if(isset($_POST['update'])){
					
					//mengambil data dari form
					$id_kuesioner=$_POST['id_kuesioner'];
					$id_objek = $_POST['id_objek'];
					$htm3 = $_POST['htm3'];
					$keindahan3 = $_POST['keindahan3'];
					$kebersihan3 = $_POST['kebersihan3'];
					$fasilitas3 = $_POST['fasilitas3'];
					$jarak3 = $_POST['jarak3'];
					$akses3 = $_POST['akses3'];
					$date_now = date("Y/m/d");
					
					// proses update
					$sql = "UPDATE kuesioner SET htm2='$htm3',keindahan2='$keindahan3',kebersihan2='$kebersihan3',fasilitas2='$fasilitas3',jarak2='$jarak3',akses2='$akses3', tgl2='$date_now' WHERE id_kuesioner='$id_kuesioner'";
					if ($conn->query($sql) === TRUE) {
						header('location:alternatif.php');
					}
				}	
				
				//menggambil id dari variabel
				$id=$_GET['id'];

				//menampilkan data alternatif
				$sql = "SELECT * FROM kuesioner WHERE id_kuesioner='$id'";
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
							<input type="text" name="id_kuesioner" id="id_kuesioner" class="form-control" readonly value="<?php echo $row['id_kuesioner']; ?>">
						</div>
						
						<div class="col-lg-2">
							<label class="text-end">ID Wisata</label>
						</div>
						<div class="col-lg-4">
							<input type="text" name="id_objek" id="id_objek" class="form-control" readonly value="<?php echo $row['id_objek']; ?>">
						</div>
						
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>C1 - Harga Tiket</label>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="htm3" id="htm3" required>
								<option align="center" selected>-- Pilih Jawaban --</option>
								<option value="1">Sangat Mahal</option>
								<option value="2">Mahal</option>
								<option value="3">Cukup</option>
								<option value="4">Murah</option>
								<option value="5">Sangat Murah</option>
							</select>
						</div>
						
						<div class="col-lg-2">
							<label>C2 - Keindahan</label>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="keindahan3" id="keindahan3" required>
								<option align="center" selected>-- Pilih Jawaban --</option>
								<option value="1">Sangat Buruk</option>
								<option value="2">Kurang</option>
								<option value="3">Cukup</option>
								<option value="4">Bagus</option>
								<option value="5">Sangat Bagus</option>
							</select>
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>C3 - Kebersihan</label>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="kebersihan3" id="kebersihan3" required>
								<option align="center" selected>-- Pilih Jawaban --</option>
								<option value="1">Sangat Buruk</option>
								<option value="2">Kurang</option>
								<option value="3">Cukup</option>
								<option value="4">Bersih</option>
								<option value="5">Sangat Bersih</option>
							</select>
						</div>
						
						<div class="col-lg-2">
							<label>C4 - Fasilitas</label>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="fasilitas3" id="fasilitas3" required>
								<option align="center" selected>-- Pilih Jawaban --</option>
								<option value="1">Sangat Kurang</option>
								<option value="2">Kurang</option>
								<option value="3">Cukup</option>
								<option value="4">Lengkap</option>
								<option value="5">Sangat Lengkap</option>
							</select>
						</div>
						
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>C5 - Jarak</label>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="jarak3" id="jarak3" required>
								<option align="center" selected>-- Pilih Jawaban --</option>
								<option value="1">Sangat Jauh</option>
								<option value="2">Jauh</option>
								<option value="3">Cukup</option>
								<option value="4">Dekat</option>
								<option value="5">Sangat Dekat</option>
							</select>
						</div>
						
						<div class="col-lg-2">
							<label>C6 - Aksesibilitas</label>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="akses3" id="akses3" required>
								<option align="center" selected>-- Pilih Jawaban --</option>
								<option value="1">Sangat Buruk</option>
								<option value="2">Buruk</option>
								<option value="3">Cukup</option>
								<option value="4">Baik</option>
								<option value="5">Sangat Baik</option>
							</select>
						</div>
					</div>
					
					<div class="row p-2">
						<div class="col-sm-4">
							<button type="submit" name="update" id="update" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update</button>
							<a class="btn btn-danger" href="alternatif.php">Batal</a>
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