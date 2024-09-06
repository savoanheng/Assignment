<?php 
  session_start();
  include("../model/conn.php");
  include("../config/image.php");
  include("../config/Products.php");
  include("../config/Brand.php");
  include("../config/Category.php");
  $user_id = $_SESSION['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);
  //Click Upload Image 
  if(ISSET($_POST['upload'])){
		// Count total files
    $countfiles = count($_FILES['files']['name']);
   
    // Prepared statement
    $query = "INSERT INTO images (name,image) VALUES(?,?)";
  
    $statement = $conn->prepare($query);
  
    // Loop all files
    for($i = 0; $i < $countfiles; $i++) {
  
        // File name
        $filename = $_FILES['files']['name'][$i];
      
        // Location
        $target_file = './photo/'.$filename;
      
        // file extension
        $file_extension = pathinfo(
            $target_file, PATHINFO_EXTENSION);
             
        $file_extension = strtolower($file_extension);
      
        // Valid image extension
        $valid_extension = array("png","jpeg","jpg");
      
        if(in_array($file_extension, $valid_extension)) {
  
            // Upload file
            if(move_uploaded_file(
                $_FILES['files']['tmp_name'][$i],
                $target_file)
            ) {
 
                // Execute query
                $statement->execute(
                    array($filename,$target_file));
            }
        }
    }
	} 
  if(isset($_POST['btnSubmit'])){
    $img = new Image($conn);
    $id = $img->selectLastId();
    $name = $_POST["proname"];
    $code = $_POST["procode"];
    $brand = $_POST["brand"];
    $cate = $_POST["category"];
    $qty = $_POST["qty"];
    $unit = $_POST["unit"];
    $price =  $_POST["price"];
    $dt = new DateTime($_POST['date']);
    $date = $dt->format('Y-m-d H:i');
    $product = new Products($conn);
    $insertProduct = $product->insertProduct($name,$code,$brand,$cate,$qty,$unit,$price,$date,$id['image_id']);
    header("location: product_home.php");
  }
  

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
          <a href="#" class="nav-link">Create New Products</a>
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
      <!-- Main content -->
      <section class="content mg-top">
        <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <center><h3>Add Photo</h3></center>
                  <div id="upload">
                     <input type="file" class="custom-file-input" name='files[]' required="required" style="position:absolute; z-index:2;margin-top:30px; width:100px;" multiple/> 
                    <label><i class="fa-solid fa-camera" style="position: absolute; z-index:1;margin-top:15px;margin-left:25px;font-size:50px;opacity:0.5;"></i></label>
                  </div>
                  <div class="margin-top"></div>
                      <div class="upload margin-left-10">
                          <div class="float-left margin-left-20">
                            <button name="" class="btn btn-danger">cancel</button> 
                          </div>
                          <div class="float-left margin-left-20">
                            <button name="upload" class="btn btn-success">Upload</button>
                          </div>
                      </div>
                  <div class="clear"></div>
                </form>
        
              <form action="" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="proname" placeholder="Enter product name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Quantity<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="qty" placeholder="Enter qty">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Code<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="procode" placeholder="Enter product code">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Unit<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="unit" placeholder="Enter unit">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Brand<span class="color-red">*</span></label>
                            <select class="custom-select" name="brand">
                            <?php 
                                $brand = new Brand($conn);
                                $data = $brand->GetAllRecord();
                                foreach($data as $key =>$val){

                            ?>
                            <option value="<?=$val['Brand_id']; ?>" > <?=$val['Brand_name']; ?> </option>
                            <?php  } 
                            
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price<span class="color-red">*</span></label>
                            <input type="text" class="form-control" name="price" placeholder="Enter price">
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Category<span class="color-red">*</span></label>
                            <select class="custom-select" name="category">
                            <?php 
                                $cate = new Category($conn);
                                $cdata = $cate->GetAllCategory();
                                foreach($cdata as $key => $val){
                            ?>
                            <option value="<?=$val['Cate_id'] ?>" > <?=$val['Category_name'] ?> </option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Create On<span class="color-red">*</span></label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="datetime-local" class="form-control" name="date"/>
                               
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="button" class="btn btn-secondary">Close</button>
                    <input type="submit" name="btnSubmit" class="btn btn-primary" value="Save">
                  </div>
                      
                </div>
              </form>
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
