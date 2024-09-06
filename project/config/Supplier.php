<?php
    require("../model/conn.php");
    class Suppliers{
        private $conn;
        function __construct($conn)
        {
            $this->conn = $conn;
        }
        public function insertNewSupplier($name,$phone,$email,$city,$country,$address){
            $sql = $this->conn->prepare("INSERT INTO Suppliers(Supplier_name, Phone,email, City, Country, Address) VALUES(:sname,:phone,:email,:city,:country,:ad);");
            $sql->bindParam(":sname",$name);
            $sql->bindParam(":phone",$phone);
            $sql->bindParam(":email",$email);
            $sql->bindParam(":city",$city);
            $sql->bindParam(":country",$country);
            $sql->bindParam(":ad",$address);
            $sql->execute();
        }
        public function GetAllSuppliers(){
            $sql = $this->conn->prepare("Select * From Suppliers;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function GetSupplier($id){
            $sql = $this->conn->prepare("SELECT Supplier_name, Phone,email, City, Country, Address FROM Suppliers WHERE Sup_id = :suId;");
            $sql->bindParam(":suId",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function EditSupplier($id,$name,$phone,$email,$city,$country,$address){
            $sql = $this->conn->prepare("Update Suppliers set Supplier_name = :sname, Phone=:ph, email=:email, City = :city, Country =:count,
                                            Address = :address WHERE Sup_id = :id");
            $sql->bindParam(":sname",$name);
            $sql->bindParam(":ph",$phone);
            $sql->bindParam(":email",$email);
            $sql->bindParam(":city",$city);
            $sql->bindParam(":count",$country);
            $sql->bindParam(":address",$address);
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function DeleteSupplier($id){
            $sql = $this->conn->prepare("DELETE FROM Suppliers WHERE Sup_id = :id");
            $sql->bindParam(":id",$id);
            $sql->execute();
        }
    }
?>