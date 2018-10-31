<?php

$PaymentID=$_GET['id'];

require 'db/config.php';

date_default_timezone_set('Asia/Kolkata');
$current = date('d-m-Y');


$sql="SELECT * FROM payment_history WHERE PaymentID='$PaymentID'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$tax=$row['Tax']/2;

$query="SELECT * FROM court_rent WHERE PaymentId='$PaymentID'";
$resulter=mysqli_query($conn,$query);
$data=mysqli_fetch_assoc($resulter);



?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>invoice</title>
    
    <style>
    .invoice-box {
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: rignt;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(3) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(4) {
        text-align: right;
    }
		.text-center{text-align: center;}
		.text-right{text-align: right;}
		.text-left{text-align: left;}
        body { margin: 0px;padding: 0;font: 12pt "Tahoma"; }
    * {box-sizing: border-box;-moz-box-sizing: border-box;}
	.main{padding: 15px;}
	.row {margin-left:0; margin-right:0;}
	.row:before,
	.row:after{
  		display: table;content: " ";}
	.row:after {clear: both;}
	.col-md-12 {width: 100%; float: left; padding: 0 10px;}
	.col-md-8 {width: 66.66%; float: left; padding: 0 10px;}
	.col-md-7 {width: 58.33333333%; float: left; padding: 0 10px;}
	.col-md-6 {width: 50%; float: left; padding: 0 10px;}
	.col-md-5 {width: 41.66666667%; float: left; padding: 0 10px;}
	.col-md-4 {width: 33.33%; float: left; padding: 0 10px;}
	.col-md-3 {width: 25%; float: left; padding: 0 10px;}
	.fr{float: right;}
	.fl{float: left;}
	.fwn{font-weight: normal;}
	.content h4{ font-size: 13px; margin: 6px 0;}
	.content tr{font-size: 13px;}
	.content td{font-size: 13px; text-align: center;}
	.header{text-align: center;}
	.header img{ width: 200px; margin: auto;}
	.header p{margin-top: 7px;}
	.text-center{text-align: center;}
	table, th border-collapse: collapse;}
	table, td{ border-collapse: collapse;}
	th, td {padding: 5px;}
	.rr p{ font-size: 12px;}
</style>
<style type="text/css" media="print">
@page {
    size: auto;
    margin: 29px; 
}
</style>
</head>

<body onload="test()">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
                <td colspan="4s">
                    <table class="row">
                        <tr>
                            <td class="title col-md-6">
                                <img src="images/LOGO.png" style="width:100%; max-width:200px;">
                            </td>
                            
                            <td class="col-md-6 text-right">
                               <h1>Invoice</h1>
                               <!--<h3>GST No: 32AAFFE1727R1Z9</h3>-->
        						<h4>Date: <?php echo $current;?></h4>
                            </td>
                        </tr>
                    </table>
                </td>
            
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Orange Fit Club<br>
                                Malabar Arcade,Pantheerankave, Kozhikode.<br>
                                
                            </td>
                            
                            <td class="text-right">
                                Name: <?php echo $row['Name'];?><br>
                                Mobile: <?php echo $row['Mobile'];?><br>
                                Email: <?php echo $row['Email'];?><br>
                                Register No: <?php echo $row['RegisterNo'];?><br>
                                Customer GST No: <?php echo $row['CustomerGST'];?><br>
                                Address: <?php echo str_replace(',', '<br />', $row['Address']);?><br>
                                State: <?php echo $row['State'];?><br>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            <td colspan="4">
            <tr class="heading">
                <td>
                    Sports Name
                </td>
                <td>
                    Time Span
                </td>
                 <td>
                    Payment Expiry Date
                </td>
                <td class="text-right">
                    Price
                </td>
               
            </tr>
            
            <tr class="item">
                <td>
                   <?php echo $row['Sports'];?>
                </td>
                <td>
                    <?php echo $row['TimeSpan'];?>
                </td>
                
                <td>
                   <?php
                 
                   $PaymentDate = $row['PaymentExpiryDate'];
                   $newPaymentDate = date("d-m-Y", strtotime($PaymentDate));

                   echo $newPaymentDate;


                   ?> 
                </td>

                <td class="text-right">
                   <?php echo $row['Amount'];?> INR
                </td>
            </tr>
            
         
            
            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right">
                  <strong>SGST @ 9%: <?php echo $tax;?> INR</strong><br>
                  <strong>CGST @ 9%: <?php echo $tax;?> INR</strong><br> 
                   <strong>Grand Total: <?php echo $row['Grandtotal'];?> INR</strong><br>
                </td>
            </tr>
                </td>
                </tr>
        </table>
        
    </div>

<script type="text/javascript">

  function test()
  {
    window.print();
  alert('Success');window.location.href = 'bill.php';
   }
    
      </script>


</body>
</html>
