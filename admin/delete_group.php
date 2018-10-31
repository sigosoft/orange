
<?php 
require 'db/config.php';

$GroupID=$_GET['id'];




$sql="DELETE FROM usergroups WHERE GroupID='$GroupID'";
 mysqli_query($conn,$sql);

$del=mysqli_query($conn,"DELETE FROM groups WHERE GroupID='$GroupID'");

header('Location: ' . $_SERVER['HTTP_REFERER']);


 ?>