<?php
  session_start();
  require("../config/Users.php");
  include("../config/Orders.php");
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $sale = new Orders($conn);
  $data_sale = $sale->selectAllSaleReturn();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sales</title>
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
          <a href="index3.html" class="nav-link">Sales Return</a>
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
            <form action="" method="post">
            <!-- Button trigger modal -->
            <div class="button-date">
                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                    <input type="date" class="form-control"name="filterdate" value="2024-01-01">
                </div>
            </div>
            <div class="button-sort">
                <button type="submit" class="btn btn-block btn-primary" name="btnfilter">
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
                <table class="table table-hover text-nowrap" id="table-sale">
                  <thead>
                    <tr>
                      <th>REFERENCE</th>
                      <th>CUSTOMER</th>
                      <th>WAREHOUSE</th>
                      <th>STATUS</th>
                      <th>GRAND TOTAL</th>
                      <th>PAID</th>
                      <th>PAYMENT STATUS</th>
                      <th>CREATED ON</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(isset($_POST['btnfilter'])){
                            $date = $_POST['filterdate'];
                            $filterdate = $sale->filterSaleReturnByDate($date);
                            foreach($filterdate as $key){
                                ?>
                            <tr>
                                <td>
                                    <div class="text">
                                    <div class="text-color">
                                        <?php echo $key['invoice_number'];?>
                                    </div>
                                    </div>
                                </td>
                                <td><div><?php echo$key['Customer_name'];?></div></td>
                                <td><div><?php echo $key['Warehouse'];?></div></td>
                                <td><div ><?php echo $key['Status'];?></div></td>
                                <td><div>$ <?php echo $key['GrandTotal'];?></div></td>
                                <td><div>$ <?php echo $key['Payment_amount'];?></div></td>
                                <td><div><?php echo $key['Payment_Status'];?></div></td>
                                <td><div><?php  $date=new DateTime($key['CreateDate']); 
                                                $dates = $date->format('y-m-d');
                                                $time = $date->format('H:i A');
                                                echo $time.'<br>';
                                                echo $dates;
                                                ?></div></td>
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
                            <?php
                            }

                    ?>
                    <?php
                        }else{
                    ?>
                    <?php
                      foreach($data_sale as $key =>$val){
                    ?>
                    <tr>
                      <td>
                        <div class="text">
                          <div class="text-color">
                            <?php echo $val['invoice_number'];?>
                          </div>
                        </div>
                      </td>
                      <td><div><?php echo$val['Customer_name'];?></div></td>
                      <td><div><?php echo $val['Warehouse'];?></div></td>
                      <td><div ><?php echo $val['Status'];?></div></td>
                      <td><div>$ <?php echo $val['GrandTotal'];?></div></td>
                      <td><div>$ <?php echo $val['Payment_amount'];?></div></td>
                      <td><div><?php echo $val['Payment_type'];?></div></td>
                      <td><div><?php  $date=new DateTime($val['CreateDate']); 
                                      $dates = $date->format('y-m-d');
                                      $time = $date->format('H:i A');
                                      echo $time.'<br>';
                                      echo $dates;
                                      ?></div></td>
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
                   <?php } 
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
<script>
  $(document).ready(function(){
    $('#table-sale').DataTable(); 
  });
</script>
</body>
</html>
