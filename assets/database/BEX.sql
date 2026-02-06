CREATE DATABASE BulldogsExchangeStore;
USE BulldogsExchangeStore;

CREATE TABLE Student_Log(
	id INT PRIMARY KEY auto_increment,
    username VARCHAR(100) unique,
    password VARCHAR(100)
);

CREATE TABLE Student (
    student_id INT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    course VARCHAR(100),
    year_level VARCHAR(20),
    FOREIGN KEY(student_id) REFERENCES Student_Log(id)
);

CREATE TABLE Product (
    product_id INT PRIMARY KEY,
    product_name VARCHAR(100),
    category VARCHAR(50),
    price DECIMAL(10,2)
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
    username VARCHAR(50),
    password VARCHAR(100)
);

CREATE TABLE Reservation (
    reservation_id INT PRIMARY KEY auto_increment,
    student_id INT,
    product_id INT,
    quantity INT,
    reservation_date DATE,
    status VARCHAR(50),
    FOREIGN KEY (student_id) REFERENCES Student_Log(id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

/* sineparate ko yung size and stocks sa product table kasi different size = different stock. gets ba gets ba

tinanggal ko yung id sa product_sizestock kasi hindi naman siya kailangan, pwede naman natin i-identify yung size at stock gamit yung product_id at size.

tapos yung auto_increment sa product_id tinanggal ko kasi nakakabobo pag nagdedelete di narereset yung increment.
*/

INSERT INTO Product(product_id, product_name, category, price) value
(1, "NSTP Uniform", "Uniform", 350);

INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("1", "S", "12"),
("1", "M", "6"),
("1", "L", "7");

INSERT INTO Product(product_id, product_name, category, price) value
(2, "PE Uniform", "Uniform", 450);

INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("2", "S", "12"),
("2", "M", "69"),
("2", "XL", "37");

/* passwords are 123 */
insert into student_log(username, password) value
('student', '202cb962ac59075b964b07152d234b70'),
('student2', '202cb962ac59075b964b07152d234b70');

insert into admin(username, password) value
('admin', '202cb962ac59075b964b07152d234b70');

SELECT 
product.product_id,
product.product_name,
product.category, 
product.price,
product_sizestock.size, 
product_sizestock.stock_quantity
FROM product
LEFT JOIN product_sizestock ON product.product_id = product_sizestock.product_id
ORDER BY product.product_id, product_sizestock.size;

delete from product_sizestock where product_id = 1 and size = "S";