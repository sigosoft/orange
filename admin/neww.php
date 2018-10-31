<?php

session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };


$current = date('Y-m-d');



require 'db/config.php';





if(isset($_POST['submit']))
{
    
    
$id=$_POST['id'];
$durationfrom=$_POST['durationfrom'];
$durationto=$_POST['durationto'];
$Name=$_POST['Name'];
$Phone=$_POST['Phone'];
$place=$_POST['Place'];
$Gender=$_POST['Gender'];
$BloodGroup=$_POST['BloodGroup'];
$DOB=$_POST['DOB'];
$Occupation=$_POST['Occupation'];
$emergency=$_POST['phone'];
$nationality=$_POST['nationality'];
$MaritalStatus=$_POST['MaritalStatus'];
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

$validate=mysqli_query($conn,"SELECT * FROM users WHERE Phone='$Phone");

if(mysqli_num_rows($validate)<=0)
{



   $usercon="U";
    $target_dir = "../uploads/user/U"; //directory details
    
    $imageFileType = pathinfo($_FILES["UserImage"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $UserImage = $usercon.time().'.'.$imageFileType; //full path
   

    $target_dir1 = "../uploads/idcards/"; //directory details
    
    $imageFileType1 = pathinfo($_FILES["IDProof"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target1=$target_dir1.time().'1'.'.'.$imageFileType1;
    $IDProof = time().'1'.'.'.$imageFileType1; //full path 
    
     if(move_uploaded_file($_FILES["UserImage"]["tmp_name"], $target) &&  move_uploaded_file($_FILES["IDProof"]["tmp_name"], $target1) )
   
    {
   
    


$sql="INSERT into users(Name,Phone,Gender,UserImage,IdentityCard,BloodGroup,DOB,MaritalStatus,Occupation,id_no,durationfrom,	durationto,Place,emargency_no,nationality,height,weight,check1,check2,check3,check4,check5,check6,check7,healthdetails)VALUES('$Name','$Phone','$Gender','$UserImage','$IDProof',$BloodGroup','$DOB','$MaritalStatus','$Occupation','$id','$durationfrom','$durationto','$place','$emergency','$nationality','$height','$weight','$check','$check2','$check3','$check4','$check5','$check6','$check7','$healthdetails')";
;

if (mysqli_query($conn, $sql))
 {

    echo "<script> alert('Customer Added Successfully');window.location.href = 'manage_customer.php';</script>";
 } 

else 
{
  
    echo "<script> alert('Error');window.location.href = 'create_customer.php';</script>";
}
}
}
else
{

 echo "<script> alert('Upload Error');window.location.href = 'create_product.php';</script>";

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
                    <form method="POST"  data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

                     
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Full Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Name" class="form-control col-md-7 col-xs-12" name="Name" placeholder="Name" required="required" type="text">
                        </div>
                      </div>
                      
                      
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Address">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="Place" required="required" name="Place" class="form-control col-md-7 col-xs-12" rows="3"></textarea>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Phone"> Phone No. <span class="required">*</span>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DOB"> DOB <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="DOB" class="form-control col-md-7 col-xs-12" name="DOB" placeholder="DOB" required="required" type="date">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Gender">Gender<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" id="Gender" name="Gender" value="Male" checked onclick="showladies1();"> Male&nbsp&nbsp
                          <input type="radio" id="Gender" name="Gender" value="Female" onclick="showladies2();"> Female&nbsp&nbsp
                          
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nationality"> Nationality <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Occupation" class="form-control col-md-7 col-xs-12" name="nationality" placeholder="Nationality" required="required" type="text">
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
