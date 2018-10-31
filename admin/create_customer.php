<?php

session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

date_default_timezone_set('Asia/Kolkata');
$current = date('Y-m-d');

$admin=$_SESSION['admin'];
$name=$admin['Name'];
$auth_id=$admin['AuthID'];

require 'db/config.php';

$sql="SELECT * FROM  sporttype WHERE Status='Active'";
$result=mysqli_query($conn,$sql);

$countquery=mysqli_query($conn,"SELECT (SELECT COUNT(*) FROM sporttype WHERE Status='Active') AS Sprtcount");
$rowcount=mysqli_fetch_assoc($countquery);
$sportcount=$rowcount['Sprtcount'];

$Reg=mysqli_query($conn,"SELECT * FROM userlastreg WHERE LastRegID='1'");

$RegRow=mysqli_fetch_assoc($Reg);
$LastReg=$RegRow['RegID'];

$RegisterNo=$LastReg+1;

if(isset($_POST['submit']))
{
$id=$_POST['id'];
$Name=$_POST['Name'];
$durationfrom=$_POST['durationfrom'];
$durationto=$_POST['durationto'];
$membership=$_POST['membership'];
$Phone=$_POST['Phone'];
$emargency=$_POST['phone'];
$Email=$_POST['Email'];
$Gender=$_POST['Gender'];
$Place=$_POST['Place'];
$BloodGroup=$_POST['BloodGroup'];
$DOB=$_POST['DOB'];
// $CustomerType=$_POST['CustomerType'];
//$Notes=$_POST['Notes'];
//$FamilyDetails = $_POST['FamilyDetails'];
$Occupation=$_POST['Occupation'];
$KnownFrom=$_POST['KnownFrom'];
$RefererMobile=$_POST['RefererMobile'];

//$LoyalityCard=$_POST['LoyalityCard'];

$MaritalStatus=$_POST['MaritalStatus'];
$membertypo="Existing";
$height=$_POST['height'];
$weight=$_POST['weight'];
$check=$_POST['check'];
$check2=$_POST['check2'];
$check3=$_POST['check3'];
$check4=$_POST['check4'];
$check5=$_POST['check5'];
$check6=$_POST['check6'];
$check7=$_POST['check7'];
$healthdetails=$_POST['healthdetails'];
$nationality=$_POST['nationality'];

$Validate=mysqli_query($conn,"SELECT * FROM users WHERE Phone='$Phone' OR Email='$Email' ");



if(mysqli_num_rows($Validate)<=0) 
{



    $usercon="U";
    $target_dir = "../uploads/user/U"; //directory details
    
    $imageFileType = pathinfo($_FILES["UserImage"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $UserImage = $usercon.time().'.'.$imageFileType; //full path
    if(move_uploaded_file($_FILES["UserImage"]["tmp_name"], $target))
   
    {

    $target_dir = "../uploads/idcards/"; //directory details
    
    $imageFileType = pathinfo($_FILES["IDProof"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $IDProof = time().'.'.$imageFileType; //full path 
    move_uploaded_file($_FILES["IDProof"]["tmp_name"], $target);
    

   if(empty($RefererMobile))
   {



   $RefferedBy=0;

   //No Refrence

   $insert="INSERT INTO users(RegisterNo, id_no,durationfrom,durationto,membership,Name, Phone, emargency_no, Email, Place, Gender, UserImage, IdentityCard, BloodGroup, DOB,  MaritalStatus,  Occupation, KnownFrom,height,weight, membertypo, RefferedBy, RegisteredThrough,check1,check2,check3,check4,check5,check6,check7,healthdetails,nationality,  SQLStatus) VALUES ('$RegisterNo','$id','$durationfrom','$durationto','$membership', '$Name', '$Phone','$emargency', '$Email', '$Place', '$Gender', '$UserImage', '$IDProof', '$BloodGroup', '$DOB', '$MaritalStatus', '$Occupation', '$KnownFrom','$height','$weight','$membertypo', '$RefferedBy', 'Estadio','$check','$check2','$check3','$check4','$check5','$check6','$check7','$healthdetails','$nationality',1)";
  
 
    if (mysqli_query($conn, $insert))
    {
     
     $user_id=mysqli_insert_id($conn);

     $updateCount=mysqli_query($conn,"UPDATE userlastreg SET RegID='$RegisterNo' WHERE LastRegID='1'");
     
     $insert=mysqli_query($conn, "INSERT INTO customer_wallet(UserID, Amount) VALUES ('$user_id',0)");

     $SportID=$_POST['sports'];
      $TimeSlot=$_POST['timeslot'];
      $Court=$_POST['Court'];
     

       for($w = 0; $w<count($TimeSlot); $w++)  
       { 

       if($TimeSlot[$w]!=0)
       {
       
       $TimeSlotID[]=$TimeSlot[$w];
       $CourtID[]=$Court[$w];
        
       };
       

       };

     for($q = 0; $q<count($SportID); $q++)  

     {  

      $SportIDE=$SportID[$q];
      $TimeSlotIDE=$TimeSlotID[$q];
      $CourtIDE=$CourtID[$q];

       $getgamename=mysqli_query($conn,"SELECT * FROM  sporttype WHERE SportID='$SportIDE'");

      $result_game=mysqli_fetch_assoc($getgamename);
             $GameName=$result_game['SportName'];
      
   

       $insertcourt="INSERT INTO usercourtdetails(UserID, CourtID, TimeSlotID, SportID, SportName, SQLSports) VALUES ('$user_id', '$CourtIDE', '$TimeSlotIDE', '$SportIDE', '$GameName', 1)";
     
           mysqli_query($conn,$insertcourt);

  
     };

 
      echo "<script> alert('Member Added');window.location.href = 'member_form.php?id=$user_id';</script>";

    }
    else
    {
   
    echo "<script> alert('Upload Error');window.location.href = 'create_customer.php';</script>";

    }


    }
    else
    {


    //Under Reference 
    
    $ReferChecker=mysqli_query($conn,"SELECT * FROM users WHERE Phone='$RefererMobile'");
    

    if(mysqli_num_rows($ReferChecker)>0)  
    {

    $Row=mysqli_fetch_assoc($ReferChecker);
    $RefererID=$Row['UserID'];
    
 

       $insert="INSERT INTO users(RegisterNo, id_no,durationfrom,durationto,membership,Name, Phone, emargency_no, Email, Place, Gender, UserImage, IdentityCard, BloodGroup, DOB,  MaritalStatus,  Occupation, KnownFrom,height,weight, membertypo, RefferedBy, RegisteredThrough,check1,check2,check3,check4,check5,check6,check7,healthdetails,nationality , SQLStatus) VALUES ('$RegisterNo','$id','$durationfrom','$durationto','$membership', '$Name', '$Phone','$emargency', '$Email', '$Place', '$Gender', '$UserImage', '$IDProof', '$BloodGroup', '$DOB', '$MaritalStatus', '$Occupation', '$KnownFrom', '$height','$weight','$membertypo', '$RefferedBy', 'Estadio', '$check','$check2','$check3','$check4','$check5','$check6','$check7','$healthdetails','$nationality',1)";
 
    if (mysqli_query($conn, $insert))
    {


    $user_id=mysqli_insert_id($conn);

     $updateCount=mysqli_query($conn,"UPDATE userlastreg SET RegID='$RegisterNo' WHERE LastRegID='1'");
     
     $insert=mysqli_query($conn, "INSERT INTO customer_wallet(UserID, Amount) VALUES ('$user_id',0)");

    $insert_referal=mysqli_query($conn, "UPDATE customer_wallet SET Amount=Amount+500 WHERE UserID='$RefererID'");

    $wallet_red_insert=mysqli_query($conn,"INSERT INTO wallet_reduction(UserID, Amount, UnderReference, Type, TransName) VALUES ('$user_id', 500, '$RefererID','Credit', 'Refferal')");
     

     $SportID=$_POST['sports'];
      $TimeSlot=$_POST['timeslot'];
      $Court=$_POST['Court'];
     

       for($w = 0; $w<count($TimeSlot); $w++)  
       { 

       if($TimeSlot[$w]!=0)
       {
       
       $TimeSlotID[]=$TimeSlot[$w];
       $CourtID[]=$Court[$w];
        
       };
       

       };

     for($q = 0; $q<count($SportID); $q++)  

     {  

      $SportIDE=$SportID[$q];
      $TimeSlotIDE=$TimeSlotID[$q];
      $CourtIDE=$CourtID[$q];

       $getgamename=mysqli_query($conn,"SELECT * FROM  sporttype WHERE SportID='$SportIDE'");

      $result_game=mysqli_fetch_assoc($getgamename);
             $GameName=$result_game['SportName'];
      
   

       $insertcourt="INSERT INTO usercourtdetails(UserID, CourtID, TimeSlotID, SportID, SportName, SQLSports) VALUES ('$user_id', '$CourtIDE', '$TimeSlotIDE', '$SportIDE', '$GameName', 1)";
     
           mysqli_query($conn,$insertcourt);

  
     };





    echo "<script> alert('Member Added');window.location.href = 'member_form.php?id=$user_id';</script>";



    }
    else
    {

    echo "<script> alert('Upload Error');window.location.href = 'create_customer.php';</script>";

    }





    }
    else
    {

    echo "<script> alert('Mobile Number Not Found');window.location.href = 'create_customer.php';</script>";

    }


    }

  }

    else
    {
    
     echo "<script> alert('Upload Error');window.location.href = 'create_customer.php';</script>";
    
    }



}


else
{
  echo "<script> alert('User Already Registered');window.location.href = 'create_customer.php';</script>";
}





};


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Orange | Admin</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

 


   <script src="vendors/jquery/dist/jquery.min.js"></script>

    <script src="typeahead.min.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 10
    });
});
    </script>
    <style type="text/css">


