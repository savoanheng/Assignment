<?php
    require("../model/conn.php");
    class OrderDetails
    {
        private $conn;
        function __construct($conn)
        {
            $this->conn = $conn;
        }
        public function insertNewOrderDetail($order_id, $pro_id, $price, $qty)
        {
            $sql = $this->conn->prepare("INSERT INTO OrderDetails(Order_id,Pro_id,UnitPrice,qty) VALUES(:orid,:proid,:price,:qty)");
            $sql->bindParam(":orid",$order_id);
            $sql->bindParam(":proid",$pro_id);
            $sql->bindParam(":price",$price);
            $sql->bindParam(":qty",$qty);
            $sql->execute();
        }
        
       
    }
?>