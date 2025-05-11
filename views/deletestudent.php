<?php
require_once '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Use the correct column name (studentID) in the query
    $query = "DELETE FROM students WHERE studentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // No echo or output here
    } else {
        // No echo or output here
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the students page
    header("Location: ./students.php");
    exit();
} else {
    echo "Invalid request.";
}
?>