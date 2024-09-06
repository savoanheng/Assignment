<?php 
  session_start();
  include("../model/conn.php");
  include("../config/image.php");
  require("../config/Employee.php");
  require("../config/Users.php");

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
  $user_id = $_GET['id'];
  $user = new Users($conn);
  $users = $user->selectUsersById($user_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users</title>
  <?php include("header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!--Box modal Delete product-->
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
          <a href="#" class="nav-link">User Details</a>
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
  <?php include("navigative.php")?>
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
                    <center><h3>edit_users</h3></center>
                    <div id="upload">
                      <input type="file" class="custom-file-input" name='files[]' required="required" style="position:absolute; z-index:2;margin-top:30px; width:100px;" multiple/> 
                      <label><img src="<?php echo $users['image']; ?>" alt="" width="100px" height="100px" style="position: absolute; z-index:1;border-radius:20%;margin-top:-10px;"></label>
                    </div>
                    
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
                  <div class="margin-top-10"></div>
                <form action="" method="post">
                  <div class="row">
                      <div class="col-4"></div>
                      <div class="col-4">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Full Name<span class="color-red">*</span></label>
                              <input type="text" class="form-control" name="proname" placeholder="Enter product name" value="<?php echo $users['fullname']?>">
                          </div>
                      </div>
                      
                  </div>
                  <div class="row">
                      <div class="col-4"></div>
                      <div class="col-4">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Username <span class="color-red">*</span></label>
                              <input type="text" class="form-control" name="procode" placeholder="Enter product code" value="<?php echo $users['username']?>">
                          </div>
                      </div>
                      
                  </div>
                  <div class="row">
                      <div class="col-4"></div>
                      <div class="col-4">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Password<span class="color-red">*</span></label>
                              <input type="password" class="form-control" name="unit" placeholder="Enter unit" value="<?php echo $users['passwords']?>">
                          </div>
                          
                      </div>
                      
                  </div>
                  <div class="row">
                      <div class="col-4"></div>
                      <div class="col-4">
                          <div class="form-group">
                              <label>Role<span class="color-red">*</span></label>
                              <select class="custom-select" name="role">
                              <option value="">  </option>
                              
                              </select>
                          </div>
                      </div>
                      
                  </div>
                  <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                      <button type="button" class="btn btn-secondary">Close</button>
                      <input type="submit" name="btnSubmit" class="btn btn-primary" value="Submit">
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
