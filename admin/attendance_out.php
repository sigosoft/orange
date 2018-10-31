<?php


session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

include "db/config.php";

date_default_timezone_set('Asia/Kolkata');

$AttendanceID=$_GET['id'];

$current = date('Y-m-d');
$current_time = date("H:i:s");



$sql="UPDATE userattendance SET TimeOut='$current_time' WHERE AttendanceID=$AttendanceID";
 mysqli_query($conn,$sql);
 header("location:attendance_view.php");

?>