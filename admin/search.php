<?php
    $key=$_GET['key'];
    $array = array();
    require 'db/config.php';
    $query=mysqli_query($conn,"SELECT * FROM users WHERE Phone LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['Phone'];
    }
    echo json_encode($array);
?>