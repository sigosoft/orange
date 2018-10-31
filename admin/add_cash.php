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



$LoyalityCard=$_POST['LoyalityCard'];


$query=mysqli_query($conn,"SELECT * FROM users WHERE LoyalityCard='$LoyalityCard'");
if(mysqli_num_rows($query)>0)
{
  
$status="True";

$row=mysqli_fetch_assoc($query);
$Name=$row['Name'];
$UserID=$row['UserID'];
$RegisterNo=$row['RegisterNo'];
$UserID=$row['UserID'];

$GetWallet=mysqli_query($conn,"SELECT * FROM customer_wallet WHERE UserID='$UserID'");
$Getrow=mysqli_fetch_assoc($GetWallet);

$currentWallet=$Getrow['Amount'];


} 

else 
{

  $status="False";
  echo "<script> alert('Card Not Found');window.location.href = 'add_cash.php';</script>";
}

};


if(isset($_POST['add']))
{


    $MemberID=$_POST['UserID'];
    $Amount=$_POST['Amount'];
    
    
    $insert_referal="UPDATE customer_wallet SET Amount=Amount+'$Amount' WHERE UserID='$MemberID'";
    
    if (mysqli_query($conn, $insert_referal))
    {

    $wallet_red_insert=mysqli_query($conn,"INSERT INTO wallet_reduction(UserID, Amount, Type, TransName) VALUES ('$MemberID', '$Amount','Credit', 'Wallet')");
    
    echo "<script> alert('Amount Added To Wallet');window.location.href = 'add_cash.php';</script>";
    
    }
    else
    {
        
     echo "<script> alert('Error');window.location.href = 'add_cash.php';</script>"; 
        
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
                <h3></h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

       

 

           <?php if($status=='True') 
           {
           ?>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Cash To Wallet</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Name" class="form-control col-md-7 col-xs-12" name="Name" placeholder="Name" required="required" value="<?php echo $Name; ?>" type="text" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="RegisterNo">Register No<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="RegisterNo" class="form-control col-md-7 col-xs-12" name="RegisterNo" placeholder="Register No" required="required" value="<?php echo $RegisterNo; ?>" type="text" readonly>
                        </div>
                      </div>

                      <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currentWallet">Available Balance<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="currentWallet" class="form-control col-md-7 col-xs-12" name="currentWallet" placeholder="Available Balance" required="required" value="<?php echo $currentWallet; ?>" type="text" readonly>
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currentWallet"> Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Amount" class="form-control col-md-7 col-xs-12" name="Amount" placeholder="Amount" required="required" type="number" >
                        </div>
                      </div>


                        <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location.reload();">Cancel</button>
                          <input type="submit" name="add" class="btn btn-success" value="Add">
                        </div>
                      </div>
                    </form>

         
              <?php } 
              else
              {
              ?>
                       

                   <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Cash To Wallet</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="LoyalityCard">Loyality Card<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="LoyalityCard" class="form-control col-md-7 col-xs-12" name="LoyalityCard" placeholder="Loyality Card" required="required" type="text">
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
            
            <?php }; ?>
                     
                      

                    



                 




                 
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
