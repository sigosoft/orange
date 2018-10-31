<?php

include 'DeviceConnection.php';

$TimeIn=$_POST['TimeIn'];
$TimeOut=$_POST['TimeOut'];

$DateIN=$_POST['DateIN'];
$UserID=$_POST['UserID'];
$TimeSlotID=$_POST['TimeSlotID'];
$SportID=$_POST['SportID'];
$SportName=$_POST['SportName'];
$CourtID=$_POST['CourtID'];



if(empty($TimeOut))
{

$sql="INSERT INTO userattendance(TimeIn, DateIN, UserID, TimeSlotID, SportID, SportName, CourtID, Status) VALUES ('$TimeIn', '$DateIN', '$UserID', '$TimeSlotID', '$SportID', '$SportName', '$CourtID','Pending')";

}
else
{

$sql="INSERT INTO userattendance(TimeIn, TimeOut, DateIN, UserID, TimeSlotID, SportID, SportName, CourtID, Status) VALUES ('$TimeIn', '$TimeOut', '$DateIN', '$UserID', '$TimeSlotID', '$SportID', '$SportName', '$CourtID','Pending')";

}

if (mysqli_query($conn, $sql))
 {
 
   $AttendanceID=mysqli_insert_id($conn);
   
   

  $pass['status']="Success";
  $pass['AttendanceID']=$AttendanceID;

 }
 else
 {
  
  $pass['status']="Failed";
  $pass['AttendanceID']=0;

 }

 print_r(json_encode($pass));

?>