<?php 
    require("../model/conn.php");
    class Orders
    {
        private $conn;
        function __construct($conn)
        {
           $this->conn = $conn; 
        }
        public function insertNewOrder($cus,$emp,$ware,$status,$date)
        {
            $sql = $this->conn->prepare("INSERT INTO Orders(Cus_id,Em_id,Warehouse,Status,Order_Date) VALUES(:cid,:emp,:ware,:state,:date)");
            $sql->bindParam(":emp",$emp);
            $sql->bindParam(":cid", $cus);
            $sql->bindParam(":ware", $ware);
            $sql->bindParam(":state", $status);
            $sql->bindParam(":date", $date);
            $sql->execute();
        }
        public function selectOrdersByLastId(){
            $sql = $this->conn->prepare("SELECT Order_id FROM Orders ORDER BY Order_id DESC LIMIT 1; ");
            $sql->execute();
            $data= $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function insertNewInvoice($invoice,$order_id){
            $sql = $this->conn->prepare("INSERT INTO Invoices(invoice_number,Order_id) VALUES(:invoice,:oid)");
            $sql->bindParam(":invoice",$invoice);
            $sql->bindParam(":oid",$order_id);
            $sql->execute();
        }
        public function selectInvoiceLastId(){
            $sql = $this->conn->prepare("SELECT invoice_id FROM Invoices ORDER BY invoice_id DESC LIMIT 1; ");
            $sql->execute();
            $id= $sql->fetch(PDO::FETCH_ASSOC);
            return $id;
        }
        public function insertNewPurchase($supid,$empid,$date,$warehouse,$status){
            $sql = $this->conn->prepare("INSERT INTO Orders(Sup_id,Em_id,Order_Date,Warehouse,Status) VALUES(:supId,:empId,:date,:ware,:status)");
            $sql->bindParam(":supId",$supid);
            $sql->bindParam(":empId",$empid);
            $sql->bindParam(":date",$date);
            $sql->bindParam(":ware",$warehouse);
            $sql->bindParam(":status",$status);
            $sql->execute();
        }
        public function selectAllSale(){
            $sql = $this->conn->prepare("SELECT I.invoice_number, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,P.Payment_type, P.CreateDate
                                        FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
                                                inner join Payments as P on P.Order_id = O.Order_id
                                                inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                inner join Customers as C on C.Cus_id = O.Cus_id
                                                inner join Employee as E on E.Em_id = O.Em_id
                                                where O.Cus_id>0 and O.Status = 'Received'
                                                group by (UnitPrice * qty)
                                                ;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectAllSaleReturn(){
            $sql = $this->conn->prepare("SELECT I.invoice_number, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,P.Payment_type, P.CreateDate
                                        FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
                                                inner join Payments as P on P.Order_id = O.Order_id
                                                inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                inner join Customers as C on C.Cus_id = O.Cus_id
                                                inner join Employee as E on E.Em_id = O.Em_id
                                                where O.Cus_id>0 and O.Status = 'Ordered'
                                                group by (UnitPrice * qty)
                                                ;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function filterSaleReturnByDate($date){
            $sql = $this->conn->prepare("SELECT I.invoice_number, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,P.Payment_type, P.CreateDate,
                                        if(O.Status = 'Ordered','Unpaid','paid')  as Payment_Status
                                        FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
                                                inner join Payments as P on P.Order_id = O.Order_id
                                                inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                inner join Customers as C on C.Cus_id = O.Cus_id
                                                inner join Employee as E on E.Em_id = O.Em_id
                                                where O.Cus_id>0 and O.Status = 'Ordered' and P.CreateDate = :dates
                                                group by (UnitPrice * qty)
                                                ;");
            $sql->bindParam(":dates",$date);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function selectAllPurchase(){
            $sql = $this->conn->prepare("SELECT I.invoice_number,O.Order_id, S.Supplier_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal ,P.Payment_amount,P.Payment_type,P.CreateDate 
                                            FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                                    inner join Invoices as I on I.Order_id = O.Order_id
                                                    inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                    inner join Suppliers as S on S.Sup_id = O.Sup_id
                                                    inner join Employee as E on E.Em_id = O.Em_id
                                                    where O.Sup_id>0 and O.Status = 'Received'  group by (UnitPrice * qty);");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectAllPurchaseReturn(){
            $sql = $this->conn->prepare("SELECT I.invoice_number,O.Order_id, S.Supplier_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal ,P.Payment_amount,P.Payment_type,P.CreateDate ,
                                            if(O.Status = 'Ordered','Unpaid','paid')  as Payment_Status
                                            FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                                    inner join Invoices as I on I.Order_id = O.Order_id
                                                    inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                    inner join Suppliers as S on S.Sup_id = O.Sup_id
                                                    inner join Employee as E on E.Em_id = O.Em_id
                                                    where O.Sup_id>0 and O.Status = 'Ordered'  group by (UnitPrice * qty);");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function filterPurchaseReturnByDate($date){
            $sql = $this->conn->prepare("SELECT I.invoice_number,O.Order_id, S.Supplier_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal ,P.Payment_amount,P.Payment_type,P.CreateDate 
                                            FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                                    inner join Invoices as I on I.Order_id = O.Order_id
                                                    inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                    inner join Suppliers as S on S.Sup_id = O.Sup_id
                                                    inner join Employee as E on E.Em_id = O.Em_id
                                                    where O.Sup_id>0 and O.Status = 'Ordered' and P.CreateDate = :dates  group by (UnitPrice * qty);");
            $sql->bindParam(":dates",$date);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectReportSale(){
            $sql = $this->conn->prepare("SELECT I.invoice_number, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,P.Payment_type, P.CreateDate
                                        FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
                                                inner join Payments as P on P.Order_id = O.Order_id
                                                inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                inner join Customers as C on C.Cus_id = O.Cus_id
                                                inner join Employee as E on E.Em_id = O.Em_id
                                                where O.Cus_id>0 and O.Status = 'Received'
                                                group by (UnitPrice * qty)
                                                ;");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectReportPurchase(){
            $sql = $this->conn->prepare("SELECT O.Order_id, E.department,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal ,P.Payment_amount,P.Payment_type,P.CreateDate , I.invoice_number
                                            FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
															inner join Invoices as I on I.Order_id = O.Order_id
                                                    inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                    inner join Suppliers as S on S.Sup_id = O.Sup_id
                                                    inner join Employee as E on E.Em_id = O.Em_id
                                                    where O.Sup_id>0 and O.Status = 'Received'  group by (UnitPrice * qty);
                                            ");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectTotalSale(){
            $sql = $this->conn->prepare("SELECT SUM(OD.UnitPrice * OD.qty) as Total
                                    FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                            inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                            inner join Customers as C on C.Cus_id = O.Cus_id
                                            inner join Employee as E on E.Em_id = O.Em_id
                                            where O.Cus_id > 0 and O.Status = 'Received';");
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectInvoice($id){
            $sql = $this->conn->prepare("SELECT * FROM Invoices WHERE invoice_id = :id;");
            $sql->bindParam(":id",$id);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectTotalInvoice(){
            $sql = $this->conn->prepare("SELECT I.invoice_number, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,
					CASE WHEN O.Status = 'Received' THEN 'Paid'
					ELSE 'Unpaid' END as Payment_Status
                    FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
                    inner join Payments as P on P.Order_id = O.Order_id
                    inner join OrderDetails as OD on OD.Order_id = O.Order_id
                    inner join Customers as C on C.Cus_id = O.Cus_id
                    inner join Employee as E on E.Em_id = O.Em_id
                    where O.Cus_id > 0  
                    group by (UnitPrice * qty);
            ");
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectCountSaleOrder(){
            $sql = $this->conn->prepare("SELECT COUNT(Recordlevel) AS totalSale FROM Products where Recordlevel > 0");
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function selectCountPurchaseOrder(){
            $sql = $this->conn->prepare("SELECT COUNT(UnitOnOrder) AS totalPurchase FROM Products where UnitOnOrder > 0");
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        
    }
?>