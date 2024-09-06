<?php
  session_start();
  require("../config/Users.php");
  include("../config/Products.php");
  include("../config/filter.php");
  include("../config/Orders.php");
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $filter = new SalesFilter($conn);
 
  $order = new Orders($conn);
  $purchase = $order->selectReportPurchase();


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
          <a href="#" class="nav-link">Purchases Summary Report</a>
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <div class="content-header ">
            <div class="clear"></div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                <h3 class="m-0">Purchases Summary Report</h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="margin-top-10"></div>
            <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                <div class="card-body">
                    <h5>Purchase Summary Report / <a href="purchase_report.php">Purchase Report</a></h5>
                    <div class="margin-left-10"></div>
                    <div class="row">
                        <div class="col-10"></div>
                        <div class="col-2"></div>
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
                        <div class="col-1"><button type="submit" name="purchasefilter" class="btn btn-primary">Filter</button></div>
                        <div class="col-4"></div>
                        <div class="col-1"><a href="purchase_summary_export.php" class="btn btn-block btn-primary">Excel</a></div>
                    </div>
                    </form>
                    <div class="margin-top-10"></div>
                    <div class="margin-top-10"></div>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-9">
                            <div style="height: 250px;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(isset($_POST['purchasefilter']))
                        {
                          $startdate = $_POST['startdate'];
                          $enddate = $_POST['enddate'];
                          $purchase_filter = $filter->selectFilterPurchaseByDate($startdate,$enddate);
                          foreach($purchase_filter as $data){
                            $invoice[] = $data['invoice_number'];
                            $purcahse[] = $data['Total'];
                          }

                    ?>
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>Invoice Number</th>
                                    <th>Sale Amount</th>
                                    <th>Purchase</th>
                                    <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0.00;
                                    foreach($purchase_filter as $k){
                                    ?>
                                    <tr>
                                    <td>
                                      <?php echo $k['invoice_number'];?>
                                    </td>
                                    <td><?php echo $k['Sale'];?></td>
                                    <td><?php echo $k['Purchase'];?></td>
                                    <td>
                                        <div class="re-status">
                                        <?php echo $k['Total'];?>
                                        </div>
                                    </td>
                                    
                                    </tr>
                                    <?php $total +=$k['Total']; } ?>
                                    <tr>
                                    <td colspan="3">Total:</td>
                                    <td>$ <?php echo number_format($total,2);?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>      
                    </div>
                    <?php }else{
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>Date</th>
                                    <th>Total Invoice</th>
                                    <th>Purchase Amount</th>
                                    <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0.00;
                                    $purchase_month = $filter->selectPurchaseByMonth();
                                    foreach($purchase_month as $data){
                                      $month[] = $data['Months'];
                                      $amount[] = $data['Purchase'];
                                    }
                                    foreach( $purchase_month as $k){
                                    ?>
                                    <tr>
                                    <td>
                                      <?php echo $k['Months'].$k['Years'];?>
                                    </td>
                                    <td><?php echo $k['total_invoice'];?></td>
                                    <td><?php echo $k['Purchase'];?></td>
                                    <td>
                                      <?php echo $k['Purchase'];?>
                                    </td>
                                    
                                    </tr>
                                    <?php $total +=$k['Purchase']; } ?>
                                    <tr>
                                    <td colspan="3">Total:</td>
                                    <td>$ <?php echo number_format($total,2);?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>      
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
<?php include("footer.php") ?>
<script>
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php if(isset($_POST['purchasefilter'])){
            echo json_encode($invoice);
      }else{
        echo json_encode($month);
      }
         ?>,
      datasets: [{
        label: 'Purchase Report',
        data: <?php if(isset($_POST['purchasefilter'])){
          echo json_encode($purchase);
        }else{
          echo json_encode($amount);
        }
         ?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>
