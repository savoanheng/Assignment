<?php
    require "../model/conn.php";
    class Expenses
    {
        private $conn;
        function __construct($conn)
        {
           $this->conn = $conn; 
        }
        public function insertExpense($refer,$amount,$descript,$note,$pay_type,$create_by)
        {
            $sql = $this->conn->prepare("INSERT INTO Expenses(refer_name,ex_amount,description,note,payment_type,create_by,create_date) VALUES(:refer,:amount,:descript,:note,:pay_type,:create_by,NOW())");
            $sql->bindParam(":refer",$refer);
            $sql->bindParam(":amount",$amount);
            $sql->bindParam(":descript",$descript);
            $sql->bindParam(":note",$note);
            $sql->bindParam(":pay_type",$pay_type);
            $sql->bindParam(":create_by",$create_by);
            $sql->execute();
        }
        public function selectAllExpense()
        {
            $sql = $this->conn->prepare("SELECT * FROM Expenses;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectExpenseById($id)
        {
            $sql = $this->conn->prepare("SELECT * FROM Expenses WHERE exp_id = :id");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function updateExpense($id,$refer,$amount,$decript,$note,$pay_type,$create_by)
        {
            $sql = $this->conn->prepare("UPDATE Expenses SET refer_name = :refer, ex_amount = :amount, description = :descript,
                                        note = :note, payment_type = :pay_type,create_by = :create_by WHERE exp_id = :id");
            $sql->bindParam(":refer",$refer);
            $sql->bindParam(":amount",$amount);
            $sql->bindParam(":descript",$decript);
            $sql->bindParam(":note",$note);
            $sql->bindParam(":pay_type",$pay_type);
            $sql->bindParam(":create_by",$create_by);
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function deleteExpense($id)
        {
            $sql = $this->conn->prepare("DELETE FROM Expenses WHERE exp_id = :id");
            $sql->bindParam(":id",$id);
            $sql->execute();
        }
        public function selectTotalExpense()
        {
            $sql = $this->conn->prepare("SELECT SUM(ex_amount) AS TotalExpense FROM Expenses;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
?>