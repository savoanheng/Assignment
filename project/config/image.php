<?php 
    include("../model/conn.php");
    class Image{
        private $conn;
        function __construct($conn)
        {
            $this->conn = $conn;
        }
        public function selectLastId(){
            $sql = $this->conn->prepare("select image_id from images order by image_id desc limit 1;");
            $sql->execute();
            $id = $sql->fetch(PDO::FETCH_ASSOC);
            return $id;
        }
        public function selectimage(){
            $sql = $this->conn->prepare("select image from images where image_id = 25");
            $sql->execute();
            $id = $sql->fetch(PDO::FETCH_ASSOC);
            return $id;
        }
        public function selectimageByid($id){
            $sql = $this->conn->prepare("select image from images where image_id = :id");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
    }
?>