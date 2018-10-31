
<?php 
require 'db/config.php';

$PackageID=$_GET['id'];




$sql="DELETE FROM payment_packages WHERE PackageID='$PackageID'";
 mysqli_query($conn,$sql);
 header("location:manage_plans.php");


 ?>