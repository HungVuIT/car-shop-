CREATE TABLE Car( 
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(50) NOT NULL, 
	brand VARCHAR(30), 
	year INT(4) UNSIGNED, seats INT, color VARCHAR(30), 
	tranmisstion VARCHAR(10), # manual, auto 
	price DECIMAL(15,2), 
	description TEXT 
);