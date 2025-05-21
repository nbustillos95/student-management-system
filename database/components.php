<?php
require_once 'data_access.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "components>";

// This file contains functions to display reusable components of the application.

//// function to display students (calls getStudents) 
function displayStudents($conn) {
    $result = getStudents($conn);
    if ($result && $result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Grade</th>
            <th>Age</th>
            <th>Actions</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {

            $dob = $row['studentDOB'];
            $age = date_diff(date_create($dob), date_create('today'))->y;

            echo "<tr>";
            echo "<td>" . $row['studentID'] . "</td>";
            echo "<td>" . $row['studentName'] . "</td>";
            echo "<td>" . $row['studentEmail'] . "</td>";
            echo "<td>" . $dob . "</td>";
            echo "<td>" . $row['studentGrade'] . "</td>";
            echo "<td>" . $age . "</td>";
            echo "<td>
                    <form action='editstudent.php' method='get' style='display:inline;'>
                        <input type='hidden' name='studentID' value='" . $row['studentID'] . "'>
                        <input type='submit' value='Edit'>
                    </form>
                    <form action='deletestudent.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $row['studentID'] . "'>
                        <input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this student?\");'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No students found.";
    }
}
//
//// function to add a new student (calls insertStudent)
function addStudent($conn, $name, $email, $dob, $grade) {
    if (empty($name) || empty($email) || empty($dob) || empty($grade)) {
        return "All fields are required.";
    }
    return insertStudent($conn, $name, $email, $dob, $grade);
}
//

?>