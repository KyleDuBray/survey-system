CREATE DATABASE IF NOT EXISTS `survey_system`;

use `survey_system`;

DROP TABLE IF EXISTS `response`;
DROP TABLE IF EXISTS `question_option`;
DROP TABLE IF EXISTS `question`;
DROP TABLE IF EXISTS `survey`;
DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
user_id INT AUTO_INCREMENT,
email VARCHAR(100) UNIQUE NOT NULL,
password VARCHAR(60) NOT NULL,
PRIMARY KEY(user_id)
);


CREATE TABLE `survey` (
survey_id INT AUTO_INCREMENT,
creator_id INT NOT NULL,
title VARCHAR(60) NOT NULL,
PRIMARY KEY(survey_id),
FOREIGN KEY(creator_id) REFERENCES `user`(user_id)
);


CREATE TABLE `question` (
question_id INT AUTO_INCREMENT,
survey_id INT NOT NULL,
question_text VARCHAR(255) NOT NULL,
response_type VARCHAR(30) NOT NULL,
PRIMARY KEY(question_id),
FOREIGN KEY (survey_id) REFERENCES `survey`(survey_id)
);


CREATE TABLE `question_option` (
option_id INT AUTO_INCREMENT,
question_id INT NOT NULL,
option_type VARCHAR(30) NOT NULL,
option_text VARCHAR(255),
PRIMARY KEY (option_id),
FOREIGN KEY (question_id) REFERENCES `question`(question_id)
);


CREATE TABLE `response`(
response_id INT AUTO_INCREMENT,
survey_id INT NOT NULL,
question_id INT NOT NULL,
option_id INT NOT NULL,
user_id INT NOT NULL,
response_text VARCHAR(255),
PRIMARY KEY (response_id),
FOREIGN KEY (survey_id) REFERENCES `survey`(survey_id),
FOREIGN KEY (question_id) REFERENCES `question`(question_id),
FOREIGN KEY (option_id) REFERENCES `question_option`(option_id),
FOREIGN KEY (user_id) REFERENCES `user`(user_id)
);