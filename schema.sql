CREATE DATABASE IF NOT EXISTS back2school;
USE back2school;

CREATE TABLE IF NOT EXISTS users(
  Username VARCHAR(255) PRIMARY KEY,
  Password VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS product(
  ID INTEGER PRIMARY KEY,
  Name VARCHAR(255) NOT NULL,
  Price FLOAT(10, 2) NOT NULL,
  Image VARCHAR(255) NOT NULL,
  Quantity INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS cart(
  ID INTEGER PRIMARY KEY,
  UserID VARCHAR(255),
  ProductID INTEGER,
  Quantity INTEGER,
  FOREIGN KEY (UserID) REFERENCES users(Username),
  FOREIGN KEY (ProductID) REFERENCES product(ID)
);

CREATE TABLE IF NOT EXISTS shipping(
  id INTEGER PRIMARY KEY,
  shipping_code VARCHAR(40),
  creation_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS payment_option(
  id INTEGER PRIMARY KEY,
  user_id VARCHAR(255),
  pay_fullname VARCHAR(100),
  pay_alias VARCHAR(20),
  pay_type ENUM('PayPal', 'CreditCard', 'DebitCard', 'AfterPay', 'COD', 'Other') DEFAULT 'Other',
  email VARCHAR(100),
  card_number VARCHAR(20),
  card_ccv VARCHAR(5),
  card_expiry DATE,
  cod_id VARCHAR(30),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS shop_order(
  id INTEGER PRIMARY KEY,
  cart_id INTEGER,
  user_id VARCHAR(255),
  payment_id INTEGER,
  shipping_id INTEGER,
  total_cost FLOAT(10, 2) DEFAULT 0.00,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (cart_id) REFERENCES cart(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
  FOREIGN KEY (payment_id) REFERENCES payment_option(id)
);

