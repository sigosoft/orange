<?php 

include 'DeviceConnection.php';

$data=array();

$Groups="SELECT * FROM groups";


$result=mysqli_query($conn,$Groups);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['Groups']=$data;

}

else
{
	$pass['Groups']="No Data";
}

print_r(json_encode($pass));




?>