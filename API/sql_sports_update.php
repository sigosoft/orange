<?php

include 'DeviceConnection.php';

$UserCourtID=$_POST['UserCourtID'];




$sql="UPDATE usercourtdetails SET SQLSports=0 WHERE UserCourtID='$UserCourtID'";

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