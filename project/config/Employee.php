<?php 
    require('../model/conn.php');
    class Employee
    {
        private $conn;
        function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function insertNewEmployee($fname,$lname,$gender,$email,$phone,$address,$depart,$salary)
        {
            $sql = $this->conn->prepare("INSERT INTO Employee(firstname,lastname,gender,email,phone,address,department,salary,status)
                                            VALUES(:fname,:lname,:gender,:email,:phone,:address,:depart,:salary,'Active');");
            $sql->bindParam(":fname",$fname);
            $sql->bindParam(":lname",$lname);
            $sql->bindParam(":gender",$gender);
            $sql->bindParam(":email",$email);
            $sql->bindParam(":phone",$phone);
            $sql->bindParam(":address",$address);
            $sql->bindParam(":depart",$depart);
            $sql->bindParam(":salary",$salary);
            $sql->execute();
        }
        public function selectAllEmployee(){
            $sql= $this->conn->prepare("SELECT * FROM Employee ");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectEmployeeById($id){
            $sql= $this->conn->prepare("SELECT * FROM Employee where Em_id = :id;");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function updateEmployee($id,$fname,$lname,$gender,$email,$phone,$address,$depart,$salary)
        {
            $sql = $this->conn->prepare("UPDATE Employee SET firstname = :fname,lastname = :lname,gender= :gender,
                                            email = :email,phone = :phone,address = :address ,department = :depart,salary = :salary Where Em_id = :id;");
                                           
            $sql->bindParam(":fname",$fname);
            $sql->bindParam(":lname",$lname);
            $sql->bindParam(":gender",$gender);
            $sql->bindParam(":email",$email);
            $sql->bindParam(":phone",$phone);
            $sql->bindParam(":address",$address);
            $sql->bindParam(":depart",$depart);
            $sql->bindParam(":salary",$salary);
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function deleteEmployeeById($id){
            $sql= $this->conn->prepare("DELETE FROM Employee where Em_id = :id;");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
    }
?>