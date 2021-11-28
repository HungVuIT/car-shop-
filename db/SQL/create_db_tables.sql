CREATE DATABASE `database`;
USE `database`;

SET time_zone = "+07:00";   -- VN time


-- Tables without Foreign Keys

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `AdminEmailId` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Contact` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(40),
    `email` varchar(50),
    `message` varchar(1000),
   PRIMARY KEY(`id`)
);

CREATE TABLE `User` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(30) NOT NULL,
    `password` varchar(32) NOT NULL,
    `email` varchar(255) NOT NULL,
    `phone` varchar(15),
    `birthday` DATE,
    `img_path` varchar(255) NOT NULL DEFAULT "register+login+user_profile\\images\\icon\\default_avatar.png",   -- TODO: move folder to root instead
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
    `car_img1` varchar(255),
    `car_img2` varchar(255),
    `car_img3` varchar(255),
    PRIMARY KEY (`id`)
);

CREATE TABLE `aboutUs` (
  `id` int(11) NOT NULL,
`address` varchar(200) DEFAULT NULL,
`email` varchar(200) DEFAULT NULL,
`phone` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
   `value` varchar(200) DEFAULT NULL
);



CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- Tables with Foreign Keys

CREATE TABLE `Order` (
    `user_id` int(11) UNSIGNED NOT NULL,
    `car_id` int(11) UNSIGNED NOT NULL,
    `quantity` int(11) UNSIGNED NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`car_id`) REFERENCES `Car`(`id`),
    PRIMARY KEY (`user_id`, `car_id`)
);


-- CREATE TABLE `CarImg` (
--     `car_id` int(11) UNSIGNED NOT NULL,
--     `car_img_path` varchar(255) NOT NULL UNIQUE,
--     FOREIGN KEY (`car_id`) REFERENCES `Car`(`id`),
--     PRIMARY KEY (`car_img_path`)
-- );

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


CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminUserName` (`AdminUserName`);

--
-- Chỉ mục cho bảng `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postId` (`postId`);

--
-- Chỉ mục cho bảng `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `postsucatid` (`SubCategoryId`),
  ADD KEY `subadmin` (`postedBy`);

--
-- Chỉ mục cho bảng `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`),
  ADD KEY `catid` (`CategoryId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
-- COMMIT;
