<?php 

include 'DeviceConnection.php';

$data=array();

$SportID=$_POST['sports_id'];

$Users="SELECT users.UserID, users.RegisterNo, users.Name, users.Phone, usercourtdetails.* FROM users INNER JOIN usercourtdetails ON users.UserID=usercourtdetails.UserID WHERE usercourtdetails.SportID='$SportID'";



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