<?php 
  session_start();
  require("../config/Users.php");
  include("../config/Orders.php");
  require("../config/Employee.php");
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $order = new Orders($conn);
  $data_of_purchase = $order->selectAllPurchase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Purchases</title>
 <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!--Box modal Delete product-->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Delete Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you want delete this products ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal" aria-label="Close">No</button>
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<!--endbox delete modal-->
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
          <a href="index3.html" class="nav-link">Purchases</a>
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
        <div class="search mg-top">
            <div class="container-fluid">
                <form action="">
                    <div class="input-group">
                        <input type="search" class="form-control " placeholder="Type your keywords here">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
        <div class="button-header mg-top">
            <!-- Button trigger modal -->
            <div class="button-item">
              <a href="create_purchase.php" class="btn btn-block btn-primary">
                Create Purchases
              </a>
            </div>
            <form action="" method="post">
              <div class="button-date">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation" placeholder="Select Range Date">
                </div>
              </div>
              <div class="button-sort">
                  <button type="submit" class="btn btn-block btn-primary" name="btnsort">
                      <i class="fa-solid fa-filter color-white" ></i>
                  </button>
              </div> 
            </form> 
        </div>
        <div class="clear"></div>
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <section class="content mg-top">
        <div class="container-fluid">
            <div class="card">
              <div class="card-body">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" id="tablepurchase">
                  <thead>
                    <tr>
                      <th>REFERENCE</th>
                      <th>SUPPLIER</th>
                      <th>WAREHOUSE</th>
                      <th>STATUS</th>
                      <th>GRAND TOTAL</th>
                      <th>PAID</th>
                      <th>PAYMENT TYPE</th>
                      <th>CREATE ON</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($data_of_purchase as $key){
                    ?>
                    <tr>
                      <td>
                        <div class="text">
                          <div class="text-color">
                            <?php echo $key['invoice_number']; ?>
                          </div>
                        </div>
                      </td>
                      <td><div><?php echo $key['Supplier_name']; ?></div></td>
                      <td><div><?php echo $key['Warehouse']; ?></div></td>
                      <td><div ><?php echo $key['Status']; ?></div></td>
                      <td><div>$ <?php echo $key['GrandTotal']; ?></div></td>
                      <td><div>$ <?php echo $key['Payment_amount']; ?></div></td>
                      <td><div><?php echo $key['Payment_type']; ?></div></td>
                      <td><div><?php echo $key['CreateDate']; ?></div></td>
                     
                      <td>
                        <div class="text-pro">
                            <div class="icon-action">
                                <i class="fa-solid fa-pen-to-square color-blue" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                            </div>
                            <div class="icon-action">
                                <i class="fa-solid fa-trash color-red" data-bs-toggle="modal" href="#exampleModalToggle" role="button"></i>
                            </div>
                        </div>
                      </td>
                    </tr>
                   <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
        </div><!-- /.container-fluid -->
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

<?php include("footer.php") ?>
<script>
  $(document).ready(function(){
    $('#tablepurchase').DataTable(); 
  });
</script>
</body>
</html>
