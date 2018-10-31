<?php 

include 'DeviceConnection.php';






if(isset($_POST['GroupID']))
{

$GroupID=$_POST['GroupID'];

$Delete="DELETE FROM groups WHERE GroupID='$GroupID'";

if (mysqli_query($conn, $Delete))
 {
    $pass['status']="Success";
 }
 else
 {
 	$pass['status']="Failed";
 }
}

else
{
	$pass['status']="Failed";
}


 print_r(json_encode($pass));

?>