<?php 

include 'DeviceConnection.php';

$GroupID=$_POST['GroupID'];
$UserID=$_POST['UserID'];


$Validate=mysqli_query($conn,"SELECT * FROM usergroups WHERE UserID='$UserID'");


if(mysqli_num_rows($Validate)<=0)	
{

$query="INSERT INTO usergroups(UserID, GroupID) VALUES ('$UserID', '$GroupID')";

if (mysqli_query($conn, $query))
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
	$pass['status']="User Already Registered In a Group";
}

print_r(json_encode($pass));

?>