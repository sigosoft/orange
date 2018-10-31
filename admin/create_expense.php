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

$query=mysqli_query($conn,"SELECT * FROM expense_category");

if(isset($_POST['submit']))
{



$ExpenseName=$_POST['ExpenseName'];
$Amount=$_POST['Amount'];
$Description=$_POST['Description'];
$ExpenseCategoryID =$_POST['ExpenseCategory'];
$ExpenseType=$_POST['ExpenseType'];





                        

$sql="INSERT INTO expense_table(ExpenseName, ExpenseDescription, Amount, ExpenseCategoryID,ExpenseType) VALUES ('$ExpenseName', '$Description', '$Amount','$ExpenseCategoryID','$ExpenseType')";


if (mysqli_query($conn, $sql))
 {
     $ExpenseID=mysqli_insert_id($conn);
    $ledger=mysqli_query($conn,"INSERT INTO ledger(LedgerDate, Amount, Type, Mode, ExpenseID) VALUES ('$current', '$Amount', 'Debit', 'Expense', '$ExpenseID')");
    echo "<script> alert('Expense Added Successfully');window.location.href = 'manage_expense.php';</script>";
 } 

else 
{
    echo "<script> alert('Upload Error');window.location.href = 'create_expense.php';</script>";
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
                <h3>Add Expense</h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Expense Details</h2>
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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ExpenseType"> Expense Type <span class="required">*</span>
                           </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="radio" name="ExpenseType" value="Club" checked> Club &nbsp&nbsp&nbsp
                           <input type="radio" name="ExpenseType" value="Cafe"> Cafe
                           </div>
                           </div>

                     
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ExpenseCategory"> Expense Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="ExpenseCategory" class="form-control col-md-7 col-xs-12" name="ExpenseCategory">

                          <?php 
                          while($row=mysqli_fetch_assoc($query))
                          { 
          
                          ?>  
                          <option value="<?php echo $row['ExpenseCategoryID']; ?>" ><?php echo $row['ExpenseCategoryName']; ?></option>  
                        
                          
                          <?php }; ?>
                          </select>
                          
                        </div>
                      </div>



                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ExpenseName"> Expense Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="ExpenseName" class="form-control col-md-7 col-xs-12" name="ExpenseName" placeholder="Expense Name" required="required" type="text">
                        </div>
                      </div>

                      
                      

                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Amount"> Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Amount" class="form-control col-md-7 col-xs-12" name="Amount" placeholder="Amount" required="required" type="number">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description"> Description <span class="required"></span>
                        </label>


                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="Description" class="form-control col-md-7 col-xs-12" rows="10" name="Description" placeholder="Description" required="required"></textarea>
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
