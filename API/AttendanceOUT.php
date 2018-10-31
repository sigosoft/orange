<?php

include 'DeviceConnection.php';

$TimeOUT=$_POST['TimeOUT'];
$AttendanceID=$_POST['AttendanceID'];


$sql="UPDATE userattendance SET TimeOUT='$TimeOUT' WHERE AttendanceID='$AttendanceID'";

if (mysqli_query($conn, $sql))
 {

  $pass['status']="Success";

 }
 else
 {
  
  $pass['status']="Failed";

 }

 print_r(json_encode($pass));


?>