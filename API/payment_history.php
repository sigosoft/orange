<?php 

include 'DeviceConnection.php';

$data=array();

$payment_history="SELECT * FROM payment_history WHERE CustomerType='Member'";


$result=mysqli_query($conn,$payment_history);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   $data[]=$list;

}




$pass['payment_history']=$data;

}

else
{
	$pass['payment_history']="No Data";
}

print_r(json_encode($pass));




?>