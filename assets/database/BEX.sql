CREATE DATABASE BulldogsExchangeStore;
USE BulldogsExchangeStore;

CREATE TABLE Student_Log(
	id INT PRIMARY KEY auto_increment,
    username VARCHAR(255) unique,
    password VARCHAR(255)
);

CREATE TABLE Student (
    student_id varchar(255) UNIQUE PRIMARY KEY, /* eto dapat yung student id na mismo ng student like 2024-1022967 */
    name VARCHAR(255),
    email VARCHAR(255),
    course VARCHAR(255),
    year_level VARCHAR(20),
    s_id int, /*eto yung irereference sa id ng student_log*/
    FOREIGN KEY(s_id) REFERENCES Student_Log(id)
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
    username VARCHAR(50),
    password VARCHAR(100)
);

CREATE TABLE Reservation (
    reservation_id INT PRIMARY KEY auto_increment,
    student_id VARCHAR(255),
    product_id INT,
    size varchar(5),
    quantity INT,
    reservation_date DATE,
    status VARCHAR(50),
    FOREIGN KEY (student_id) REFERENCES Student(student_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

/* sineparate ko yung size and stocks sa product table kasi different size = different stock. gets ba gets ba*/

INSERT INTO Product(product_name, category, price) value
("NSTP Uniform", "Uniform", 350);

INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("1", "S", "12"),
("1", "M", "6"),
("1", "L", "7");

INSERT INTO Product(product_name, category, price) value
("PE Uniform", "Uniform", 450);

INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("2", "S", "12"),
("2", "M", "69"),
("2", "XL", "37");

/* passwords are 123 */
insert into student_log(username, password) value
('student', '202cb962ac59075b964b07152d234b70'),
('student2', '202cb962ac59075b964b07152d234b70');

insert into student(student_id, name, email, course, year_level, s_id) value
('2024-1022967', 'John Doe', 'student@example.com', 'BSCS', '3rd Year', 1),
('2024-1022968', 'Jane Smith', 'student@example.com', 'BSIT', '2nd Year', 2);

insert into admin(username, password) value
('admin', '202cb962ac59075b964b07152d234b70');

insert into reservation(student_id, product_id, size, quantity, reservation_date, status) value
('2024-1022967', 1, 'M', 2, '2024-10-01', 'Pending'),
('2024-1022968', 2, 'S', 1, '2024-10-02', 'Pending');
