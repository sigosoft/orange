<?php 

include 'DeviceConnection.php';

$data=array();

$TimeSlots="SELECT * FROM timeslots";


$result=mysqli_query($conn,$TimeSlots);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['TimeSlots']=$data;

}

else
{
	$pass['TimeSlots']="No Data";
}

print_r(json_encode($pass));




?>