<?php

include 'DeviceConnection.php';

$TimeIn=$_POST['TimeIn'];
$DateIN=$_POST['DateIN'];
$UserID=$_POST['UserID'];
$TimeSlotID=$_POST['TimeSlotID'];
$SportID=$_POST['SportID'];
$SportName=$_POST['SportName'];
$CourtID=$_POST['CourtID'];



$sql="INSERT INTO userattendance(TimeIn, DateIN, UserID, TimeSlotID, SportID, SportName, CourtID, Status) VALUES ('$TimeIn', '$DateIN', '$UserID', '$TimeSlotID', '$SportID', '$SportName', '$CourtID','Pending')";

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