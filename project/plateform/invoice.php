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
    $pay = new Payments($conn);
    $in = new Orders($conn);
    $invoice_id= $in->selectInvoiceLastId();
    $invoice= $in->selectInvoice($invoice_id['invoice_id']);
    $order = $in->selectOrdersByLastId();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Print Invoice</title>
  <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- Main content -->
            <div class="card">
              <!-- title row -->
               <div class="card-body">

                <div class="row">
                    <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> CS Shop
                        <small class="float-right">Date: 
                            <?php
                                $pdata = $pay->selectPayment();
                                $date = new DateTime($pdata['CreateDate']);
                                $dates = $date->format('d/m/y H:i A');
                                echo $dates;
                            ?>  
                        </small>
                    </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Computer Shop.</strong><br>
                        Phone: 096 765 789 <br>
                        Email: computershop@gmail.com
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                 
                    <address>
                       
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                    <b>Invoice : <?php 
                   
                    echo $invoice['invoice_number'];
                     ?></b><br>
                    <br>
                    <b>Order ID:</b><?php echo $order['Order_id']; ?><br>
                    <b>Payment Due:</b> <?php $d = $date->format('d/m/y');
                            echo $d; ?><br>
                   
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if(isset($_COOKIE['add_to_cart']))
                            {
                                $total =0;
                                $qty = 0;
                                $x = 1;
                                $cookie_data = stripslashes($_COOKIE['add_to_cart']);
                                $cart_data = json_decode($cookie_data,true);
                                foreach($cart_data as $key => $values)
                                {
                                ?>
                                   
                                  <tr>
                                    <td><?php echo $x++;?></td>
                                    <td><input type="hidden" name="proid" value="<?php echo $values['Pro_id'];?>"><?php echo $values['Product_name'];?></td>
                                    <td><input type="hidden" name="pro_qty" value="<?php echo $values['UnitInStock']?>"><?php echo $values['UnitInStock'];?></td>
                                    <td><input type="hidden" name="pro_price" value="<?php echo $values['UnitPrice'];?>">$ <?php echo $values['UnitPrice'];?></td>
                                    <td>$ <?php echo number_format($values['UnitInStock']*$values['UnitPrice'],2);?></td>
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
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                    
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                    <p class="lead">Amount Due 
                      <?php 
                            $d = $date->format('d/m/y');
                            echo $d;
                            ?></p>

                    <div class="table-responsive">
                        <table class="table">
                        <tbody><tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>$ <?=number_format($total,2);?></td>
                        </tr>
                        <tr>
                            <th>Tax </th>
                            <td>$0.0</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>$ <?=number_format($total,2);?></td>
                        </tr>
                        </tbody></table>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                
                </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
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
    window.print();
</script>
</body>
</html>
