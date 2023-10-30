<?php
include '../config.php';
session_start();
if($_SESSION["id"] != 1){
	header("Location: ../index.php");
}

$id=$_GET['id'];

$sql = "DELETE FROM kuesioner WHERE id_kuesioner='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location:alternatif.php");
}
$conn->close();
?>