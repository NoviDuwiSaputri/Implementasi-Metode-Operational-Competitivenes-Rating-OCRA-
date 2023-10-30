<?php 
 
session_start();
session_destroy();
$_SESSION["id"] = "0";
 
header("Location: index.php");
 
?>