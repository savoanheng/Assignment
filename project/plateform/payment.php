<?php
  session_start();
  require("../config/Users.php");
  require("../config/Payment.php");
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $pay = new Payments($conn);
    $data = $pay->selectAllPayment();
 
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer</title>
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
          <a href="index3.html" class="nav-link">Customers</a>
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
                <form action="" method="POST">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control " placeholder="Type your keywords here">
                        <div class="input-group-append">
                            <input type="submit" name="btnSearch" class="btn btn-default" value='Search'>
                        </div>
                    </div>
                </form>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
        <div class="button-header mg-top">
          <form action="" method="post">
            <!-- Button trigger modal -->
            <div class="button-item">
                <a href="export_payment.php" class="btn btn-block btn-primary">
                    Export to Excel
                </a>
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
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                        <td>INVOICE NUMBER</td>
                        <td>Payment Type</td>
                        <td>Payment Amount</td>
                        <td>CREATE DATE</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                     
                      if(isset($_POST['btnSearch'])){
                        $keys=$_POST['search'];
                        $datas= $cust->filterSearchCustomer($keys);
                      foreach($datas as $k){
                    ?>
                    <tr>
                      <td>
                        <div class="text-name color-blue"><?php echo $k['Customer_name']; ?></div>
                        <div class="text-email"><?php echo $k['Email']; ?></div>
                      </td>
                      <td><div ><?php echo $k['Phone']; ?></div></td>
                      <td><div><?php echo $k['CreateOn']; ?></div></td>
                      <td>
                            <div class="icon-action">
                             <input type="hidden" name="id" value="<?php echo $k['Cus_id'];?>"><i class="fa-solid fa-pen-to-square color-blue" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                            </div>
                            <div class="icon-action">
                                <a href=""><i class="fa-solid fa-trash color-red"></i></a>
                            </div>
                      </td>
                    </tr>
                   <?php }
                   } else { ?>
                   <?php 
                   foreach($data as $key){
                    ?>
                    <tr>
                      <td>
                        <div class="text-name color-blue"><?php echo $key['invoice_number']; ?></div>
                      </td>
                      <td><div ><?php echo $key['Payment_type']; ?></div></td>
                      <td><div><?php echo $key['Payment_amount']; ?></div></td>
                      <td><div><?php echo $key['CreateDate']; ?></div></td>
                    </tr>
                   <?php }?>
                   <?php }?>
                  </tbody>
                </table>
              </div>
        
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
</body>
</html>
<?php 
  $id = $_GET['id'];
  $data = $cust->deleteCustomer($id);
  
?>