.tt-dropdown-menu {
  background-color: #FFFFFF;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  margin-top: 12px;
  padding: 8px 0;
  width: 422px;
}

.hide{
       display: none;
         }
      .boxe{
        border: 1px solid #9595a7!important;
    background-color: #f7f7f9;
    margin-top: 5%;
    text-align: center;
    margin-left: 5%;
    margin-bottom: 5%;
    height: 100px;
      }
</style>

  </head>

  <body class="nav-md">


  <?php require 'partials/sidebar.php'; ?>

       


<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create Customer</h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Customer Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Id"> ID No. <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="id" class="form-control col-md-7 col-xs-12" name="id" placeholder="ID No" required="required" type="text">
                        </div>
                      </div>


                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="duration"> MemberShip Duration <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                       From   <input id="durationfrom" class="form-control col-md-7 col-xs-12" name="durationfrom" placeholder="From" required="required" type="date">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                       To   <input id="durationto" class="form-control col-md-7 col-xs-12" name="durationto" placeholder="To" required="required" type="date">
                        </div>
                      </div>
                      
                       
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="membership">MemberShip Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                              <input type="radio" name="membership"
                            <?php if (isset($membership) && $membership=="halfyearly") echo "checked";?>
                              value="halfyearly">Half Yearly &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              
                              <input type="radio" name="membership"
                              <?php if (isset($membership) && $membership=="quaterly") echo "checked";?>
                              value="quaterly">Quaterly &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               
                               
                               <input type="radio" name="membership"
                              <?php if (isset($membership) && $membership=="monthly") echo "checked";?>
                              value="monthly">Monthly &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               </div>
                      </div>
                      

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name"> Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Name" class="form-control col-md-7 col-xs-12" name="Name" placeholder="Name" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Phone"> Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="Phone" class="form-control col-md-7 col-xs-12" name="Phone" placeholder="Phone" required="required" >
                        </div>
                      </div>
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Phone"> Incase Of Emergency <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone" class="form-control col-md-7 col-xs-12" name="phone" placeholder="Person To Contact" required="required" type="text">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Email"> Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Email" class="form-control col-md-7 col-xs-12" name="Email" placeholder="Email" required="required" type="email">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Gender">Gender<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" id="Gender" name="Gender" value="Male" checked onclick="showladies1();"> Male&nbsp&nbsp
                          <input type="radio" id="Gender" name="Gender" value="Female" onclick="showladies2();"> Female&nbsp&nbsp
                          
                        </div>
                      </div>

                    

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="FamilyDetails">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="Place" required="required" name="Place" class="form-control col-md-7 col-xs-12" rows="3"></textarea>
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="BloodGroup"> Blood Group <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select id="BloodGroup" class="form-control col-md-7 col-xs-12" name="BloodGroup">
 
                          <option value="A Positive">A Positive</option>  
                          <option value="A Negative">A Negative</option>  
                          <option value="B Positive">B Positive</option>  
                          <option value="B Negative">B Negative</option> 
                          <option value="AB Positive">AB Positive</option>  
                          <option value="AB Negative">AB Negative</option>   
                          <option value="O Positive">O Positive</option>   
                          <option value="O Negative">O Negative</option> 
                        
                          
                        
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DOB"> DOB <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="DOB" class="form-control col-md-7 col-xs-12" name="DOB" placeholder="DOB" required="required" type="date">
                        </div>
                      </div>

                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MaritalStatus">Marital Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" id="MaritalStatus" name="MaritalStatus" value="Single" checked> Single&nbsp&nbsp
                          <input type="radio" id="MaritalStatus" name="MaritalStatus" class="female" value="Married"> Married&nbsp&nbsp
                          
                        </div>
                      </div>


                     


             


                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Occupation"> Occupation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Occupation" class="form-control col-md-7 col-xs-12" name="Occupation" placeholder="Occupation" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="KnownFrom">Known From<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" id="KnownFrom" name="KnownFrom" onclick="show1();" value="Newspaper" checked> Newspaper&nbsp&nbsp
                          <input type="radio" id="KnownFrom" name="KnownFrom" onclick="show1();" value="Online"> Online&nbsp&nbsp
                          <input type="radio" id="KnownFrom" name="KnownFrom" onclick="show1();" value="Magazine"> Magazine&nbsp&nbsp
                          <input type="radio" id="KnownFrom" name="KnownFrom" value="Friends" onclick="show2();"> Friend&nbsp&nbsp
                        </div>
                      </div>

                      <div id="div1" style="display: none">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="RefererMobile"> Referer Mobile <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <input id="RefererMobile" class="form-control col-md-7 col-xs-12 typeahead" name="RefererMobile" placeholder="Referer Mobile" autocomplete="off" onblur ="GetCustomer()" spellcheck="false" type="text">&nbsp&nbsp<h5 id="RefMembNAme"></h5>
                          
                        </div>
                      </div>
                      </div>
                      
                      
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nationality"> Nationality <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Occupation" class="form-control col-md-7 col-xs-12" name="nationality" placeholder="Nationality" required="required" type="text">
                        </div>
                      </div>
                      
                      
                  <!--    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="LoyalityCard">Card No<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="LoyalityCard" name="LoyalityCard" class="form-control col-md-7 col-xs-12" required>
                        </div>
                      </div>-->
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Height"> Height <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="height" class="form-control col-md-7 col-xs-12" name="height" placeholder="Height" required="required" type="number">
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Weight"> Weight <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="weight" class="form-control col-md-7 col-xs-12" name="weight" placeholder="Weight" required="required" type="number">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="UserImage">User Image<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="UserImage" name="UserImage" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="IDProof">ID Proof <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="IDProof" name="IDProof" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="check1">Checked/Diagnosed By Doctor Recently<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                              <input type="radio" name="check"
                            <?php if (isset($check) && $check=="yes") echo "checked";?>
                              value="yes">Yes &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              
                              <input type="radio" name="check"
                              <?php if (isset($check) && $check=="no") echo "checked";?>
                              value="no">No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="check2">Any Previous Injury/Accidents<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                              <input type="radio" name="check2"
                            <?php if (isset($check2) && $check2=="yes") echo "checked";?>
                              value="yes">Yes &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              
                              <input type="radio" name="check2"
                              <?php if (isset($check2) && $check2=="no") echo "checked";?>
                              value="no">No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               </div>
                      </div>
                      
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="check3">Any Condition of Diabetes/Thyroid<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                              <input type="radio" name="check3"
                            <?php if (isset($check3) && $check3=="yes") echo "checked";?>
                              value="yes">Yes &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              
                              <input type="radio" name="check3"
                              <?php if (isset($check3) && $check3=="no") echo "checked";?>
                              value="no">No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               </div>
                      </div>
                      
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="check4">Any Condition of Hernia Etc Aggravated By History of Lifting Of Weights<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                              <input type="radio" name="check4"
                            <?php if (isset($check4) && $check4=="yes") echo "checked";?>
                              value="yes">Yes &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              
                              <input type="radio" name="check4"
                              <?php if (isset($check4) && $check4=="no") echo "checked";?>
                              value="no">No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               </div>
                      </div>
                      
                      
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="check4">Any Surgery/Fracture History <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                              <input type="radio" name="check7"
                            <?php if (isset($check7) && $check7=="yes") echo "checked";?>
                              value="yes">Yes &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              
                              <input type="radio" name="check7"
                              <?php if (isset($check7) && $check7=="no") echo "checked";?>
                              value="no">No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               </div>
                      </div>

             
                     
                     
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="check5">Any History of Taking Suppliments<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                              <input type="radio" name="check5"
                            <?php if (isset($check5) && $check5=="yes") echo "checked";?>
                              value="yes">Yes &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              
                              <input type="radio" name="check5"
                              <?php if (isset($check5) && $check5=="no") echo "checked";?>
                              value="no">No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="check6">Any History of Taking Steroids<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                              <input type="radio" name="check6"
                            <?php if (isset($check6) && $check6=="yes") echo "checked";?>
                              value="yes">Yes &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              
                              <input type="radio" name="check6"
                              <?php if (isset($check6) && $check6=="no") echo "checked";?>
                              value="no">No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                               </div>
                      </div>
                      
                      
                      

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="health">Any Specific Health Scenarios, Explain <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="healthdetails" required="required" name="healthdetails" class="form-control col-md-7 col-xs-12" rows="3"></textarea>
                        </div>
                      </div>


                  
                     <div class="row" style="text-align: center; margin-left:100px ">

                     <?php 
                     $i=0;
                     while($row=mysqli_fetch_assoc($result))

                     {

                     $i=$i+1;
                     
                     ?>


                        <?php 
                        if($row['Court']=='True')
                        {
                        ?>


                          <div class="col-md-5" style="border: 1px solid #73879C;  margin-right: 8px;margin-bottom: 3%;">
                          <div style="display: flex;">
                          <input type="checkbox" id="<?php echo 'sport'.$i; ?>" name="sports[]" onclick="racist('<?php echo 'sport'.$i; ?>','<?php echo 'sporty'.$i; ?>')" value="<?php echo $row['SportID']; ?>">
                          <p style="margin-left: 5%;"><?php echo $row['SportName']; ?></p>

                          


                          </div>

                          <div id="<?php echo 'sporty'.$i; ?>" style="display: none">

                          <h4 style="text-align: center;">Time slot</h4>

                          <div class="col-md-4">
                          <h4>Morning</h4>

                           <?php
                           $morning_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Morning' AND Status='Active'");
                           while($morning_result=mysqli_fetch_assoc($morning_slot))
                           {

                           ?> 
                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="GetCourt('<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'courtdiv'.$i;?>');addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>');" data-toggle="modal" data-target="#myModal" value="<?php echo $morning_result['TimeSlotID']; ?> "> <?php echo $morning_result['TimeSlotName']; ?><br>
                           
                           <?php }; ?>
                           </div>


                          <div class="col-md-4">
                          <h4>Evening</h4>


                           <?php
                           $evening_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Evening' AND Status='Active'");
                           while($evening_result=mysqli_fetch_assoc($evening_slot))
                           {

                           ?> 

                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="GetCourt('<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'courtdiv'.$i;?>');addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $evening_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')"  data-toggle="modal" data-target="#myModal" value="<?php echo $evening_result['TimeSlotID']; ?>"> <?php echo $evening_result['TimeSlotName']; ?><br>
                           
                           <?php }; ?>
                           
                             
                          </div>



                          <div id="<?php echo 'divladies'.$i;?>" style="display: none">
                          <div class="col-md-4">
                          <h4>Ladies Only</h4>


                           <?php
                           $ladies_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Ladies Only' AND Status='Active'");
                           while($ladies_result=mysqli_fetch_assoc($ladies_slot))
                           {

                           ?> 

                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="GetCourt('<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'courtdiv'.$i;?>');addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $ladies_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')"  data-toggle="modal" data-target="#myModal" value="<?php echo $ladies_result['TimeSlotID']; ?>"> <?php echo $ladies_result['TimeSlotName']; ?><br>


                           
                           <?php }; ?>


                          
                             
                          </div><br>
                          </div><br>


                           

                        </div>
                        </div>

                        <?php }

                        else {
                        ?>

                          <div class="col-md-5" style="border: 1px solid #73879C;  margin-right: 8px;margin-bottom: 3%;">
                          <div style="display: flex;">
                          <input type="checkbox" id="<?php echo 'sport'.$i; ?>" name="sports[]" onclick="racist('<?php echo 'sport'.$i; ?>','<?php echo 'sporty'.$i; ?>')" value="<?php echo $row['SportID']; ?>">
                          <p style="margin-left: 5%;"><?php echo $row['SportName']; ?></p>

                     
                          </div>

                          <div id="<?php echo 'sporty'.$i; ?>" style="display: none">

                          <h4 style="text-align: center;">Time slot</h4>

                          <div class="col-md-4">
                          <h4>Morning</h4>

                           <?php
                           $morning_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Morning' AND Status='Active'");
                           while($morning_result=mysqli_fetch_assoc($morning_slot))
                           {

                           ?> 
                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')" value="<?php echo $morning_result['TimeSlotID']; ?> "> <?php echo $morning_result['TimeSlotName']; ?><br>
                           
                          <?php }; ?>
                          </div>


                          <div class="col-md-4">
                          <h4>Evening</h4>


                           <?php
                           $evening_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Evening' AND Status='Active'");
                           while($evening_result=mysqli_fetch_assoc($evening_slot))
                           {

                           ?> 

                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $evening_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')" value="<?php echo $evening_result['TimeSlotID']; ?>"> <?php echo $evening_result['TimeSlotName']; ?><br>
                           
                           <?php }; ?>
                           
                             
                          </div>



                           <div id="<?php echo 'divladies'.$i;?>" style="display: none">
                           <div class="col-md-4">
                           <h4>Ladies Only</h4>


                           <?php
                           $ladies_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Ladies Only' AND Status='Active'");
                           while($ladies_result=mysqli_fetch_assoc($ladies_slot))
                           {

                           ?> 

                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $ladies_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')" value="<?php echo $ladies_result['TimeSlotID']; ?>"> <?php echo $ladies_result['TimeSlotName']; ?><br>
                           
                           <?php }; ?>
                           
                             
                          </div><br>
                          </div><br>

                           

                        </div>
                        </div>

                      <?php }; ?>
                      
                           <input type="hidden" name="timeslot[]" id="<?php echo 'timesloted'.$i;?>">
                          <input type="hidden" name="Court[]" id="<?php echo 'courtdiv'.$i;?>" value="0">
              
                     <?php }; ?>
                         
                     <input type="hidden" id="sportcount" value="<?php echo $sportcount ?>">    

                       </div> <br>

                       

                        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Courts</h4>
      </div>

      <div id="CourtDetails">
      
     

      </div>
     
      <div class="modal-footer">
    
      </div>
    </div>

  </div>
