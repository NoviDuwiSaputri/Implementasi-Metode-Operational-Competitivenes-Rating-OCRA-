<?php 
include '../config.php';
session_start();
error_reporting(0);
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
					<li class="nav-item "><a class="nav-link" aria-current="page" href="admin.php">Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="objek_wisata.php">Objek Wisata</a></li>
					<li class="nav-item"><a class="nav-link" href="kriteria.php">Kriteria</a></li>
					<li class="nav-item"><a class="nav-link" href="alternatif.php">Nilai Alternatif</a></li>
					<li class="nav-item"><a class="nav-link active" href="perhitungan.php">Perhitungan</a></li>
					<li class="nav-item"><a href="../logout.php" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- End Navbar -->
	
	<!-- Table Data -->
	<div class="container">   
        <div class="row" style="padding-top: 80px; padding-bottom: 20px;">
			<div class="col-lg-12 p-3">
			<section class="card p-3">
				<h3 class="text-center">MATRIK KEPUTUSAN</h3><hr>
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
						</tr>
					</thead>
					<tbody>
					<!-- awal proses menampilkan -->
					<?php
					include '../config.php';
					$no = 1;
					$sql = "SELECT t2.nama_wisata, htm3, keindahan3, kebersihan3, fasilitas3, jarak3, akses3, tgl3 FROM matrik t1 INNER JOIN objek_wisata t2 on t1.id_objek=t2.id_objek;";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) {
					?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row['nama_wisata']; ?></td>
							<td><?php echo $row['htm3']; ?></td>
							<td><?php echo $row['keindahan3']; ?></td>
							<td><?php echo $row['kebersihan3']; ?></td>
							<td><?php echo $row['fasilitas3']; ?></td>
							<td><?php echo $row['jarak3']; ?></td>
							<td><?php echo $row['akses3']; ?></td>
							<td><?php echo $row['tgl3']; ?></td>
						</tr>
					<?php
						}
					?>
					<!-- akhir proses menampilkan -->
					</tbody>
				</table>
				
				<div class="col-lg-6">
					<form id="form" method="post">
						<button type="submit" name="hitung" id="hitung" class="btn btn-primary">Hitung Preferensi</button>
						<button type="submit" name="ranking" id="ranking" class="btn btn-primary">Ranking</button>
					</form>
				</div>
				<hr>
				<form action="" id="form" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-2">							
							<label class="text-end">Periode Ranking :</label>
						</div>
						
						<div class="col-lg-2">
							<select class="form-control" name="bulan" id="bulan" required>
								<option align="center" value="">Bulan</option>
								<?php
								$bulanIndo=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
								for($c=1; $c<=12; $c++){
									echo"<option value=$c> $bulanIndo[$c] </option>";
								}
								?>
							</select>
						</div>
						
						<div class="col-lg-1">
							<select class="form-control" name="tahun" id="tahun" required>
								<option align="center" value="">Tahun</option>
								<?php
								//$tanggal = date('D d F Y');
								//$tahun = date('Y', strtotime($tanggal));
								
								$tahun = 2022;
								for($i=$tahun; $i<=$tahun+10; $i++){
									echo "<option value=$i> $i </option>";
								}
								?>
							</select>						
						</div>
						
						<div class="col-lg-1">
							<button type="submit" class="btn btn-primary" name="filter" id="filter">Filter</button>
						</div>
					</div>
				</form><br>
					<?php
						require '../config.php';
						if (isset($_POST["filter"])){
							filter();
						}
					?>
					
					<!-- filter -->
					<?php
						require '../config.php';
						function filter(){
							global $conn;
							
							if(isset($_POST['filter'])){
								$Bulan = $_POST['bulan'];
								$Tahun = $_POST['tahun'];
								//var_dump($Bulan,$Tahun);
								//die();
								?>
								<h3 class="text-center">Hasil Ranking <?php echo "Bulan ".$Bulan." Tahun ".$Tahun; ?></h3><br>
								<form action="" id="form" method="post" enctype="multipart/form-data">
								<table class="table table-striped table-hover table-bordered table-responsive" >
								<thead>
									<tr>
										<td><strong>ID Wisata</strong></td>
										<td><strong>Wisata</strong></td>
										<td><strong>Total Pi</strong></td>
										<td><strong>Ranking</strong></td>
										<td><strong>Ket</strong></td>
										<td><strong>Tanggal</strong></td>
									</tr>
								</thead>								
								<tbody>
								<?php
								$user = mysqli_query($conn,"SELECT * FROM (SELECT t1.id_rank, t2.id_objek, t2.nama_wisata, Pi, ranking, t1.ket, tgl4 FROM ranking t1 INNER JOIN objek_wisata t2 on t1.id_objek=t2.id_objek WHERE month(tgl4)='$Bulan' AND year(tgl4)='$Tahun' AND ranking BETWEEN 1 and 15 ORDER BY id_rank DESC LIMIT 15) AS a ORDER BY id_rank ASC");
								
								if (mysqli_num_rows($user) > 0){
									while ($row = $user->fetch_assoc()){
									?>
									<tr>
										<td><?php echo $row['id_objek']; ?></td>
										<td><?php echo $row['nama_wisata']; ?></td>
										<td><?php echo $row['Pi']; ?></td>
										<td><?php echo $row['ranking']; ?></td>
										<td><?php echo $row['ket']; ?></td>
										<td><?php echo $row['tgl4']; ?></td>
									</tr>
									<?php
									}
								}else{
									echo'<tr><td colspan="6" class="text-center">DATA KOSONG</td></tr>';
								}
								?>
								</tbody>
								</table>
								</form>
								<?php
							}
						}
					?>
					<!-- end filter -->
			</section>		
			
			<?php
			require '../config.php';
			if (isset($_POST["hitung"])){
				hitung();
			}			
			if (isset($_POST["ranking"])){
				ranking();
			}
			?>
			</div>
		</div>
	</div>
	<!-- End Table Data -->
	
	<!-- Hitung -->
	<?php
	require '../config.php';
	function hitung(){
		global $conn;
		
		//max
		$max=mysqli_query($conn,"SELECT MAX(htm3) AS max1, MAX(keindahan3) AS max2, MAX(kebersihan3) AS max3, MAX(fasilitas3) AS max4, MAX(jarak3) AS max5, MAX(akses3) AS max6 FROM matrik");			
		$a=mysqli_fetch_assoc($max);			
				
		//min
		$min=mysqli_query($conn,"SELECT MIN(htm3) AS min1,  MIN(keindahan3) AS min2, MIN(kebersihan3) AS min3, MIN(fasilitas3) AS min4, MIN(jarak3) AS min5, MIN(akses3) AS min6 FROM matrik");
		$b=mysqli_fetch_assoc($min);
		
		//mengambil nilai bobot dari tabel kriteria
		$bobot=mysqli_query($conn,"SELECT bobot FROM kriteria");
		$arrayBobot = [];
		foreach ($bobot as $bobot) {
			array_push($arrayBobot, $bobot);
		}
		for ($i = 0; $i < count($arrayBobot); $i++){
			$bbt1 = $arrayBobot[0]["bobot"];
			$bbt2 = $arrayBobot[1]["bobot"];
			$bbt3 = $arrayBobot[2]["bobot"];
			$bbt4 = $arrayBobot[3]["bobot"];
			$bbt5 = $arrayBobot[4]["bobot"];
			$bbt6 = $arrayBobot[5]["bobot"];			
		}	
		
		//mengambil nilai matrik keputusan
		$data = mysqli_query($conn,"SELECT t1.id_matrik, t2.id_objek, t2.nama_wisata, htm3, keindahan3, kebersihan3, fasilitas3, jarak3, akses3, tgl3 FROM matrik t1 INNER JOIN objek_wisata t2 on t1.id_objek=t2.id_objek;");
		$array = [];
		foreach ($data as $data) {
			array_push($array, $data);
		}		
		for ($i = 0; $i < count($array); $i++) {			
			$id_objek = $array[$i]["id_objek"];
			$nama_wisata = $array[$i]["nama_wisata"];
			$htm = $array[$i]["htm3"];
			$keindahan = $array[$i]["keindahan3"];
			$kebersihan = $array[$i]["kebersihan3"];
			$fasilitas = $array[$i]["fasilitas3"];
			$jarak = $array[$i]["jarak3"];
			$akses = $array[$i]["akses3"];
			
			$nor_htm = round((($a['max1']-$htm)/$b['min1'])*$bbt1,3);
			$nor_keindahan = round((($keindahan-$b['min2'])/$b['min2'])*$bbt2,3);
			$nor_kebersihan = round((($kebersihan-$b['min3'])/$b['min3'])*$bbt3,3);
			$nor_fasilitas = round((($fasilitas-$b['min4'])/$b['min4'])*$bbt4,3);
			$nor_jarak = round((($jarak-$b['min5'])/$b['min5'])*$bbt5,3);
			$nor_akses = round((($akses-$b['min6'])/$b['min6'])*$bbt6,3);
			
			$cost = $nor_htm;
			$benefit = $nor_keindahan + $nor_kebersihan + $nor_fasilitas + $nor_jarak + $nor_akses;			
			
			mysqli_query($conn,"UPDATE preferensi SET htm4=$nor_htm, keindahan4=$nor_keindahan, kebersihan4=$nor_kebersihan, fasilitas4=$nor_fasilitas, jarak4=$nor_jarak, akses4=$nor_akses, cost=$cost, benefit=$benefit WHERE id_objek='$id_objek'");
		}
		
		//mengambil nilai minimal Cost dan Benefit
		$minCostBen=mysqli_query($conn,"SELECT MIN(cost) AS min7,  MIN(benefit) AS min8 FROM preferensi");
		$c=mysqli_fetch_assoc($minCostBen);		
		
		//mengambil nilai Cost dan Benefit
		$cost_ben = mysqli_query($conn, "SELECT*FROM preferensi");
		$array_costben = [];
		foreach ($cost_ben as $cost_ben) {
			array_push($array_costben, $cost_ben);
		}
		for ($i = 0; $i < count($array_costben); $i++) {
			$id_objek1 = $array_costben[$i]["id_objek"];
			$Cost = $array_costben[$i]["cost"];
			$Benefit = $array_costben[$i]["benefit"];
							
			$cost_lin = round(($Cost-$c['min7']),3);
			$benefit_lin = round(($Benefit-$c['min8']),3);
			
			mysqli_query($conn,"UPDATE preferensi SET cost_lin=$cost_lin, benefit_lin=$benefit_lin WHERE id_objek='$id_objek1'");
		}
		
		//min Cost Lin dan Benefit Lin
		$min_LinCostBen=mysqli_query($conn,"SELECT MIN(cost_lin) AS min9,  MIN(benefit_lin) AS min10 FROM preferensi");
		$d=mysqli_fetch_assoc($min_LinCostBen);
		
		//mengambil nilai Linear Cost dan Benefit
		$lincostben = mysqli_query($conn,"SELECT * FROM preferensi");
		$array_lincostben = [];
		foreach ($lincostben as $lincostben) {
			array_push($array_lincostben, $lincostben);
		}
		for ($i = 0; $i < count($array_lincostben); $i++) {
			$id_objek2 = $array_lincostben[$i]["id_objek"];
			$Cost_Linear = $array_lincostben[$i]["cost_lin"];
			$Ben_Linear = $array_lincostben[$i]["benefit_lin"];
							
			$total = round(($Cost_Linear + $Ben_Linear)-($d['min9']-$d['min10']),3);
								
			mysqli_query($conn,"UPDATE preferensi SET pi=$total WHERE id_objek='$id_objek2'");
		}				
		?>
		<div class="container">   
        <div class="row" style="padding-top:20px;">
			<div class="col-lg-12 p-3">
			<section class="card p-3">
			<h3 class="text-center">Peringkat Preferensi</h3><hr>
			<table class="table table-striped table-hover table-bordered table-responsive" id="data-table">
				<thead>
					<tr>
						<td rowspan="2" style="vertical-align: middle"><strong>No</strong></td>
						<td rowspan="2" style="vertical-align: middle"><strong>Wisata</strong></td>
						<td><strong>Cost</strong></td>
						<td colspan="5" class="text-center"><strong>Benefit</strong></td>
						<td rowspan="2" style="vertical-align: middle"><strong>𝛴 Cost</strong></td>
						<td rowspan="2" style="vertical-align: middle"><strong>𝛴 Benefit</strong></td>
						<td rowspan="2" style="vertical-align: middle"><strong>Lin Cost</strong></td>
						<td rowspan="2" style="vertical-align: middle"><strong>Lin Benefit</strong></td>
						<td rowspan="2" style="vertical-align: middle"><strong>Pi</strong></td>
					</tr>
					<tr>
						<td><strong>Harga Tiket</strong></td>
						<td><strong>Keindahan</strong></td>
						<td><strong>Kebersihan</strong></td>
						<td><strong>Fasilitas</strong></td>
						<td><strong>Jarak</strong></td>
						<td><strong>Akses</strong></td>						
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$sql = "SELECT t2.nama_wisata, htm4, keindahan4, kebersihan4, fasilitas4, jarak4, akses4, cost, benefit, cost_lin, benefit_lin, pi FROM preferensi t1 INNER JOIN objek_wisata t2 ON t1.id_objek=t2.id_objek";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row['nama_wisata']; ?></td>
						<td><?php echo $row['htm4']; ?></td>
						<td><?php echo $row['keindahan4']; ?></td>
						<td><?php echo $row['kebersihan4']; ?></td>
						<td><?php echo $row['fasilitas4']; ?></td>
						<td><?php echo $row['jarak4']; ?></td>
						<td><?php echo $row['akses4']; ?></td>
						<td><?php echo $row['cost']; ?></td>
						<td><?php echo $row['benefit']; ?></td>
						<td><?php echo $row['cost_lin']; ?></td>
						<td><?php echo $row['benefit_lin']; ?></td>
						<td><?php echo $row['pi']; ?></td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			</section>
			</div>
		</div>
		</div>
	<?php
	}
	?>	
	<?php
	require '../config.php';
	function ranking(){
		global $conn;?>
	<div class="container">   
        <div class="row" style="padding-top:20px; padding-bottom: 20px;">
			<div class="col-lg-12 p-3">
			<section class="card p-3">
				<h3 class="text-center">Hasil Ranking</h3><hr>
				<form action="" id="form" method="post" enctype="multipart/form-data">
				<div class="row">				
				<form action="" id="form" method="post" enctype="multipart/form-data">
				<table class="table table-striped table-hover table-bordered table-responsive text-center" id="data-table">
					<thead>
						<tr>
							<td><strong>No</strong></td>
							<td><strong>ID Wisata</strong></td>
							<td><strong>Wisata</strong></td>
							<td><strong>Total Pi</strong></td>
							<td><strong>Ranking</strong></td>
							<td><strong>Ket</strong></td>
							<td><strong>Tanggal</strong></td>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$sql = mysqli_query($conn,"SET @ranking=0;");
						$sql = mysqli_query($conn,"SELECT t2.id_objek,t2.nama_wisata,pi, @ranking:=@ranking+1 AS ranking FROM preferensi t1 INNER JOIN objek_wisata t2 ON t1.id_objek=t2.id_objek ORDER BY pi DESC");
						$rekom="Sangat Direkomendasikan";
						while($row = mysqli_fetch_array($sql)) {
							if ($no>=11){
								$rekom="Direkomendasikan  ";
							}else{
								$rekom="Sangat Direkomendasikan";
							}
							$date_now =date("Y/m/d");							
						?>
						<tr>							
							<td><?php echo $no++; ?></td>
							<td><?php echo $row['id_objek']; ?></td>
							<td><?php echo $row['nama_wisata']; ?></td>
							<td><?php echo $row['pi']; ?></td>
							<td><?php echo $row['ranking']; ?></td>
							<td><?php echo $rekom; ?></td>
							<td><?php echo $date_now; ?></td>
						</tr>
						<?php
							$id_objek3 = $row['id_objek'];
							$total = $row['pi'];
							$ranking = $row['ranking'];
							$ket = $rekom;
							$tgl4 = $date_now;							
							
							mysqli_query($conn,"INSERT INTO ranking(id_objek, Pi, ranking, ket, tgl4) VALUES('$id_objek3','$total', '$ranking', '$ket', '$tgl4')");
						}
						?>
					</tbody>
				</table>
				</form>
			</section>
			</div>
		</div>
	</div>	
	<?php
	}
	?>
	<!-- End Hitung -->
	
	<!-- Footer-->
	<footer class="bg-dark text-white mb-3">
	<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
		  &#169;Copyright 2022 Fajar Tour and Travel
		</div>
	</footer>
	<!--end footer-->
</body>
</html>