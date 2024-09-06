<?php
  session_start();
  require("../config/Products.php");
  require("../config/Orders.php");
  require("../config/Expense.php");
  require("../config/Employee.php");
  require("../config/filter.php");
  require("../config/Users.php");
  $user_id = $_SESSION['id'];
  //create object Products
  $pro = new Products($conn);
  $TopSale = $pro->filterTopSale();
  foreach($TopSale as $key){
    $product[] = $key['Product_name'];
    $record[] = $key['Recordlevel'];
  }
  $filter = new SalesFilter($conn);
  $salemonth = $filter->selectSaleByMonth();
  foreach($salemonth as $key){
    $month[] = $key['Months'];
    $amount[] = $key['Sale'];
  }
  //Create object Orders
  $order = new Orders($conn);
  $invoice = $order->selectTotalInvoice();

  $total_income = $order->selectTotalSale();

  $sale = $order->selectCountSaleOrder();

  $purchase = $order->selectCountPurchaseOrder();
  
  //Create Object Expense
  $exp = new Expenses($conn);
  $expense = $exp->selectTotalExpense();
  $id = 1;
  //Create Object Employee
  $emp = new Employee($conn);
  $employee = $emp->selectEmployeeById($id);
  //Create Object Users
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
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
          <a href="index3.html" class="nav-link">Dashboard</a>
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
            <?php echo $users['fullname'];?><img src="<?php echo $users['image']; ?>" style="width: 30px;height:30px;border-radius: 50%;">
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?php echo $users['image']; ?>" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?php echo $users['fullname']; ?></h3>

                <p class="text-muted text-center"><?php echo $users['roles']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <a href="update_user.php?id=<?php  echo $users['user_id'];?>"><i class="fa-solid fa-user nav-icon"></i> Profile</a>
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
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $sale['totalSale'];?></h3>
                  <p>Total Sale</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $purchase['totalPurchase'];?></h3>
                  <p>Total Purchase</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>$ <?php echo $total_income['Total'];?></h3>
                  <p>Total Income</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>$ <?php foreach($expense as $key) {echo number_format($key['TotalExpense'],2);}?></h3>

                  <p>Expense</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-8 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Total Amount per Month</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
                  <!-- /.card-body -->
               
              <!-- /.card -->
            
            </section>

            <section class="col-lg-4 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Top Sale</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                  <canvas id="myPie"></canvas>
                  </div>
                </div>
                  <!-- /.card-body -->
               
              <!-- /.card -->
            
            </section>
            <!-- /.Left col -->
          
          </div>
          
          <div class="row">
            <div class="col-8">
              <div class="card">
                <div class="card-header">
                  <?php echo var_dump($user_id); ?>
                  <h3 class="card-title">Total Invoice</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Invoice Number</th>
                        <th>Customer</th>
                        <th>Sub Total</th>
                        <th>Grand Total</th>
                        <th>Discount</th>
                        <th>Payment Type</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        foreach($invoice as $key){
                       ?>
                      <tr>
                        <td><?php echo $key['invoice_number'] ?></td>
                        <td><?php echo $key['Customer_name'] ?></td>
                        <td><?php echo $key['GrandTotal'] ?></td>
                        <td><?php echo $key['Payment_amount'] ?></td>
                        <td>$ 0.00</td>
                        <td><?php echo $key['Payment_Status'] ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-4">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Product Summary</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include("footer.php")?>
</body>
<script type="text/javascript">
  const myPie = document.getElementById('myPie');

  new Chart(myPie, {
    type: 'pie',
    data: {
      labels: <?php echo json_encode($product);?>,
      datasets: [{
        label: 'Top Sale',
        data: <?php echo json_encode($record);?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        
      }
    }
  });
</script>
<script>
  const ctx = document.getElementById('myChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels:  <?php echo json_encode($month);?>,
        datasets: [{
          label: 'Total Amount',
          data: <?php echo json_encode($amount);?>,
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
</html>
