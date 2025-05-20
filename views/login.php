<?php
session_start();
require_once '../database/database.php';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $loginError = '';

    // Check if both fields are filled
    if ($username && $password) {
        // Prepare and execute user lookup
        $stmt = $conn->prepare("SELECT userID, userPassword FROM users WHERE userName = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        // If user found, verify password
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($userId, $dbPassword);
            $stmt->fetch();
            if ($password === $dbPassword) { // Plain text check (not for production)
                $_SESSION['userID'] = $userId;
                $_SESSION['userName'] = $username;
                header('Location: dashboard.php');
                exit;
            }
        }
        $stmt->close();
        $loginError = 'Invalid username or password.';
    } else {
        $loginError = 'Please enter both username and password.';
    }

    // Store error and redirect back to login
    $_SESSION['loginError'] = $loginError;
    header('Location: index.php');
    exit;
}

// Redirect if accessed directly
header('Location: index.php');
exit;