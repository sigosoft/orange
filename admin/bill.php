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

$query=mysqli_query($conn,"SELECT * FROM sporttype WHERE Status='Active'");



$querymember=mysqli_query($conn,"SELECT * FROM sporttype WHERE Status='Active'");



if(isset($_POST['guest']))
{


$CustomerType=$_POST['SelectedType'];
$GuestName=$_POST['GuestName'];
$GuestMobile=$_POST['GuestMobile'];
$GuestEmail=$_POST['GuestEmail'];
$GuestSports=$_POST['GuestSports'];
$GuestTimeSpan=$_POST['GuestTimeSpan'];
$GuestAmount=$_POST['GuestAmount'];
$FromDate=$_POST['GuestDate'];
$GuestDays=$_POST['GuestDays'];
$GuestTotal=$_POST['GuestTotal'];

$GuestGST=$_POST['GuestGST'];

$GuestState=$_POST['GuestState'];
$GuestAddress=$_POST['GuestAddress'];




$GuestTax=$GuestTotal*(18/100);

$GuestGrand=$GuestTotal+$GuestTax;


 $dated_to=strtotime('+ ' . $GuestDays . ' days', strtotime($FromDate));
 $ToDate=date('Y-m-d',$dated_to);



$sql="INSERT INTO payment_history(CustomerType, Name, Mobile, Email, Sports, TimeSpan, Amount, Tax, Grandtotal, CustomerGST,  PaymentExpiryDate, Address, State,msg_status) VALUES ('$CustomerType', '$GuestName','$GuestMobile', '$GuestEmail','$GuestSports', '$GuestTimeSpan','$GuestTotal', '$GuestTax', '$GuestGrand', '$GuestGST', '$current', '$GuestAddress', '$GuestState',1)";


 

if (mysqli_query($conn, $sql))
 {
 $paymentid=mysqli_insert_id($conn);
 
$last_invoice=mysqli_query($conn,"SELECT * FROM last_invoice WHERE LastID=1");
$last_row=mysqli_fetch_assoc($last_invoice);
$Invce=$last_row['LInvoiceNo'];
$Invce1=$Invce+1;

$invoice='CE'.$Invce1;

$sql1=mysqli_query($conn,"UPDATE payment_history SET invoice_no = '$invoice' WHERE PaymentID='$paymentid';");
$sql2=mysqli_query($conn,"UPDATE last_invoice SET LInvoiceNo = '$Invce1' WHERE LastID=1;");


    $ledger=mysqli_query($conn,"INSERT INTO ledger(LedgerDate, Amount, Type, Mode) VALUES ('$current', '$GuestGrand', 'Credit', 'Payment')");

 


      $query_rent=mysqli_query($conn,"INSERT INTO court_rent(BookType, FromDate, ToDate, Days, Name, Mobile, Email, SportsName, AmountPaid, paymentid) VALUES ('$GuestTimeSpan', '$FromDate', '$ToDate', '$GuestDays', '$GuestName', '$GuestMobile', '$GuestEmail', '$GuestSports','$GuestGrand', '$paymentid')");
    


    echo "<script> alert('Processing');window.location.href = 'guestbill.php?id=$paymentid';</script>";
 } 

else 
{

    echo "<script> alert('Upload Error');window.location.href = 'bill.php';</script>";
}

};



if(isset($_POST['custom']))
{


$CustomerType=$_POST['SelectedType'];
$CustomName=$_POST['CustomName'];
$CustomMobile=$_POST['CustomMobile'];
$CustomEmail=$_POST['CustomEmail'];
$BillName=$_POST['BillName'];

$CustomGST=$_POST['CustomGST'];


$CustomTotal=$_POST['CustomTotal'];

$CustomTax=$CustomTotal*(18/100);

$CustomGrand=$CustomTotal+$CustomTax;


$CustomState=$_POST['CustomState'];
$CustomAddress=$_POST['CustomAddress'];



$sql="INSERT INTO payment_history(CustomerType, Name, Mobile, Email, BillName, Amount, Tax, Grandtotal, CustomerGST, Address, State) VALUES ('$CustomerType', '$CustomName','$CustomMobile', '$CustomEmail','$BillName', '$CustomTotal', '$CustomTax', '$CustomGrand', '$CustomGST', '$CustomAddress', '$CustomState')";


 

if (mysqli_query($conn, $sql))
 {
 $paymentid=mysqli_insert_id($conn);
 
$last_invoice=mysqli_query($conn,"SELECT * FROM last_invoice WHERE LastID=1");
$last_row=mysqli_fetch_assoc($last_invoice);
$Invce=$last_row['LInvoiceNo'];
$Invce1=$Invce+1;

$invoice='CE'.$Invce1;

$sql1=mysqli_query($conn,"UPDATE payment_history SET invoice_no = '$invoice' WHERE PaymentID='$paymentid';");
$sql2=mysqli_query($conn,"UPDATE last_invoice SET LInvoiceNo = '$Invce1' WHERE LastID=1;");

    $ledger=mysqli_query($conn,"INSERT INTO ledger(LedgerDate, Amount, Type, Mode) VALUES ('$current', '$CustomGrand', 'Credit', 'Payment')");

 


      
    


    echo "<script> alert('Processing');window.location.href = 'custombill.php?id=$paymentid';</script>";
 } 

else 
{
echo mysqli_error($conn);
die;
    echo "<script> alert('Upload Error');window.location.href = 'bill.php';</script>";
}

};



