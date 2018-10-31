<?php 

include 'DeviceConnection.php';

$data=array();

$user=$_POST['username'];
$pass=$_POST['password'];
$pass = md5($pass);

$query="SELECT * FROM estadio_users WHERE username='$user' && password='$pass'";


$result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0)
{
    $ret = ['msg'=>'success'];
}
else
{
	$ret = ['msg' => 'failed'];
}

print_r(json_encode($ret));
?>