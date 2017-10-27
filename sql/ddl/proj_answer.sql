USE anaxdb;


-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table User
--
DROP TABLE IF EXISTS proj_answer;
CREATE TABLE proj_answer (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `commentId` INTEGER,
    `questionId` INTEGER,
    `user` VARCHAR(80) NOT NULL,
    `content` TEXT NOT NULL,
    `gravatar` VARCHAR(255) NOT NULL,
    `created` DATETIME,
    `updated` DATETIME,
    `deleted` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

SELECT * FROM proj_answer;
