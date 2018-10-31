
<?php 
require 'db/config.php';

$ExpenseID=$_GET['id'];




$sql="DELETE FROM expense_table WHERE ExpenseID='$ExpenseID'";
 mysqli_query($conn,$sql);

 $Del="DELETE FROM ledger WHERE ExpenseID='$ExpenseID'";
 mysqli_query($conn,$Del);
 
header('Location: ' . $_SERVER['HTTP_REFERER']);


 ?>