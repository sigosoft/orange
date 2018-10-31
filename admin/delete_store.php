<?php


session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

include "db/config.php";

$store_id=$_GET['id'];




$sql="DELETE FROM stores WHERE store_id=$store_id";
 mysqli_query($conn,$sql);
 header("location:manage_store.php");

?>