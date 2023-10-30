<?php
include '../config.php';
session_start();
if($_SESSION["id"] != 1){
	header("Location: ../index.php");
}

$id=$_GET['id'];

$queryShow = "SELECT * FROM objek_wisata WHERE id_objek='$id'";
$sqlShow = mysqli_query($conn, $queryShow);
$result = mysqli_fetch_assoc($sqlShow);

unlink("../gambar/".$result['gambar']);

$sql = "DELETE FROM objek_wisata WHERE id_objek='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location:objek_wisata.php");
}
$conn->close();
?>