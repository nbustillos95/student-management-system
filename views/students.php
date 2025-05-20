<?php
session_start();
require_once '../database/database.php';
require_once '../database/components.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Redirect to login if not authenticated
if (!isset($_SESSION['userID'])) {
    header('Location: index.php');
    exit;
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
    <title>View Students Table</title>
</head>
<body class="<?php echo $theme; ?>">
    <div class="header">
        <h1>Currently Enrolled Students</h1>
        <div class="navbuttons">
            <form action="dashboard.php" method="get" style="display:inline;">
                <input type="submit" value="Dashboard">
            </form>
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Logout">
            </form>
            <button id="themeToggle">Switch Theme</button>
        </div>
    </div>
    <div class="dashboard">
        <h2>Student Data</h2>
        <?php displayStudents($conn); ?>
    </div>
    <div class="addstudent">
        <form action="addstudent.php" method="post">
            <input type="submit" value="Add Student">
        </form>
    </div>
    <script src="assets/myscript.js"></script>
</body>
</html>
<?php
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}