if(isset($_POST['membersub']))
{


$SelectedTypememb=$_POST['SelectedTypememb'];
$Name=$_POST['Name'];
$Mobile=$_POST['Mobile'];
$Email=$_POST['Email'];
$Sports=$_POST['Sports'];
$TimeSpan=$_POST['TimeSpan'];
$MemberID=$_POST['MemberID'];
$RegisterNo=$_POST['RegisterNo'];
$Amount=$_POST['Amount'];
$pay_type=$_POST['pay_type'];
$payment_expiry=$_POST['payment_expiry'];
$memberGST=$_POST['memberGST'];

$MemberState=$_POST['MemberState'];
$MemberAddress=$_POST['MemberAddress'];

$get_date=$_POST['get_date'];

$Tax=$Amount*(18/100);

$Grand=$Amount+$Tax;

if($pay_type=='New')
{
  $date=$get_date;
}
else
{
  $date=$payment_expiry;
}



 if($TimeSpan=='Daily')
 {

 $PaymentExpiryDate=$current;

 }
 elseif($TimeSpan=='Monthly')
 {

 
 $dated=strtotime('+30 days', strtotime($date));
 $PaymentExpiryDate=date('Y-m-d',$dated);

 }
 
  elseif($TimeSpan=='3 Month')
 {

 
 $dated=strtotime('+90 days', strtotime($date));
 $PaymentExpiryDate=date('Y-m-d',$dated);

 }
 
  elseif($TimeSpan=='6 Month')
 {

 
 $dated=strtotime('+180 days', strtotime($date));
 $PaymentExpiryDate=date('Y-m-d',$dated);

 }
 
 
 elseif($TimeSpan=='1 Year')
 {

  
  $dated=strtotime('+365 days', strtotime($date));

  $PaymentExpiryDate=date('Y-m-d',$dated);


 }

 elseif($TimeSpan=='3 Year')
 {

 
  $dated=strtotime('+1095 days', strtotime($date));

  $PaymentExpiryDate=date('Y-m-d',$dated);


 }

 elseif($TimeSpan=='5 Year')
 {

  
  $dated=strtotime('+1825 days', strtotime($date));

  $PaymentExpiryDate=date('Y-m-d',$dated);


 }
 elseif($TimeSpan=='10 Year')
 {

 
  $dated=strtotime('+3650 days', strtotime($date));

  $PaymentExpiryDate=date('Y-m-d',$dated);


 }
   elseif($TimeSpan=='15 Year')
 {


  $dated=strtotime('+5475 days', strtotime($date));

  $PaymentExpiryDate=date('Y-m-d',$dated);


 }
 elseif($TimeSpan=='Life Time')
 {


  

  $PaymentExpiryDate=" ";


 };




$sql="INSERT INTO payment_history(CustomerType, MemberID, RegisterNo, Name, Mobile, Email, Sports, TimeSpan, Amount, Tax, Grandtotal, CustomerGST, PaymentExpiryDate, Address, State, msg_status) VALUES ('$SelectedTypememb', '$MemberID', '$RegisterNo', '$Name','$Mobile', '$Email','$Sports', '$TimeSpan','$Amount', '$Tax', '$Grand', '$memberGST', '$PaymentExpiryDate','$MemberAddress', '$MemberState',1)";






if (mysqli_query($conn, $sql))
 {

  $paymentid=mysqli_insert_id($conn);
  
$last_invoice=mysqli_query($conn,"SELECT * FROM last_invoice WHERE LastID=1");
$last_row=mysqli_fetch_assoc($last_invoice);
$Invce=$last_row['LInvoiceNo'];
$Invce1=$Invce+1;

$invoice='CE'.$Invce1;

$sql1=mysqli_query($conn,"UPDATE payment_history SET invoice_no = '$invoice' WHERE PaymentID='$paymentid';");
$sql2=mysqli_query($conn,"UPDATE last_invoice SET LInvoiceNo = '$Invce1' WHERE LastID=1;");


  
   if($Sports=='Family Membership')
  {

  $query=mysqli_query($conn,"INSERT INTO family_membership(Type, MemberID, PaymentID) VALUES ('Primary','$MemberID','$paymentid')"); 

 

  };
    
    $update=mysqli_query($conn,"UPDATE users SET PaymentExpiryDate='$PaymentExpiryDate', CustomerType='$Sports', SQLStatus=2 WHERE UserID='$MemberID'");
     $ledger=mysqli_query($conn,"INSERT INTO ledger(LedgerDate, Amount, Type, Mode) VALUES ('$current', '$Amount', 'Credit', 'Payment')");
    echo "<script> alert('Processing');window.location.href = 'memberbill.php?id=$paymentid';</script>";
 } 

else 
{
    echo "<script> alert('Upload Error');window.location.href = 'bill.php';</script>";
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
                <h3>Bill</h3>
              </div>

          
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bill Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>



                  <div class="x_content">
                    <br />

                    <div>
                      

                    </div>

                    <div id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">

                          <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="UserType">User Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" id="UserType" name="UserType" value="Guest"  onclick="guest();" checked> Guest&nbsp&nbsp
                          <input type="radio" id="UserType" name="UserType" class="Member"  onclick="member();" value="Member"> Member&nbsp&nbsp
                          <input type="radio" id="UserType" name="UserType" class="Member"  onclick="custom();" value="Member"> Custom Bill&nbsp&nbsp
                         
                        </div>
                      </div>
                       

                        <div id="div1">
                        <form method="POST">



                         <input type="hidden" name="SelectedType" value="Guest">

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestName"> Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestName" class="form-control col-md-7 col-xs-12" name="GuestName" placeholder="Name" required="required" type="text">
                        </div>
                      </div>
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestMobile"> Mobile <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestMobile" class="form-control col-md-7 col-xs-12" name="GuestMobile" placeholder="Mobile" required="required" type="number">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestEmail"> Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestEmail" class="form-control col-md-7 col-xs-12" name="GuestEmail" placeholder="Email" required="required" type="email">
                        </div>
                      </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestSports"> Sport Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="GuestSports" class="form-control col-md-7 col-xs-12" name="GuestSports" onchange="GetPrice('GuestSports','GuestTimeSpan','GuestAmount')">

                          <?php 
                          while($row=mysqli_fetch_assoc($query))
                          { 

                          ?>  
                          <option value="<?php echo $row['SportName']?>"><?php echo $row['SportName']?></option>  
                        
                          
                          <?php }; ?>

                         
                          </select>
                          
                        </div>
                      </div>

                      



                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestTimeSpan"> Time Span <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="GuestTimeSpan" class="form-control col-md-7 col-xs-12" name="GuestTimeSpan"  onchange="GetPrice('GuestSports','GuestTimeSpan','GuestAmount')">
 
                          <option value="Daily">Daily</option>  
                          <option value="Rent">Rent</option>   
                     
                        
                          
                        
                          </select>
                          
                        </div>
                      </div>


                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestAmount"> Amount Per Day <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestAmount" class="form-control col-md-7 col-xs-12" onchange="grandtotal()" name="GuestAmount" placeholder="Amount" required="required" type="number" readonly>
                        </div>
                      </div>

                    
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestDate"> Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestDate" class="form-control col-md-7 col-xs-12" name="GuestDate" required="required" type="date">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestDays"> No Of Days <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestDays" class="form-control col-md-7 col-xs-12" name="GuestDays" onchange="grandtotal()" placeholder ="No Of Days" required="required" type="number">
                        </div>
                      </div>
                   
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestTotal"> Grand Total<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestTotal" class="form-control col-md-7 col-xs-12" name="GuestTotal" placeholder="Grand Total" required="required" type="number" readonly>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestGST"> Customer GST Number <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestGST" class="form-control col-md-7 col-xs-12" name="GuestGST" placeholder="Customer GST Number" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Address"> Address <span class="required"></span>
                        </label>


                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="GuestAddress" class="form-control col-md-7 col-xs-12" rows="6" name="GuestAddress" placeholder="Address" required="required"></textarea>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestState"> State <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestState" class="form-control col-md-7 col-xs-12" name="GuestState" placeholder="State" required="required" type="text">
                        </div>
                      </div>
                     
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location.reload();">Cancel</button>
                          <input type="submit" name="guest" class="btn btn-success" value="Submit">
                        </div>
                      </div>
                      </div>

                      </form>
                    </div>



                        <div id="div2" style="display: none">
                          <div id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">
                        <form method="POST">

                          <input type="hidden" name="SelectedTypememb" value="Member">

                        
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="RegisterNo"> Register No <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="RegisterNo" class="form-control col-md-7 col-xs-12" onchange="GetMember();" name="RegisterNo" placeholder="RegisterNo" required="required" type="text">
                        </div>
                      </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name"> Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Name" class="form-control col-md-7 col-xs-12" name="Name" placeholder="Name" required="required" type="text" readonly>
                        </div>
                      </div>
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mobile"> Mobile <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Mobile" class="form-control col-md-7 col-xs-12" name="Mobile" placeholder="Mobile" required="required" type="number" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Email"> Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Email" class="form-control col-md-7 col-xs-12" name="Email" placeholder="Email" required="required" type="email" readonly>
                        </div>
                      </div>

                      <input type="hidden" name="MemberID" id="MemberID">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_expiry"> Payment Expires On <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="payment_expiry" class="form-control col-md-7 col-xs-12" name="payment_expiry" placeholder="payment_expiry" type="text" readonly>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="get_date"> Start Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="get_date" class="form-control col-md-7 col-xs-12" name="get_date" placeholder="get_date" type="date">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pay_type">Payment<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" id="pay_type" name="pay_type" value="New" checked> New
                          <input type="radio" id="pay_type" name="pay_type" class="Renew" > Renew&nbsp&nbsp
                         
                        </div>
                      </div> 

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Sports"> Sport Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="Sports" class="form-control col-md-7 col-xs-12" name="Sports" onchange="GetPrice('Sports','TimeSpan','Amount')">

                            <option value="Club Member">Club Member</option>
                            <option value="Family Membership">Family Membership</option>
                            <option value="Ladies Only Membership">Ladies Only Membership</option>
                            <option value="Couple Membership">Couple Membership</option>
                            <option value="Senior Citizen Membership">Senior Citizen Membership</option>
                            <option value="Kids Coaching">Kids Coaching</option>

                          <?php 
                          while($rowmember=mysqli_fetch_assoc($querymember))
                          { 

                          ?>  
                          <option value="<?php echo $rowmember['SportName']?>"><?php echo $rowmember['SportName']?></option>  
                        
                          
                          <?php }; ?>

                          
                          </select>
                          
                        </div>
                      </div>

                      
                      

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="TimeSpan"> Time Span <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="TimeSpan" class="form-control col-md-7 col-xs-12" name="TimeSpan"  onchange="GetPrice('Sports','TimeSpan','Amount')">
 
                         <!--  <option value="Daily">Daily</option> -->  
                         
                           <option value="Monthly">1 Month</option>
                          <option value="3 Month">3 Month</option>
                          <option value="6 Month">6 Month</option>   
                          <option value="1 Year">1 Year</option>  
                          <option value="3 Year">3 Year</option>  
                          <option value="5 Year">5 Year</option>  
                          <option value="10 Year">10 Year</option>  
                          <option value="15 Year">15 Year</option>
                          <option value="Life Time">Life Time</option>   
                        
                          
                        
                          </select>
                          
                        </div>
                      </div>


                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Amount"> Amount <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="Amount" class="form-control col-md-7 col-xs-12" name="Amount" placeholder="Amount" required="required" type="number" readonly>
                        </div>
                      </div>

                    

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="memberGST"> Customer GST Number <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="memberGST" class="form-control col-md-7 col-xs-12" name="memberGST" placeholder="Customer GST Number" required="required" type="text">
                        </div>
                      </div>


                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MemberAddress"> Address <span class="required"></span>
                        </label>


                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="MemberAddress" class="form-control col-md-7 col-xs-12" rows="6" name="MemberAddress" placeholder="Address" required="required"></textarea>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MemberState"> State <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="MemberState" class="form-control col-md-7 col-xs-12" name="MemberState" placeholder="State" required="required" type="text">
                        </div>
                      </div>
                     
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location.reload();">Cancel</button>
                          <input type="submit" name="membersub" class="btn btn-success" value="Submit">
                        </div>
                      </div>
                      </div>

                      </form>
                    </div>
                    
                    
                    
                      <div id="div3" style="display: none">
                        <form method="POST">

                         <div id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left"> 

                         <input type="hidden" name="SelectedType" value="Guest">

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CustomName"> Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="CustomName" class="form-control col-md-7 col-xs-12" name="CustomName" placeholder="Name" required="required" type="text">
                        </div>
                      </div>
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CustomMobile"> Mobile <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="CustomMobile" class="form-control col-md-7 col-xs-12" name="CustomMobile" placeholder="Mobile" required="required" type="number">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CustomEmail"> Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="CustomEmail" class="form-control col-md-7 col-xs-12" name="CustomEmail" placeholder="Email" required="required" type="email">
                        </div>
                      </div>


                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="BillName"> Bill Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="GuestEmail" class="form-control col-md-7 col-xs-12" name="BillName" placeholder="Bill Name" required="required" type="text">
                        </div>
                      </div>

                 

                   
                   
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GuestTotal"> Grand Total<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="CustomTotal" class="form-control col-md-7 col-xs-12" name="CustomTotal" placeholder="Grand Total" required="required" type="number">
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CustomGST"> Customer GST Number <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="CustomGST" class="form-control col-md-7 col-xs-12" name="CustomGST" placeholder="Customer GST Number" required="required" type="text">
                        </div>
                      </div> 

                              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MemberAddress"> Address <span class="required"></span>
                        </label>


                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="CustomAddress" class="form-control col-md-7 col-xs-12" rows="6" name="CustomAddress" placeholder="Address" required="required"></textarea>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CustomState"> State <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="CustomState" class="form-control col-md-7 col-xs-12" name="CustomState" placeholder="State" required="required" type="text">
                        </div>
                      </div>
                     
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location.reload();">Cancel</button>
                          <input type="submit" name="custom" class="btn btn-success" value="Submit">
                        </div>
                      </div>
                      </div>

                      </form>
                    </div>

                  
                </div>
              </div>
            </div>
            </div>

 


           
           


     
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        
          <div class="pull-right">
            Powered By <a href="">Orange</a>
          </div>
          <div class="clearfix"></div>
        
        <!-- /footer content -->
      </div>
    </div>

<script>
  
function grandtotal()
{


var GuestAmount = document.getElementById('GuestAmount').value;

var GuestDays = document.getElementById('GuestDays').value;




var GuestTotal= GuestDays*GuestAmount;



 document.getElementById('GuestTotal').value = GuestTotal;


}

</script>



    <script>
      
function member(){
     
     document.getElementById('div1').style.display ='none';
     document.getElementById('div2').style.display ='block';
     document.getElementById('div3').style.display ='none';
   }

function guest(){

   document.getElementById('div2').style.display ='none';
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div3').style.display ='none';
   }


   function custom(){

   document.getElementById('div3').style.display ='block';
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='none';
   }

    </script>


       <script>
       function GetMember()
       {

           var RegisterNo = document.getElementById('RegisterNo').value 



           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'GetMember.php' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           RegisterNo:RegisterNo

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);

             var check = temp.status;


             if(check=='Success')
             {
           
            document.getElementById('Name').value =temp.details.Name;
            document.getElementById('Mobile').value =temp.details.Phone;
            document.getElementById('Email').value =temp.details.Email;
            document.getElementById('payment_expiry').value =temp.details.PaymentExpiryDate;
            document.getElementById('MemberID').value =temp.details.UserID;
            
             }

            else
            {
            
            alert("NO RECORDS")
           
            }


           }

           }
           };




   
       

          
       }


   </script>

   <script>
     
     function GetPrice(sportdiv,timespandiv,amountdiv)
     {


     var sportdiv=sportdiv;
     var timespandiv=timespandiv;
     var amountdiv=amountdiv;

     var sport = document.getElementById(sportdiv).value;
     var timespan = document.getElementById(timespandiv).value;
   
   
     xhr = new XMLHttpRequest();
           xhr.open('POST' , 'GetPrice.php' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           sport:sport,
           timespan:timespan

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);

             var check = temp.status;

           


             if(check=='Success')
             {
           
            document.getElementById(amountdiv).value =temp.details.Amount;
           

            
            
             }

            else
            {
            
            alert("NO RECORDS")
           
            }


           }

           }
           };




   
       

          

     }

   </script>





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
