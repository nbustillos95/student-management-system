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
    <title>Dashboard</title>
</head>
<!--html body-->
<body class="<?php echo $theme; ?>">

    <div class="header">
        <h1>Welcome to the dashboard</h1>
        <div class="navbuttons">
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Logout">
            </form>
            <button id="themeToggle">Switch Theme</button>
        </div>
    </div>

    <div class="dashboard">
        <ul>
            <li><a href="students.php" class="dashlink">View/Edit Students</a></li>
        </ul>
    </div>

    <script src="assets/myscript.js"></script>
</body>
</html>

<?php
// Close database connection if open
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}