<?php 
  include("../model/conn.php");
  include("../config/Supplier.php");
  include("../config/Products.php");
  include("../config/Customer.php");
  include("../config/Category.php");
  include("../config/Brand.php");
  include("../config/Employee.php");
  include("../config/Orders.php");
  include("../config/OrderDetail.php");
  include("../config/Payment.php");
  $x = 0;
  //Create Object Products
  $pro = new Products($conn);
  //Call function SelectAllProduct
  $row = $pro->selectAllProduct();

  if(isset($_POST['add_to_cart']))
  {
    if(isset($_COOKIE['add_to_cart']))
    {
      $cookie_data = stripcslashes($_COOKIE['add_to_cart']);

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
    setcookie('add_to_cart',$item_data,time() + (86400 * 30));
    header('location: pos_home.php?success=1');
  }
  if(isset($_GET['action']))
  {
    if($_GET["action"] == "delete")
    {
      $cookie_data = stripcslashes($_COOKIE['add_to_cart']);
      $cart_data = json_decode($cookie_data,true);
      foreach($cart_data as $keys =>$values)
      {
        if($cart_data[$keys]['Pro_id'] == $_GET['id'])
        {
          unset($cart_data[$keys]);
          $item_data = json_encode($cart_data);
          setcookie('add_to_cart', $item_data,time() + (8640 * 30));
          header('location: pos_home.php?remove=1');
        }
      }
    }
    if($_GET['action'] == "clear")
    {
      setcookie('add_to_cart','' , time() - 3600);
      header("location: pos_home.php?clearall=1");
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
  // Create Object Employee
  $emp = new Employee($conn);
  $edata = $emp->selectAllEmployee();
  $cus = new Customers($conn);
  if(isset($_POST['btnSave']))
  {
    $cname = $_POST['c_name'];
    $cemail = $_POST['c_email'];
    $cgender = $_POST['c_gender'];
    $ccountry = $_POST['c_country'];
    $cphone = $_POST['c_phone'];
    $caddress = $_POST['c_address'];
    $ccity = $_POST['c_city'];
    $cdate = new DateTime($_POST['c_createdate']);
    $c_date = $cdate->format('y-m-d H:i');
    $cus->insertCustomer($cname,$cgender,$cphone,$ccity,$cemail,$ccountry,$caddress,$C_date);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POS</title>
 <?php include("header.php") ?>
</head>
<body class="bg-pri">
<!-- Modal-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Create Customer
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
 
 <form action="pos.php" method="post">
  <div class="header-pos">
    <div class="row">
      <div class="col-2">
        <div class="input-group mb-3">
          <input type="datetime-local" name="create_date" class="form-control  form-control-lg">
        </div>
      </div>
      <div class="col-2">
        <div class="input-group mb-3">
          <?php 
            $cdata = $cus->GetAllCustomer();
          ?>
          <select class="form-control form-control-lg" name="customer">
            <?php 
              foreach($cdata as $key)
              {
            ?>
             <option value="<?=$key['Cus_id'];?>"><?=$key['Customer_name'];?></option>
             <?php } ?>  
          </select>
          <div class="input-group-append">
            <span class="input-group-text" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-user-plus"></i></span>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="input-group mb-3">
          <select class="form-control form-control-lg" name="warehouse">
            <option value="warehouse">Warehouse</option>                
          </select>
          <div class="input-group-append">
            <span class="input-group-text"><i class="fa-solid fa-house"></i></span>
          </div>
        </div>
      </div>
      <div class="col-3">
        <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here">
      </div>
      <div class="col-3">
        <button type="button" class="btn bg-gradient-pink position-relative" style="height: 45px;width:45px;">
        <i class="fa-solid fa-list"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
            <?php
              echo $x; 
            ?>
            <span class="visually-hidden">unread messages</span>
          </span>
        </button>
        <button type="button" class="btn bg-gradient-success position-relative" style="height: 45px;width:45px;margin-left:10px;">
          <i class="fa-solid fa-bag-shopping"></i>
        </button>
        <a href="dashboard.php" class="btn btn-primary position-relative" style="height: 45px;width:45px;margin-left:10px;">
          <i class="fa-solid fa-gauge"></i>
        </a>
      </div>
    </div>
   
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <div class="card card-outline">
           
            <div class="pos-left">
            <div class="card-body p-0" style="height: 500px;">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <td>PRODUCT</td>
                      <td>QTY</td>
                      <td>PRICE</td>
                      <td>SUB TOTAL</td>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(isset($_COOKIE['add_to_cart']))
                      {
                          $total =0;
                          $qty = 0;
                          $cookie_data = stripslashes($_COOKIE['add_to_cart']);
                          $cart_data = json_decode($cookie_data,true);
                          foreach($cart_data as $key => $values)
                          {
                          ?>
                            <tr>
                              <td><input type="hidden" name="proid" value="<?php echo $values['Pro_id'];?>"><?php echo $values['Product_name'];?></td>
                              <td><input type="hidden" name="pro_qty" value="<?php echo $values['UnitInStock'];?>"><?php echo $values['UnitInStock'];?></td>
                              <td><input type="hidden" name="pro_price" value="<?php echo $values['UnitPrice'];?>">$ <?php echo $values['UnitPrice'];?></td>
                              <td>$ <?php echo number_format($values['UnitInStock']*$values['UnitPrice'],2);?></td>
                              <td><a href="pos.php?action=delete&id=<?php echo $values['Pro_id']; ?>">
                                <i class="fa-solid fa-trash text-danger"></i>
                              </a></td>
                            </tr>
                          <?php 
                            $total = $total + ($values['UnitInStock']*$values['UnitPrice']);
                            $qty = $qty + ($values['UnitInStock']);
                          ?>
                          <?php
                          }
                          $count = count($cart_data);
                          
                      }
                      else
                      {
                        echo '<tr>
                          <td colspan="4" align="center"> No Item in Cart </td>
                        </tr>';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Tax">
                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Discount">
                      <div class="input-group-append">
                        <span class="input-group-text">$</span>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Discount">
                      <div class="input-group-append">
                        <span class="input-group-text">$</span>
                      </div>
                    </div>
                    
                </div>

                <div class="col-6">
                  <div class="text-total">
                    <span class="txt">Total QTY :</span>
                    <span class="txt"><?php 
                      if(isset($_POST['add_to_cart']) or isset($_COOKIE))
                      {
                        echo number_format($qty);
                      }
                    ?></span>
                  </div>
                  <div class="text-total">
                    <span class="txt">Sub Total :</span>
                    <span class="txt">$ <?php  
                    if(isset($_POST['add_to_cart']) or isset($_COOKIE))
                    {
                      echo number_format($total,2);
                    }
                     ?></span>
                  </div>
                  <div class="text-total">
                    <span class="txt">Total: $</span>
                    <span class="txt"><?php  
                    if(isset($_POST['add_to_cart']) or isset($_COOKIE))
                    {
                      echo number_format($total,2);
                    }
                     ?></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <button type="button" class="btn btn-block bg-gradient-pink">Hold</button>
                </div>
                <div class="col-4">
                  <a href="pos.php?action=clear" class="btn btn-block  bg-gradient-danger">Delete</a>
                </div>
                <div class="col-4">
                  <button type="button" id="btnPayon" class="btn btn-block bg-gradient-success" name="btnPayon" data-bs-toggle="modal" data-bs-target="#exampleModal">Pay ON</button>
                </div>
                  
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabels">Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                      <div class="form-group">
                        <label>Invoice Number: </label>
                        <input type="text" name="invoice" class="form-control" placeholder="POSI-00001">
                      </div>
                </div>
                <div class="row">
                      <div class="form-group">
                        <label>Payment Type: </label>
                        <select class="custom-select" name="payment_type">
                          <option value="Cash">Cash</option> 
                          <option value="ABA BANK">ABA BANK</option> 
                          <option value="ACLEDA BANK">ACLEDA BANK</option> 
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Payment By:</label>
                        <select class="custom-select" name="create_by">
                          <?php foreach($edata as $key){ ?>
                          <option value="<?php echo $key['Em_id'];?>" ><?php echo $key['department'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                        
                </div>
                <div class="row">
                  <div class="col-4">
                    <p>Total:</p>
                  </div>
                  <div class="col-4">
                    $ <?php 
                    if(isset($_POST['add_to_cart']) or isset($_COOKIE))
                    {
                      echo number_format($total,2);
                    } ?>
                  </div>
                  <div class="col-4">
                    R <?php 
                    if(isset($_POST['add_to_cart']) or isset($_COOKIE))
                    {
                     $riel = $total * 4100;
                     echo number_format($riel,2);
                    } ?>
                  </div>
                </div>
                <div class="margin-top-10"></div>
                <div class="row">
                  <div class="col-4">
                    <p>Dollar Pay :</p>
                  </div>
                  <div class="col-6">
                    <input type="text" class="form-control" placeholder="Dollar pay" name="payment_amount">
                  </div>
                </div>
                <div class="margin-top-10"></div>
                <div class="row">
                  <div class="col-4">
                    <p>Riels Pay :</p>
                  </div>
                </div>
                <div class="margin-top-10"></div>
                <div class="row">
                  <div class="col-4">
                    <p>Remainning :</p>
                  </div>
                  <div class="col-4">
                    0.00
                  </div>
                </div>
                <div class="margin-top-10"></div>
                <div class="row">
                      <div class="form-group">
                        <label>Status: </label>
                        <select class="custom-select" name="status">
                          <option value="Ordered">Ordered</option> 
                          <option value="Received">Received</option> 
                        </select>
                      </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="btnPayment" value="Pay & Print">
              </div>
            </div>
          </div>
        </div>
        </form>

        <div class="col-6">
        <div class="pos-right">
          <div class="cate">
            <button type="button" class="btn btn-block btn-primary btn-sm">All Categories</button>
          </div>
          <?php
                $cate = new Category($conn);
                $data = $cate->GetAllCategory();
                foreach($data as $ke){
            ?>
          <div class="cate-item">
            <button type="button" class="btn btn-block btn-default btn-sm"><?=$ke['Category_name']; ?></button>
          </div>
          <?php } ?>
          <div class="clear"></div>

          <div class="cate">
              <button type="button" class="btn btn-block btn-primary btn-sm">All Brands</button>
          </div>
          <?php 
              $brand = new Brand($conn);
              $bdata = $brand->GetAllRecord();
              foreach($bdata as $keys){
          ?>
          <div class="cate-item">
            <button type="button" class="btn btn-block btn-default btn-sm"><?php echo $keys['Brand_name']; ?></button>
          </div>
          <?php } ?>
          <div class="clear"></div>
          <div class="margin-top-10"></div>
      <!--box product-->
        <div class="box-all-product">
          <?php 
            foreach($row as $key){
 
          ?>
          <div class="box-product">
            <form action="pos.php?id=<?php echo $key['Pro_id'] ?>" method="post">
            <div class="price">$ <?php echo $key['UnitPrice'] ?></div>
            <div class="unit"><?php echo $key['UnitInStock'].' '.$key['Unit'];?></div>
            <div class="image-product">
              <img src="<?php echo $key['image'] ?>" alt="" height="100px">
            </div>
            <div class="fn-size fn-weight margin-left-10" style="margin-top: 40px;"><?php echo $key['Product_name'];?></div>
            <div class="fn-size margin-left-10"><?php echo $key['Brand_name'];?></div>
            <input type="hidden" name="name" value="<?php echo $key['Product_name'];?>">
            <input type="hidden" name="price" value="<?php echo $key['UnitPrice'];?>">
            <div class="fn-size margin-left-10">
              <input type="number" class="form-control" name="qty" style="height:30px;width:160px;font-size:11px;" value="1">
            </div>
            <div class="margin-top-10 margin-left-10">
              <input type="submit" class="btn btn-primary" name="add_to_cart" value="Add to Cart" style="height: 30px; width:160px;font-size:11px;">
            </div>
            </form>
          </div>
          <?php } ?>
        </div>
      <!--End product-->
        </div>
         
      </div>
      </div>
      
  </div>
 </div>
<?php include("footer.php") ?>
</body>
</html>
<?php 

  if(isset($_POST['btnPayment']))
  {
    $cust = $_POST['customer'];
    $ware = $_POST['warehouse'];
    $pay_type = $_POST['payment_type'];
    $pay_amount = $_POST['payment_amount'];
    $date =new DateTime($_POST['create_date']);
    $datetime=$date->format("y-m-d H:i");
    $pay_by = $_POST['create_by'];
    $status = $_POST['status'];
    $invoice = $_POST['invoice'];
    $order = new Orders($conn);
    $OD = new OrderDetails($conn);
    $pay = new Payments($conn);
    //call method insertneworder from class Orders
    $order->insertNewOrder($cust,$pay_by,$ware,$status,$datetime);
    $odata = $order->selectOrdersByLastId();
    $order->insertNewInvoice($invoice,$odata['Order_id']);
    $id = $order->selectInvoiceLastId();
    foreach($cart_data as $key)
    {
      $OD->insertNewOrderDetail($odata['Order_id'],$key['Pro_id'],$key['UnitPrice'],$key['UnitInStock']);
      $pro->updateStock($key['Pro_id'],$key['UnitInStock']);
      $pro->updateRecordLevel($key['Pro_id']);
    }
    $pay->insertPayment($pay_type,$pay_amount,$odata['Order_id'],$id['invoice_id'],$datetime); 
    $pdata = $pay->selectPayment();
    echo '<script>window.location="invoice.php" </script>';
    $x++;
    echo var_dump($x);
  // echo '<script>
    //  window.alert("Order Product Successfull");
  // </script>';
  }
?>