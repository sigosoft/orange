<?php 

include 'android_connection.php';

include 'estadio_conn.php';

$order_no=$_POST['order_no'];

$customer_id=$_POST['customer_id'];
$grand_total=$_POST['grand_total'];
$total=$_POST['total'];

$GST=$_POST[GST];

$CGST=$GST/2;
$SGST=$GST/2;



$data=$_POST['data'];

$WalletReduction=$_POST['WalletReduction'];

date_default_timezone_set('Asia/Kolkata');
$current = date('Y-m-d');

$json = json_decode($data, true);

$elementCount  = count($json);

$user_type=$_POST['user_type'];







$bill=mysqli_query($conn,"SELECT * FROM last_bill WHERE LastBillID='1'");

$billRow=mysqli_fetch_assoc($bill);
$Lastbill=$billRow['LastBill'];

$invoice_no=$Lastbill+1;

if($user_type=='Guest')
{


$sql="INSERT INTO orders(order_no, invoice_no, user_type, total, grand_total, CGST, SGST) VALUES ('$order_no', '$invoice_no', 'Guest', '$total' , '$grand_total', '$CGST','$SGST')";


if (mysqli_query($conn, $sql))
 {
    
   $order_id=mysqli_insert_id($conn);




   for ($i=0;$i < $elementCount; $i++) 
   {

    $product_id = $json[$i]['product_id'];
    $product_name = $json[$i]['product_name'];
    $quantity = $json[$i]['quantity'];
    $unit_price = $json[$i]['unit_price'];
    $packet_size = $json[$i]['packet_size'];
    $total_price = $json[$i]['total_price'];




    $order="INSERT INTO order_items(order_id, product_id, product_name, quantity, unit_price, packet_size, total_price) VALUES ('$order_id', '$product_id', '$product_name', '$quantity', '$unit_price', '$packet_size', '$total_price')";

    mysqli_query($conn,$order);


   }

   $updateCount=mysqli_query($conn,"UPDATE last_bill SET LastBill='$invoice_no' WHERE LastBillID='1'");
   $pass['Status']="Success";
   $pass['Invoice']=$invoice_no;



 } 

else 
{
echo mysqli_error($conn);
$pass['Status']="Failed";
$pass['Invoice']="0";

}

}



else
{

$sql="INSERT INTO orders(order_no, invoice_no, user_type, customer_id, total, grand_total, CGST, SGST) VALUES ('$order_no', '$invoice_no', 'Customer', '$customer_id', '$total' , '$grand_total', '$CGST','$SGST')";


if (mysqli_query($conn, $sql))
 {
    
   $order_id=mysqli_insert_id($conn);

   if($WalletReduction>0)
   {


       $wallet_red =mysqli_query($estadio_conn,"UPDATE customer_wallet SET Amount=Amount-'$WalletReduction' WHERE UserID='$customer_id'");
   
       $wallet_red_insert=mysqli_query($estadio_conn,"INSERT INTO wallet_reduction(UserID, OrderID, Amount, TransName) VALUES ('$customer_id', '$order_id', '$WalletReduction', 'Cafe')");




   };




   $json = json_decode($data, true);

   $elementCount  = count($json);


   for ($i=0;$i < $elementCount; $i++) 
   {

    $product_id = $json[$i]['product_id'];
    $product_name = $json[$i]['product_name'];
    $quantity = $json[$i]['quantity'];
    $unit_price = $json[$i]['unit_price'];
    $packet_size = $json[$i]['packet_size'];
    $total_price = $json[$i]['total_price'];




    $order="INSERT INTO order_items(order_id, product_id, product_name, quantity, unit_price, packet_size, total_price, customer_id) VALUES ('$order_id', '$product_id', '$product_name', '$quantity', '$unit_price', '$packet_size', '$total_price', '$customer_id')";

    mysqli_query($conn,$order);


   }

    $updateCount=mysqli_query($conn,"UPDATE last_bill SET LastBill='$invoice_no' WHERE LastBillID='1'");
  
   $pass['Status']="Success";
   $pass['Invoice']=$invoice_no;


 } 

else 
{


$pass['Status']="Failed";
$pass['Invoice']="0";

}

}	

print_r(json_encode($pass));



?>