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

$sql="SELECT * FROM ledger WHERE DATE(`Timestamp`)='$current'";
$result=mysqli_query($conn,$sql);

if(isset($_POST['submit']))
{

 $from = $_POST['from'];
 $to = $_POST['to'];

 $sql="SELECT * FROM ledger  WHERE (DATE(`Timestamp`) >= '$from' AND DATE(`Timestamp`) <= '$to')";



 $result=mysqli_query($conn,$sql);

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
            <div class="page-title">
              <div class="title_left">
                <h3>Ledger</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>
             <div style="padding-bottom: 10px;">
            <form method="POST">
            <label class="m-left">From</label>
            <input type="Date" name="from" class="a">
            <label class="m-left">To</label>
            <input type="Date" name="to" class="a">
            <button type="submit" name="submit" class="btn btn-success m-left">SUBMIT</button>
            </form>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel p-btm" >
                  <div class="x_title">
                    <h2>Ledger</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Type</th>
                          <th>Mode</th>
                          <th>Amount</th>
                          <th>Date</th>
                         
                          

                        </tr>
                      </thead>


                      <tbody>

                      <?php while($row=mysqli_fetch_assoc($result))
                      {
                      ?>
                        
                        <tr>
                          
                          <td><?php echo $row['Type']; ?></td>
                          <td><?php echo $row['Mode']; ?></td>
                          
                          <td><?php echo $row['Amount']; ?></td>
                          <td><?php $dated=$row['LedgerDate'];
                            echo date("jS F, Y", strtotime("$dated"));
                           ?></td>
                    
                         
                          



                      
                            
                      
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