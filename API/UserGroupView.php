<?php 

include 'DeviceConnection.php';

$GroupID=$_POST['GroupID'];


$View=mysqli_query($conn,"SELECT usergroups.*,users.RegisterNo, users.Name, users.UserImage FROM usergroups INNER JOIN users ON usergroups.UserID=users.UserID WHERE usergroups.GroupID='$GroupID'");

if(mysqli_num_rows($View)>0)
{

while($list=mysqli_fetch_assoc($View))
{
   $data[]=$list;

}




$pass['GroupDetails']=$data;

}

else
{
	$pass['GroupDetails']="No Data";
}

print_r(json_encode($pass));

 ?>