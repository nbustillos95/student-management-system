DROP DATABASE IF EXISTS student_management;
CREATE DATABASE student_management;
USE student_management; 

CREATE TABLE students (
    studentID INT AUTO_INCREMENT PRIMARY KEY,
    studentName VARCHAR(100) NOT NULL,
    studentEmail VARCHAR(100) NOT NULL UNIQUE,
    studentDOB DATE NOT NULL,
    studentGrade VARCHAR (10) NOT NULL
);

CREATE TABLE users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(100) NOT NULL,
    userPassword VARCHAR(100) NOT NULL
);

INSERT INTO students (studentName, studentEmail, studentDOB, studentGrade)
VALUES ('John Smith', 'example@student.com', '2000-05-20', 'A');

INSERT INTO users (userName, userPassword)
VALUES ('admin', 'admin123');

DROP USER IF EXISTS sm_admin@localhost;
CREATE USER sm_admin@localhost
IDENTIFIED BY 'admin123';

GRANT SELECT, INSERT, DELETE, UPDATE
ON student_management.* 
TO sm_admin@localhost;