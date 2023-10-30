<?php
include 'config.php';
session_start();
error_reporting(0);
if($_SESSION["id"] !=0){
	header("Location: admin/admin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SPK OCRA | Login Admin</title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.css">
	<link rel="stylesheet" href="asset/fontawesome-5.10.2/css/all.css">
	<script type="text/javascript" src="asset/js/jquery.js"></script>
	<script type="text/javascript" src="asset/js/bootstrap.js"></script>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="img/logo.png" alt="..." style="height:35px; width: 35px;"> Fajar Tour and Travel
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link " aria-current="page" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="user/index.php">Objek Wisata</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="user/rekomendasi.php">Rekomendasi</a>
					</li>
					<li class="nav-item">
						<a href="login.php">
							<button class="btn btn-secondary" type="button"><i class="fa fa-sign-in-alt"></i>&nbsp;Login</button>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
   <!-- End Navbar -->
	
   <!-- Content Login -->
	<section id="card"  style="padding-top: 60px; padding-bottom: 5px;">
		<div class="container p-md-5 p-5">
			<div class="d-flex justify-content-center">
				<div class="card w-45 mb-4">
					<div class="card-header text-center mt-8">
						<h3>Login Admin</h3>
					</div>
					<div class="card-body">
					<div class="text-center mb-3">
						<img src="img/user.jpg" class="rounded-circle" height="100px" width="100px" alt="">
					</div>
					<form method="post" action="">
						<div class="input-group mb-3">
							<span class="input-group-text" id="addon-wrapping"><i class="fa fa-user"></i></span>
							<input type="text" name="username" class="form-control" placeholder="Username" required>
							<br>
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text" id="addon-wrapping"><i class="fa fa-key"></i></span>
							<input type="password" name="password" class="form-control" placeholder="Password" required>
						</div>
						<div class="d-grid gap-2 col-6 mx-auto">
							<input type="submit" name="submit" value="Login" class="btn btn-outline-dark center-block">
						</div>
					</form>
					<?php
						if (isset($_POST['submit'])){
							session_start();
							include "config.php";

							$user = mysqli_real_escape_string($conn, $_POST['username']);
							$pass = mysqli_real_escape_string($conn, $_POST['password']);
							
							$cek = mysqli_query($conn,"SELECT * FROM login WHERE username = '".$user."' AND password = '".$pass."'");		
							if (mysqli_num_rows ($cek) > 0){
									$d = mysqli_fetch_object($cek);
									$_SESSION['status_login'] = true ;
									$_SESSION['a_global'] = $d;
									$_SESSION['id'] = "1";
									echo '<script>window.location="admin/admin.php"</script>';
							}else{
									echo '<script>alert("Username atau Password salah")</script>';
							}
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</section>
   <!-- End Login -->
   
   <!--footer-->
	<footer class="bg-dark text-white mb-3">
		<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
		  &#169;Copyright 2022 Fajar Tour and Travel
		</div>
	</footer>
	<!--end footer-->
</body>
</html>