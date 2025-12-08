-- Create Database
CREATE DATABASE onlineshoppingsystem_db;
USE onlineshoppingsystem_db;

--------------------------------------------------
-- TABLE: Customer
--------------------------------------------------
CREATE TABLE Customer (
    CustomerID CHAR(3) PRIMARY KEY,
    FirstName VARCHAR(15) NOT NULL,
    LastName VARCHAR(15) NOT NULL,
    PhoneNumber VARCHAR(11) NOT NULL
);

INSERT INTO Customer (CustomerID, FirstName, LastName, PhoneNumber)
VALUES ('001', 'Monico Vian', 'Baxal', '09957529633');

INSERT INTO Customer (CustomerID, FirstName, LastName, PhoneNumber)
VALUES ('002', 'John', 'Doe', '09239279274');

INSERT INTO Customer (CustomerID, FirstName, LastName, PhoneNumber)
VALUES ('003', 'Jude', 'Nabalan', '09476529373');

INSERT INTO Customer (CustomerID, FirstName, LastName, PhoneNumber)
VALUES ('004', 'Rhobert', 'Patena', '09192738439');

INSERT INTO Customer (CustomerID, FirstName, LastName, PhoneNumber)
VALUES ('005', 'Sarah', 'Discaya', '09562939117');


--------------------------------------------------
-- TABLE: CustomerAddress
--------------------------------------------------
CREATE TABLE CustomerAddress (
    CustomerAddressID CHAR(3) PRIMARY KEY,
    Address VARCHAR(50) NOT NULL,
    CustomerID CHAR(3),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID)
);

INSERT INTO CustomerAddress (CustomerAddressID, Address, CustomerID)
VALUES ('001', 'Punta Princesa', '001');

INSERT INTO CustomerAddress (CustomerAddressID, Address, CustomerID)
VALUES ('002', 'Los Angeles, California', '002');

INSERT INTO CustomerAddress (CustomerAddressID, Address, CustomerID)
VALUES ('003', 'Cebu City', '003');

INSERT INTO CustomerAddress (CustomerAddressID, Address, CustomerID)
VALUES ('004', 'Liloan', '004');

INSERT INTO CustomerAddress (CustomerAddressID, Address, CustomerID)
VALUES ('005', 'City of Manila', '005');


--------------------------------------------------
-- TABLE: Category
--------------------------------------------------
CREATE TABLE Category (
    CategoryID CHAR(3) PRIMARY KEY,
    CategoryName VARCHAR(20) NOT NULL
);

INSERT INTO Category (CategoryID, CategoryName)
VALUES ('001', 'Essentials');

INSERT INTO Category (CategoryID, CategoryName)
VALUES ('002', 'Dairy Products');

INSERT INTO Category (CategoryID, CategoryName)
VALUES ('003', 'Beverages');

INSERT INTO Category (CategoryID, CategoryName)
VALUES ('004', 'Food');

INSERT INTO Category (CategoryID, CategoryName)
VALUES ('005', 'Shoes');

