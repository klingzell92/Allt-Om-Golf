--
-- Table User
--
DROP TABLE IF EXISTS proj_user;
CREATE TABLE proj_user (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `acronym` VARCHAR(80) UNIQUE NOT NULL,
    `email` VARCHAR(80) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created` DATETIME,
    `updated` DATETIME,
    `deleted` DATETIME,
    `active` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
SELECT * FROM proj_user;


--
-- Table Answer
--
DROP TABLE IF EXISTS proj_answer;
CREATE TABLE proj_answer (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `commentId` INTEGER NOT NULL,
    `user` VARCHAR(80) NOT NULL,
    `content` TEXT NOT NULL,
    `gravatar` VARCHAR(255) NOT NULL,
    `created` DATETIME,
    `updated` DATETIME,
    `deleted` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

SELECT * FROM proj_answer;

--
-- Table Comment
--
DROP TABLE IF EXISTS proj_comment;
CREATE TABLE proj_comment (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `articleId` INTEGER NOT NULL,
    `user` VARCHAR(80) NOT NULL,
    `content` TEXT NOT NULL,
    `gravatar` VARCHAR(255) NOT NULL,
    `created` DATETIME,
    `updated` DATETIME,
    `deleted` DATETIME,
    `active` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

SELECT * FROM proj_comment;

