<?php


session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

include "db/config.php";

$AttendanceID=$_GET['id'];




$sql="UPDATE userattendance SET Status='Approved' WHERE AttendanceID=$AttendanceID";
 mysqli_query($conn,$sql);
 header("location:attendance_view.php");

?>