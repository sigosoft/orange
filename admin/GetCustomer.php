<?php

header('Content-Type: application/json');

include "db/config.php";

$list=array();

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$Phone=$input['Phone'];


$sql="SELECT * FROM users WHERE Phone='$Phone'";
$result=mysqli_query($conn,$sql);




$list = mysqli_fetch_array($result);
$pass['customer']=$list;







$tempData = $pass;

$cleanData =  json_encode($tempData);
print_r($cleanData);



?>