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

$UserID=$_GET['id'];

require 'db/config.php';

$sql="SELECT * FROM  sporttype WHERE Status='Active'";
$result=mysqli_query($conn,$sql);

$countquery=mysqli_query($conn,"SELECT (SELECT COUNT(*) FROM sporttype WHERE Status='Active') AS Sprtcount");
$rowcount=mysqli_fetch_assoc($countquery);
$sportcount=$rowcount['Sprtcount'];

$users=mysqli_query($conn,"SELECT * FROM users WHERE UserID='$UserID'");
$user_row=mysqli_fetch_assoc($users);
$Gender=$user_row['Gender'];



if(isset($_POST['submit']))
{


$del="DELETE FROM usercourtdetails WHERE UserID='$UserID'";
      mysqli_query($conn,$del);

   

     for($q = 0; $q<count($_POST['sports']); $q++)  
     {  

      

      $SportID=$_POST['sports'][$q];
    
      $CourtID=$_POST['Court'][$q];
      $TimeSlotID=$_POST['timeslot'][$q];

      $getgamename=mysqli_query($conn,"SELECT * FROM  sporttype WHERE SportID='$SportID'");
      $result_game=mysqli_fetch_assoc($getgamename);
      $GameName=$result_game['SportName'];
      
      

      $insertcourt="INSERT INTO usercourtdetails(UserID, CourtID, TimeSlotID, SportID, SportName, SQLSports) VALUES ('$UserID', '$CourtID', '$TimeSlotID', '$SportID', '$GameName', 2)";
     
     
     
     mysqli_query($conn,$insertcourt);
    
   
  
      echo "<script> alert('Sports Modified');window.location.href = 'manage_customer.php';</script>";

      
  
     };



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
                <h3>Manage Customer Sports</h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Customer Sports Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">


          

                  
                     <div class="row" style="text-align: center; margin-left:100px ">

                     <?php 
                     $i=0;
                     while($row=mysqli_fetch_assoc($result))

                     {

                     $i=$i+1;

                     $sts=0;

                     $SID=$row['SportID'];
                     $qc="SELECT * FROM usercourtdetails WHERE SportID='$SID' AND UserID='$UserID'";
                     $qcr=mysqli_query($conn,$qc);
                     if(mysqli_num_rows($qcr)==1)
                     {

                     $qcrow=mysqli_fetch_assoc($qcr); 
                     $TIME=$qcrow['TimeSlotID'];
                     $COUR=$qcrow['CourtID'];
                     $GetDetailed=mysqli_query($conn,"SELECT * FROM court WHERE CourtID='$COUR'");
                     $row_details=mysqli_fetch_assoc($GetDetailed);
                     $Court_Name=$row_details['CourtName'];
                     $sts=1;
                     
                     }; 
                     
                     ?>


                        <?php 
                        if($row['Court']=='True')
                        {
                        ?>


                          <div class="col-md-5" style="border: 1px solid #73879C;  margin-right: 8px;margin-bottom: 3%;">
                          <div style="display: flex;">
                          <input type="checkbox" id="<?php echo 'sport'.$i; ?>" name="sports[]" onclick="racist('<?php echo 'sport'.$i; ?>','<?php echo 'sporty'.$i; ?>')" value="<?php echo $row['SportID']; ?>" <?php if($sts==1){?> checked <?php }?>>
                          <p style="margin-left: 5%;"><?php echo $row['SportName']; ?></p>

                          

                          <input type="hidden" name="timeslot[]" value="<?php echo $TIME; ?>" id="<?php echo 'timesloted'.$i;?>">
                          <input type="hidden" name="Court[]" value="<?php echo $COUR; ?>" id="<?php echo 'courtdiv'.$i;?>" value="0">

                          </div>


                            <?php if($sts==1){
                            ?> 
                            
                            <div id="<?php echo 'sporty'.$i; ?>">                           
 

                            <?php }
                            else
                            { ?>

                            <div id="<?php echo 'sporty'.$i; ?>" style="display: none"> 

                            <?php
                            }
                            ?>
                          
                          <h4 style="text-align: center;">Court: <?php echo $Court_Name; ?></h4>
                          <h4 style="text-align: center;">Time slot</h4>

                          <div class="col-md-4">
                          <h4>Morning</h4>

                           <?php
                           $morning_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Morning' AND Status='Active'");
                           while($morning_result=mysqli_fetch_assoc($morning_slot))
                           {

                             $tmsts=0;

                             $TID=$morning_result['TimeSlotID'];
                             $tmqc="SELECT * FROM usercourtdetails WHERE TimeSlotID='$TID' AND UserID='$UserID' AND SportID='$SID'";
                             $tmqcr=mysqli_query($conn,$tmqc);
                             if(mysqli_num_rows($tmqcr)==1)
                             {
                             

                             $tmsts=1;

                     
                             };

                           ?> 
                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="GetCourt('<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'courtdiv'.$i;?>');addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>');" data-toggle="modal" data-target="#myModal" value="<?php echo $morning_result['TimeSlotID']; ?> " <?php if($tmsts==1){?> checked <?php }?>> <?php echo $morning_result['TimeSlotName']; ?><br>
                           
                           <?php }; ?>
                           </div>


                          <div class="col-md-4">
                          <h4>Evening</h4>


                           <?php
                           $evening_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Evening' AND Status='Active'");
                           while($evening_result=mysqli_fetch_assoc($evening_slot))
                           {
                            
                            $tests=0;

                             $TID=$evening_result['TimeSlotID'];
                             $teqc="SELECT * FROM usercourtdetails WHERE TimeSlotID='$TID' AND UserID='$UserID' AND SportID='$SID'";
                             $teqcr=mysqli_query($conn,$teqc);
                             if(mysqli_num_rows($teqcr)==1)
                             {

                             $tests=1;

                     
                             };
                           
                            
                           ?> 

                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="GetCourt('<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'courtdiv'.$i;?>');addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $evening_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')"  data-toggle="modal" data-target="#myModal" value="<?php echo $evening_result['TimeSlotID']; ?>" <?php if($tests==1){?> checked <?php }?> > <?php echo $evening_result['TimeSlotName']; ?><br>
                           
                           <?php }; ?>
                           
                             
                          </div>


                          <?php 
                          if($Gender=='Female')
                          { ?>
                          
                           <div id="<?php echo 'divladies'.$i;?>">
                           
                           <?php
                           }
                           else
                           { ?> 
                           
                           <div id="<?php echo 'divladies'.$i;?>" style="display: none">

                           <?php };
                           ?>
                          
                          <div class="col-md-4">
                          <h4>Ladies Only</h4>


                           <?php
                           $ladies_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Ladies Only' AND Status='Active'");
                           while($ladies_result=mysqli_fetch_assoc($ladies_slot))
                           {
                            
                             $tlsts=0;

                             $TID=$ladies_result['TimeSlotID'];
                             $tlqc="SELECT * FROM usercourtdetails WHERE TimeSlotID='$TID' AND UserID='$UserID' AND SportID='$SID'";
                             $tlqcr=mysqli_query($conn,$tlqc);
                             if(mysqli_num_rows($tlqcr)==1)
                             {

                             $tlsts=1;

                     
                             };

                           ?> 

                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="GetCourt('<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'courtdiv'.$i;?>');addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $ladies_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')"  data-toggle="modal" data-target="#myModal" value="<?php echo $ladies_result['TimeSlotID']; ?>" <?php if($tlsts==1){?> checked <?php }?> > <?php echo $ladies_result['TimeSlotName']; ?><br>


                           
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
                          <input type="checkbox" id="<?php echo 'sport'.$i; ?>" name="sports[]" onclick="racist('<?php echo 'sport'.$i; ?>','<?php echo 'sporty'.$i; ?>')" value="<?php echo $row['SportID']; ?>" <?php if($sts==1){?> checked <?php }?>>
                          <p style="margin-left: 5%;"><?php echo $row['SportName']; ?></p>

                          <input type="hidden" name="timeslot[]" value="<?php echo $TIME; ?>" id="<?php echo 'timesloted'.$i;?>">
                          <input type="hidden" name="Court[]" value="<?php echo $COUR; ?>" id="<?php echo 'courtdiv'.$i;?>" value="0">
                          </div>

                           <?php if($sts==1){
                            ?> 
                            
                            <div id="<?php echo 'sporty'.$i; ?>">                           
 

                            <?php }
                            else
                            { ?>

                            <div id="<?php echo 'sporty'.$i; ?>" style="display: none"> 

                            <?php
                            }
                            ?>

                          <h4 style="text-align: center;">Time slot</h4>

                          <div class="col-md-4">
                          <h4>Morning</h4>

                           <?php
                           $morning_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Morning' AND Status='Active'");
                           while($morning_result=mysqli_fetch_assoc($morning_slot))
                           {


                             $tmsts=0;

                             $TID=$morning_result['TimeSlotID'];
                             $tmqc="SELECT * FROM usercourtdetails WHERE TimeSlotID='$TID' AND UserID='$UserID' AND SportID='$SID'";
                             $tmqcr=mysqli_query($conn,$tmqc);
                             if(mysqli_num_rows($tmqcr)==1)
                             {

                             $tmsts=1;
                     
                             };
                           ?> 
                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $morning_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')" value="<?php echo $morning_result['TimeSlotID']; ?> " <?php if($tmsts==1){?> checked <?php }?> > <?php echo $morning_result['TimeSlotName']; ?><br>
                           
                          <?php }; ?>
                          </div>


                          <div class="col-md-4">
                          <h4>Evening</h4>


                           <?php
                           $evening_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Evening' AND Status='Active'");
                           while($evening_result=mysqli_fetch_assoc($evening_slot))
                           {

                             $tests=0;

                             $TID=$evening_result['TimeSlotID'];
                             $teqc="SELECT * FROM usercourtdetails WHERE TimeSlotID='$TID' AND UserID='$UserID' AND SportID='$SID'";
                             $teqcr=mysqli_query($conn,$teqc);
                             if(mysqli_num_rows($teqcr)==1)
                             {

                             $tests=1;

                     
                             };

                           ?> 

                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $evening_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')" value="<?php echo $evening_result['TimeSlotID']; ?>" > <?php echo $evening_result['TimeSlotName']; ?><br>
                           
                           <?php }; ?>
                           
                             
                          </div>



                             <?php 
                          if($Gender=='Female')
                          { ?>
                          
                           <div id="<?php echo 'divladies'.$i;?>">
                           
                           <?php
                           }
                           else
                           { ?> 
                           
                           <div id="<?php echo 'divladies'.$i;?>" style="display: none">

                           <?php };
                           ?>
                           <div class="col-md-4">
                           <h4>Ladies Only</h4>


                           <?php
                           $ladies_slot=mysqli_query($conn,"SELECT * FROM timeslots WHERE TimeSlotType='Ladies Only' AND Status='Active'");
                           while($ladies_result=mysqli_fetch_assoc($ladies_slot))
                           {

                             $tlsts=0;

                             $TID=$ladies_result['TimeSlotID'];
                             $tlqc="SELECT * FROM usercourtdetails WHERE TimeSlotID='$TID' AND UserID='$UserID' AND SportID='$SID'";
                             $tlqcr=mysqli_query($conn,$tlqc);
                             if(mysqli_num_rows($tlqcr)==1)
                             {

                             $tlsts=1;

                     
                             };

                           ?> 

                           <input type="radio" id="<?php echo 'timeslot'.$i; ?>" name="<?php echo 'timeslotradio'.$i;?>" onclick="addcount('<?php echo 'timeslot'.$i; ?>','<?php echo $ladies_result['TimeSlotID']; ?>','<?php echo 'timesloted'.$i;?>')" value="<?php echo $ladies_result['TimeSlotID']; ?>" <?php if($tlsts==1){?> checked <?php }?> > <?php echo $ladies_result['TimeSlotName']; ?><br>
                           
                           <?php }; ?>
                           
                             
                          </div><br>
                          </div><br>

                           

                        </div>
                        </div>

                      <?php }; 

                     $TIME="";
                     $COUR=""; 
              
                      }; ?>
                         
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
            Powered By <a href="">Orange</a>
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
