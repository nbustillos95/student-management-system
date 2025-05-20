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

// Handle form submission (update student)
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['studentID'];
    $studentName = $_POST['studentName'];
    $studentEmail = $_POST['studentEmail'];
    $studentDOB = $_POST['studentDOB'];
    $studentGrade = $_POST['studentGrade'];

    if (updateStudent($conn, $studentID, $studentName, $studentEmail, $studentDOB, $studentGrade)) {
        header("Location: students.php");
        exit();
    } else {
        $message = "Failed to update student details. Please try again.";
    }
}

// Handle GET request (show form)
$student = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];
    $student = getStudentByID($conn, $studentID);
    if (!$student) {
        $message = "Student not found.";
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
    <title>Edit Student</title>
</head>
<body class="<?php echo $theme; ?>">
    <div class="header">
        <h1>Edit Student</h1>
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
    <div class="editstudentform">
        <?php if ($message): ?>
            <div class="error"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($student): ?>
            <?php displayEditStudentForm($student); ?>
        <?php endif; ?>
    </div>
    <script src="assets/myscript.js"></script>
</body>
</html>
<?php
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}