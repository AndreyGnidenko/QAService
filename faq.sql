-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'admins'
-- 
-- ---

DROP TABLE IF EXISTS `admins`;
		
CREATE TABLE `admins` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `login` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(255) NULL DEFAULT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'topics'
-- 
-- ---

DROP TABLE IF EXISTS `topics`;
		
CREATE TABLE `topics` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'questions'
-- 
-- ---

DROP TABLE IF EXISTS `questions`;
		
CREATE TABLE `questions` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `question_text` MEDIUMTEXT NULL DEFAULT NULL,
  `topic_id` INTEGER NULL DEFAULT NULL,
  `is_hidden` TINYINT NULL DEFAULT NULL,
  `author_name` VARCHAR(255) NULL DEFAULT NULL,
  `author_email` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'answers'
-- 
-- ---

DROP TABLE IF EXISTS `answers`;
		
CREATE TABLE `answers` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `answer_text` MEDIUMTEXT NULL DEFAULT NULL,
  `question_id` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `questions` ADD FOREIGN KEY (topic_id) REFERENCES `topics` (`id`);
ALTER TABLE `answers` ADD FOREIGN KEY (question_id) REFERENCES `questions` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `admins` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `topics` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `questions` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `answers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
