<?php
  session_start();

  require("../config/Users.php");
  require("../config/Orders.php");
  require("../config/Products.php");
  $product = new Products($conn);
  $Allproduct = $product->selectAllProduct();
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
 

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
          <a href="#" class="nav-link">Stock Report</a>
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
              <h1 class="m-0">Stock Location</h1>
            </div>
        </div>
        <div class="margin-top-10"></div>
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-primary">
              <div class="card-body">
                <h4>Stock Location / <a href="record_stock_summary_report.php">Recordering Stock Summary Reports</a></h4>
                <div class="row">
                  <div class="col-10"></div>
                  <div class="col-2"></div>
                </div>
                <div class="row">
                  <div class="col-11"></div>
                  <div class="col-1"><a href="stock_export.php" class="btn btn-block btn-primary">Excel</a></div>
                </div>
                <div class="margin-top-10"></div>
                <div class="margin-top-10"></div>
                <div class="row">
                  <div class="col-12">
                    <div class="card-body p-0">
                      <table class="table" id="table-product">
                        <thead>
                          <tr>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Unit</th>
                            <th>Defualt Warehouse</th>
                            <th>Total Quantity</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          foreach($Allproduct as $key){
                        ?>
                          <tr>
                            <td><?php echo $key['Product_name'];?></td>
                            <td><?php echo $key['Product_code'];?></td>
                            <td><?php echo $key['Unit'];?></td>
                            <td><?php echo $key['UnitInStock'];?></td>
                            <td><?php echo $key['UnitInStock'];?></td> 
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
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
<!-- ./wrapper -->

<?php include("footer.php") ?>
<script>
  $(document).ready(function(){
    $('#table-product').DataTable(); 
  });
</script>
</body>
</html>