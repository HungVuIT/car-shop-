-- Insert ADMIN user

INSERT INTO `user`(`name`, `password`, `email`) VALUES
    ('Admin', '0192023a7bbd73250516f069df18b500', 'admin@gmail.com')    -- password = 'admin123'
;










INSERT INTO `car`(`name`, `brand`, `year`, `seats`, `color`, `transmission`, `engine`, `price`, `warranty`, `description`) VALUES
	('Car 01', 'BMW', 2010, 4, 'Red'	, 'manual'	, 2.0, 125000, 4, 'Lorem ipsum'),
	('Car 02', 'MEC', 2014, 6, 'Yellow'	, 'auto'	, 1.8, 224000, 6, 'Lorem ipsum'),
	('Car 03', 'FER', 2005, 4, 'Blue'	, 'manual'	, 1.6, 126000, 1, 'Lorem ipsum'),
	('Car 04', 'CCX', 2012, 8, 'White'	, 'manual'	, 2.2, 152000, NULL, 'Lorem ipsum'),
	('Car 05', 'ASX', 2008, 4, 'Black'	, 'auto'	, 2.4, 141000, 4, 'Lorem ipsum'),
	('Car 06', 'BMW', 2012, 6, 'Grey'	, 'auto'	, 3.0, 162000, 5, 'Lorem ipsum'),
	('Car 07', 'MEC', 2011, 4, 'Red'	, 'manual'	, 1.6, 155000, 2, 'Lorem ipsum'),
	('Car 08', 'FER', 2019, 8, 'Grey'	, 'auto'	, 2.6, 215000, 7, 'Lorem ipsum'),
	('Car 09', 'FER', 2003, 4, 'Black'	, 'manual'	, 2.4, 225000, 3, 'Lorem ipsum'),
	('Car 10', 'BMW', 2012, 4, 'Green'	, 'auto'	, 1.4, 252000, 3, 'Lorem ipsum'),
	('Car 11', 'FER', 2018, 2, 'Purple'	, 'manual'	, 2.8, 321000, 5, 'Lorem ipsum'),
	('Car 12', 'BMW', 2020, 4, 'White'	, 'auto'	, 2.2, 129000, 2, 'Lorem ipsum')
;