--------------------------------------------------
-- TABLE: Product
--------------------------------------------------
CREATE TABLE Product (
    ProductID CHAR(3) PRIMARY KEY,
    Name VARCHAR(30) NOT NULL,
    Price DECIMAL(10,2) NOT NULL,
    StockQuantity INT NOT NULL,
    CategoryID CHAR(3),
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('001', 'Safeguard', '9.99', '100', '001');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('002', 'Head and Shoulders', '99.99', '100', '001');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('003', 'Cream Silk', '79.99', '100', '001');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('004', 'Bioderm', '49.99', '100', '001');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('005', 'Surf', '499.99', '100', '001');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('006', 'Eden Cheese', '45.00', '100', '002');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('007', 'Bear Brand', '9.99', '100', '002');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('008', 'Selecta', '39.99', '100', '002');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('009', 'Alaska', '19.99', '100', '002');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('010', 'Hersheys', '59.99', '100', '002');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('011', 'C2', '12.99', '100', '003');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('012', 'Mogu Mogu', '12.99', '100', '003');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('013', 'Mojitos', '29.99', '100', '003');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('014', 'Pocari Sweat', '19.99', '100', '003');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('015', 'Red Bull', '69.99', '100', '003');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('016', 'Argentina Corned Beef', '7.99', '100', '004');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('017', 'Lucky Me Pancit Canton', '7.99', '100', '004');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('018', 'San Marino Corned Tuna', '7.99', '100', '004');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('019', 'Lucky Me Beef na Beef', '7.99', '100', '004');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('020', 'Highlands Corned Beef', '7.99', '100', '004');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('021', 'Nike', '79.99', '100', '005');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('022', 'Under Armour', '79.99', '100', '005');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('023', 'Converse', '79.99', '100', '005');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('024', 'Adidas', '79.99', '100', '005');

INSERT INTO Product (ProductID, Name, Price, StockQuantity, CategoryID)
VALUES ('025', 'Puma', '79.99', '100', '005');


--------------------------------------------------
-- TABLE: Order
--------------------------------------------------
CREATE TABLE Orders (
    OrderID CHAR(3) PRIMARY KEY,
    OrderDate DATE NOT NULL,
    OrderStatus VARCHAR(20) NOT NULL,
    TotalAmount DECIMAL(10,2) NOT NULL,
    Balance DECIMAL(10,2),
    CustomerID CHAR(3),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID)
);

INSERT INTO Orders (OrderID, OrderDate, OrderStatus, TotalAmount, Balance, CustomerID)
VALUES ('001', '2025-12-01', 'Pending', '9.99', '10.00', '001');

INSERT INTO Orders (OrderID, OrderDate, OrderStatus, TotalAmount, Balance, CustomerID)
VALUES ('002', '2025-12-01', 'Successful', '45.00', '50.00', '002');


--------------------------------------------------
-- TABLE: OrderItem
--------------------------------------------------
CREATE TABLE OrderItem (
    OrderItemID CHAR(3) PRIMARY KEY,
    Quantity INT NOT NULL,
    Subtotal DECIMAL(10,2) NOT NULL,
    OrderID CHAR(3),
    ProductID CHAR(3),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);

INSERT INTO OrderItem (OrderItemID, Quantity, Subtotal, OrderID, ProductID)
VALUES ('001', 2, 19.98, '001', '001');


--------------------------------------------------
-- TABLE: Shipment
--------------------------------------------------
CREATE TABLE Shipment (
    ShipmentID CHAR(3) PRIMARY KEY,
    ShipDate DATE NOT NULL,
    Carrier VARCHAR(30) NOT NULL,
    TrackingNumber VARCHAR(20)
);

INSERT INTO Shipment (ShipmentID, ShipDate, Carrier, TrackingNumber)
VALUES ('001', '2025-12-01', 'Cokaliong', '0123456789');

--------------------------------------------------
-- TABLE: Payment
--------------------------------------------------
CREATE TABLE Payment (
    PaymentID CHAR(3) PRIMARY KEY,
    PaymentDate DATE NOT NULL,
    Amount DECIMAL(10,2) NOT NULL,
    PaymentMethod VARCHAR(20) NOT NULL,
    OrderID CHAR(3),
    FOREIGN KEY (OrderID) REFERENCES `Orders`(OrderID)
);

INSERT INTO Payment (PaymentID, PaymentDate, Amount, PaymentMethod, OrderID)
VALUES ('001', '2025-12-01', '19.98', 'Gcash', '001');

SHOW TABLES;
SELECT * FROM CustomerAddress;
SELECT * FROM Customer;
SELECT * FROM Category;
SELECT * FROM Product;
SELECT * FROM Orders;
SELECT * FROM OrderItem;
SELECT * FROM Shipment;
SELECT * FROM Payment;

DROP DATABASE onlineshoppingsystem_db;