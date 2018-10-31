<?php 

include 'DeviceConnection.php';

$Name=$_POST['Name'];
$Phone=$_POST['Phone'];
$Email=$_POST['Email'];
$Place=$_POST['Place'];
$BloodGroup=$_POST['BloodGroup'];
$DOB=$_POST['DOB'];

$idNo=$_POST['idNo'];
$nationality=$_POST['nationality'];
$height=$_POST['height'];
$weight=$_POST['weight'];
$emergencyNo=$_POST['emergencyNo'];
$checkup=$_POST['checkup'];
$injury=$_POST['injury'];
$diabetes=$_POST['diabetes'];
$surgery=$_POST['surgery'];
$suppli=$_POST['suppli'];
$diabetes=$_POST['diabetes'];
$steroid=$_POST['steroid'];
$hernia=$_POST['hernia'];
$specific=$_POST['specific'];
//$membership=$_POST['membership'];
$fromDate=$_POST['fromDate'];
$toDate=$_POST['toDate'];
$membership=$_POST['membership'];

$Notes=$_POST['Notes'];
$RefferedBy=$_POST['RefferedBy'];
$MaritalStatus=$_POST['Marital'];
$Gender=$_POST['Gender'];
$UserImageP = $_POST['UserImage'];
$IdentityCardP = $_POST['IdentityCard'];
$FamilyDetails = $_POST['FamilyDetail'];
$data=$_POST['SportJson'];

$KnownFrom=$_POST['KnownFrom'];
$Occupation=$_POST['Occupation'];
$membertypo=$_POST['membertypo'];

$LoyalityCard=$_POST['LoyalityCard'];

$Reg=mysqli_query($conn,"SELECT * FROM userlastreg WHERE LastRegID='1'");

$RegRow=mysqli_fetch_assoc($Reg);
$LastReg=$RegRow['RegID'];

$RegisterNo=$LastReg+1;



$json = json_decode($data, true);

$elementCount  = count($json);

 $usercon="U";
 $UserImage=$usercon.time();
 
 $userpath = "../uploads/user/$UserImage.png";
 
 $identitycon="ID";
 $IdentityCard=$identitycon.time();
 
 $idpath = "../uploads/idcards/$IdentityCard.png";


$Validate=mysqli_query($conn,"SELECT * FROM users WHERE Phone='$Phone' OR Email='$Email'");



