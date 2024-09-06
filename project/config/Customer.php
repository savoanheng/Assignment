<?php
    require("../model/conn.php");

    class Customers{
        private $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function insertCustomer($name, $gender,$phone,$city,$email,$country,$address,$create){
            $sql = $this->conn->prepare("INSERT INTO Customers(Customer_name, Gender,Phone, City, Email, Country, Address, CreateOn ) 
                                        VALUES (:cname,:cgender,:cphone,:ccity,:cemail,:ccountry,:caddress,:date)");
            $sql->bindParam(":cname",$name);
            $sql->bindParam(":cgender",$gender);
            $sql->bindParam(":cphone",$phone);
            $sql->bindParam(":ccity",$city);
            $sql->bindParam(":cemail",$email);
            $sql->bindParam(":ccountry",$country);
            $sql->bindParam(":caddress",$address);
            $sql->bindParam(":date",$create);
            $sql->execute(); 
        }

        public function GetAllCustomer(){
            $sql = $this->conn->prepare("SELECT * FROM Customers;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }
        public function GetCustomerById($id){
            $sql = $this->conn->prepare("SELECT * FROM Customer WHERE Cus_id = :id");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function editCustomer($id, $name, $gender, $phone, $city,$email,$country,$address,$create){
            $sql = $this->conn->prepare("UPDATE Customers SET Customer_name=:cname, Gender= :cgender,
                                            Phone = :cphone, City = :ccity, Email = :cemail, Country = :country, Address = :caddress,
                                            CreateOn = :date WHERE Cus_id = :id");

             $sql->bindParam(":cname",$name);
             $sql->bindParam(":cgender",$gender);
             $sql->bindParam(":cphone",$phone);
             $sql->bindParam(":ccity",$city);
             $sql->bindParam(":cemail",$email);
             $sql->bindParam(":ccountry",$country);
             $sql->bindParam(":caddress",$address);
             $sql->bindParam(":date",$create);
             $sql->bindParam(":id",$id);
             $sql->execute(); 
             $data = $sql->fetch(PDO::FETCH_ASSOC);
             return $data;
        }
        public function deleteCustomer($id){
            $sql= $this->conn->prepare("DELETE FROM Customers WHERE Cus_id = :id");
            $sql->bindParam(":id",$id);
            $sql->execute();
        }
        // filter search customer
        public function filterSearchCustomer($key){
            $sql = $this->conn->prepare("SELECT * FROM Customers WHERE Customer_name LIKE '% :key %';");
            $sql->bindParam(":key",$key);
            $sql->exectue();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
?>