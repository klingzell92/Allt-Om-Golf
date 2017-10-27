USE anaxdb;


-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table User
--
DROP TABLE IF EXISTS proj_question;
CREATE TABLE proj_question (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `user` VARCHAR(80) NOT NULL,
    `title` VARCHAR(80) NOT NULL,
    `content` TEXT NOT NULL,
    `gravatar` VARCHAR(255) NOT NULL,
    `tags` VARCHAR(80),
    `created` DATETIME,
    `updated` DATETIME,
    `deleted` DATETIME,
    `active` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
