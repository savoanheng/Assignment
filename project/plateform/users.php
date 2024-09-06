<?php
    session_start();
    require("../model/conn.php");
    require("../config/Users.php");
    $user_id = $_SESSION['id'];
    $us = new Users($conn);
    $users = $us->selectAllUsers();
    $user = $us->selectUsersById($user_id);
    $create = $us->GetAllUsers();
    if(isset($_POST['btnSubmit']))
    {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $createby = $_POST['create_by'];
        $us->addNewUsers($fullname,$username,$password,$role,$createby);
        header('location:users.php');
    }
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Create New User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>FullName<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="fullname" placeholder="Enter fullname">
              </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Role<span class="color-red">*</span></label>
                    <select name="role" class="custom-select">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
              
            </div>
          </div>
          <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Username<span class="color-red">*</span></label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Create By<span class="color-red">*</span></label>
                <select name="create_by" class="custom-select" >
                    <?php 
                        foreach ($create as $key){
                    ?>
                    <option value="<?php echo $key['fullname']; ?>"><?php echo $key['fullname'];?></option>
                    <?php }?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Password<span class="color-red">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password" id="myPassword">
                    <div class="margin-top-10"></div>
                    <input type="checkbox" onclick="myFunction()"> Show Password
                </div>
            </div>
            
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" name="btnSubmit" value="Submit">
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
          <a href="index3.html" class="nav-link">Users</a>
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
            <?php echo $user['fullname'];?><img src="<?php echo $user['image'];?>" style="width: 30px;height:30px;border-radius: 50%;">
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?php echo $user['image'];?>" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?php echo $user['fullname']; ?></h3>

                <p class="text-muted text-center"><?php echo $user['roles']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <a href="update_user.php?id=<?php echo  $user['user_id'];?>"><i class="fa-solid fa-user nav-icon"></i> Profile</a>
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
                        <input type="search" name="search" class="form-control " placeholder="Search by username">
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
                Create Users
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
                <table class="table">
                  <thead>
                    <th></th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Create By</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                   <?php 
                   if(isset($_POST['btnSearch']))
                   {
                        $search = $_POST['search'];
                        $sql = $conn->prepare("SELECT U.user_id,I.image,U.fullname,U.username,U.roles, U.create_by FROM Users as U inner JOIN images as I ON I.image_id = U.image_id
                                            where username LIKE '%$search%'");
                        $sql->execute();
                        while($key = $sql->fetch()){
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo $key['image'];?>" alt="" width="50px" height="50px" style="border-radius: 50%;">
                        </td>
                        <td><?php echo $key['fullname'];?></td>
                        <td><?php echo $key['username'];?></td>
                        <td><div class="btn btn-primary"><?php echo $key['roles'];  ?></div></td>
                        <td><div><?php echo $key['create_by']; ?></div></td>
                        <td>
                            <div class="icon-action">
                                <a href="update_user.php?id=<?php echo $key['user_id'];?>"><i class="fa-solid fa-pen-to-square color-blue"></i></a>
                            </div>
                            <div class="icon-action">
                                <a href="users.php?id=<?php echo $key['user_id']; ?>"><i class="fa-solid fa-trash color-red" role="button"></i></a>
                            </div>
                        </td>
                    </tr>
                   <?php }
                    }else{ ?>
                   <?php 
                      foreach($users as $key){
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo $key['image'];?>" alt="" width="50px" height="50px" style="border-radius: 50%;">
                        </td>
                        <td><?php echo $key['fullname'];?></td>
                        <td><?php echo $key['username'];?></td>
                        <td><div class="btn btn-primary"><?php echo $key['roles'];  ?></div></td>
                        <td><div><?php echo $key['create_by']; ?></div></td>
                        <td>
                            <div class="icon-action">
                                <a href="update_user.php?id=<?php echo $key['user_id'];?>"><i class="fa-solid fa-pen-to-square color-blue"></i></a>
                            </div>
                            <div class="icon-action">
                                <a href="delete_user.php?id=<?php echo $key['user_id']; ?>"><i class="fa-solid fa-trash color-red" role="button"></i></a>
                            </div>
                        </td>
                    </tr>
                   <?php 
                        }
                    }
                    ?>
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
   function myFunction() {
  var x = document.getElementById("myPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>

