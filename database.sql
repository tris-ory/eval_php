CREATE DATABASE IF NOT EXISTS `wf3_php_intermediaire_tristan`;
USE `wf3_php_intermediaire_tristan`;
CREATE TABLE `advert` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `postal_code` CHAR(5) NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `type` CHAR(1) NOT NULL,
  `price` DECIMAL(9,2) NOT NULL,
  `reservation_message` VARCHAR(255) DEFAULT '',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);