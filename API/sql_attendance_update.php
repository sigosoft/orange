<?php

include 'DeviceConnection.php';

$TimeIn=$_POST['TimeIn'];
$TimeOut=$_POST['TimeOut'];
$AttendanceID=$_POST['AttendanceID'];

$DateIN=$_POST['DateIN'];
$UserID=$_POST['UserID'];
$TimeSlotID=$_POST['TimeSlotID'];
$SportID=$_POST['SportID'];
$SportName=$_POST['SportName'];
$CourtID=$_POST['CourtID'];





$sql="UPDATE userattendance SET TimeIn='$TimeIn', TimeOut='$TimeOut', DateIN='$DateIN',UserID='$UserID', TimeSlotID='$TimeSlotID', SportID='$SportID', SportName='$SportName', CourtID='$CourtID' WHERE AttendanceID='$AttendanceID'";



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