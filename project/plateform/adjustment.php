<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adjustments</title>
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
          <a href="index3.html" class="nav-link">Adjustments</a>
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

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
  </div>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-boxes-stacked nav-icon"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                <i class="fa-solid fa-boxes-stacked nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="fa-solid fa-cart-flatbed nav-icon"></i>
                  <p>Products Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                <i class="fa-solid fa-quote-right nav-icon"></i>
                  <p>Units</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-map-location nav-icon"></i>
              <p>
                Adjustments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-basket-shopping nav-icon"></i>
              <p>
                Quotations
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-receipt nav-icon"></i>
              <p>
                Purchases
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                <i class="fa-solid fa-receipt nav-icon"></i>
                  <p>Purchases</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                <i class="fa-solid fa-arrow-right nav-icon"></i>
                  <p>Purchases Returns</p>
                </a>
              </li>
          
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-cart-shopping nav-icon"></i>
              <p>
                Sales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                <i class="fa-solid fa-cart-shopping nav-icon"></i>
                  <p>Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                <i class="fa-solid fa-arrow-right nav-icon"></i>
                  <p>Sales Returns</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
            <i class="fa-solid fa-map-location nav-icon"></i>
              <p>
                Transfers
                
              </p>
            </a>
          </li>   
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-money-bills nav-icon"></i>
              <p>
                Expenses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expenses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expenses Category</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-user nav-icon"></i>
              <p>
                Peoples
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                <i class="fa-solid fa-truck nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fa-solid fa-user-group nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/e-commerce.html" class="nav-link">
                <i class="fa-solid fa-user nav-icon"></i>
                  <p>Users</p>
                </a>
              </li> 
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-shield nav-icon"></i>
              <p>
                Roles/Permissions
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-warehouse nav-icon"></i>
              <p>
                Warehouse
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="iframe.html" class="nav-link">
            <i class="fa-solid fa-chart-line nav-icon"></i>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
            <i class="fa-solid fa-dollar-sign nav-icon"></i>
              <p>Currencies</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-gear nav-icon"></i>
              <p>Settings</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="body">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Stock Adjustments</h1>
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
                        <h3 class="card-title">All stock adjustments</h3>
                      </div>
                      <div class="col-4"></div>
                      <div class="col-1"></div>
                      <div class="col-1">
                        <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Add</button>
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
                                    <th>Date</th>
                                    <th>Reference No</th>
                                    <th>Warehouse</th>
                                    <th>Adjustment type</th>
                                  
                                    <th>Total Amount</th>
                                    <th>Total amount recovered</th>
                                    <th>Reason</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <div class="dates">
                                        08/04/2021
                                        02:06
                                      </div>
                                    </td>
                                    <td>EP2021/0001</td>
                                    <td>Warehouse1</td>
                                    <td>Laptop</td>
            
                                    <td>
                                      <span>$ </span>
                                      <span>200.00</span>
                                    </td>
                                    <td>
                                      <span>$ </span>
                                      <span>200.00</span>
                                    </td>
                                    <td>
                                      Cashier2
                                    </td>
                                    <td></td>
                                    <td>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary">Action</button>
                                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <div class="dropdown-menu" role="menu" >
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square"></i> <span> </span> View</a>
                                        <a class="dropdown-item" href="#"> <i class="fa-solid fa-trash"></i> Delete</a>
                                
                                      </div>
                                    </div>
                                    </td>
                                  </tr>
                                  
        
                                </tbody>
                              </table>
                              <tfoot>
                              
                              </tfoot>
                            </table>
                          </div></div>
                          <div class="row">
                            <div class="col-md-5">
                              <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                Showing 1 to 10 of 57 entries
                              </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-4"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                              <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="example1_previous">
                                  <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">
                                    Previous
                                  </a>
                                </li>
                                <li class="paginate_button page-item active">
                                  <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">
                                    1
                                  </a>
                                </li>
                                <li class="paginate_button page-item ">
                                  <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">
                                    2
                                  </a>
                                </li>
                                <li class="paginate_button page-item ">
                                  <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">
                                    3
                                  </a>
                                </li>
                                <li class="paginate_button page-item ">
                                  <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">
                                    4
                                  </a>
                                </li>
                                <li class="paginate_button page-item ">
                                  <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">
                                    5
                                  </a>
                                </li>
                                <li class="paginate_button page-item ">
                                  <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">
                                    6
                                  </a>
                                </li>
                                <li class="paginate_button page-item next" id="example1_next">
                                  <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">
                                    Next
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>
