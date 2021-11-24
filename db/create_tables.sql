SET time_zone = "+07:00";   -- VN time


-- Tables without Foreign Keys

CREATE TABLE `User` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(30) NOT NULL,
    `password` varchar(30) NOT NULL,
    `email` varchar(255) NOT NULL,
    `phone` varchar(15),
    `birthday` DATE,
    `img_path` varchar(255) NOT NULL DEFAULT "res/",   -- TODO: do I really need DEFAULT here?
    PRIMARY KEY (`id`)
);

CREATE TABLE `Car` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL UNIQUE, 
    `brand` varchar(20) NOT NULL, 
    `year` year NOT NULL, 
    `seats` int(2) NOT NULL, 
    `color` varchar(10) NOT NULL, 
    `transmission` varchar(6) NOT NULL, -- `manual`/`auto`
    `engine` float(1) NOT NULL, 	    -- 1.5, 2.0,... L
    `price` int(11) NOT NULL,
    `warranty` int(2),                  -- years
    `description` varchar(2048),
    PRIMARY KEY (`id`)
);

CREATE TABLE `Article` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` varchar(256) NOT NULL,
    `date_posted` datetime NOT NULL,
    `content` varchar(65536) NOT NULL,
    PRIMARY KEY (`id`)
);



-- Tables with Foreign Keys

CREATE TABLE `Order` (
    `user_id` int(11) UNSIGNED NOT NULL,
    `car_id` int(11) UNSIGNED NOT NULL,
    `quantity` int(11) UNSIGNED NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`car_id`) REFERENCES `Car`(`id`),
    PRIMARY KEY (`user_id`, `car_id`)
);


CREATE TABLE `CarImg` (
    `car_id` int(11) UNSIGNED NOT NULL,
    `car_img_path` varchar(255) NOT NULL UNIQUE,
    FOREIGN KEY (`car_id`) REFERENCES `Car`(`id`),
    PRIMARY KEY (`car_img_path`)
);

CREATE TABLE `CarReview` (
    `user_id` int(11) UNSIGNED NOT NULL,
    `car_id` int(11) UNSIGNED NOT NULL,
    `review` varchar(256) NOT NULL,
    `rating` int(2) UNSIGNED,
    `date_posted` datetime,
    FOREIGN KEY (`user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`car_id`) REFERENCES `Car`(`id`),
    PRIMARY KEY (`user_id`, `car_id`)
);


CREATE TABLE `ArticleKeyword` (
    `article_id` int(11) UNSIGNED NOT NULL,
    `keyword` varchar(30) NOT NULL,
    FOREIGN KEY (`article_id`) REFERENCES `Article`(`id`),
    PRIMARY KEY (`article_id`, `keyword`)
);

CREATE TABLE `ArticleComment` (
    `user_id` int(11) UNSIGNED NOT NULL,
    `article_id` int(11) UNSIGNED NOT NULL,
    `comment` varchar(256) NOT NULL,
    `date_posted` datetime NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`article_id`) REFERENCES `Article`(`id`),
    PRIMARY KEY (`user_id`, `article_id`)
);