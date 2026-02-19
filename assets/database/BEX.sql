CREATE DATABASE BulldogsExchangeStore;
USE BulldogsExchangeStore;

CREATE TABLE User_Credentials(
	id INT PRIMARY KEY auto_increment,
    username VARCHAR(50) unique,
    password VARCHAR(255)
);

CREATE TABLE Student ( 
    student_id varchar(12) UNIQUE PRIMARY KEY, 
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    course VARCHAR(255),
    year_level VARCHAR(20),
    userid int UNIQUE,
    FOREIGN KEY(userid) REFERENCES User_Credentials(id)
);

CREATE TABLE Product (
    product_id INT PRIMARY KEY auto_increment,
    product_name VARCHAR(255),
    category VARCHAR(255),
    price DECIMAL(10,2),
    image VARCHAR(255)
);

CREATE TABLE Product_SizeStock (
	pssid int primary key auto_increment,
    product_id int,
    size varchar(20),
    stock_quantity int,
    FOREIGN KEY (product_id) references Product(product_id)
);

CREATE TABLE Admin (
    admin_id INT PRIMARY KEY auto_increment,
    username VARCHAR(50) unique,
    password VARCHAR(100)
);

CREATE TABLE Reservation (
    reservation_id INT PRIMARY KEY auto_increment,
    student_id VARCHAR(12),
    pssid INT,
    quantity INT,
    reservation_date DATE,
    status VARCHAR(50),
    FOREIGN KEY (student_id) REFERENCES Student(student_id),
    FOREIGN KEY (pssid) REFERENCES Product_SizeStock(pssid)
);

/* passwords are 123 */
insert into User_Credentials(username, password) value
('student', '202cb962ac59075b964b07152d234b70'),
('student2', '202cb962ac59075b964b07152d234b70');

insert into admin(username, password) value
('admin', '202cb962ac59075b964b07152d234b70');