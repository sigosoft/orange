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




$sql="SELECT * FROM users WHERE UserID='$UserID'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$Sports="SELECT usercourtdetails.*, timeslots.* FROM usercourtdetails INNER JOIN timeslots ON usercourtdetails.TimeSlotID=timeslots.TimeSlotID WHERE usercourtdetails.UserID='$UserID'";
$SportResult=mysqli_query($conn,$Sports);









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
  </head>

  <body class="nav-md">


  <?php require 'partials/sidebar.php'; ?>

                       <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Customer Details</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>
            <div class="container " style="padding-top: 5%;">
            <div class="col-md-6">



            <table class="table" style="width: 50%;margin-left: 20%;">
  <thead>
    <tr>
     
    
    </tr>
  </thead>
  <tbody class="table-striped">
     <tr>
      <th scope="row"><strong>Register No</strong></th>
      <td><?php echo $row['RegisterNo'];?></td>
      
    </tr>
  <tr>
      <th scope="row"><strong>Name</strong></th>
      <td><?php echo $row['Name'];?></td>
      
    </tr>
    
  <!--  <tr>
      <th scope="row"><strong>Loyality Card</strong></th>
      <td><?php echo $row['LoyalityCard'];?></td>
      
    </tr>-->
    
    
    <tr>
      <th scope="row"><strong>Email</strong></th>
      <td><?php echo $row['Email'];?></td>
      
    </tr>
    <tr>
      <th scope="row"><strong>Mobile</strong></th>
      <td><?php echo $row['Phone'];?></td>
      
    </tr>

   
    <tr>
      <th scope="row"><strong>Place</strong></th>
      <td><?php echo $row['Place'];?></td>
      
    </tr>
    <tr>
      <th scope="row"><strong>Gender</strong></th>
      <td><?php echo $row['Gender'];?></td>
      
    </tr>

  <!--  <tr>
      <th scope="row"><strong>Customer Type</strong></th>
      <td><?php echo $row['CustomerType'];?></td>
      
    </tr>-->


  <tr>
      <th scope="row"><strong>Height</strong></th>
     
      <td><?php echo $row['height']; ?></td>
     
    </tr>
    
     <tr>
      <th scope="row"><strong>Weight</strong></th>
     
      <td><?php echo $row['weight']; ?></td>
     
    </tr>
    
    
     <tr>
      <th scope="row"><strong>Nationality</strong></th>
     
      <td><?php echo $row['nationality']; ?></td>
     
    </tr>
   

    <tr>
      <th scope="row"><strong>DOB</strong></th>
     
      <td><?php $DOB_date=$row['DOB'];
      echo date("jS F, Y", strtotime("$DOB_date"));
      ?></td>
     
    </tr>

<!--    <tr>
      <th scope="row"><strong>Notes</strong></th>
      <td><?php echo $row['Notes'];?></td>
      
    </tr>-->

     <tr>
    <th scope="row"><strong>Image</strong></th>
    <td><div class="col-md-12">
    <img src="../uploads/user/<?php echo $row['UserImage']; ?>" class="img-thumbnail" width="100%"/><br><br>
    </div></td>
    </tr>


  
  </tbody>
