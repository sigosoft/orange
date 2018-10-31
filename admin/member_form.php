<?php

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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
</head>
<style>
    body { margin: 0px;padding: 0;font: 12pt "Tahoma"; }
    * {box-sizing: border-box;-moz-box-sizing: border-box;}
	.main{padding: 15px;}
	.row {margin-left:0; margin-right:0;}
	.row:before,
	.row:after{
  		display: table;content: " ";}
	.row:after {clear: both;}
	.col-md-12 {width: 100%; float: left; padding: 0 15px;}
	.col-md-8 {width: 66.66%; float: left; padding: 0 15px;}
	.col-md-6 {width: 50%; float: left; padding: 0 15px;}
	.col-md-4 {width: 33.33%; float: left; padding: 0 15px;}
	.col-md-3 {width: 25%; float: left; padding: 0 15px;}
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
	table, th{border-bottom: 2px solid #2B2B2B; border-collapse: collapse;}
	table, td{border-bottom: 1px solid #2B2B2B; border-collapse: collapse;}
	th, td {padding: 5px;}
	.rr p{ font-size: 12px;}
</style>
<style type="text/css" media="print">
@page {
    size: auto;
    margin: 10px; 
}
</style>
<body onload="test()">
<section class="main" id="divToPrint">
        	<div class="header">
        		<img src="images/LOGO.png">
        		<p> <strong>Orange Fit Club<br>Malabar Arcade<br>Kozhikode. </strong></p>
        	</div>
        	<div class="content">
        		<div class="row">
        			<div class="col-md-4"><h4>Registration No</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['RegisterNo'];?></h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Name</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['Name'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Phone</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['Phone'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Email</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['Email'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Gender</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['Gender'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Place</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['Place'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>DOB</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['DOB'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Marital Status</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['MaritalStatus'];?> </h4></div>
        		</div>
        	<!--	<div class="row">
        			<div class="col-md-4"><h4>Notes</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['Notes'];?></h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Family Details</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['FamilyDetails'];?></h4></div>
        		</div>-->
        		<div class="row">
        			<div class="col-md-4"><h4>Occupation</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['Occupation'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>MemberShip Duration From</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['durationfrom'];?> </h4></div>
        		</div>
        		
        			<div class="row">
        			<div class="col-md-4"><h4>MemberShip Duration To </h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['durationto'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Known From</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['KnownFrom'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-4"><h4>Blood Group</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['BloodGroup'];?> </h4></div>
        		</div>
        		<!--	<div class="row">
        			<div class="col-md-4"><h4>Sport Type</h4></div><div class="col-md-8"><h4 class="fl fwn"><?php echo $row['BloodGroup'];?> </h4></div>
        		</div>
        		<div class="row">
        			<div class="col-md-12"><h4 >Sports Details</h4></div>
        			
        				<table width="100%">

        
  							<tr>
    							<th>Sports Name</th>
    						<!--	<th>Time</th>
    							<th>Session</th>
    							<th>Court</th>
  							</tr>

                             <?php 
         while($data=mysqli_fetch_assoc($SportResult))
         {
         ?>
  							<tr>
    							<td><?php echo $data['SportName'];?> </td>
    						<!--	<td><?php echo $data['TimeSlotName'];?> </td> 
    							<td><?php echo $data['TimeSlotType'];?> </td>
    							
    							<?php $CourtID=$data['CourtID'];

         $court=mysqli_query($conn,"SELECT CourtName FROM court WHERE CourtID='$CourtID'");
         $list=mysqli_fetch_assoc($court);
         $CourtName=$list['CourtName'];?>
         <td><?php echo $CourtName; ?></td>-->
  				<!--			</tr>
  							

         <?php }; ?>                   
						</table>
       				</div>
        		
        	</div>-->
        	
<!--         	<div class="row">
        	<div class="rr">
        	<h4>Terms and Conditions</h4>
        		<p> 1. A Member pay full fee in advance before granting membership.</p>
<p>2. The Member Agrees and ensures that he will renew his existing membership before the date of expiry.</p>
<p>3. Management reserves the right to withdraw or cancel the membership granted upon the non-payment of fees in time. As stated above.</p>
<p>4. The member shall ensure that he/she obtains from the office of the club a receipt duly acknowledging the payment of fees and the member shall keep the receipt under safe custody throughout the membership period- as it is the only documentary evidence of payment of the fees  and the same has to be produced for scrutiny of the office whenever asked by authorized officials.</p>
<p>5. Member shall take notice that only upon the basis of fitness assessment including due condition of the medical condition of the member, if applicable, that the management shall enrol him/her to a particular course of training or provide guidance, diet & nutrition, Counselling etc. Mere willingness to pay fees for the course will not make a person eligible to get enrolled to a course of his/her option. Members are advised to follow the expert training provided by the management and pursue the exercise card prescribed by the trainer.</p>
<p>6. Management assures that all fitness assessment and fitness training will be conducted with due diligence and with the help of safety methods. Management is not responsible for any injury or damage to loss of property of the member. During fitness assessment, the member is informed that during training he/she will experience certain body soreness which is a natural sign and result of exercise.</p>
<p>7. Member is advised to bring minimum possible personal valuable articles to the gym- including mobile phone, wallet, cash, Jewellery etc. All the members who enter the gym shall deposit his/her valuable personal articles in the locker provided for the purpose and such deposit in the locker will be at the sole responsibility of the member and the management will not responsible for any loss, theft or damage of such articles.</p>
<p>8. Member may be expelled or fined or both in case of habitual indiscipline including acts of violence or aggression, using abusive language, behaving in disrespectful manner to the staff and co-members, occupying training machines/facilities unnecessarily, not returning equipment to the right place after using, not maintaining standards of hygiene (e.g. body odour and not using clean & dry towel, t-shirts, shoes etc. during exercise). Three or more such acts of indiscipline will constitute sufficient reason for expulsion or fine or both after giving due notice to the member.</p>
<p>9. Member is advised to bring work-out-shoes solely for using in the gym. Shoes or chappal using/used outside will not be permitted in the badminton court and fitness centre.</p>
<p>10. Member is advised to use suitable dress during workout. Normal dress are not permitted during exercises.</p>
<p>11. Management reserves complete right to revise membership fees, operating hours and holidays without prior notice or assigning any detailed reason.</p>
<p>12. Fees once paid will not be refunded at any cost. But membership is transferable to any new member only near relation.</p>
<p>13. Members are not permitted to enter the estadio club under the influence of alcohol or drugs.</p>
<p>14. Badminton gears are not included in the membership charges.</p>
<p>15. Members can use the court only in the allotted slot.</p>
<p>16. The member can play an hour a day. Pair Choice is given if slot is available. Estadio holds no responsibility towards the attendance of the co-player.</p>
<p>17. In case of tournament, Members may not be given priority on court ( Tournaments are restricted to a maximum of 6days per month)</p>
<br>
<p>Only if you agree the above terms & conditions, Please sign this form.</p>
<p>Above mentioned all terms & conditions are acceptable to me and I’m willing to take membership here</p>
<br>
<p>Signature of member.</p>
        	</div>
        	</div> -->
</section>

	
<script type="text/javascript">

        function test()
        { 
	window.print();
	window.location.href = 'create_customer.php';
	}
	
   
  
      </script>

   
</body>
</html>