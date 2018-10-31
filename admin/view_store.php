<?php

session_start();

if(!isset($_SESSION['vendor']))
 {
   header('location:index.php');
 };


$vendor=$_SESSION['vendor'];
$v_name=$vendor['name'];
$v_image=$vendor['vendor_image'];
$vendor_id=$vendor['vendor_id'];
$category_id=$vendor['category'];


$store_id=$_GET['id'];

require 'db/config.php';

$sql="SELECT * FROM stores WHERE vendor_id='$vendor_id' AND store_id='$store_id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Orange | Vendor </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    




 <?php require 'partials/sidebar.php'; ?>




        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Stores</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>



            <table class="table" style="width: 50%;margin-left: 20%;">
  <thead>
    <tr>
     
    
    </tr>
  </thead>
  <tbody class="table-striped">
  <tr>
      <th scope="row"><strong>Store Name</strong></th>
      <td><?php echo $row['store_name'];?></td>
      
    </tr>
    <tr>
      <th scope="row"><strong>Location</strong></th>
      <td><?php echo $row['location'];?></td>
      
    </tr>
    <tr>
      <th scope="row"><strong>Mobile</strong></th>
      <td><?php echo $row['city'];?></td>
    
    </tr>
    <tr>
      <th scope="row"><strong>Zip Code</strong></th>
      <td><?php echo $row['zip'];?></td>
     
    </tr>
     <tr>
      <th scope="row"><strong>Phone</strong></th>
      <td><?php echo $row['phone'];?></td>
     
    </tr>
     <tr>
      <th scope="row"><strong>Latitude</strong></th>
      <td><?php echo $row['latitude'];?></td>
     
    </tr>
     <tr>
      <th scope="row"><strong>Longitude</strong></th>
      <td><?php echo $row['longitude'];?></td>
     
    </tr>
     <tr>
      <th scope="row"><strong>Description</strong></th>
      <td><?php echo $row['description'];?></td>
     
    </tr>
  
  </tbody>
</table






        <!-- </div> -->
        </div>
        </div>
       
              
                     <!-- footer content -->
        <footer>
          <div class="pull-right">
             Powered By <a href="">Orange</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>