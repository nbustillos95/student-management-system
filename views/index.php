<?php
session_start();
require_once '../database/database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve and clear login error message from session
$loginError = '';
if (isset($_SESSION['loginError'])) {
    $loginError = $_SESSION['loginError'];
    unset($_SESSION['loginError']);
}

// Set theme based on cookie, default to light
$theme = isset($_COOKIE['theme']) ? htmlspecialchars($_COOKIE['theme']) : 'light-theme';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/layout.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Index</title>
</head>
<!--html body-->
<body class="<?php echo $theme; ?>">

    <div class="header">
        <h1>Welcome to the Student Management System</h1>
        <div class="navbuttons">
            <button id="themeToggle">Switch Theme</button>
        </div>
    </div>

    <div class="loginform">
        <h2>Login</h2>
        <?php if (!empty($loginError)): ?>
            <div class="error"><?php echo htmlspecialchars($loginError); ?></div>
        <?php endif; ?>
        <form action="login.php" method="post" autocomplete="off">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
    
    <script src="assets/myscript.js"></script>
</body>
</html>

<?php
// Close database connection if open
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}