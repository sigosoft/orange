<?php 

include 'DeviceConnection.php';

$data=array();

$court="SELECT * FROM court";


$result=mysqli_query($conn,$court);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['court']=$data;

}

else
{
	$pass['court']="No Data";
}

print_r(json_encode($pass));




?>