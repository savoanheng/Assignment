<?php 
   include("../model/conn.php");
    class Products{
        private $conn;  
        //Create Constructor 
        function __construct($conn){
            $this->conn=$conn;
        }
        //Create Method Insert Product
        public function insertProduct($name,$code,$brand,$cate,$qty,$unit,$price,$date,$img){
            $query = $this->conn->prepare("INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) Values(:proName,:proCode,:bId,:cateId,:qty,:unit,:price,0,0,0,:dates,:imgId)");
            $query->bindParam(":proName",$name);
            $query->bindParam(":proCode",$code);
            $query->bindParam(":bId",$brand);
            $query->bindParam(":cateId",$cate);
            $query->bindParam(":price",$price);
            $query->bindParam(":unit",$unit);
            $query->bindParam(":qty",$qty);
            $query->bindParam(":dates",$date);
            $query->bindParam(":imgId",$img);
            $query->execute();

        }
        public function selectOneRecord($id){
            $query = $this->conn->prepare("Select I.image_id,I.image, P.Product_name, P.Product_code,B.Brand_id, B.Brand_name,C.Cate_id, C.Category_name,P.UnitPrice, P.Unit, P.UnitInStock, P.CreateDate
                                            From Products as P inner join Brands as B on B.Brand_id = P.Brand_id
                                                            inner join Category as C on C.Cate_id = P.Cate_id
                                                            inner join images as I on I.image_id = P.image_id
                                            WHERE Pro_id = :id;");
            $query->bindParam(":id",$id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        //Select Product by product code
        public function selectProductByCode($code){
            $sql = $this->conn->prepare("SELECT * FROM Products WHERE Product_code = :pcode");
            $sql->bindParam(":pcode",$code);
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        //Create Method Select All Products
        public function selectAllProduct(){
            $query = $this->conn->prepare("Select Pro_id,I.image, P.Product_name, P.Product_code, B.Brand_name, C.Category_name,P.UnitPrice, P.Unit, P.UnitInStock, P.CreateDate
                                            From Products as P inner join Brands as B on B.Brand_id = P.Brand_id
                                                            inner join Category as C on C.Cate_id = P.Cate_id
                                                            inner join images as I on I.image_id = P.image_id
                                            GROUP BY image, Product_name, Product_code, Brand_name, Category_name, UnitPrice, Unit, UnitInStock, CreateDate, Pro_id;");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectReportAllProduct(){
            $query = $this->conn->prepare("Select Pro_id,I.image, P.Product_name, P.Product_code, B.Brand_name, C.Category_name,P.UnitPrice, P.Unit, P.UnitInStock,P.Recordlevel,P.UnitOnOrder, P.CreateDate
                                            From Products as P inner join Brands as B on B.Brand_id = P.Brand_id
                                                            inner join Category as C on C.Cate_id = P.Cate_id
                                                            inner join images as I on I.image_id = P.image_id
                                            GROUP BY image, Product_name, Product_code, Brand_name, Category_name, UnitPrice, Unit, UnitInStock, CreateDate, Pro_id;");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        //Create Method Update Products
        public function updateProduct($id,$name,$code,$brand,$cate,$price,$unit,$qty,$date,$img){
            $query = $this->conn->prepare("UPDATE Products Set Product_name = :proname , Product_code = :procode ,Brand_id = :brandid,
					Cate_id =:cate , UnitPrice=:price, Unit=:unit , UnitInStock =:qty , CreateDate = :dates ,
                    image_id = :imgs
				Where Pro_id = :id ;");
            $query->bindParam(":proname",$name);
            $query->bindParam(":procode",$code);
            $query->bindParam(":brandid",$brand);
            $query->bindParam(":cate",$cate);
            $query->bindParam(":price",$price);
            $query->bindParam(":unit",$unit);
            $query->bindParam(":qty",$qty);
            $query->bindParam(":dates",$date);
            $query->bindParam(":imgs",$img);
            $query->bindParam(":id",$id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        //Create method Delete Record Products
        public function deleteProducts($id){
            $query = $this->conn->prepare("Delete from Products where Pro_id = :id");
            $query->bindParam(":id",$id);
            $query->execute();
        }
        //Update Recordlevel
        public function updateRecordLevel($id)
        {
            $sql = $this->conn->prepare("UPDATE Products SET Recordlevel = Recordlevel + 1 WHERE Pro_id = :id");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        //update UnitInStock
        public function updateStock($id,$qty){
            $sql = $this->conn->prepare("UPDATE Products SET UnitInStock = UnitInStock - :qty WHERE Pro_id = :id");
            $sql->bindParam(":qty",$qty);
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        //update UnitOnOrder by purchase status ordered
        public function updateStorkOrder($id,$qty){
            $sql = $this->conn->prepare("UPDATE Products SET UnitOnOrder = UnitOnOrder + :qty WHERE Pro_id = :id");
            $sql->bindParam(":qty",$qty);
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        //update UnitInStock by purchase status recieved
        public function updateStockPurchase($id,$qty){
            $sql = $this->conn->prepare("UPDATE Products SET UnitInStock = UnitInStock + :quantity WHERE Pro_id = :id");
            $sql->bindParam(":quantity",$qty);
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function countProducts(){
            $sql = $this->conn->prepare("SELECT COUNT(Pro_id) AS total FROM Products");
            $sql->execute();
            $total = $sql->fetch(PDO::FETCH_ASSOC);
            return $total;
        }
        public function filterProducts($sid,$lid){
            $sql = $this->conn->prepare("Select Pro_id,I.image, P.Product_name, P.Product_code, B.Brand_name, C.Category_name,P.UnitPrice, P.Unit, P.UnitInStock, P.CreateDate
                                            From Products as P inner join Brands as B on B.Brand_id = P.Brand_id
                                                            inner join Category as C on C.Cate_id = P.Cate_id
                                                            inner join images as I on I.image_id = P.image_id
                                            GROUP BY image, Product_name, Product_code, Brand_name, Category_name, UnitPrice, Unit, UnitInStock, CreateDate, Pro_id
                                            Order by Pro_id asc limit :sid,:lastid;");
            $sql->bindParam(":sid",$sid);
            $sql->bindParam(":lastid",$lid);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function filterTopSale()
        {
            $sql = $this->conn->prepare("SELECT  Product_name, Recordlevel FROM Products GROUP BY Product_name ORDER BY Recordlevel DESC limit 5;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
?>