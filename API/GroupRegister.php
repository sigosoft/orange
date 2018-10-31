<?php 

include 'DeviceConnection.php';

$GroupName=$_POST['GroupName'];



$Reg=mysqli_query($conn,"SELECT * FROM grouplastreg WHERE GroupLastID='1'");

$RegRow=mysqli_fetch_assoc($Reg);
$LastReg=$RegRow['GroupRegID'];

$GroupNo='G'.($LastReg+1);



$Validate=mysqli_query($conn,"SELECT * FROM groups WHERE GroupName='$GroupName'");



if(mysqli_num_rows($Validate)<=0)	
{


$query="INSERT INTO groups (GroupNo, GroupName) VALUES ('$GroupNo', '$GroupName')";
if (mysqli_query($conn, $query))
 {


  $updateCount=mysqli_query($conn,"UPDATE grouplastreg SET GroupRegID=GroupRegID+1 WHERE GroupLastID='1'");
  $pass['status']="Success";

 }
 else
 {

  $pass['status']="Failed";

 }

}

else
{

	$pass['status']="Taken";

}

print_r(json_encode($pass));

?>