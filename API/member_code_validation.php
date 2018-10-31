<?php

include 'DeviceConnection.php';

$current=date('Y-m-d');

$RegisterNo=$_POST['RegisterNo'];
$SportID=$_POST['SportID'];

$validate=mysqli_query($conn,"SELECT UserID,RegisterNo,Name,UserImage,PaymentExpiryDate FROM users WHERE RegisterNo='$RegisterNo'");
if(mysqli_num_rows($validate)>0)
{

$getuser=mysqli_fetch_assoc($validate);
$UserID=$getuser['UserID'];

$sporttype=mysqli_query($conn,"SELECT * FROM usercourtdetails WHERE UserID='$UserID' AND SportID='$SportID'");
if(mysqli_num_rows($sporttype)>0)
{



$getsport=mysqli_fetch_assoc($sporttype);

$Check="SELECT * FROM userattendance WHERE DateIN='$current' AND UserID='$UserID' AND TimeOUT IS NULL";

$LiveCheck=mysqli_query($conn,$Check);
if(mysqli_num_rows($LiveCheck)>0)
{


$toggle="OUT";

}
else
{

$toggle="IN";

}

$pass['status']="Success";
$pass['user']=$getuser;
$pass['sport']=$getsport;
$pass['toggle']=$toggle;

}
else
{

$pass['status']="No Sports";
$pass['user']="No Data";
$pass['sport']="No Data";
$pass['toggle']="Invalid";

}


}
else
{


$pass['status']="Failed";
$pass['user']="No Data";
$pass['sport']="No Data";
$pass['toggle']="Invalid";


}


print_r(json_encode($pass));


?>