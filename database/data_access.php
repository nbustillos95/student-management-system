<?php
require_once 'database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "data_access>";

// This file contains functions to query the data to be used in the application.

//// function to get student data
function getStudents($conn) {
    $sql = "SELECT
                students.studentID,
                students.studentName,
                students.studentEmail,
                students.studentDOB,
                students.studentGrade
            FROM
                students
            ORDER BY students.studentID ASC";
    return $conn->query($sql);
}
//
//// function to insert a new student into the database
function insertStudent($conn, $name, $email, $dob, $grade) {
    $query = "INSERT INTO students (studentName, studentEmail, studentDOB, studentGrade) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        return "Error preparing statement: " . $conn->error;
    }
    $stmt->bind_param("ssss", $name, $email, $dob, $grade);
    if ($stmt->execute()) {
        $stmt->close();
        return "Student added successfully!";
    } else {
        $stmt->close();
        return "Error: " . $stmt->error;
    }
}
//
//// fetch a students details by ID
function getStudentByID($conn, $studentID) {
    $query = "SELECT * FROM students WHERE studentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
//
//// Update a student's details
function updateStudent($conn, $studentID, $studentName, $studentEmail, $studentDOB, $studentGrade) {
    $stmt = $conn->prepare("UPDATE students SET studentName=?, studentEmail=?, studentDOB=?, studentGrade=? WHERE studentID=?");
    $stmt->bind_param("ssssi", $studentName, $studentEmail, $studentDOB, $studentGrade, $studentID);
    return $stmt->execute();
}
//
////

//
?>