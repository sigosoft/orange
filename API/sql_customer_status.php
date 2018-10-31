<?php 

include 'DeviceConnection.php';

$data=array();


$Users="SELECT * FROM users";



$result=mysqli_query($conn,$Users);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['Users']=$data;

}

else
{
	$pass['Users']="No Data";
}

print_r(json_encode($pass));




?>