<?php

session_start();

if(!isset($_SESSION['store']))
 {
   header('location:index.php');
 };


$current = date('Y-m-d');


require 'db/config.php';

$ImageID=$_GET['id'];




$sql="DELETE FROM gallery_image WHERE gallery_id=$ImageID";
 mysqli_query($conn,$sql);
 header("location:manage_gallery.php");

?>