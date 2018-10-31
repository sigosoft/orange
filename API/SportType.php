<?php 

include 'DeviceConnection.php';

$data=array();

$SportType="SELECT * FROM sporttype";


$result=mysqli_query($conn,$SportType);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['SportType']=$data;

}

else
{
	$pass['SportType']="No Data";
}

print_r(json_encode($pass));




?>