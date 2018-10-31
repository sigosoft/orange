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

if(isset($_POST['submit']))
{



$TimeSlotName=$_POST['TimeSlotName'];
$TimeSlotType=$_POST['TimeSlotType'];
$TimeSlotIn=$_POST['TimeSlotIn'];
$TimeSlotOut=$_POST['TimeSlotOut'];


$sql="INSERT INTO timeslots(TimeSlotName, TimeSlotType, TimeSlotIn, TimeSlotOut, Status) VALUES ('$TimeSlotName', '$TimeSlotType','$TimeSlotIn', '$TimeSlotOut', 'Active')";


if (mysqli_query($conn, $sql))
 {
    echo "<script> alert('TimeSlot Added Successfully');window.location.href = 'manage_timeslots.php';</script>";
 } 

else 
{
    echo "<script> alert('Upload Error');window.location.href = 'create_timeslots.php';</script>";
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
    <!-- bootstrap-wysiwyg -->
    <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="vendors/starrr/dist/starrr.css" rel="stylesheet">
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
                <h3>Add Timeslot</h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Timeslot Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left">





                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="TimeSlotName"> Timeslot Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="TimeSlotName" class="form-control col-md-7 col-xs-12" name="TimeSlotName" placeholder="Timeslot Name" required="required" type="text">
                        </div>
                      </div>

                      
                      

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="TimeSlotType">Timeslot <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="radio" name="TimeSlotType" value="Morning" checked> Morning &nbsp&nbsp&nbsp
                           <input type="radio" name="TimeSlotType" value="Evening"> Evening &nbsp&nbsp&nbsp
                           <input type="radio" name="TimeSlotType" value="Ladies Only"> Ladies Only
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="TimeSlotIn"> Time In <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="TimeSlotIn" class="form-control col-md-7 col-xs-12" name="TimeSlotIn" placeholder="Time In" required="required" type="time">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="TimeSlotOut"> Time Out <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="TimeSlotOut" class="form-control col-md-7 col-xs-12" name="TimeSlotOut" placeholder="Time Out" required="required" type="time">
                        </div>
                      </div>


                     
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location.reload();">Cancel</button>
                          <input type="submit" name="submit" class="btn btn-success" value="Submit">
                        </div>
                      </div>
                    </form>

                 
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
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  
  </body>
</html>
