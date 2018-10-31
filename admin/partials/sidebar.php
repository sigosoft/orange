<style >
     .left_col {
    background-image: -webkit-gradient(linear, right top, left top, from(#ff2368 ), to( #e28109 ));
    background-image: linear-gradient(to bottom, #d0770a 0%, #ff2368 100%);
}
.nav_title {
    background: #bf400f;
}
   </style>

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <!-- <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class=""></i> <span>Orange</span></a>
            </div> -->

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../uploads/admin/logo.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $name;?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                
                <ul class="nav side-menu">
                  <li><a href="dashboard.php"><i class="fa fa-home"></i> Home </a>

                    <li><a href="bill.php"><i class="fa fa-credit-card"></i> Payments</a></li>

                    <li><a href="attendance_view.php"><i class="fa fa-television"></i> Real Time Attendance</a></li>

                    <li><a href="attendance_history.php"><i class="fa fa-television"></i> Attendance History</a></li>

                    <li><a href="ledger.php"><i class="fa fa-calculator"></i> Ledger</a></li>
                    
                    <li><a href="booking.php"><i class="fa fa-calendar"></i> Bookings</a></li>

                    <li><a href="family_membership.php"><i class="fa fa-car"></i> Family Membership</a></li>

                    

                    <li><a href="groups.php"><i class="fa fa-users"></i> Groups</a></li>

                    <li><a href="payment_history.php"><i class="fa fa-usd"></i> Payment History</a></li>


                    <li><a><i class="fa fa-male"></i> Customer <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="create_customer.php">Add Customer</a></li>
                      <li><a href="manage_customer.php">Manage Customer</a></li>
                      
                    </ul>
                  </li>
                  
                  
                  <li><a><i class="fa fa-credit-card-alt"></i> Loyality Card <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="issue_card.php">Issue Card</a></li>
                      <li><a href="add_cash.php">Add Cash</a></li>
                      <li><a href="wallet_cash.php">Wallet Cash</a></li>
                      <li><a href="customer_wallet.php">Customer Wallet</a></li>
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bicycle"></i> Sports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="create_sports.php">Add Sports</a></li>
                      <li><a href="manage_sports.php">Manage Sports</a></li>
                      
                    </ul>
                  </li>

             <!--     <li><a><i class="fa fa-hourglass-1"></i> Timeslot <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="create_timeslots.php">Add Timeslot</a></li>
                      <li><a href="manage_timeslots.php">Manage Timeslots</a></li>
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-sitemap"></i> Court <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="create_court.php">Add Court</a></li>
                      <li><a href="manage_court.php">Manage Court</a></li>
                      
                    </ul>
                  </li>-->

                  <li><a><i class="fa fa-money"></i> Manage Payment <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="create_payment_plans.php">Create Plans</a></li>
                      <li><a href="manage_plans.php">Manage Plans</a></li>
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-book"></i> Expense <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="create_expense.php">Create Expense</a></li>
                      <li><a href="manage_expense.php">Manage Expense</a></li>
                      <li><a href="expense_category.php">Expense Category</a></li>
                      
                    </ul>
                  </li>
                  
              <!--    <li><a href="expirydate.php"><i class="fa fa-users"></i> Expiry Date</a></li>-->

                  
               <!--    <li><a href="expirydate.php"><i class="fa fa-users"></i> Expiry Date</a></li>-->


                  
                  <li><a><i class="fa fa-picture-o"></i> Gallery <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="create_gallery.php">Create Gallery</a></li>
                      <li><a href="manage_gallery.php">Manage Gallery</a></li>
                     
                      
                    </ul>
                  </li>
                
                
                
                    
                  </li>
                

                </ul>
              </div>
        

            </div>
            <!-- /sidebar menu -->

     
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../uploads/admin/logo.jpg" alt="">
                    <?php echo $name;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li>
                      <a href="password_change.php">
                        
                        <span>Change Password</span>
                      </a>
                    </li>
                 
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              
              </ul>
            </nav>
          </div>
        </div>