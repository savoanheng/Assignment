<?php
    require("../config/Users.php");
    $user_id = $_GET['id'];
    $user = new Users($conn);
    $user->deleteUsers($user_id);
    header("location:users.php");
?>