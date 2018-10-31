<?php

include 'DeviceConnection.php';

$UserID=$_POST['UserID'];




$sql="UPDATE users SET SQLStatus=0 WHERE UserID='$UserID'";

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