<?php 
    require("../model/conn.php");

    class Users
    {
        private $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        // Create method insert Users
        public function addNewUsers($fullname,$users,$password,$role,$create_by)
        {
            $sql = $this->conn->prepare("INSERT INTO Users(fullname,username,passwords,roles,image_id,create_by,create_date)
                                        VALUES(:fullname,:users,:pass,:roles,25,:createby,NOW());");
            $sql->bindParam(":fullname",$fullname);
            $sql->bindParam(":users",$users);
            $sql->bindParam(":pass",$password);
            $sql->bindParam(":roles",$role);
            $sql->bindParam(":createby",$create_by);
            $sql->execute();
        }

        // Create Method Select All Users
        public function selectAllUsers()
        {
            $sql = $this->conn->prepare("SELECT U.user_id,I.image,U.fullname,U.username,U.roles, U.create_by FROM Users as U inner JOIN images as I ON I.image_id = U.image_id;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function GetAllUsers()
        {
            $sql = $this->conn->prepare("SELECT * FROM Users;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function deleteUsers($id)
        {
            $sql = $this->conn->prepare("Delete FROM Users where user_id = :id;");
            $sql->bindParam(":id",$id);
            $sql->execute();
        }
        public function updateUsers($id,$fullname,$users,$password,$role,$image_id)
        {
            $sql = $this->conn->prepare("UPDATE Users SET fullname = :fullname, username = :user,passwords = :pass, roles = :roles, image_id = :img_id
                                        where user_id = :id;");
            $sql->bindParam(":fullname",$fullname);
            $sql->bindParam(":user",$users);
            $sql->bindParam(":pass",$password);
            $sql->bindParam(":roles",$role);
            $sql->bindParam(":img_id",$image_id);
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectUsersById($id)
        {
            $sql = $this->conn->prepare("SELECT U.user_id,I.image,U.fullname,U.username,U.passwords,U.roles, U.create_by FROM Users as U inner JOIN images as I ON I.image_id = U.image_id
                                            where user_id = :id;");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function userLogin($username,$password,$role){
            $sql = $this->conn->prepare("SELECT * FROM Users Where username = :users and passwords = :password and roles = :role;");
            $sql->bindParam(":users",$username);
            $sql->bindParam(":password",$password);
            $sql->bindParam(":role",$role);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
  
    }

?>