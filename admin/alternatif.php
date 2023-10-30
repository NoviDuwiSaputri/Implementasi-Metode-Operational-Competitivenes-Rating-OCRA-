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
	
	<!-- Tambahkan Data -->
	<div class="container">   
        <div class="row" style="padding-top: 80px; padding-bottom: 20px;">
			<div class="col-lg-12 p-3">
				<section class="card p-3">
				<div class="col-lg-12">
					<h3 class="text-center">NILAI ALTERNATIF</h3>
				</div>
				
				<div class="alert alert-secondary" role="alert">
					<strong>Tambahkan Nilai Alternatif</strong>
				</div>
				
				<!-- insert file -->
				<?php
					include '../config.php';
					
					if(isset($_POST['Submit'])){
						//mengambil data dari form
						$id_objek = $_POST['id_objek'];
						$htm3 = $_POST['htm3'];
						$keindahan3 = $_POST['keindahan3'];
						$kebersihan3 = $_POST['kebersihan3'];
						$fasilitas3 = $_POST['fasilitas3'];
						$jarak3 = $_POST['jarak3'];
						$akses3 = $_POST['akses3'];
						$date_now = date("Y/m/d");
						
						$sql = mysqli_query($conn,"INSERT INTO kuesioner(id_objek, htm2, keindahan2, kebersihan2, fasilitas2, jarak2, akses2, tgl2) VALUES('$id_objek','$htm3','$keindahan3','$kebersihan3','$fasilitas3','$jarak3','$akses3','$date_now')");
						
						if($sql){	
							echo "<div class='alert alert-success'>Data Alternatif Anda berhasil disimpan.</div>"; 
						}else{
							echo "<div class='alert alert-danger'>Pengisian Gagal.</div>";
						}
					}
				?>
				<!-- end insert -->
				
				<form action="" id="form" method="post" enctype="multipart/form-data">
					<div class="row p-2">
						<div class="col-lg-2">
							<label class="text-end">Nama Wisata</label>
						</div>
						<div class="col-lg-4">
							<select name="id_objek" class="form-control" style="text-transform: uppercase;" required>
								<option align="center" value="">-- Pilih Objek Wisata --</option>
								<?php
									$selectedWisata = $row['nama_wisata'];
									$qTampilWisata   = "SELECT * FROM objek_wisata";
									$tampilWisata  = mysqli_query($conn, $qTampilWisata);
									while($rows = mysqli_fetch_assoc($tampilWisata) ){
										if($rows['nama_wisata'] == $selectedwisata){
								?>
								<option value="<?php echo $rows['id_objek']; ?>" selected="selected"><?php echo $rows['nama_wisata']; ?></option>
								<?php
										}else{
								?>
								<option value="<?php echo $rows['id_objek']; ?>"><?php echo $rows['id_objek'], ". ", $rows['nama_wisata']; ?></option>

								<?php 
										} 
									}									
								?>
							</select>
						</div>
						
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
					</div>
					
					<div class="row p-2">
						<div class="col-lg-2">
							<label>C2 - Keindahan</label>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="keindahan3" id="keindahan3" required>
								<option align="center" selected>-- Pilih Jawaban --</option>
								<option value="1">Sangat Buruk</option>
								<option value="2">Buruk</option>
								<option value="3">Cukup</option>
								<option value="4">Bagus</option>
								<option value="5">Sangat Bagus</option>
							</select>
						</div>
						
						<div class="col-lg-2">
							<label>C3 - Kebersihan</label>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="kebersihan3" id="kebersihan3" required>
								<option align="center" selected>-- Pilih Jawaban --</option>
								<option value="1">Sangat Buruk</option>
								<option value="2">Buruk</option>
								<option value="3">Cukup</option>
								<option value="4">Bersih</option>
								<option value="5">Sangat Bersih</option>
							</select>
						</div>
					</div>
					
					<div class="row p-2">
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
					</div>
					
					<div class="row p-2">
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
	<div class="container">   
        <div class="row" style="padding-bottom: 20px;">
			<div class="card col-lg-12 p-3">
			<h3 class="text-center">Data Nilai Alternatif</h3>			
			<table class="table table-striped table-hover table-bordered table-responsive" id="data-table">
				<thead>
					<tr>
 						<td><strong>No</strong></td>
						<td><strong>Wisata</strong></td>
						<td><strong>Harga Tiket</strong></td>
						<td><strong>Keindahan</strong></td>
						<td><strong>Kebersihan</strong></td>
						<td><strong>Fasilitas</strong></td>
						<td><strong>Jarak</strong></td>
						<td><strong>Aksesibilitas</strong></td>
						<td><strong>Tanggal</strong></td>
						<td><strong>Aksi</strong></td>
					</tr>
				</thead>
				<tbody>
				<!-- awal proses menampilkan -->
				<?php
				include '../config.php';
				$no = 1;
				$sql = "SELECT id_kuesioner,nama_wisata,htm2,keindahan2,kebersihan2,fasilitas2,jarak2,akses2,tgl2 FROM `kuesioner` t1 INNER JOIN objek_wisata t2 on t1.id_objek=t2.id_objek;";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()) {
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row['nama_wisata']; ?></td>
						<td><?php echo $row['htm2']; ?></td>
						<td><?php echo $row['keindahan2']; ?></td>
						<td><?php echo $row['kebersihan2']; ?></td>
						<td><?php echo $row['fasilitas2']; ?></td>
						<td><?php echo $row['jarak2']; ?></td>
						<td><?php echo $row['akses2']; ?></td>
						<td><?php echo $row['tgl2']; ?></td>
						
						<td class="text-center">
							<a class="btn btn-success btn-sm" href='update_alternatif.php?id=<?php echo $row['id_kuesioner']; ?>'><i class="fa fa-edit"></i></a>
							<a class="btn btn-danger btn-sm" href='hapus_alternatif.php?id=<?php echo $row['id_kuesioner']; ?>' onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
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
	</div>
	<!-- End Table Data -->
	
	<!-- Card Filter -->
	<div class="container">   
        <div class="row" style="padding-bottom: 20px;">
			<div class="card col-lg-12 p-3">
			<h3 class="text-center">Filter Data Nilai Alternatif</h3>
			<form action="" id="form" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-1">
						<label>ID objek :</label>
					</div>
					
					<div class="col-lg-3">
						<select name="id_objek" class="form-control" required>
							<option align="center" value="">-- Pilih ID objek --</option>
							<?php
							$selected = $row['id_objek'];
							$qTampil   = "SELECT * FROM objek_wisata";
							$tampil  = mysqli_query($conn, $qTampil);
							while($rows = mysqli_fetch_assoc($tampil) ){
								if($rows['id_objek'] == $selected){
							?>
							<option value="<?php echo $rows['id_objek']; ?>" selected="selected"><?php echo $rows['id_objek']; ?></option>
							<?php
								}else{
							?>
							<option value="<?php echo $rows['id_objek']; ?>"><?php echo $rows['id_objek'], " (", $rows['nama_wisata'], " )"; ?></option>

							<?php 
								} 
							}								
							?>
						</select>						
					</div>
					
					<div class="col-lg-3">
						<button type="submit" class="btn btn-primary" name="pilih" id="pilih">Pilih</button>					
						<button type="submit" class="btn btn-primary" name="rata" id="rata">Rata-rata</button>							
					</div>
				</div>				
			</form>
			<br>
			<?php
				require '../config.php';
				if (isset($_POST["pilih"])){
					pilih();
				}
				if (isset($_POST["rata"])){
					rata();
				}
			?>
			
			<?php
				require '../config.php';
				function pilih(){
					global $conn;
					
					if(isset($_POST['pilih'])){
						$id_objek = $_POST['id_objek'];
						?>
						<table class="table table-striped table-hover table-bordered table-responsive" >
						<thead>
							<tr>
								<td><strong>No</strong></td>
								<td><strong>ID</strong></td>
								<td><strong>Wisata</strong></td>
								<td><strong>Harga Tiket</strong></td>
								<td><strong>Keindahan</strong></td>
								<td><strong>Kebersihan</strong></td>
								<td><strong>Fasilitas</strong></td>
								<td><strong>Jarak</strong></td>
								<td><strong>Aksesibilitas</strong></td>
								<td><strong>Tanggal</strong></td>
							</tr>
						</thead>								
						<tbody>
						<?php
						$no = 1;
						$data = mysqli_query($conn, "SELECT t1.id_kuesioner, t1.id_objek, nama_wisata, htm2, keindahan2, kebersihan2, fasilitas2, jarak2, akses2, tgl2 FROM `kuesioner` t1 INNER JOIN objek_wisata t2 on t1.id_objek=t2.id_objek WHERE t1.id_objek=$id_objek");
						while ($row = $data->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $row['id_objek']; ?></td>
								<td><?php echo $row['nama_wisata']; ?></td>
								<td><?php echo $row['htm2']; ?></td>
								<td><?php echo $row['keindahan2']; ?></td>
								<td><?php echo $row['kebersihan2']; ?></td>
								<td><?php echo $row['fasilitas2']; ?></td>
								<td><?php echo $row['jarak2']; ?></td>
								<td><?php echo $row['akses2']; ?></td>
								<td><?php echo $row['tgl2']; ?></td>
							</tr>
						<?php
						}
						?>
						</tbody>
						</table>						
						<?php
					}
				}
			?>
			
			<?php
				require '../config.php';
				function rata(){
					global $conn;
					
					if(isset($_POST['rata'])){
						$id_objek = $_POST['id_objek'];
						?>
						<form action="" id="form" method="post" enctype="multipart/form-data">
						<table class="table table-striped table-hover table-bordered table-responsive" >
						<thead>
							<tr>
								<td rowspan="2" style="vertical-align: middle"><strong>ID Wisata</strong></td>
								<td rowspan="2" style="vertical-align: middle"><strong>Wisata</strong></td>
								<td colspan="7" align="center"><strong>RATA-RATA</strong></td>
							</tr>
							<tr>								
								<td><strong>Harga Tiket</strong></td>
								<td><strong>Keindahan</strong></td>
								<td><strong>Kebersihan</strong></td>
								<td><strong>Fasilitas</strong></td>
								<td><strong>Jarak</strong></td>
								<td><strong>Aksesibilitas</strong></td>
							</tr>
						</thead>								
						<tbody>
						<?php
						$rata = mysqli_query($conn, "SELECT t1.id_kuesioner, t1.id_objek, nama_wisata, AVG(htm2) AS htm3, AVG(keindahan2) AS keindahan3, AVG(kebersihan2) AS kebersihan3, AVG(fasilitas2) AS fasilitas3, AVG(jarak2) AS jarak3, AVG(akses2) AS akses3 FROM `kuesioner` t1 INNER JOIN objek_wisata t2 on t1.id_objek=t2.id_objek WHERE t1.id_objek=$id_objek;");
						while ($row = $rata->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $row['id_objek']; ?></td>
								<td><?php echo $row['nama_wisata']; ?></td>
								<td><?php echo $row['htm3']; ?></td>
								<td><?php echo $row['keindahan3']; ?></td>
								<td><?php echo $row['kebersihan3']; ?></td>
								<td><?php echo $row['fasilitas3']; ?></td>
								<td><?php echo $row['jarak3']; ?></td>
								<td><?php echo $row['akses3']; ?></td>								
							</tr>
						<?php
							$id_objek1 = $row['id_objek'];
							$nama_wisata = $row['nama_wisata'];
							$htm3 = $row['htm3'];
							$keindahan3 = $row['keindahan3'];
							$kebersihan3 = $row['kebersihan3'];
							$fasilitas3 = $row['fasilitas3'];
							$jarak3 = $row['jarak3'];
							$akses3 = $row['akses3'];
							$tgl3 = date("Y/m/d");
							
							//var_dump($id_kuesioner,$id_objek1,$htm3,$keindahan3,$kebersihan3,$fasilitas3,$jarak3,$akses3,$tgl3);
							//die();
							
							//$matrik = mysqli_query($conn,"INSERT INTO matrik(id_kuesioner, id_objek, htm3, keindahan3, kebersihan3, fasilitas3, jarak3, akses3, tgl3) VALUES('$id_kuesioner', '$id_objek1','$htm3','$keindahan3','$kebersihan3','$fasilitas3','$jarak3','$akses3', '$tgl3')");
							
							$matrik = mysqli_query($conn,"UPDATE matrik SET id_objek='$id_objek1', htm3='$htm3', keindahan3='$keindahan3', kebersihan3='$kebersihan3', fasilitas3='$fasilitas3', jarak3='$jarak3', akses3='$akses3', tgl3='$tgl3' WHERE id_objek='$id_objek1'");
							
							if($matrik){	
								echo "<div class='alert alert-success'>Rata-rata $nama_wisata berhasil disimpan.</div>"; 
							}else{
								echo "<div class='alert alert-danger'>Pengisian Gagal.</div>";
							}							
						}
						?>
						</tbody>
						</table>
						</form>						
						<?php	
					}
				}
			?>
			</div>
		</div>
	</div>
	<!-- End Card Filter -->
	
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