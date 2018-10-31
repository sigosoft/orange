<?php

header('Content-Type: application/json');

include "db/config.php";
date_default_timezone_set('Asia/Kolkata');

$current=date('Y-m-d');

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 





$TimeSlotID=$input['TimeSlotID'];
$Courtdiv=$input['court_div'];



$Court="SELECT * FROM court WHERE Status='Active'";




$result=mysqli_query($conn,$Court);

if(mysqli_num_rows($result)>0)
{

while($list=mysqli_fetch_assoc($result))
{
   

   $courtID=$list['CourtID'];
   $courtName=$list['CourtName'];

   $CourtCount=mysqli_query($conn,"SELECT (SELECT 8-COUNT(*) FROM usercourtdetails WHERE CourtID='$courtID' AND TimeSlotID='$TimeSlotID') AS CourtCount");
   $CourtCounter=mysqli_fetch_assoc($CourtCount);

   $Occupied=$CourtCounter['CourtCount'];



   $scene ='<div class="col-md-3 boxe" data-dismiss="modal" onclick="testerkan('.$courtID.')">
     <h3>'.$courtName.'</h3>
     <p>Availability: '.$Occupied.'</p>
     <div style="display: none"><input type="text" id="courttree" value="'.$Courtdiv.'"></div>
     </div>';

   $pass[]=$scene;  

}

 $Data['scene']= $pass;


}

else
{

 $Data['scene']="No Data";
 

}


$tempData = $Data;

$cleanData =  json_encode($tempData);
print_r($cleanData);



?>