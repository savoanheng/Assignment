<?php
    require("../config/Products.php");
    $pro_id = $_GET['id'];
    $product = new Products($conn);
    $product->deleteProducts($pro_id);
    header("location:product.php");


?>