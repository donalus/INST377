DROP DATABASE IF EXISTS  `organizations`;
CREATE DATABASE `organizations` DEFAULT CHARACTER SET utf8;
USE `organizations`;
CREATE TABLE `organizations` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_name` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `country` varchar(45) NOT NULL,
  `description` text,
  `state_or_region` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `founding_year` int(11) NOT NULL,
  `size` varchar(45) DEFAULT NULL,
  `type_of_data_used` varchar(255) DEFAULT NULL,
  `sectors` varchar(45) DEFAULT NULL,
  `organization_type` varchar(45) NOT NULL,
  `country_income_level` varchar(45) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
