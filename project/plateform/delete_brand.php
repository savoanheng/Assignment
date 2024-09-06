<?php
    require("../config/Brand.php");
    $delete_id = $_GET['delete'];
    $id = $_GET['id'];
    $brand = new Brand($conn);
    $brand->deleteBrand($delete_id);
    header("location:brand.php");
    $brand->deleteBrand($id);
    header("location:brand_home.php");
?>