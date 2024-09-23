CREATE TABLE admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE user (
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
    code_product VARCHAR(50) PRIMARY KEY NOT NULL,
    name_product VARCHAR(100) NOT NULL UNIQUE,
    stock_product INT(11) NOT NULL,
    desc_product TEXT,
    image_product VARCHAR(100),
    variant_product VARCHAR(50) NOT NULL,
    price_product DECIMAL(10, 2) NOT NULL
);

CREATE TABLE transaction (
    code_transaction VARCHAR(50) PRIMARY KEY NOT NULL,
    user VARCHAR(50) NOT NULL,
    method_payment VARCHAR(50) NOT NULL,
    date_transaction DATE NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    desc_transaction TEXT,
    FOREIGN KEY (user) REFERENCES register(username)
);