<?php 
  session_start();
  include("../config/Supplier.php");
  require("../config/Users.php");
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $supplier = new Suppliers($conn);
  if(isset($_POST['btnSubmit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $supplier->insertNewSupplier($name,$phone,$email,$city,$country,$address);
  }
  $data = $supplier->GetAllSuppliers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Supplier</title>
  <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Name<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="name" placeholder="Enter name">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Email<span class="color-red">*</span></label>
                <input type="email" class="form-control" name="email" placeholder="Enter email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Phone Number<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="phone" placeholder="Enter phone number">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Country<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="country" placeholder="Enter Country">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>City<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="city" placeholder="Enter city">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Address<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="address" placeholder="Enter Address">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" name="btnSubmit" value="Submit">
      </div>
    </div>
  </div>
</div>
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
          <a href="index3.html" class="nav-link">Suppliers</a>
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
 <?php  include("navigative.php") ?>
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
              <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Create Supplier
              </button>
            </div>
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
                <table class="table table-hover table-striped" id="table-supplier">
                  <thead>
                    <tr>
                      <td>SUPPLIER NAME</td>
                      <td>PHONE</td>
                      <td>EMAIL</td>
                      <td>CITY</td>
                      <td>COUNTRY</td>
                      <td>ADDRESS</td>
                      <td>ACTION</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach($data as $key){
                    ?>
                    <tr>
                      <td><?php echo $key['Supplier_name'];?></td>
                      <td><?php echo $key['Phone'];?></td>
                      <td><?php echo $key['email'];?></td>
                      <td><?php echo $key['City'];?></td>
                      <td><?php echo $key['Country'];?></td>
                      <td><?php echo $key['Address'];?></td>
                      <td>
                            <div class="icon-action">
                                
                                 <a href="editSupplier.php?id=<?php echo $key['Sup_id']; ?>"><i class="fa-solid fa-pen-to-square color-blue"> </i></a>
                               
                            </div>
                            <div class="icon-action">
                                <a href="delete_supplier.php?delete=<?php echo $key['Sup_id']; ?>"> <i class="fa-solid fa-trash color-red"></i></a>
                            </div>
                      
                      </td>
                    </tr>
                   <?php } ?>
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
<script>
  $(document).ready(function(){
    $('#table-supplier').DataTable(); 
  });
</script>
</body>
</html>
