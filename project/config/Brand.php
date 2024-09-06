<?php 
    require("../model/conn.php");
    class Brand{
        private $conn;

        function __construct($conn){
            $this->conn=$conn;
        }

        public function insertNewBrand($name){
            $query = $this->conn->prepare("INSERT INTO Brands(Brand_name) VALUES(:bname)");
            $query->bindParam(":bname",$name);
            $query->execute();
        }
        public function deleteBrand($id){
            $query = $this->conn->prepare("delete from Brands where Brand_id = :id;");
            $query->bindParam(":id",$id);
            $query->execute();
        }

        public function selectBrandById($id){
            $sql = $this->conn->prepare("SELECT Brand_name, Description FROM Brands WHERE Brand_id = :id");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function GetAllRecord(){
            $sql = $this->conn->prepare("Select * From Brands");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function selectAllBrand(){
            $query = $this->conn->prepare("SELECT B.Brand_id, B.Brand_name, COUNT(P.Brand_id) as CountProductByBrand FROM Brands as B LEFT JOIN Products as P ON P.Brand_id = B.Brand_id GROUP BY  Brand_id,Brand_name,P.Brand_id;");
            $query->execute();
            $data=$query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function updateBrand($id,$name,$des){
            $sql = $this->conn->prepare("UPDATE Brands SET Brand_name = :bname, Description = :bdes WHERE Brand_id = :bid");
            $sql->bindParam(":bname",$name);
            $sql->bindParam(":bdes",$des);
            $sql->bindParam(":bid",$id);
            $sql->execute();
            $data= $sql->rowCount();
            if($data){
                return $this->selectAllBrand();
            }
        }
        
    }

?>