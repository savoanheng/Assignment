<?php
    require("../model/conn.php");
    class SalesFilter
    {
        private $conn;
        function __construct($conn)
        {
            $this->conn = $conn;
        }
        public function selectFilterByDate($start,$end)
        {
            $sql = $this->conn->prepare("SELECT O.Order_id, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,P.Payment_type, I.invoice_number,P.CreateDate
                                        FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
                                                inner join Payments as P on P.Order_id = O.Order_id
                                                inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                inner join Customers as C on C.Cus_id = O.Cus_id
                                                inner join Employee as E on E.Em_id = O.Em_id
                                                where O.Cus_id>0 and O.Status = 'Received' and P.CreateDate between :startdate and :enddate
                                                group by (UnitPrice * qty);");
            $sql->bindParam(":startdate",$start);
            $sql->bindParam(":enddate",$end);
            $sql->execute();
            $filter = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $filter;
        }
        public function selectAllSales()
        {
            $sql = $this->conn->prepare("SELECT O.Order_id, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,P.Payment_type, I.invoice_number,P.CreateDate
                                        FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
                                                inner join Payments as P on P.Order_id = O.Order_id
                                                inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                inner join Customers as C on C.Cus_id = O.Cus_id
                                                inner join Employee as E on E.Em_id = O.Em_id
                                                where O.Cus_id>0 and O.Status = 'Received'
                                                group by (UnitPrice * qty);");
            $sql->execute();
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
        public function selectPaymentBySale($start,$end)
        {
            $sql = $this->conn->prepare("SELECT P.Payment_type, Sum(P.Payment_amount) as Total
                                        FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                                inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                inner join Customers as C on C.Cus_id = O.Cus_id
                                                inner join Employee as E on E.Em_id = O.Em_id
                                                where O.Cus_id>0 and O.Status = 'Received' and P.CreateDate between :ds and :de");
            $sql->bindParam(":ds",$start);
            $sql->bindParam(":de",$end);
            $sql->execute();
            $filter = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $filter;
        }
        public function selectPaymentAllSale(){
            $sql = $this->conn->prepare("SELECT P.Payment_type, Sum(P.Payment_amount) as Total
                                        FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                                inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                inner join Customers as C on C.Cus_id = O.Cus_id
                                                inner join Employee as E on E.Em_id = O.Em_id
                                                where O.Cus_id>0 and O.Status = 'Received' ;");
            $sql->execute();
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
        public function selectSaleByMonth(){
            $sql = $this->conn->prepare("SELECT P.Payment_id as id,count(I.invoice_number != 'PI%') as invoice, sum( if(O.Cus_id >0,P.Payment_amount,0.00)) as Sale, monthname(O.Order_Date) as Months, year(O.Order_Date) as Years
                                        FROM Payments as P Right join Orders as O on O.Order_id = P.Order_id
                                        inner join Invoices as I on I.invoice_id = P.invoice_id
                                        Group By Months;");
            $sql->execute();
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
        public function filterSaleSummaryByDate($sdate,$edate)
        {
            $sql = $this->conn->prepare("Select I.invoice_number,if(O.Sup_id > 0,P.Payment_amount,0.00) as Purchase,if(O.Cus_id > 0,P.Payment_amount,0.00) as Sale,if(O.Cus_id > 0,P.Payment_amount,-P.Payment_amount) as Total from Payments as P inner join Invoices as I on I.invoice_id = P.invoice_id
                                        Right join Orders as O on O.Order_id = P.Order_id where O.Status ='Received' and P.CreateDate between :ds and :de;");
            $sql->bindParam(":ds",$sdate);
            $sql->bindParam(":de",$edate);
            $sql->execute();
            $filter = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $filter;
        }
        public function selectFilterPurchaseByDate($start,$end)
        {
            $sql = $this->conn->prepare("Select I.invoice_number,if(O.Sup_id > 0,P.Payment_amount,0.00) as Purchase,if(O.Cus_id > 0,P.Payment_amount,0.00) as Sale,if(O.Cus_id > 0,P.Payment_amount,-P.Payment_amount) as Total from Payments as P inner join Invoices as I on I.invoice_id = P.invoice_id
                                            Right join Orders as O on O.Order_id = P.Order_id where P.CreateDate between :startdate and :enddate;");
            $sql->bindParam(":startdate",$start);
            $sql->bindParam(":enddate",$end);
            $sql->execute();
            $filter = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $filter;
        }
        public function selectPurchaseByMonth(){
            $sql = $this->conn->prepare("SELECT sum(if(O.Sup_id >0,P.Payment_amount,0.00)) as Purchase, monthname(O.Order_Date) as Months, year(O.Order_Date) as Years,sum(I.invoice_number) as total_invoice
                                            FROM Payments as P Right join Orders as O on O.Order_id = P.Order_id
                                                    inner join Invoices as I on I.invoice_id = P.invoice_id
                                            Group By Months;");
            $sql->execute();
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
        
    }
?>