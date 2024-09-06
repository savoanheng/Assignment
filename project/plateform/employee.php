<?php
  session_start();
  require("../config/Employee.php");
  require("../config/Users.php");
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  //Create Object Employee
  $emp = new Employee($conn);
  if(isset($_POST['btnSave'])){
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $address = $_POST['address'];
    
    $emp->insertNewEmployee($fname,$lname,$gender,$email,$phone,$address,$depart,$salary);
    echo"<sript>window.alert('Insert One row') </sript>";
  }
 
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employees</title>
  <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Create Employee
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>First Name<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="f_name" placeholder="Enter first name">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Last Name<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="l_name" placeholder="Enter last name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Gender<span class="color-red">*</span></label>
                <select class="custom-select" name="gender">
                  <option value="Female">ស្រី</option>
                  <option value="Male">ប្រុស</option>
                  <option value="Other">ផ្សេង</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Email<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="email" placeholder="Enter email">
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
                <label>Address<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="address" placeholder="Enter Address">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Department<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="department" placeholder="Enter department">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Salary<span class="color-red">*</span></label>
                <input type="number" class="form-control" name="salary" placeholder="Enter salary">
              </div>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" name="btnSave" value="Save">
      </div>
      </form>
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
          <a href="index3.html" class="nav-link">Employee</a>
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
              <button type="button" class="btn btn-block btn-primary" name="btnAdd" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Create Employee
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
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <td>FULLNAME</td>
                      <td>GENDER</td>
                      <td>EMAIL</td>
                      <td>PHONE NUMBER</td>
                      <td>ADDRESS</td>
                      <td>Department</td>
                      <td>Salary</td>
                      <td>ACTION</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $data = $emp->selectAllEmployee();
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
                        <?php echo $key['lastname'].' '.$key['firstname']; ?>
                      </td>
                      <td><div ><?php echo $key['gender']; ?></div></td>
                      <td><div><?php echo $key['email']; ?></div></td>
                      <td><div><?php echo $key['phone']; ?></div></td>
                      <td><div><?php echo $key['address']; ?></div></td>
                      <td><div><?php echo $key['department']; ?></div></td>
                      <td><div>$ <?php echo $key['salary']; ?></div></td>
                      <td>
                        <div class="icon-action">
                            <a href="edit_employee.php?id=<?php echo $key['Em_id'];?>"><i class="fa-solid fa-pen-to-square color-blue" ></i></a>
                        </div>
                        <div class="icon-action">
                            <a href="employee.php?id=<?php echo$key['Em_id'] ?>"><i class="fa-solid fa-trash color-red"></i></a>
                        </div>
                      </td>
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
  $data = $cust->deleteEmployeeById($id);
  
?>

