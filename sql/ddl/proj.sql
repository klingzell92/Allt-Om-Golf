USE anaxdb;

--
-- Table User
--
DROP TABLE IF EXISTS proj_user;
CREATE TABLE proj_user (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `acronym` VARCHAR(80) UNIQUE NOT NULL,
    `email` VARCHAR(80) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
	`activity` INTEGER
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
SELECT * FROM proj_user;

--
-- Table User
--
DROP TABLE IF EXISTS proj_q2tag;
DROP TABLE IF EXISTS proj_question;
CREATE TABLE proj_question (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `user` VARCHAR(80) NOT NULL,
    `title` VARCHAR(80) NOT NULL,
    `content` TEXT NOT NULL,
    `gravatar` VARCHAR(255) NOT NULL,
    `created` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
SELECT * FROM proj_question;
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
    `created` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

SELECT * FROM proj_comment;



--
-- Table Answer
--
DROP TABLE IF EXISTS proj_answer;
CREATE TABLE proj_answer (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `commentId` INTEGER,
    `questionId` INTEGER,
    `user` VARCHAR(80) NOT NULL,
    `content` TEXT NOT NULL,
    `created` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

SELECT * FROM proj_answer;

--
-- Table Tags
--
DROP TABLE IF EXISTS proj_tags;
CREATE TABLE proj_tags (
	`id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `tag` VARCHAR(30),
    `used` INTEGER
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

SELECT * FROM proj_tags;
--
-- Table q2tag
--

CREATE TABLE proj_q2tag (
	`id` INT AUTO_INCREMENT,
	`questionId` INT,
	`tagId` INT,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`tagId`) REFERENCES `proj_tags` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`questionId`) REFERENCES `proj_question` (`id`)
)ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
SELECT * FROM proj_q2tag;