</div>

                        <div class="col-md-6 col-md-offset-4">
                          <button type="submit" onClick="window.location.reload()" class="btn btn-primary">Cancel</button>
                          <input type="submit" name="submit" class="btn btn-success" value="Submit">
                        </div>
                    </form>
                    <br>
                  <!--   <div class="container">
                    

                    </div>   -->

                 
                  </div>
                </div>
              </div>
            </div>

 


           
           


     
          </div>
        </div>





        
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered By <a href="">Estadio</a>
          </div>
          <div class="clearfix"></div>
        </footer>


<script>
  
function GetCustomer()
       {

           var Phone = document.getElementById('RefererMobile').value 



           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'GetCustomer.php' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           Phone:Phone

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);
           
             document.getElementById('RefMembNAme').innerHTML = temp.customer.Name;

           
          
          

           }

           }
           };




   
       

          
       }




</script>


<script>
  

function racist(chkd,sportdivy)

{

 var chckd = chkd;
 var sportdivy = sportdivy;

 


 if ( document.getElementById(chckd).checked==true ) {

       
  document.getElementById(sportdivy).style.display ='block';

  } 

 else {
      
   document.getElementById(sportdivy).style.display ='none';


  }


}

</script>




        <script>
          
   function show1(){

  
  document.getElementById('div1').style.display ='none';
}
function show2(){


  document.getElementById('div1').style.display = 'block';
}


   function showladies1(){

  
  

var sportcount = document.getElementById('sportcount').value;

var t=0;
for (i=0; i<sportcount; i++)
{

t = t+1;
var tested ="divladies"+t;



document.getElementById(tested).style.display ='none';

}
}



