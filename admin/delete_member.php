
<?php 
require 'db/config.php';

$UserID=$_GET['id'];




$sql="DELETE FROM usergroups WHERE UserID='$UserID'";
 mysqli_query($conn,$sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);


 ?>