<?php
// Test the connection
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "database>";

// Database credentials
$servername = "localhost";
$username = "sm_admin";
$password = "admin123";
$database = "student_management";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