function showladies2(){


var sportcount = document.getElementById('sportcount').value;

var t=0;
for (i=0; i<sportcount; i++)
{

t = t+1;
var tested ="divladies"+t;




  document.getElementById(tested).style.display = 'block';

}

}


function addcount(getradio,timeslot,giveslot)
 {
 


  var getradio = getradio;
  var timeslot = timeslot;
  var giveslot = giveslot;

 

 document.getElementById(giveslot).value=timeslot;

  }


        </script>


<script>
function GetCourt(timeslot_id,court_div)
{

 var TimeSlotID = timeslot_id;
 var court_div = court_div;


 xhr = new XMLHttpRequest();
 xhr.open('POST' , 'GetCourt.php' , true);

 xhr.setRequestHeader('Content-Type', 'application/json');
 xhr.send(JSON.stringify({
 TimeSlotID:TimeSlotID,
 court_div:court_div

 }));
 
 
xhr.onreadystatechange = function() {
  
if (this.readyState == 4 && this.status == 200) {


console.log('-------------------------------111--------------------------->>>')
           
var temp =xhr.responseText;
if (temp) {
           
temp= JSON.parse(temp);


document.getElementById('CourtDetails').innerHTML =temp.scene;


}
   }

           }



 
}



function testerkan(court_id)
{


var court_id =  court_id;

var echodiv =  document.getElementById('courttree').value;

document.getElementById(echodiv).value=court_id;

}
    </script>    
    

    <!-- jQuery -->
    
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgres->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>


	
  </body>
</html>