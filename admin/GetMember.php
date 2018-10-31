<?php

header('Content-Type: application/json');

include "db/config.php";

$list=array();

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$RegisterNo=$input['RegisterNo'];


$sql="SELECT * FROM users WHERE RegisterNo='$RegisterNo'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)<=0)
{

$pass['status']="Fail";
$pass['details']=$list;

}
else
{

$pass['status']="Success";
$list = mysqli_fetch_array($result);
$pass['details']=$list;

}





$tempData = $pass;

$cleanData =  json_encode($tempData);
print_r($cleanData);



?>