<?php 

include 'DeviceConnection.php';






if(isset($_POST['UserID'],$_POST['GroupID']))
{

$GroupID=$_POST['GroupID'];
$UserID=$_POST['UserID'];

$Delete="DELETE FROM usergroups WHERE GroupID='$GroupID' AND UserID='$UserID'";

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