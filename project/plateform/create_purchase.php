<?php 
    session_start();
    include("../model/conn.php");
    include("../config/Supplier.php");
    include("../config/Users.php");
    include("../config/Products.php");
    include("../config/Customer.php");
    include("../config/Category.php");
    include("../config/Brand.php");
    include("../config/Employee.php");
    include("../config/Orders.php");
    include("../config/OrderDetail.php");
    include("../config/Payment.php");
    
    $product = new Products($conn);
    $data_of_product = $product->selectAllProduct();
    $supplier = new Suppliers($conn);
    $data_of_supplier = $supplier->GetAllSuppliers();
    $pay = new Payments($conn);
    $employee = new Employee($conn);
    $order = new Orders($conn);
    $od = new OrderDetails($conn);
    $data_of_employee = $employee->selectAllEmployee();
    //Create Object Employee
    $ids = 1;
    $empl = $employee->selectEmployeeById($ids);
    //add to cart
    if(isset($_POST['add_purchase']))
    {
      if(isset($_COOKIE['add_purchase']))
      {
        $cookie_data = stripcslashes($_COOKIE['add_purchase']);
  
        $cart_data = json_decode($cookie_data,true);
      }
      else
      {
        $cart_data = array();
      }
      $item_id_list = array_column($cart_data,'Pro_id');
      if(in_array($_POST['id'],$item_id_list))
      {
        foreach($cart_data as $keys => $values)
        {
          if($cart_data[$keys]['Pro_id'] == $_POST['id'])
          {
            $cart_data[$keys]['UnitInStock'] = $cart_data[$keys]['UnitInStock'] + $_POST['qty'];
          }
        }
      }
      else
      {
        $item_array = array(
          "Pro_id" => $_GET['id'],
          "Product_name" => $_POST['name'],
          "UnitPrice" => $_POST['price'],
          "UnitInStock"=> $_POST['qty']
        );
        $cart_data[] = $item_array;
      }
      
      $item_data = json_encode($cart_data);
      setcookie('add_purchase',$item_data,time() + (86400 * 30));
      header('location: create_purchase.php?success=1');
    }
    if(isset($_GET['action']))
    {
      if($_GET["action"] == "delete")
      {
        $cookie_data = stripcslashes($_COOKIE['add_purchase']);
        $cart_data = json_decode($cookie_data,true);
        foreach($cart_data as $keys =>$values)
        {
          if($cart_data[$keys]['Pro_id'] == $_GET['id'])
          {
            unset($cart_data[$keys]);
            $item_data = json_encode($cart_data);
            setcookie('add_purchase', $item_data,time() + (8640 * 30));
            header('location: create_purchase.php?remove=1');
          }
        }
      }
      if($_GET['action'] == "clear")
      {
        setcookie('add_purchase','' , time() - 3600);
        header("location: create_purchase.php?clearall=1");
      }
    }
    if(isset($_GET['success']))
    {
      $message = '<div class ="alert alert-success swalDefultSuccess">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Added into Cart </div>';
    }
    if(isset($_GET['remove']))
    {
      $message = '<div class ="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item romve from Cart </div>';
    }
    $user_id = $_SESSION['id'];
    $user = new Users($conn);
    $users = $user->selectUsersById($user_id);

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Purchases</title>
 <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Modal-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Create New Suppliers
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Name<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="c_name" placeholder="Enter name">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Email<span class="color-red">*</span></label>
                <input type="email" class="form-control" name="c_email" placeholder="Enter email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Gender<span class="color-red">*</span></label>
                <select class="custom-select" name="c_gender">
                  <option value="Female">ស្រី</option>
                  <option value="Male">ប្រុស</option>
                  <option value="Other">ផ្សេង</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Country<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="c_country" placeholder="Enter Country">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Phone Number<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="c_phone" placeholder="Enter phone number">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Address<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="c_address" placeholder="Enter Address">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>City<span class="color-red">*</span></label>
                <input type="text" class="form-control" name="c_city" placeholder="Enter city">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Create On<span class="color-red">*</span></label>
                <input type="datetime-local" class="form-control" name="createdate" placeholder="Enter city">
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
<!--End Model -->
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
          <a href="index3.html" class="nav-link">Create Purchases</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
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
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Create Purchases</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-block btn-outline-primary">Back</button>
                </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
      <!-- /.content-header -->

   
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-5">
            <form action="" method="post">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa-solid fa-user nav-icon"></i></span>
                        </div>
                        <select name="employee" class="custom-select">
                          <?php 
                           foreach($data_of_employee as $key){
                          ?>
                          <option value="<?php echo $key['Em_id'];?>"><?php echo $key['department'];?></option>
                          <?php } ?>
                        </select>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <input type="datetime-local" name="create_date" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <input type="text" name="invoice" class="form-control" placeholder="PI00001">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-9">
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa-solid fa-user-group nav-icon"></i></span>
                            </div>
                            <select class="custom-select" name="supplier">
                              <?php 
                                foreach($data_of_supplier as $key=>$values){
                              ?>
                                <option value="<?php echo $values['Sup_id']; ?>"><?php echo $values['Supplier_name']; ?></option>
                              <?php }?>
                              
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                      <button type="button" class="btn btn-block bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Supplier</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="">Warehouse</label>
                        <select class="custom-select" name="warehouse">
                          <option value="warehouse">Warehouse</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-md">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Product Name</th>
                          <th>QTY</th>
                          <th>Sub Total</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      if(isset($_COOKIE['add_purchase']))
                      {
                          $total =0;
                          $qty = 0;
                          $tax=0;
                          $x=1;
                          $cookie_data = stripslashes($_COOKIE['add_purchase']);
                          $cart_data = json_decode($cookie_data,true);
                         
                          foreach($cart_data as $key=>$values)
                          {
                      ?>
                        <tr>
                          <td><?php echo $x++;?></td>
                          <td><input type="hidden" name="proid" value="<?php echo $values['Pro_id'];?>"><?php echo $values['Product_name'];?></td>
                          <td><input type="hidden" name="pro_qty" value="<?php echo $values['UnitInStock'];?>"><?php echo $values['UnitInStock'];?></td>
                          <td>
                          <?php echo number_format($values['UnitInStock']*$values['UnitPrice'],2);?>
                          </td>
                          <td><a href="create_purchase.php?action=delete&id=<?php echo $values['Pro_id']; ?>">
                          <i class="fa-solid fa-trash text-danger"></i></td>
                        </tr>
                        <?php
                          $total = $total + ($values['UnitInStock']*$values['UnitPrice']);
                         }
                        
                          }?>
                      </tbody>
                    </table>
                  </div>
                  </div>

                  <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-6">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Tax</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control">
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Total</label>
                            <div class="input-group mb-3">
                              <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input type="text" class="form-control" value="<?php if(isset($_POST['add']) or isset($_COOKIE))
                                      {
                                        echo number_format($total,2);
                                      }?>" disabled>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <select class="custom-select" name="pay_type">
                        <option>Choose payment type</option>
                        <option value="Cash">Cash</option>
                        <option value="ABA BANK">ABA BANK</option>
                        <option value="ACLEDA BANK">ACLEDA BANK</option>
                      </select>
                    </div>
                    
                    <div class="col-6">
                      <input type="text" name="pay_amount" class="form-control" placeholder="Enter payment amount">
                    </div>
                  </div>
                  <div class="margin-top-10"></div>
                  <div class="row">
                    <div class="col-12">
                      <select class="custom-select" name="status">
                        <option>Choose Status</option>
                        <option value="Ordered">Ordered</option>
                        <option value="Received">Received</option>
                      </select>
                    </div>
                  </div>
                  <div class="margin-top-10"></div>
                  <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3">
                      <input type="submit" class="btn btn-block bg-gradient-primary" name="btnPurchase" value="Save Purchase">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              </form>
            </div>
            <div class="col-7">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Products</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Code</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Qty</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $x= 1;
                        foreach($data_of_product as $key){
                      ?>
                      <form action="create_purchase.php?id=<?php echo $key['Pro_id'] ?>" method="post">
                        <tr>
                          <td><?php echo $x++; ?></td>
                          
                          <td><img src="<?php echo $key['image'] ?>" alt="" height="40px"></td>
                          <td><?php echo $key['Product_name']; ?></td>
                          <td><?php echo $key['Product_code']; ?></td>
                          <td>$ <?php echo $key['UnitPrice']; ?></td>
                          <td><div class="btn btn-success"><?php echo $key['UnitInStock'];?></div></td>
                          <input type="hidden" name="name" value="<?php echo $key['Product_name'];?>">
                          <input type="hidden" name="price" value="<?php echo $key['UnitPrice'];?>">
                          <td><input type="number" name="qty" class="form-control" style="width:80px;" value="1"></td>
                          <td><button type="submit" class="btn btn-primary" name="add_purchase"><i class="fa-solid fa-plus"></i></button></td>
                        </tr>
                      </form>
                      <?php
                        } ?>
                     
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>
                
            </div>
          </div>
        </div>    
      </section>
  
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
  if(isset($_POST['btnPurchase'])){
    $sup = $_POST['supplier'];
    $employ = $_POST['employee'];
    $payment_type = $_POST['pay_type'];
    $payment_amount = $_POST['pay_amount'];
    $status = $_POST['status'];
    $warehouse = $_POST['warehouse'];
    $invoice = $_POST['invoice'];
    $date = new DateTime($_POST['create_date']);
    $dates = $date->format('y-m-d H:i');
    if($status == 'Ordered'){
      $order->insertNewPurchase($sup,$employ,$dates,$warehouse,$status);
      $data_of_order = $order->selectOrdersByLastId();
      $order->insertNewInvoice($invoice,$data_of_order['Order_id']);
      $id = $order->selectInvoiceLastId();
      foreach($cart_data as $key){
        $od->insertNewOrderDetail($data_of_order['Order_id'],$key['Pro_id'],$key['UnitPrice'],$key['UnitInStock']);
        $product->updateStorkOrder($key['Pro_id'],$key['UnitInStock']);
      }
      $pay->insertPayment($payment_type,$payment_amount, $data_of_order['Order_id'],$id['invoice_id'],$dates);
      echo '<script>window.location="purchase.php" </script>';
    }else if($status == 'Received'){
      $order->insertNewPurchase($sup,$employ,$dates,$warehouse,$status);
      $data_of_order = $order->selectOrdersByLastId();
      $order->insertNewInvoice($invoice,$data_of_order['Order_id']);
      $id = $order->selectInvoiceLastId();
      foreach($cart_data as $key){
        $od->insertNewOrderDetail($data_of_order['Order_id'],$key['Pro_id'],$key['UnitPrice'],$key['UnitInStock']);
        $product->updateStockPurchase($key['Pro_id'],$key['UnitInStock']);
      }
      $pay->insertPayment($payment_type,$payment_amount, $data_of_order['Order_id'],$id['invoice_id'],$dates);
      echo '<script>window.location="purchase.php" </script>';
    }
  }
?>
