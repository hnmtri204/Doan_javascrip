<?php 
include_once "../dbconnect.php";
include_once "../functions.php";
$id=$_GET['id'];
deleteProduct($id);
?>