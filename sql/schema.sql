CREATE DATABASE IF NOT EXISTS test;

use test;

/* CLStore SQL Schema */

CREATE TABLE Products (
	id int unsigned not null auto_increment primary key,
	name varchar(255) not null,
	price decimal(6,2) not null,
	description text,
	availability int unsigned not null
);

CREATE TABLE Users (
	id int unsigned not null auto_increment primary key,
	email varchar(255) not null,
	password varchar(255) not null,
	firstname varchar(255) not null,
	lastname varchar(255) not null,
	is_admin tinyint(1) default 0
);

CREATE TABLE Photos (
	id int unsigned not null auto_increment primary key,
	product_id int unsigned not null,
	file_path varchar(355) not null,
  	FOREIGN KEY fk_prod(product_id) REFERENCES Products(id)
  	ON UPDATE CASCADE
  	ON DELETE RESTRICT
);

CREATE TABLE Messages (
	id int unsigned not null auto_increment primary key,
	subject varchar(255) not null,
	message text,
	from_user_id int unsigned not null,
	to_user_id int unsigned not null,
	senddate timestamp,
	is_read tinyint(1) DEFAULT 0,
	FOREIGN KEY fk_from_user(from_user_id) REFERENCES Users(id),
	FOREIGN KEY fk_to_user(to_user_id) REFERENCES Users(id)
);

CREATE TABLE Orders (
	id int unsigned not null auto_increment primary key,
	user_id int unsigned not null,
	state tinyint(2) not null DEFAULT 0,
	FOREIGN KEY fk_order_user(user_id) REFERENCES Users(id)
);

CREATE TABLE Order_Products (
	id int unsigned not null auto_increment primary key,
	order_id int unsigned not null,
	product_id int unsigned not null,
	quantity int unsigned not null,
	FOREIGN KEY fk_order(order_id) REFERENCES Orders(id),
	FOREIGN KEY fk_product(product_id) REFERENCES Products(id)	
);

CREATE TABLE Baskets (
	id int unsigned not null auto_increment primary key,
	user_id int unsigned not null,
	product_id int unsigned not null,
	quantity int unsigned not null,
	FOREIGN KEY fk_basket_user(user_id) REFERENCES Users(id),
	FOREIGN KEY fk_basket_product(product_id) REFERENCES Products(id)
);

