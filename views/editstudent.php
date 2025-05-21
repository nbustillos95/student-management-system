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

// Handle GET request (show form)
$student = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];
    $student = getStudentByID($conn, $studentID);
    if (!$student) {
        $message = "Student not found.";
    }
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
<!--html body-->
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

    <h2>Edit Student Form</h2>

    <div class="editstudent">
        <?php if ($message): ?>
            <div class="error"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($student): ?>
            <form method="post">
                <input type="hidden" name="studentID" value="<?php echo htmlspecialchars($student['studentID']); ?>">
                <label for="studentName">Name:</label>
                <input type="text" id="studentName" name="studentName" value="<?php echo htmlspecialchars($student['studentName']); ?>" required>
                <br>
                <label for="studentEmail">Email:</label>
                <input type="email" id="studentEmail" name="studentEmail" value="<?php echo htmlspecialchars($student['studentEmail']); ?>" required>
                <br>
                <label for="studentDOB">Date of Birth:</label>
                <input type="date" id="studentDOB" name="studentDOB" value="<?php echo htmlspecialchars($student['studentDOB']); ?>" required>
                <br>
                <label for="studentGrade">Grade:</label>
                <input type="text" id="studentGrade" name="studentGrade" value="<?php echo htmlspecialchars($student['studentGrade']); ?>" required>
                <br><br>
                <input type="submit" value="Update Student">
            </form>
        <?php endif; ?>
    </div>

    <script src="assets/myscript.js"></script>
</body>
</html>

<?php
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}