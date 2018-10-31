<?php

session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

date_default_timezone_set('Asia/Kolkata');
$current = date('Y-m-d');

$admin=$_SESSION['admin'];
$name=$admin['Name'];
$auth_id=$admin['AuthID'];



require 'db/config.php';

$sql="SELECT * FROM users";
$result=mysqli_query($conn,$sql);


$members_count="SELECT (SELECT COUNT(*) FROM users) AS members";
$members_result=mysqli_query($conn,$members_count);
$members_row=mysqli_fetch_assoc($members_result);
$total_members=$members_row['members'];

$sports="SELECT * FROM sporttype";
$sport_result=mysqli_query($conn,$sports);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Orange | Admin</title>

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


<style type="text/css">
  
#thumbwrap {
  position:relative;
  /*margin:75px auto;*/
  /*width:252px; height:252px;*/
}
.thumb img { 
  border:1px solid #000;
  margin:3px;
   height: 139px;
  width: 155px;
  /*float:left;*/
}
.thumb span { 
  position:absolute;
  visibility:hidden;
}
.thumb:hover, .thumb:hover span { 
  visibility:visible;
  top:0; right: 150px; 
  z-index:1;
}


</style>
 
  </head>

  <body class="nav-md">
    




 <?php require 'partials/sidebar.php'; ?>




        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
              <div class="title_left">
                <h3>Customer</h3>
              </div>
              <div class="row">
              <div class="col-md-3" style="border: 1px solid black; padding: 50px 72px;width:20%;margin-right: 20px; margin-top: 2%;background: white;margin-left: 20px;text-align: center;">

               <h4>Members</h4>
               <p><?php echo $total_members;?></p>
              </div>


              <?php while($sport_row=mysqli_fetch_assoc($sport_result))
              {
              ?>

               <div class="col-md-3" style="border: 1px solid black; padding: 50px 72px; width:20%;margin-right: 20px;margin-top: 2%;background: white;margin-left: 20px;text-align: center;">

               <h4><?php 
                $sportname=$sport_row['SportName'];
                echo $sportname; ?></h4>

               <?php 
               
               $sports_count="SELECT (SELECT COUNT(*) FROM usercourtdetails WHERE SportName='$sportname') AS count";
               $sports_count_result=mysqli_query($conn,$sports_count);
               $sports_count_row=mysqli_fetch_assoc($sports_count_result);
               ?>
               <p><?php echo $sports_count_row['count']; ?></p>
              </div>

              <?php }; ?>
               
            </div>

              
            </div>

           
          
          
            <div class="page-title">
              <div class="title_left">
              
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel p-btm" >
                  <div class="x_title">
                    <h2>Customer List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                       <!--   <th>Register No</th>-->
                       <th>ID No.</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Gender</th>
                   <!--      <th>Customer Type</th>-->
                         <th>DOB</th>
                          <th>Place</th>
                          <th>Height</th>
                          <th>Weight</th>
                          <th>View</th>
                          <th>Edit</th>
                      <!--    <th>Edit Image</th>-->
                          <th>Print</th>

                        </tr>
                      </thead>


                      <tbody>

                      <?php while($row=mysqli_fetch_assoc($result))
                      {
                      ?>
                        
                        <tr>
                          
                          <td><?php echo $row['id_no']; ?></td>
                          <td><?php echo $row['Name']; ?></td>
                          <td><?php echo $row['Phone']; ?></td>
                          <td><?php echo $row['Gender']; ?></td>
                        <!--  <td><?php echo $row['CustomerType']; ?></td>-->
                          <td><?php echo $row['DOB']; ?></td>
                          <td><?php echo $row['Place']; ?></td>
                          <td><?php echo $row['height']; ?></td>
                           <td><?php echo $row['weight']; ?></td>
                    
                      

                           <td><a href="view_customer.php?id=<?php echo $row['UserID'];?>">View</a></td>
                           <td><a href="edit_customer_details.php?id=<?php echo $row['UserID'];?>">Edit </a> 
                           <!--<a href="edit_customer_sports.php?id=<?php echo $row['UserID'];?>">Edit Sports</a>-->
                           </div></td>
                          <!-- <td><a href="image_edit.php?id=<?php echo $row['UserID'];?>">View</a></td>-->
                           <td><a href="member_form.php?id=<?php echo $row['UserID'];?>" target="_blank">Print</a></td>
                           
                         



                      
                            
                      
                        </tr>

                       <?php }; ?> 
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


        


        </div>
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