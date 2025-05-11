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

DROP USER IF EXISTS sm_admin@localhost;
CREATE USER sm_admin@localhost
IDENTIFIED BY 'admin123';

GRANT SELECT, INSERT, DELETE, UPDATE
ON student_management.* 
TO sm_admin@localhost;

