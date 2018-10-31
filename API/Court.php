<?php 

include 'DeviceConnection.php';

$data=array();

$TimeSlotID=$_POST['TimeSlotID'];



$Court="SELECT * FROM court";




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
   
$pass[]=array_merge($list,$CourtCounter);


    // $pass[]=$list;

   // $CourtIDE[]=$courtID;
   // $courtNameE[]=$courtName;
   // $OccupiedE[]=$Occupied;

}






 // $pass['CourtID']=$CourtIDE;
 // $pass['courtName']=$courtNameE;
 // $pass['Occupied']=$OccupiedE;
 
 $Data['court']=$pass;


}

else
{

 $Data['Court']="No Data";

}

 print_r(json_encode($Data));




?>

