-- Run once: mysql -u root -p < schema.sql
CREATE DATABASE IF NOT EXISTS university CHARACTER SET utf8mb4;
USE university;

CREATE TABLE IF NOT EXISTS Course (
    id     INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course VARCHAR(100) NOT NULL,
    credit INT          NOT NULL
);

INSERT INTO Course (course, credit) VALUES
    ('Introduction to Programming', 3),
    ('Database Management Systems', 3),
    ('Web Application Development', 4);
