CREATE DATABASE `FINAL`;
USE `FINAL`;
CREATE TABLE `contact` (
`id` int UNIQUE NOT NULL,
   `name` varchar(40),
   `email` varchar(50),
`message` varchar(1000),
   PRIMARY KEY(id)
);