</table>
</div>
      <div class="col-md-6">



            <table class="table" style="width: 50%;margin-left: 20%;">
  <thead>
    <tr>
     
    
    </tr>
  </thead>
  <tbody class="table-striped">


      <tr>
      <th scope="row"><strong>BloodGroup</strong></th>
      <td><?php echo $row['BloodGroup'];?></td>
     
    </tr>
  
    <tr>
      <th scope="row"><strong>Marital Status</strong></th>
      <td><?php echo $row['MaritalStatus'];?></td>
      
    </tr>
    <tr>
      <th scope="row"><strong>Occupation</strong></th>
      <td><?php echo $row['Occupation'];?></td>
      
    </tr>

     <tr>
      <th scope="row"><strong>KnownFrom</strong></th>
      <td><?php echo $row['KnownFrom'];?></td>
      
    </tr>
    <tr>
      <th scope="row"><strong>Reffered By</strong></th>
      <td><?php echo $row['KnownFrom'];?></td>
      
    </tr>

    <tr>
      <th scope="row"><strong>Joined ON</strong></th>
      <td><?php $join_date=$row['Timestamp'];
      echo date("jS F, Y", strtotime("$join_date"));
      ?></td>
      
    </tr>

    <tr>
      <th scope="row"><strong>Payment Expires On</strong></th>

                         
      <td><?php $dated=$row['PaymentExpiryDate'];
      echo date("jS F, Y", strtotime("$dated"));
      ?></td>
      
    </tr>
     <tr>
      <th scope="row"><strong>Membership Duration From</strong></th>

                         
      <td><?php $durationfrom=$row['durationfrom'];
      echo date("jS F, Y", strtotime("$durationfrom"));
      ?></td>
      
    </tr>
    
     <tr>
      <th scope="row"><strong>Membership Duration To</strong></th>

                         
      <td><?php $durationto=$row['durationto'];
      echo date("jS F, Y", strtotime("$durationto"));
      ?></td>
      
    </tr>

    <tr>
      <th scope="row"><strong>Health Details</strong></th>
      <td><?php echo $row['healthdetails'];?></td>
      
    </tr>

 <!--   <tr>
      <th scope="row"><strong>Family Details</strong></th>
      <td><?php echo $row['FamilyDetails'];?></td>
      
    </tr>-->
    

    <tr>
    <th scope="row"><strong>ID Proof</strong></th>
    <td><div class="col-md-12">
    <img src="../uploads/idcards/<?php echo $row['IdentityCard']; ?>" class="img-thumbnail" width="100%"/><br><br>
    </div></td>
    </tr>


 


  
  </tbody>
</table>
</div>
</div>

<div class="container" style="padding: 5%;">
<div class="row">
    <table class="table">
    <thead>
      <tr>
        <th>Sports Name</th>
        <th>Timeslot</th>
        <th>Court</th>
        
      </tr>
    </thead>
    <tbody>

     <?php 
     while($data=mysqli_fetch_assoc($SportResult))
    {

     ?>
 
      <tr>
        <td><?php echo $data['SportName'];?></td>
        <td><?php echo $data['TimeSlotName'];?></td>
        <?php $CourtID=$data['CourtID'];

         $court=mysqli_query($conn,"SELECT CourtName FROM court WHERE CourtID='$CourtID'");
         $list=mysqli_fetch_assoc($court);
         $CourtName=$list['CourtName'];?>
         <td><?php echo $CourtName; ?></td>
      
  


      </tr>
      <?php }; ?>
    </tbody>
  </table>


</div>
  
</div>



<div class="container" style="padding: 2%;">
<h4>Customer Payment Details</h4><br>

<div class="row">
    <table class="table">
    <thead>
      <tr>
        <th>Payment Type</th>
        <th>Timespan</th>
        <th>Amount</th>
        <th>Paid On</th>
        <th>Expires On</th>
        
      </tr>
    </thead>
    <tbody>

     <?php 
     $query_payment=mysqli_query($conn,"SELECT * FROM payment_history WHERE MemberID='$UserID'");
     while($data_pay=mysqli_fetch_assoc($query_payment))
    {

     ?>
 
      <tr>
        <td><?php echo $data_pay['Sports'];?></td>
        <td><?php echo $data_pay['TimeSpan'];?></td>
        <td><?php echo $data_pay['Amount'];?></td>
        <td><?php $paid_on=$data_pay['Timestamp'];
      echo date("jS F, Y", strtotime("$paid_on"));
      ?></td>
      <td><?php $expire_date=$data_pay['PaymentExpiryDate'];
      echo date("jS F, Y", strtotime("$expire_date"));
      ?></td>
     
      
  


      </tr>
      <?php }; ?>
    </tbody>
  </table>


</div>
  
</div>



        <!-- </div> -->
        </div>
        </div>

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered By <a href="">Orange</a>
          </div>
          <div class="clearfix"></div>
        </footer>
    

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
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