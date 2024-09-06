<?php 
  session_start();
  require("../config/Users.php");
  include("../model/conn.php");
  require("../config/Employee.php");
  $emp_id = $_GET['id'];
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $emp = new Employee($conn);
  $data = $emp->selectEmployeeById($emp_id);
  if(isset($_POST['btnUpdate']))
  {
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $address = $_POST['address'];
    $employee = $emp->updateEmployee($emp_id,$fname,$lname,$gender,$email,$phone,$address,$department,$salary);
    header("location:employee.php");
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products</title>
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
          <a href="#" class="nav-link">Edit Products</a>
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
                            <label>First Name<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="f_name" value="<?php echo $data['firstname']; ?>">
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label>Last Name<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="l_name" value="<?php echo $data['lastname']; ?>">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <div class="form-group">
                            <label>Gender<span class="color-red">*</span></label>
                            <select class="custom-select" name="gender">
                            <option value="Female" <?php if($data['gender']=='Female') echo 'selected'; ?>>ស្រី</option>
                            <option value="Male" <?php if($data['gender']=='Male') echo 'selected'; ?>>ប្រុស</option>
                            <option value="Other" <?php if($data['gender']=='Other') echo 'selected'; ?>>ផ្សេង</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label>Email<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="email" value="<?php echo $data['email']; ?>">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <div class="form-group">
                            <label>Phone Number<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $data['phone']; ?>">
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label>Address<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="address" value="<?php echo $data['address']; ?>">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <div class="form-group">
                            <label>Department<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="department" value="<?php echo $data['department']; ?>">
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label>Salary<span class="color-red">*</span></label>
                            <input type="number" class="form-control" name="salary" value="<?php echo $data['salary']; ?>">
                        </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" name="btnUpdate" value="Update">
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
