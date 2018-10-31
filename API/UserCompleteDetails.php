<?php 

include 'DeviceConnection.php';

$data=array();

$UserID=$_POST['UserID'];

$Users="SELECT * FROM users WHERE UserID='$UserID'";


$result=mysqli_query($conn,$Users);

if(mysqli_num_rows($result)>0)
{

$list=mysqli_fetch_assoc($result);

$pass['Users']=$list;

}

else
{
	$pass['Users']="No Data";
}


$Sports="SELECT usercourtdetails.*, timeslots.* FROM usercourtdetails INNER JOIN timeslots ON usercourtdetails.TimeSlotID=timeslots.TimeSlotID WHERE usercourtdetails.UserID='$UserID'";
$SportResult=mysqli_query($conn,$Sports);


if(mysqli_num_rows($SportResult)>0)
{

while($row=mysqli_fetch_assoc($SportResult))
{
   // $data[]=$row;

   $CourtID=$row['CourtID'];

   $court=mysqli_query($conn,"SELECT CourtName FROM court WHERE CourtID='$CourtID'");
   $list=mysqli_fetch_assoc($court);

   if($list=="")
   {
   	$list['CourtName']="";
   }

   $data[]=array_merge($row,$list);

}

$pass['Sports']=$data;

}

else
{
	$pass['Sports']="No Data";
}





$Attendance="SELECT * FROM userattendance WHERE UserID='$UserID' ORDER BY AttendanceID DESC";



$resulted=mysqli_query($conn,$Attendance);

if(mysqli_num_rows($resulted)>0)
{

while($rower=mysqli_fetch_assoc($resulted))
{
   $Attend[]=$rower;

}




$pass['Attendance']=$Attend;

}

else
{
   $pass['Attendance']="No Data";
}




$output[]=$pass;


print_r(json_encode($output));




?>