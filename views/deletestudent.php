<?php
session_start();
require_once '../database/database.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['userID'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Use prepared statement to delete student by ID
    $stmt = $conn->prepare("DELETE FROM students WHERE studentID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the students page
    header("Location: students.php");
    exit;
} else {
    // Invalid request, redirect to students page
    header("Location: students.php");
    exit;
}

if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}