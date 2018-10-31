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

$underID=$_GET['id'];

require 'db/config.php';

$sql="SELECT family_membership.*, users.* FROM family_membership INNER JOIN users ON users.UserID=family_membership.MemberID WHERE family_membership.Type='Secondary' AND family_membership.UnderPrimary='$underID'";


$result=mysqli_query($conn,$sql);


if(isset($_POST['submit']))
{

$RegisterNo=$_POST['RegisterNo'];

$GetID=mysqli_query($conn,"SELECT * FROM users WHERE RegisterNo='$RegisterNo'");

if(mysqli_num_rows($GetID)==1)
{

$GetRow=mysqli_fetch_assoc($GetID);
$UserID=$GetRow['UserID'];


$Validate=mysqli_query($conn,"SELECT * FROM family_membership WHERE MemberID='$UserID'");


if(mysqli_num_rows($Validate)<=0) 
{

$query="INSERT INTO family_membership(Type, MemberID, UnderPrimary) VALUES ('Secondary', '$UserID', '$underID')";
$expiry="0000-00-00";
if (mysqli_query($conn, $query))
 {
    $update=mysqli_query($conn,"UPDATE users SET PaymentExpiryDate='$expiry' WHERE UserID='$UserID'");

    $updater=mysqli_query($conn,"UPDATE users SET CustomerType='Family Membership' WHERE UserID='$UserID'");
   
    

 
    echo "<script> alert('Member Added To Family Membership');window.location.href = 'view_family_members.php?id=$underID';</script>";
 }
 else
 {

   echo "<script> alert('Upload Error');window.location.href = 'view_family_members.php?id=$underID';</script>";
 }

}
else
{
  
   echo "<script> alert('User Already In Family Group');window.location.href = 'view_family_members.php?id=$underID';</script>";
 
}

}

else
{
  
   echo "<script> alert('Register Number Not Found');window.location.href = 'view_family_members.php?id=$underID'';</script>";
 
}

};




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
          
           

              
            </div>

           
          
          
            <div class="page-title">
              <div class="title_left">
              
              </div>

              
            </div>

            <div class="clearfix"></div>

             <div class="col-md-12">
                          <button type="submit" onclick="show2();" class="btn btn-primary">Add Family Members</button>
                          
                        </div><br>

                        <form method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

                      <div id="div1" style="display: none">
                      <div class="item form-group">
                        
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input id="RegisterNo" class="form-control col-md-7 col-xs-12" name="RegisterNo" placeholder="Register No" required="required" type="text">
                        </div>
                      </div>

                       <div class="col-md-6 ">
                          <button type="submit" onClick="show1()" class="btn btn-primary">Cancel</button>
                          <input type="submit" name="submit" class="btn btn-success" value="Submit">
                        </div>
                      </div>

                    </form>

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
                          <th>Register No</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Gender</th>
                          <th>Customer Type</th>
                          <th>Place</th>
                          <th>View</th>
                          

                        </tr>
                      </thead>


                      <tbody>

                      <?php while($row=mysqli_fetch_assoc($result))
                      {
                      ?>
                        
                        <tr>
                          
                          <td><?php echo $row['RegisterNo']; ?></td>
                          <td><?php echo $row['Name']; ?></td>
                          <td><?php echo $row['Phone']; ?></td>
                          <td><?php echo $row['Gender']; ?></td>
                          <td><?php echo $row['CustomerType']; ?></td>
                          <td><?php echo $row['Place']; ?></td>
                    
                      

                           <td><a href="view_family_members.php?id=<?php echo $row['UserID'];?>">View</a></td>
                           
                         



                      
                            
                      
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


     <script>
      function show1(){

  
  document.getElementById('div1').style.display ='none';
}
function show2(){


  document.getElementById('div1').style.display = 'block';
}
    </script>
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