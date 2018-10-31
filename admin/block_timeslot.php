<?php

$TimeSlotID=$_GET['id'];

require 'db/config.php';


$update="UPDATE timeslots SET status='Blocked' WHERE TimeSlotID='$TimeSlotID'";
mysqli_query($conn,$update);

header('location:manage_timeslots.php');

?>