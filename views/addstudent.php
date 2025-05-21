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

// Handle form submission and feedback message
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $grade = trim($_POST['grade'] ?? '');

    if (!$name || !$email || !$dob || !$grade || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "All fields must be filled out correctly.";
    } else {
        $message = addStudent($conn, $name, $email, $dob, $grade);
    }
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
    <title>Add Student</title>
</head>
<!--html body-->
<body class="<?php echo $theme; ?>">

    <div class="header">
        <h1>Add New Student</h1>
        <div class="navbuttons">
            <form action="students.php" method="get" style="display:inline;">
                <input type="submit" value="View Students">
            </form>
            <form action="dashboard.php" method="get" style="display:inline;">
                <input type="submit" value="Dashboard">
            </form>
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Logout">
            </form>
            <button id="themeToggle">Switch Theme</button>
        </div>
    </div>

    <div class="addstudent">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form class="addstudentform" action="addstudent.php" method="post" autocomplete="off">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="dob">Date of Birth:</label><br>
            <input type="date" id="dob" name="dob" required><br>
            <label for="grade">Grade:</label><br>
            <input type="text" id="grade" name="grade" required><br><br>
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