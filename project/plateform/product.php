<?php 
  session_start();
  require("../config/Users.php");
  include "../model/conn.php";
  include "../config/Products.php";
  require("../config/Employee.php");
  //Create Object Employee
  $pro = new Products($conn);
  $data =  $pro->selectAllProduct();
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);

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
          <a href="index3.html" class="nav-link">Products</a>
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
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control " name="search" placeholder="Search product name">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-default" value='Search' name="btnsearch" >
                        </div>
                    </div>
                </form>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
        <div class="button-header mg-top">
            <!-- Button trigger modal -->
            <div class="button-item">
              <a class="btn btn-block btn-primary" href="create_new_product.php">
              Add Products</a>
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
                <table class="table table-hover text-nowrap" id="table-product">
                  <thead>
                    <tr>
                      <th>PRODUCT</th>
                      <th>CODE</th>
                      <th>BRAND</th>
                      <th>CATEGORY</th>
                      <th>PRICE</th>
                      <th>PRODUCT UNIT</th>
                      <th>INSTOCK</th>
                      <th>CREATE ON</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    if(isset($_POST['btnsearch'])){
                      $name = $_POST['search'];
                      $sql = $conn->prepare( "Select I.image, P.Product_name, P.Product_code, B.Brand_name, C.Category_name,P.UnitPrice, P.Unit, P.UnitInStock, P.CreateDate
                                              From Products as P inner join Brands as B on B.Brand_id = P.Brand_id
                                                        inner join Category as C on C.Cate_id = P.Cate_id
                                                                inner join images as I on I.image_id = P.image_id
                                                                WHERE Product_name LIKE '%$name%'
                                              GROUP BY image, Product_name, Product_code, Brand_name, Category_name, UnitPrice, Unit, UnitInStock, CreateDate
                                              ;");
                      $sql->execute();
                    while ($data = $sql->fetch()){
                           
                   ?>
                   <tr>
                   <td>
                       <img src="<?php echo $data['image'];?>" alt="" style="width:40px;height:30px;border-radius:1px;" >
                       <?php echo $data["Product_name"]; ?>
                     </td>
                     <td><?php echo$data["Product_code"]; ?></td>
                     <td><?php echo$data["Brand_name"]; ?></td>
                     <td><?php echo$data["Category_name"]; ?></td>
                     <td>$ <?php echo$data["UnitPrice"]; ?></td>
                     <td><?php echo$data["Unit"]; ?></td>
                     <td><?php echo$data["UnitInStock"]; ?></td>
                     <td><div class="dates"><?php echo$data["CreateDate"]; ?></div></td>
                     <td>
                       <div class="text-pro">
                           <div class="icon-action">
                               <i class="fa-solid fa-pen-to-square color-blue"></i>
                           </div>
                           <div class="icon-action">
                               <i class="fa-solid fa-trash color-red" data-bs-toggle="modal" href="#exampleModalToggle" role="button"></i>
                           </div>
                       </div>
                     </td>
                   
                   </tr>
                   <?php 
                      }
                    }else{
                      ?>
                    <?php
                      foreach($data as $key){
                    ?>
                      <tr>
                      <td>
                          <img src="<?php echo $key['image'];?>" alt="" style="width:40px;height:30px;border-radius:1px;" >
                          <?php echo $key["Product_name"]; ?>
                        </td>
                        <td><?php echo$key["Product_code"]; ?></td>
                        <td><?php echo$key["Brand_name"]; ?></td>
                        <td><?php echo$key["Category_name"]; ?></td>
                        <td>$ <?php echo$key["UnitPrice"]; ?></td>
                        <td><?php echo$key["Unit"]; ?></td>
                        <td><?php echo$key["UnitInStock"]; ?></td>
                        <td>
                          <div class="dates"><?php 
                            $date = new DateTime($key["CreateDate"]);
                            $time = $date->format('H:i A');
                            $dates = $date->format('y-m-d');
                            echo $dates.'<br>';
                            echo $time; ?>
                          </div>
                        </td>
                        <td>
                          <div class="text-pro">
                              <div class="icon-action">
                                  <a href="edit_product.php?id=<?php echo $key['Pro_id'];?>"><i class="fa-solid fa-pen-to-square color-blue"></i></a>
                              </div>
                              <div class="icon-action">
                                <a href="delete_product.php?id=<?php echo $key['Pro_id'];?>"><i class="fa-solid fa-trash color-red"></i></a>
                              </div>
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
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  
                </ul>
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
    $('#table-product').DataTable(); 
  });
</script>
</body>
</html>

