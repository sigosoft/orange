<?php

$SportID=$_GET['id'];

require 'db/config.php';


$update="UPDATE sporttype SET status='Active' WHERE SportID='$SportID'";
mysqli_query($conn,$update);

header('location:manage_sports.php');

?>