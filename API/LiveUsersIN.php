<?php 

include 'DeviceConnection.php';

$current=date('Y-m-d');;



$data=array();

$Users="SELECT users.UserID, users.RegisterNo, users.Name, users.Phone,users.UserImage, userattendance.* FROM users INNER JOIN userattendance ON users.UserID=userattendance.UserID WHERE userattendance.DateIN='$current' AND userattendance.TimeOUT IS NULL";



$result=mysqli_query($conn,$Users);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['LiveUsers']=$data;

}

else
{
	$pass['LiveUsers']="No Data";
}

print_r(json_encode($pass));




?>