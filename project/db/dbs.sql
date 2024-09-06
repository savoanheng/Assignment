Create Database pos_sys;
use pos_sys;
Create or REPLACE Table Suppliers(
	Sup_id int primary key auto_increment,
    Supplier_name varchar(50),
    Phone varchar(50),
    email varchar(100),
    City varchar(50),
    Country varchar(50),
    Address varchar(100)
);
CREATE OR REPLACE TABLE Brands(
	Brand_id int primary key  auto_increment,
    Brand_name varchar(30),
    Description varchar(150)
);
CREATE or replace Table Category(
	Cate_id int primary key auto_increment,
    Category_name varchar(50) not null,
    Description varchar(100)
);
CREATE TABLE `images`(
    `image_id` int AUTO_INCREMENT, 
     `name` varchar(100) NOT NULL,
     `image` varchar(255) NOT NULL,
    PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
Create OR REPLACE Table Products(
	Pro_id int primary key auto_increment,
    Product_name varchar(50) not null,
    Product_code varchar(20),
    Brand_id int,
    Sup_id int,
    Cate_id int,
    UnitPrice decimal(10,2),
    Unit varchar(100),
    UnitInStock int,
    UnitOnOrder int,
    Recordlevel int,
    Discontinued int,
    CreateDate datetime,
	image_id int,
    foreign key (Sup_id) references Suppliers(Sup_id),
	foreign key (Cate_id) references Category(Cate_id),
    foreign key (Brand_id) references Brands(Brand_id),
    foreign key (image_id) references images(image_id)
);
CREATE OR REPLACE TABLE Customers(
	Cus_id 	int primary key auto_increment,
    Customer_name varchar(50),
    Gender varchar(20),
    Email varchar(50),
    City varchar(20),
    Country varchar(20),
    Phone varchar(50),
    Address varchar(50),
    CreateOn datetime
);
CREATE OR REPLACE TABLE Employee(
	Em_id int primary key auto_increment,
    firstname varchar(50),
    lastname varchar(50),
    gender varchar(20),
    email varchar(50),
    phone varchar(50),
    address varchar(50),
    department varchar(50),
    salary decimal(10,2),
    status varchar(20)
);
CREATE OR REPLACE TABLE Orders(
	Order_id int primary key auto_increment,
    Cus_id int,
    Sup_id int,
	Em_id int,
    Order_date datetime,
    Warehouse varchar(30),
    Status varchar(20),
    Foreign key (Cus_id) References Customers(Cus_id),
    Foreign key (Sup_id) References Suppliers(Sup_id),
    Foreign key (Em_id) References Employee(Em_id)
);

CREATE OR REPLACE TABLE OrderDetails(
	OD_id int primary key auto_increment,
    Order_id int,
    Pro_id int,
    UnitPrice decimal (10,2),
    qty int,
    discount decimal (10,2),
    Foreign Key (Order_id) References Orders(Order_id),
    Foreign Key (Pro_id) References Products(Pro_id)
);
CREATE OR REPLACE TABLE Invoices(
	invoice_id int primary key auto_increment,
    invoice_number varchar(20),
    Order_id int ,
    Foreign key (Order_id) REFERENCES Orders(Order_id)
);
CREATE OR REPLACE TABLE Payments(
	Payment_id int primary key auto_increment,
    Payment_type varchar(50),
    Payment_amount decimal(10,2),
	Order_id int ,
    invoice_id int,
    CreateDate datetime,
    Foreign key (Order_id) REFERENCES Orders(Order_id),
    FOREIGN KEY (invoice_id) REFERENCES Invoices(invoice_id)
);
CREATE OR REPLACE TABLE Users(
	user_id int primary key auto_increment,
    fullname varchar(50),
    username varchar(50),
    passwords varchar(50),
    roles varchar(20),
    image_id int,
    create_by varchar(20),
    create_date date,
    FOREIGN KEY (image_id) REFERENCES images(image_id)
);
CREATE OR REPLACE TABLE Expenses(
	exp_id int primary key auto_increment,
    refer_name varchar(20),
    ex_amount decimal(10,2),
    description varchar(50),
    note varchar(50),
    payment_type varchar(20),
    create_by varchar(20),
    create_date datetime
);
-- insert data to table Category
INSERT INTO Category(Category_name,Description) VALUES('Laptop','CPU, Ram, GPU, Processer, Screen, Battery...');
INSERT INTO Category(Category_name,Description) VALUES('Accessoriees','Mouse, Keyboard, Cable, Mouse Pad, Laptop Bag...');
INSERT INTO Category(Category_name,Description) VALUES('Printer','inkjet, laser');
INSERT INTO Category(Category_name,Description) VALUES('Projector','Screen & Stand, Wireless');
INSERT INTO Category(Category_name,Description) VALUES('PC Component','Ram, Storage, Graphic Card, CPU, Motherboard,...');
INSERT INTO Category(Category_name,Description) VALUES('Gaming Gear','Gaming Chair, Headset, Gaming Keyboard, Mouse..');
INSERT INTO Category(Category_name,Description) VALUES('Auto Device','Portable Speaker, Desktop Speaker, Headset, Microphone,Earphone,...');
-- insert data to table Brands
INSERT INTO Brands(Brand_name, Description) VALUES('MSI','Laptop, desktop, Monitor, HDD,..');
INSERT INTO Brands(Brand_name, Description) VALUES('DELL','Laptop, desktop, Monitor, HDD,..');
INSERT INTO Brands(Brand_name, Description) VALUES('SAMSUNG','Laptop, desktop, Monitor, HDD,..');
INSERT INTO Brands(Brand_name, Description) VALUES('ASUS','Laptop, desktop, Monitor, HDD,..');
INSERT INTO Brands(Brand_name, Description) VALUES('HP','Laptop, desktop, Monitor, HDD,..');
INSERT INTO Brands(Brand_name, Description) VALUES('LENOVO','Laptop, desktop, Monitor, HDD,..');
INSERT INTO Brands(Brand_name, Description) VALUES('MAC','Laptop, desktop, Monitor, HDD,..');
INSERT INTO Brands(Brand_name, Description) VALUES('SONY','Laptop, desktop, Monitor, HDD,..');
INSERT INTO Brands(Brand_name, Description) VALUES('AORUS','Laptop, desktop, Monitor, HDD,..');
-- insert data to table Suppliers
INSERT INTO Suppliers(Supplier_name,Phone,email,City,Country,Address) VALUES('ANANA Computer','012 831 516','sale@ananacomputer.com','Phnom Penh','Cambodia','No 95, Preah Norodom Blvd(41), Sangkat Beoung Raing,Khan Daun Penh, Phnom Penh, Cambodia');
INSERT INTO Suppliers(Supplier_name,Phone,email,City,Country,Address) VALUES('CC Computer','012 474 855','cccomputer168@gmail.com','Phnom Penh','Cambodia','No 18 Eo, St:468, Phnom Penh');
INSERT INTO Suppliers(Supplier_name,Phone,email,City,Country,Address) VALUES('Gaming Gears','069 997 565 ','gaminggearskh.com','Phnom Penh','Cambodia','No 198A, St:150, Phnom Penh');
INSERT INTO Suppliers(Supplier_name,Phone,email,City,Country,Address) VALUES('PTC Computer','012 831 516','siemreap@ptc-computer.com.kh','Siem Reap','Cambodia','#555, St: Samdach Tep Vong, Modol 2 Village, Sankat Svay Dongkom, Siem Reap Province');
-- Insert Image to Table image
INSERT INTO images(name,image) VALUES ('MSI Newest GF63 Thin Gaming Laptop, 15.6-688$.jpg','./photo/MSI Newest GF63 Thin Gaming Laptop, 15.6-688$.jpg');
INSERT INTO images(name,image) VALUES ('MSI GF63 Thin Gaming Laptop-717$.jpg','./photo/MSI GF63 Thin Gaming Laptop-717$.jpg');
INSERT INTO images(name,image) VALUES ('MSI Thin 15 15.6” 144Hz -8999$.jpg','./photo/MSI Thin 15 15.6” 144Hz -8999$.jpg');
INSERT INTO images(name,image) VALUES ('MSI Thin GF63 684$.jpg','./photo/MSI Thin GF63 684$.jpg');
INSERT INTO images(name,image) VALUES ('MSI Cyborg 15 5-719$.jpg','./photo/MSI Cyborg 15 5-719$.jpg');
-- laptop mac 
INSERT INTO images(name,image) VALUES ('Apple MacBook Pro-599$.jpg','./photo/Apple MacBook Pro-599$.jpg');
INSERT INTO images(name,image) VALUES ('Apple 2022 MacBook Pro Laptop with M2 chip-1499$.jpg', './photo/Apple 2022 MacBook Pro Laptop with M2 chip-1499$.jpg');
INSERT INTO images(name,image) VALUES ('Apple 2023 MacBook Pro laptop M2 Pro chip-1699$.jpg', './photo/Apple 2023 MacBook Pro laptop M2 Pro chip-1699$.jpg');
INSERT INTO images(name,image) VALUES ('Apple 2023 MacBook Pro laptop M2 Pro chip-1699$.jpg', './photo/Apple 2023 MacBook Pro laptop M2 Pro chip-1699$.jpg');
INSERT INTO images(name,image) VALUES ('Apple MacBook Pro 16.2-5743$.jpg', './photo/Apple MacBook Pro 16.2-5743$.jpg');
-- laptop Aorus 
INSERT INTO images(name,image) VALUES ('AORUS 15-939$.jpg','./photo/AORUS 15-939$.jpg');
INSERT INTO images(name,image) VALUES ('AORUS 16X (2024) Gaming Laptop -1499$.jpg', './photo/AORUS 16X (2024) Gaming Laptop -1499$.jpg');
INSERT INTO images(name,image) VALUES ('AORUS 17H-1799$.jpg', './photo/AORUS 17H-1799$.jpg');
INSERT INTO images(name,image) VALUES ('AORUS-1549$.jpg', './photo/AORUS-1549$.jpg');
INSERT INTO images(name,image) VALUES ('AORUS-2999$.jpg','./photo/AORUS-2999$.jpg');

INSERT INTO images(name,image) VALUES ('HP EliteBook x360 1030 G3.jpg','./photo/HP EliteBook x360 1030 G3.jpg');
INSERT INTO images(name,image) VALUES ('HP Envy x360.jpg', './photo/HP Envy x360.jpg');
INSERT INTO images(name,image) VALUES ('HP SPECTRE X360 16-F0013.jpg', './photo/HP SPECTRE X360 16-F0013.jpg');
INSERT INTO images(name,image) VALUES ('HP ZBook 15 G3.jpg', './photo/HP ZBook 15 G3.jpg');
INSERT INTO images(name,image) VALUES ('HP Zbook Studio G3.jpg','./photo/HP Zbook Studio G3.jpg');

INSERT INTO images(name,image) VALUES ('1.jpg','./photo/1.jpg');
INSERT INTO images(name,image) VALUES ('4.jpg', './photo/4.jpg');
INSERT INTO images(name,image) VALUES ('5.jpg', './photo/5.jpg');
INSERT INTO images(name,image) VALUES ('2.jpg', './photo/2.jpg');
INSERT INTO images(name,image) VALUES('user.jpg','./photo/user.jpg');

-- Insert New Products to Table Product
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('MSI GF63','10001',1,1,'5','PC',688.00,0,0,0,'2024-01-07 7:00:00',1);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('GF63 Thin 11UCX-1424US','10002',1,1,'5','PC',717.00,0,0,0,'2024-01-07 7:02:00',2);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('Thin 15 B12VE-2023US','10003',1,1,'5','PC',899.00,0,0,0,'2024-01-07 7:05:00',3);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('Thin GF63 12UCX-484US','10004',1,1,'5','PC',684.00,0,0,0,'2024-01-07 7:10:00',4);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('Cyborg 15 A12UCX-276US','10005',1,1,'5','PC',719.00,0,0,0,'2024-01-07 7:20:00',5);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('MacBook Pro 16-inch','10006',7,1,'5','PC',599.00,0,0,0,'2024-01-07 7:25:00',6);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('MacBook Pro','10007',7,1,'5','PC',1499.00,0,0,0,'2024-01-07 7:27:00',7);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('MacBook Pro','10008',7,1,'5','PC',1699.00,0,0,0,'2024-01-07 7:28:00',8);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('MacBook Pro','10009',7,1,'5','PC',1799.00,0,0,0,'2024-01-07 7:29:00',9);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('MacBook Pro','10010',7,1,'5','PC',5743.00,0,0,0,'2024-01-07 7:30:00',10);
-- laptop aorus
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('AORUS 15 9MF-E2US583SH','10011',9,1,'5','PC',939.00,0,0,0,'2024-01-07 7:36:00',11);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('AORUS 16X 9SG-43USC64SH','10012',9,1,'5','PC',1499.00,0,0,0,'2024-01-07 7:35:00',12);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('AORUS 17H BXF-74US554SH','10013',9,1,'5','PC',1799.00,0,0,0,'2024-01-07 7:38:00',13);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('AORUS 17 BSF-73US654SH','10014',9,1,'5','PC',1549.00,0,0,0,'2024-01-07 7:40:00',14);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('AORUS 17X AZF-D5US665SH','10015',9,1,'5','PC',2999.00,0,0,0,'2024-01-07 7:47:00',15);
-- laptop hp
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('HP EliteBook x360 1030 G3','10016',5,1,'5','PC',449.00,0,0,0,'2024-01-07 7:49:00',16);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('HP Envy x360','10017',5,1,'5','PC',529.00,0,0,0,'2024-01-07 7:55:00',17);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('HP SPECTRE X360 16-F0013','10018',5,1,'5','PC',799.00,0,0,0,'2024-01-07 8:00:00',18);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('HP ZBook 15 G3','10019',5,1,'5','PC',349.00,0,0,0,'2024-01-07 8:10:00',19);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('HP Zbook Studio G3','10020',5,1,'5','PC',549.00,0,0,0,'2024-01-07 8:15:00',20);
-- laptop samsung
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('Galaxy Book4','10021',3,1,'5','PC',1294.00,0,0,0,'2024-01-07 8:20:00',21);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES( 'Galaxy Book3 Pro','10022',3,1,'5','PC',1195.00,0,0,0,'2024-01-07 8:25:00',21);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('Chrombook Plus V2','10023',3,1,'5','PC',400.00,0,0,0,'2024-01-07 8:30:00',22);
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('XE530QDA-KA1US','10024',3,1,'5','PC',500.00,0,0,0,'2024-01-07 8:35:00',23);
-- laptop sony
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('Sony Vaio FE14','10025',8,1,'5','PC',449.00,0,0,0,'2024-01-07 8:40:00',24);
-- laptop dell
INSERT INTO Products(Product_name,Product_code, Brand_id, Cate_id,UnitInStock , Unit, UnitPrice,UnitOnOrder,Recordlevel,Discontinued, CreateDate, image_id) 
VALUES('Dell Latitude 5000','10026',2,1,'5','PC',579.77,0,0,0,'2024-01-07 8:40:00',25);

-- insert data customer in table customers
select * from Customers;
INSERT INTO Customers(Customer_name) VALUES ('Normal');

INSERT INTO Employee(firstname,lastname,gender,email,phone,address,department,salary,status)
VALUES('Dara','Chann','Male','channdara@gmail.com','093 890 654','Siem Reap','Admin',700.00,'Active');

-- insert users 
select * from Users;
INSERT INTO Users(fullname,username,passwords,roles,image_id,create_by,create_date)
VALUES('Chann Dara','admin','admin@123','admin',25,'admin',NOW());



SELECT U.user_id,I.image,U.fullname,U.username,U.roles, U.create_by FROM Users as U inner JOIN images as I ON I.image_id = U.image_id;
SELECT U.user_id,I.image,U.fullname,U.username,U.roles, U.create_by FROM Users as U inner JOIN images as I ON I.image_id = U.image_id
                                            where username LIKE '%m%';
select * from Users;
select * from Products;
select * from Orders;
select * from Invoices;
select * from OrderDetails;
select * from Payments;
select * from images;




SELECT I.invoice_number,O.Order_id, S.Supplier_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal ,P.Payment_amount,P.Payment_type,P.CreateDate,
if(O.Status = 'Ordered','Unpaid','paid')  as Payment_Status
                                            FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                                    inner join Invoices as I on I.Order_id = O.Order_id
                                                    inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                                    inner join Suppliers as S on S.Sup_id = O.Sup_id
                                                    inner join Employee as E on E.Em_id = O.Em_id
                                                    where O.Sup_id>0 and O.Status = 'Ordered'  group by (UnitPrice * qty);



-- INSERT DATA INTO TABLE ORDER
SELECT B.Brand_name, COUNT(P.Brand_id) as CountProductByBrand FROM Brands as B INNER JOIN Products as P ON P.Brand_id = B.Brand_id GROUP BY  Brand_name,P.Brand_id;
SELECT * FROM Orders;
insert into Orders (Cus_id,Order_Date) Values(1,now());
select Order_id From Orders Order by Order_id desc limit 1;
alter table Orders ADD Note Varchar(100);

Select P.Pro_id, I.image, P.Product_name, P.Product_code, B.Brand_name, C.Category_name,P.UnitPrice, P.Unit, P.UnitInStock, P.CreateDate
From Products as P inner join Brands as B on B.Brand_id = P.Brand_id
				   inner join Category as C on C.Cate_id = P.Cate_id
                   inner join images as I on I.image_id = P.image_id
GROUP BY image, Product_name, Product_code, Brand_name, Category_name, UnitPrice, Unit, UnitInStock, CreateDate,Pro_id
Order by Pro_id asc limit 0,20;

Select I.image, P.Product_name, P.Product_code, B.Brand_name, C.Category_name,P.UnitPrice, P.Unit, P.UnitInStock, P.CreateDate
From Products as P inner join Brands as B on B.Brand_id = P.Brand_id
				   inner join Category as C on C.Cate_id = P.Cate_id
                   inner join images as I on I.image_id = P.image_id
WHERE Pro_id = 1;

-- Select Sale
SELECT O.Order_id, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,P.Payment_type, I.invoice_number,P.CreateDate
FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
		inner join Payments as P on P.Order_id = O.Order_id
		inner join OrderDetails as OD on OD.Order_id = O.Order_id
        inner join Customers as C on C.Cus_id = O.Cus_id
		inner join Employee as E on E.Em_id = O.Em_id
        where O.Cus_id>0 and O.Status = 'Received'
        group by (UnitPrice * qty);
        
-- select total Sale
SELECT SUM(OD.UnitPrice * OD.qty) as Total
FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
		inner join OrderDetails as OD on OD.Order_id = O.Order_id
        inner join Customers as C on C.Cus_id = O.Cus_id
		inner join Employee as E on E.Em_id = O.Em_id
        where O.Cus_id>0 and O.Status = 'Received';
-- filter report sale
SELECT O.Order_id, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,P.Payment_type, I.invoice_number,P.CreateDate
FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
		inner join Payments as P on P.Order_id = O.Order_id
		inner join OrderDetails as OD on OD.Order_id = O.Order_id
        inner join Customers as C on C.Cus_id = O.Cus_id
		inner join Employee as E on E.Em_id = O.Em_id
        where O.Cus_id>0 and O.Status = 'Received' and P.CreateDate between '2024-08-18' and '2024-08-19'
        group by (UnitPrice * qty);
-- report total sale 
SELECT P.Payment_type, Sum(P.Payment_amount) as Total
FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
		inner join OrderDetails as OD on OD.Order_id = O.Order_id
        inner join Customers as C on C.Cus_id = O.Cus_id
		inner join Employee as E on E.Em_id = O.Em_id
        where O.Cus_id>0 and O.Status = 'Received' and P.CreateDate between '2024-08-18' and '2024-08-19';
 -- Select purchase       
SELECT I.invoice_number,O.Order_id, S.Supplier_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal ,P.Payment_amount,P.Payment_type,P.CreateDate 
FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
		inner join Invoices as I on I.Order_id = O.Order_id
		inner join OrderDetails as OD on OD.Order_id = O.Order_id
        inner join Suppliers as S on S.Sup_id = O.Sup_id
		inner join Employee as E on E.Em_id = O.Em_id
        where O.Sup_id>0 and O.Status = 'Received'  group by (UnitPrice * qty);

SELECT SUM(OD.UnitPrice * OD.qty) as Total
                                    FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                            inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                            inner join Customers as C on C.Cus_id = O.Cus_id
                                            inner join Employee as E on E.Em_id = O.Em_id
                                            where O.Cus_id > 0 and O.Status = 'Received';
             
SELECT I.invoice_number, C.Customer_name,O.Warehouse,O.Status,SUM(OD.UnitPrice * OD.qty) as GrandTotal,E.department,P.Payment_amount,
					CASE WHEN O.Status = 'Received' THEN 'Paid'
					ELSE 'Unpaid' END as Payment_Status
FROM Orders as O inner join Invoices as I on I.Order_id = O.Order_id
inner join Payments as P on P.Order_id = O.Order_id
inner join OrderDetails as OD on OD.Order_id = O.Order_id
inner join Customers as C on C.Cus_id = O.Cus_id
inner join Employee as E on E.Em_id = O.Em_id
where O.Cus_id > 0  
group by (UnitPrice * qty);

select * from Payments where CreateDate between "2024-01-18" and "2024-08-19";
select * from Orders;
select * from OrderDetails;
select * from Invoices;


-- Select Top 5 Product to Sale
SELECT  Product_name, Recordlevel FROM Products GROUP BY Product_name ORDER BY Recordlevel DESC limit 5;





SELECT SUM(OD.UnitPrice * OD.qty) as Total
                                    FROM Orders as O inner join Payments as P on P.Order_id = O.Order_id
                                            inner join OrderDetails as OD on OD.Order_id = O.Order_id
                                            inner join Customers as C on C.Cus_id = O.Cus_id
                                            inner join Employee as E on E.Em_id = O.Em_id
                                            where O.Cus_id>0 and O.Status = 'Received';

SELECT COUNT(Recordlevel) AS totalSale FROM Products where Recordlevel > 0;

SELECT COUNT(UnitOnOrder) AS totalPurchase FROM Products where UnitOnOrder > 0;
SELECT SUM(ex_amount) AS TotalExpense FROM Expenses;





select I.invoice_number,P.Payment_type,P.Payment_amount 
From Invoices as I inner join Payments as P on P.invoice_id = I.invoice_id
				   inner join Orders as O on O.Order_id = I.Order_id;



-- insert data into table Employee

INSERT INTO Employee(firstname,lastname,gender,email,phone,address,department,status)
VALUES('SreyRoth','Kann','Female','kannsreyroth@gmail.com','093 890 654','Siem Reap','Cashier','Active');
select * from Suppliers;
SELECT C.Category_name, COUNT(P.Cate_id) as ProductCount FROM Category as C Left JOIN Products as P ON P.Cate_id = C.Cate_id GROUP BY Category_name, P.Cate_id;
select * from Products Order by Pro_id asc limit 0,20;
select * from Payments;
-- Select Output Value From page Sale



-- Select Output Value From page Purchases
SELECT * ,I.invoice_id,O.Sup_id,O.Order_Date
FROM Invoices as I inner join Orders as O on O.Order_id = I.Order_id
				   inner join Payments as P on P.invoice_id = I.invoice_id;
                   
                   
Select SUM(UnitPrice * qty) as GrandTotal FROM OrderDetails group by Order_id;
Select Customer_name as Custom From Customers Group by Customer_name;

SELECT I.invoice_id, O.Cus_id,O.Warehouse,O.Status,O.Order_id,
P.Payment_amount as PAID,P.Payment_type,P.CreateDate 
FROM Invoices as I inner join Orders as O on O.Order_id = I.Order_id
inner join Payments as P on P.invoice_id = I.invoice_id Where O.Cus_id >0;
use pos_sys;
SELECT Sum(if(O.Sup_id >0,-P.Payment_amount,P.Payment_amount)) as Total,sum(if(O.Sup_id >0,P.Payment_amount,0.00)) as Purchase, sum( if(O.Cus_id >0,P.Payment_amount,0.00)) as Sale, monthname(O.Order_Date) as Months, year(O.Order_Date) as Years
FROM Payments as P Right join Orders as O on O.Order_id = P.Order_id
Group By Months;
SELECT P.Payment_id as id,count(I.invoice_number != 'PI%') as invoice, sum( if(O.Cus_id >0,P.Payment_amount,0.00)) as Sale, monthname(O.Order_Date) as Months, year(O.Order_Date) as Years
FROM Payments as P Right join Orders as O on O.Order_id = P.Order_id
inner join Invoices as I on I.invoice_id = P.invoice_id
Group By Months;
SELECT sum(if(O.Sup_id >0,P.Payment_amount,0.00)) as Purchase, monthname(O.Order_Date) as Months, year(O.Order_Date) as Years
FROM Payments as P Right join Orders as O on O.Order_id = P.Order_id
Group By Months;
-- filter Sale by date 
Select I.invoice_number,if(O.Sup_id > 0,P.Payment_amount,0.00) as Purchase,if(O.Cus_id > 0,P.Payment_amount,0.00) as Sale,if(O.Cus_id > 0,P.Payment_amount,-P.Payment_amount) as Total from Payments as P inner join Invoices as I on I.invoice_id = P.invoice_id
Right join Orders as O on O.Order_id = P.Order_id where P.CreateDate between '' and '';


