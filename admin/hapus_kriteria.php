<?php
include '../config.php';
session_start();
if($_SESSION["id"] != 1){
	header("Location: ../index.php");
}

$id=$_GET['id'];

$sql = "DELETE FROM kriteria WHERE id_kriteria='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location:kriteria.php");
}
$conn->close();
?>