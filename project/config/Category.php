<?php 
    require("../model/conn.php");
    class Category{

        private $conn;

        function __construct($conn){
            $this->conn = $conn;
        }
        //Create Method Insert New Category
        public function insertNewCategory($name,$decription){
            $query = $this->conn->prepare("INSERT INTO Category(Category_name,Description) VALUES(:cname,:cdescript)");
            $query->bindParam(":cname",$name);
            $query->bindParam(":cdescript",$decription);
            $query->execute();
        }
        public function selectOneRecord($id){
            $query = $this->conn->prepare("SELECT* FROM Category WHERE Cate_id = :id");
            $query->bindParam(":id",$id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            return $data; 
        }
        public function GetAllCategory(){
            $sql = $this->conn->prepare("Select * From Category");
            $sql->execute();
            $data= $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        //Create Method Select All Category
        public function selectAllCategory(){
            $query = $this->conn->prepare("SELECT C.Cate_id,C.Category_name, COUNT(P.Cate_id) as ProductCount FROM Category as C LEFT JOIN Products as P ON P.Cate_id = C.Cate_id GROUP BY Category_name, P.Cate_id;");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        // Update Category
        public function editCategory($id,$name, $description){
            $query = $this->conn->prepare("UPDATE Category SET Category_name = :cname, Description = :cdes WHERE Cate_id = :id");
            $query->bindParam(":cname",$name);
            $query->bindParam(":cdes",$description);
            $query->bindParam(":id",$id);
            $query->execute();
            $data=$query->rowCount();
            if($data){
                return $this->selectAllCategory();
            }else{
                return "<script>window.alert('Update this category is fail!')</script>";
            }
        }
        //Create method delete Category
      
    }
?>