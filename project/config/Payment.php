<?php
    require('../model/conn.php');
    class Payments
    {
        private $conn;
        function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function insertPayment($type,$amount,$order,$id,$date)
        {
            $sql= $this->conn->prepare("INSERT INTO Payments (Payment_type,Payment_amount,Order_id,invoice_id,CreateDate) VALUES(:pay_type,:pay_amount,:order,:inId,:date)");
            $sql->bindParam(":pay_type",$type);
            $sql->bindParam(":pay_amount",$amount);
            $sql->bindParam(":order",$order);
            $sql->bindParam(":inId",$id);
            $sql->bindParam(":date",$date);
            $sql->execute();
        }
        public function selectPayment()
        {
            $sql=$this->conn->prepare("SELECT CreateDate FROM Payments Order by CreateDate DESC LIMIT 1");
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectAllPayment()
        {
            $sql=$this->conn->prepare("SELECT *,I.invoice_number FROM Payments as P inner join Invoices as I on I.invoice_id = P.invoice_id;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }


    }
?>