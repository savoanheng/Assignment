<?php 
  session_start();
  include("../config/Employee.php");
  require("../config/Users.php");
  include("../config/Expense.php");
  $emp = new Employee($conn);
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  $data_of_emp = $emp->selectEmployeeById($user_id);
  $expense = new Expenses($conn);
  if(isset($_POST['btnAddExpense'])){
    $create_by = $_POST['create_by'];
    $reference = $_POST['reference_name'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $payment_type = $_POST['payment_type'];
    $note = $_POST['note'];
    $expense->insertExpense($reference,$amount,$description,$note,$payment_type,$create_by);

  }
  $data = $expense->selectAllExpense();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Expenses</title>
  <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Expense</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="create_by" value="<?php echo  $data_of_emp['lastname'].' '.$data_of_emp['firstname'];?>">
            <div class="form-group">
              <input type="text" name="reference_name" class="form-control" placeholder="Reference Number">
            </div>
            <div class="form-group">
              <input type="text" name="description" class="form-control" placeholder="Description">
            </div>
            <div class="form-group">
              <input type="text" name="amount" class="form-control" placeholder="Amount">
            </div>
            <div class="form-group">
              <select name="payment_type" class="custom-select">
                <option value="Cash">Cash</option>
                <option value="ABA">ABA Bank</option>
                <option value="ACLEDA">ACLEDA Bank</option>
              </select>
            </div>
            <div class="form-group">
              <textarea type="text" name="note" class="form-control" placeholder="Note"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Add Expense" name="btnAddExpense" id="btnAdd">
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
          <a href="index3.html" class="nav-link">Expenses</a>
        </li>
      </ul>
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
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Expenses</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <h3 class="card-title">All Expenses</h3>
                      </div>
                      <div class="col-4"></div>
                      <div class="col-1"></div>
                      <div class="col-1">
                        <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Expense</button>
                      </div>
                    </div>
                    <div class="margin-top"></div>
                    <div class="row">
                      <div class="col-4">
                        <span class="sort-show">Show</span>
                        <span class="sort">
                          <select class="form-control">
                            <option>10</option>
                            <option>20</option>
                            <option>30</option>
                            <option>40</option>
                            <option>50</option>
                          </select>
                        </span>
                        <span class="sort-show">entries</span>
                      </div>

                      <div class="col-4">
                        <div class="dt-buttons btn-group flex-wrap">   
                          <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button">
                            <span>Copy</span>
                          </button>
                          <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button">
                            <span> CSV</span>
                          </button> 
                          <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button">
                            <span> Excel</span>
                          </button> 
                          <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button">
                            <span> PDF</span>
                          </button> 
                          <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button">
                            <span>Print</span>
                          </button> 
                        </div>
                      </div>

                      <div class="col-2">
                      </div>
                      <div class="col-md-2">
                        <div id="example1_filter" class="dataTables_filter">
                            <input type="search" class="form-control form-control-sm" placeholder="Search" aria-controls="example1">
                        </div>
                      </div>
                    </div>

                    <div class="margin-top"></div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Reference No</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Create By</th>
                                    <th>Create Date</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach($data as $key){
                                  ?>
                                  <tr>
                                    <td><?php echo$key['refer_name']; ?></td>
                                    <td><?php echo$key['description']; ?></td>
                                    <td><?php echo$key['ex_amount']; ?></td>
                                    <td><?php echo$key['payment_type']; ?></td>
                                    <td><?php echo$key['create_by']; ?></td>
                                    <td>
                                      <div class="dates">
                                        <?php 
                                          $dates = new DateTime($key['create_date']);
                                          $date = $dates->format('d/m/y');
                                          $time = $dates->format('H:i');
                                          echo $date.'<br>';
                                          echo $time;
                                        ?>
                                      </div>
                                    </td>
                                    <td><?php echo$key['note']; ?></td>
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
                                  <?php }?>
                                 
                                </tbody>
                              </table>
                              <tfoot>
                              
                              </tfoot>
                            </table>
                          </div>
                          
                          </div>
                          <!-- /.card-body -->
                        </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                </div>
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
