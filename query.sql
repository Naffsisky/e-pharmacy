CREATE TABLE admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE register (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    dateOfBirth DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    paypalID VARCHAR(100) NOT NULL
);

CREATE TABLE product (
    code_product VARCHAR(50) PRIMARY KEY,
    name_product VARCHAR(100),
    stock_product INT(11),
    desc_product TEXT,
    variant_product VARCHAR(50),
    price_product DECIMAL(10, 2)
);

CREATE TABLE transaction (
    code_transaction VARCHAR(50) PRIMARY KEY,
    user VARCHAR(50),
    method_payment VARCHAR(50),
    total_price DECIMAL(10, 2),
    desc_transaction TEXT,
    FOREIGN KEY (user) REFERENCES register(username)
);