CREATE DATABASE IF NOT EXISTS university;
USE university;

CREATE TABLE IF NOT EXISTS Course (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course VARCHAR(100) NOT NULL,
    credit INT NOT NULL CHECK (credit BETWEEN 1 AND 10)
);

INSERT INTO Course (course, credit) VALUES
('Introduction to Programming', 3),
('Database Systems', 4),
('Web Development', 3);
