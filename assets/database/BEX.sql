CREATE DATABASE BulldogsExchangeStore;
USE BulldogsExchangeStore;

CREATE TABLE Student_Log(
	id INT PRIMARY KEY auto_increment,
    username VARCHAR(255) unique,
    password VARCHAR(255)
);

CREATE TABLE Student ( /* hiwalay first name at last name */
    student_id varchar(255) UNIQUE PRIMARY KEY, /* eto dapat yung student id na mismo ng student like 2024-1022967 */
    first_name VARCHAR(255),
    last_name VARCHAR(255),
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

/*  Procuct ID
	NSTP Shirt = 1
	PE Shirt = 2
    ESS Men Shirt = 3
    ESS Women Shirt = 4
    Tourism Vest = 5
    Tourism Men's Blazer = 6
    Psych Men's Top = 7
    Psych Women's Top = 8
    SHS Type A Men's Top = 9
    SHS Type A Women's Top= 10
    Type A Men's Polo = 11
    Type A Women's Polo = 12
    */

INSERT INTO Product(product_name, category, price) value
("NSTP Uniform", "Uniform", 260);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("1", "XS", "21"),
("1", "S", "12"),
("1", "M", "6"),
("1", "L", "7"),
("1", "XL", "10");
	
INSERT INTO Product(product_name, category, price) value
("PE Shirt", "Uniform", 260);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("2", "XS", "21"),
("2", "S", "20"),
("2", "M", "6"),
("2", "L", "7"),
("2", "XL", "10");

INSERT INTO Product(product_name, category, price) value
("ESS Men's Shirt", "Uniform", 480);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("3", "XS", "21"),
("3", "S", "12"),
("3", "M", "6"),
("3", "L", "7"),
("3", "XL", "10");

INSERT INTO Product(product_name, category, price) value
("ESS Women's Shirt", "Uniform", 480);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("4", "XS", "21"),
("4", "S", "12"),
("4", "M", "6"),
("4", "L", "7"),
("4", "XL", "10");

INSERT INTO Product(product_name, category, price) value
("Tourism Vest", "Uniform", 560);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("5", "XS", "21"),
("5", "S", "12"),
("5", "M", "6"),
("5", "L", "7"),
("5", "XL", "10");

INSERT INTO Product(product_name, category, price) value
("Tourism Men's Coat", "Uniform", 1260);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("6", "XS", "21"),
("6", "S", "12"),
("6", "M", "6"),
("6", "L", "7"),
("6", "XL", "10");

INSERT INTO Product(product_name, category, price) value
("Pscyh Men's Top" , "Uniform", 600);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("7", "XS", "21"),
("7", "S", "12"),
("7", "M", "6"),
("7", "L", "7"),
("7", "XL", "10");

INSERT INTO Product(product_name, category, price) value
("Pscyh Women's Top", "Uniform", 600);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("8", "XS", "21"),
("8", "S", "12"),
("8", "M", "6"),
("8", "L", "7"),
("8", "XL", "10");
	
INSERT INTO Product(product_name, category, price) value
("SHS Type A Men's Polo", "Uniform", 560);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("9", "XS", "21"),
("9", "S", "12"),
("9", "M", "6"),
("9", "L", "7"),
("9", "XL", "10");

INSERT INTO Product(product_name, category, price) value
("SHS Type A Women's Polo", "Uniform", 560);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("10", "XS", "21"),
("10", "S", "12"),
("10", "M", "6"),
("10", "L", "7"),
("10", "XL", "10");

INSERT INTO Product(product_name, category, price) value
("Type A Men's Polo", "Uniform", 560);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("11", "XS", "21"),
("11", "S", "12"),
("11", "M", "6"),
("11", "L", "7"),
("11", "XL", "10");
				
INSERT INTO Product(product_name, category, price) value
("Type A Women's Polo" , "Uniform", 560);
INSERT INTO product_sizestock(product_id, size, stock_quantity) value
("12", "XS", "21"),
("12", "S", "12"),
("12", "M", "6"),
("12", "L", "7"),
("12", "XL", "10");

/* passwords are 123 */
insert into student_log(username, password) value
('student', '202cb962ac59075b964b07152d234b70'),
('student2', '202cb962ac59075b964b07152d234b70');

insert into student(student_id, first_name, last_name, email, course, year_level, s_id) value
('2024-1022967', 'John', 'Doe', 'student@example.com', 'BS Computer Science', '3rd Year', 1),
('2024-1022968', 'Jane', 'Smith', 'student@example.com', 'BS Information Technology', '2nd Year', 2);

insert into admin(username, password) value
('admin', '202cb962ac59075b964b07152d234b70');

insert into reservation(student_id, product_id, size, quantity, reservation_date, status) value
('2024-1022967', 1, 'M', 2, '2024-10-01', 'Pending'),
('2024-1022968', 2, 'S', 1, '2024-10-02', 'Pending');

SELECT * FROM Student WHERE s_id = 1; 