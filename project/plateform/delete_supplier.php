<?php
    require("../config/Supplier.php");
    $delete_id = $_GET['delete'];
    $sup->DeleteSupplier($delete_id);
    header("location:supplier.php");

?>