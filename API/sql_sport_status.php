<?php 

include 'DeviceConnection.php';

$data=array();


$Users="SELECT * FROM usercourtdetails";



$result=mysqli_query($conn,$Users);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['Users_sport']=$data;

}

else
{
	$pass['Users_sport']="No Data";
}

print_r(json_encode($pass));




?>