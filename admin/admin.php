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
					<li class="nav-item "><a class="nav-link active" aria-current="page" href="admin.php"><i class="fa fa-user"></i>&nbsp;&nbsp;Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="objek_wisata.php">Objek Wisata</a></li>
					<li class="nav-item"><a class="nav-link" href="kriteria.php">Data Kriteria</a></li>
					<li class="nav-item"><a class="nav-link" href="alternatif.php">Nilai Alternatif</a></li>
					<li class="nav-item"><a class="nav-link" href="perhitungan.php">Perhitungan</a></li>
					<li class="nav-item"><a href="../logout.php" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- End Navbar -->
	
	<!-- content -->
	<div class="container">   
        <div class="row" style="padding-top: 80px; padding-bottom: 20px;">
			<div class="col-lg-3 p-3">
				<section class="card">
				<div class="row">
					<div class="col-lg-12 text-center p-2">
						<img height="140px" width="140px" src="../img/user.jpg" class="rounded-circle" alt="">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">				
						<h5 class="text-center">Halo, <strong>Administrator!</strong></h5>
						<hr>
						<p class="text-center">Selamat datang di web Sistem Pendukung Keputusan Pemilihann Objek Wisata
						di Yogyakarta menggunakan Metode OCRA!</p>
					</div>
				</div>
				</section>
			</div>
			
			<div class="col-lg-6 p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="text-end">
							<?php
								$tanggal = date('D d F Y');
								$hari = date('D', strtotime($tanggal));
								$bulan = date('F', strtotime($tanggal));
								$hariIndo = array(
								  'Mon' => 'Senin',
								  'Tue' => 'Selasa',
								  'Wed' => 'Rabu',
								  'Thu' => 'Kamis',
								  'Fri' => 'Jumat',
								  'Sat' => 'Sabtu',
								  'Sun' => 'Minggu',
								);
								$bulanIndo = array(
								  'January' => 'Januari',
								  'February' => 'Februari',
								  'March' => 'Maret',
								  'April' => 'April',
								  'May' => 'Mei',
								  'June' => 'Juni',
								  'July' => 'Juli',
								  'August' => 'Agustus',
								  'September' => 'September',
								  'October' => 'Oktober',
								  'November' => 'November',
								  'December' => 'Desember'
								);
								echo $hariIndo[$hari] . ', ' . date('d ') . $bulanIndo[$bulan] . date(' Y');
							?>
						</div><br>
					</div>
					
					<div class="col-lg-12">
						<div class="alert alert-secondary">
							<strong><i class="fa fa-user"></i>&nbsp;&nbsp;Dashboard</strong>
						</div>
						<h3> Welcome Dashboard Administrator</h3>
						<hr>
					</div>
										
					<div class="col-lg-12">
						<h4>Data Objek Wisata</h4>
						<p>Klik tombol di bawah untuk mengelolah Data Objek Wisata Alam.</p>
						<a href="objek_wisata.php"><button class="btn btn-outline-secondary">Data Objek Wisata</button></a>
						<hr>
					</div>
					
					<div class="col-lg-12">
						<h4>Data Kriteria</h4>
						<p>Klik tombol di bawah untuk mengelolah Data Kriteria SPK.</p>
						<a href="kriteria.php"><button class="btn btn-outline-secondary">Data Kriteria</button></a>
						<hr>
					</div>
					
					<div class="col-lg-12">
						<h4>Data Nilai Alternatif</h4>
						<p>Klik tombol di bawah untuk mengelolah Data Nilai Alternatif SPK.</p>
						<a href="alternatif.php"><button class="btn btn-outline-secondary">Nilai Alternatif</button></a>
						<hr>
					</div>
					
					<div class="col-lg-12">
						<h4>Perhitungan OCRA</h4>
						<p>Klik tombol di bawah untuk mengelolah Perhitungan OCRA.</p>
						<a href="perhitungan.php"><button class="btn btn-outline-secondary">Perhitungan</button></a>
						<hr>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 p-3">
				<section class="card">
				<div class="row">
					<div class="col-lg-12 text-center p-2">
						<img height="130px" width="140px" src="../img/logo.png" alt="">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">				
						<h5 class="text-center"><strong>Fajar Tour & Travel</strong></h5>
						<p class="text-center"><i><small>"Your Satisfaction, Our Commitment"</small></i></p>
						<hr>
						<p class="text-center">Desa Candipari RT 02 RW 01, Porong, Sidoarjo, Jawa Timur, Indonesia 61274</p>
					</div>
				</div>
				</section>
			</div>
		</div>
	</div>
	<!-- end content -->
	
	<!-- Footer-->
	<footer class="bg-dark text-white mb-3">
	<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
		  &#169;Copyright 2022 Fajar Tour and Travel
		</div>
	</footer>
	<!--end footer-->
</body>
</html>