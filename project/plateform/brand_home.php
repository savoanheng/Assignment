<?php 
  session_start();
  require("../config/Users.php");
  require('../config/Brand.php');
  require('../model/conn.php');
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $brand = new Brand($conn);
  if(isset($_POST['name'])){
    $name = $_POST['name'];
    $brand->insertNewBrand($name);
  }
  $data = $brand->selectAllBrand();
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Brands</title>
  <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Brand Name:</label>
            <input type="text" name="name" class="form-control" id="recipient-name">
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
          <a href="index3.html" class="nav-link">Brands</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" href="pos_home.php" role="button">
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
<?php include("navigative_home.php") ?>
  <div class="body">
    <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header ">
        <div class="search mg-top">
            <div class="container-fluid">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="search" class="form-control" name="brandsearch" placeholder="Search brand name">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default" name="btnSearch">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
        <div class="button-header mg-top">
            <!-- Button trigger modal -->
            <div class="button-date">
              <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">
                Create Brand
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
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>BRAND NAME</th>
                      <th>PRODUCT COUNT</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(isset($_GET['btnSearch'])){
                        $brand_name = $_GET['brandsearch'];
                        $sql= $conn->prepare("SELECT B.Brand_id, B.Brand_name, COUNT(P.Brand_id) as CountProductByBrand FROM Brands as B INNER JOIN Products as P ON P.Brand_id = B.Brand_id
                                              WHERE Brand_name LIKE '%$brand_name%'
                                              GROUP BY  Brand_id,Brand_name,P.Brand_id;");
                        $sql->execute();
                        while($row = $sql->fetch()){
                          ?>
                          <tr>
                      <td>
                        <?php echo $row['Brand_name'];?>
                      </td>
                      <td><?php echo $row['CountProductByBrand'];?></td>
                      <td>
                        <div class="text-pro">
                            <div class="icon-action">
                                <a href="edit_brand_home.php?id=<?php echo $row['Brand_id']; ?>"><i class="fa-solid fa-pen-to-square color-blue"></i></a>
                            </div>
                            <div class="icon-action">
                                <a href="delete_brand.php?id=<?php echo $row['Brand_id']; ?>"><i class="fa-solid fa-trash color-red"></i></a>
                            </div>
                        </div>
                      </td>
                    </tr>
                    <?php
                        }
                      }else{
                        ?>
                        <?php
                    
                      foreach($data as $k){
                    ?>
                    <tr>
                      <td>
                        <?php echo $k['Brand_name'];?>
                      </td>
                      <td><?php echo $k['CountProductByBrand'];?></td>
                      <td>
                        <div class="text-pro">
                            <div class="icon-action">
                                <a href="edit_brand_home.php?id=<?php echo $k['Brand_id']; ?>"><i class="fa-solid fa-pen-to-square color-blue"></i></a>
                            </div>
                            <div class="icon-action">
                                <a href="delete_brand.php?id=<?php echo $k['Brand_id']; ?>"><i class="fa-solid fa-trash color-red"></i></a>
                            </div>
                        </div>
                      </td>
                    </tr>
                   <?php
                      }
                    }?>
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
</body>
</html>
<?php
   $brand_id = $_GET['id'];
   $brand->deleteBrand($brand_id);
?>
