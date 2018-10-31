<?php
$conn = mysqli_connect("localhost","works_orange","orange@123","works_orange");

// Check connection
if (mysqli_connect_errno())
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  };

?>