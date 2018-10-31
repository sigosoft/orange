<?php

$CourtID=$_GET['id'];

require 'db/config.php';


$update="UPDATE court SET status='Blocked' WHERE CourtID='$CourtID'";
mysqli_query($conn,$update);

header('location:manage_court.php');

?>