if(mysqli_num_rows($Validate)<=0)	
{

//New Entry

if($RefferedBy=="")
{

//No Refrence

$sql="INSERT INTO users(RegisterNo, Name, Phone, Email, Place, Gender, UserImage, IdentityCard, BloodGroup, DOB,id_no,durationfrom,durationto,emargency_no,nationality,height,weight,check1,check2,check3,check4,check5,check6,check7,healthdetails,membership, Notes, MaritalStatus, FamilyDetails, Occupation, KnownFrom, membertypo, RefferedBy, RegisteredThrough, SQLStatus) VALUES ('$RegisterNo', '$Name', '$Phone', '$Email', '$Place', '$Gender', '$UserImage.png', '$IdentityCard.png', '$BloodGroup', '$DOB','$idNo','$fromDate','$toDate','$emergencyNo','$nationality','$height','$weight','$checkup','$injury','$diabetes','$hernia','$surgery','$suppli','$steroid','$specific','$membership','$Notes', '$MaritalStatus', '$FamilyDetails', '$Occupation', '$KnownFrom','$membertypo', '$RefferedBy', 'App', 1)";



if (mysqli_query($conn, $sql))
 {
 	$user_id=mysqli_insert_id($conn);

     $insert=mysqli_query($conn, "INSERT INTO customer_wallet(UserID, Amount) VALUES ('$user_id',0)");

    $updateCount=mysqli_query($conn,"UPDATE userlastreg SET RegID='$RegisterNo' WHERE LastRegID='1'");

    file_put_contents($userpath,base64_decode($UserImageP));
    file_put_contents($idpath,base64_decode($IdentityCardP));

    
for ($i=0;$i < $elementCount; $i++)
   {

    $SportID=$json[$i]['Game'];
	$TimeSlotID=$json[$i]['Timeslot'];
    $CourtID=$json[$i]['CourtId'];
	$GameName=$json[$i]['GameName'];

   mysqli_query($conn,"INSERT INTO usercourtdetails SET
    UserID=$user_id,
    CourtID=$CourtID,
    TimeSlotID=$TimeSlotID,
    SportID=$SportID,
    SportName='$GameName',
    SQLSports=1");
   }


echo mysqli_error($conn);
    $pass['status']="Success";
    $pass['user_id']=$user_id;
 } 

else 
{
    echo mysqli_error($conn);
    $pass['status']="Error";
    $pass['user_id']="0";

}

}

else
{

//Under Reference 

$ReferChecker=mysqli_query($conn,"SELECT * FROM users WHERE Phone='$RefferedBy'");

if(mysqli_num_rows($ReferChecker)>0)	
{

$Row=mysqli_fetch_assoc($ReferChecker);
$RefererID=$Row['UserID'];


$sql="INSERT INTO users(RegisterNo, Name, Phone, Email, Place, Gender, UserImage, IdentityCard, BloodGroup, DOB ,id_no,durationfrom,durationto,emargency_no,nationality,height,weight,check1,check2,check3,check4,check5,check6,check7,healthdetails,membership, Notes, MaritalStatus, FamilyDetails, Occupation, KnownFrom, membertypo, RefferedBy, RegisteredThrough, SQLStatus) VALUES ('$RegisterNo', '$Name', '$Phone', '$Email', '$Place', '$Gender', '$UserImage.png', '$IdentityCard.png', '$BloodGroup', '$DOB','$idNo','$fromDate','$toDate','$emergencyNo','$nationality','$height','$weight','$checkup','$injury','$diabetes','$hernia','$surgery','$suppli','$steroid','$specific','$membership', '$Notes', '$MaritalStatus', '$FamilyDetails', '$Occupation', '$KnownFrom', '$membertypo','$RefererID','App', 1)";





if (mysqli_query($conn, $sql))
 {
    $user_id=mysqli_insert_id($conn);


       $insert=mysqli_query($conn, "INSERT INTO customer_wallet(UserID, Amount) VALUES ('$user_id',0)");

    $insert_referal=mysqli_query($conn, "UPDATE customer_wallet SET Amount=Amount+500 WHERE UserID='$RefererID'");

    $wallet_red_insert=mysqli_query($conn,"INSERT INTO wallet_reduction(UserID, Amount, UnderReference, Type, TransName) VALUES ('$user_id', 500, '$RefererID','Credit', 'Refferal')");
     

    

     $updateCount=mysqli_query($conn,"UPDATE userlastreg SET RegID='$RegisterNo' WHERE LastRegID='1'");

    file_put_contents($userpath,base64_decode($UserImageP));
    file_put_contents($idpath,base64_decode($IdentityCardP));


                                              

    
for ($i=0;$i < $elementCount; $i++)
   {

    $SportID=$json[$i]['Game'];
    $TimeSlotID=$json[$i]['Timeslot'];
    $CourtID=$json[$i]['CourtId'];
    $GameName=$json[$i]['GameName'];

   mysqli_query($conn,"INSERT INTO usercourtdetails SET
    UserID=$user_id,
    CourtID=$CourtID,
    TimeSlotID=$TimeSlotID,
    SportID=$SportID,
    SportName='$GameName',
    SQLSports=1");
   }



    $pass['status']="Success";
    $pass['user_id']=$user_id;
 } 

else 
{
echo mysqli_error($conn);
    $pass['status']="Error";
    $pass['user_id']="0";

}
}

else
{
    //Reference Number Not Found

    $pass['status']="Reference Number Not Found";
    $pass['user_id']="0";

}

}







}

// If User Already Registered
else
{

    $pass['status']="User Already Registered";
    $pass['user_id']="0";

}

print_r(json_encode($pass));







?>