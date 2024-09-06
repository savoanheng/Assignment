<?php
  session_start();
  require("../config/Users.php");

  include("../config/filter.php");
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $filter = new SalesFilter($conn);
  $salemonth = $filter->selectSaleByMonth();

  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reports</title>
  <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  <div class="header">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="report.php" class="nav-link">Sales Report</a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" href="pos.php" role="button">
            <div class="pos">POS</div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item dropdown" >
          <a class="nav-link" data-toggle="dropdown" href="#">
            <?php echo $users['fullname'];?><img src="<?php echo $users['image'];?>" style="width: 30px;height:30px;border-radius: 50%;">
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?php echo $users['image'];?>" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?php echo $users['fullname']; ?></h3>

                <p class="text-muted text-center"><?php echo $users['roles']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <a href="update_user.php?id=<?php echo  $users['user_id'];?>"><i class="fa-solid fa-user nav-icon"></i> Profile</a>
                  </li>
                  <li class="list-group-item">
                    Change Password
                  </li>
                  <li class="list-group-item">
                    <a href="login.php">Log Out</a>
                  </li>
                  
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
  </div>
  <!-- Main Sidebar Container -->
 <?php include("navigative.php") ?>
  
  <div class="body">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header ">
        <div class="clear"></div>
      </div>
      <div class="container-fluid">
        <div class="row">
            <div class="col-6">
              <h1 class="m-0">Sale Report</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-primary">
              <div class="card-body">
                <h4>Sales Report / <a href="sales_summary.php">Sales Summary</a></h4>
              </div>
              <div class="row">
                <div class="col-10"></div>
                <div class="col-2"><a href="export.php" class="btn btn-block btn-primary">Excel</a></div>
              </div>
              <form action="" method="post">
              <div class="row">
                  <div class="margin-left-10"></div>
                  <div class="col-3">
                      <input type="date" name="startdate" class="form-control" value="2024-01-01">
                  </div>
                  <div class="col-3">
                      <input type="date" name="enddate" class="form-control" value="2024-01-31">
                  </div>
                  <div class="col-1">
                      <button type="submit" class="btn btn-primary" name="btnfilter">Filter</button>
                  </div>
                  <div class="col-4"></div>
              </div>
              </form>
              <div class="margin-top-10"></div>
              <div class="margin-top-10"></div>
              <div class="row">
                <div class="col-4">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Sale Payment</h3>
                      <div class="cart-tool"></div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                          <thead>
                            <th>Payment Method</th>
                            <th>Amount</th>
                          </thead>
                          <tbody>
                          <?php
                            $total = 0.00;
                            if(isset($_POST['btnfilter'])){
                              $start = $_POST['startdate'];
                              $end = $_POST['enddate'];
                              $payfilter = $filter->selectPaymentBySale($start,$end);       
                              foreach($payfilter as $key){
                          ?>
                            <tr>
                              <td><?php echo $key['Payment_type']; ?></td>
                              <td>$ <?php echo $key['Total']; ?></td>
                            </tr>
                          <?php $total += $key['Total'];?>
                          <?php } 
                          echo '<tr>
                                  <td></td>
                                  <td> $ '.number_format($total,2).'</td>
                                </tr>';
                            } else { 
                              $payAllsale = $filter->selectPaymentAllSale();
                                foreach($payAllsale as $key){
                          ?>
                            <tr>
                                <td><?php echo $key['Payment_type']; ?></td>
                                <td>$ <?php echo $key['Total']; ?></td>
                            </tr>
                          <?php $total += $key['Total'];?>
                          <?php }
                           echo '<tr>
                                    <td></td>
                                         <td> $ '.number_format($total,2).'</td>
                                    </tr>';
                            }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>

                <div class="col-8">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Sales Summary</h3>
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Invoice Number</th>
                            <th>Create By</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $total = 0.00;
                          if(isset($_POST['btnfilter'])){
                            $start = $_POST['startdate'];
                            $end = $_POST['enddate'];
                            $filterbydate = $filter->selectFilterByDate($start,$end);    
                            foreach($filterbydate as $key){
                        ?>
                            <tr>
                              <td><?php echo $key['CreateDate'];?></td>
                              <td>
                                <?php echo $key['invoice_number'];?>
                              </td>
                              <td>
                                <?php echo $key['department'];?>
                              </td>
                              <td><?php echo $key['GrandTotal'];?></td>         
                            </tr>
                        <?php $total += $key['GrandTotal']; } ?>
                            <tr>
                              <td colspan="3">Total:</td>
                                  <td>$ <?php echo number_format($total,2);?></td>
                            </tr>
                        <?php
                            }else{
                                $allfilter = $filter->selectAllSales();
                                foreach ($allfilter as $key){
                        ?> 
                            <tr>
                              <td><?php echo $key['CreateDate'];?></td>
                              <td>
                                <?php echo $key['invoice_number'];?>
                              </td>
                              <td>
                               
                                <?php echo $key['department'];?>
                                
                              </td>
                              <td><?php echo $key['GrandTotal'];?></td>            
                            </tr>
                            <?php $total += $key['GrandTotal']; } ?>
                            <tr>
                              <td colspan="3">Total:</td>
                              <td>$ <?php echo number_format($total,2);?></td>
                            </tr>
                        <?php } ?>
                          </tbody>
                        </table>
                      </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        
          </div>
        </div>                              
      </div>
      <!-- /.content -->
    </div>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<?php include("footer.php") ?>

</body>
</html>
