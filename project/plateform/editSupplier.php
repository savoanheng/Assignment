<?php 
    session_start();
    include("../config/Supplier.php");
    require("../config/Employee.php");
    require("../config/Users.php");
    $user_id = $_SESSION['id'];
    $user = new Users($conn);
    $users = $user->selectUsersById($user_id);
    $supplier = new Suppliers($conn);
    $id = $_GET['id'];
    $data = $supplier->GetSupplier($id);
    if(isset($_POST['btnSave'])){
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $city = $_POST['city'];
      $country = $_POST['country'];
      $address = $_POST['address'];
      $supplier->EditSupplier($id,$name,$phone,$email,$city,$country,$address);
      header("location: supplier.php");
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Supplier</title>
  <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
          <a href="index3.html" class="nav-link">Edit Suppliers</a>
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
      <!-- Main content -->
      <section class="content mg-top">
        <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <form action="" method="post">
                        <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                                <label>Name<span class="color-red">*</span></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $data['Supplier_name']; ?>">
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                <label>Email<span class="color-red">*</span></label>
                                <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                                <label>Phone Number<span class="color-red">*</span></label>
                                <input type="text" class="form-control" name="phone" value="<?php echo $data['Phone']; ?>">
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                <label>Country<span class="color-red">*</span></label>
                                <input type="text" class="form-control" name="country" value="<?php echo $data['Country']; ?>">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                                <label>City<span class="color-red">*</span></label>
                                <input type="text" class="form-control" name="city" value="<?php echo $data['City']; ?>">
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                <label>Address<span class="color-red">*</span></label>
                                <input type="text" class="form-control" name="address" value="<?php echo $data['Address']; ?>">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" name="btnSave" value="Save">
                    </div>
                      
                </div>
              </form>
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
    
?>
