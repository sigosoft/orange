<?php 

include 'DeviceConnection.php';

$current=date('Y-m-d');;


$SportID=$_POST['sports_id'];

$data=array();

$Attendance="SELECT userattendance.*, users.RegisterNo,users.Name,users.UserImage FROM userattendance INNER JOIN users ON userattendance.UserID=users.UserID WHERE userattendance.SportID='$SportID'  ORDER BY userattendance.AttendanceID DESC";




$result=mysqli_query($conn,$Attendance);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['Attendance']=$data;

}

else
{
	$pass['Attendance']="No Data";
}

print_r(json_encode($pass));




?>