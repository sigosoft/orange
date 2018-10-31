<?php


 header('location:dash.php');


   require 'db/config.php';

    $date=strtotime(date('Y-m-d'));
    $newDate = date('Y-m-d',strtotime('+7 days',$date));
    
    
    
   // $PaymentID=$_GET['id'];
     
    $sql="SELECT * FROM payment_history WHERE PaymentExpiryDate='$newDate' AND msg_status='1'";
    $result=mysqli_query($conn,$sql);

 while( $row=mysqli_fetch_assoc($result))
 {
  
   $number=$row['Mobile'];
  
   
 /*   $authKey = "234958AaETodXa5b8a17a1";
	$senderId = "Orange";
	$route="4";
	$postData = array('authkey' => $authKey,'mobiles' => $number,'message' => hi,'sender' => $senderId,'route' =>$route);
	$url="http://api.msg91.com/api/sendhttp.php";
	$ch = curl_init();
	curl_setopt_array($ch, array(CURLOPT_URL => $url,CURLOPT_RETURNTRANSFER => true,CURLOPT_POST => true,CURLOPT_POSTFIELDS => $postData));
	$output = curl_exec($ch);
	if(curl_errno($ch)){
	echo 'error:' . curl_error($ch);
	}
	curl_close($ch);
//	$query2="update payment_history set msg_status='0'  where PaymentExpiryDate='$newDate'";
  //     mysqli_query($conn, $query2);
	return true;
	
//	print_r($number);*/



        $authKey = "234958AaETodXa5b8a17a1"; //Your Authentkation key
        $mobileNumber = $row['Mobile'];
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "Orange";
        $mymsg = "Your Payment Expiry Date Will End Soon";
        //Your message to send, Add URL encoding here.
        $message = urlencode("$mymsg");
        $route = "4";
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        //API URL provided by your SMS service provider
        $url = "http://api.msg91.com/api/sendhttp.php";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
        //return true;
        	$query2="update payment_history set msg_status='0'  where PaymentExpiryDate='$newDate'";
           mysqli_query($conn, $query2);
 
};
 
?>