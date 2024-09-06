<?php
    session_start();
    require("../config/Users.php");
    if(isset($_POST['btnlogin'])){
      $username = $_POST["username"]; 
      $password = $_POST["password"]; 
      $role = $_POST['role'];
      $user = new Users($conn);
      $users = $user->userLogin($username,$password,$role);
      if($users==true){
        if($users['roles'] == 'admin'){
              $_SESSION['user'] = $users;
              $_SESSION['id'] = $users['user_id'];
              if(($_POST['remember']==1) || ($_POST['remember']=='on')){
                  $hour = time() + (3600 *24 *30);
                  setcookie("username",$username,$hour);
                  setcookie("password",$password,$hour);
                  setcookie('active',1,$hour);
              }
              $_SESSION['status'] = 'Login';
              $_SESSION['status_code'] = 'success';
              header("location:index.php");
        }else if($users['roles'] == 'user'){
            $_SESSION['user'] = $users;
            $_SESSION['id'] = $users['user_id'];
            if(($_POST['remember']==1) || ($_POST['remember']=='on')){
                $hour = time() + (3600 *24 *30);
                setcookie("username",$username,$hour);
                setcookie("password",$password,$hour);
                setcookie('active',1,$hour);
            }
            $_SESSION['status'] = 'Login';
            $_SESSION['status_code'] = 'success';
            header("location:dashboard.php");
        }
      }else{
            $_SESSION['status'] = 'Login';
            $_SESSION['status_code'] = 'error';
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include("header.php");?>
</head>
<body class="login-page" style="min-height: 496.111px;">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Computer</b>Shop</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fa-solid fa-user nav-icon"></i>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8"></div>
          <div class="col-4">
            <select name="role" class="custom-select">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
          </div>
        </div>
        <div class="margin-top-10"></div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" name="btnlogin" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<?php include("footer.php");?>
</body>
</html>