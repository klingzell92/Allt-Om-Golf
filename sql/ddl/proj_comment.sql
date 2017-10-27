USE anaxdb;


-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table User
--
DROP TABLE IF EXISTS proj_comment;
CREATE TABLE proj_comment (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `articleId` INTEGER NOT NULL,
    `user` VARCHAR(80) NOT NULL,
    `content` TEXT NOT NULL,
    `gravatar` VARCHAR(255) NOT NULL,
    `created` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

SELECT * FROM proj_comment;
